@extends('admin.master')

@section('title','Bank Accounts List')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Bank Accounts List</h4>
                <h6>Manage Your Bank Accounts</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('bank_account.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">Add Account</a>
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
                            <th>Account Holder</th>
                            <th>Account No.</th>
                            <th>Balance</th>
                            <th>Bank</th>
                            <th>Branch</th>
                            <th>Status</th>
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
                                <td>{{ $account->account_holder }}</td>
                                <td>{{ $account->account_no }}</td>
                                <td>{{ $account->balance }}</td>
                                <td>{{ empty($account->bank->name) ? '' : $account->bank->name }}</td>
                                <td>{{ $account->branch_name }}</td>
                                <td>{{ ucfirst($account->status) }}</td>
                                <td>
                                    @can('update bank_account')
                                        <a class="me-3" href="{{route('bank_account.edit',$account->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete bank_account')
                                        <form action="{{route('bank_account.destroy',$account->id)}}" method="POST" class="sr-dl" >
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
        <!-- /bank accounts list -->
    </div>
@endsection

@section('js')
{{--    @include('admin.include.plugin.datatable')--}}
@endsection
