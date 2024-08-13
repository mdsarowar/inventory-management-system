@extends('admin.master')

@section('title','Account Payment Vouchers')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Payment Vouchers List</h4>
                <h6>Manage Your Payment Vouchers</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('account_payment.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">Add Payment Voucher</a>
            </div>
        </div>


        <!-- /product list -->
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="{{asset('/')}}admin/assets/img/icons/filter.svg" alt="img">
                                <span><img src="{{asset('/')}}admin/assets/img/icons/closes.svg" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="{{asset('/')}}admin/assets/img/icons/search-white.svg" alt="img"></a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{asset('/')}}admin/assets/img/icons/pdf.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{asset('/')}}admin/assets/img/icons/excel.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{asset('/')}}admin/assets/img/icons/printer.svg" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Filter -->
                <div class="card" id="filter_inputs">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Class Name">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Class Bname">
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                <div class="form-group">
                                    <a class="btn btn-filters ms-auto"><img src="{{asset('/')}}admin/assets/img/icons/search-whites.svg" alt="img"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table datanew">
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
                            <th>Invno</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th>Action</th>
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
                                    @can('update account_payment')
                                        <a class="me-3" href="{{route('account_payment.edit',$payment->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete account_payment')
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
