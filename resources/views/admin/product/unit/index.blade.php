@extends('admin.master')

@section('title','Unit')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Unit List</h4>
                <h6>Manage your Unit</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('unit.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">Add unit</a>
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
                        @foreach($units as $unit)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{$unit->name}}</td>
                                <td>{!! $unit->bname !!}</td>
                                <td>{!! $unit->symbol !!}</td>
                                <td>{{ $unit->status == 1? 'Active':'Inactive' }}</td>
                                <td>
                                    @can('update unit')
                                        <a class="me-3" href="{{route('unit.edit',$unit->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete unit')
                                        <form action="{{route('unit.destroy',$unit->id)}}" method="POST" class="sr-dl" >
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


