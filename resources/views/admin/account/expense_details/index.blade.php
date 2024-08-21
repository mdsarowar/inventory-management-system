@extends('admin.master')

@section('title','Expense Details')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Expense Details List</h4>
                <h6>Manage Your Expense Details</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('expense_details.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">Add Expense Details</a>
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
                            <th>Expense ID</th>
                            <th>Invno</th>
                            <th>Amount</th>
                            <th>Cheque ID</th>
                            <th>Reference</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses as $expense)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ !empty($expense->date) ? \Carbon\Carbon::parse($expense->date)->format('d M Y') : '' }}</td>
                                <td>{{ $expense->expense_id }}</td>
                                <td>{{ $expense->inv_number }}</td>
                                <td>{{ $expense->amount }}</td>
                                <td>{{ $expense->cheque_id }}</td>
                                <td>{{ $expense->reference }}</td>
                                <td>
                                    @can('update expense_details')
                                        <a class="me-3" href="{{route('expense_details.edit',$expense->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete expense_details')
                                        <form action="{{route('expense_details.destroy', $expense->id)}}" method="POST" class="sr-dl" >
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
        <!-- /expense details list -->
    </div>
@endsection

@section('js')
{{--    @include('admin.include.plugin.datatable')--}}
@endsection
