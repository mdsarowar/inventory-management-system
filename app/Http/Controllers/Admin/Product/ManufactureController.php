<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Manufacture;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view manufacture'),403,__('User does not have the right permissions.'));
        return view('admin.product.manufacture.index',[
            'manufactures'=>Manufacture::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create manufacture'),403,__('User does not have the right permissions.'));
        return view('admin.product.manufacture.create',[
            'manufactures'=>Manufacture::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request;
        abort_if(!auth()->user()->can('create manufacture'),403,__('User does not have the right permissions.'));
        $store=Manufacture::createOrUpdateManufacture($request);
//        return $store;

        return redirect()->route('manufacture.index')->with('success','Manufacture create successfully');
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
        abort_if(!auth()->user()->can('update manufacture'),403,__('User does not have the right permissions.'));
        return view('admin.product.manufacture.edit',[
            'manufacture'=>Manufacture::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update manufacture'),403,__('User does not have the right permissions.'));
        $update=Manufacture::createOrUpdateManufacture($request,$id);
        return redirect()->route('manufacture.index')->with('success','Manufacture information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete manufacture'),403,__('User does not have the right permissions.'));
        $delete=Manufacture::find($id);
        if (file_exists($delete->image)){
            unlink(public_path($delete->image));
        }
        $delete->delete();
        return redirect()->route('manufacture.index')->with('error','Manufacture delete successfully');
    }
}