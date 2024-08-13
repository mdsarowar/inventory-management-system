<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountClass;
use App\Models\AccountGroup;
use App\Models\Branch;
use App\Models\Company;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view group'),403,__('User does not have the right permissions.'));
        return view('admin.account.group.index',[
            'groups' => AccountGroup::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create group'),403,__('User does not have the right permissions.'));
        return view('admin.account.group.create', [
            'classes' => AccountClass::get(),
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
        abort_if(!auth()->user()->can('create group'),403,__('User does not have the right permissions.'));
        $store=AccountGroup::createOrUpdateGroup($request);
//        return $store;

        return redirect()->route('group.index')->with('success','Group create successfully');
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
        abort_if(!auth()->user()->can('update group'),403,__('User does not have the right permissions.'));
        return view('admin.account.group.edit',[
            'group'=>AccountGroup::find($id),
            'classes' => AccountClass::get(),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update group'),403,__('User does not have the right permissions.'));
        $update=AccountGroup::createOrUpdateGroup($request,$id);
        return redirect()->route('group.index')->with('success','Group information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->can('delete group'),403,__('User does not have the right permissions.'));
        $delete=AccountGroup::find($id);
        $delete->delete();
        return redirect()->route('group.index')->with('error','Group delete successfully');
    }
}