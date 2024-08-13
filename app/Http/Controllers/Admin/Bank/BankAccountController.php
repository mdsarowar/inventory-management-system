<?php

namespace App\Http\Controllers\Admin\Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\Company;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view bankaccount'),403,__('User does not have the right permissions.'));
        return view('admin.bank.bank_account.index',[
            'accounts' => BankAccount::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create bankaccount'),403,__('User does not have the right permissions.'));
        return view('admin.bank.bank_account.create', [
            'banks' => Bank::get(),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('create bankaccount'),403,__('User does not have the right permissions.'));
        $store = BankAccount::createOrUpdateBankAccount($request);
        return redirect()->route('bank_account.index')->with('success','Account create successfully');
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
        abort_if(!auth()->user()->can('update bankaccount'),403,__('User does not have the right permissions.'));
        return view('admin.bank.bank_account.edit',[
            'account' => BankAccount::find($id),
            'banks' => Bank::get(),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update bankaccount'),403,__('User does not have the right permissions.'));
        $update = BankAccount::createOrUpdateBankAccount($request,$id);
        return redirect()->route('bank_account.index')->with('success','Account information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete bankaccount'),403,__('User does not have the right permissions.'));
        $delete = BankAccount::find($id);
        $delete->delete();
        return redirect()->route('bank_account.index')->with('error','Account delete successfully');
    }
}
