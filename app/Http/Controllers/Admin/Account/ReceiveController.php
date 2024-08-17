<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\AccountReceive;
use App\Models\AccountReceiveDetails;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Support\Facades\Session;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view accountreceive'),403,__('User does not have the right permissions.'));
        return view('admin.account.receive.index', [
            'receives' => AccountReceive::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        Session::forget('receivedVoucher');
        abort_if(!auth()->user()->can('create accountreceive'),403,__('User does not have the right permissions.'));
        return view('admin.account.receive.create', [
            'branches' => Branch::get(),
            'customers'=>Customer::get(),
            'suppliers'=>Supplier::get(),
            'companies' => Company::get()
        ]);
    }

    public function revstoreSessionData(Request $request)
    {
//        return $request;
        // Retrieve existing session data or initialize an empty array
            $paymentData = Session::get('receivedVoucher', []);
//            Session::forget('receivedVoucher');

        // Add the new data to the array
        $paymentData[] = [
            'received_to' => $request->received_to,
            'received_form' => $request->received_form,
            'amount' => $request->amount,
            'ref' => $request->ref,
            'revcheque' => $request->revcheque,
            'revcheque_date' => $request->revcheque_date,
            'vou_no' => $request->vou_no,
            'vou_date' => $request->vou_date,
        ];
//return $paymentData;
        // Store the updated array back into the session
        Session::put('receivedVoucher', $paymentData);
        $paymentData = Session::get('receivedVoucher', []);
//return $paymentData;
        // Calculate the total amount
        $totalAmount = array_sum(array_column($paymentData, 'amount'));

        // Store the total amount in the session
        Session::put('revtotalAmount', $totalAmount);

        return response()->json(['success' => true, 'data' => $paymentData, 'totalAmount' => $totalAmount]);
    }

    public function revdeleteSessionData(Request $request)
    {
        // Retrieve the current session data
        $paymentData = Session::get('receivedVoucher', []);

        // Remove the specific item from the array using its index
        if(isset($paymentData[$request->index])) {
            unset($paymentData[$request->index]);

            // Re-index the array to prevent gaps in the indices
            $paymentData = array_values($paymentData);

            // Update the session with the new array
            Session::put('receivedVoucher', $paymentData);
        }
        // Recalculate the total amount after deletion
        $totalAmount = array_sum(array_column($paymentData, 'amount'));
        Session::put('revtotalAmount', $totalAmount);

        return response()->json(['success' => true, 'data' => $paymentData, 'totalAmount' => $totalAmount]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request;
        abort_if(!auth()->user()->can('create accountreceive'),403,__('User does not have the right permissions.'));
        // Create or update the main AccountReceive

        $paymentData = Session::get('receivedVoucher', []);

        $total= Session::get('revtotalAmount');
        $request['total']=$total;

        $store = AccountReceive::createOrUpdateReceive($request);

        // Extract payment details from the hidden input field
        try {
//            $paymentDetails = json_decode($request->payment_details, true);
            if (!empty($paymentData)) {
                foreach ($paymentData as $detail) {
                    $paymentDetail = new AccountReceiveDetails();
                    $paymentDetail->receive_id      = $store->id;
                    $paymentDetail->inv_number      = $store->inv_number ?? null;
                    $paymentDetail->note            = $store->note ?? null;
                    $paymentDetail->received_to       = $detail['received_to'] ?? null;
                    $paymentDetail->received_form        = $detail['received_form'] ?? null;
                    $paymentDetail->amount          = $detail['amount'] ?? null;
                    $paymentDetail->reference       = $detail['ref'] ?? null;
                    $paymentDetail->date            = $store->date ?? null;
                    $paymentDetail->cheque_id       = $detail['revcheque'] ?? null;
                    $paymentDetail->cheque_date     = !empty($detail['revcheque_date']) ? $detail['revcheque_date'] : null;
                    $paymentDetail->user_id         = $store->user_id ?? null;
                    $paymentDetail->branch_id       = $store->branch_id ?? null;
                    $paymentDetail->company_id      = $store->company_id ?? null;
                    $paymentDetail->save();
                }
            }

            Session::forget('receivedVoucher');
            Session::forget('revtotalAmount');
//            // Clear payment details array from cookies after successfully stored
//            Cookie::queue(Cookie::forget('paymentDetailsArray'));

            return redirect()->route('account_receive.index')->with('success', 'Receive voucher created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the receive voucher.');
        }

        return redirect()->route('account_receive.index')->with('success','Receive voucher create successfully');
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
        abort_if(!auth()->user()->can('update accountreceive'),403,__('User does not have the right permissions.'));
        return view('admin.account.receive.edit',[
            'receive'=>AccountReceive::find($id),
            'branches' => Branch::get(),
            'companies' => Company::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update accountreceive'),403,__('User does not have the right permissions.'));
        $update = AccountReceive::createOrUpdateReceive($request,$id);

        // Extract receive details from the hidden input field
        try {
            $receiveDetails = json_decode($request->receive_details, true);
            // Delete existing receive details for this receive
            $update->details()->delete();
            if (!empty($receiveDetails)) {
                // Insert updated receive details
                foreach ($receiveDetails as $detail) {
                    $receiveDetail = new AccountReceiveDetails();
                    $receiveDetail->fill([
                        'receive_id' => $update->id,
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
                    $receiveDetail->save();
                }
            }

            return redirect()->route('account_receive.index')->with('success', 'Receive voucher information updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the receive voucher.');
        }

        return redirect()->route('account_receive.index')->with('success','Receive voucher information update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!auth()->user()->can('delete accountreceive'),403,__('User does not have the right permissions.'));
        $delete=AccountReceive::find($id);
        $delete->delete();
        return redirect()->route('account_receive.index')->with('error','Receive voucher delete successfully');
    }
}
