@extends('admin.master')

@section('title',__('Account Sub-Group'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__("Account Sub-Group List")}}</h4>
                <h6>{{__("Manage Your Account Sub-Group")}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('sub_group.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">{{__('Add Account Sub-Group')}}</a>
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
                            <th>{{__("Name")}}</th>
                            <th>{{__("Group")}}</th>
                            <th>{{__("Description")}}</th>
                            <th>{{__("Action")}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sub_groups as $group)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->group_id ? $group->group->name : '' }}</td>
                                <td>{!! $group->description !!}</td>
                                <td>
                                    @can('update group')
                                        <a class="me-3" href="{{route('sub_group.edit',$group->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete group')
                                        <form action="{{route('sub_group.destroy', $group->id)}}" method="POST" class="sr-dl" >
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
