@extends('admin.master')

@section('title','Size')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Size Edit</h4>
                <h6>Update Size</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('size.update',$size->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>size Name</label>
                                <input type="text" name="name" value="{{$size->name}}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>size Name (বাংলা)</label>
                                <input type="text" name="bname" value="{{$size->bname}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Symbol</label>
                                <input type="text" name="symbol" value="{{$size->symbol}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="active"
                                           value="1" {{$size->status == 1 ? 'checked':''}}>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                           value="0" {{$size->status == 0 ? 'checked':''}}>
                                    <label class="form-check-label" for="inactive">Inactive</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('size.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection