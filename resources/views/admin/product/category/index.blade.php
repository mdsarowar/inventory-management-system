@extends('admin.master')

@section('title',__('Category'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Product Category list')}}</h4>
                <h6>{{__('View/Search product Category')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('category.create')}}" class="btn btn-added">
                    <img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-1" alt="img">{{__('Add Category')}}
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
                            <th>{{__('Image')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Code')}}</th>
                            <th>{{__('Description')}}</th>
                            <th>{{__('status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td class="productimgname">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="{{asset($category->image)}}" alt="product">
                                    </a>
                                    <a href="javascript:void(0);">Fruits</a>
                                </td>
                                <td>{{$category->name}}</td>
                                <td>CA-00{{$category->category_Code}}</td>
                                <td>{{$category->description}}</td>
                                <td>{{ $category->status == 1? 'Active':'Inactive' }}</td>
                                <td>
                                    @can('update brand')
                                        <a class="me-3" href="{{route('category.edit',$category->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete brand')
                                        <form action="{{route('category.destroy',$category->id)}}" method="POST" class="sr-dl" >
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

