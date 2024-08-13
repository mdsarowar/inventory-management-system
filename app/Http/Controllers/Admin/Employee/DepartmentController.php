<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view department'),403,__('User does not have the right permissions.'));
        return view('admin.employee.department.index',[
            'departments'=>Department::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create department'),403,__('User does not have the right permissions.'));
        return view('admin.employee.department.create',[
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
        abort_if(!auth()->user()->can('create department'),403,__('User does not have the right permissions.'));
        $store=Department::createOrUpdateUser($request);
//        return $store;

        return redirect()->route('department.index')->with('success','Department create successfully');
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
        abort_if(!auth()->user()->can('update department'),403,__('User does not have the right permissions.'));
        return view('admin.employee.department.edit',[
            'department'=>Department::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update department'),403,__('User does not have the right permissions.'));
        $update=Department::createOrUpdateUser($request,$id);
        return redirect()->route('department.index')->with('success','Department information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete department'),403,__('User does not have the right permissions.'));
        $delete=Department::find($id);
        $delete->delete();
        return redirect()->route('department.index')->with('error','Department delete successfully');
    }
}
