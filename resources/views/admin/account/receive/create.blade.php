@extends('admin.master')

@section('title',__('Create New Receive Voucher'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Receive Voucher Add')}}</h4>
                <h6>{{__('Create New Receive Voucher')}}</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('account_receive.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            @php
                                $formattedNumber = 'REV-' . now()->format('YmdHis');
                                 $date = date('Y-m-d');
                            @endphp
                            <div class="form-group">
                                <label>{{__('Voucher Number')}}</label>
                                <input type="text" id="revvoucher_no" name="voucher_no" value="{{$formattedNumber}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Date')}}</label>
                                <input type="date" id="revvoucher_date" name="date" class="form-control" value="{{$date}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Received To')}}</label>
                                <select name="received_to" id="received_to" class="form-select">
                                    <option selected disabled>-- select one --</option>
                                    <option value="cash" >Cash</option>
                                    <option value="bank" >Bank</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>{{__('Balance')}}</label>
                                <input type="tel" name="balance" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <label>{{__('Cheque')}}</label>
                            <input type="number" id="rev_cheque"  class="form-control mb-2" readonly>
                            <label>{{__('Cheque Date')}}</label>
                            <input type="date" id="rev_cheque_date" class="form-control" readonly>
                        </div>

                        <div class="col-12 bg-light pt-2 pb-3">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>{{__('Received Form')}}</label>
                                        <select class="form-control nested" name="received_form" id="received_form" >
                                            <option selected="selected" value="">--Select--</option>
                                            <optgroup label="Supplier">
                                                @foreach($suppliers as $supplier)
                                                    <option value="sup-{{$supplier->id}}">sup-{{$supplier->name}}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Customer">
                                                @foreach($customers as $customer)
                                                    <option value="cus-{{$customer->id}}">cus-{{$customer->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>{{__('Balance')}}</label>
                                        <input type="tel" name="balance" id="balance" class="form-control" value="00" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>{{__('Referance')}}</label>
                                        <input type="tel" id="ref" name="ref" class="form-control"  >
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>{{__('Amount')}}</label>
                                        <input type="tel" id="amount" name="amount" class="form-control"  >
                                    </div>
                                </div>
                                {{--                                <div class="col-lg-3 col-sm-6 col-12">--}}
                                {{--                                    <label>Credit</label>--}}
                                {{--                                    <input type="number" id="pd_credit" class="form-control mb-2">--}}
                                {{--                                    <label>Debit</label>--}}
                                {{--                                    <input type="number" id="pd_debit" class="form-control">--}}
                                {{--                                </div>--}}

                                {{--                                <div class="col-lg-3 col-sm-6 col-12">--}}
                                {{--                                    <label>Amount</label>--}}
                                {{--                                    <input type="number" id="pd_amount" class="form-control mb-2">--}}
                                {{--                                    <label>Reference</label>--}}
                                {{--                                    <input type="text" id="pd_reference" class="form-control">--}}
                                {{--                                </div>--}}
                                <div class="col-lg-2 col-sm-6 col-12 d-flex align-items-center pt-4">
                                    <button type="button" id="pd_add_btn" class="btn btn-submit"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </div>
                            <input type="hidden" name="payment_details" id="payment_details">
                        </div>
                        <div class="col-12 mb-4">
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Received')}}</th>
                                    <th>{{__('Received From')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Cheque')}}</th>
                                    <th>{{__('Cheque Date')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Reference')}}</th>
                                    <th><i class="fas fa-trash-alt"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(Session::has('receivedVoucher'))
                                    @foreach(Session::get('receivedVoucher') as $index => $payment)
                                        <tr data-index="{{ $index }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $payment['received_to'] }}</td>
                                            <td>{{ $payment['received_form'] }}</td>
                                            <td>{{ $payment['amount'] }}</td>
                                            <td>{{ $payment['revcheque'] }}</td>
                                            <td>{{ $payment['revcheque_date'] }}</td>
                                            <td>{{ $payment['vou_date'] }}</td>
                                            <td>{{ $payment['ref'] }}</td>
                                            <td><i class="fas fa-trash-alt delete-row" style="cursor:pointer;"></i></td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">{{ __('No Data Available') }}</td>
                                    </tr>
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="3">{{ __('Total') }}</th>
                                    <th colspan="6" id="total-amount">{{ Session::get('revtotalAmount', 0) }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{__('Note')}}</label>
                                <textarea name="note"></textarea>
                            </div>
                        </div>
                        {{--                        <div class="col-lg-4 col-sm-6 col-12">--}}
                        {{--                            <div class="form-group">--}}
                        {{--                                <label>Publisher</label>--}}
                        {{--                                <input type="text" value="{{ auth()->user()->name }}" readonly>--}}
                        {{--                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" required>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="col-lg-4 col-sm-6 col-12">--}}
                        {{--                            <div class="form-group">--}}
                        {{--                                <label>Select Branch</label>--}}
                        {{--                                <select name="branch_id" class="form-select">--}}
                        {{--                                    <option selected disabled>-- select one --</option>--}}
                        {{--                                    @forelse($branches as $branch)--}}
                        {{--                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>--}}
                        {{--                                    @empty--}}
                        {{--                                    <option selected disabled>no branch found</option>--}}
                        {{--                                    @endforelse--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="col-lg-4 col-sm-6 col-12">--}}
                        {{--                            <div class="form-group">--}}
                        {{--                                <label>Select Compnay</label>--}}
                        {{--                                <select name="company_id" class="form-select">--}}
                        {{--                                    <option selected disabled>-- select one --</option>--}}
                        {{--                                    @forelse($companies as $company)--}}
                        {{--                                    <option value="{{ $company->id }}">{{ $company->name }}</option>--}}
                        {{--                                    @empty--}}
                        {{--                                    <option selected disabled>no company found</option>--}}
                        {{--                                    @endforelse--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('account_receive.index')}}" class="btn btn-cancel">Cancel</a>
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
            // Event listener for "Add" button click to add a new payment detail
            $('#pd_add_btn').click(function() {
                // Retrieve values from input fields
                let received_to = $('#received_to').val();
                let received_form = $('#received_form').val();
                let amount = parseFloat($('#amount').val()); // Make sure amount is a number
                let ref = $('#ref').val();
                let revcheque = $('#rev_cheque').val();
                let revcheque_date = $('#rev_cheque_date').val();
                let vou_no = $('#revvoucher_no').val();
                let vou_date = $('#revvoucher_date').val();

                console.log('sarowar');
                $.ajax({
                    url: '{{ route("revstoreSessionData") }}', // Replace with your route
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for security
                        received_to: received_to,
                        received_form: received_form,
                        amount: amount,
                        ref: ref,
                        revcheque: revcheque,
                        revcheque_date: revcheque_date,
                        vou_no: vou_no,
                        vou_date: vou_date
                    },
                    success: function(response) {
                        if(response.success) {
                            // Clear the current table body
                            $('table tbody').empty();

                            // Loop through the returned session data and append it to the table
                            response.data.forEach(function(item, index) {
                                let newRow = `
                        <tr data-index="${ index }">
                            <td>${index + 1}</td>
                            <td>${item.received_to}</td>
                            <td>${item.received_form}</td>
                            <td>${item.amount}</td>
                            <td>${item.revcheque}</td>
                            <td>${item.revcheque_date}</td>
                            <td>${item.vou_date}</td>
                            <td>${item.ref}</td>
                            <td><i class="fas fa-trash-alt delete-row" style="cursor:pointer;"></i></td>
                        </tr>
                    `;
                                $('table tbody').append(newRow);
                            });

                            // Update the total amount displayed in the table
                            $('#total-amount').text(response.totalAmount);
                            // Clear the input fields after appending the data to the table
                            // $('#pay_soruch').val('');
                            $('#received_form').val('');
                            $('#amount').val('');
                            $('#ref').val('');
                            $('#pb_cheque').val('');
                            $('#pb_cheque_date').val('');
                            $('#received_to').val('');
                            // $('#voucher_date').val('');
                        }
                        // console.log('Session data stored successfully!');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error storing session data:', error);
                    }
                });
            });

            $(document).on('click', '.delete-row', function() {
                // Get the row's index
                let row = $(this).closest('tr');
                let index = row.data('index');

                // Send the delete request via AJAX
                $.ajax({
                    url: '{{ route("revdeleteSessionData") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for security
                        index: index
                    },
                    success: function(response) {
                        if(response.success) {
                            // Remove the row from the table
                            row.remove();

                            // Update the total amount displayed in the table
                            $('#total-amount').text(response.totalAmount);

                            // Optionally, re-number the rows
                            $('table tbody tr').each(function(i) {
                                $(this).find('td:first').text(i + 1);
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting session data:', error);
                    }
                });
            });


            // Load existing data from cookies and render the table on page load
            // renderTable();
        });
    </script>
@endsection
