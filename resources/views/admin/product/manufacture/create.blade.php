@extends('admin.master')

@section('title',__('Manufacture'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Add Manufacture')}}</h4>
                <h6>{{__('Create new Manufacture')}}</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('manufacture.store')}}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name" placeholder="e.g. Realme" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Name')}} (বাংলা)</label>
                                <input type="text" name="bname">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Contact Person')}}</label>
                                <input type="text" name="cperson" class="form-control" placeholder="e.g. Umar Saif">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Contact Mobile')}}</label>
                                <input type="tel" name="cmobile" class="form-control" placeholder="e.g. 018xxxxxxxx">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Contact Email')}}</label>
                                <input type="email" name="email" class="form-control" placeholder="e.g. example@mail.com">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Main Products')}}</label>
                                <input name="mainproduct" class="form-control" placeholder="comma , separated value. e.g. Puma, Adidas etc.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Website')}}</label>
                                <input type="url" name="web" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Rank')}}</label>
                                <input type="number" name="rank" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">{{__('Status')}}</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="active"
                                           value="1">
                                    <label class="form-check-label" for="active">{{__('Active')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                           value="0">
                                    <label class="form-check-label" for="inactive">{{__('Inactive')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Address')}}</label>
                                <textarea name="address" id="summernote2"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Description')}}</label>
                                <textarea name="description" id="summernote1"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">{{__('Submit')}}</button>
                            <a href="{{route('manufacture.index')}}" class="btn btn-cancel">{{__('Cancel')}}</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection

