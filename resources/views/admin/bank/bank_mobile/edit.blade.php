@extends('admin.master')
@section('title','Bank Account Edit')
@section('custom_css')
<style>
button.mfs_logo_btn img{
    width: 50px;
    height: 25px;
    vertical-align: middle;
}
button.selected_mfs{
    background: #fe9f4310 !important;
    border: 2px solid #fe9f43 !important;
}
</style>
@endsection
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
                <form action="{{route('bank_mobile.update', $account->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>MFS Prodiver</label>
                                <input type="hidden" name="mfs_provider" id="mfs_provider" value="{{ $account->mfs_provider }}">
                                <div id="mfs_btn_container">
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2 {{ $account->mfs_provider == 'bkash' ? 'selected_mfs' : '' }}" data-mfs="bkash">
                                        <img src="{{ asset('admin/assets/img/mfs/bkash.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2 {{ $account->mfs_provider == 'nagad' ? 'selected_mfs' : '' }}" data-mfs="nagad">
                                        <img src="{{ asset('admin/assets/img/mfs/nagad.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2 {{ $account->mfs_provider == 'upay' ? 'selected_mfs' : '' }}" data-mfs="upay">
                                        <img src="{{ asset('admin/assets/img/mfs/upay.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2 {{ $account->mfs_provider == 'rocket' ? 'selected_mfs' : '' }}" data-mfs="rocket">
                                        <img src="{{ asset('admin/assets/img/mfs/rocket.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2 {{ $account->mfs_provider == 'mcash' ? 'selected_mfs' : '' }}" data-mfs="mcash">
                                        <img src="{{ asset('admin/assets/img/mfs/mcash.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2 {{ $account->mfs_provider == 'meghnapay' ? 'selected_mfs' : '' }}" data-mfs="meghnapay">
                                        <img src="{{ asset('admin/assets/img/mfs/meghnapay.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2 {{ $account->mfs_provider == 'surecash' ? 'selected_mfs' : '' }}" data-mfs="surecash">
                                        <img src="{{ asset('admin/assets/img/mfs/surecash.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2 {{ $account->mfs_provider == 'tap' ? 'selected_mfs' : '' }}" data-mfs="tap">
                                        <img src="{{ asset('admin/assets/img/mfs/tap.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2 {{ $account->mfs_provider == 'telecash' ? 'selected_mfs' : '' }}" data-mfs="telecash">
                                        <img src="{{ asset('admin/assets/img/mfs/telecash.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 {{ $account->mfs_provider == 'mycash' ? 'selected_mfs' : '' }}" data-mfs="mycash">
                                        <img src="{{ asset('admin/assets/img/mfs/mycash.webp') }}" class="img-fluid">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Account Name</label>
                                <input type="text" name="account_name" value="{{ $account->account_name }}" required>
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
                                <input type="number" name="balance" class="form-control" step="any" value="{{ $account->balance }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Deposit</label>
                                <input type="number" name="deposit" class="form-control" step="any" value="{{ $account->deposit }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Withdrawn</label>
                                <input type="number" name="withdrawn" class="form-control" step="any" value="{{ $account->withdrawn }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Note</label>
                                <textarea name="note">{{ $account->note }}</textarea>
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
                            <a href="{{route('bank_mobile.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!-- /edit -->
    </div>
@endsection
@section('js')
<script>
$(document).ready(function() {
    $('#mfs_btn_container button').click(function() {
        $('#mfs_btn_container button').removeClass('selected_mfs');
        $(this).addClass('selected_mfs');
        $('#mfs_provider').val($(this).data('mfs'));
    });
});
</script>
@endsection
