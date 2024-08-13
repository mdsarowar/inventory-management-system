@extends('admin.master')

@section('title',__('Manufacture'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Product')}} {{__('List')}}</h4>
                <h6>{{__('Manage your')}} {{__('products')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('product.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg" alt="img" class="me-1">Add</a>
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
                            <a class="btn btn-searchset"><img src="{{asset('/')}}admin/assets/img/icons/search-white.svg" alt="img"></a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{asset('/')}}admin/assets/img/icons/pdf.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{asset('/')}}admin/assets/img/icons/excel.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{asset('/')}}admin/assets/img/icons/printer.svg" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Filter -->
                <div class="card mb-0" id="filter_inputs">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg col-sm-6 col-12">
                                        <div class="form-group">
                                            <select class="select">
                                                <option>Choose Product</option>
                                                <option>Macbook pro</option>
                                                <option>Orange</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg col-sm-6 col-12">
                                        <div class="form-group">
                                            <select class="select">
                                                <option>Choose Category</option>
                                                <option>Computers</option>
                                                <option>Fruits</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg col-sm-6 col-12">
                                        <div class="form-group">
                                            <select class="select">
                                                <option>Choose Sub Category</option>
                                                <option>Computer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg col-sm-6 col-12">
                                        <div class="form-group">
                                            <select class="select">
                                                <option>Brand</option>
                                                <option>N/D</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg col-sm-6 col-12 ">
                                        <div class="form-group">
                                            <select class="select">
                                                <option>Price</option>
                                                <option>150.00</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-sm-6 col-12">
                                        <div class="form-group">
                                            <a class="btn btn-filters ms-auto"><img src="{{asset('/')}}admin/assets/img/icons/search-whites.svg" alt="img"></a>
                                        </div>
                                    </div>
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
                            <th>Vendor Name</th>
                            <th>Reference</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Grand Total</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $purchas)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                @if($purchas->vendor_type == 'other')
                                    <td>{{$purchas->vendor}}</td>
                                @elseif($purchas->vendor_type == 'cus')
                                    @php
                                        $name=\App\Models\Customer::find($purchas->vendor)
                                     @endphp
                                    <td>{{$name->name}}</td>
                                @elseif($purchas->vendor_type == 'sup')
                                    @php
                                        $name=\App\Models\Supplier::find($purchas->vendor)
                                    @endphp
                                    <td>{{$name->name}}</td>
                                @endif
{{--                                <td>{{$purchas->vendor_type == 'other'? $purchas->vendor:($purchas->vendor_type == 'cus'?$purchas->Customer->vendor:$purchas->Supplier->vendor)}}</td>--}}
                                <td>{{$purchas->ref}}</td>
                                <td>{{$purchas->issue_date}}</td>
                                <td><span class="{{ $purchas->status == 0? 'badges bg-lightred':($purchas->status == 1?'badges bg-lightgreen':'badges bg-lightyellow') }}">{{ $purchas->status == 0? 'Pending':($purchas->status == 1?'Received':'Ordered') }}</span></td>
                                <td>{{$purchas->total}}</td>
                                <td>{{$purchas->total - $purchas->due}}</td>
                                <td>{{$purchas->due}}</td>
                                <td><span class="{{$purchas->invoice->status == 'paid'?'badges bg-lightgreen':($purchas->invoice->status == 'unpaid'?'badges bg-lightred':'badges bg-lightyellow')}}">{{$purchas->invoice->status}}</span></td>
                                <td>

                                    @can('update product')
                                        <a class="me-3" href="{{route('purchas_return',$purchas->id)}}">
                                            <i class="fa fa-share" data-bs-toggle="tooltip" title="Return Product"></i>
                                        </a>
                                    @endcan
                                    @can('update product')
                                        <a class="me-3" href="{{route('purchases.edit',$purchas->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
{{--                                    @can('view product')--}}
{{--                                        <a class="me-3" href="{{route('product.show',$purchas->id)}}">--}}
{{--                                            <img src="{{asset('/')}}admin/assets/img/icons/eye.svg" alt="img">--}}
{{--                                        </a>--}}
{{--                                    @endcan--}}
                                    @can('delete product')
                                        <form action="{{route('purchases.destroy',$purchas->id)}}" method="POST" class="sr-dl" >
                                            @csrf
                                            @method('delete')
                                            <a class="delete_confirm" href="javascript:void(0);">
                                                <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">
                                            </a>
                                        </form>
                                    @endcan
                                </td>
                                {{--                                <td>--}}
                                {{--                                    <a class="me-3" href="product-details.html">--}}
                                {{--                                        <img src="{{asset('/')}}admin/assets/img/icons/eye.svg" alt="img">--}}
                                {{--                                    </a>--}}
                                {{--                                    <a class="me-3" href="editproduct.html">--}}
                                {{--                                        <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
                                {{--                                    </a>--}}
                                {{--                                    @can('delete brand')--}}
                                {{--                                        <form action="{{route('product.destroy',$purchas->id)}}" method="POST" class="sr-dl" >--}}
                                {{--                                            @csrf--}}
                                {{--                                            @method('delete')--}}
                                {{--                                            <a class="delete_confirm" href="javascript:void(0);">--}}
                                {{--                                                <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
                                {{--                                            </a>--}}
                                {{--                                        </form>--}}
                                {{--                                    @endcan--}}
                                {{--                                </td>--}}
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


