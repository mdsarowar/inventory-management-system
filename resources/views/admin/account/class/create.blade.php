@extends('admin.master')

@section('title',__('Account Classes'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Add Account Classes')}}</h4>
                <h6>{{__("Create a New Account Classes")}}</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('class.store')}}" method="post">
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
                                <label>{{__('Name')}} (বাংলা)</label>
                                <input type="text" name="bname">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Type')}}</label>
                                <select name="type" class="form-select">
                                    <option selected disabled>-- select one --</option>
                                    <option value="asset">{{__('Asset')}}</option>
                                    <option value="liability">{{__('Liability')}}</option>
                                    <option value="equity">{{__('Equity')}}</option>
                                    <option value="income">{{__('Income')}}</option>
                                    <option value="expense">{{__('Expense')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{__('Description')}}</label>
                                <textarea name="description" id="summernote1"></textarea>
                            </div>
                        </div>
{{--                        <div class="col-lg-3 col-sm-6 col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Publisher</label>--}}
{{--                                <input type="text" value="{{ auth()->user()->name }}" readonly>--}}
{{--                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-sm-6 col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Select Branch</label>--}}
{{--                                <select name="branch_id" class="form-select">--}}
{{--                                    <option selected disabled>-- select one --</option>--}}
{{--                                    @forelse($branches as $branch)--}}
{{--                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>--}}
{{--                                    @empty--}}
{{--                                    <option selected disabled>no branch found</option>--}}
{{--                                    @endforelse--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4 col-sm-6 col-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Select Compnay</label>--}}
{{--                                <select name="company_id" class="form-select">--}}
{{--                                    <option selected disabled>-- select one --</option>--}}
{{--                                    @forelse($companies as $company)--}}
{{--                                    <option value="{{ $company->id }}">{{ $company->name }}</option>--}}
{{--                                    @empty--}}
{{--                                    <option selected disabled>no company found</option>--}}
{{--                                    @endforelse--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('class.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
