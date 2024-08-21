@extends('admin.master')

@section('title',__('Suppliers'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Supplier List')}}</h4>
                <h6>{{__('Manage your Suppliers')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('suppliers.create')}}" class="btn btn-added"> <img src="{{asset('/')}}admin/assets/img/icons/plus.svg" alt="img">{{__('Add Supplier')}}</a>
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
                            <th>{{__('Suppliers')}}</th>
                            <th>{{__('Code')}}</th>
{{--                            <th>Customer</th>--}}
                            <th>{{__('Phone')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($suppliers as $supplier)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{isset($supplier->image)?asset($supplier->image):asset('admin/assets/img/customer/customer1.jpg')}}" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">{{$supplier->name}}</a>
                                </td>
                                <td>{{$supplier->sup_code}}</td>
{{--                                <td>{{$supplier->name}}</td>--}}
                                <td>{{$supplier->mobile}}</td>
                                <td>{{$supplier->email}}</td>
                                <td>{{ $supplier->status == 1? 'Active':'Inactive' }}</td>
                                <td>
                                    @can('update brand')
                                        <a class="me-3" href="{{route('suppliers.edit',$supplier->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete brand')
                                        <form action="{{route('suppliers.destroy',$supplier->id)}}" method="POST" class="sr-dl" >
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

