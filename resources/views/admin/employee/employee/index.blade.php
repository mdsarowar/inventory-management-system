@extends('admin.master')

@section('title',__('Employee'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Employee List')}}</h4>
                <h6>{{__('Manage your Employee')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('employee.create')}}" class="btn btn-added"> <img src="{{asset('/')}}admin/assets/img/icons/plus.svg" alt="img">{{__('Add Employee')}}</a>
            </div>
        </div>
        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>{{__('Employee')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Department')}}</th>
{{--                            <th>{{__('Designation')}}</th>--}}
{{--                            <th>{{__('Father Name')}}</th>--}}
{{--                            <th>{{__('Mother Name')}}</th>--}}
{{--                            <th>mobile</th>--}}
                            <th>{{__('Phone')}}</th>
                            <th>{{__('Email')}}</th>
{{--                            <th>nid</th>--}}
{{--                            <th>dob</th>--}}
                            <th>{{__('Joining Date')}}</th>
                            <th>{{__('Salary')}}</th>
{{--                            <th>address</th>--}}
{{--                            <th>per_address</th>--}}
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
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
{{--                                <td>{{$employee->designation->name}}</td>--}}
{{--                                <td>{{$employee->fname}}</td>--}}
{{--                                <td>{{$employee->mname}}</td>--}}
{{--                                <td>{{$employee->mobile}}</td>--}}
                                <td>{{$employee->phone}}</td>
                                <td>{{$employee->email}}</td>
{{--                                <td>{{$employee->nid}}</td>--}}
{{--                                <td>{{$employee->dob}}</td>--}}
                                <td>{{$employee->joining_date}}</td>
                                <td>{{$employee->salary}}</td>
{{--                                <td>{{$employee->address}}</td>--}}
{{--                                <td>{{$employee->per_address}}</td>--}}
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

