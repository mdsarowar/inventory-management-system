@extends('admin.master')

@section('title',__('Account Payment Vouchers'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Payment Vouchers List')}}</h4>
                <h6>{{__('Manage Your Payment Vouchers')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('account_payment.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">{{__('Add
                    Payment Voucher')}}</a>
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
                            <th>{{__('Date')}}</th>
                            <th>{{__('Invno')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Note')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ !empty($payment->date) ? \Carbon\Carbon::parse($payment->date)->format('d M Y') : '' }}</td>
                                <td>{{ $payment->inv_number }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ Str::limit($payment->note, 80) }}</td>
                                <td>
                                    @can('update accountpayment')
                                        <a class="me-3" href="{{route('account_payment.edit',$payment->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('update accountpayment')
                                        <a class="me-3" href="{{route('account_payment.show',$payment->id)}}">
                                            <i class="fa fa-eye" data-bs-toggle="tooltip" title="view Product"></i>
                                        </a>
                                    @endcan
                                    @can('delete accountpayment')
                                        <form action="{{route('account_payment.destroy', $payment->id)}}" method="POST" class="sr-dl" >
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
        <!-- /payment voucher list -->
    </div>
@endsection

@section('js')
{{--    @include('admin.include.plugin.datatable')--}}
@endsection
