<?php

namespace App\Http\Controllers\Admin\Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankMobile;
use App\Models\Branch;
use App\Models\Company;

class BankMobileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view bankmobile'),403,__('User does not have the right permissions.'));
        return view('admin.bank.bank_mobile.index',[
            'accounts' => BankMobile::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create bankmobile'),403,__('User does not have the right permissions.'));
        return view('admin.bank.bank_mobile.create', [
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('create bankmobile'),403,__('User does not have the right permissions.'));
        $store = BankMobile::createOrUpdateBankMobile($request);
        return redirect()->route('bank_mobile.index')->with('success','Account create successfully');
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
        abort_if(!auth()->user()->can('update bankmobile'),403,__('User does not have the right permissions.'));
        return view('admin.bank.bank_mobile.edit',[
            'account' => BankMobile::find($id),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update bankmobile'),403,__('User does not have the right permissions.'));
        $update = BankMobile::createOrUpdateBankMobile($request,$id);
        return redirect()->route('bank_mobile.index')->with('success','Account information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete bankmobile'),403,__('User does not have the right permissions.'));
        $delete = BankMobile::find($id);
        $delete->delete();
        return redirect()->route('bank_mobile.index')->with('error','Account delete successfully');
    }
}
