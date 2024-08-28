@extends('admin.master')

@section('title',__('Sub Category'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Edit Sub Category')}}</h4>
{{--                <h6>Edit Sub Category</h6>--}}
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('sub_category.update',$sub_cat->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name" value="{{$sub_cat->name}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Category')}}</label>
                                <select class="select" name="category_id" >
                                    <option>Select</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$category->id ==$sub_cat->category_id? 'selected':'' }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
{{--                        <div class="col-lg-4 col-sm-6 col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Creator Name</label>--}}
{{--                                <input readonly type="text" name="created_by" value="{{auth()->user()->name}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">{{__('Status')}}</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_male"
                                           value="1" {{$sub_cat->status == 1 ? 'checked':''}}>
                                    <label class="form-check-label" for="gender_male">{{__('Active')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_female"
                                           value="0" {{$sub_cat->status == 0 ? 'checked':''}}>
                                    <label class="form-check-label" for="gender_female">{{__('Inactive')}}</label>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{__('Description')}}</label>
                                <textarea class="form-control" name="description">{!! $sub_cat->description !!}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{__('Image')}}</label>
                                <div class="image-upload">
                                    <input type="file" name="image">
                                    <div class="image-uploads">
                                        <img src="{{asset('/')}}admin/assets/img/icons/upload.svg" alt="img">
                                        <h4>{{__('Drag and drop a file to upload')}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="product-list">
                                <ul class="row">
                                    <li>
                                        <div class="productviews">
                                            <div class="productviewsimg">
                                                <img src="{{asset($sub_cat->image)}}" alt="img">
                                            </div>
                                            <div class="productviewscontent">
                                                <div class="productviewsname">
                                                    <h2>{{$sub_cat->name}}</h2>
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
                            <button type="submit"  class="btn btn-submit me-2">{{__('Submit')}}</button>
                            <a href="{{route('sub_category.index')}}" class="btn btn-cancel">{{__('Cancel')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
