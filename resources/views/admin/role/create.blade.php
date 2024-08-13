{{--<x-app-web-layout>--}}
@extends('admin.master')

@section('title','users')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Create Role
                            <a href="{{ url('roles') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('roles') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="">Role Name</label>
                                <input type="text" required name="name" class="form-control" />
                            </div>
                            <table class="permissionTable table table-bordered table-striped">
                                <th>
                                    {{__('Section')}}
                                </th>

                                <th>
                                    <label>
                                        <input class="grand_selectall" type="checkbox">
                                        {{__('Select All') }}
                                    </label>
                                </th>

                                <th>
                                    {{__("Available permissions")}}
                                </th>



                                <tbody>
                                @foreach($custom_permission as $key => $group)
                                    <tr>
                                        <td>
                                            <b>{{ ucfirst($key) }}</b>
                                        </td>
                                        <td width="30%">
                                            <label>
                                                <input class="selectall" type="checkbox">
                                                {{__('Select All') }}
                                            </label>
                                        </td>
                                        <td>

                                            @forelse($group as $permission)

                                                <label>
                                                    <input name="permissions[]" class="permissioncheckbox" type="checkbox" value="{{ $permission->name }}">
                                                    {{$permission->name}} &nbsp;&nbsp;
                                                </label>

                                            @empty
                                                {{ __("No permission in this group !") }}
                                            @endforelse

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
{{--                            <table class="table table-bordered table-striped">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Id</th>--}}
{{--                                    <th>Name</th>--}}
{{--                                    <th width="40%">Action</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach ($roles as $role)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $role->id }}</td>--}}
{{--                                        <td>{{ $role->name }}</td>--}}
{{--                                        <td>--}}
{{--                                            <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="btn btn-warning">--}}
{{--                                                Add / Edit Role Permission--}}
{{--                                            </a>--}}

{{--                                            @can('update role')--}}
{{--                                                <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-success">--}}
{{--                                                    Edit--}}
{{--                                                </a>--}}
{{--                                            @endcan--}}

{{--                                            @can('delete role')--}}
{{--                                                <a href="{{ url('roles/'.$role->id.'/delete') }}" class="btn btn-danger mx-2">--}}
{{--                                                    Delete--}}
{{--                                                </a>--}}
{{--                                            @endcan--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--</x-app-web-layout>--}}
@endsection

@section('js')
    <script src="{{ url('admin/assets/js/checkbox.js') }}"></script>
@endsection
