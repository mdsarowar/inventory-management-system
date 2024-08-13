@extends('admin.master')

@section('title','employee')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Employee Management</h4>
                <h6>Add/Update Employee</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('employee.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Department</label>
{{--                                <input type="text" name="department_id" >--}}
                                <select class="select" name="department_id" >
                                    <option>Choose department</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}" >{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Designation</label>
{{--                                <input type="text" name="designation_id" >--}}
                                <select class="select" name="designation_id" >
                                    <option>Choose department</option>
                                    @foreach($designations as $designation)
                                        <option value="{{$designation->id}}" >{{$designation->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Father Name</label>
                                <input type="text" name="fname" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Mother Name</label>
                                <input type="text" name="mname" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="mobile" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>NID</label>
                                <input type="text" name="nid" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Joining Date</label>
                                <input type="date" name="joining_date" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Salary</label>
                                <input type="text" name="salary" >
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_male"
                                           value="1">
                                    <label class="form-check-label" for="gender_male">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_female"
                                           value="0">
                                    <label class="form-check-label" for="gender_female">Inactive</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Permanent Address</label>
                                <textarea class="form-control" name="per_address"></textarea>
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
                        <div class="col-lg-12">
                            <button type="submit"  class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('employee.index')}}"  class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
