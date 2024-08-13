@extends('admin.master')

@section('title','brand')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Supplier Edit </h4>
                <h6>Edit a Supplier </h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('suppliers.update',$supplier->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" name="name" value="{{$supplier->name}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{$supplier->email}}" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="mobile" value="{{$supplier->mobile}}" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>NID</label>
                                <input type="text" name="nid" value="{{$supplier->nid}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="text" name="cperson" value="{{$supplier->cperson}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Contact mobile</label>
                                <input type="text" name="cmobile" value="{{$supplier->cmobile}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Creditlimit</label>
                                <input type="text" name="creditlimit" value="{{$supplier->creditlimit}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Balance</label>
                                <input type="text" name="balance" value="{{$supplier->balance}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Rank</label>
                                <input type="text" name="rank" value="{{$supplier->rank}}">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_male"
                                           value="1" {{$supplier->status == 1?'checked':''}}>
                                    <label class="form-check-label" for="gender_male">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_female"
                                           value="0" {{$supplier->status == 0?'checked':''}}>
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
                                <input type="text" name="address" value="{{$supplier->address}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="note">{!! $supplier->note !!}</textarea>
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
                        <div class="product-list">
                            <ul class="row">
                                <li>
                                    <div class="productviews">
                                        <div class="productviewsimg">
                                            <img src="{{asset($supplier->image)}}" alt="img">
                                        </div>
                                        <div class="productviewscontent">
                                            <div class="productviewsname">
                                                <h2>{{$supplier->name}}</h2>
                                                {{--                                                    <h3>581kb</h3>--}}
                                            </div>
                                            <a href="javascript:void(0);" class="hideset">x</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit"  class="btn btn-submit me-2">update</button>
                            <a href="{{route('suppliers.index')}}"  class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
