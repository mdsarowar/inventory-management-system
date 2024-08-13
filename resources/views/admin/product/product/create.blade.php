@extends('admin.master')

@section('title','Product')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Add</h4>
                <h6>Create new product</h6>
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
                                <label>Product Name</label>
                                <input type="text" name="name">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Created By</label>
                                <input readonly type="text" name="created_by" value="{{auth()->user()->name}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Manufacture</label>
                                <select class="select" name="manufacture_id" >
                                    <option>Choose Manufacture</option>
                                    @foreach($manufacturers as $manufacture)
                                    <option value="{{$manufacture->id}}" >{{$manufacture->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="select" name="category_id" id="category_id" >
                                    <option>Choose Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sub Category</label>
                                <select class="select" name="sub_category_id" id="sub_category" >
                                    <option>Choose Sub Category</option>
{{--                                    @foreach($subCategories as $subcategory)--}}
{{--                                        <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>--}}
{{--                                    @endforeach--}}
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Child Category</label>
                                <select class="select" name="child_category_id" id="child_category" >
                                    <option>Choose Child Category</option>
{{--                                    @foreach($childCategories as $childcategory)--}}
{{--                                        <option value="{{$childcategory->id}}" >{{$childcategory->name}}</option>--}}
{{--                                    @endforeach--}}
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Brand</label>
                                <select class="select" name="brand_id">
                                    <option>Choose Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" >{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Unit</label>
                                <select class="select" name="unit_id">
                                    <option>Choose Unit</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}" >{{$unit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Size</label>
                                <select class="select" name="size_id">
                                    <option>Choose Size</option>
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}" >{{$size->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Color</label>
                                <select class="select" name="color_id">
                                    <option>Choose Color</option>
                                    @foreach($colors as $color)
                                        <option value="{{$color->id}}" >{{$color->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
{{--                        <div class="col-lg-3 col-sm-6 col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>SKU</label>--}}
{{--                                <input type="text" >--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Minimum Qty</label>
                                <input type="text" name="min_quantity">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Tax</label>
                                <input type="text" name="tex">
{{--                                <select class="select" name="tex">--}}
{{--                                    <option>Choose Tax</option>--}}
{{--                                    <option value="1">2%</option>--}}
{{--                                </select>--}}
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount Type</label>
                                <select class="select" name="discount_type">
                                    <option value="percent">Percentage</option>
                                    <option value="fix">fixed</option>
{{--                                    <option>20%</option>--}}
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount</label>
                                <input type="text" name="discount">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_male"
                                           value="1">
                                    <label class="form-check-label" for="gender_male">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_female"
                                           value="0">
                                    <label class="form-check-label" for="gender_female">Inactive</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	Product Image</label>
                                <div class="image-upload">
                                    <input type="file" name="image">
                                    <div class="image-uploads">
                                       <img src="{{asset('/')}}admin/assets/img/icons/upload.svg" alt="img">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit"  class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('product.index')}}" class="btn btn-cancel">Cancel</a>
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
