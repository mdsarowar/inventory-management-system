@extends('admin.master')

@section('title','Create New Bank Transaction')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Bank Transaction Add</h4>
                <h6>Create New Bank Transaction</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('bank_transaction.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Account Number</label>
                                <input type="text" name="account_no">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Account Name</label>
                                <input type="text" name="account_name">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" name="amount" class="form-control" step="any">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Bank Name</label>
                                <input type="text" name="bank_name">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Branch Name</label>
                                <input type="text" name="branch_name">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Currency</label>
                                <select name="currency" class="form-select">
                                    <option value="BDT">Bangladesh (BDT)</option>
                                    <option disabled>----------------------</option>
                                    <option value="AFN">Afghanistan (AFN)</option>
                                    <option value="ALL">Albania (ALL)</option>
                                    <option value="DZD">Algeria (DZD)</option>
                                    <option value="EUR">Andorra (EUR)</option>
                                    <option value="AOA">Angola (AOA)</option>
                                    <option value="XCD">Antigua and Barbuda (XCD)</option>
                                    <option value="ARS">Argentina (ARS)</option>
                                    <option value="AMD">Armenia (AMD)</option>
                                    <option value="AUD">Australia (AUD)</option>
                                    <option value="EUR">Austria (EUR)</option>
                                    <option value="AZN">Azerbaijan (AZN)</option>
                                    <option value="BSD">Bahamas (BSD)</option>
                                    <option value="BHD">Bahrain (BHD)</option>
                                    <option value="BBD">Barbados (BBD)</option>
                                    <option value="BYN">Belarus (BYN)</option>
                                    <option value="EUR">Belgium (EUR)</option>
                                    <option value="BZD">Belize (BZD)</option>
                                    <option value="XOF">Benin (XOF)</option>
                                    <option value="BTN">Bhutan (BTN)</option>
                                    <option value="BOB">Bolivia (BOB)</option>
                                    <option value="BAM">Bosnia and Herzegovina (BAM)</option>
                                    <option value="BWP">Botswana (BWP)</option>
                                    <option value="BRL">Brazil (BRL)</option>
                                    <option value="BND">Brunei (BND)</option>
                                    <option value="BGN">Bulgaria (BGN)</option>
                                    <option value="XOF">Burkina Faso (XOF)</option>
                                    <option value="BIF">Burundi (BIF)</option>
                                    <option value="KHR">Cambodia (KHR)</option>
                                    <option value="XAF">Cameroon (XAF)</option>
                                    <option value="CAD">Canada (CAD)</option>
                                    <option value="CVE">Cape Verde (CVE)</option>
                                    <option value="XAF">Central African Republic (XAF)</option>
                                    <option value="XAF">Chad (XAF)</option>
                                    <option value="CLP">Chile (CLP)</option>
                                    <option value="CNY">China (CNY)</option>
                                    <option value="COP">Colombia (COP)</option>
                                    <option value="KMF">Comoros (KMF)</option>
                                    <option value="XAF">Congo (Brazzaville) (XAF)</option>
                                    <option value="CDF">Congo (Kinshasa) (CDF)</option>
                                    <option value="CRC">Costa Rica (CRC)</option>
                                    <option value="XOF">Côte d'Ivoire (XOF)</option>
                                    <option value="HRK">Croatia (HRK)</option>
                                    <option value="CUP">Cuba (CUP)</option>
                                    <option value="EUR">Cyprus (EUR)</option>
                                    <option value="CZK">Czech Republic (CZK)</option>
                                    <option value="DKK">Denmark (DKK)</option>
                                    <option value="DJF">Djibouti (DJF)</option>
                                    <option value="XCD">Dominica (XCD)</option>
                                    <option value="DOP">Dominican Republic (DOP)</option>
                                    <option value="USD">East Timor (USD)</option>
                                    <option value="USD">Ecuador (USD)</option>
                                    <option value="EGP">Egypt (EGP)</option>
                                    <option value="USD">El Salvador (USD)</option>
                                    <option value="XAF">Equatorial Guinea (XAF)</option>
                                    <option value="ERN">Eritrea (ERN)</option>
                                    <option value="EUR">Estonia (EUR)</option>
                                    <option value="ETB">Ethiopia (ETB)</option>
                                    <option value="FJD">Fiji (FJD)</option>
                                    <option value="EUR">Finland (EUR)</option>
                                    <option value="EUR">France (EUR)</option>
                                    <option value="XAF">Gabon (XAF)</option>
                                    <option value="GMD">Gambia (GMD)</option>
                                    <option value="GEL">Georgia (GEL)</option>
                                    <option value="EUR">Germany (EUR)</option>
                                    <option value="GHS">Ghana (GHS)</option>
                                    <option value="EUR">Greece (EUR)</option>
                                    <option value="XCD">Grenada (XCD)</option>
                                    <option value="GTQ">Guatemala (GTQ)</option>
                                    <option value="GNF">Guinea (GNF)</option>
                                    <option value="XOF">Guinea-Bissau (XOF)</option>
                                    <option value="GYD">Guyana (GYD)</option>
                                    <option value="HTG">Haiti (HTG)</option>
                                    <option value="HNL">Honduras (HNL)</option>
                                    <option value="HUF">Hungary (HUF)</option>
                                    <option value="ISK">Iceland (ISK)</option>
                                    <option value="INR">India (INR)</option>
                                    <option value="IDR">Indonesia (IDR)</option>
                                    <option value="IRR">Iran (IRR)</option>
                                    <option value="IQD">Iraq (IQD)</option>
                                    <option value="EUR">Ireland (EUR)</option>
                                    <option value="ILS">Israel (ILS)</option>
                                    <option value="EUR">Italy (EUR)</option>
                                    <option value="JMD">Jamaica (JMD)</option>
                                    <option value="JPY">Japan (JPY)</option>
                                    <option value="JOD">Jordan (JOD)</option>
                                    <option value="KZT">Kazakhstan (KZT)</option>
                                    <option value="KES">Kenya (KES)</option>
                                    <option value="AUD">Kiribati (AUD)</option>
                                    <option value="KPW">North Korea (KPW)</option>
                                    <option value="KRW">South Korea (KRW)</option>
                                    <option value="KWD">Kuwait (KWD)</option>
                                    <option value="KGS">Kyrgyzstan (KGS)</option>
                                    <option value="LAK">Laos (LAK)</option>
                                    <option value="EUR">Latvia (EUR)</option>
                                    <option value="LBP">Lebanon (LBP)</option>
                                    <option value="LSL">Lesotho (LSL)</option>
                                    <option value="LRD">Liberia (LRD)</option>
                                    <option value="LYD">Libya (LYD)</option>
                                    <option value="CHF">Liechtenstein (CHF)</option>
                                    <option value="EUR">Lithuania (EUR)</option>
                                    <option value="EUR">Luxembourg (EUR)</option>
                                    <option value="MGA">Madagascar (MGA)</option>
                                    <option value="MWK">Malawi (MWK)</option>
                                    <option value="MYR">Malaysia (MYR)</option>
                                    <option value="MVR">Maldives (MVR)</option>
                                    <option value="XOF">Mali (XOF)</option>
                                    <option value="EUR">Malta (EUR)</option>
                                    <option value="USD">Marshall Islands (USD)</option>
                                    <option value="MRU">Mauritania (MRU)</option>
                                    <option value="MUR">Mauritius (MUR)</option>
                                    <option value="MXN">Mexico (MXN)</option>
                                    <option value="USD">Micronesia (USD)</option>
                                    <option value="MDL">Moldova (MDL)</option>
                                    <option value="EUR">Monaco (EUR)</option>
                                    <option value="MNT">Mongolia (MNT)</option>
                                    <option value="EUR">Montenegro (EUR)</option>
                                    <option value="MAD">Morocco (MAD)</option>
                                    <option value="MZN">Mozambique (MZN)</option>
                                    <option value="MMK">Myanmar (MMK)</option>
                                    <option value="NAD">Namibia (NAD)</option>
                                    <option value="AUD">Nauru (AUD)</option>
                                    <option value="NPR">Nepal (NPR)</option>
                                    <option value="EUR">Netherlands (EUR)</option>
                                    <option value="NZD">New Zealand (NZD)</option>
                                    <option value="NIO">Nicaragua (NIO)</option>
                                    <option value="XOF">Niger (XOF)</option>
                                    <option value="NGN">Nigeria (NGN)</option>
                                    <option value="NOK">Norway (NOK)</option>
                                    <option value="OMR">Oman (OMR)</option>
                                    <option value="PKR">Pakistan (PKR)</option>
                                    <option value="USD">Palau (USD)</option>
                                    <option value="PAB">Panama (PAB)</option>
                                    <option value="PGK">Papua New Guinea (PGK)</option>
                                    <option value="PYG">Paraguay (PYG)</option>
                                    <option value="PEN">Peru (PEN)</option>
                                    <option value="PHP">Philippines (PHP)</option>
                                    <option value="PLN">Poland (PLN)</option>
                                    <option value="EUR">Portugal (EUR)</option>
                                    <option value="QAR">Qatar (QAR)</option>
                                    <option value="RON">Romania (RON)</option>
                                    <option value="RUB">Russia (RUB)</option>
                                    <option value="RWF">Rwanda (RWF)</option>
                                    <option value="XCD">Saint Kitts and Nevis (XCD)</option>
                                    <option value="XCD">Saint Lucia (XCD)</option>
                                    <option value="XCD">Saint Vincent and the Grenadines (XCD)</option>
                                    <option value="WST">Samoa (WST)</option>
                                    <option value="EUR">San Marino (EUR)</option>
                                    <option value="STN">Sao Tome and Principe (STN)</option>
                                    <option value="SAR">Saudi Arabia (SAR)</option>
                                    <option value="XOF">Senegal (XOF)</option>
                                    <option value="RSD">Serbia (RSD)</option>
                                    <option value="SCR">Seychelles (SCR)</option>
                                    <option value="SLL">Sierra Leone (SLL)</option>
                                    <option value="SGD">Singapore (SGD)</option>
                                    <option value="EUR">Slovakia (EUR)</option>
                                    <option value="EUR">Slovenia (EUR)</option>
                                    <option value="SBD">Solomon Islands (SBD)</option>
                                    <option value="SOS">Somalia (SOS)</option>
                                    <option value="ZAR">South Africa (ZAR)</option>
                                    <option value="SSP">South Sudan (SSP)</option>
                                    <option value="EUR">Spain (EUR)</option>
                                    <option value="LKR">Sri Lanka (LKR)</option>
                                    <option value="SDG">Sudan (SDG)</option>
                                    <option value="SRD">Suriname (SRD)</option>
                                    <option value="SZL">Swaziland (SZL)</option>
                                    <option value="SEK">Sweden (SEK)</option>
                                    <option value="CHF">Switzerland (CHF)</option>
                                    <option value="SYP">Syria (SYP)</option>
                                    <option value="TWD">Taiwan (TWD)</option>
                                    <option value="TJS">Tajikistan (TJS)</option>
                                    <option value="TZS">Tanzania (TZS)</option>
                                    <option value="THB">Thailand (THB)</option>
                                    <option value="XOF">Togo (XOF)</option>
                                    <option value="TOP">Tonga (TOP)</option>
                                    <option value="TTD">Trinidad and Tobago (TTD)</option>
                                    <option value="TND">Tunisia (TND)</option>
                                    <option value="TRY">Turkey (TRY)</option>
                                    <option value="TMT">Turkmenistan (TMT)</option>
                                    <option value="AUD">Tuvalu (AUD)</option>
                                    <option value="UGX">Uganda (UGX)</option>
                                    <option value="UAH">Ukraine (UAH)</option>
                                    <option value="AED">United Arab Emirates (AED)</option>
                                    <option value="GBP">United Kingdom (GBP)</option>
                                    <option value="USD">United States (USD)</option>
                                    <option value="UYU">Uruguay (UYU)</option>
                                    <option value="UZS">Uzbekistan (UZS)</option>
                                    <option value="VUV">Vanuatu (VUV)</option>
                                    <option value="EUR">Vatican City (EUR)</option>
                                    <option value="VES">Venezuela (VES)</option>
                                    <option value="VND">Vietnam (VND)</option>
                                    <option value="YER">Yemen (YER)</option>
                                    <option value="ZMW">Zambia (ZMW)</option>
                                    <option value="ZWL">Zimbabwe (ZWL)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Transaction Date</label>
                                <input type="date" name="transaction_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="success"
                                           value="success">
                                    <label class="form-check-label" for="success">Success</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="failed"
                                           value="failed">
                                    <label class="form-check-label" for="failed">Failed</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 bg-light pt-2 pb-3">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Credit</label>
                                    <input type="number" id="bt_credit" class="form-control mb-2">
                                    <label>Debit</label>
                                    <input type="number" id="bt_debit" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Cheque</label>
                                    <input type="number" id="bt_cheque" class="form-control mb-2">
                                    <label>Cheque Date</label>
                                    <input type="date" id="bt_cheque_date" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <label>Amount</label>
                                    <input type="number" id="bt_amount" class="form-control mb-2">
                                    <label>Reference</label>
                                    <input type="text" id="bt_reference" class="form-control">
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12 d-flex align-items-center pt-4">
                                    <button type="button" id="bt_add_btn" class="btn btn-submit"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </div>
                            <input type="hidden" name="transaction_details" id="transaction_details">
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
                            <a href="{{route('bank_transaction.index')}}" class="btn btn-cancel">Cancel</a>
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
    // Retrieve transaction details array from cookies or initialize as empty array
    let transactionDetailsArray = JSON.parse(getCookie('transactionDetailsArray')) || [];
    let count = 1; // Initialize counter for table rows

    // Function to update cookies and hidden input field with current transaction details array
    function updateCookie() {
        setCookie('transactionDetailsArray', JSON.stringify(transactionDetailsArray), 1); // Cookie will expire in 1 days
        $('#transaction_details').val(JSON.stringify(transactionDetailsArray));
    }

    // Function to render the transaction details table based on current transactionDetailsArray
    function renderTable() {
        let tableBody = $('table tbody');
        tableBody.empty(); // Clear existing table rows
        count = 1; // Reset row counter
        let totalAmount = 0; // Initialize total amount accumulator

        // If no transaction details, display a message row
        if (transactionDetailsArray.length === 0) {
            tableBody.append('<tr><td colspan="8" class="text-center">There are no items in your transaction list!</td></tr>');
        } else {
            // Iterate through each transaction detail and build table rows
            transactionDetailsArray.forEach(function(transactionDetail, index) {
                let row = '<tr>';
                row += '<td>' + count++ + '</td>'; // Incremental row number
                row += '<td>' + transactionDetail.credit_id + '</td>';
                row += '<td>' + transactionDetail.debit_id + '</td>';
                row += '<td>' + transactionDetail.cheque_id + '</td>';
                row += '<td>' + transactionDetail.cheque_date + '</td>';
                row += '<td>' + transactionDetail.amount + '</td>';
                row += '<td>' + transactionDetail.reference + '</td>';
                row += '<td><a href="javascript:void(0)" class="delete_row text-danger"><i class="fas fa-minus"></i></a></td>'; // Delete row link
                row += '</tr>';
                tableBody.append(row);

                // Accumulate total amount
                totalAmount += parseFloat(transactionDetail.amount);
            });

            // Display total amount row at the bottom of the table
            let totalRow = '<tr><td colspan="4"></td><td><strong>Total:</strong></td><td><strong>&#x9F3;' + totalAmount + '</strong></td><td></td></tr>';
            tableBody.append(totalRow);
        }

        // Update cookies and hidden input field with current transaction details array
        updateCookie();
    }

    // Event listener for "Add" button click to add a new transaction detail
    $('#bt_add_btn').click(function() {
        // Retrieve values from input fields
        let credit = $('#bt_credit').val();
        let debit = $('#bt_debit').val();
        let cheque = $('#bt_cheque').val();
        let cheque_date = $('#bt_cheque_date').val();
        let amount = $('#bt_amount').val();
        let reference = $('#bt_reference').val();

        // Create a new transaction detail object
        let transactionDetail = {
            'credit_id': credit,
            'debit_id': debit,
            'cheque_id': cheque,
            'cheque_date': cheque_date,
            'amount': amount,
            'reference': reference
        };

        // Add the new transaction detail to the array and render the table
        transactionDetailsArray.push(transactionDetail);
        renderTable();

        // Clear input fields after adding the data
        $('#bt_credit').val('');
        $('#bt_debit').val('');
        $('#bt_cheque').val('');
        $('#bt_cheque_date').val('');
        $('#bt_amount').val('');
        $('#bt_reference').val('');
    });

    // Event listener for deleting a row by clicking on the delete icon
    $(document).on('click', '.delete_row', function() {
        var rowIndex = $(this).closest('tr').index(); // Get the index of the row to delete
        transactionDetailsArray.splice(rowIndex, 1); // Remove the corresponding transaction detail from the array
        renderTable(); // Re-render the table
    });

    // Load existing data from cookies and render the table on page load
    renderTable();
});
</script>
@endsection
