@extends('admin.master')

@section('title','users')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>User List</h4>
                <h6>Manage your User</h6>
            </div>
            <div class="page-btn">
                <a href="{{ url('admins/create') }}" class="btn btn-added">
                    <img src="{{asset('/')}}admin/assets/img/icons/plus.svg" alt="img" class="me-2">Add User</a>
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
                                <span><img src="{{asset('/')}}admin/assets/img/icons/closes.svg" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset">
                                <img src="{{asset('/')}}admin/assets/img/icons/search-white.svg" alt="img">
                            </a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                        src="{{asset('/')}}admin/assets/img/icons/pdf.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                        src="{{asset('/')}}admin/assets/img/icons/excel.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                        src="{{asset('/')}}admin/assets/img/icons/printer.svg" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Filter -->
{{--                <div class="card" id="filter_inputs">--}}
{{--                    <div class="card-body pb-0">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-2 col-sm-6 col-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="text" placeholder="Enter User Name">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-2 col-sm-6 col-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="text" placeholder="Enter Phone">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-2 col-sm-6 col-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="text" placeholder="Enter Email">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-2 col-sm-6 col-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <select class="select">--}}
{{--                                        <option>Disable</option>--}}
{{--                                        <option>Enable</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-1 col-sm-6 col-12 ms-auto">--}}
{{--                                <div class="form-group">--}}
{{--                                    <a class="btn btn-filters ms-auto"><img--}}
{{--                                            src="{{asset('/')}}admin/assets/img/icons/search-whites.svg" alt="img"></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>Profile</th>
                            <th>First name</th>
                            <th>email</th>
                            <th>role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td class="productimgname">
                                    <a href="#" class="product-img">
                                        <img src="{{asset($user->image)}}" alt="product">
                                    </a>
                                </td>
{{--                                <td>{{ $user->id }}</td>--}}
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $rolename)
                                        <label class="badge bg-primary mx-1">{{ $rolename->name }}</label>
                                    @endforeach
                                </td>

{{--                                <td>--}}
{{--                                    <div class="status-toggle d-flex justify-content-between align-items-center">--}}
{{--                                        <input type="checkbox" id="user1" class="check">--}}
{{--                                        <label for="user1" class="checktoggle">checkbox</label>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
                                <td>
                                    @can('update user')
                                        <a class="me-3" href="{{ url('admins/'.$user->id.'/edit') }}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete user')
                                        <a class="me-3 confirm-text" href="{{ route('user_delete',$user->id) }}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach

{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <label class="checkboxs">--}}
{{--                                    <input type="checkbox">--}}
{{--                                    <span class="checkmarks"></span>--}}
{{--                                </label>--}}
{{--                            </td>--}}
{{--                            <td class="productimgname">--}}
{{--                                <a href="javascript:void(0);" class="product-img">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/customer/customer2.jpg" alt="product">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>Benjamin</td>--}}
{{--                            <td>Franklin</td>--}}
{{--                            <td>504Benjamin</td>--}}
{{--                            <td>123-456-888</td>--}}
{{--                            <td>customer@example.com</td>--}}
{{--                            <td>--}}
{{--                                <div class="status-toggle d-flex justify-content-between align-items-center">--}}
{{--                                    <input type="checkbox" id="user2" class="check" checked="">--}}
{{--                                    <label for="user2" class="checktoggle">checkbox</label>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}

{{--                                <a class="me-3" href="edituser.html">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
{{--                                </a>--}}
{{--                                <a class="me-3 confirm-text" href="javascript:void(0);">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <label class="checkboxs">--}}
{{--                                    <input type="checkbox">--}}
{{--                                    <span class="checkmarks"></span>--}}
{{--                                </label>--}}
{{--                            </td>--}}
{{--                            <td class="productimgname">--}}
{{--                                <a href="javascript:void(0);" class="product-img">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/customer/customer3.jpg" alt="product">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>James</td>--}}
{{--                            <td>James</td>--}}
{{--                            <td>James 524</td>--}}
{{--                            <td>+12163547758</td>--}}
{{--                            <td>james@example.com</td>--}}
{{--                            <td>--}}
{{--                                <div class="status-toggle d-flex justify-content-between align-items-center">--}}
{{--                                    <input type="checkbox" id="user3" class="check" checked="">--}}
{{--                                    <label for="user3" class="checktoggle">checkbox</label>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}

{{--                                <a class="me-3" href="edituser.html">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
{{--                                </a>--}}
{{--                                <a class="me-3 confirm-text" href="javascript:void(0);">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <label class="checkboxs">--}}
{{--                                    <input type="checkbox">--}}
{{--                                    <span class="checkmarks"></span>--}}
{{--                                </label>--}}
{{--                            </td>--}}
{{--                            <td class="productimgname">--}}
{{--                                <a href="javascript:void(0);" class="product-img">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/customer/customer4.jpg" alt="product">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>Bruklin</td>--}}
{{--                            <td>Bruklin</td>--}}
{{--                            <td>Bruklin2022</td>--}}
{{--                            <td>123-456-888</td>--}}
{{--                            <td>bruklin@example.com</td>--}}
{{--                            <td>--}}
{{--                                <div class="status-toggle d-flex justify-content-between align-items-center">--}}
{{--                                    <input type="checkbox" id="user4" class="check" checked="">--}}
{{--                                    <label for="user4" class="checktoggle">checkbox</label>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}

{{--                                <a class="me-3" href="edituser.html">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
{{--                                </a>--}}
{{--                                <a class="me-3 confirm-text" href="javascript:void(0);">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <label class="checkboxs">--}}
{{--                                    <input type="checkbox">--}}
{{--                                    <span class="checkmarks"></span>--}}
{{--                                </label>--}}
{{--                            </td>--}}
{{--                            <td class="productimgname">--}}
{{--                                <a href="javascript:void(0);" class="product-img">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/customer/customer5.jpg" alt="product">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>Franklin</td>--}}
{{--                            <td>Jacob</td>--}}
{{--                            <td>BeverlyWIN25</td>--}}
{{--                            <td>+12163547758</td>--}}
{{--                            <td>Beverly@example.com</td>--}}
{{--                            <td>--}}
{{--                                <div class="status-toggle d-flex justify-content-between align-items-center">--}}
{{--                                    <input type="checkbox" id="user5" class="check">--}}
{{--                                    <label for="user5" class="checktoggle">checkbox</label>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}

{{--                                <a class="me-3" href="edituser.html">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
{{--                                </a>--}}
{{--                                <a class="me-3 confirm-text" href="javascript:void(0);">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <label class="checkboxs">--}}
{{--                                    <input type="checkbox">--}}
{{--                                    <span class="checkmarks"></span>--}}
{{--                                </label>--}}
{{--                            </td>--}}
{{--                            <td class="productimgname">--}}
{{--                                <a href="javascript:void(0);" class="product-img">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/customer/customer6.jpg" alt="product">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>B. Huber</td>--}}
{{--                            <td>Jacob</td>--}}
{{--                            <td>BeverlyWIN25</td>--}}
{{--                            <td>+12163547758</td>--}}
{{--                            <td>Huber@example.com</td>--}}
{{--                            <td>--}}
{{--                                <div class="status-toggle d-flex justify-content-between align-items-center">--}}
{{--                                    <input type="checkbox" id="user6" class="check">--}}
{{--                                    <label for="user6" class="checktoggle">checkbox</label>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}

{{--                                <a class="me-3" href="edituser.html">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
{{--                                </a>--}}
{{--                                <a class="me-3 confirm-text" href="javascript:void(0);">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <label class="checkboxs">--}}
{{--                                    <input type="checkbox">--}}
{{--                                    <span class="checkmarks"></span>--}}
{{--                                </label>--}}
{{--                            </td>--}}
{{--                            <td class="productimgname">--}}
{{--                                <a href="javascript:void(0);" class="product-img">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/customer/customer7.jpg" alt="product">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>Alwin</td>--}}
{{--                            <td>Alwin</td>--}}
{{--                            <td>Alwin243</td>--}}
{{--                            <td>+12163547758</td>--}}
{{--                            <td>customer@example.com</td>--}}
{{--                            <td>--}}
{{--                                <div class="status-toggle d-flex justify-content-between align-items-center">--}}
{{--                                    <input type="checkbox" id="user7" class="check">--}}
{{--                                    <label for="user7" class="checktoggle">checkbox</label>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}

{{--                                <a class="me-3" href="edituser.html">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
{{--                                </a>--}}
{{--                                <a class="me-3 confirm-text" href="javascript:void(0);">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <label class="checkboxs">--}}
{{--                                    <input type="checkbox">--}}
{{--                                    <span class="checkmarks"></span>--}}
{{--                                </label>--}}
{{--                            </td>--}}
{{--                            <td class="productimgname">--}}
{{--                                <a href="javascript:void(0);" class="product-img">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/customer/customer8.jpg" alt="product">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>Fred john</td>--}}
{{--                            <td>john</td>--}}
{{--                            <td>FredJ25</td>--}}
{{--                            <td>+12163547758</td>--}}
{{--                            <td>john@example.com</td>--}}
{{--                            <td>--}}
{{--                                <div class="status-toggle d-flex justify-content-between align-items-center">--}}
{{--                                    <input type="checkbox" id="user15" class="check">--}}
{{--                                    <label for="user15" class="checktoggle">checkbox</label>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}

{{--                                <a class="me-3" href="edituser.html">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
{{--                                </a>--}}
{{--                                <a class="me-3 confirm-text" href="javascript:void(0);">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <label class="checkboxs">--}}
{{--                                    <input type="checkbox">--}}
{{--                                    <span class="checkmarks"></span>--}}
{{--                                </label>--}}
{{--                            </td>--}}
{{--                            <td class="productimgname">--}}
{{--                                <a href="javascript:void(0);" class="product-img">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/customer/customer1.jpg" alt="product">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>Rasmussen</td>--}}
{{--                            <td>Gothic</td>--}}
{{--                            <td>Cras56</td>--}}
{{--                            <td>+12163547758</td>--}}
{{--                            <td>Rasmussen@example.com</td>--}}
{{--                            <td>--}}
{{--                                <div class="status-toggle d-flex justify-content-between align-items-center">--}}
{{--                                    <input type="checkbox" id="user9" class="check" checked>--}}
{{--                                    <label for="user9" class="checktoggle">checkbox</label>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}

{{--                                <a class="me-3" href="edituser.html">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
{{--                                </a>--}}
{{--                                <a class="me-3 confirm-text" href="javascript:void(0);">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <label class="checkboxs">--}}
{{--                                    <input type="checkbox">--}}
{{--                                    <span class="checkmarks"></span>--}}
{{--                                </label>--}}
{{--                            </td>--}}
{{--                            <td class="productimgname">--}}
{{--                                <a href="javascript:void(0);" class="product-img">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/customer/customer2.jpg" alt="product">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>Grace</td>--}}
{{--                            <td>Halena</td>--}}
{{--                            <td>Grace2022</td>--}}
{{--                            <td>+12163547758</td>--}}
{{--                            <td>customer@example.com</td>--}}
{{--                            <td>--}}
{{--                                <div class="status-toggle d-flex justify-content-between align-items-center">--}}
{{--                                    <input type="checkbox" id="user10" class="check" checked>--}}
{{--                                    <label for="user10" class="checktoggle">checkbox</label>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}

{{--                                <a class="me-3" href="edituser.html">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
{{--                                </a>--}}
{{--                                <a class="me-3 confirm-text" href="javascript:void(0);">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <label class="checkboxs">--}}
{{--                                    <input type="checkbox">--}}
{{--                                    <span class="checkmarks"></span>--}}
{{--                                </label>--}}
{{--                            </td>--}}
{{--                            <td class="productimgname">--}}
{{--                                <a href="javascript:void(0);" class="product-img">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/customer/customer3.jpg" alt="product">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>Rasmussen</td>--}}
{{--                            <td>Gothic</td>--}}
{{--                            <td>Cras56</td>--}}
{{--                            <td>+12163547758</td>--}}
{{--                            <td>Rasmussen@example.com</td>--}}
{{--                            <td>--}}
{{--                                <div class="status-toggle d-flex justify-content-between align-items-center">--}}
{{--                                    <input type="checkbox" id="user19" class="check" checked>--}}
{{--                                    <label for="user19" class="checktoggle">checkbox</label>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}

{{--                                <a class="me-3" href="edituser.html">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
{{--                                </a>--}}
{{--                                <a class="me-3 confirm-text" href="javascript:void(0);">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <label class="checkboxs">--}}
{{--                                    <input type="checkbox">--}}
{{--                                    <span class="checkmarks"></span>--}}
{{--                                </label>--}}
{{--                            </td>--}}
{{--                            <td class="productimgname">--}}
{{--                                <a href="javascript:void(0);" class="product-img">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/customer/customer4.jpg" alt="product">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>Grace</td>--}}
{{--                            <td>Halena</td>--}}
{{--                            <td>Grace2022</td>--}}
{{--                            <td>+12163547758</td>--}}
{{--                            <td>customer@example.com</td>--}}
{{--                            <td>--}}
{{--                                <div class="status-toggle d-flex justify-content-between align-items-center">--}}
{{--                                    <input type="checkbox" id="user18" class="check" checked>--}}
{{--                                    <label for="user18" class="checktoggle">checkbox</label>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}

{{--                                <a class="me-3" href="edituser.html">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
{{--                                </a>--}}
{{--                                <a class="me-3 confirm-text" href="javascript:void(0);">--}}
{{--                                    <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>

@endsection

@section('js')
{{--    @include('admin.include.plugin.datatable')--}}
@endsection
