<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view brand'),403,__('User does not have the right permissions.'));
        return view('admin.product.brand.index',[
            'brands'=>Brand::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create brand'),403,__('User does not have the right permissions.'));
        return view('admin.product.brand.create',[
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
        abort_if(!auth()->user()->can('create brand'),403,__('User does not have the right permissions.'));
        $store=Brand::createOrUpdateUser($request);
//        return $store;

        return redirect()->route('brand.index')->with('success','Brand create successfully');
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
        abort_if(!auth()->user()->can('update brand'),403,__('User does not have the right permissions.'));
        return view('admin.product.brand.edit',[
            'brand'=>Brand::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update brand'),403,__('User does not have the right permissions.'));
        $update=Brand::createOrUpdateUser($request,$id);
        return redirect()->route('brand.index')->with('success','Brand information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete brand'),403,__('User does not have the right permissions.'));
        $delete=Brand::find($id);
        if (file_exists($delete->image)){
            unlink(public_path($delete->image));
        }
        $delete->delete();
        return redirect()->route('brand.index')->with('error','Brand delete successfully');
    }
}
