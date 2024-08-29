@extends('admin.master')

@section('title',__('Account Classes'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Account Classes list')}}</h4>
                <h6>{{__('Manage Your Account Classes')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('class.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">{{__('Add Account Classes')}}</a>
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
                            <th>{{__('Name')}} (বাংলা)</th>
                            <th>{{__('Type')}} (বাংলা)</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classes as $class)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ __($class->name) }}</td>
                                <td>{{$class->bname}}</td>
                                <td>{{__($class->type)}}</td>
                                <td>
                                    @can('update class')
                                        <a class="me-3" href="{{route('class.edit',$class->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete class')
                                        <form action="{{route('class.destroy',$class->id)}}" method="POST" class="sr-dl" >
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
        <!-- /class list -->
    </div>
@endsection

@section('js')
{{--    @include('admin.include.plugin.datatable')--}}
@endsection
