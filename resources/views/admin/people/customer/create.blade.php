@extends('admin.master')

@section('title','category')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Customer Management</h4>
                <h6>Add/Update Customer</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('customers.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" name="name" >
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
                                <label>Contact Person</label>
                                <input type="text" name="cperson" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Contact mobile</label>
                                <input type="text" name="cmobile" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Creditlimit</label>
                                <input type="text" name="creditlimit" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Balance</label>
                                <input type="text" name="balance" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Rank</label>
                                <input type="text" name="rank" >
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
                        {{--                    <div class="col-lg-3 col-sm-6 col-12">--}}
                        {{--                        <div class="form-group">--}}
                        {{--                            <label>Choose Country</label>--}}
                        {{--                            <select class="select">--}}
                        {{--                                <option>Choose Country</option>--}}
                        {{--                                <option>India</option>--}}
                        {{--                                <option>USA</option>--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        {{--                    <div class="col-lg-3 col-sm-6 col-12">--}}
                        {{--                        <div class="form-group">--}}
                        {{--                            <label>City</label>--}}
                        {{--                            <select class="select">--}}
                        {{--                                <option>Choose City</option>--}}
                        {{--                                <option>City 1</option>--}}
                        {{--                                <option>City 2</option>--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        <div class="col-lg-9 col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="note"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>	Avatar</label>
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
                            <a href="{{route('customers.index')}}"  class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
