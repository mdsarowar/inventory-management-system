<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountClass;
use App\Models\Branch;
use App\Models\Company;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view class'),403,__('User does not have the right permissions.'));
        return view('admin.account.class.index',[
            'classes' => AccountClass::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create class'),403,__('User does not have the right permissions.'));
        return view('admin.account.class.create', [
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
        abort_if(!auth()->user()->can('create class'),403,__('User does not have the right permissions.'));
        $store=AccountClass::createOrUpdateClass($request);
//        return $store;

        return redirect()->route('class.index')->with('success','Class create successfully');
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
        abort_if(!auth()->user()->can('update class'),403,__('User does not have the right permissions.'));
        return view('admin.account.class.edit',[
            'class'=>AccountClass::find($id),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update class'),403,__('User does not have the right permissions.'));
        $update=AccountClass::createOrUpdateClass($request,$id);
        return redirect()->route('class.index')->with('success','Class information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->can('delete class'),403,__('User does not have the right permissions.'));
        $delete=AccountClass::find($id);
        $delete->delete();
        return redirect()->route('class.index')->with('error','Class delete successfully');
    }
}