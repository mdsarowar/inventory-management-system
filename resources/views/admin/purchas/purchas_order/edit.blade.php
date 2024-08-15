@extends('admin.master')
@section('title',__('Edit Purchase'))
@section('custom_css')
    <style>
        .btn-group-flex-wrap {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .pos-products .product-info {
            padding: 10px;
            color: #b8bcc9;
            -webkit-transition: all 0.5s ease;
            -ms-transition: all 0.5s ease;
            transition: all 0.5s ease;
            border-radius: 10px;
        }
        .pos-products .product-info .img-bg {
            height: 117px;
            background-color: #f3f6f9;
            border-radius: 10px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            align-items: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            justify-content: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            margin-bottom: 10px;
            position: relative;
        }
        .pos-products .product-info .img-bg i {
            position: absolute;
            top: 5px;
            right: 5px;
            color: #28c76f;
            font-size: 18px;
            display: none;
        }
        .pos-products .product-info .img-bg:hover i {
            display: block;
        }
        .custom-product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            padding: 0 13px 13px 13px;
            height: 70vh;
            overflow-y: auto;
            border-bottom: 1px solid #ebebeb;
        }
        .custom-product-img {
            transform: scale(1);
            transition: transform 0.5s ease;
        }
        .custom-product-img:hover {
            transform: scale(1.2);
        }
        .product-info.default-cover.card {
            margin-bottom: 10px;
        }
        .pos-products .product-info h6 {
            font-size: 15px;
            font-weight: 700;
        }
        .pos-products .product-info h6.cat-name a {
            color: #b8bcc9;
        }
        .pos-categories h5,
        .pos-categories h6,
        .order-list h5,
        .order-list h6 {
            color: #092c4c;
        }
        .pos-products .product-info h6.product-name {
            color: #092c4c;
        }
        .pos-products .product-info .price {
            margin-top: 10px;
        }
        .pos-products .product-info .price span {
            color: #888888;
        }
        .pos-products .product-info .price p {
            color: #ff9f43;
        }
        .btn-outline-primary {
            color: #6e6e6e;
        }
        input {
            border-color: #dbe0e6 !important;
        }
        aside {
            height: 100%;
            padding: 15px 23px 23px 23px;
            background-color: #ffffff;
            border-left: 1px solid #f3f6f9;
        }
        aside.product-order-list .head {
            background-color: #fafbfe;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 13px;
        }
        aside.product-order-list h6 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #1b2850;
        }
        aside.product-order-list .customer-info .input-block {
            margin-bottom: 10px;
        }
        p.placeholder-glow span.placeholder {
            min-height: 21px;
            border-radius: 10px;
            cursor: progress;
        }
        img.customer_img_circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        aside.product-order-list .product-added h6 .count {
            width: 15px;
            height: 15px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            align-items: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            justify-content: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            background: #ff9f43;
            border-radius: 100%;
            color: #ffffff;
            font-size: 10px;
            font-weight: 600;
            margin: 0 0 0 7px;
        }
        .product-wrap {
            height: fit-content;
            max-height: 30vh;
            overflow: auto;
        }
        .product-wrap .qty-item {
            position: relative;
            margin-right: 7px;
        }
        .product-wrap .qty-item input {
            padding: 1px 9px;
            background: #fafbfe;
            border-radius: 8px;
            height: 33px;
            width: 110px;
            text-align: center;
            font-size: 13px;
        }
        .product-wrap .qty-item .dec {
            left: 9px;
        }
        .product-wrap .qty-item .dec,
        .product-wrap .qty-item .inc {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            color: #092c4c;
            -webkit-transition: all 0.5s ease;
            -ms-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }
        .product-wrap .qty-item .inc {
            right: 9px;
        }
        .product-wrap input.product_cost_field {
            width: 110px;
            padding: 3px 5px;
            border: 1px solid #efefef;
            border-radius: 5px;
        }
        aside.product-order-list .order-total {
            background-color: #f3f6f9;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px dotted #b1b1b1;
        }
        aside.product-order-list .order-total ul li {
            color: #5b6670;
            font-size: 15px;
            font-weight: 500;
            background: transparent;
            border: none;
        }
        aside.product-order-list .btn-row .btn {
            margin-right: 5px;
            border-radius: 4px;
            font-size: 14px;
        }
        div.popover {
            max-width: fit-content;
        }
        h3.popover-header {
            text-align: center;
        }
        div.popover-body {
            padding: 0.5rem;
        }
        div.color_plate_btn {
            width: 20px;
            height: 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 5px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        div.color_plate_btn.color_green {
            background-color: green;
            border: green;
        }
        div.color_plate_btn.color_red {
            background-color: red;
            border-color: red;
        }
        div.color_plate_btn.color_blue {
            background-color: blue;
            border-color: blue;
        }
        div.color_plate_btn.color_yellow {
            background-color: yellow;
            border-color: yellow;
        }
        div.color_plate_btn.color_orange {
            background-color: orange;
            border-color: orange;
        }
        div.color_plate_btn.color_purple {
            background-color: purple;
            border-color: purple;
        }
        div.color_plate_btn.color_cyan {
            background-color: cyan;
            border-color: cyan;
        }
        div.color_plate_btn.color_magenta {
            background-color: magenta;
            border-color: magenta;
        }
        div.color_plate_btn.color_black {
            background-color: black;
            border-color: black;
        }
        div.color_plate_btn.color_white {
            background-color: white;
            border: 1px solid #d7d7d7;
        }
        div.save_progress i {
            color: #ff9f43;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        #alphabet-filter button {
            border-left: none;
            border-radius: 0;
        }
        #alphabet-filter button.all_btn {
            border-left: 1px solid #ff9f43;
        }
        #alphabet-filter button.active_alphabet {
            color: #ffffff;
            background-color: #ff9f43;
        }

        .grand_total_container {
            background-color: lightblue;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: fit-content;
            padding: 13px;
            border: 1px dotted #b3b3b3;
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .grand_total_container span {
            color: #5c5c5c;
            font-size: 20px;
            font-weight: 800;
            white-space: nowrap;
            margin-right: 15px;
        }
        .grand_total_container input {
            width: fit-content;
        }

        .cursor_pointer {
            cursor: pointer;
        }
        .cursor_not_allowed {
            cursor: not-allowed;
        }

        /* area collapse/expand */
        .area_product_browser,
        .area_product_calculation {
            transition: width 0.5s ease;
        }

        /* serial offcanvas */
        @keyframes spin {
            0% { transform: rotate(0deg) scale(1); }
            100% { transform: rotate(360deg) scale(1.1); }
        }
        .input-group-text.auto_generate_serial_btn:hover i {
            animation: spin 1s linear infinite;
        }
    </style>
@endsection
@section('content')
    @php
        $ssn_walkin = session()->get('purchase_walkin', []);
        $ssn_additional = session()->get('purchase_additional', []);
        $ssn_products = array_reverse(session()->get('purchase_products', []));
        $ssn_product_ids = array_column($ssn_products, 'id');
    @endphp
    <div class="content pt-0">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Purchase')}}</h4>
                <h6>{{__('Create New Purchase')}}</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="row">
            <div class="col-md-6 area_product_browser">
                <div class="pos-products">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="search_field" placeholder="{{__('Search by product')}}...">
                    </div>
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <div class="btn-group-flex-wrap" role="group" id="alphabet-filter">
                            <button type="button" class="btn btn-outline-primary btn-sm all_btn active_alphabet" data-letter="All">
                                {{__('All')}}</button>
                            @foreach(range('A', 'Z') as $char)
                                <button type="button" class="btn btn-outline-primary btn-sm" data-letter="{{ $char }}">{{ $char }}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="tabs_container">
                        <div id="product-container" class="custom-product-grid">
                            @foreach($products as $product)
                                @php
                                    $inSession = in_array($product->id, $ssn_product_ids);
                                @endphp
                                <div class="custom-product-item {{ $inSession ? 'cursor_not_allowed' : 'cursor_pointer' }}" data-id="{{ $product->id }}" data-name="{{ $product->name }}">
                                    <div class="product-info default-cover card">
                                        <div class="img-bg">
                                            <img src="{{ asset($product->image) }}" class="custom-product-img">
                                            <i class="fas fa-check-circle product_check_mark {{ $inSession ? 'd-block' : '' }}"></i>
                                        </div>
                                        <h6 class="product-name">{{ $product->name }}</h6>
                                        <div class="d-flex align-items-center justify-content-between price">
                                            {{--                                            <span>{{ $product->quantity }} Qty</span>--}}
                                            <p>৳{{ $product->price }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 area_product_calculation">
                <aside class="product-order-list">
                    <form action="{{route('purchases.update',$purchas->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="customer-info block-section mb-2">
                            {{--                            <h6>Walk-in Information</h6>--}}

                            <div>
                                <div class="d-flex flex-row align-items-center mb-3">
                                    <a href="javascript:void(0)" class="area_toggler_btn me-3"><i class="fas fa-chevron-circle-left fa-2x"></i></a>
                                    <button type="button" class="btn btn-primary btn-icon me-2" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fas fa-luggage-cart"></i> {{__('Walk-in')}}
                                    </button>
                                    @php
                                        if (empty($purchas->wkname)){
                                           $sup=explode('-',$purchas->vendor);
                                           if ($sup[0] == 'sup'){
                                               $supplier=\App\Models\Supplier::find($sup[1])->first();
                                           }else{
                                               $supplier=\App\Models\Customer::find($sup[1])->first();
                                           }
                                       }else{
                                           $supplier='';
                                       }
                                    @endphp
                                    <select class="form-control nested" name="vendor" >
                                        <option selected="selected" value="">--Select--</option>
                                        @if($supplier != null)
                                        <optgroup label="Supplier">
                                            @foreach($suppliers as $supplier)
                                                <option value="sup-{{$supplier->id}}" {{(isset($sup) && $sup[0]=='sup' && $sup[1]==$supplier->id)?'selected':''}}>sup-{{$supplier->name}}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Customer">
                                            @foreach($customers as $customer)
                                                <option value="cus-{{$customer->id}}" {{(isset($sup) && $sup[0]=='cus' && $sup[1]==$customer->id)?'selected':''}}>cus-{{$customer->name}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif
                                    </select>


                                    {{--                                    <select class="form-select" name="vendor" id="select_vendor" >--}}
                                    {{--                                        <option>Select</option>--}}
                                    {{--                                        --}}{{--                                                    @foreach($companies as $company)--}}
                                    {{--                                        <option value="">select</option>--}}
                                    {{--                                        --}}{{--                                                    @endforeach--}}
                                    {{--                                    </select>--}}
                                </div>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <div class="selling-info">
                                            <div class="row mt-2">
                                                <div class="col-md-6 mb-2">
                                                    <label>{{__('Name')}}</label>
                                                    <input type="text" class="form-control form-control-sm" name="wkname" id="" value="{{isset($purchas->wkname)?$purchas->wkname:''}}">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label>{{__('Phone')}}</label>
                                                    <input type="text" class="form-control form-control-sm" name="wkphone" id="" value="{{isset($purchas->wkphone)?$purchas->wkphone:''}}">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label>{{__('Email')}}</label>
                                                    <input type="text" class="form-control form-control-sm" name="wkemail" id="" value="{{isset($purchas->wkemail)?$purchas->wkemail:''}}">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label>{{__('Address')}}</label>
                                                    <input type="text" class="form-control form-control-sm" name="wkaddress" id="" value="{{isset($purchas->wkaddress)?$purchas->wkaddress:''}}">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="districtSelect" class="form-label">{{ __('District') }}</label>
                                                    <select class="form-select form-select-sm select2" id="districtSelect" name="wkdistrict" >
                                                        <option value="" disabled selected>Select District</option>
                                                    </select>
                                                </div>
                                                {{--                                                <div class="col-md-6 mb-2">--}}
                                                {{--                                                    <label for="zoneSelect" class="form-label">{{ __('Zone') }}</label>--}}
                                                {{--                                                    <select class="form-select form-select-sm" id="zoneSelect">--}}
                                                {{--                                                        <option value="" disabled selected>Select Zone</option>--}}
                                                {{--                                                    </select>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                            {{--                                            <div class="row">--}}
                                            {{--                                                <div class="col-sm-7 col-12">--}}
                                            {{--                                                    <div class="input-block">--}}
                                            {{--                                                        <label>Select Vendor--}}
                                            {{--                                                            <div class="save_progress d-none">--}}
                                            {{--                                                                <i class="fas fa-spinner"></i>--}}
                                            {{--                                                            </div>--}}
                                            {{--                                                        </label>--}}
                                            {{--                                                        <div class="col-md-10">--}}
                                            {{--                                                            <div class="radio" id="vendor_type">--}}
                                            {{--                                                                <label>--}}
                                            {{--                                                                    <input type="radio" value="cus" name="vendor_type"> Customer--}}
                                            {{--                                                                </label>--}}
                                            {{--                                                                <label class="mx-3">--}}
                                            {{--                                                                    <input type="radio" value="sup" name="vendor_type"> Supplier--}}
                                            {{--                                                                </label>--}}
                                            {{--                                                                <label>--}}
                                            {{--                                                                    <input type="radio" value="other" name="vendor_type"> Walk-in customer--}}
                                            {{--                                                                </label>--}}
                                            {{--                                                            </div>--}}
                                            {{--                                                        </div>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <div class="col-sm-5 col-12 mb-2">--}}
                                            {{--                                                    <div class="input-block">--}}
                                            {{--                                                        <div class="form-group" id="vendor_select_field">--}}
                                            {{--                                                            <label>{{__('vendor')}}</label>--}}
                                            {{--                                                            <select class="form-select" name="vendor" id="select_vendor" >--}}
                                            {{--                                                                <option>Select</option>--}}
                                            {{--                                                                --}}{{--                                                    @foreach($companies as $company)--}}
                                            {{--                                                                <option value="">select</option>--}}
                                            {{--                                                                --}}{{--                                                    @endforeach--}}
                                            {{--                                                            </select>--}}
                                            {{--                                                        </div>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6  mb-2 me-4">
                                {{--                                <div class="col-sm-5 col-12 mb-2">--}}
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <select class="form-select" name="" id="product_search" >
                                        <option value="">Product search</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-4 ml-4 mb-2">
                                {{--                                <label>Barcode--}}
                                {{--                                    <div class="save_progress d-none">--}}
                                {{--                                        <i class="fas fa-spinner"></i>--}}
                                {{--                                    </div>--}}
                                {{--                                </label>--}}
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-white"><i class="fas fa-barcode"></i></span>
                                    <input type="text" class="form-control" id="barcode_field" value="{{ $ssn_additional['barcode'] ?? '' }}" placeholder="Barcode">
                                </div>
                            </div>

                        </div>
                        <div class="product-added block-section mb-2">
                            <div class="head-text d-flex align-items-center justify-content-between mb-3">
                                <h6 class="d-flex align-items-center mb-0">Product Added<span class="count" id="product_len_counter">{{ count($ssn_products) }}</span></h6>
                                <a href="javascript:void(0);" class="d-flex align-items-center text-danger" id="clear_all_btn">
                             <span class="me-1">
                                <i class="fas fa-times"></i>
                             </span>
                                    Clear all
                                </a>
                            </div>
                            <div class="product-wrap" >
                                <table class="table table-border text-center" >
                                    <thead>
                                    <tr>
                                        <th><i class="fas fa-boxes"></i></th>
                                        <th>Serial/EMEI</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>SubTotal</th>
                                        <th><i class="fas fa-trash-alt"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody id="product_list_tbody">
                                    @if(count($ssn_products) > 0)
                                        @foreach($ssn_products as $key=> $product)
                                            <tr>
                                                <td class="py-1">
                                                    <a href="javascript:void(0);" class="product_offcanvas_btn cursor_pointer" role="button" data-bs-toggle="offcanvas" data-bs-target="#product_offcanvas" data-id="{{ $product['id'] }}">{{ $product['name'] }}</a>
                                                    <a href="javascript:void(0);" class="product_offcanvas_btn cursor_pointer ml-3 text-warning" role="button" data-bs-toggle="offcanvas" data-bs-target="#product_offcanvas" data-id="{{ $product['id'] }}">Edit</a>
                                                </td>
                                                <td class="py-1">
                                                    {{--                                                    <div class="d-flex">--}}
                                                    {{--                                                        <input type="radio" name="serial{{ $product['id'] }}" class="me-1 serial-radio" id="serial_auto{{ $product['id'] }}" value="{{ $product['id'] }}" data-serial-method="auto" {{ $product['serial_method'] === 'auto' ? 'checked' : '' }}>--}}
                                                    {{--                                                        <label for="serial_auto{{ $product['id'] }}" class="cursor_pointer"><small>Auto</small></label>--}}
                                                    {{--                                                    </div>--}}
                                                    <div class="d-flex">
                                                        @if(!empty($product['serial_method']))
                                                            <input type="radio" name="serial{{ $product['id'] }}" class="me-1 serial-radio manual-radio" id="serial_manual{{ $product['id'] }}" value="{{ $product['id'] }}" data-serial-method="manual" {{ $product['serial_method'] === 'manual' ? 'checked' : '' }}>
                                                            <label for="serial_manual{{ $product['id'] }}" class="cursor_pointer" data-bs-toggle="offcanvas" data-bs-target="#product_serial_offcanvas" role="button"><small>Serial</small></label>
                                                        @endif

                                                    </div>
                                                </td>
                                                <td class="py-1">
                                                    <div class="d-flex justify-content-center">
                                                        <div class="qty-item text-center">
                                                            <a class="dec d-flex justify-content-center align-items-center" data-id="{{ $product['id'] }}"><i class="far fa-minus-square"></i></a>
                                                            <input type="text" class="form-control text-center qty-input" id="product_qty" data-id="{{ $product['id'] }}" name="qty" value="{{ $product['quantity'] }}" >
                                                            <a class="inc d-flex justify-content-center align-items-center" data-id="{{ $product['id'] }}"><i class="far fa-plus-square"></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-1">
                                                    <input type="tel" class="product_cost_field" value="{{ $product['price'] }}" data-id="{{ $product['id'] }}">
                                                    <div class="save_progress d-none">
                                                        <i class="fas fa-spinner"></i>
                                                    </div>
                                                </td>
                                                <td class="py-1">{{ $product['price'] * $product['quantity'] }}</td>
                                                <td class="py-1">
                                                    <a href="javascript:void(0);" class="btn-icon dlt_pd_ssn" data-id="{{ $product['id'] }}">
                                                        <i class="fas fa-times-circle text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">there are no products selected</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @php
                            $ssn_additional=session()->get('purchase_additional');
                            $bank_pay=session()->get('bank_info');
                        @endphp
                        <div class="block-section">
                            <div class="order-total">
                                <div class="row">
                                    {{--                                    <div class="col-6 d-flex align-items-center mb-2">SubTotal--}}
                                    {{--                                        <div class="save_progress d-none ms-1">--}}
                                    {{--                                            <i class="fas fa-spinner"></i>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <div class="col-6 mb-2">
                                        <label>SubTotal</label>
                                        <input type="tel" class="form-control form-control-sm text-center" name="all_subtotal" id="sub_total_field" value="{{ isset($ssn_additional) ? $ssn_additional['subtotal'] : 0 }}">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label>Discount</label>
                                        <input type="tel" class="form-control form-control-sm text-center" name="all_discount" id="discount_field" value="{{ isset($ssn_additional) ? $ssn_additional['discount'] : 0 }}">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label>Vat</label>
                                        <input type="tel" class="form-control form-control-sm text-center" name="all_vat" id="vat_field" value="{{ isset($ssn_additional) ? $ssn_additional['vat'] : 0 }}">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label>Tax</label>
                                        <input type="tel" class="form-control form-control-sm text-center" name="all_tax" id="tax_field" value="{{ isset($ssn_additional) ? $ssn_additional['tax'] : 0 }}">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label>Speed Money</label>
                                        <input type="tel" class="form-control form-control-sm text-center" name="all_speedmoney" id="speed_money_field" value="{{ isset($ssn_additional) && isset($ssn_additional['speed_money']) ? $ssn_additional['speed_money'] : 0 }}">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label>Freight</label>
                                        <input type="tel" class="form-control form-control-sm text-center" name="all_freight" id="freight_field" value="{{ isset($ssn_additional) && isset($ssn_additional['freight']) ? $ssn_additional['freight'] : 0 }}">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label>Fractional Discount</label>
                                        <input type="tel" class="form-control form-control-sm text-center" name="fractional_dis" id="fractional_discount_field" value="{{ isset($ssn_additional) && isset($ssn_additional['fractional_discount']) ? $ssn_additional['fractional_discount'] : 0 }}">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label>Payment Method</label>
                                        <select class="form-select form-select-sm" name="payment_type" id="payment_type">
                                            <option selected disabled>-- select one --</option>
                                            <option value="cash">Cash</option>
                                            <option value="bank" {{isset($bank_pay)? 'selected':''}}>Online</option>
                                        </select>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label>Payment Amount</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="payment_amount" id="payment_amount" value="{{ isset($bank_pay) ? $bank_pay['payment_amount'] : 0 }}">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label>Due Amount</label>
                                        <input type="text" class="form-control form-control-sm text-center" name="due_amount" id="due_amount" value="{{(isset($ssn_additional) ? $ssn_additional['grand_total'] : 0) - (isset($bank_pay) ? $bank_pay['payment_amount'] : 0) }}" readonly>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label>Issue Date</label>
                                        <input type="date" class="form-control form-control-sm text-center" name="issue_date" id="" value="{{$purchas->issue_date}}">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label>Due Date</label>
                                        <input type="date" class="form-control form-control-sm text-center" name="due_date" id="" value="{{$purchas->due_date}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-4">
                                <div class="grand_total_container">
                                    <span>Grand Total</span>
                                    <input type="tel" class="form-control text-center" name="fractional_dis" id="grand_total" value="{{ isset($ssn_additional) ? $ssn_additional['grand_total'] : 0 }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="input-block">
                                    <label>{{__('Reference')}}
                                        <div class="save_progress d-none">
                                            <i class="fas fa-spinner"></i>
                                        </div>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-white"><i class="fas fa-retweet"></i></span>
                                        <input type="text" class="form-control form-control-sm" name="ref" id="reference_field" value="{{ $purchas->ref }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="input-block">
                                    <label>{{__('Note')}}
                                        <div class="save_progress d-none">
                                            <i class="fas fa-spinner"></i>
                                        </div>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-white"><i class="fas fa-pen-alt"></i></span>
                                        <input type="text" class="form-control form-control-sm" name="note" id="note_field" value="{{$purchas->note}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="btn-row d-flex align-items-center justify-content-between mt-2">
                            <button type="button" class="btn btn-danger btn-lg flex-fill" id="destroy_all_ssn_btn"><i class="fas fa-trash-alt"></i>
                                {{__('Empty')}}</button>
                            {{--                            <button type="button" class="btn btn-success btn-lg flex-fill" data-bs-toggle="offcanvas" data-bs-target="#payment_offcanvas"><i class="fas fa-credit"></i> Payment</button>--}}
                            <button type="submit" class="btn btn-success btn-lg flex-fill"><i class="fas fa-credit-card"></i>
                                {{__('Checkout')}}</button>
                        </div>
                    </form>
                </aside>
            </div>
        </div>
        <!-- /add -->
    </div>

    {{--    <!-- payment bank offcanvas -->--}}
    <div class="offcanvas offcanvas-end w-50 h-auto" data-bs-scroll="true" tabindex="-1" id="payment_offcanvas" >
        <div class="offcanvas-header border-bottom pb-2">
            <h5 class="offcanvas-title"><i class="fas fa-search"></i> {{__('Bank Details')}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body bg-light">
            <form action="" id="payment_form">
                <div class="col-6 d-flex align-items-center">{{__('Bank Type')}}
                    <div class="save_progress d-none ms-1">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <select class="form-select" name="bank_type" id="bank_type">
                        <option selected disabled>-- select one --</option>
                        <option value="bank">Bank</option>
                        <option value="mobile">Mobile_bank</option>
                        <option value="cheque">Cheque</option>
                    </select>
                </div>
                <div class="col-6 d-flex align-items-center">vendor
                    <div class="save_progress d-none ms-1">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <select class="form-select" name="bank" id="bank">
                        <option selected disabled>-- select one --</option>
                    </select>
                </div>
                <div class="col-6 d-flex align-items-center">{{__('Name')}}
                    <div class="save_progress d-none ms-1">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <input type="text" class="form-control text-center" name="bank_name" id="bank_name" value="" readonly>
                </div>
                <div class="col-6 d-flex align-items-center">{{__('Amount')}}
                    <div class="save_progress d-none ms-1">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <input type="text" class="form-control text-center" name="bank_amount" id="bank_amount" value="" readonly>
                </div>
                <div class="col-6 d-flex align-items-center">{{__('Payment Amount')}}
                    <div class="save_progress d-none ms-1">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
                <div class="col-6 mb-2">
                    {{--                    <input type="text" class="form-control text-center" name="" id="payment_amount" value="" >--}}
                    <input type="text" class="form-control text-center" name="bank_payment" id="bank_payment" value="">

                </div>
                <div class="text-dark mb-3">
                    <strong>Grand Total: </strong><span id="grand_total_preview"></span>
                </div>

                <input type="submit" id="pay" class="form-control btn btn-outline-primary" value="pay">
            </form>

        </div>

    </div>

    <!-- product editor offcanvas -->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="product_offcanvas">
        <div class="offcanvas-header border-bottom pb-2">
            <h5 class="offcanvas-title"><i class="fas fa-edit"></i> {{__('Edit Product')}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body bg-light">
            <div class="row">
                <div class="col-6 mb-3">
                    <label>{{__('Discount Type')}}</label>
                    <select class="form-select" name="discount_type">
                        <option selected disabled>-- select one --</option>
                        <option value="percent">Percentage</option>
                        <option value="fixed">Fixed</option>
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <label>{{__('Discount Upto')}}</label>
                    <input type="number" class="form-control" name="discount">
                </div>

                <div class="col-6 mb-3">
                    <label>{{__('Vat Type')}}</label>
                    <select class="form-select" name="vat_type">
                        <option selected disabled>-- select one --</option>
                        <option value="percent">Percentage</option>
                        <option value="fixed">Fixed</option>
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <label>{{__('Vat')}}</label>
                    <input type="number" class="form-control" name="vat">
                </div>
                <div class="col-6 mb-3">
                    <label>{{__('Tax Type')}}</label>
                    <select class="form-select" name="tax_type">
                        <option selected disabled>-- select one --</option>
                        <option value="percent">Percentage</option>
                        <option value="fixed">Fixed</option>
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <label>{{__('Tax')}}</label>
                    <input type="number" class="form-control" name="tax">
                </div>
                <div class="col-sm-6 mb-2">
                    <label>{{__('Color')}}</label>
                    <select class="form-select" id="color_selector">
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <div class='d-flex'>
                        <div class='color_plate_btn color_green'></div>
                        <div class='color_plate_btn color_red'></div>
                        <div class='color_plate_btn color_blue'></div>
                        <div class='color_plate_btn color_yellow'></div>
                        <div class='color_plate_btn color_orange'></div>
                        <div class='color_plate_btn color_purple'></div>
                        <div class='color_plate_btn color_cyan'></div>
                        <div class='color_plate_btn color_magenta'></div>
                        <div class='color_plate_btn color_black'></div>
                        <div class='color_plate_btn color_white'></div>
                    </div>
                </div>
                <div class="col-sm-6 mb-3">
                    <label>{{__('Size')}}</label>
                    <select class="form-select" id="size_selector">
                    </select>
                </div>
                <div class="col-sm-6 mb-4">
                    <label>{{__('Warranty Days')}}</label>
                    <input type="tel" class="form-control" name="warranty_days">
                </div>
                <input type="hidden" name="id" id="product_edit_id">
                <div class="col-12 text-center">
                    <button class="btn btn-primary">{{__('Update')}}</button>
                </div>
            </div>
        </div>
    </div>


    <!-- product serial modal -->
    <div class="offcanvas offcanvas-end w-75" data-bs-scroll="true" tabindex="-1" id="product_serial_offcanvas">
        <div class="offcanvas-header d-flex justify-content-between">
            <h5 class="offcanvas-title"></h5>
            <div>
                <button type="button" class="btn btn-success btn-sm save_serial_values">{{__('Save')}}</button>
                <button type="button" class="btn btn-primary btn-sm auto_generate_serial_all_btn">{{__('Auto-Generate')}}</button>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
        </div>
        <div class="offcanvas-body pt-0">
        </div>
    </div>

    <!-- payment modal -->
    <div class="modal fade modal-default" role="dialog" id="payment_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body bg-light pb-0">
                    <div class="col-6 d-flex align-items-center">{{__('Payment Method')}}
                        <div class="save_progress d-none ms-1">
                            <i class="fas fa-spinner"></i>
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <select class="form-select" name="payment_type">
                            <option selected disabled>-- select one --</option>
                            <option value="cash">Cash</option>
                            <option value="bank">Bank</option>
                        </select>
                    </div>
                    <div class="col-6 d-flex align-items-center">{{__('Payment Amount')}}
                        <div class="save_progress d-none ms-1">
                            <i class="fas fa-spinner"></i>
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <input type="text" class="form-control text-center" name="" id="payment_amount" value="">
                    </div>
                    <div class="col-6 d-flex align-items-center">{{__('Due Amount')}}
                        <div class="save_progress d-none ms-1">
                            <i class="fas fa-spinner"></i>
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <input type="text" class="form-control text-center" name="due_amount" id="fractional_discount_field" value="">
                    </div>
                    <div class="col-6 d-flex align-items-center">{{__('Due Date')}}
                        <div class="save_progress d-none ms-1">
                            <i class="fas fa-spinner"></i>
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <input type="date" class="form-control text-center" name="" id="fractional_discount_field" value="">
                    </div>
                </div>
                <div class="modal-footer border d-flex justify-content-between p-1">
                    <button type="button" class="btn btn-secondary py-2" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="button" class="btn btn-primary py-2">{{__('Save Changes')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        // area collapse/expand
        $(document).ready(function() {
            let toggled = false;

            $('.area_toggler_btn').click(function() {
                if (!toggled) {
                    // Slide out and hide the browser area, expand the calculation area
                    $('.area_product_browser').animate({ width: '0' }, 800, function() {
                        $(this).hide();
                    });
                    $('.area_product_calculation').animate({ width: '100%' }, 800);
                    $('.col-md-6').removeClass('col-md-6').addClass('col-md-12');
                    // Change button icon to chevron right
                    $(this).find('i').removeClass('fa-chevron-circle-left').addClass('fa-chevron-circle-right');
                } else {
                    // Show and slide back the browser area, reset the calculation area
                    $('.area_product_browser').show().animate({ width: '50%' }, 800);
                    $('.area_product_calculation').animate({ width: '50%' }, 800);
                    $('.col-md-12').removeClass('col-md-12').addClass('col-md-6');
                    // Change button icon to chevron left
                    $(this).find('i').removeClass('fa-chevron-circle-right').addClass('fa-chevron-circle-left');
                }

                toggled = !toggled;
            });
        });
    </script>
    <script>
        // walk-in district & zone selector
        const districtZoneData = {
            'Dhaka': ['Gulshan', 'Dhanmondi', 'Mirpur', 'Uttara', 'Mohammadpur', 'Khilgaon', 'Badda', 'Rampura', 'Jatrabari'].sort(),
            'Chattogram': ['Panchlaish', 'Halishahar', 'Chandgaon', 'Bayezid', 'Double Mooring', 'Lalkhan Bazar', 'Kaptai'].sort(),
            'Rajshahi': ['Rajshahi City', 'Bagmara', 'Puthia', 'Durgapur', 'Mohanpur', 'Tanore', 'Chapainawabganj'].sort(),
            'Khulna': ['Khulna City', 'Rupsha', 'Dacope', 'Batiaghata', 'Koyra', 'Paikgachha', 'Satkhira'].sort(),
            'Sylhet': ['Sylhet City', 'Jaintiapur', 'Companiganj', 'Gowainghat', 'Beanibazar', 'Osmaninagar'].sort(),
            'Barisal': ['Barisal City', 'Wazirpur', 'Muladi', 'Bakerganj', 'Hizla', 'Banaripara', 'Ujirpur'].sort(),
            'Rangpur': ['Rangpur City', 'Pirgachha', 'Mithapukur', 'Kawnia', 'Badarganj', 'Ranishwar', 'Dinajpur'].sort(),
            'Mymensingh': ['Mymensingh City', 'Gaffargaon', 'Trishal', 'Ishwarganj', 'Haluaghat', 'Nandail'].sort(),
            'Jashore': ['Jashore City', 'Benapole', 'Jhikargachha', 'Chandragati', 'Keshabpur', 'Abhaynagar', 'Monirampur'].sort(),
            'Brahmanbaria': ['Brahmanbaria City', 'Nabinagar', 'Kasba', 'Bijoynagar', 'Bancharampur', 'Sarail'].sort(),
            'Lakshmipur': ['Lakshmipur City', 'Ramganj', 'Ramgati', 'Lakshmipur Sadar', 'Raipur', 'Rameswar'].sort(),
            'Narail': ['Narail City', 'Narail Sadar', 'Kalia', 'Lohagara', 'Dorihata', 'Balia'].sort(),
            'Patuakhali': ['Patuakhali City', 'Galachipa', 'Bauphal', 'Mirzaganj', 'Patuakhali Sadar', 'Dumki', 'Kalapara'].sort(),
            'Jamalpur': ['Jamalpur City', 'Jamalpur Sadar', 'Melandah', 'Islampur', 'Dewanganj', 'Bhaluka'].sort(),
            'Gazipur': ['Gazipur City', 'Sreepur', 'Kaliakair', 'Kaliakoir', 'Kapasia', 'Tongi', 'Bhaluka'].sort(),
            'Savar': ['Savar City', 'Hemayetpur', 'Uttara', 'Ashulia', 'Dhamsona', 'Sreepur', 'Nawabganj'].sort(),
            'Tangail': ['Tangail City', 'Mirzapur', 'Basail', 'Nagarpur', 'Gopalpur', 'Kalihati', 'Delduar'].sort(),
            'Moulvibazar': ['Moulvibazar City', 'Kulaura', 'Juri', 'Barlekha', 'Rashidpur', 'Srimangal'].sort(),
            'Pabna': ['Pabna City', 'Pabna Sadar', 'Ishwardi', 'Bera', 'Chatmohar', 'Faridpur', 'Santhia'].sort(),
            'Noakhali': ['Noakhali City', 'Begumganj', 'Chowmuhani', 'Hatiya', 'Senbagh', 'Companiganj', 'Subarnachar'].sort(),
            'Kurigram': ['Kurigram City', 'Rajarhat', 'Bhurungamari', 'Nageshwari', 'Ulipur', 'Chilmari'].sort()
        };

        // Populate districts
        const districtSelect = document.getElementById('districtSelect');
        Object.keys(districtZoneData).forEach(district => {
            const option = document.createElement('option');
            option.value = district;
            option.textContent = district;
            districtSelect.appendChild(option);
        });

        // Event listener for district selection
        districtSelect.addEventListener('change', function () {
            const selectedDistrict = this.value;
            const zoneSelect = document.getElementById('zoneSelect');

            // Clear previous zones
            zoneSelect.innerHTML = '<option value="" disabled selected>Select Zone</option>';

            // Populate zones based on selected district
            if (selectedDistrict && districtZoneData[selectedDistrict]) {
                districtZoneData[selectedDistrict].forEach(zone => {
                    const option = document.createElement('option');
                    option.value = zone;
                    option.textContent = zone;
                    zoneSelect.appendChild(option);
                });
            }
        });
    </script>
    <script>
        // serial table collapse/expand
        $('#collapsibleTable .clickable-header').click(function() {
            let $tbody = $('#collapsibleTable .collapse-body');
            let $actualHeaders = $('#collapsibleTable #actual-headers');
            let $placeholderRow = $('#collapsibleTable #placeholder-row');
            if ($tbody.is(':visible')) {
                $tbody.animate({ height: '0px', opacity: 0 }, 300, function() {
                    $tbody.hide();
                    $actualHeaders.hide();
                    $placeholderRow.show();
                });
            } else {
                $placeholderRow.hide();
                $actualHeaders.show();
                $tbody.show().css({'height': 'auto', 'opacity': 0});
                let fullHeight = $tbody.height();
                $tbody.css('height', '0px').animate({ height: fullHeight, opacity: 1 }, 300);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#bank_type').select2();
            $('#product_search').select2();
            $('.select2').select2();
        });
    </script>
    <!-- Select2 JS -->
    {{--    <script src="{{asset('/')}}assets/plugins/select2/js/select2.min.js"></script>--}}
    {{--    <script src="{{asset('/')}}assets/plugins/select2/js/custom-select.js"></script>--}}
    <script>

        $(document).ready(function(){
            // console.log('sarowar');
            $(document).on('input','#payment_amount',function (){
                let $total=$('#grand_total').val();
                let $amount= $(this).val();
                let $due= $total - $amount;
                $('#due_amount').val($due);
                // console.log($total);
            })

            $(document).on('change', '#payment_type',function(){
                var optionSelected = this.value;
                if(optionSelected != 'cash'){
                    // Show the offcanvas
                    var offcanvas = new bootstrap.Offcanvas(document.getElementById('payment_offcanvas'));
                    offcanvas.show();
                    $('#grand_total_preview').text('৳'+$('#grand_total').val());
                    // $('#offcanvas').toggleClass('is-open');
                    // $('#payment_offcanvas').show();
                    console.log(optionSelected);
                }
            });

            $(document).on('change','#bank_type',function(){
                var bankvalue = this.value;
                $.ajax({
                    url:base_url+'/bank_type/'+bankvalue,
                    type:'get',
                    dataType:'json',
                    success: function(success) {
                        // console.log(success.data);

                        var options = ' <option selected disabled>-- select one --</option>'; // Initialize options variable

                        if(bankvalue == 'bank')
                        {
                            $.each(success.data, function(index, bank) {
                                // Set the value attribute to vendor.id or another unique identifier
                                options += `<option value="${bank.id}">${bank.branch_name}</option>`;
                            });
                        }
                        else if(bankvalue == 'mobile')
                        {
                            $.each(success.data, function(index, bank) {
                                // Set the value attribute to vendor.id or another unique identifier
                                options += `<option value="${bank.id}">${bank.mfs_provider}</option>`;
                            });
                        }
                        else if(bankvalue == 'cheque')
                        {
                            $.each(success.data, function(index, bank) {
                                // Set the value attribute to vendor.id or another unique identifier
                                options += `<option value="${bank.id}">${bank.cheque_bank}</option>`;
                            });
                        }

                        $('#bank').html(options); // Update the select element with new options
                        // Reinitialize Select2 after updating options
                        $('#bank').select2();
                    },
                })
            });

            $(document).on('change', '#bank', function() {
                var bankId = this.value;
                var bankType = $('#bank_type').val();
                // console.log(bankType);
                // Perform POST request
                $.ajax({
                    url: '{{route('get_bank_details')}}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: bankId,
                        bank_type: bankType
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(bankType == 'bank')
                        {
                            $('#bank_name').val(response.data.branch_name)
                            $('#bank_amount').val(response.data.balance)
                        }
                        else if(bankType == 'mobile')
                        {
                            $('#bank_name').val(response.data.mfs_provider)
                            $('#bank_amount').val(response.data.balance)
                        }
                        else if(bankType == 'cheque')
                        {
                            // $.each(success.data, function(index, bank) {
                            //     // Set the value attribute to vendor.id or another unique identifier
                            //     options += `<option value="${bank.id}">${bank.cheque_bank}</option>`;
                            // });
                        }

                        // console.log('Post request successful:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Post request failed:', status, error);
                    }
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // $(document).ready(function() {
            // Handle form submission
            $('#payment_form').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                var amount = $('#bank_payment').val();

                // Gather form data
                var formData = {
                    bank_type: $('#bank_type').val(),
                    bank_id: $('#bank').val(),
                    bank_name: $('#bank_name').val(),
                    bank_amount: $('#bank_amount').val(),
                    payment_amount: amount,
                };

                // Initialize Offcanvas instance
                var offcanvasElement = document.getElementById('payment_offcanvas');
                var offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement); // Check if Offcanvas is already initialized
                if (!offcanvas) {
                    offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                }

                // Display a spinner or some kind of loading indication
                $('.save_progress').removeClass('d-none');

                // Perform the AJAX request
                $.ajax({
                    url: '{{route('submit_bank_amount')}}',
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    success: function(response) {
                        // Handle successful response
                        // console.log('Attempting to hide Offcanvas');
                        offcanvas.hide(); // Hide the Offcanvas
                        // console.log('Offcanvas hide method called');
                        // console.log('Form submission successful:', response);

                        // Optionally, you can reset the form or display a success message
                        $('form')[0].reset(); // Reset the form fields
                        $('.save_progress').addClass('d-none'); // Hide the spinner
                        $('#payment_amount').val(amount);

                        let $total=$('#grand_total').val();
                        // let $amount= $(this).val();
                        let $due= $total - amount;
                        $('#due_amount').val($due);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error('Form submission failed:', status, error);
                        $('.save_progress').addClass('d-none'); // Hide the spinner
                    }
                });
            });
            // });
        });
    </script>
    <script>
        if ($('body').hasClass('mini-sidebar')) {
            $('body').removeClass('mini-sidebar');
            $(this).addClass('active');
            $('.subdrop + ul');
            localStorage.setItem('screenModeNightTokenState', 'night');
            setTimeout(function() {
                $("body").removeClass("mini-sidebar");
                $(".header-left").addClass("active");
            }, 100);
        } else {
            $('body').addClass('mini-sidebar');
            $(this).removeClass('active');
            $('.subdrop + ul');
            localStorage.removeItem('screenModeNightTokenState', 'night');
            setTimeout(function() {
                $("body").addClass("mini-sidebar");
                $(".header-left").removeClass("active");
            }, 100);
        }
    </script>
    <script>
        $(document).ready(function() {

            function filterProducts(query) {
                $('#product-container').html('<div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div>');
// alert(query);
                $.ajax({
                    url: "{{ route('pur_filter_products') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        query: query
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            $('#product-container').html(response.html);
                        } else {
                            console.error('Failed to load products.');
                        }
                    }
                });
            };

            // Search Field Event
            $('#search_field').on('keyup', function() {
                filterProducts($(this).val());
            });

            // Alphabet Filter Event
            $('#alphabet-filter button').on('click', function() {
                $('#alphabet-filter button').removeClass('active_alphabet');
                $(this).addClass('active_alphabet');
                filterProducts($(this).data('letter'));
            });

            $(document).on('change','#product_search',function(){
                var $search=this.value;
                $.ajax({
                    url: "{{ route('get_product_data') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: $search
                    },
                    success: function(response) {
                        displayProducts(response.products);
                        serialTableGenerator(response.products);
                        updateCheckMark(response.products);
                        calculateAndUpdateSummary();
                    }
                });
            });

            // add product into session purchase_products[]
            $(document).on('click', '.custom-product-item', function() {
                let productId = $(this).data('id');

                $.ajax({
                    url: "{{ route('get_product_data') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId
                    },
                    success: function(response) {
                        displayProducts(response.products);
                        serialTableGenerator(response.products);
                        updateCheckMark(response.products);
                        calculateAndUpdateSummary();
                    }
                });
            });

            // delete product from session purchase_products[]
            $(document).on('click', '.dlt_pd_ssn', function(event) {
                event.stopPropagation(); // prevent the click event from bubbling up to the .custom-product-item handler

                let productId = $(this).data('id');

                $.ajax({
                    url: "{{ route('delete_product_data') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId
                    },
                    success: function(response) {
                        displayProducts(response.products);
                        serialTableGenerator(response.products);
                        updateCheckMark(response.products);
                        calculateAndUpdateSummary();
                    }
                });
            });

            // will call this function after any CRUD on purchase_products[] session, to refresh table data
            function displayProducts(products) {
                let productRows = '';

                if (products.length === 0) {
                    $('#product_list_tbody').html(`<tr><td colspan="6" class="text-center">there are no products selected</td></tr>`);
                } else {
                    $.each(products, function(index, product) {
                        productRows += `
                    <tr>
                        <td class="py-1">
<a href="javascript:void(0);" class="product_offcanvas_btn cursor_pointer" role="button" data-bs-toggle="offcanvas" data-bs-target="#product_offcanvas" data-id='${product.id}'>${product.name}</a>
<a href="javascript:void(0);" class="product_offcanvas_btn cursor_pointer ml-3 text-warning" role="button" data-bs-toggle="offcanvas" data-bs-target="#product_offcanvas" data-id='${product.id}'>Edit</a>
</td>
                        <td class="py-1">
                            <div class="d-flex">
                                ${product.serial_method ? `
                                    <input type="radio" name="serial${product.id}" class="me-1 serial-radio manual-radio" id="serial_manual${product.id}" value="${product.id}" data-serial-method="manual" ${product.serial_method === 'manual' ? 'checked' : ''}>
                                    <label for="serial_manual${product.id}" class="cursor_pointer" data-bs-toggle="offcanvas" data-bs-target="#product_serial_offcanvas" role="button"><small>Serial</small></label>
                                    ` : ''}
                            </div>
                        </td>
                        <td class="py-1">
                            <div class="d-flex justify-content-center">
                                <div class="qty-item text-center">
                                    <a class="dec d-flex justify-content-center align-items-center" data-id="${product.id}"><i class="far fa-minus-square"></i></a>
                                    <input type="text" class="form-control text-center qty-input" id="product_qty" data-id="${product.id}" name="qty" value="${product.quantity}" >
                                    <a class="inc d-flex justify-content-center align-items-center" data-id="${product.id}"><i class="far fa-plus-square"></i></a>
                                </div>
                            </div>
                        </td>
                        <td class="py-1">
                            <input type="tel" class="product_cost_field" value="${product.price}" data-id="${product.id}">
                        </td>
                        <td class="py-1">${product.price * product.quantity}</td>
                        <td class="py-1">
                            <a href="javascript:void(0);" class="btn-icon dlt_pd_ssn" data-id="${product.id}">
                                <i class="fas fa-times-circle text-danger"></i>
                            </a>
                        </td>
                    </tr>
                `;
                    });
                    // Replace the table body content with the new product rows
                    $('#product_list_tbody').html(productRows);
                }
                // product length counter
                $('#product_len_counter').text(products.length);
            }

            // serial/imei table generator
            function serialTableGenerator(products) {
                let productRows = '';
                let globalIndex = 1;

                if (products.length === 0) {
                    $('.serial_container_tbody').html(`<tr><td colspan="4" class="text-center">There are no serial/IMEI found</td></tr>`);
                } else {
                    $.each(products, function(index, product) {
                        // create rows based on product quantity
                        for (let i = 0; i < product.quantity; i++) {
                            productRows += `<tr>
                                                <td>${globalIndex}</td>
                                                <td>${product.name}</td>
                                                <td><input type="text" class="form-control form-control-sm"></td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0)" class="del_serial_item" data-id="${product.id}" data-qty="${product.quantity}"><i class="fas fa-times text-danger"></i></a>
                                                </td>
                                            </tr>`;
                            globalIndex++;
                        }
                    });
                    $('.serial_container_tbody').html(productRows);
                }
            }

            // serial/imei field remover
            $(document).on('click', '.del_serial_field_item', function() {
                let productId = $(this).data('id');
                let quantity = parseInt($(this).data('qty'));
                updateQuantity(productId, --quantity);
                // Find the parent container of the clicked delete icon
                let serialField = $(this).closest('.d-flex').closest('.col-md-3.col-sm-4.col-12.mb-3');
                // Remove the serial field from the UI
                serialField.remove();
            });
            // serial/imei table tr remover
            $(document).on('click', '.del_serial_item', function() {
                let currentQty = parseInt($(this).data('qty'));
                let productId = $(this).data('id');
                if (currentQty > 0) {
                    currentQty--;
                    updateQuantity(productId, currentQty);
                    $('.collapse-body').click();
                }
            });

            // update check icons based on product presence in session
            function updateCheckMark(products) {
                // Get all product IDs from the session response
                let productIdsInSession = products.map(product => product.id);

                // Iterate through each product item
                $('.custom-product-item').each(function() {
                    let productId = $(this).data('id');

                    // Check if the product ID is in the session products
                    if (productIdsInSession.includes(productId)) {
                        $(this).removeClass('cursor_pointer').addClass('cursor_not_allowed');
                        $(this).find('.product_check_mark').addClass('d-block');
                    } else {
                        $(this).removeClass('cursor_not_allowed').addClass('cursor_pointer');
                        $(this).find('.product_check_mark').removeClass('d-block');
                    }
                });
            }

            // update total summary
            async function calculateAndUpdateSummary() {
                try {
                    const response = await $.ajax({
                        url: "{{ route('pur_calculate_summary') }}",
                        method: 'POST',
                        data: { _token: '{{ csrf_token() }}' }
                    });

                    if (!response.data) {
                        throw new Error('Invalid response data');
                    }

                    // Update the DOM elements
                    $('#reference_field').val(response.data.reference);
                    $('#note_field').val(response.data.note);
                    $('#sub_total_field').val(response.data.subtotal);
                    $('#discount_field').val(response.data.discount);
                    $('#vat_field').val(response.data.vat);
                    $('#tax_field').val(response.data.tax);
                    $('#speed_money_field').val(response.data.speed_money);
                    $('#freight_field').val(response.data.freight);
                    $('#fractional_discount_field').val(response.data.fractional_discount);
                    $('#grand_total').val(response.data.grand_total);
                    // console.log(response.data.subtotal);
                } catch (error) {
                    // console.error('Error:', error.message);
                }
            }

            // additional session data handler
            $(document).on('input', '#reference_field, #note_field, #sub_total_field, #discount_field, #vat_field, #tax_field, #speed_money_field, #freight_field, #fractional_discount_field', function() {
                $(this).closest('div').find('.save_progress').removeClass('d-none').addClass('d-inline');
                $(this).closest('.col-6').prev('.col-6').find('.save_progress').removeClass('d-none').addClass('d-inline');
                $.ajax({
                    url: "{{ route('pur_update_summary') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        reference: $('#reference_field').val(),
                        note: $('#note_field').val(),
                        subtotal: $('#sub_total_field').val(),
                        discount: $('#discount_field').val(),
                        vat: $('#vat_field').val(),
                        tax: $('#tax_field').val(),
                        speed_money: $('#speed_money_field').val(),
                        freight: $('#freight_field').val(),
                        fractional_discount: $('#fractional_discount_field').val(),
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#reference_field').val(response.data.reference);
                            $('#note_field').text(response.data.note);
                            $('#speed_money_field').val(response.data.speed_money);
                            $('#freight_field').val(response.data.freight);
                            $('#fractional_discount_field').val(response.data.fractional_discount);
                            $('#grand_total').val(response.data.grand_total);
                            $('.save_progress').removeClass('d-inline').addClass('d-none');
                        } else {
                            console.error('Invalid response data');
                        }
                    }
                });
            });

            // update product serial method
            $(document).on('click', 'input[type=radio].serial-radio', function() {
                let productId = $(this).val();
                let serialMethod = $(this).data('serial-method');
                $.ajax({
                    url: "{{ route('pur_update_serial_method') }}",
                    method: 'POST',
                    data: {
                        product_id: productId,
                        serial_method: serialMethod,
                        _token: '{{ csrf_token() }}'
                    }
                });
            });

            function populateOffcanvas(product) {
                let quantity = product.quantity;
                let serials = product.serial || [];
                let offcanvasBody = $('#product_serial_offcanvas').find('.offcanvas-body');
                offcanvasBody.empty();
                let row = $('<div class="row"></div>');
                for (let i = 1; i <= quantity; i++) {
                    let serialNumber = serials[i - 1] || '';
                    let inputGroup = `
                        <div class="col-md-3 col-sm-4 col-12 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="input-group me-2">
                                    <input type="text" class="form-control form-control-sm w-75" placeholder="serial number ${i}" value="${serialNumber}">
                                    <span class="input-group-text text-dark cursor_pointer auto_generate_serial_btn"><i class="fas fa-cog"></i></span>
                                </div>
                                <i class="fas fa-times text-danger cursor_pointer del_serial_field_item" data-id="${product.id}" data-qty="${quantity}"></i>
                            </div>
                        </div>
                    `;
                    row.append(inputGroup);
                }
                offcanvasBody.append(row);
            }

            // product serial handler
            $(document).on('click', 'input[type=radio].manual-radio', function() {
                let productId = $(this).val();

                $.ajax({
                    url: "{{ route('pur_fetch_product_data') }}",
                    method: 'POST',
                    data: {
                        id: productId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        let product = response.product;
                        // Update the offcanvas header with the product name
                        $('#product_serial_offcanvas').find('.offcanvas-header h5').text(product.name);
                        $('#product_serial_offcanvas').find('button.save_serial_values').attr('data-id', product.id);
                        // Populate offcanvas with serial fields
                        populateOffcanvas(product);

                        // Initialize and show the offcanvas
                        var offcanvasElement = document.getElementById('product_serial_offcanvas');
                        var myOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasElement);
                        myOffcanvas.show();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            });


            // Function to generate a serial number with leading zeros
            function generateSerialNumber(number) {
                return ('0000000000' + number).slice(-10);
            }
            // Function to get the highest existing serial number from input fields
            function getMaxSerialNumber(fields) {
                let maxNumber = 0;
                fields.each(function() {
                    let value = $(this).val();
                    let number = parseInt(value.replace(/^0+/, ''), 10);
                    if (!isNaN(number) && number > maxNumber) {
                        maxNumber = number;
                    }
                });
                return maxNumber;
            }

            // auto generate serial values for all available fields
            $(document).on('click', '.auto_generate_serial_all_btn', function() {
                $('#product_serial_offcanvas').find('.form-control').each(function(index) {
                    // Generate serial number based on the index (1-based index for the display)
                    let serialNumber = generateSerialNumber(index + 1);
                    // Set the generated serial number into the input field
                    $(this).val(serialNumber);
                });
            });

            // Event handler for individual auto-generate button
            $(document).on('click', '.auto_generate_serial_btn', function() {
                // Find the input field associated with the clicked button
                let inputField = $(this).siblings('input');
                // Generate the next serial number for this input field
                let currentMaxSerialNumber = getMaxSerialNumber($('#product_serial_offcanvas').find('.form-control'));
                let serialNumber = generateSerialNumber(currentMaxSerialNumber + 1);
                inputField.val(serialNumber);
            });



            // update quantity on click + - buttons
            // handle click on minus button
            $(document).on('click', '.dec', function() {
                let $input = $(this).siblings('.qty-input');
                let currentQty = parseInt($input.val(), 10);
                let productId = $(this).data('id');
                if (currentQty > 1) {
                    currentQty--;
                    updateQuantity(productId, currentQty);
                    $input.val(currentQty).focus();
                }
            });

            $(document).on('input', '.qty-input', function () {
                let product_qty = $(this).val();
                let productId = $(this).data('id');
                let currentQty = parseInt(product_qty, 10);
                updateQuantity(productId, currentQty);
            });

            // handle click on plus button
            $(document).on('click', '.inc', function() {
                let $input = $(this).siblings('.qty-input');
                let currentQty = parseInt($input.val(), 10);
                let productId = $(this).data('id');
                currentQty++;
                updateQuantity(productId, currentQty);
                $input.val(currentQty).focus();
            });
            // handle click on plus button
            // $(document).on('click', '.inc', function() {
            //     // let $input = $(this).siblings('.qty-input');
            //     let $input = #product_qty.val();
            //     let currentQty = parseInt($input.val(), 10);
            //     let productId = $(this).data('id');
            //     currentQty++;
            //     updateQuantity(productId, currentQty);
            //     $input.val(currentQty);
            // });

            function updateQuantity(productId, quantity) {
                $.ajax({
                    url: "{{ route('update_quantity') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        displayProducts(response.products);
                        serialTableGenerator(response.products);
                        calculateAndUpdateSummary();
                        populateOffcanvas(response.products.find(p => p.id === productId));
                    }
                });
            }


            $(document).on('input', '.product_cost_field', function() {
                $(this).closest('td').find('.save_progress').removeClass('d-none').addClass('d-inline');
                let productId = $(this).data('id');
                let newPrice = $(this).val();

                // Validate the new price (optional, depending on your requirements)
                if (isNaN(newPrice) || newPrice.trim() === '') {
                    console.error("Invalid price entered.");
                    return;
                }

                // Perform AJAX request to update the product price
                $.ajax({
                    url: "{{ route('pur_update_product_price') }}",
                    method: 'POST',
                    data: {
                        product_id: productId,
                        price: newPrice,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('.save_progress').removeClass('d-inline').addClass('d-none');
                        displayProducts(response.products);
                        calculateAndUpdateSummary();
                    }
                });
            });

            // product edit offcanvas
            $(document).on('click', '.product_offcanvas_btn', function() {
                let productId = $(this).data('id');

                // Perform AJAX request to fetch the product data
                $.ajax({
                    url: "{{ route('pur_fetch_product_data') }}",
                    method: 'POST',
                    data: {
                        id: productId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // console.log("Fetched Product Data:", response);

                        if (response.status) {
                            let productData = response.product;

                            let colors = @json($colors);
                            let sizes = @json($sizes);

                            // Populate the color selector with options
                            let colorOptions = '<option value="">Select Color</option>';
                            $.each(colors, function(index, color) {
                                colorOptions += `<option value="${color.name}" ${color.name === productData.color ? 'selected' : ''}>${color.name}</option>`;
                            });
                            $('#color_selector').html(colorOptions);

                            // Handle color plate button click
                            $('.color_plate_btn').off('click').on('click', function() {
                                let classes = $(this).attr('class').split(' ');
                                let colorClass = classes.find(cls => cls.startsWith('color_') && cls !== 'color_plate_btn').replace('color_', '');

                                let colorData = colors.find(color => color.name.toLowerCase() === colorClass.toLowerCase());
                                let colorName = colorData ? colorData.name : colorClass.charAt(0).toUpperCase() + colorClass.slice(1);

                                let $colorSelector = $('#color_selector');
                                let existingOption = $colorSelector.find(`option[value="${colorName}"]`);

                                if (existingOption.length === 0) {
                                    $colorSelector.append(`<option value="${colorName}" selected>${colorName}</option>`);
                                } else {
                                    $colorSelector.val(existingOption.val());
                                }
                            });

                            // Populate the size selector with options
                            let sizeOptions = '<option value="">Select Size</option>';
                            $.each(sizes, function(index, size) {
                                sizeOptions += `<option value="${size.name}" ${size.name === productData.size ? 'selected' : ''}>${size.name}</option>`;
                            });
                            $('#size_selector').html(sizeOptions);

                            // Set other form values
                            $('#product_offcanvas select[name="discount_type"]').val(productData.discount_type);
                            $('#product_offcanvas input[name="discount"]').val(productData.discount);
                            $('#product_offcanvas select[name="vat_type"]').val(productData.vat_type);
                            $('#product_offcanvas input[name="vat"]').val(productData.vat);
                            $('#product_offcanvas select[name="tax_type"]').val(productData.tax_type);
                            $('#product_offcanvas input[name="tax"]').val(productData.tax);
                            $('#product_offcanvas input[name="warranty_days"]').val(productData.warranty_days);
                            $('#product_edit_id').val(productData.id);
                        } else {
                            console.error("Failed to fetch product data");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                    }
                });
            });

            // handle click event on the product update button
            $('#product_offcanvas .btn-primary').on('click', function() {
                // Capture the product ID from the hidden input field
                let productId = $('#product_edit_id').val();

                // Capture other form data
                let discountType = $('#product_offcanvas select[name="discount_type"]').val();
                let discount = $('#product_offcanvas input[name="discount"]').val();
                let vatType = $('#product_offcanvas select[name="vat_type"]').val();
                let vat = $('#product_offcanvas input[name="vat"]').val();
                let taxType = $('#product_offcanvas select[name="tax_type"]').val();
                let tax = $('#product_offcanvas input[name="tax"]').val();
                let color = $('#color_selector').val();
                let size = $('#size_selector').val();
                let warrantyDays = $('#product_offcanvas input[name="warranty_days"]').val();

                // Perform AJAX request to update the session
                $.ajax({
                    url: "{{ route('pur_update_pdata') }}",
                    method: 'POST',
                    data: {
                        product_id: productId,
                        discount_type: discountType,
                        discount: discount,
                        vat_type: vatType,
                        vat: vat,
                        tax_type: taxType,
                        tax: tax,
                        color: color,
                        size: size,
                        warranty_days: warrantyDays,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            // Hide the offcanvas
                            let offcanvasInstance = bootstrap.Offcanvas.getInstance($('#product_offcanvas'));
                            if (offcanvasInstance) {
                                offcanvasInstance.hide();
                            }
                            calculateAndUpdateSummary();
                        }
                    }
                });
            });

            // get customer/supplier list
            // event listener for input changes
            $('#walkin_search_field').on('input', function() {
                const asset_path = "{{ asset('') }}";
                let query = $(this).val().trim();
                let walk_in_type = $('input[name="walk_in"]:checked').val();
                if (query.length > 1) {
                    $.ajax({
                        url: "{{ route('walkin_search_api') }}",
                        method: 'POST',
                        data: { query: query, walk_in: walk_in_type, _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            $('#walkin_list').empty();
                            if (response.walkin.length > 0) {
                                $.each(response.walkin, function(index, walkin) {
                                    $('#walkin_list').append(`
                                <li class="list-group-item d-flex align-items-center cursor_pointer" data-id="${walkin.id}" data-name="${walkin.name}" data-balance="${walkin.balance}" data-type="${walkin.type}">
                                    <img src="${walkin.image ? asset_path+walkin.image : asset_path+'admin/assets/img/customer/customer1.jpg'}" class="img-fluid customer_img_circle">
                                    <h6 class="mb-0">${walkin.name}</h6>
                                </li>
                            `);
                                });
                            } else {
                                $('#walkin_list').append(`
                            <li class="list-group-item text-center">no customers found</li>
                        `);
                            }
                        }
                    });
                } else {
                    $('#walkin_list').html(`<li class="list-item"><img src="{{ asset('admin/assets/img/search_placeholder.webp') }}"></li>`);
                }
            });

            // on change walk-in type, make search field empty
            $('input[name="walk_in"]').on('change', function() {
                $('#walkin_search_field').val('').focus();
                $('#walkin_list').empty();
            });

            // on click any list item from customer/supplier search result, it will store that customer/supplier id into the session
            $(document).on('click', '#walkin_list .list-group-item', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let balance = $(this).data('balance');
                let type = $(this).data('type');
                $.ajax({
                    url: "{{ route('store_walkin_into_session') }}",
                    method: 'POST',
                    data: {
                        id: id,
                        name: name,
                        balance: balance,
                        type: type,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#walkin_details_container").addClass("d-flex flex-column justify-content-center").html(`
                    <h6 class="mb-0">${name}</h6>
                    <div>৳${balance}</div>
                `);

                        // Hide the offcanvas
                        let offcanvas = bootstrap.Offcanvas.getInstance($('#payment_offcanvas'));
                        if (offcanvas) {
                            offcanvas.hide();
                        }
                    }
                });
            });

            $('#clear_all_btn').on('click', function() {
                $.ajax({
                    url: "{{ route('product_clear_all') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('.product_check_mark').removeClass('d-block');
                        $('.custom-product-item').removeClass('cursor_not_allowed').addClass('cursor_pointer');
                        $('#product_len_counter').text(0);
                        $('#product_list_tbody').html(`<tr><td colspan="5" class="text-center">there are no products selected</td></tr>`);
                        $('.serial_container_tbody').html(`<tr><td colspan="4" class="text-center">There are no serial/IMEI found</td></tr>`);
                        calculateAndUpdateSummary();
                        animateCollapseBody();
                    }
                });
            });

            $('#destroy_all_ssn_btn').on('click', function() {
                $.ajax({
                    url: "{{ route('pur_destroy_all_ssn') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('.product_check_mark').removeClass('d-block');
                        $('.custom-product-item').removeClass('cursor_not_allowed').addClass('cursor_pointer');
                        $('#product_len_counter').text(0);
                        $('#product_list_tbody').html(`<tr><td colspan="5" class="text-center">there are no products selected</td></tr>`);
                        $('.serial_container_tbody').html(`<tr><td colspan="4" class="text-center">There are no serial/IMEI found</td></tr>`);
                        $("#walkin_details_container").addClass("d-flex flex-column justify-content-center").html(`<p class="placeholder-glow d-inline"><span class="placeholder w-50"></span></p>`);
                        calculateAndUpdateSummary();
                        animateCollapseBody();
                    }
                });
            });

            $(document).on('click', '.save_serial_values', function() {
                let productId = $(this).data('id');
                let serialNumbers = [];

                // Iterate over input fields in the offcanvas body
                $('#product_serial_offcanvas').find('.offcanvas-body input').each(function() {
                    serialNumbers.push($(this).val());
                });

                $.ajax({
                    url: "{{ route('pur_store_product_serials') }}",
                    method: 'POST',
                    data: {
                        id: productId,
                        serials: serialNumbers,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        // Hide the offcanvas after successful AJAX call
                        var offcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('product_serial_offcanvas'));
                        offcanvas.hide();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            });


        });
    </script>
    <script>
        $(document).ready(function(){
            $('#vendor_select_field').hide();
            $('#vendor_input_field').hide();

            $("input[type='radio']").click(function(){
                var radioValue = $("input[name='vendor_type']:checked").val();
                console.log('sarowar');
                if(radioValue != 'other'){
                    $('#vendor_input_field').hide();
                    $('#vendor_select_field').show();
                    $.ajax({
                        url:base_url+'/get_vendor/'+radioValue,
                        type:'get',
                        dataType:'json',
                        success: function(success) {
                            // console.log(success.data);

                            var options = ''; // Initialize options variable

                            $.each(success.data, function(index, vendor) {
                                // Set the value attribute to vendor.id or another unique identifier
                                options += `<option value="${vendor.id}">${vendor.name}</option>`;
                            });

                            $('#select_vendor').html(options); // Update the select element with new options

                            $('#select_vendor').select2();
                        },
                    })
                }else {
                    $('#vendor_select_field').hide();
                    $('#vendor_input_field').show();
                }
                // alert(radioValue)
                // if(radioValue){
                //     alert("Your are a - " + radioValue);
                // }
            });
        });
    </script>


@endsection
