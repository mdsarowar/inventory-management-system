@extends('admin.master')

@section('title',__('Product'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Product')}} {{__('List')}}</h4>
                <h6>{{__('Manage your products')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('product.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg" alt="img" class="me-1">{{__('Add')}}</a>
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
                            <th>{{__('Image')}}/{{__('Name')}}</th>
{{--                            <th></th>--}}
                            <th>{{__('Code')}}</th>
                            <th>{{__('Price')}}</th>
{{--                            <th>{{__('Quantity')}}</th>--}}

{{--                            <th>min_quantity</th>--}}
{{--                            <th>tex</th>--}}

{{--                            <th>{{__('Discount Type')}}</th>--}}
{{--                            <th>{{__('Discount')}}</th>--}}
{{--                            <th>description</th>--}}
                            <th>{{__('Brand')}}</th>
                            <th>{{__('Category')}}</th>
{{--                            <th>{{__('Sub Category')}}</th>--}}
{{--                            <th>child_category</th>--}}
{{--                            <th>{{__('Size')}}</th>--}}
{{--                            <th>{{__('Color')}}</th>--}}
{{--                            <th>unit</th>--}}
                            <th>{{__('Manufacture')}}</th>
{{--                            <th>Qty</th>--}}
{{--                            <th>Created By</th>--}}
                            <th>{{__('Action')}}</th>
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
                                    <a href="javascript:void(0);">{{$product->name}}</a>
                                </td>
{{--                                <td>{{$product->name}}</td>--}}
                                <td>{{$product->code}}</td>
                                <td>{{$product->price}}</td>
{{--                                <td>{{$product->quantity}}</td>--}}
{{--                                <td>{{$product->min_quantity}}</td>--}}
{{--                                <td>{{$product->tex}}</td>--}}
{{--                                <td>{{$product->discount_type}}</td>--}}
{{--                                <td>{{$product->discount}}</td>--}}
{{--                                <td>{{$product->description}}</td>--}}
                                <td>{{$product->brand->name}}</td>
                                <td>{{$product->category->name}}</td>
{{--                                <td>{{$product->subCategory->name}}</td>--}}
{{--                                <td>{{$product->childCategory->name}}</td>--}}
{{--                                <td>{{$product->size->name}}</td>--}}
{{--                                <td>{{$product->color->name}}</td>--}}
{{--                                <td>{{$product->unit->name}}</td>--}}
                                <td>{{$product->manufacture->name}}</td>
{{--                                <td>{{$product->quantity}}</td>--}}
{{--                                <td>{{$product->created_by}}</td>--}}
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


