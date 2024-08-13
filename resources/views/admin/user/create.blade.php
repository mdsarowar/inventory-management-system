@extends('admin.master')

@section('title','users')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>User Management</h4>
                <h6>Add/Update User</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admins.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="row">
{{--                    <div class="col-lg-3 col-sm-6 col-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>First Name</label>--}}
{{--                            <input type="text" >--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3 col-sm-6 col-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Last Name</label>--}}
{{--                            <input type="text" >--}}
{{--                        </div>--}}
{{--                    </div>--}}


                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="name" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" name="password" class=" pass-input">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>

                        </div>
                        {{--                    <div class="col-lg-3 col-sm-6 col-12">--}}
                        {{--                        <div class="form-group">--}}
                        {{--                            <label>Phone</label>--}}
                        {{--                            <input type="text" >--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="select" name="roles[]" multiple >
                                    {{--                                <option>Select</option>--}}
                                    @foreach($roles as $role)
                                        <option>{{$role}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	User Image</label>
                                <div class="image-upload">
                                    <input type="file" name="image">
{{--                                    <div class="image-uploads">--}}
{{--                                        <img src="{{asset('/')}}admin/assets/img/icons/upload.svg" alt="img">--}}
{{--                                        <h4>Drag and drop a file to upload</h4>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Save</button>
                            {{--                            <a  class="btn btn-submit me-2">Submit</a>--}}
                            <a href="{{route('admins.index')}}"  class="btn btn-cancel">Cancel</a>
                        </div>


                </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
