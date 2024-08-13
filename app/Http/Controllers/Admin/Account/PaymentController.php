<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\AccountPayment;
use App\Models\AccountPaymentDetails;
use App\Models\Branch;
use App\Models\Company;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view accountpayment'),403,__('User does not have the right permissions.'));
        return view('admin.account.payment.index', [
            'payments' => AccountPayment::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create accountpayment'),403,__('User does not have the right permissions.'));
        return view('admin.account.payment.create', [
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('create accountpayment'),403,__('User does not have the right permissions.'));
        // Create or update the main AccountPayment
        $store = AccountPayment::createOrUpdatePayment($request);

        // Extract payment details from the hidden input field
        try {
            $paymentDetails = json_decode($request->payment_details, true);
            if (!empty($paymentDetails)) {
                foreach ($paymentDetails as $detail) {
                    $paymentDetail = new AccountPaymentDetails();
                    $paymentDetail->payment_id      = $store->id;
                    $paymentDetail->inv_number      = $store->inv_number ?? null;
                    $paymentDetail->note            = $store->note ?? null;
                    $paymentDetail->credit_id       = $detail['credit_id'] ?? null;
                    $paymentDetail->debit_id        = $detail['debit_id'] ?? null;
                    $paymentDetail->amount          = $detail['amount'] ?? null;
                    $paymentDetail->reference       = $detail['reference'] ?? null;
                    $paymentDetail->date            = $store->date ?? null;
                    $paymentDetail->cheque_id       = $detail['cheque_id'] ?? null;
                    $paymentDetail->cheque_date     = !empty($detail['cheque_date']) ? $detail['cheque_date'] : null;
                    $paymentDetail->user_id         = $store->user_id ?? null;
                    $paymentDetail->branch_id       = $store->branch_id ?? null;
                    $paymentDetail->company_id      = $store->company_id ?? null;
                    $paymentDetail->save();
                }
            }

            // Clear payment details array from cookies after successfully stored
            Cookie::queue(Cookie::forget('paymentDetailsArray'));

            return redirect()->route('account_payment.index')->with('success', 'Payment voucher created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the payment voucher.');
        }

        return redirect()->route('account_payment.index')->with('success','Payment voucher create successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!auth()->user()->can('update accountpayment'),403,__('User does not have the right permissions.'));
        return view('admin.account.payment.edit',[
            'payment'=>AccountPayment::find($id),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update accountpayment'),403,__('User does not have the right permissions.'));
        $update = AccountPayment::createOrUpdatePayment($request,$id);

        // Extract payment details from the hidden input field
        try {
            $paymentDetails = json_decode($request->payment_details, true);
            // Delete existing payment details for this payment
            $update->details()->delete();
            if (!empty($paymentDetails)) {
                // Insert updated payment details
                foreach ($paymentDetails as $detail) {
                    $paymentDetail = new AccountPaymentDetails();
                    $paymentDetail->fill([
                        'payment_id' => $update->id,
                        'inv_number' => $update->inv_number ?? null,
                        'note' => $update->note ?? null,
                        'credit_id' => $detail['credit_id'] ?? null,
                        'debit_id' => $detail['debit_id'] ?? null,
                        'amount' => $detail['amount'] ?? null,
                        'reference' => $detail['reference'] ?? null,
                        'date' => $update->date ?? null,
                        'cheque_id' => $detail['cheque_id'] ?? null,
                        'cheque_date' => !empty($detail['cheque_date']) ? $detail['cheque_date'] : null,
                        'user_id' => $update->user_id ?? null,
                        'branch_id' => $update->branch_id ?? null,
                        'company_id' => $update->company_id ?? null
                    ]);
                    $paymentDetail->save();
                }
            }

            return redirect()->route('account_payment.index')->with('success', 'Payment voucher information updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the payment voucher.');
        }

        return redirect()->route('account_payment.index')->with('success','Payment voucher information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->can('delete accountpayment'),403,__('User does not have the right permissions.'));
        $delete=AccountPayment::find($id);
        $delete->delete();
        return redirect()->route('account_payment.index')->with('error','Payment voucher delete successfully');
    }
}
