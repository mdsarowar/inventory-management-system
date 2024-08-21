@extends('admin.master')

@section('title','MFS Accounts List')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>MFS Accounts List</h4>
                <h6>Manage Your MFS Accounts</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('bank_mobile.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">Add Account</a>
            </div>
        </div>


        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>#</th>
                            <th>MFS Provider</th>
                            <th>Account No.</th>
                            <th>Account Name</th>
                            <th>Balance</th>
                            <th>Deposit</th>
                            <th>Withdrawn</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($accounts as $account)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($account->mfs_provider == 'bkash')
                                        <img src="{{ asset('admin/assets/img/mfs/bkash.webp') }}" class="img-fluid" width="55px">
                                    @endif

                                    @if($account->mfs_provider == 'nagad')
                                        <img src="{{ asset('admin/assets/img/mfs/nagad.webp') }}" class="img-fluid" width="55px">
                                    @endif

                                    @if($account->mfs_provider == 'upay')
                                        <img src="{{ asset('admin/assets/img/mfs/upay.webp') }}" class="img-fluid" width="55px">
                                    @endif

                                    @if($account->mfs_provider == 'rocket')
                                        <img src="{{ asset('admin/assets/img/mfs/rocket.webp') }}" class="img-fluid" width="55px">
                                    @endif

                                    @if($account->mfs_provider == 'mcash')
                                        <img src="{{ asset('admin/assets/img/mfs/mcash.webp') }}" class="img-fluid" width="55px">
                                    @endif

                                    @if($account->mfs_provider == 'meghnapay')
                                        <img src="{{ asset('admin/assets/img/mfs/meghnapay.webp') }}" class="img-fluid" width="55px">
                                    @endif

                                    @if($account->mfs_provider == 'surecash')
                                        <img src="{{ asset('admin/assets/img/mfs/surecash.webp') }}" class="img-fluid" width="55px">
                                    @endif

                                    @if($account->mfs_provider == 'tap')
                                        <img src="{{ asset('admin/assets/img/mfs/tap.webp') }}" class="img-fluid" width="55px">
                                    @endif

                                    @if($account->mfs_provider == 'telecash')
                                        <img src="{{ asset('admin/assets/img/mfs/telecash.webp') }}" class="img-fluid" width="55px">
                                    @endif

                                    @if($account->mfs_provider == 'mycash')
                                        <img src="{{ asset('admin/assets/img/mfs/mycash.webp') }}" class="img-fluid" width="55px">
                                    @endif
                                </td>
                                <td>{{ $account->account_no }}</td>
                                <td>{{ $account->account_name }}</td>
                                <td>&#x9F3;{{ $account->balance }}</td>
                                <td>&#x9F3;{{ $account->deposit }}</td>
                                <td>&#x9F3;{{ $account->withdrawn }}</td>
                                <td>
                                    @can('update bank_mobile')
                                        <a class="me-3" href="{{route('bank_mobile.edit',$account->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete bank_mobile')
                                        <form action="{{route('bank_mobile.destroy',$account->id)}}" method="POST" class="sr-dl" >
                                            @csrf
                                            @method('delete')
                                            <a class="delete_confirm" href="javascript:void(0);">
                                                <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">
                                            </a>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /mfs list -->
    </div>
@endsection

@section('js')
{{--    @include('admin.include.plugin.datatable')--}}
@endsection
