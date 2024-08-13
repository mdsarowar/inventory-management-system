@extends('admin.master')

@section('title','child category')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Add Child Category</h4>
                <h6>Create new product Child Category</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('child_category.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label> Name</label>
                                <input type="text" name="name">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="select" name="cat_id" id="category_id">
                                    <option>Select</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sub Category</label>
                                <select class="select" name="sub_cat_id" id="sub_category">
                                    <option>Select</option>

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
                                <label>Description</label>
                                <textarea class="form-control" name="description"></textarea>
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
                            <a href="{{route('child_category.index')}}" class="btn btn-cancel">Cancel</a>
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
{{--    <script>--}}
{{--        $(document).ready(function (){--}}
{{--            $("#category_id").on('change',function (){--}}
{{--                var id=$("#category_id").val();--}}
{{--                $.ajax({--}}
{{--                    url:base_url+"/get_sub_cat/"+id,--}}
{{--                    type:'get',--}}
{{--                    dataType:'json',--}}
{{--                    success:function (data){--}}
{{--                        option = '';--}}
{{--                        $.each(data.data, function(i,data)--}}
{{--                        {--}}
{{--                            // console.log(i);--}}
{{--                            option +='<option value="'+data.id+'">'+data.name+'</option>';--}}
{{--                        });--}}
{{--                        $("#sub_category").empty().html(option);--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
