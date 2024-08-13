@extends('admin.master')

@section('title','brand')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Edit Category</h4>
                <h6>Edit a product Category</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('employee.update',$employee->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label> Name</label>
                                <input type="text" name="name" value="{{$employee->name}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label> department_id</label>
{{--                                <input type="text" name="department_id" value="{{$employee->department_id}}">--}}
                                <select class="select" name="department_id" >
                                    <option>Choose department</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}" {{$department->id == $employee->department_id ? 'selected':''}} >{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label> designation_id</label>
{{--                                <input type="text" name="designation_id" value="{{$employee->designation_id}}">--}}
                                <select class="select" name="designation_id" >
                                    <option>Choose department</option>
                                    @foreach($designations as $designation)
                                        <option value="{{$designation->id}}" {{$designation->id == $employee->designation_id ? 'selected':''}} >{{$designation->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Father Name</label>
                                <input type="text" name="fname" value="{{$employee->fname}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Mother Name</label>
                                <input type="text" name="mname" value="{{$employee->mname}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{$employee->email}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" value="{{$employee->phone}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="mobile" value="{{$employee->mobile}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>NID</label>
                                <input type="text" name="nid" value="{{$employee->nid}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" value="{{$employee->dob}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Joining Date</label>
                                <input type="date" name="joining_date" value="{{$employee->joining_date}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Salary</label>
                                <input type="text" name="salary" value="{{$employee->salary}}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_male"
                                           value="1" {{$employee->status == 1?'checked':''}}>
                                    <label class="form-check-label" for="gender_male">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_female"
                                           value="0" {{$employee->status == 0?'checked':''}}>
                                    <label class="form-check-label" for="gender_female">Inactive</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address">{!! $employee->address !!}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Permanent Address</label>
                                <textarea class="form-control" name="per_address">{!! $employee->per_address !!}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Image</label>
                                <div class="image-upload">
                                    <input type="file" name="image">
                                    <div class="image-uploads">
                                        <img src="{{asset('/')}}admin/assets/img/icons/upload.svg" alt="img">
                                        <h4>Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-list">
                            <ul class="row">
                                <li>
                                    <div class="productviews">
                                        <div class="productviewsimg">
                                            <img src="{{asset($employee->image)}}" alt="img">
                                        </div>
                                        <div class="productviewscontent">
                                            <div class="productviewsname">
                                                <h2>{{$employee->name}}</h2>
                                                {{--                                                    <h3>581kb</h3>--}}
                                            </div>
                                            <a href="javascript:void(0);" class="hideset">x</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit"  class="btn btn-submit me-2">Update</button>
                            <a href="{{route('employee.index')}}"  class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
