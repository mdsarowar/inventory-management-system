@extends('admin.master')

@section('title','Create New Journal')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Journal Add</h4>
                <h6>Create New Journal</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('journal.store')}}" method="post">
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
                                    <input type="number" id="jd_credit" class="form-control mb-2">
                                    <label>Debit</label>
                                    <input type="number" id="jd_debit" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Cheque</label>
                                    <input type="number" id="jd_cheque" class="form-control mb-2">
                                    <label>Cheque Date</label>
                                    <input type="date" id="jd_cheque_date" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Amount</label>
                                    <input type="number" id="jd_amount" class="form-control mb-2">
                                    <label>Reference</label>
                                    <input type="text" id="jd_reference" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12 d-flex align-items-center pt-4">
                                    <button type="button" id="jd_add_btn" class="btn btn-submit"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </div>
                            <input type="hidden" name="journal_details" id="journal_details">
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
                                <textarea name="note" id="summernote"></textarea>
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
                            <a href="{{route('journal.index')}}" class="btn btn-cancel">Cancel</a>
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
    // Retrieve journal details array from localStorage or initialize as empty array
    let journalDetailsArray = JSON.parse(getCookie('journalDetailsArray')) || [];
    let count = 1; // Initialize counter for table rows

    // Function to update localStorage and hidden input field with current journal details array
    function updateCookie() {
        setCookie('journalDetailsArray', JSON.stringify(journalDetailsArray), 1); // Cookie will expire in 1 days
        $('#journal_details').val(JSON.stringify(journalDetailsArray));
    }

    // Function to render the journal details table based on current journal details array
    function renderTable() {
        let tableBody = $('table tbody');
        tableBody.empty(); // Clear existing table rows
        count = 1; // Reset row counter
        let totalAmount = 0; // Initialize total amount accumulator

        // If no journal details, display a message row
        if (journalDetailsArray.length === 0) {
            tableBody.append('<tr><td colspan="8" class="text-center">There are no items in your journal list!</td></tr>');
        } else {
            // Iterate through each journal detail and build table rows
            journalDetailsArray.forEach(function(journalDetail, index) {
                let row = '<tr>';
                row += '<td>' + count++ + '</td>'; // Incremental row number
                row += '<td>' + journalDetail.credit_id + '</td>';
                row += '<td>' + journalDetail.debit_id + '</td>';
                row += '<td>' + journalDetail.cheque_id + '</td>';
                row += '<td>' + journalDetail.cheque_date + '</td>';
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
        }

        // Update cookies and hidden input field with current journal details array
        updateCookie();
    }

    // Event listener for "Add" button click to add a new journal detail
    $('#jd_add_btn').click(function() {
        // Retrieve values from input fields
        let credit = $('#jd_credit').val();
        let debit = $('#jd_debit').val();
        let cheque = $('#jd_cheque').val();
        let cheque_date = $('#jd_cheque_date').val();
        let amount = $('#jd_amount').val();
        let reference = $('#jd_reference').val();

        // Create a new journal detail object
        let journalDetail = {
            'credit_id': credit,
            'debit_id': debit,
            'cheque_id': cheque,
            'cheque_date': cheque_date,
            'amount': amount,
            'reference': reference
        };

        // Add the new journal detail to the array and render the table
        journalDetailsArray.push(journalDetail);
        renderTable();

        // Clear input fields after adding the data
        $('#jd_credit').val('');
        $('#jd_debit').val('');
        $('#jd_cheque').val('');
        $('#jd_cheque_date').val('');
        $('#jd_amount').val('');
        $('#jd_reference').val('');
    });

    // Event listener for deleting a row by clicking on the delete icon
    $(document).on('click', '.delete_row', function() {
        var rowIndex = $(this).closest('tr').index(); // Get the index of the row to delete
        journalDetailsArray.splice(rowIndex, 1); // Remove the corresponding journal detail from the array
        renderTable(); // Re-render the table
    });

    // Load existing data from localStorage and render the table on page load
    renderTable();
});
</script>
@endsection
