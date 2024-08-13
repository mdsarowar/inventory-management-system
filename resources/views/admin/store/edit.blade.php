@extends('admin.master')

@section('title',__('store'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Store')}} {{__('Management')}}</h4>
                <h6>{{__('Edit')}} {{__('Store')}}</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('store.update',$store->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name" required value="{{$store->name}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Company')}}</label>
                                <select class="select" name="company_id" >
                                    <option>Select</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}" {{$company->id == $store->company_id ?"selected":''}}>{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('User')}}</label>
                                <select class="select" name="incharge" >
                                    <option>Select</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" {{$user->id == $store->incharge ?"selected":''}}>{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Mobile')}}</label>
                                <input type="text" name="mobile" value="{{$store->mobile}}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">{{__('Status')}}</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_male"
                                           value="1" {{$store->status == 1 ? 'checked':''}}>
                                    <label class="form-check-label" for="gender_male">{{__('Active')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_female"
                                           value="0" {{$store->status == 0 ? 'checked':''}}>
                                    <label class="form-check-label" for="gender_female">{{__('Inactive')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Address')}}</label>
                                <textarea id="summernote" name="address" rows="4" cols="50">{!! $store->address !!}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">{{__('Update')}}</button>
                            <a href="{{route('store.index')}}" class="btn btn-cancel">{{__('Cancel')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>


@endsection
