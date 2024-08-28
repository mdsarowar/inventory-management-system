@extends('admin.master')

@section('title',__('Product'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Edit Product')}}</h4>
                <h6>{{__('Update your Product')}}</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name" value="{{$product->name}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Bengali')}} {{__('Name')}}</label>
                                <input type="text" name="bname" value="{{$product->bname}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{ __('Code') }}</label>
                                <input readonly type="text" name="code" value="{{$product->code}}" >
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Category')}}</label>
                                <select class="select" name="category_id" id="category_id" required>
                                    <option value=" ">--select--</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected':''}} >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Sub Category')}}</label>
                                <select class="select" name="sub_category_id" id="sub_category" >
                                    <option value=" ">--{{__('select')}}--</option>
                                    @foreach($subCategories as $subcategory)
                                        <option value="{{$subcategory->id}}" {{$product->sub_category_id == $subcategory->id ? 'selected':''}}>{{$subcategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Child Category')}}</label>
                                <select class="select" name="child_category_id" id="child_category" >
                                    <option value=" " >--{{__('select')}}--</option>
                                    @foreach($childCategories as $childcategory)
                                        <option value="{{$childcategory->id}}" {{$product->child_category_id == $childcategory->id ? 'selected':''}} >{{$childcategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Brand')}}</label>
                                <select class="select" name="brand_id" required>
                                    <option value=" " >--select--</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" {{$product->brand_id == $brand->id ? 'selected':''}}>{{$brand->name}}</option>
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
                                        <option value="{{$manufacture->id}}" {{$product->manufacture_id == $manufacture->id ? 'selected':''}}>{{$manufacture->name}}</option>
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
                                        <option value="{{$unit->id}}" {{$product->unit_id == $unit->id ? 'selected':''}}>{{$unit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Purchase Scan')}}</label>
                                <select class="select" name="purmode" required>
                                    <option value=" ">--select--</option>
                                    <option value="barcode" {{$product->purmode == 'barcode'?'selected':''}}>Barcode </option>
                                    <option value="serial" {{$product->purmode == 'serial'?'selected':''}}>Serial</option>
                                    <option value="imei" {{$product->purmode == 'imei'?'selected':''}}>IMEI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Country')}}</label>
                                <select class="select" name="country" required>
                                    <option value=" ">--select--</option>
                                    <option value="bd" selected>Bangladesh</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Certificate')}}</label>
                                <input type="text" name="certificate" value="{{$product->certificate}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Minimum Stock')}}</label>
                                <input type="text" name="min_stock" value="{{$product->min_stock}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Model No')}}</label>
                                <input type="text" name="model" value="{{$product->model}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Brand No')}}</label>
                                <input type="text" name="brand_no" value="{{$product->brand_no}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Cost')}}</label>
                                <input type="text" name="cost" value="{{$product->cost}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Price')}}</label>
                                <input type="text" name="price" value="{{$product->price}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Warranty Days')}}</label>
                                <input type="text" name="warranty" value="{{$product->warranty}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Barcode')}} ({{__('Optional')}})</label>
                                <input type="text" name="barcode" value="{{$product->barcode}}" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">{{__('Status')}}</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_male"
                                           value="1" {{$product->status ==1?'checked':''}} >
                                    <label class="form-check-label" for="gender_male">{{__('Active')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_female"
                                           value="0" {{$product->status ==0?'checked':''}}>
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
                            <div class="col-12">
                                <div class="product-list">
                                    <ul class="row">
                                        <li>
                                            <div class="productviews">
                                                <div class="productviewsimg">
                                                    <img src="{{asset($product->image)}}" alt="img">
                                                </div>
                                                <div class="productviewscontent">
                                                    <div class="productviewsname">
                                                        <h2>{{$product->name}}</h2>
{{--                                                        <h3>581kb</h3>--}}
                                                    </div>
                                                    <a href="javascript:void(0);" class="hideset">x</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{__('Description')}}</label>
                                <textarea class="form-control" name="description">{!! $product->description !!}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">{{__('Update')}}</button>
                            <a href="{{route('product.index')}}" class="btn btn-cancel" >{{__('Cancel')}}</a>
                        </div>
                    </div>
                </form>
            </div>
{{--            </div>--}}
        </div>
        <!-- /add -->
    </div>
@endsection
