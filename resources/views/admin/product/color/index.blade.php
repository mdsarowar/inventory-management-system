@extends('admin.master')

@section('title','Color')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Color List</h4>
                <h6>Manage your Color</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('color.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">Add Color</a>
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
                            <th>Name</th>
                            <th>বাংলা</th>
                            <th>Symbol</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($colors as $color)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $color->name }}</td>
                                <td>{!! $color->bname !!}</td>
                                <td>{!! $color->symbol !!}</td>
                                <td>{{ $color->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    @can('update color')
                                        <a class="me-3" href="{{route('color.edit',$color->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete color')
                                        <form action="{{route('color.destroy',$color->id)}}" method="POST" class="sr-dl" >
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


