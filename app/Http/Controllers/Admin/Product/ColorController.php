<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view color'),403,__('User does not have the right permissions.'));
        return view('admin.product.color.index',[
            'colors'=>Color::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create color'),403,__('User does not have the right permissions.'));
        return view('admin.product.color.create',[
            'colors'=>Color::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request;
        abort_if(!auth()->user()->can('create color'),403,__('User does not have the right permissions.'));
        $store=Color::createOrUpdateColor($request);
//        return $store;

        return redirect()->route('color.index')->with('success','Color create successfully');
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
        abort_if(!auth()->user()->can('update color'),403,__('User does not have the right permissions.'));
        return view('admin.product.color.edit',[
            'color'=>Color::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update color'),403,__('User does not have the right permissions.'));
        $update=Color::createOrUpdateColor($request,$id);
        return redirect()->route('color.index')->with('success','Color information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete color'),403,__('User does not have the right permissions.'));
        $delete=Color::find($id);
        if (file_exists($delete->image)){
            unlink(public_path($delete->image));
        }
        $delete->delete();
        return redirect()->route('color.index')->with('error','Color delete successfully');
    }
}