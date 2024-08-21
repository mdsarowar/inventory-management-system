@extends('admin.master')

@section('title','sub category')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Sub Category list</h4>
                <h6>View/Search product Sub Category</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('sub_category.create')}}" class="btn btn-added">
                    <img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-1" alt="img">Add Sub Category
                </a>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Created By</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sub_categoris as $sub_cat)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{asset($sub_cat->image)}}" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Fruits</a>
                                </td>
                                <td>{{$sub_cat->name}}</td>
                                <td>{{$sub_cat->category->name}}</td>
                                <td>SUB-CA-00{{$sub_cat->sub_cat_code}}</td>
                                <td>{{$sub_cat->description}}</td>
                                <td>{{$sub_cat->created_by}}</td>
                                <td>{{ $sub_cat->status == 1? 'Active':'Inactive' }}</td>
                                <td>
                                    @can('update brand')
                                        <a class="me-3" href="{{route('sub_category.edit',$sub_cat->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete brand')
                                        <form action="{{route('sub_category.destroy',$sub_cat->id)}}" method="POST" class="sr-dl" >
                                            @csrf
                                            @method('delete')
                                            <a class="delete_confirm" href="javascript:void(0);">
                                                <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">
                                            </a>
                                        </form>
                                    @endcan
                                </td>
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


