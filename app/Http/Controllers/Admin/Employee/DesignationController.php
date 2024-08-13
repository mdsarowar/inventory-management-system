<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view designation'),403,__('User does not have the right permissions.'));
        return view('admin.employee.designation.index',[
            'designations'=>Designation::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create designation'),403,__('User does not have the right permissions.'));
        return view('admin.employee.designation.create',[
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
        abort_if(!auth()->user()->can('create designation'),403,__('User does not have the right permissions.'));
        $store=Designation::createOrUpdateUser($request);
//        return $store;

        return redirect()->route('designation.index')->with('success','Designation create successfully');
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
        abort_if(!auth()->user()->can('update designation'),403,__('User does not have the right permissions.'));
        return view('admin.employee.designation.edit',[
            'designation'=>Designation::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update designation'),403,__('User does not have the right permissions.'));
        $update=Designation::createOrUpdateUser($request,$id);
        return redirect()->route('designation.index')->with('success','Designation information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete designation'),403,__('User does not have the right permissions.'));
        $delete=Designation::find($id);
        $delete->delete();
        return redirect()->route('designation.index')->with('error','Designation delete successfully');
    }
}
