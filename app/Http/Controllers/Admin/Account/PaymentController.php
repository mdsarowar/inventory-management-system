<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\AccountPayment;
use App\Models\AccountPaymentDetails;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Support\Facades\Session;

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
            'customers'=>Customer::get(),
            'suppliers'=>Supplier::get(),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    public function storeSessionData(Request $request)
    {
        // Retrieve existing session data or initialize an empty array
        $paymentData = Session::get('paymentVoucher', []);

        // Add the new data to the array
        $paymentData[] = [
            'sourch' => $request->sourch,
            'payto' => $request->payto,
            'amount' => $request->amount,
            'ref' => $request->ref,
            'cheque' => $request->cheque,
            'cheque_date' => $request->cheque_date,
            'vou_no' => $request->vou_no,
            'vou_date' => $request->vou_date,
        ];

        // Store the updated array back into the session
        Session::put('paymentVoucher', $paymentData);
        $paymentData = Session::get('paymentVoucher', []);

        // Calculate the total amount
        $totalAmount = array_sum(array_column($paymentData, 'amount'));

        // Store the total amount in the session
        Session::put('totalAmount', $totalAmount);

        return response()->json(['success' => true, 'data' => $paymentData, 'totalAmount' => $totalAmount]);
    }

    public function deleteSessionData(Request $request)
    {
        // Retrieve the current session data
        $paymentData = Session::get('paymentVoucher', []);

        // Remove the specific item from the array using its index
        if(isset($paymentData[$request->index])) {
            unset($paymentData[$request->index]);

            // Re-index the array to prevent gaps in the indices
            $paymentData = array_values($paymentData);

            // Update the session with the new array
            Session::put('paymentVoucher', $paymentData);
        }
        // Recalculate the total amount after deletion
        $totalAmount = array_sum(array_column($paymentData, 'amount'));
        Session::put('totalAmount', $totalAmount);

        return response()->json(['success' => true, 'data' => $paymentData, 'totalAmount' => $totalAmount]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        abort_if(!auth()->user()->can('create accountpayment'),403,__('User does not have the right permissions.'));
        $paymentData = Session::get('paymentVoucher', []);

       $total= Session::get('totalAmount');
       $request['total']=$total;

            $store = AccountPayment::createOrUpdatePayment($request);

        // Extract payment details from the hidden input field
        try {
//            $paymentDetails = json_decode($request->payment_details, true);
            if (!empty($paymentData)) {
                foreach ($paymentData as $detail) {
                    $paymentDetail = new AccountPaymentDetails();
                    $paymentDetail->payment_id      = $store->id;
                    $paymentDetail->inv_number      = $store->inv_number ?? null;
                    $paymentDetail->note            = $store->note ?? null;
                    $paymentDetail->sourch       = $detail['sourch'] ?? null;
                    $paymentDetail->payto        = $detail['payto'] ?? null;
                    $paymentDetail->amount          = $detail['amount'] ?? null;
                    $paymentDetail->reference       = $detail['ref'] ?? null;
                    $paymentDetail->date            = $store->date ?? null;
                    $paymentDetail->cheque_id       = $detail['cheque'] ?? null;
                    $paymentDetail->cheque_date     = !empty($detail['cheque_date']) ? $detail['cheque_date'] : null;
                    $paymentDetail->user_id         = $store->user_id ?? null;
                    $paymentDetail->branch_id       = $store->branch_id ?? null;
                    $paymentDetail->company_id      = $store->company_id ?? null;
                    $paymentDetail->save();
                }
            }

            Session::forget('paymentVoucher');
            Session::forget('totalAmount');
//            // Clear payment details array from cookies after successfully stored
//            Cookie::queue(Cookie::forget('paymentDetailsArray'));

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
        abort_if(!auth()->user()->can('update accountreceive'),403,__('User does not have the right permissions.'));
        $pay=AccountPayment::find($id);
        $paymentData = AccountPaymentDetails::where('payment_id',$id)->get();
        return view('admin.account.payment.view',[
            'payment'=>AccountPayment::find($id),
            'details'=>$paymentData,
            'customers'=>Customer::get(),
            'suppliers'=>Supplier::get(),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!auth()->user()->can('update accountpayment'),403,__('User does not have the right permissions.'));

        $pay=AccountPayment::find($id);
        $paymentData = AccountPaymentDetails::where('payment_id',$id)->get();
        if (!empty($paymentData)) {
            foreach ($paymentData as $key=> $detail) {
//                $paymentDetail = new AccountPaymentDetails();
//                $paymentDetail->payment_id      = $store->id;
//                $paymentDetail->inv_number      = $store->inv_number ?? null;
//                $paymentDetail->note            = $store->note ?? null;
                $paymentDetail[$key]['sourch']       = $detail['sourch'] ?? null;
                $paymentDetail[$key]['payto']        = $detail['payto'] ?? null;
                $paymentDetail[$key]['amount']          = $detail['amount'] ?? null;
                $paymentDetail[$key]['ref']     = $detail['reference'] ?? null;
                $paymentDetail[$key]['vou_date']     = $detail['date'] ?? null;
//                $paymentDetail->date            = $store->date ?? null;
                $paymentDetail[$key]['cheque']      = $detail['cheque_id'] ?? null;
                $paymentDetail[$key]['cheque_date']     = !empty($detail['cheque_date']) ? $detail['cheque_date'] : null;
//                $paymentDetail->user_id         = $store->user_id ?? null;
//                $paymentDetail->branch_id       = $store->branch_id ?? null;
//                $paymentDetail->company_id      = $store->company_id ?? null;
//                $paymentDetail->save();
                Session::put('paymentVoucher',$paymentDetail);
            }
        }
        Session::put('totalAmount', $pay->amount);
//       return Session::get('paymentVoucher',[]);
        return view('admin.account.payment.edit',[
            'payment'=>AccountPayment::find($id),
            'branches' => Branch::get(),
            'customers'=>Customer::get(),
            'suppliers'=>Supplier::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
//        return $request;
        abort_if(!auth()->user()->can('update accountpayment'),403,__('User does not have the right permissions.'));
        $paymentData = Session::get('paymentVoucher', []);

        $total= Session::get('totalAmount');
        $request['total']=$total;
        $detailsData = AccountPaymentDetails::where('payment_id', $id)->get();

        foreach ($detailsData as $detail) {
            $detail->delete();
        }
//       return $request;
        $store = AccountPayment::createOrUpdatePayment($request,$id);
//        }
//return $store;

        // Extract payment details from the hidden input field
        try {
//            $paymentDetails = json_decode($request->payment_details, true);
            if (!empty($paymentData)) {
                foreach ($paymentData as $detail) {
                    $paymentDetail = new AccountPaymentDetails();
                    $paymentDetail->payment_id      = $store->id;
                    $paymentDetail->inv_number      = $store->inv_number ?? null;
                    $paymentDetail->note            = $store->note ?? null;
                    $paymentDetail->sourch       = $detail['sourch'] ?? null;
                    $paymentDetail->payto        = $detail['payto'] ?? null;
                    $paymentDetail->amount          = $detail['amount'] ?? null;
                    $paymentDetail->reference       = $detail['ref'] ?? null;
                    $paymentDetail->date            = $store->date ?? null;
                    $paymentDetail->cheque_id       = $detail['cheque'] ?? null;
                    $paymentDetail->cheque_date     = !empty($detail['cheque_date']) ? $detail['cheque_date'] : null;
                    $paymentDetail->user_id         = $store->user_id ?? null;
                    $paymentDetail->branch_id       = $store->branch_id ?? null;
                    $paymentDetail->company_id      = $store->company_id ?? null;
                    $paymentDetail->save();
                }
            }

            Session::forget('paymentVoucher');
            Session::forget('totalAmount');
//            // Clear payment details array from cookies after successfully stored
//            Cookie::queue(Cookie::forget('paymentDetailsArray'));

            return redirect()->route('account_payment.index')->with('success', 'Payment voucher created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the payment voucher.');
        }

        return redirect()->route('account_payment.index')->with('success','Payment voucher information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete accountpayment'),403,__('User does not have the right permissions.'));
        $delete=AccountPayment::find($id);
        $detailsData = AccountPaymentDetails::where('payment_id', $id)->get();
        foreach ($detailsData as $detail) {
            $detail->delete();
        }
        $delete->delete();
        return redirect()->route('account_payment.index')->with('error','Payment voucher delete successfully');
    }
}
