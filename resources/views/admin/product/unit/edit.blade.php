@extends('admin.master')

@section('title','Unit')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Unit Edit</h4>
                <h6>Update Unit</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('unit.update',$unit->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Unit Name</label>
                                <input type="text" name="name" value="{{$unit->name}}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Unit Name (বাংলা)</label>
                                <input type="text" name="bname" value="{{$unit->bname}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Symbol</label>
                                <input type="text" name="symbol" value="{{$unit->symbol}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="active"
                                           value="1" {{$unit->status == 1 ? 'checked':''}}>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                           value="0" {{$unit->status == 0 ? 'checked':''}}>
                                    <label class="form-check-label" for="inactive">Inactive</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('unit.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection