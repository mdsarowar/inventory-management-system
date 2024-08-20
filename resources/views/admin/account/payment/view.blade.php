@extends('admin.master')
@section('title',__('Payment Voucher View'))
@section('custom_css')
    <style>
        /* invoice print */
        img.invoice_logo {
            width: 125px;
        }
        div.signature_border {
            border-top: 1px solid #9d9d9d;
            width: 150px;
            text-align: center;
        }
        @media print {
            #invoice_print_content {
                color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
        .text_left {
            text-align: left;
        }
    </style>
@endsection
@section('content')

    <div class="content pt-0">
        <!-- /add -->
        <div class="row mt-2">
          <div class="col-md-6 d-flex align-items-center">
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-primary me-2"  data-bs-toggle="modal" data-bs-target="#print_receipt_modal">Invoice</button>
                <button type="button" class="btn btn-primary me-2"  data-bs-toggle="modal" data-bs-target="#print_receipt_modal_calan">Calan</button>
                <button type="button" class="btn btn-primary me-2"  data-bs-toggle="modal" data-bs-target="#print_receipt_modal_pad">Pad</button>
{{--                <button type="button" class="btn btn-secondary">Calan</button>--}}
            </div>
        </div>
        <div class="row">
            <div class="modal-body bg-light rounded pb-0">
                <div class="row" >
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-4">
                                            <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/logo.png" class="img-fluid invoice_logo mb-2">
                                            <h6 class="text-dark">{{__('Sales Tax Invoice')}}</h6>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column align-items-end">
                                            <h2 class="text-dark mb-2 mt-md-2">{{__('Invoice')}} #{{$payment->inv_number}}</h2>
                                            <ul class="list list-unstyled mb-0">
                                                <li>{{__('Date:')}} <span id="invoice_modal_date">{{$payment->date}}</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="text-center">{{__('PAYMENT VOUCHER')}}</h3>
                                        <hr>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead>
                                        <tr>
                                            <th class="text_left">Head of Accounts</th>
                                            <th>Mode</th>
                                            <th>Cheque</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Reference</th>
                                        </tr>
                                        </thead>
                                        <tbody id="invoice_modal_items_table">
                                        @php
                                            $totalAmount = 0;
                                        @endphp
                                        @foreach($details as $detail)
                                            @php
                                                $totalAmount += $detail->amount;
                                                $sup = explode("-", $detail->payto);
                                                   if (isset($sup[1])) {
                                                        if ($sup[0] == 'sup') {
                                                            $name = \App\Models\Supplier::find($sup[1]);
                                                        } else {
                                                            $name = \App\Models\Customer::find($sup[1]);
                                                        }
                                                    } else {
                                                        $name = null;
                                                    }
                                            @endphp
                                            <tr>
                                                <td class="text_left">{{ $name ? $name->name : ''  }}</td>
                                                <td>{{ $detail->sourch }}</td>
                                                <td>{{ $detail->cheque_id }}</td>
                                                <td>{{ $detail->cheque_date }}</td>
                                                <td>{{ number_format($detail->amount, 2) }}</td>
                                                <td>{{ $detail->reference }}</td>
                                            </tr>
                                        @endforeach
                                        <tr >
                                            <td colspan="4" class="text_right"><strong>Total Taka:</strong></td>
                                            <td><strong>{{ number_format($totalAmount, 2) }}</strong></td>
                                            <td></td> <!-- Empty cell for alignment with table structure -->
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div class="card-body mt-lg-5" style="height: 100px">

                            </div>
                            <div class="card-body mt-lg-5">
                                <div class="d-flex justify-content-between">
                                    <div class="signature_border">
                                        <small>{{__('Received By')}}</small>
                                    </div>
                                    <div class="signature_border">
                                        <small>{{__('Prepared By')}}</small>
                                    </div>
                                    <div class="signature_border">
                                        <small>{{__('Checked By')}}</small>
                                    </div>
                                    <div class="signature_border">
                                        <small>{{__('Approved By')}}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-light text-muted d-flex flex-column align-items-center">
                                <small>{{__('If you have any questions concerning this invoice, feel free to contact us:
                                    0123456789 or support@smce.com')}}</small>
                                <small>{{__('Thank you for your purchasing.')}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--        <div class="row">--}}
        {{--            <div class="col-md-6">--}}
        {{--                <aside class="product-order-list">--}}
        {{--                    <div class="head text-center">--}}
        {{--                        <h6 class="text-muted mb-0">No IMEI/Serial Information!</h6>--}}
        {{--                    </div>--}}
        {{--                    <div class="btn-row d-flex align-items-center justify-content-between mt-3">--}}
        {{--                        <button type="button" class="btn btn-danger btn-lg flex-fill" id="destroy_all_ssn_btn"><i class="fas fa-trash-alt"></i> Empty</button>--}}

        {{--                        <!-- update this button -->--}}
{{--                                <button type="button" class="btn btn-success btn-lg flex-fill" data-bs-toggle="modal" data-bs-target="#print_receipt_modal"><i class="fas fa-credit-card"></i> Checkout</button>--}}
        {{--                        <!-- update this button -->--}}

        {{--                    </div>--}}
        {{--                </aside>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <!-- /add -->
    </div>

    <!-- add this new modal for print -->
    <!-- print receipt modal -->
    <div class="modal fade" id="print_receipt_modal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Print Invoice</h5>
                    <button type="button" class="btn btn-primary" id="invoice_print_btn">Print</button>
                </div>
                <div class="modal-body bg-light rounded pb-0">
                    <div class="row" id="invoice_print_content">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-4">
                                                <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/logo.png" class="img-fluid invoice_logo mb-2">
                                                <h6 class="text-dark">{{__('Sales Tax Invoice')}}</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column align-items-end">
                                                <h2 class="text-dark mb-2 mt-md-2">{{__('Invoice')}} #{{$payment->inv_number}}</h2>
                                                <ul class="list list-unstyled mb-0">
                                                    <li>{{__('Date:')}} <span id="invoice_modal_date">{{$payment->date}}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="text-center">{{__('PAYMENT VOUCHER')}}</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    {{--                                <div class="row mb-3">--}}

                                    {{--                                    <div class="col-sm-6">--}}
                                    {{--                                        <h5 class="my-2">Vendor</h5>--}}
                                    {{--                                        @if(empty($purchas->wkname))--}}
                                    {{--                                            <ul class="list list-unstyled mb-0 text-left">--}}
                                    {{--                                                <li><i class="far fa-user"></i> {{$supplier->name}}</li>--}}
                                    {{--                                                <li><i class="far fa-envelope"></i> {{$supplier->email}}</li>--}}
                                    {{--                                                <li><i class="fas fa-phone-alt"></i>{{$supplier->mobile}}</li>--}}
                                    {{--                                                --}}{{--                                                <li><i class="fas fa-map-marker-alt"></i> {{$supplier->address}}</li>--}}
                                    {{--                                            </ul>--}}
                                    {{--                                        @else--}}
                                    {{--                                            <ul class="list list-unstyled mb-0 text-left">--}}
                                    {{--                                                <li><i class="far fa-user"></i> {{$purchas->wkname}}</li>--}}
                                    {{--                                                <li><i class="far fa-envelope"></i> {{$purchas->wkemail}}</li>--}}
                                    {{--                                                <li><i class="fas fa-phone-alt"></i>{{$purchas->wkphone}}</li>--}}
                                    {{--                                                --}}{{--                                                <li><i class="fas fa-map-marker-alt"></i> {{$purchas->wkaddress}}</li>--}}
                                    {{--                                            </ul>--}}
                                    {{--                                        @endif--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="col-sm-6">--}}
                                    {{--                                        <h5 class="my-2">Address</h5>--}}
                                    {{--                                        @if(empty($purchas->wkname))--}}
                                    {{--                                            <ul class="list list-unstyled mb-0 text-left">--}}
                                    {{--                                                <li><i class="fas fa-map-marker-alt"></i> {{$supplier->address}}</li>--}}
                                    {{--                                            </ul>--}}
                                    {{--                                        @else--}}
                                    {{--                                            <ul class="list list-unstyled mb-0 text-left">--}}
                                    {{--                                                <li><i class="fas fa-map-marker-alt"></i> {{$purchas->wkaddress}}</li>--}}
                                    {{--                                            </ul>--}}
                                    {{--                                        @endif--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead>
                                            <tr>
                                                <th class="text_left">Head of Accounts</th>
                                                <th>Mode</th>
                                                <th>Cheque</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Reference</th>
                                            </tr>
                                            </thead>
                                            <tbody id="invoice_modal_items_table">
                                            @php
                                                $totalAmount = 0;
                                            @endphp
                                            @foreach($details as $detail)
                                                @php
                                                    $totalAmount += $detail->amount;
                                                    $sup = explode("-", $detail->payto);
                                                       if (isset($sup[1])) {
                                                            if ($sup[0] == 'sup') {
                                                                $name = \App\Models\Supplier::find($sup[1]);
                                                            } else {
                                                                $name = \App\Models\Customer::find($sup[1]);
                                                            }
                                                        } else {
                                                            $name = null;
                                                        }
                                                @endphp
                                                <tr>
                                                    <td class="text_left">{{ $name ? $name->name : ''  }}</td>
                                                    <td>{{ $detail->sourch }}</td>
                                                    <td>{{ $detail->cheque_id }}</td>
                                                    <td>{{ $detail->cheque_date }}</td>
                                                    <td>{{ number_format($detail->amount, 2) }}</td>
                                                    <td>{{ $detail->reference }}</td>
                                                </tr>
                                            @endforeach
                                            <tr >
                                                <td colspan="4" class="text_right"><strong>Total Taka:</strong></td>
                                                <td><strong>{{ number_format($totalAmount, 2) }}</strong></td>
                                                <td></td> <!-- Empty cell for alignment with table structure -->
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div class="card-body mt-lg-5" style="height: 100px">

                                </div>
                                <div class="card-body mt-lg-5">
                                    <div class="d-flex justify-content-between">
                                        <div class="signature_border">
                                            <small>{{__('Received By')}}</small>
                                        </div>
                                        <div class="signature_border">
                                            <small>{{__('Prepared By')}}</small>
                                        </div>
                                        <div class="signature_border">
                                            <small>{{__('Checked By')}}</small>
                                        </div>
                                        <div class="signature_border">
                                            <small>{{__('Approved By')}}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-light text-muted d-flex flex-column align-items-center">
                                    <small>{{__('If you have any questions concerning this invoice, feel free to contact us:
                                    0123456789 or support@smce.com')}}</small>
                                    <small>{{__('Thank you for your purchasing.')}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    </div>--}}

    <div class="modal fade" id="print_receipt_modal_calan" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Print calan</h5>
                    <button type="button" class="btn btn-primary" id="invoice_print_btn_calan">Print</button>
                </div>
                <div class="modal-body bg-light rounded pb-0">
                    <div class="row" id="invoice_print_calan">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-4">
                                                <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/logo.png" class="img-fluid invoice_logo mb-2">
                                                <h6 class="text-dark">{{__('Sales Tax Invoice')}}</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column align-items-end">
                                                <h2 class="text-dark mb-2 mt-md-2">{{__('Invoice')}} #{{$payment->inv_number}}</h2>
                                                <ul class="list list-unstyled mb-0">
                                                    <li>{{__('Date:')}} <span id="invoice_modal_date">{{$payment->date}}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="text-center">{{__('PAYMENT VOUCHER')}}</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    {{--                                <div class="row mb-3">--}}

                                    {{--                                    <div class="col-sm-6">--}}
                                    {{--                                        <h5 class="my-2">Vendor</h5>--}}
                                    {{--                                        @if(empty($purchas->wkname))--}}
                                    {{--                                            <ul class="list list-unstyled mb-0 text-left">--}}
                                    {{--                                                <li><i class="far fa-user"></i> {{$supplier->name}}</li>--}}
                                    {{--                                                <li><i class="far fa-envelope"></i> {{$supplier->email}}</li>--}}
                                    {{--                                                <li><i class="fas fa-phone-alt"></i>{{$supplier->mobile}}</li>--}}
                                    {{--                                                --}}{{--                                                <li><i class="fas fa-map-marker-alt"></i> {{$supplier->address}}</li>--}}
                                    {{--                                            </ul>--}}
                                    {{--                                        @else--}}
                                    {{--                                            <ul class="list list-unstyled mb-0 text-left">--}}
                                    {{--                                                <li><i class="far fa-user"></i> {{$purchas->wkname}}</li>--}}
                                    {{--                                                <li><i class="far fa-envelope"></i> {{$purchas->wkemail}}</li>--}}
                                    {{--                                                <li><i class="fas fa-phone-alt"></i>{{$purchas->wkphone}}</li>--}}
                                    {{--                                                --}}{{--                                                <li><i class="fas fa-map-marker-alt"></i> {{$purchas->wkaddress}}</li>--}}
                                    {{--                                            </ul>--}}
                                    {{--                                        @endif--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="col-sm-6">--}}
                                    {{--                                        <h5 class="my-2">Address</h5>--}}
                                    {{--                                        @if(empty($purchas->wkname))--}}
                                    {{--                                            <ul class="list list-unstyled mb-0 text-left">--}}
                                    {{--                                                <li><i class="fas fa-map-marker-alt"></i> {{$supplier->address}}</li>--}}
                                    {{--                                            </ul>--}}
                                    {{--                                        @else--}}
                                    {{--                                            <ul class="list list-unstyled mb-0 text-left">--}}
                                    {{--                                                <li><i class="fas fa-map-marker-alt"></i> {{$purchas->wkaddress}}</li>--}}
                                    {{--                                            </ul>--}}
                                    {{--                                        @endif--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead>
                                            <tr>
                                                <th class="text_left">Head of Accounts</th>
                                                <th>Mode</th>
                                                <th>Cheque</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Reference</th>
                                            </tr>
                                            </thead>
                                            <tbody id="invoice_modal_items_table">
                                            @php
                                                $totalAmount = 0;
                                            @endphp
                                            @foreach($details as $detail)
                                                @php
                                                    $totalAmount += $detail->amount;
                                                    $sup = explode("-", $detail->payto);
                                                       if (isset($sup[1])) {
                                                            if ($sup[0] == 'sup') {
                                                                $name = \App\Models\Supplier::find($sup[1]);
                                                            } else {
                                                                $name = \App\Models\Customer::find($sup[1]);
                                                            }
                                                        } else {
                                                            $name = null;
                                                        }
                                                @endphp
                                                <tr>
                                                    <td class="text_left">{{ $name ? $name->name : ''  }}</td>
                                                    <td>{{ $detail->sourch }}</td>
                                                    <td>{{ $detail->cheque_id }}</td>
                                                    <td>{{ $detail->cheque_date }}</td>
                                                    <td>{{ number_format($detail->amount, 2) }}</td>
                                                    <td>{{ $detail->reference }}</td>
                                                </tr>
                                            @endforeach
                                            <tr >
                                                <td colspan="4" class="text_right"><strong>Total Taka:</strong></td>
                                                <td><strong>{{ number_format($totalAmount, 2) }}</strong></td>
                                                <td></td> <!-- Empty cell for alignment with table structure -->
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div class="card-body mt-lg-5" style="height: 100px">

                                </div>
                                <div class="card-body mt-lg-5">
                                    <div class="d-flex justify-content-between">
                                        <div class="signature_border">
                                            <small>{{__('Received By')}}</small>
                                        </div>
                                        <div class="signature_border">
                                            <small>{{__('Prepared By')}}</small>
                                        </div>
                                        <div class="signature_border">
                                            <small>{{__('Checked By')}}</small>
                                        </div>
                                        <div class="signature_border">
                                            <small>{{__('Approved By')}}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-light text-muted d-flex flex-column align-items-center">
                                    <small>{{__('If you have any questions concerning this invoice, feel free to contact us:
                                    0123456789 or support@smce.com')}}</small>
                                    <small>{{__('Thank you for your purchasing.')}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="print_receipt_modal_pad" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Voucher</h5>
                    <button type="button" class="btn btn-primary" id="invoice_print_btn_pad">Print</button>
                </div>
                <div class="modal-body bg-light rounded pb-0">
                    <div class="row" id="invoice_print_pad">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row" style="height: 400px">

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="text-center">{{__('PAYMENT VOUCHER')}}</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead>
                                            <tr>
                                                <th class="text_left">Head of Accounts</th>
                                                <th>Mode</th>
                                                <th>Cheque</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Reference</th>
                                            </tr>
                                            </thead>
                                            <tbody id="invoice_modal_items_table">
                                            @php
                                                $totalAmount = 0;
                                            @endphp
                                            @foreach($details as $detail)
                                                @php
                                                    $totalAmount += $detail->amount;
                                                    $sup = explode("-", $detail->payto);
                                                       if (isset($sup[1])) {
                                                            if ($sup[0] == 'sup') {
                                                                $name = \App\Models\Supplier::find($sup[1]);
                                                            } else {
                                                                $name = \App\Models\Customer::find($sup[1]);
                                                            }
                                                        } else {
                                                            $name = null;
                                                        }
                                                @endphp
                                                <tr>
                                                    <td class="text_left">{{ $name ? $name->name : ''  }}</td>
                                                    <td>{{ $detail->sourch }}</td>
                                                    <td>{{ $detail->cheque_id }}</td>
                                                    <td>{{ $detail->cheque_date }}</td>
                                                    <td>{{ number_format($detail->amount, 2) }}</td>
                                                    <td>{{ $detail->reference }}</td>
                                                </tr>
                                            @endforeach
                                            <tr >
                                                <td colspan="4" class="text_right"><strong>Total Taka:</strong></td>
                                                <td><strong>{{ number_format($totalAmount, 2) }}</strong></td>
                                                <td></td> <!-- Empty cell for alignment with table structure -->
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div class="card-body mt-lg-5" style="height: 100px">

                                </div>
                                <div class="card-body mt-lg-5">
                                    <div class="d-flex justify-content-between">
                                        <div class="signature_border">
                                            <small>{{__('Received By')}}</small>
                                        </div>
                                        <div class="signature_border">
                                            <small>{{__('Prepared By')}}</small>
                                        </div>
                                        <div class="signature_border">
                                            <small>{{__('Checked By')}}</small>
                                        </div>
                                        <div class="signature_border">
                                            <small>{{__('Approved By')}}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-light text-muted d-flex flex-column align-items-center">
                                    <small>{{__('If you have any questions concerning this invoice, feel free to contact us:
                                    0123456789 or support@smce.com')}}</small>
                                    <small>{{__('Thank you for your purchasing.')}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('admin/assets/js/printThis.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#invoice_print_btn").click(function() {
                $("#invoice_print_content").printThis({
                    importCSS: true,
                    importStyle: true,
                    pageTitle: "Invoice",
                    printDelay: 1000,
                    canvas: true
                });
            });
            $("#invoice_print_btn_calan").click(function() {
                $("#invoice_print_calan").printThis({
                    importCSS: true,
                    importStyle: true,
                    pageTitle: "Invoice",
                    printDelay: 1000,
                    canvas: true
                });
            });
            $("#invoice_print_btn_pad").click(function() {
                $("#invoice_print_pad").printThis({
                    importCSS: true,
                    importStyle: true,
                    pageTitle: "Invoice",
                    printDelay: 1000,
                    canvas: true
                });
            });
        });
    </script>
@endsection
