@extends('admin.master')

@section('title',__('Size'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Size List')}}</h4>
                <h6>{{__('Manage your Sizes')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('size.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">{{__('Add Size')}}</a>
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
                            <th>{{__('Name')}}</th>
                            <th>বাংলা</th>
                            <th>{{__('Symbol')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sizes as $size)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{$size->name}}</td>
                                <td>{!! $size->bname !!}</td>
                                <td>{!! $size->symbol !!}</td>
                                <td>{{ $size->status == 1? 'Active':'Inactive' }}</td>
                                <td>
                                    @can('update size')
                                        <a class="me-3" href="{{route('size.edit',$size->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete size')
                                        <form action="{{route('size.destroy',$size->id)}}" method="POST" class="sr-dl" >
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


