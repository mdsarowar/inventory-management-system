<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view employee'),403,__('User does not have the right permissions.'));
        return view('admin.employee.employee.index',[
            'employees'=>Employee::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create employee'),403,__('User does not have the right permissions.'));
        return view('admin.employee.employee.create',[
            'departments'=>Department::get(),
            'designations'=>Designation::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request;
        abort_if(!auth()->user()->can('create employee'),403,__('User does not have the right permissions.'));
        $store=Employee::createOrUpdateUser($request);
//        return $store;

        return redirect()->route('employee.index')->with('success','Employee create successfully');
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
        abort_if(!auth()->user()->can('update employee'),403,__('User does not have the right permissions.'));
        return view('admin.employee.employee.edit',[
            'employee'=>Employee::find($id),
            'departments'=>Department::get(),
            'designations'=>Designation::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update employee'),403,__('User does not have the right permissions.'));
        $update=Employee::createOrUpdateUser($request,$id);
        return redirect()->route('employee.index')->with('success','Employee information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete employee'),403,__('User does not have the right permissions.'));
        $delete=Employee::find($id);
        $delete->delete();
        return redirect()->route('employee.index')->with('error','Employee delete successfully');
    }
}
