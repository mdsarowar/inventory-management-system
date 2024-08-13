@extends('admin.master')

@section('title','Manufacture')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Edit</h4>
                <h6>Update your product</h6>
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
                                <label>Product Name</label>
                                <input type="text" name="name" value="{{$product->name}}">
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
                                <label>manufacture</label>
                                <select class="select" name="manufacture_id" >
                                    <option>Choose Manufacture</option>
                                    @foreach($manufacturers as $manufacture)
                                        <option value="{{$manufacture->id}}" {{$product->manufacture_id == $manufacture->id ? 'selected':''}}>{{$manufacture->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="select" name="category_id" >
                                    <option>Choose Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected':''}} >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sub Category</label>
                                <select class="select" name="sub_category_id" >
                                    <option>Choose Sub Category</option>
                                    @foreach($subCategories as $subcategory)
                                        <option value="{{$subcategory->id}}" {{$product->sub_category_id == $subcategory->id ? 'selected':''}}>{{$subcategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>child_category</label>
                                <select class="select" name="child_category_id" >
                                    <option>Choose child_category</option>
                                    @foreach($childCategories as $childcategory)
                                        <option value="{{$childcategory->id}}" {{$product->child_category_id == $childcategory->id ? 'selected':''}} >{{$childcategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Brand</label>
                                <select class="select" name="brand_id">
                                    <option>Choose Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" {{$product->brand_id == $brand->id ? 'selected':''}}>{{$brand->name}}</option>
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
                                        <option value="{{$unit->id}}" {{$product->unit_id == $unit->id ? 'selected':''}}>{{$unit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>size</label>
                                <select class="select" name="size_id">
                                    <option>Choose size</option>
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}" {{$product->size_id == $size->id ? 'selected':''}} >{{$size->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>color</label>
                                <select class="select" name="color_id">
                                    <option>Choose color</option>
                                    @foreach($colors as $color)
                                        <option value="{{$color->id}}" {{$product->color_id == $color->id ? 'selected':''}} >{{$color->name}}</option>
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
                                <input type="text" name="min_quantity" value="{{$product->min_quantity}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity" value="{{$product->quantity}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description">{!! $product->description !!}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Tax</label>
                                <input type="text" name="tex" value="{{$product->tex}}">
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
                                    <option value="percent" {{$product->discount_type == 'percent'? 'selected':''}}>Percentage</option>
                                    <option value="fix" {{$product->discount_type == 'fix'? 'selected':''}}>fixed</option>
                                    {{--                                    <option>20%</option>--}}
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>discount</label>
                                <input type="text" name="discount" value="{{$product->discount}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price" value="{{$product->price}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_male"
                                           value="1" {{$product->status ==1?'checked':''}}>
                                    <label class="form-check-label" for="gender_male">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_female"
                                           value="0" {{$product->status ==0?'checked':''}}>
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
                                                    <h3>581kb</h3>
                                                </div>
                                                <a href="javascript:void(0);" class="hideset">x</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Update</button>
                            <a href="{{route('product.index')}}" class="btn btn-cancel" >Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
{{--            </div>--}}
        </div>
        <!-- /add -->
    </div>
@endsection
