<?php

namespace App\Http\Controllers\Admin\Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankTransfer;
use App\Models\Branch;
use App\Models\Company;

class BankTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view banktransfer'),403,__('User does not have the right permissions.'));
        return view('admin.bank.bank_transfer.index',[
            'transfers' => BankTransfer::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create banktransfer'),403,__('User does not have the right permissions.'));
        return view('admin.bank.bank_transfer.create',[
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
        abort_if(!auth()->user()->can('create banktransfer'),403,__('User does not have the right permissions.'));
        $store = BankTransfer::createOrUpdateBankTransfer($request);
//        return $store;

        return redirect()->route('bank_transfer.index')->with('success','Transfer create successfully');
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
        abort_if(!auth()->user()->can('update banktransfer'),403,__('User does not have the right permissions.'));
        return view('admin.bank.bank_transfer.edit',[
            'bank_transfer' => BankTransfer::find($id),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update banktransfer'),403,__('User does not have the right permissions.'));
        $update = BankTransfer::createOrUpdateBankTransfer($request,$id);
        return redirect()->route('bank_transfer.index')->with('success','Transfer information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete banktransfer'),403,__('User does not have the right permissions.'));
        $delete = BankTransfer::find($id);
        $delete->delete();
        return redirect()->route('bank_transfer.index')->with('error','Transfer delete successfully');
    }
}
