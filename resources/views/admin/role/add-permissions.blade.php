@extends('admin.master')

@section('title','users')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Role : {{ $role->name }}
                            <a href="{{ url('roles') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <label for="">Permissions</label>

                                <div class="row">
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
                                                            <input {{$role->permissions->contains('id',$permission->id)?"checked":""}} name="permissions[]" class="permissioncheckbox" type="checkbox" value="{{ $permission->name }}">
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
                                </div>

                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('admin/assets/js/checkbox.js') }}"></script>
@endsection
