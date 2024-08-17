@extends('admin.master')

@section('title',__('Department'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4> {{__('Edit Department')}}</h4>
                <h6>{{__('Edit a Department')}}</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('department.update',$department->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name" value="{{$department->name}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">{{__('Status')}}</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_male"
                                           value="1" {{$department->status == 1?'checked':''}}>
                                    <label class="form-check-label" for="gender_male">{{__('Active')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_female"
                                           value="0" {{$department->status == 0?'checked':''}}>
                                    <label class="form-check-label" for="gender_female">{{__('Inactive')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>{{__('Description')}}</label>
                                <textarea class="form-control" name="description">{!! $department->description !!}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="submit"  class="btn btn-submit me-2">{{__('update')}}</button>
                            <a href="{{route('department.index')}}"  class="btn btn-cancel">{{__('Cancel')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
