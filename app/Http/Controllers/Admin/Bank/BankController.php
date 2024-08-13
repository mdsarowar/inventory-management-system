<?php

namespace App\Http\Controllers\Admin\Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Company;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view bank'),403,__('User does not have the right permissions.'));
        return view('admin.bank.bank.index',[
            'banks' => Bank::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create bank'),403,__('User does not have the right permissions.'));
        return view('admin.bank.bank.create', [
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('create bank'),403,__('User does not have the right permissions.'));
        $store = Bank::createOrUpdateBank($request);
        return redirect()->route('bank.index')->with('success','Bank create successfully');
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
        abort_if(!auth()->user()->can('update bank'),403,__('User does not have the right permissions.'));
        return view('admin.bank.bank.edit',[
            'bank' => Bank::find($id),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update bank'),403,__('User does not have the right permissions.'));
        $update = Bank::createOrUpdateBank($request,$id);
        return redirect()->route('bank.index')->with('success','Bank information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete bank'),403,__('User does not have the right permissions.'));
        $delete = Bank::find($id);
        $delete->delete();
        return redirect()->route('bank.index')->with('error','Bank delete successfully');
    }
}