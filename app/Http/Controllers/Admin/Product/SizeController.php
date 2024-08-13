<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view size'),403,__('User does not have the right permissions.'));
        return view('admin.product.size.index',[
            'sizes'=>Size::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create size'),403,__('User does not have the right permissions.'));
        return view('admin.product.size.create',[
            'sizes'=>Size::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request;
        abort_if(!auth()->user()->can('create size'),403,__('User does not have the right permissions.'));
        $store=Size::createOrUpdateSize($request);
//        return $store;

        return redirect()->route('size.index')->with('success','Size create successfully');
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
        abort_if(!auth()->user()->can('update size'),403,__('User does not have the right permissions.'));
        return view('admin.product.size.edit',[
            'size'=>Size::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update size'),403,__('User does not have the right permissions.'));
        $update=Size::createOrUpdatesize($request,$id);
        return redirect()->route('size.index')->with('success','Size information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete size'),403,__('User does not have the right permissions.'));
        $delete=size::find($id);
        if (file_exists($delete->image)){
            unlink(public_path($delete->image));
        }
        $delete->delete();
        return redirect()->route('size.index')->with('error','Size delete successfully');
    }
}