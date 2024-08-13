@extends('admin.master')

@section('title','Create New Receive Voucher')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Receive Voucher Add</h4>
                <h6>Create New Receive Voucher</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('account_receive.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Invoice Number</label>
                                <input type="text" name="inv_number">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="tel" name="amount" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 bg-light pt-2 pb-3">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Credit</label>
                                    <input type="number" id="rd_credit" class="form-control mb-2">
                                    <label>Debit</label>
                                    <input type="number" id="rd_debit" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Cheque</label>
                                    <input type="number" id="rd_cheque" class="form-control mb-2">
                                    <label>Cheque Date</label>
                                    <input type="date" id="rd_cheque_date" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Amount</label>
                                    <input type="number" id="rd_amount" class="form-control mb-2">
                                    <label>Reference</label>
                                    <input type="text" id="rd_reference" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12 d-flex align-items-center pt-4">
                                    <button type="button" id="rd_add_btn" class="btn btn-submit"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </div>
                            <input type="hidden" name="receive_details" id="receive_details">
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
                                <textarea name="note"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Publisher</label>
                                <input type="text" value="{{ auth()->user()->name }}" readonly>
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Branch</label>
                                <select name="branch_id" class="form-select">
                                    <option selected disabled>-- select one --</option>
                                    @forelse($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @empty
                                    <option selected disabled>no branch found</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Compnay</label>
                                <select name="company_id" class="form-select">
                                    <option selected disabled>-- select one --</option>
                                    @forelse($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @empty
                                    <option selected disabled>no company found</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
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
    // Retrieve receive details array from localStorage or initialize as empty array
    let receiveDetailsArray = JSON.parse(getCookie('receiveDetailsArray')) || [];
    let count = 1; // Initialize counter for table rows

    // Function to update localStorage and hidden input field with current receive details array
    function updateCookie() {
        setCookie('receiveDetailsArray', JSON.stringify(receiveDetailsArray), 1); // Cookie will expire in 1 days
        $('#receive_details').val(JSON.stringify(receiveDetailsArray));
    }

    // Function to render the receive details table based on current receive details array
    function renderTable() {
        let tableBody = $('table tbody');
        tableBody.empty(); // Clear existing table rows
        count = 1; // Reset row counter
        let totalAmount = 0; // Initialize total amount accumulator

        // If no receive details, display a message row
        if (receiveDetailsArray.length === 0) {
            tableBody.append('<tr><td colspan="8" class="text-center">There are no items in your receive list!</td></tr>');
        } else {
            // Iterate through each receive detail and build table rows
            receiveDetailsArray.forEach(function(receiveDetail, index) {
                let row = '<tr>';
                row += '<td>' + count++ + '</td>'; // Incremental row number
                row += '<td>' + receiveDetail.credit_id + '</td>';
                row += '<td>' + receiveDetail.debit_id + '</td>';
                row += '<td>' + receiveDetail.cheque_id + '</td>';
                row += '<td>' + receiveDetail.cheque_date + '</td>';
                row += '<td>' + receiveDetail.amount + '</td>';
                row += '<td>' + receiveDetail.reference + '</td>';
                row += '<td><a href="javascript:void(0)" class="delete_row text-danger"><i class="fas fa-minus"></i></a></td>'; // Delete row link
                row += '</tr>';
                tableBody.append(row);

                // Accumulate total amount
                totalAmount += parseFloat(receiveDetail.amount);
            });

            // Display total amount row at the bottom of the table
            let totalRow = '<tr><td colspan="4"></td><td><strong>Total:</strong></td><td><strong>&#x9F3;' + totalAmount + '</strong></td><td></td></tr>';
            tableBody.append(totalRow);
        }

        // Update cookies and hidden input field with current receive details array
        updateCookie();
    }

    // Event listener for "Add" button click to add a new receive detail
    $('#rd_add_btn').click(function() {
        // Retrieve values from input fields
        let credit = $('#rd_credit').val();
        let debit = $('#rd_debit').val();
        let cheque = $('#rd_cheque').val();
        let cheque_date = $('#rd_cheque_date').val();
        let amount = $('#rd_amount').val();
        let reference = $('#rd_reference').val();

        // Create a new receive detail object
        let receiveDetail = {
            'credit_id': credit,
            'debit_id': debit,
            'cheque_id': cheque,
            'cheque_date': cheque_date,
            'amount': amount,
            'reference': reference
        };

        // Add the new receive detail to the array and render the table
        receiveDetailsArray.push(receiveDetail);
        renderTable();

        // Clear input fields after adding the data
        $('#rd_credit').val('');
        $('#rd_debit').val('');
        $('#rd_cheque').val('');
        $('#rd_cheque_date').val('');
        $('#rd_amount').val('');
        $('#rd_reference').val('');
    });

    // Event listener for deleting a row by clicking on the delete icon
    $(document).on('click', '.delete_row', function() {
        var rowIndex = $(this).closest('tr').index(); // Get the index of the row to delete
        receiveDetailsArray.splice(rowIndex, 1); // Remove the corresponding receive detail from the array
        renderTable(); // Re-render the table
    });

    // Load existing data from localStorage and render the table on page load
    renderTable();
});
</script>
@endsection
