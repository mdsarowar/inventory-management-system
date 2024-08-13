<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view childcategory'),403,__('User does not have the right permissions.'));
        return view('admin.product.child_category.index',[
            'child_categoris'=>ChildCategory::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create childcategory'),403,__('User does not have the right permissions.'));
        return view('admin.product.child_category.create',[
            'categories'=>Category::get(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request;
        abort_if(!auth()->user()->can('create childcategory'),403,__('User does not have the right permissions.'));
        $store=ChildCategory::createOrUpdateUser($request);
//        return $store;

        return redirect()->route('child_category.index')->with('success','Child create successfully');
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
        abort_if(!auth()->user()->can('update childcategory'),403,__('User does not have the right permissions.'));
        return view('admin.product.child_category.edit',[
            'child_cat'=>ChildCategory::find($id),
            'categories'=>Category::get(),
            'sub_categories'=>SubCategory::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update childcategory'),403,__('User does not have the right permissions.'));
        $update=ChildCategory::createOrUpdateUser($request,$id);
        return redirect()->route('child_category.index')->with('success','Child Category information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete childcategory'),403,__('User does not have the right permissions.'));
        $delete=ChildCategory::find($id);
        if (file_exists($delete->image)){
            unlink(public_path($delete->image));
        }
        $delete->delete();
        return redirect()->route('child_category.index')->with('error','Child Category delete successfully');
    }
}
