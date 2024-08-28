@extends('admin.master')

@section('title',__('Color'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Edit Color')}}</h4>
                <h6>{{__('Update Color')}}</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('color.update',$color->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Color Name')}}</label>
                                <input type="text" name="name" value="{{$color->name}}" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Color Name')}} (বাংলা)</label>
                                <input type="text" name="bname" value="{{$color->bname}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Symbol')}}</label>
                                <input type="text" name="symbol" value="{{$color->symbol}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">{{__('Status')}}</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="active"
                                           value="1" {{$color->status == 1 ? 'checked':''}}>
                                    <label class="form-check-label" for="active">{{__('Active')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                           value="0" {{$color->status == 0 ? 'checked':''}}>
                                    <label class="form-check-label" for="inactive">{{__('Inactive')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">{{__('Submit')}}</button>
                            <a href="{{route('color.index')}}" class="btn btn-cancel">{{__('Cancel')}}</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
