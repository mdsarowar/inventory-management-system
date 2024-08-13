<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view store'),403,__('User does not have the right permissions.'));
        return view('admin.store.index',[
            'stores'=>Store::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create store'),403,__('User does not have the right permissions.'));
        return view('admin.store.create',[
            'companies'=>Company::get(),
            'users'=>User::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('create store'),403,__('User does not have the right permissions.'));
        $store=Store::createOrUpdateUser($request);
//        return $store;

        return redirect()->route('store.index')->with('success','Store create successfully');
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
        abort_if(!auth()->user()->can('update store'),403,__('User does not have the right permissions.'));
        return view('admin.store.edit',[
            'store'=>Store::find($id),
            'companies'=>Company::get(),
            'users'=>User::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update store'),403,__('User does not have the right permissions.'));
        $update=Store::createOrUpdateUser($request,$id);
        return redirect()->route('store.index')->with('success','Store information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete store'),403,__('User does not have the right permissions.'));
        $delete=Store::find($id);
//        if (file_exists($branch->logo)){
//            unlink(public_path($branch->logo));
//        }

        $delete->delete();
        return redirect()->route('store.index')->with('error','Branch delete successfully');
    }
}
