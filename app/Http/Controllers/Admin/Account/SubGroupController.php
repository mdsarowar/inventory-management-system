<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountClass;
use App\Models\AccountGroup;
use App\Models\AccountSubGroup;
use App\Models\Branch;
use App\Models\Company;

class SubGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view subgroup'),403,__('User does not have the right permissions.'));
        return view('admin.account.sub_group.index', [
            'sub_groups' => AccountSubGroup::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create subgroup'),403,__('User does not have the right permissions.'));
        return view('admin.account.sub_group.create', [
            'classes' => AccountClass::get(),
            'groups' => AccountGroup::get(),
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
        abort_if(!auth()->user()->can('create subgroup'),403,__('User does not have the right permissions.'));
        $store=AccountSubGroup::createOrUpdateSubGroup($request);
//        return $store;

        return redirect()->route('sub_group.index')->with('success','Sub-Group create successfully');
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
        abort_if(!auth()->user()->can('update subgroup'),403,__('User does not have the right permissions.'));
        return view('admin.account.sub_group.edit',[
            'sub_group'=>AccountSubGroup::find($id),
            'classes' => AccountClass::get(),
            'groups' => AccountGroup::get(),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update subgroup'),403,__('User does not have the right permissions.'));
        $update = AccountSubGroup::createOrUpdateSubGroup($request,$id);
        return redirect()->route('sub_group.index')->with('success','Sub-Group information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->can('delete subgroup'),403,__('User does not have the right permissions.'));
        $delete=AccountSubGroup::find($id);
        $delete->delete();
        return redirect()->route('sub_group.index')->with('error','Sub-Group delete successfully');
    }
}
