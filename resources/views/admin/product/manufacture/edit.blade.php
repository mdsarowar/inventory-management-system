@extends('admin.master')

@section('title','Manufacture')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Manufacture Edit</h4>
                <h6>Update Manufacture</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('manufacture.update',$manufacture->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Manufacture Name</label>
                                <input type="text" name="name" placeholder="e.g. Realme" value="{{ $manufacture->name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Manufacture Name (বাংলা)</label>
                                <input type="text" name="bname" value="{{ $manufacture->bname }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="active"
                                           value="1" {{$manufacture->status == 1 ? 'checked':''}}>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                           value="0" {{$manufacture->status == 0 ? 'checked':''}}>
                                    <label class="form-check-label" for="inactive">Inactive</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="text" name="cperson" class="form-control" placeholder="e.g. Umar Saif" value="{{ $manufacture->cperson }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Contact Mobile</label>
                                <input type="tel" name="cmobile" class="form-control" placeholder="e.g. 018xxxxxxxx" value="{{ $manufacture->cmobile }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Contact Email</label>
                                <input type="email" name="email" class="form-control" placeholder="e.g. example@mail.com" value="{{ $manufacture->email }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address">{{ $manufacture->address }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description">{{ $manufacture->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Main Products</label>
                                <textarea name="mainproduct" placeholder="comma , separated value. e.g. Puma, Adidas etc.">{{ $manufacture->mainproduct }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Website</label>
                                <input type="url" name="web" class="form-control" value="{{ $manufacture->web }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Rank</label>
                                <input type="number" name="rank" class="form-control" value="{{ $manufacture->rank }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('manufacture.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection