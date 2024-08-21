@extends('admin.master')

@section('title',__('Customer'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Customer List')}}</h4>
                <h6>{{__('Manage your Customers')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('customers.create')}}" class="btn btn-added"> <img src="{{asset('/')}}admin/assets/img/icons/plus.svg" alt="img">{{__('Add Customer')}}</a>
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
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Code')}}</th>
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Phone')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{isset($customer->image)?asset($customer->image):asset('admin/assets/img/customer/customer1.jpg')}}" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">{{$customer->name}}</a>
                                </td>
                                <td>{{$customer->cus_code}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->mobile}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{ $customer->status == 1? 'Active':'Inactive' }}</td>
                                <td>
                                    @can('update customer')
                                        <a class="me-3" href="{{route('customers.edit',$customer->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete customer')
                                        <form action="{{route('customers.destroy',$customer->id)}}" method="POST" class="sr-dl" >
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

