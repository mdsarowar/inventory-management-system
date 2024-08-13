<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\AccountJournal;
use App\Models\AccountJournalDetails;
use App\Models\Branch;
use App\Models\Company;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view journal'),403,__('User does not have the right permissions.'));
        return view('admin.account.journal.index', [
            'journals' => AccountJournal::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create journal'),403,__('User does not have the right permissions.'));
        return view('admin.account.journal.create', [
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('create journal'),403,__('User does not have the right permissions.'));
        // Create or update the main Accountjournal
        $store = AccountJournal::createOrUpdateJournal($request);

        // Extract journal details from the hidden input field
        try {
            $journalDetails = json_decode($request->journal_details, true);
            if (!empty($journalDetails)) {
                foreach ($journalDetails as $detail) {
                    $journalDetail = new AccountJournalDetails();
                    $journalDetail->journal_id      = $store->id;
                    $journalDetail->inv_number      = $store->inv_number ?? null;
                    $journalDetail->note            = $store->note ?? null;
                    $journalDetail->credit_id       = $detail['credit_id'] ?? null;
                    $journalDetail->debit_id        = $detail['debit_id'] ?? null;
                    $journalDetail->amount          = $detail['amount'] ?? null;
                    $journalDetail->reference       = $detail['reference'] ?? null;
                    $journalDetail->date            = $store->date ?? null;
                    $journalDetail->cheque_id       = $detail['cheque_id'] ?? null;
                    $journalDetail->cheque_date     = !empty($detail['cheque_date']) ? $detail['cheque_date'] : null;
                    $journalDetail->user_id         = $store->user_id ?? null;
                    $journalDetail->branch_id       = $store->branch_id ?? null;
                    $journalDetail->company_id      = $store->company_id ?? null;
                    $journalDetail->save();
                }
            }

            // Clear journal details array from cookies after successfully stored
            Cookie::queue(Cookie::forget('journalDetailsArray'));

            return redirect()->route('journal.index')->with('success', 'Journal voucher created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the journal voucher.');
        }

        return redirect()->route('journal.index')->with('success','Journal create successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!auth()->user()->can('update journal'),403,__('User does not have the right permissions.'));
        return view('admin.account.journal.edit',[
            'journal'=>AccountJournal::find($id),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update journal'),403,__('User does not have the right permissions.'));
        $update = AccountJournal::createOrUpdateJournal($request,$id);

        // Extract journal details from the hidden input field
        try {
            $journalDetails = json_decode($request->journal_details, true);
            // Delete existing journal details for this journal
            $update->details()->delete();
            if (!empty($journalDetails)) {
                // Insert updated journal details
                foreach ($journalDetails as $detail) {
                    $journalDetail = new AccountJournalDetails();
                    $journalDetail->fill([
                        'journal_id' => $update->id,
                        'inv_number' => $update->inv_number ?? null,
                        'note' => $update->note ?? null,
                        'credit_id' => $detail['credit_id'] ?? null,
                        'debit_id' => $detail['debit_id'] ?? null,
                        'amount' => $detail['amount'] ?? null,
                        'reference' => $detail['reference'] ?? null,
                        'date' => $update->date ?? null,
                        'cheque_id' => $detail['cheque_id'] ?? null,
                        'cheque_date' => !empty($detail['cheque_date']) ? $detail['cheque_date'] : null,
                        'user_id' => $update->user_id ?? null,
                        'branch_id' => $update->branch_id ?? null,
                        'company_id' => $update->company_id ?? null
                    ]);
                    $journalDetail->save();
                }
            }
    
            return redirect()->route('journal.index')->with('success', 'Journal voucher information updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the journal voucher.');
        }
        
        return redirect()->route('journal.index')->with('success','Journal information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->can('delete journal'),403,__('User does not have the right permissions.'));
        $delete=AccountJournal::find($id);
        $delete->delete();
        return redirect()->route('journal.index')->with('error','Journal delete successfully');
    }
}