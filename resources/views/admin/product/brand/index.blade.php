@extends('admin.master')

@section('title',__('Brand'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Brand List')}}</h4>
                <h6>{{__('Manage your Brand')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('brand.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">{{__('Add Brand')}}</a>
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
                            <th>{{__('Description')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>
                                    <a class="product-img">
                                        <img src="{{$brand->image}}" alt="product">
                                    </a>
                                </td>
                                <td>{{$brand->name}}</td>
                                <td>{!! $brand->description !!}</td>
                                <td>{{ $brand->status == 1? 'Active':'Inactive' }}</td>
                                <td>
                                    @can('update brand')
                                        <a class="me-3" href="{{route('brand.edit',$brand->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete brand')
                                        <form action="{{route('brand.destroy',$brand->id)}}" method="POST" class="sr-dl" >
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


