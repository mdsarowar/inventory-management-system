@extends('admin.master')

@section('title','Transaction Details')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Transaction Details List</h4>
                <h6>Manage Your Transaction Details</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('transaction_details.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">Add Transaction Details</a>
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
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>Transaction Type</th>
                            <th>Invno</th>
                            <th>Amount</th>
                            <th>Cheque ID</th>
                            <th>Reference</th>
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
                                <td>{{ !empty($transaction->date) ? \Carbon\Carbon::parse($transaction->date)->format('d M Y') : '' }}</td>
                                <td>{{ $transaction->transaction_id }}</td>
                                <td>{{ $transaction->transaction_type }}</td>
                                <td>{{ $transaction->inv_number }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->cheque_id }}</td>
                                <td>{{ $transaction->reference }}</td>
                                <td>
                                    @can('update transaction_details')
                                        <a class="me-3" href="{{route('transaction_details.edit',$transaction->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete transaction_details')
                                        <form action="{{route('transaction_details.destroy', $transaction->id)}}" method="POST" class="sr-dl" >
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
        <!-- /transaction details list -->
    </div>
@endsection

@section('js')
{{--    @include('admin.include.plugin.datatable')--}}
@endsection
