<?php

namespace App\Http\Controllers\Admin\People;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view suppliers'),403,__('User does not have the right permissions.'));
        return view('admin.people.supplier.index',[
            'suppliers'=>Supplier::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create suppliers'),403,__('User does not have the right permissions.'));
        return view('admin.people.supplier.create',[
//            'companies'=>Brand::get(),
//            'users'=>User::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request;
        abort_if(!auth()->user()->can('create suppliers'),403,__('User does not have the right permissions.'));
        $store=Supplier::createOrUpdateUser($request);
//        return $store;

        return redirect()->route('suppliers.index')->with('success','Supplier create successfully');
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
        abort_if(!auth()->user()->can('update suppliers'),403,__('User does not have the right permissions.'));
        return view('admin.people.supplier.edit',[
            'supplier'=>Supplier::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update suppliers'),403,__('User does not have the right permissions.'));
        $update=Supplier::createOrUpdateUser($request,$id);
        return redirect()->route('suppliers.index')->with('success','Supplier information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete suppliers'),403,__('User does not have the right permissions.'));
        $delete=Supplier::find($id);
        if (file_exists($delete->image)){
            unlink(public_path($delete->image));
        }
        $delete->delete();
        return redirect()->route('suppliers.index')->with('error','Supplier delete successfully');
    }
}
