@extends('admin.master')

@section('title',__('Company'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Company')}} {{__('Management')}}</h4>
                <h6>{{__('Add')}} {{__('Company')}}</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Email')}}</label>
                                <input type="text" name="email" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Phone')}}</label>
                                <input type="text" name="phone" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Mobile')}}</label>
                                <input type="text" name="mobile">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Fax')}}</label>
                                <input type="text" name="fax">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Tin')}}</label>
                                <input type="text" name="tin">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Vat')}}</label>
                                <input type="text" name="vat">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('License')}}</label>
                                <input type="text" name="license">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Web')}}</label>
                                <input type="text" name="web">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Page Header')}}</label>
                                <input type="text" name="page_header">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">{{__('Status')}}</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="gender_male"
                                           value="1">
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
                                <label>{{__('Tin Image')}}</label>
                                <div class="image-upload">
                                    <input type="file" name="tin_image">
                                    <div class="image-uploads">
                                        <img src="{{asset('/')}}admin/assets/img/icons/upload.svg" alt="img">
                                        <h4>{{__('Drag and drop a file to upload')}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{__('License Image')}}</label>
                                <div class="image-upload">
                                    <input type="file" name="license_image">
                                    <div class="image-uploads">
                                        <img src="{{asset('/')}}admin/assets/img/icons/upload.svg" alt="img">
                                        <h4>{{__('Drag and drop a file to upload')}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{__('Company Logo')}}</label>
                                <div class="image-upload">
                                    <input type="file" name="logo">
                                    <div class="image-uploads">
                                        <img src="{{asset('/')}}admin/assets/img/icons/upload.svg" alt="img">
                                        <h4>{{__('Drag and drop a file to upload')}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Address')}}</label>
                                <textarea id="summernote" name="address" rows="4" cols="50"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">{{__('Save')}}</button>
                            <a href="{{route('company.index')}}" class="btn btn-cancel">{{__('Cancel')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
