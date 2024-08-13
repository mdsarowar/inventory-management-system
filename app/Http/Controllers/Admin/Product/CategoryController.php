<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view category'),403,__('User does not have the right permissions.'));
        return view('admin.product.category.index',[
            'categories'=>Category::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create category'),403,__('User does not have the right permissions.'));
        return view('admin.product.category.create',[
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
        abort_if(!auth()->user()->can('create category'),403,__('User does not have the right permissions.'));
        $store=Category::createOrUpdateUser($request);
//        return $store;

        return redirect()->route('category.index')->with('success','Category create successfully');
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
        abort_if(!auth()->user()->can('update category'),403,__('User does not have the right permissions.'));
        return view('admin.product.category.edit',[
            'category'=>Category::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update category'),403,__('User does not have the right permissions.'));
        $update=Category::createOrUpdateUser($request,$id);
        return redirect()->route('category.index')->with('success','Category information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete category'),403,__('User does not have the right permissions.'));
        $delete=Category::find($id);
        if (file_exists($delete->image)){
            unlink(public_path($delete->image));
        }
        $delete->delete();
        return redirect()->route('category.index')->with('error','Category delete successfully');
    }
}
