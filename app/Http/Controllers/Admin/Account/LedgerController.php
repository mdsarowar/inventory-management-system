<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountClass;
use App\Models\AccountGroup;
use App\Models\AccountSubGroup;
use App\Models\AccountLedger;
use App\Models\Branch;
use App\Models\Company;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view ledger'),403,__('User does not have the right permissions.'));
        return view('admin.account.ledger.index', [
            'ledgers' => AccountLedger::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create ledger'),403,__('User does not have the right permissions.'));
        return view('admin.account.ledger.create', [
            'classes' => AccountClass::get(),
            'groups' => AccountGroup::get(),
            'sub_groups' => AccountSubGroup::get(),
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
        abort_if(!auth()->user()->can('create ledger'),403,__('User does not have the right permissions.'));
        $store=AccountLedger::createOrUpdateLedger($request);
//        return $store;

        return redirect()->route('ledger.index')->with('success','Ledger create successfully');
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
        abort_if(!auth()->user()->can('update ledger'),403,__('User does not have the right permissions.'));
        return view('admin.account.ledger.edit',[
            'ledger'=>AccountLedger::find($id),
            'classes' => AccountClass::get(),
            'groups' => AccountGroup::get(),
            'sub_groups' => AccountSubGroup::get(),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update ledger'),403,__('User does not have the right permissions.'));
        $update = AccountLedger::createOrUpdateLedger($request,$id);
        return redirect()->route('ledger.index')->with('success','Ledger information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->can('delete ledger'),403,__('User does not have the right permissions.'));
        $delete=AccountLedger::find($id);
        $delete->delete();
        return redirect()->route('ledger.index')->with('error','Ledger delete successfully');
    }
}