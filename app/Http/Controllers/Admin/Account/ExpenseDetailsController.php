<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountExpenseDetails;
use App\Models\Branch;
use App\Models\Company;

class ExpenseDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view expensedetails'),403,__('User does not have the right permissions.'));
        return view('admin.account.expense_details.index', [
            'expenses' => AccountExpenseDetails::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create expensedetails'),403,__('User does not have the right permissions.'));
        return view('admin.account.expense_details.create', [
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
        abort_if(!auth()->user()->can('create expensedetails'),403,__('User does not have the right permissions.'));
        $store=AccountExpenseDetails::createOrUpdateExpenseDetails($request);
//        return $store;

        return redirect()->route('expense_details.index')->with('success','Expense details create successfully');
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
        abort_if(!auth()->user()->can('update expensedetails'),403,__('User does not have the right permissions.'));
        return view('admin.account.expense_details.edit',[
            'expense'=>AccountExpenseDetails::find($id),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update expensedetails'),403,__('User does not have the right permissions.'));
        $update = AccountExpenseDetails::createOrUpdateExpenseDetails($request,$id);
        return redirect()->route('expense_details.index')->with('success','Expense details information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->can('delete expensedetails'),403,__('User does not have the right permissions.'));
        $delete=AccountExpenseDetails::find($id);
        $delete->delete();
        return redirect()->route('expense_details.index')->with('error','Expense details delete successfully');
    }
}
