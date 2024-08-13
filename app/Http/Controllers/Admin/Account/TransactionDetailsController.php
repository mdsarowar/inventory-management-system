<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountTransactionDetails;
use App\Models\Branch;
use App\Models\Company;

class TransactionDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view transactiondetails'),403,__('User does not have the right permissions.'));
        return view('admin.account.transaction_details.index', [
            'transactions' => AccountTransactionDetails::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create transactiondetails'),403,__('User does not have the right permissions.'));
        return view('admin.account.transaction_details.create', [
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request;
        abort_if(!auth()->user()->can('create transactiondetails'),403,__('User does not have the right permissions.'));
        $store=AccountTransactionDetails::createOrUpdateTransactionDetails($request);
//        return $store;

        return redirect()->route('transaction_details.index')->with('success','Transaction details create successfully');
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
        abort_if(!auth()->user()->can('update transactiondetails'),403,__('User does not have the right permissions.'));
        return view('admin.account.transaction_details.edit',[
            'transaction'=>AccountTransactionDetails::find($id),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update transactiondetails'),403,__('User does not have the right permissions.'));
        $update = AccountTransactionDetails::createOrUpdateTransactionDetails($request,$id);
        return redirect()->route('transaction_details.index')->with('success','Transaction details information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->can('delete transactiondetails'),403,__('User does not have the right permissions.'));
        $delete=AccountTransactionDetails::find($id);
        $delete->delete();
        return redirect()->route('transaction_details.index')->with('error','Transaction details delete successfully');
    }
}
