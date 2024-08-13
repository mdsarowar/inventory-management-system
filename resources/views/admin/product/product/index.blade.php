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
                            <th>Product image</th>
                            <th>Product Name</th>
                            <th>SKU</th>
                            <th>price</th>
                            <th>quantity</th>
                            <th>min_quantity</th>
                            <th>tex</th>
                            <th>discount_type</th>
                            <th>discount</th>
                            <th>description</th>
                            <th>brand</th>
                            <th>category</th>
                            <th>sub_category </th>
                            <th>child_category</th>
                            <th>size</th>
                            <th>color</th>
                            <th>unit</th>
                            <th>manufacture</th>
                            <th>Qty</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{asset($product->image)}}" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Macbook pro</a>
                                </td>
                                <td>{{$product->name}}</td>
                                <td>PT00{{$product->sku}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->min_quantity}}</td>
                                <td>{{$product->tex}}</td>
                                <td>{{$product->discount_type}}</td>
                                <td>{{$product->discount}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->brand->name}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->subCategory->name}}</td>
                                <td>{{$product->childCategory->name}}</td>
                                <td>{{$product->size->name}}</td>
                                <td>{{$product->color->name}}</td>
                                <td>{{$product->unit->name}}</td>
                                <td>{{$product->manufacture->name}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->created_by}}</td>
                                <td>
                                    @can('update product')
                                        <a class="me-3" href="{{route('product.edit',$product->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('view product')
                                            <a class="me-3" href="{{route('product.show',$product->id)}}">
                                                <img src="{{asset('/')}}admin/assets/img/icons/eye.svg" alt="img">
                                            </a>
                                    @endcan
                                    @can('delete product')
                                        <form action="{{route('product.destroy',$product->id)}}" method="POST" class="sr-dl" >
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
{{--                                        <form action="{{route('product.destroy',$product->id)}}" method="POST" class="sr-dl" >--}}
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


