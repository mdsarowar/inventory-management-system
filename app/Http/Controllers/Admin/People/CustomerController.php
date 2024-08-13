<?php

namespace App\Http\Controllers\Admin\People;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view customers'),403,__('User does not have the right permissions.'));
        return view('admin.people.customer.index',[
            'customers'=>Customer::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create customers'),403,__('User does not have the right permissions.'));
        return view('admin.people.customer.create',[
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
        abort_if(!auth()->user()->can('create customers'),403,__('User does not have the right permissions.'));
        $store=Customer::createOrUpdateUser($request);
//        return $store;

        return redirect()->route('customers.index')->with('success','Customer create successfully');
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
        abort_if(!auth()->user()->can('update customers'),403,__('User does not have the right permissions.'));
        return view('admin.people.customer.edit',[
            'customer'=>Customer::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update customers'),403,__('User does not have the right permissions.'));
        $update=Customer::createOrUpdateUser($request,$id);
        return redirect()->route('customers.index')->with('success','Customer information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete customers'),403,__('User does not have the right permissions.'));
        $delete=Customer::find($id);
        if (file_exists($delete->image)){
            unlink(public_path($delete->image));
        }
        $delete->delete();
        return redirect()->route('customers.index')->with('error','Customer delete successfully');
    }
}
