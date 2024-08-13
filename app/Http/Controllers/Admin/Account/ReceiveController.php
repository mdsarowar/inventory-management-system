<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\AccountReceive;
use App\Models\AccountReceiveDetails;
use App\Models\Branch;
use App\Models\Company;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view accountreceive'),403,__('User does not have the right permissions.'));
        return view('admin.account.receive.index', [
            'receives' => AccountReceive::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create accountreceive'),403,__('User does not have the right permissions.'));
        return view('admin.account.receive.create', [
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('create accountreceive'),403,__('User does not have the right permissions.'));
        // Create or update the main AccountReceive
        $store=AccountReceive::createOrUpdateReceive($request);

        // Extract receive details from the hidden input field
        try {
            $receiveDetails = json_decode($request->receive_details, true);
            if (!empty($receiveDetails)) {
                foreach ($receiveDetails as $detail) {
                    $receiveDetail = new AccountReceiveDetails();
                    $receiveDetail->receive_id      = $store->id;
                    $receiveDetail->inv_number      = $store->inv_number ?? null;
                    $receiveDetail->note            = $store->note ?? null;
                    $receiveDetail->credit_id       = $detail['credit_id'] ?? null;
                    $receiveDetail->debit_id        = $detail['debit_id'] ?? null;
                    $receiveDetail->amount          = $detail['amount'] ?? null;
                    $receiveDetail->reference       = $detail['reference'] ?? null;
                    $receiveDetail->date            = $store->date ?? null;
                    $receiveDetail->cheque_id       = $detail['cheque_id'] ?? null;
                    $receiveDetail->cheque_date     = !empty($detail['cheque_date']) ? $detail['cheque_date'] : null;
                    $receiveDetail->user_id         = $store->user_id ?? null;
                    $receiveDetail->branch_id       = $store->branch_id ?? null;
                    $receiveDetail->company_id      = $store->company_id ?? null;
                    $receiveDetail->save();
                }
            }

            // Clear receive details array from cookies after successfully stored
            Cookie::queue(Cookie::forget('receiveDetailsArray'));

            return redirect()->route('account_receive.index')->with('success', 'Receive voucher created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the receive voucher.');
        }

        return redirect()->route('account_receive.index')->with('success','Receive voucher create successfully');
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
        abort_if(!auth()->user()->can('update accountreceive'),403,__('User does not have the right permissions.'));
        return view('admin.account.receive.edit',[
            'receive'=>AccountReceive::find($id),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update accountreceive'),403,__('User does not have the right permissions.'));
        $update = AccountReceive::createOrUpdateReceive($request,$id);

        // Extract receive details from the hidden input field
        try {
            $receiveDetails = json_decode($request->receive_details, true);
            // Delete existing receive details for this receive
            $update->details()->delete();
            if (!empty($receiveDetails)) {
                // Insert updated receive details
                foreach ($receiveDetails as $detail) {
                    $receiveDetail = new AccountReceiveDetails();
                    $receiveDetail->fill([
                        'receive_id' => $update->id,
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
                    $receiveDetail->save();
                }
            }

            return redirect()->route('account_receive.index')->with('success', 'Receive voucher information updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the receive voucher.');
        }

        return redirect()->route('account_receive.index')->with('success','Receive voucher information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->can('delete accountreceive'),403,__('User does not have the right permissions.'));
        $delete=AccountReceive::find($id);
        $delete->delete();
        return redirect()->route('account_receive.index')->with('error','Receive voucher delete successfully');
    }
}
