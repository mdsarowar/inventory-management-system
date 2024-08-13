@extends('admin.master')

@section('title','users')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>User Management</h4>
                <h6>Edit/Update User</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{ url('admins/'.$user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="name" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" name="password" class=" pass-input" >
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{$user->email}}" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="select" name="roles[]" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"{{ in_array($role, $userRoles) ? 'selected':'' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="formFile" class="form-label">Default file input example</label>
                                <input class="form-control" type="file" name="image" id="formFile" accept="image/*">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="product-list">
                                <ul class="row">
                                    <li class="ps-0">
                                        <div class="productviewset">
                                            <div class="productviewsimg">
                                                <img src="{{asset($user->image)}}" alt="img">
                                            </div>
                                            <div class="productviewscontent">
                                                <a href="javascript:void(0);" class="hideset"><i class="fa fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Update</button>
                            <a href="{{route('admins.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- /add -->
    </div>


@endsection
