<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view subcategory'),403,__('User does not have the right permissions.'));
        return view('admin.product.sub_category.index',[
            'sub_categoris'=>SubCategory::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create subcategory'),403,__('User does not have the right permissions.'));
        return view('admin.product.sub_category.create',[
            'categories'=>Category::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request;
        abort_if(!auth()->user()->can('create subcategory'),403,__('User does not have the right permissions.'));
        $store=SubCategory::createOrUpdateUser($request);
//        return $store;

        return redirect()->route('sub_category.index')->with('success','Category create successfully');
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
        abort_if(!auth()->user()->can('update subcategory'),403,__('User does not have the right permissions.'));
        return view('admin.product.sub_category.edit',[
            'sub_cat'=>SubCategory::find($id),
            'categories'=>Category::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update subcategory'),403,__('User does not have the right permissions.'));
        $update=SubCategory::createOrUpdateUser($request,$id);
        return redirect()->route('sub_category.index')->with('success','Category information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete subcategory'),403,__('User does not have the right permissions.'));
        $delete=SubCategory::find($id);
        if (file_exists($delete->image)){
            unlink(public_path($delete->image));
        }
        $delete->delete();
        return redirect()->route('sub_category.index')->with('error','Sub Category delete successfully');
    }
}
