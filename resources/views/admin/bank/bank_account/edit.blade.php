@extends('admin.master')

@section('title','Bank Account Edit')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Bank Account Edit</h4>
                <h6>Update Bank Account</h6>
            </div>
        </div>
        <!-- /edit -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('bank_account.update', $account->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Account Holder Name</label>
                                <input type="text" name="account_holder" value="{{ $account->account_holder }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Account Number</label>
                                <input type="text" name="account_no" value="{{ $account->account_no }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Balance</label>
                                <input type="number" name="balance" class="form-control" step="any" value="{{ $account->balance }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Bank</label>
                                <select name="bank_id" class="form-select">
                                    @if($account->bank_id)
                                        @foreach($banks as $bank)
                                            <option value="{{ $bank->id }}" {{ $account->bank_id == $bank->id ? 'selected' : '' }}>{{ $bank->name }}</option>
                                        @endforeach
                                    @else
                                        <option selected disabled>-- select one --</option>
                                        @foreach($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Branch Name</label>
                                <input type="text" name="branch_name" value="{{ $account->branch_name }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Branch Code</label>
                                <input type="text" name="branch_code" value="{{ $account->branch_code }}">
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-5 col-12">
                            <div class="form-group">
                                <label>Branch Address</label>
                                <input type="text" name="branch_address" value="{{ $account->branch_address }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-7 col-12">
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="active"
                                           value="active" {{ $account->status == 'active' ? 'checked':'' }}>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                           value="inactive" {{ $account->status == 'inactive' ? 'checked':'' }}>
                                    <label class="form-check-label" for="inactive">Inactive</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Publisher</label>
                                <input type="text" value="{{ $account->user->name }}" readonly>
                                <input type="hidden" name="user_id" value="{{ $account->user->id }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Branch</label>
                                <select name="branch_id" class="form-select">
                                    @if($account->branch_id)
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ $account->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                        @endforeach
                                    @else
                                        <option selected disabled>-- select one --</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Compnay</label>
                                <select name="company_id" class="form-select">
                                    @if($account->company_id)
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ $account->branch_id == $branch->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                        @endforeach
                                    @else
                                        <option selected disabled>-- select one --</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('bank_account.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!-- /edit -->
    </div>
@endsection