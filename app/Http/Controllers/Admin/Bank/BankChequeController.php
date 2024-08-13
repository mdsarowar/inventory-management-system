<?php

namespace App\Http\Controllers\Admin\Bank;

use App\Http\Controllers\Controller;
use App\Models\BankCheque;
use Illuminate\Http\Request;

class BankChequeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view unit'),403,__('User does not have the right permissions.'));
        return view('admin.product.unit.index',[
            'units'=>BankCheque::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create unit'),403,__('User does not have the right permissions.'));
        return view('admin.product.unit.create',[
            'units'=>BankCheque::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request;
        abort_if(!auth()->user()->can('create unit'),403,__('User does not have the right permissions.'));
        $store=BankCheque::createOrUpdateunit($request);
//        return $store;

        return redirect()->route('unit.index')->with('success','Unit create successfully');
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
        abort_if(!auth()->user()->can('update unit'),403,__('User does not have the right permissions.'));
        return view('admin.product.unit.edit',[
            'unit'=>Unit::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update unit'),403,__('User does not have the right permissions.'));
        $update=Unit::createOrUpdateunit($request,$id);
        return redirect()->route('unit.index')->with('success','Unit information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete unit'),403,__('User does not have the right permissions.'));
        $delete=Unit::find($id);
        if (file_exists($delete->image)){
            unlink(public_path($delete->image));
        }
        $delete->delete();
        return redirect()->route('unit.index')->with('error','Unit delete successfully');
    }
}