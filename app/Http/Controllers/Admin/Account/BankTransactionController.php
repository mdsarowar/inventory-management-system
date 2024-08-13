<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\AccountBankTransaction;
use App\Models\AccountBankTransactionDetails;
use App\Models\Branch;
use App\Models\Company;

class BankTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view bank_transaction'),403,__('User does not have the right permissions.'));
        return view('admin.account.bank_transaction.index', [
            'transactions' => AccountBankTransaction::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create bank_transaction'),403,__('User does not have the right permissions.'));
        return view('admin.account.bank_transaction.create', [
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('create bank_transaction'),403,__('User does not have the right permissions.'));
        // Create or update the main AccountBankTransaction
        $store = AccountBankTransaction::createOrUpdateBankTransaction($request);

        // Extract bankTran details from the hidden input field
        try {
            $bankTranDetails = json_decode($request->bankTran_details, true);
            if (!empty($bankTranDetails)) {
                foreach ($bankTranDetails as $detail) {
                    $bankTranDetail = new AccountBankTransactionDetails();
                    $bankTranDetail->bank_tran_id    = $store->id;
                    $bankTranDetail->inv_id          = $store->inv_number ?? null;
                    $bankTranDetail->note            = $store->note ?? null;
                    $bankTranDetail->credit_id       = $detail['credit_id'] ?? null;
                    $bankTranDetail->debit_id        = $detail['debit_id'] ?? null;
                    $bankTranDetail->amount          = $detail['amount'] ?? null;
                    $bankTranDetail->reference       = $detail['reference'] ?? null;
                    $bankTranDetail->date            = $store->date ?? null;
                    $bankTranDetail->cheque_id       = $detail['cheque_id'] ?? null;
                    $bankTranDetail->cheque_date     = !empty($detail['cheque_date']) ? $detail['cheque_date'] : null;
                    $bankTranDetail->user_id         = $store->user_id ?? null;
                    $bankTranDetail->branch_id       = $store->branch_id ?? null;
                    $bankTranDetail->company_id      = $store->company_id ?? null;
                    $bankTranDetail->save();
                }
            }

            // Clear bankTran details array from cookies after successfully stored
            Cookie::queue(Cookie::forget('bankTranDetailsArray'));

            return redirect()->route('bank_transaction.index')->with('success', 'Bank tansaction voucher created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the bank transaction voucher.');
        }

        return redirect()->route('bank_transaction.index')->with('success','Bank transaction create successfully');
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
        abort_if(!auth()->user()->can('update bank_transaction'),403,__('User does not have the right permissions.'));
        return view('admin.account.bank_transaction.edit',[
            'transaction'=>AccountBankTransaction::find($id),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update bank_transaction'),403,__('User does not have the right permissions.'));
        $update = AccountBankTransaction::createOrUpdateBankTransaction($request,$id);

        // Extract bankTran details from the hidden input field
        try {
            $bankTranDetails = json_decode($request->bankTran_details, true);
            // Delete existing bankTran details for this bankTran
            $update->details()->delete();
            if (!empty($bankTranDetails)) {
                // Insert updated bankTran details
                foreach ($bankTranDetails as $detail) {
                    $bankTranDetail = new AccountBankTransactionDetails();
                    $bankTranDetail->fill([
                        'bank_tran_id' => $update->id,
                        'inv_id' => $update->inv_number ?? null,
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
                    $bankTranDetail->save();
                }
            }
    
            return redirect()->route('bank_transaction.index')->with('success', 'Bank transaction voucher information updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the bank transaction voucher.');
        }

        return redirect()->route('bank_transaction.index')->with('success','Bank transaction information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->can('delete bank_transaction'),403,__('User does not have the right permissions.'));
        $delete=AccountBankTransaction::find($id);
        $delete->delete();
        return redirect()->route('bank_transaction.index')->with('error','Bank transaction delete successfully');
    }
}