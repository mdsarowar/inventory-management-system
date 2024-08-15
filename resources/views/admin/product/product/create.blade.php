@extends('admin.master')

@section('title','Product')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Product')}} {{__('Add')}}</h4>
                <h6>{{__('Create New Product')}}</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Bengali')}} {{__('Name')}}</label>
                                <input type="text" name="bname" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{ __('Code') }}</label>
                                <input readonly type="text" name="code" value="{{ 'pro' . \Carbon\Carbon::now()->format('YmdHis') }}" required>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Category')}}</label>
                                <select class="select" name="category_id" id="category_id" required>
                                    <option value=" ">--select--</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Sub Category')}}</label>
                                <select class="select" name="sub_category_id" id="sub_category" >
                                    <option value=" ">--{{__('select')}}--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Child Category')}}</label>
                                <select class="select" name="child_category_id" id="child_category" >
                                    <option value=" " >--{{__('select')}}--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Brand')}}</label>
                                <select class="select" name="brand_id" required>
                                    <option value=" " >--select--</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" >{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Manufacture')}}</label>
                                <select class="select" name="manufacture_id" required>
                                    <option value=" " >--select--</option>
                                    @foreach($manufacturers as $manufacture)
                                        <option value="{{$manufacture->id}}" >{{$manufacture->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Unit')}}</label>
                                <select class="select" name="unit_id" required>
                                    <option value=" " >--select--</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}" >{{$unit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Purchase Scan')}}</label>
                                <select class="select" name="purmode" required>
                                    <option value=" ">--select--</option>
                                    <option value="barcode">Barcode</option>
                                    <option value="serial">Serial</option>
                                    <option value="imei">IMEI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Country')}}</label>
                                <select class="select" name="country" required>
                                    <option value=" ">--select--</option>
                                    <option value="bd">Bangladesh</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Certificate')}}</label>
                                <input type="text" name="certificate" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Minimum Stock')}}</label>
                                <input type="text" name="min_stock" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Model No')}}</label>
                                <input type="text" name="model" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Brand No')}}</label>
                                <input type="text" name="brand_no" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Cost')}}</label>
                                <input type="text" name="cost" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Price')}}</label>
                                <input type="text" name="price" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Warranty Days')}}</label>
                                <input type="text" name="warranty" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Barcode (Optional)')}}</label>
                                <input type="text" name="barcode">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">{{__('Status')}}</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_male"
                                           value="1" checked >
                                    <label class="form-check-label" for="gender_male">{{__('Active')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_female"
                                           value="0">
                                    <label class="form-check-label" for="gender_female">{{__('Inactive')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> {{__('Product Image')}}</label>
                                <div class="image-upload">
                                    <input type="file" name="image">
                                    <div class="image-uploads">
                                       <img src="{{asset('/')}}admin/assets/img/icons/upload.svg" alt="img">
                                        <h4>{{__('Drag and drop a file to upload')}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{__('Description')}}</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit"  class="btn btn-submit me-2">{{__('Submit')}}</button>
                            <a href="{{route('product.index')}}" class="btn btn-cancel">{{__('Cancel')}}</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- /add -->
    </div>

    @include('admin.product.product.category_subcat_child_js')
@endsection

@section('js')

@endsection
