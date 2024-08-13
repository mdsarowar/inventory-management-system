@extends('admin.master')

@section('title','Manufacture')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Details</h4>
                <h6>Full details of a product</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('product.index')}}" class="btn btn-added">Back</a>
            </div>
        </div>
        <!-- /add -->
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bar-code-view">
                            <img src="{{asset('/')}}admin/assets/img/barcode1.png" alt="barcode">
                            <a class="printimg">
                                <img src="{{asset('/')}}admin/assets/img/icons/printer.svg" alt="print">
                            </a>
                        </div>
                        <div class="productdetails">
                            <ul class="product-bar">
                                <li>
                                    <h4>Product</h4>
                                    <h6>{{$product->name}}	</h6>
                                </li>
                                <li>
                                    <h4>Category</h4>
                                    <h6>{{$product->category->name}}</h6>
                                </li>
                                <li>
                                    <h4>Sub Category</h4>
                                    <h6>{{$product->subCategory->name}}</h6>
                                </li>
                                <li>
                                    <h4>Brand</h4>
                                    <h6>{{$product->brand->name}}</h6>
                                </li>
                                <li>
                                    <h4>Unit</h4>
                                    <h6>{{$product->unit->name}}</h6>
                                </li>
                                <li>
                                    <h4>SKU</h4>
                                    <h6>PT00{{$product->sku}}</h6>
                                </li>
                                <li>
                                    <h4>Minimum Qty</h4>
                                    <h6>{{$product->min_quantity}}</h6>
                                </li>
                                <li>
                                    <h4>Quantity</h4>
                                    <h6>{{$product->quantity}}</h6>
                                </li>
                                <li>
                                    <h4>Tax</h4>
                                    <h6>{{$product->tex}}</h6>
                                </li>
                                <li>
                                    <h4>Discount Type</h4>
                                    <h6>{{$product->discount_type}}</h6>
                                </li>
                                <li>
                                    <h4>Price</h4>
                                    <h6>{{$product->price}}</h6>
                                </li>
                                <li>
                                    <h4>Status</h4>
                                    <h6>{{$product->status}}</h6>
                                </li>
                                <li>
                                    <h4>Description</h4>
                                    <h6>{!! $product->description !!}</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="slider-product-details">
                            <div class="owl-carousel owl-theme product-slide">
                                <div class="slider-product">
{{--                                    <img src="{{asset('/')}}admin/assets/img/product/product69.jpg" alt="img">--}}
                                    <img src="{{asset($product->image)}}" alt="img">
                                    <h4>macbookpro.jpg</h4>
                                    <h6>581kb</h6>
                                </div>
                                <div class="slider-product">
                                    <img src="{{asset('/')}}admin/assets/img/product/product69.jpg" alt="img">
                                    <h4>macbookpro.jpg</h4>
                                    <h6>581kb</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /add -->
    </div>
@endsection
