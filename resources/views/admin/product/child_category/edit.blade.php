@extends('admin.master')

@section('title','child category')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Edit Child Category</h4>
                <h6>Edit a product Child Category</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('child_category.update',$child_cat->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{$child_cat->name}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="select" name="cat_id" id="category">
                                    <option>Select</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$category->id == $child_cat->cat_id? 'selected':'' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sub Category</label>
                                <select class="select" name="sub_cat_id" id="sub_cat" >
                                    <option>Select</option>
                                    @foreach($sub_categories as $subcategory)
                                        <option value="{{$subcategory->id}}" {{$subcategory->id == $child_cat->sub_cat_id? 'selected':'' }}>{{$subcategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Creator Name</label>
                                <input readonly type="text" name="created_by" value="{{auth()->user()->name}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_male"
                                           value="1" {{$child_cat->status == 1 ? 'checked':''}}>
                                    <label class="form-check-label" for="gender_male">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_female"
                                           value="0" {{$child_cat->status == 0 ? 'checked':''}}>
                                    <label class="form-check-label" for="gender_female">Inactive</label>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description">{!! $child_cat->description !!}</textarea>
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
                            <div class="product-list">
                                <ul class="row">
                                    <li>
                                        <div class="productviews">
                                            <div class="productviewsimg">
                                                <img src="{{asset($child_cat->image)}}" alt="img">
                                            </div>
                                            <div class="productviewscontent">
                                                <div class="productviewsname">
                                                    <h2>{{$child_cat->name}}</h2>
                                                    {{--                                                    <h3>581kb</h3>--}}
                                                </div>
                                                <a href="javascript:void(0);" class="hideset">x</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit"  class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('child_category.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
