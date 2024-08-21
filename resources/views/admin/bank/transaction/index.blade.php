@extends('admin.master')

@section('title','Bank Transactions')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Bank Transactions List</h4>
                <h6>Manage Your Bank Transactions</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('bank_transaction.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">Add Transaction</a>
            </div>
        </div>

        <!-- /transaction list -->
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
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>Bank Name</th>
                            <th>Branch Name</th>
                            <th>Amount</th>
                            <th>Transaction Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->account_name }}</td>
                                <td>{{ $transaction->account_no }}</td>
                                <td>{{ $transaction->bank_name }}</td>
                                <td>{{ $transaction->branch_name }}</td>
                                <td>{{ $transaction->amount }} {{ $transaction->currency }}</td>
                                <td>{{ !empty($transaction->transaction_date) ? \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') : '' }}</td>
                                <td>
                                    @can('update bank_transaction')
                                        <a class="me-3" href="{{route('bank_transaction.edit',$transaction->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete bank_transaction')
                                        <form action="{{route('bank_transaction.destroy', $transaction->id)}}" method="POST" class="sr-dl" >
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
        <!-- /bank transactions list -->
    </div>
@endsection

@section('js')
{{--    @include('admin.include.plugin.datatable')--}}
@endsection
