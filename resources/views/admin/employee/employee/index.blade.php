@extends('admin.master')

@section('title','employee')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Employee List</h4>
                <h6>Manage your Employee</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('employee.create')}}" class="btn btn-added"> <img src="{{asset('/')}}admin/assets/img/icons/plus.svg" alt="img">Add employee</a>
            </div>
        </div>
        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                 <img src="{{asset('/')}}admin/assets/img/icons/filter.svg" alt="img">
                                <span> <img src="{{asset('/')}}admin/assets/img/icons/closes.svg" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"> <img src="{{asset('/')}}admin/assets/img/icons/search-white.svg" alt="img"></a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"> <img src="{{asset('/')}}admin/assets/img/icons/pdf.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"> <img src="{{asset('/')}}admin/assets/img/icons/excel.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"> <img src="{{asset('/')}}admin/assets/img/icons/printer.svg" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Filter -->
                <div class="card" id="filter_inputs">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Customer Code">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Customer Name">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Phone Number">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-6 col-12  ms-auto">
                                <div class="form-group">
                                    <a class="btn btn-filters ms-auto"> <img src="{{asset('/')}}admin/assets/img/icons/search-whites.svg" alt="img"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>Employee image</th>
                            <th>name</th>
                            <th>department_id</th>
                            <th>designation_id</th>
                            <th>fname</th>
                            <th>mname</th>
                            <th>mobile</th>
                            <th>phone</th>
                            <th>email</th>
                            <th>nid</th>
                            <th>dob</th>
                            <th>joining_date</th>
                            <th>salary</th>
                            <th>address</th>
                            <th>per_address</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{isset($employee->image)?asset($employee->image):asset('admin/assets/img/customer/customer1.jpg')}}" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">{{$employee->name}}</a>
                                </td>
                                <td>{{$employee->name}}</td>
                                <td>{{$employee->department->name}}</td>
                                <td>{{$employee->designation->name}}</td>
                                <td>{{$employee->fname}}</td>
                                <td>{{$employee->mname}}</td>
                                <td>{{$employee->mobile}}</td>
                                <td>{{$employee->phone}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->nid}}</td>
                                <td>{{$employee->dob}}</td>
                                <td>{{$employee->joining_date}}</td>
                                <td>{{$employee->salary}}</td>
                                <td>{{$employee->address}}</td>
                                <td>{{$employee->per_address}}</td>
                                <td>{{ $employee->status == 1? 'Active':'Inactive' }}</td>
                                <td>
                                    @can('update employee')
                                        <a class="me-3" href="{{route('employee.edit',$employee->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete employee')
                                        <form action="{{route('employee.destroy',$employee->id)}}" method="POST" class="sr-dl" >
                                            @csrf
                                            @method('delete')
                                            <a class="delete_confirm" href="javascript:void(0);">
                                                <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">
                                            </a>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
@endsection

