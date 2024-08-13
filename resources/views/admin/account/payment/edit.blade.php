@extends('admin.master')

@section('title','Payment Voucher Edit')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Payment Voucher Edit</h4>
                <h6>Update Payment Voucher</h6>
            </div>
        </div>
        <!-- /edit -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('account_payment.update',$payment->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Invoice Number</label>
                                <input type="text" name="inv_number" value="{{ $payment->inv_number }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="tel" name="amount" class="form-control" value="{{ $payment->amount }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" value="{{ !empty($payment->date) ? \Carbon\Carbon::parse($payment->date)->format('Y-m-d') : '' }}">
                            </div>
                        </div>
                        <div class="col-12 bg-light pt-2 pb-3">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Credit</label>
                                    <input type="number" id="pd_credit" class="form-control mb-2">
                                    <label>Debit</label>
                                    <input type="number" id="pd_debit" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Cheque</label>
                                    <input type="number" id="pd_cheque" class="form-control mb-2">
                                    <label>Cheque Date</label>
                                    <input type="date" id="pd_cheque_date" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Amount</label>
                                    <input type="number" id="pd_amount" class="form-control mb-2">
                                    <label>Reference</label>
                                    <input type="text" id="pd_reference" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12 d-flex align-items-center pt-4">
                                    <button type="button" id="pd_add_btn" class="btn btn-submit"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </div>
                            <input type="hidden" name="payment_details" id="payment_details" value="{{ $payment->details }}">
                        </div>
                        <div class="col-12 mb-4">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Credit</th>
                                        <th>Debit</th>
                                        <th>Cheque</th>
                                        <th>Cheque Date</th>
                                        <th>Amount</th>
                                        <th>Reference</th>
                                        <th><i class="fas fa-trash-alt"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Note</label>
                                <textarea name="note">{{ $payment->note }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Publisher</label>
                                <input type="text" value="{{ $payment->user->name }}" readonly>
                                <input type="hidden" name="user_id" value="{{ $payment->user->id }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Branch</label>
                                <select name="branch_id" class="form-select">
                                    @if($payment->branch_id)
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ $payment->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                        @endforeach
                                    @else
                                        <option selected disabled>-- select one --</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Compnay</label>
                                <select name="company_id" class="form-select">
                                    @if($payment->company_id)
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ $payment->branch_id == $branch->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                        @endforeach
                                    @else
                                        <option selected disabled>-- select one --</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('account_payment.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!-- /edit -->
    </div>
@endsection
@section('js')
<script>
$(document).ready(function() {
    let paymentDetailsArray = JSON.parse($('#payment_details').val()) || [];
    let count = 1;

    // Function to render the payment details table based on current payment details array
    function renderTable() {
        let tableBody = $('table tbody');
        tableBody.empty(); // Clear existing table rows
        count = 1; // Reset row counter
        let totalAmount = 0; // Initialize total amount accumulator

        // If no payment details, display a message row
        if (paymentDetailsArray.length === 0) {
            tableBody.append('<tr><td colspan="8" class="text-center">There are no items in your payment list!</td></tr>');
        } else {
            // Iterate through each payment detail and build table rows
            paymentDetailsArray.forEach(function(paymentDetail, index) {
                let row = '<tr>';
                row += '<td>' + count++ + '</td>'; // Incremental row number
                row += '<td>' + paymentDetail.credit_id + '</td>';
                row += '<td>' + paymentDetail.debit_id + '</td>';
                row += '<td>' + paymentDetail.cheque_id + '</td>';
                row += '<td>' + formatDate(paymentDetail.cheque_date) + '</td>';
                row += '<td>' + paymentDetail.amount + '</td>';
                row += '<td>' + paymentDetail.reference + '</td>';
                row += '<td><a href="javascript:void(0)" class="delete_row text-danger"><i class="fas fa-minus"></i></a></td>'; // Delete row link
                row += '</tr>';
                tableBody.append(row);

                // Accumulate total amount
                totalAmount += parseFloat(paymentDetail.amount);
            });

            // Display total amount row at the bottom of the table
            let totalRow = '<tr><td colspan="4"></td><td><strong>Total:</strong></td><td><strong>&#x9F3;' + totalAmount + '</strong></td><td></td></tr>';
            tableBody.append(totalRow);

            // Update hidden input field with JSON string of payment details array
            $('#payment_details').val(JSON.stringify(paymentDetailsArray));
        }
    }

    // Event listener for "Add" button click to add a new payment detail
    $('#pd_add_btn').click(function() {
        let credit = $('#pd_credit').val();
        let debit = $('#pd_debit').val();
        let cheque = $('#pd_cheque').val();
        let cheque_date = $('#pd_cheque_date').val();
        let amount = $('#pd_amount').val();
        let reference = $('#pd_reference').val();

        // Create a new payment detail object
        let paymentDetail = {
            'credit_id': credit,
            'debit_id': debit,
            'cheque_id': cheque,
            'cheque_date': cheque_date,
            'amount': amount,
            'reference': reference
        };

        // Add the new payment detail to the array and render the table
        paymentDetailsArray.push(paymentDetail);
        renderTable();

        // Clear input fields after adding the data
        $('#pd_credit').val('');
        $('#pd_debit').val('');
        $('#pd_cheque').val('');
        $('#pd_cheque_date').val('');
        $('#pd_amount').val('');
        $('#pd_reference').val('');
    });

    // Event listener for deleting a row by clicking on the delete icon
    $(document).on('click', '.delete_row', function() {
        var rowIndex = $(this).closest('tr').index(); // Get the index of the row to delete
        paymentDetailsArray.splice(rowIndex, 1); // Remove the corresponding payment detail from the array
        renderTable(); // Re-render the table
        // Update hidden input field with JSON string of payment details array
        $('#payment_details').val(JSON.stringify(paymentDetailsArray));
    });

    // Load existing data from localStorage and render the table on page load
    renderTable();
});
</script>
@endsection
