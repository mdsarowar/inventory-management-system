@extends('admin.master')

@section('title',__('Employee'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Employee Management')}}</h4>
                <h6>{{__('Add/Update Employee')}}</h6>
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
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name" required >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Department')}}</label>
{{--                                <input type="text" name="department_id" >--}}
                                <select class="select" name="department_id" >
                                    <option>{{__('Choose Department')}}</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}" >{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Designation')}}</label>
{{--                                <input type="text" name="designation_id" >--}}
                                <select class="select" name="designation_id" >
                                    <option>{{__('Choose Department')}}</option>
                                    @foreach($designations as $designation)
                                        <option value="{{$designation->id}}" >{{$designation->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Father Name')}}</label>
                                <input type="text" name="fname" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Mother Name')}}</label>
                                <input type="text" name="mname" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Email')}}</label>
                                <input type="text" name="email" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Phone')}}</label>
                                <input type="text" name="phone" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Mobile')}}</label>
                                <input type="text" name="mobile" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('NID')}}</label>
                                <input type="text" name="nid" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Date Of Birth')}}</label>
                                <input type="date" name="dob" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Joining Date')}}</label>
                                <input type="date" name="joining_date" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Salary')}}</label>
                                <input type="text" name="salary" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="form-group">
                                <label>{{__('Address')}}</label>
                                <input type="text" name="address">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">{{__('Status')}}</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_male"
                                           value="1" checked>
                                    <label class="form-check-label" for="gender_male">{{__('Active')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_female"
                                           value="0">
                                    <label class="form-check-label" for="gender_female">{{__('Inactive')}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{__('Permanent Address')}}</label>
                                <textarea class="form-control" name="per_address"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{__('Image')}}</label>
                                <div class="image-upload">
                                    <input type="file" name="image">
                                    <div class="image-uploads">
                                        <img src="{{asset('/')}}admin/assets/img/icons/upload.svg" alt="img">
                                        <h4>{{__('Drag and drop a file to upload')}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit"  class="btn btn-submit me-2">{{__('Submit')}}</button>
                            <a href="{{route('employee.index')}}"  class="btn btn-cancel">{{__('Cancel')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
