<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view branch'),403,__('User does not have the right permissions.'));
        return view('admin.branch.index',[
            'branches'=>Branch::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create branch'),403,__('User does not have the right permissions.'));
        return view('admin.branch.create',[
            'companies'=>Company::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('create branch'),403,__('User does not have the right permissions.'));
        $store=Branch::createOrUpdateUser($request);
//        return $store;

        return redirect()->route('branch.index')->with('success','Branch create successfully');
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
        abort_if(!auth()->user()->can('update branch'),403,__('User does not have the right permissions.'));
        return view('admin.branch.edit',[
            'branch'=>Branch::find($id),
            'companies'=>Company::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update branch'),403,__('User does not have the right permissions.'));
        $update=Branch::createOrUpdateUser($request,$id);
        return redirect()->route('branch.index')->with('success','Branch information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete branch'),403,__('User does not have the right permissions.'));
        $branch=Branch::find($id);
        if (file_exists($branch->logo)){
            unlink(public_path($branch->logo));
        }

        $branch->delete();
        return redirect()->route('branch.index')->with('error','Branch delete successfully');
    }
}
