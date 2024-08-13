@extends('admin.master')
@section('title','Create New MFS Account')
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
                <h4>MFS Account Add</h4>
                <h6>Create New MFS Account</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('bank_mobile.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>MFS Prodiver</label>
                                <input type="hidden" name="mfs_provider" id="mfs_provider">
                                <div id="mfs_btn_container">
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2" data-mfs="bkash">
                                        <img src="{{ asset('admin/assets/img/mfs/bkash.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2" data-mfs="nagad">
                                        <img src="{{ asset('admin/assets/img/mfs/nagad.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2" data-mfs="upay">
                                        <img src="{{ asset('admin/assets/img/mfs/upay.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2" data-mfs="rocket">
                                        <img src="{{ asset('admin/assets/img/mfs/rocket.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2" data-mfs="mcash">
                                        <img src="{{ asset('admin/assets/img/mfs/mcash.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2" data-mfs="meghnapay">
                                        <img src="{{ asset('admin/assets/img/mfs/meghnapay.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2" data-mfs="surecash">
                                        <img src="{{ asset('admin/assets/img/mfs/surecash.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2" data-mfs="tap">
                                        <img src="{{ asset('admin/assets/img/mfs/tap.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1 mb-2" data-mfs="telecash">
                                        <img src="{{ asset('admin/assets/img/mfs/telecash.webp') }}" class="img-fluid">
                                    </button>
                                    <button type="button" class="btn btn-light border mfs_logo_btn mx-1" data-mfs="mycash">
                                        <img src="{{ asset('admin/assets/img/mfs/mycash.webp') }}" class="img-fluid">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Account Name</label>
                                <input type="text" name="account_name" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Account Number</label>
                                <input type="text" name="account_no">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Balance</label>
                                <input type="number" name="balance" class="form-control" step="any">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Deposit</label>
                                <input type="number" name="deposit" class="form-control" step="any">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Withdrawn</label>
                                <input type="number" name="withdrawn" class="form-control" step="any">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Note</label>
                                <textarea name="note"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Publisher</label>
                                <input type="text" value="{{ auth()->user()->name }}" readonly>
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Branch</label>
                                <select name="branch_id" class="form-select">
                                    <option selected disabled>-- select one --</option>
                                    @forelse($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @empty
                                    <option selected disabled>no branch found</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Compnay</label>
                                <select name="company_id" class="form-select">
                                    <option selected disabled>-- select one --</option>
                                    @forelse($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @empty
                                    <option selected disabled>no company found</option>
                                    @endforelse
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
        <!-- /add -->
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
