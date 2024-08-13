@extends('admin.master')

@section('title','Bank Transaction Edit')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Bank Transaction Edit</h4>
                <h6>Update Bank Transaction</h6>
            </div>
        </div>
        <!-- /edit -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('transaction.update',$transaction->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Invoice Number</label>
                                <input type="text" name="inv_number" value="{{ $transaction->inv_number }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="tel" name="amount" class="form-control" value="{{ $transaction->amount }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" value="{{ $transaction->date ? \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') : '' }}">
                            </div>
                        </div>
                        <div class="col-12 bg-light pt-2 pb-3">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Credit</label>
                                    <input type="number" id="btd_credit" class="form-control mb-2">
                                    <label>Debit</label>
                                    <input type="number" id="btd_debit" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Cheque</label>
                                    <input type="number" id="btd_cheque" class="form-control mb-2">
                                    <label>Cheque Date</label>
                                    <input type="date" id="btd_cheque_date" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Amount</label>
                                    <input type="number" id="btd_amount" class="form-control mb-2">
                                    <label>Reference</label>
                                    <input type="text" id="btd_reference" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12 d-flex align-items-center pt-4">
                                    <button type="button" id="btd_add_btn" class="btn btn-submit"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </div>
                            <input type="hidden" name="bankTran_details" id="bankTran_details" value="{{ $transaction->details }}">
                        </div>
                        <div class="col-12 mb-4">
                            <table class="table table-bordered table-sm">
                                <thead class="bg-light">
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
                                <textarea name="note">{{ $transaction->note }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Publisher</label>
                                <input type="text" value="{{ $transaction->user->name }}" readonly>
                                <input type="hidden" name="user_id" value="{{ $transaction->user->id }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Branch</label>
                                <select name="branch_id" class="form-select">
                                    @if($transaction->branch_id)
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ $transaction->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
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
                                    @if($transaction->company_id)
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ $transaction->branch_id == $branch->id ? 'selected' : '' }}>{{ $company->name }}</option>
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
                            <a href="{{route('transaction.index')}}" class="btn btn-cancel">Cancel</a>
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
    let journalDetailsArray = JSON.parse($('#bankTran_details').val()) || [];
    let count = 1;

    // Function to render the bankTran details table based on current bankTran details array
    function renderTable() {
        let tableBody = $('table tbody');
        tableBody.empty(); // Clear existing table rows
        count = 1; // Reset row counter
        let totalAmount = 0; // Initialize total amount accumulator

        // If no bankTran details, display a message row
        if (journalDetailsArray.length === 0) {
            tableBody.append('<tr><td colspan="8" class="text-center">There are no items in your transaction list!</td></tr>');
        } else {
            // Iterate through each bankTran detail and build table rows
            journalDetailsArray.forEach(function(journalDetail, index) {
                let row = '<tr>';
                row += '<td>' + count++ + '</td>'; // Incremental row number
                row += '<td>' + journalDetail.credit_id + '</td>';
                row += '<td>' + journalDetail.debit_id + '</td>';
                row += '<td>' + journalDetail.cheque_id + '</td>';
                row += '<td>' + formatDate(journalDetail.cheque_date) + '</td>';
                row += '<td>' + journalDetail.amount + '</td>';
                row += '<td>' + journalDetail.reference + '</td>';
                row += '<td><a href="javascript:void(0)" class="delete_row text-danger"><i class="fas fa-minus"></i></a></td>'; // Delete row link
                row += '</tr>';
                tableBody.append(row);

                // Accumulate total amount
                totalAmount += parseFloat(journalDetail.amount);
            });

            // Display total amount row at the bottom of the table
            let totalRow = '<tr><td colspan="4"></td><td><strong>Total:</strong></td><td><strong>&#x9F3;' + totalAmount + '</strong></td><td></td></tr>';
            tableBody.append(totalRow);

            // Update hidden input field with JSON string of bankTran details array
            $('#journal_details').val(JSON.stringify(journalDetailsArray));
        }
    }

    // Event listener for "Add" button click to add a new bankTran detail
    $('#btd_add_btn').click(function() {
        // Retrieve values from input fields
        let credit = $('#btd_credit').val();
        let debit = $('#btd_debit').val();
        let cheque = $('#btd_cheque').val();
        let cheque_date = $('#btd_cheque_date').val();
        let amount = $('#btd_amount').val();
        let reference = $('#btd_reference').val();

        // Create a new bankTran detail object
        let journalDetail = {
            'credit_id': credit,
            'debit_id': debit,
            'cheque_id': cheque,
            'cheque_date': cheque_date,
            'amount': amount,
            'reference': reference
        };

        // Add the new bankTran detail to the array and render the table
        journalDetailsArray.push(journalDetail);
        renderTable();

        // Clear input fields after adding the data
        $('#btd_credit').val('');
        $('#btd_debit').val('');
        $('#btd_cheque').val('');
        $('#btd_cheque_date').val('');
        $('#btd_amount').val('');
        $('#btd_reference').val('');
    });

    // Event listener for deleting a row by clicking on the delete icon
    $(document).on('click', '.delete_row', function() {
        var rowIndex = $(this).closest('tr').index(); // Get the index of the row to delete
        journalDetailsArray.splice(rowIndex, 1); // Remove the corresponding bankTran detail from the array
        renderTable(); // Re-render the table
        // Update hidden input field with JSON string of bankTran details array
        $('#bankTran_details').val(JSON.stringify(journalDetailsArray));
    });

    // Load existing data from localStorage and render the table on page load
    renderTable();
});
</script>
@endsection
