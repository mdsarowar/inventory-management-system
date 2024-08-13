<?php

namespace App\Http\Controllers\Admin\Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\BankTransaction;
use App\Models\BankTransactionDetails;
use App\Models\Branch;
use App\Models\Company;

class BankTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view banktransaction'),403,__('User does not have the right permissions.'));
        return view('admin.bank.transaction.index', [
            'transactions' => BankTransaction::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create banktransaction'),403,__('User does not have the right permissions.'));
        return view('admin.bank.transaction.create', [
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('create banktransaction'),403,__('User does not have the right permissions.'));
        // Create or update the main BankTransaction
        $store = BankTransaction::createOrUpdateBankTransaction($request);

        // Extract transaction details from the hidden input field
        try {
            $transactionDetails = json_decode($request->transaction_details, true);
            if (!empty($transactionDetails)) {
                foreach ($transactionDetails as $detail) {
                    $transactionDetail = new BankTransactionDetails();
                    $transactionDetail->transaction_id      = $store->id;
                    $transactionDetail->credit_id           = $detail['credit_id'] ?? null;
                    $transactionDetail->debit_id            = $detail['debit_id'] ?? null;
                    $transactionDetail->amount              = $detail['amount'] ?? null;
                    $transactionDetail->note                = $store->note ?? null;
                    $transactionDetail->cheque_id           = $detail['cheque_id'] ?? null;
                    $transactionDetail->cheque_date         = !empty($detail['cheque_date']) ? $detail['cheque_date'] : null;
                    $transactionDetail->reference           = $detail['reference'] ?? null;
                    $transactionDetail->user_id             = $store->user_id ?? null;
                    $transactionDetail->branch_id           = $store->branch_id ?? null;
                    $transactionDetail->company_id          = $store->company_id ?? null;
                    $transactionDetail->save();
                }
            }

            // Clear transaction details array from cookies after successfully stored
            Cookie::queue(Cookie::forget('transactionDetailsArray'));

            return redirect()->route('bank_transaction.index')->with('success', 'Bank transaction created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the bank transaction.');
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
        abort_if(!auth()->user()->can('update banktransaction'),403,__('User does not have the right permissions.'));
        return view('admin.bank.transaction.edit',[
            'transaction'=>BankTransaction::find($id),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update banktransaction'),403,__('User does not have the right permissions.'));
        $update = BankTransaction::createOrUpdateBankTransaction($request,$id);

        // Extract transaction details from the hidden input field
        try {
            $transactionDetails = json_decode($request->transaction_details, true);
            // Delete existing transaction details for this transaction
            $update->details()->delete();
            if (!empty($transactionDetails)) {
                // Insert updated transaction details
                foreach ($transactionDetails as $detail) {
                    $transactionDetail = new BankTransactionDetails();
                    $transactionDetail->fill([
                        'transaction_id' => $update->id,
                        'credit_id' => $detail['credit_id'] ?? null,
                        'debit_id' => $detail['debit_id'] ?? null,
                        'amount' => $detail['amount'] ?? null,
                        'note' => $update->note ?? null,
                        'cheque_id' => $detail['cheque_id'] ?? null,
                        'cheque_date' => !empty($detail['cheque_date']) ? $detail['cheque_date'] : null,
                        'reference' => $detail['reference'] ?? null,
                        'user_id' => $update->user_id ?? null,
                        'branch_id' => $update->branch_id ?? null,
                        'company_id' => $update->company_id ?? null
                    ]);
                    $transactionDetail->save();
                }
            }

            return redirect()->route('bank_transaction.index')->with('success', 'Bank transaction information updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the bank transaction.');
        }

        return redirect()->route('bank_transaction.index')->with('success','Bank transaction information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->can('delete banktransaction'),403,__('User does not have the right permissions.'));
        $delete = BankTransaction::find($id);
        $delete->delete();
        return redirect()->route('bank_transaction.index')->with('error','Bank transaction delete successfully');
    }
}
