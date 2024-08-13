<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view company'),403,__('User does not have the right permissions.'));
        return view('admin.company.index',[
            'companies'=>Company::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create company'),403,__('User does not have the right permissions.'));
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('create company'),403,__('User does not have the right permissions.'));
        $store=Company::createOrUpdateUser($request);

        return redirect()->route('company.index')->with('success','Company create successfully');
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
        abort_if(!auth()->user()->can('update company'),403,__('User does not have the right permissions.'));
        return view('admin.company.edit',[
            'company'=>Company::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update company'),403,__('User does not have the right permissions.'));
        $company=Company::createOrUpdateUser($request,$id);
        return redirect()->route('company.index')->with('success','Company information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete company'),403,__('User does not have the right permissions.'));
        $company=Company::find($id);
        if (file_exists($company->logo)){
            unlink(public_path($company->logo));
        }
        if (file_exists($company->license_image)){
            unlink(public_path($company->license_image));
        }
        if (file_exists($company->tin_image)){
            unlink(public_path($company->tin_image));
        }

        $company->delete();
        return redirect()->route('company.index')->with('error','company delete successfully');
    }
}
