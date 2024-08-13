{{--<x-app-layout>--}}
@extends('admin.master')

@section('title','users')

@section('content')
    <div class="container mt-5">
        <a href="{{ url('roles') }}" class="btn btn-primary mx-1">Roles</a>
        <a href="{{ url('permissions') }}" class="btn btn-info mx-1">Permissions</a>
        <a href="{{ url('users') }}" class="btn btn-warning mx-1">Users</a>
    </div>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>
                            Roles
                            @can('create role')
                                <a href="{{ url('roles/create') }}" class="btn btn-primary float-end">Add Role</a>
                            @endcan
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th width="40%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="btn btn-warning">
                                            Add / Edit Role Permission
                                        </a>

                                        @can('update role')
                                            <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-success">
                                                Edit
                                            </a>
                                        @endcan

                                        @can('delete role')
                                            <a href="{{ url('roles/'.$role->id.'/delete') }}" class="btn btn-danger mx-2">
                                                Delete
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

{{--</x-app-layout>--}}
@endsection

{{--@extends('admin.master')--}}

{{--@section('title','users')--}}

{{--@section('content')--}}
{{--    <div class="content">--}}
{{--        <div class="page-header">--}}
{{--            <div class="page-title">--}}
{{--                <h4>User List</h4>--}}
{{--                <h6>Manage your User</h6>--}}
{{--            </div>--}}
{{--            <div class="page-btn">--}}
{{--                <a href="{{ url('users/create') }}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"--}}
{{--                                                                               alt="img" class="me-2">Add User</a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- /product list -->--}}
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <div class="table-top">--}}
{{--                    <div class="search-set">--}}
{{--                        <div class="search-path">--}}
{{--                            <a class="btn btn-filter" id="filter_search">--}}
{{--                                <img src="{{asset('/')}}admin/assets/img/icons/filter.svg" alt="img">--}}
{{--                                <span><img src="{{asset('/')}}admin/assets/img/icons/closes.svg" alt="img"></span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="search-input">--}}
{{--                            <a class="btn btn-searchset">--}}
{{--                                <img src="{{asset('/')}}admin/assets/img/icons/search-white.svg" alt="img">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="wordset">--}}
{{--                        <ul>--}}
{{--                            <li>--}}
{{--                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img--}}
{{--                                        src="{{asset('/')}}admin/assets/img/icons/pdf.svg" alt="img"></a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img--}}
{{--                                        src="{{asset('/')}}admin/assets/img/icons/excel.svg" alt="img"></a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img--}}
{{--                                        src="{{asset('/')}}admin/assets/img/icons/printer.svg" alt="img"></a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /Filter -->--}}
{{--                --}}{{--                <div class="card" id="filter_inputs">--}}
{{--                --}}{{--                    <div class="card-body pb-0">--}}
{{--                --}}{{--                        <div class="row">--}}
{{--                --}}{{--                            <div class="col-lg-2 col-sm-6 col-12">--}}
{{--                --}}{{--                                <div class="form-group">--}}
{{--                --}}{{--                                    <input type="text" placeholder="Enter User Name">--}}
{{--                --}}{{--                                </div>--}}
{{--                --}}{{--                            </div>--}}
{{--                --}}{{--                            <div class="col-lg-2 col-sm-6 col-12">--}}
{{--                --}}{{--                                <div class="form-group">--}}
{{--                --}}{{--                                    <input type="text" placeholder="Enter Phone">--}}
{{--                --}}{{--                                </div>--}}
{{--                --}}{{--                            </div>--}}
{{--                --}}{{--                            <div class="col-lg-2 col-sm-6 col-12">--}}
{{--                --}}{{--                                <div class="form-group">--}}
{{--                --}}{{--                                    <input type="text" placeholder="Enter Email">--}}
{{--                --}}{{--                                </div>--}}
{{--                --}}{{--                            </div>--}}
{{--                --}}{{--                            <div class="col-lg-2 col-sm-6 col-12">--}}
{{--                --}}{{--                                <div class="form-group">--}}
{{--                --}}{{--                                    <select class="select">--}}
{{--                --}}{{--                                        <option>Disable</option>--}}
{{--                --}}{{--                                        <option>Enable</option>--}}
{{--                --}}{{--                                    </select>--}}
{{--                --}}{{--                                </div>--}}
{{--                --}}{{--                            </div>--}}
{{--                --}}{{--                            <div class="col-lg-1 col-sm-6 col-12 ms-auto">--}}
{{--                --}}{{--                                <div class="form-group">--}}
{{--                --}}{{--                                    <a class="btn btn-filters ms-auto"><img--}}
{{--                --}}{{--                                            src="{{asset('/')}}admin/assets/img/icons/search-whites.svg" alt="img"></a>--}}
{{--                --}}{{--                                </div>--}}
{{--                --}}{{--                            </div>--}}
{{--                --}}{{--                        </div>--}}
{{--                --}}{{--                    </div>--}}
{{--                --}}{{--                </div>--}}
{{--                <!-- /Filter -->--}}
{{--                <div class="table-responsive">--}}
{{--                    <table class="table  datanew">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                <label class="checkboxs">--}}
{{--                                    <input type="checkbox">--}}
{{--                                    <span class="checkmarks"></span>--}}
{{--                                </label>--}}
{{--                            </th>--}}
{{--                            <th>ID</th>--}}
{{--                            <th>name</th>--}}
{{--                            --}}{{--                            <th>Last name</th>--}}
{{--                            --}}{{--                            <th>User name</th>--}}
{{--                            <th>email</th>--}}
{{--                            --}}{{--                            <th>Phone</th>--}}
{{--                            <th>role</th>--}}
{{--                            <th>Action</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach ($roles as $role)--}}
{{--                            <tr>--}}

{{--                                <td>--}}
{{--                                    <label class="checkboxs">--}}
{{--                                        <input type="checkbox">--}}
{{--                                        <span class="checkmarks"></span>--}}
{{--                                    </label>--}}
{{--                                </td>--}}
{{--                                <td class="productimgname">--}}
{{--                                    <a href="#" class="product-img">--}}
{{--                                        <img src="{{asset('/')}}admin/assets/img/customer/customer1.jpg" alt="product">--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                                <td>{{ $role->id }}</td>--}}
{{--                                <td>{{ $role->name }}</td>--}}
{{--                                <td>--}}
{{--                                    @can('update user')--}}
{{--                                        <a class="me-3" href="{{ url('roles/'.$role->id.'/give-permissions') }}">--}}
{{--                                            add permission--}}
{{--                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
{{--                                        </a>--}}
{{--                                        <a class="me-3" href="{{ url('roles/'.$role->id.'/edit') }}">--}}
{{--                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
{{--                                        </a>--}}
{{--                                    @endcan--}}
{{--                                    @can('delete user')--}}
{{--                                        <a class="me-3 confirm-text" href="{{ url('roles/'.$role->id.'/delete') }}">--}}
{{--                                            <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
{{--                                        </a>--}}
{{--                                    @endcan--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /product list -->--}}
{{--    </div>--}}

{{--@endsection--}}

