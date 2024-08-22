<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\BankMobile;
use App\Models\Color;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductSerial;
use App\Models\ProductTransection;
use App\Models\Purchas;
use App\Models\Sale;
use App\Models\Size;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view purchase'),403,__('User does not have the right permissions.'));
        return view('admin.sale.index', [
            'sales' => Sale::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sale.create', [
            'customers'=>Customer::get(),
            'suppliers'=>Supplier::get(),
            'products' => Product::get(),
            'colors' => Color::get(),
            'sizes' => Size::get(),
            'units' => Unit::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(Request $request)
//    {
////        return $request;
//        $validatedData = $request->validate([
//            'vendor' => 'required_without_all:wkname|nullable|string|max:255',
//            'wkname' => 'required_without_all:vendor|nullable|string|max:255',
//        ], [
//            'vendor.required_without_all' => 'Either vendor or wkname must be provided.',
//            'wkname.required_without_all' => 'Either wkname or vendor must be provided.',
//        ]);
//
////        return response()->json(['message' => 'Data successfully stored', 'data' => $validatedData]);
//
//        abort_if(!auth()->user()->can('create purchase'),403,__('User does not have the right permissions.'));
//        $amounts = session()->get('sale_additional');
////        return $amounts;
//        $request['total']=$amounts['grand_total'];
//
//
//        $bank_amount = session()->get('bank_info');
//
//        $amount['type']='redeived';
//        $amount['vendor_type']=$request->vendor_type;
//        if ($request->vendor != null){
//            $amount['name']=$request->vendor;
//        }else{
//            $amount['name']=$request->wkname;
//        }
//        $amount['date']=$request->issue_date;
//        $amount['due_date']=$request->due_date;
//        $amount['amount']=$request->due_amount + $request->payment_amount;
//        $amount['paid_amount']=$request->payment_amount;
//        $amount['due_amount']=$request->due_amount;
//
//        if ($request->payment_amount == 0){
//            $amount['status']='unpaid';
//            $request['status']=0;
//        }
//        elseif($request->payment_amount == $request->due_amount + $request->payment_amount){
//            $amount['status']='paid';
//            $request['status']=1;
//        }elseif ($request->payment_amount < $request->due_amount + $request->payment_amount){
//            $amount['status']='partial';
//            $request['status']=2;
//        }
//
//        if ($request->payment_type == 'bank'){
//            $amount['bank_type']=$bank_amount['bank_type'];
//            $amount['bank_id']=$bank_amount['bank_id'];
//
//            if (isset($bank_amount['bank_type']) && $bank_amount['bank_type']=='bank'){
//                $bank=BankAccount::where('id',$bank_amount['bank_id'])->first();
//                $bank_name=Bank::where('id',$bank->bank_id)->first();
//                $bank->balance=$bank->balance + $bank_amount['payment_amount'];
//                $bank->update();
//
//            }elseif (isset($bank_amount['bank_type']) && $bank_amount['bank_type']=='mobile'){
//                $bank=BankMobile::where('id',$bank_amount['bank_id'])->first();
//                $bank->balance=$bank->balance + $bank_amount['payment_amount'];
//                $bank->update();
//
//            }
//        }else{
//            $amount['type']='received';
//            $amount['bank_type']='cash';
//            $amount['bank_id']='';
//        }
//
//
//
//        $invoice=Invoice::createOrUpdateUser($amount);
//        $store=Sale::createOrUpdateUser($request,$invoice->id);
//        $sessionProducts = session()->get('sale_products', []);
////        $sessionProducts = session()->put('sale_products', []);
////        return $sessionProducts;
//        foreach ($sessionProducts as $key=>$product){
//
////            return $product['serial'];
//            $data['product_id']=$product['id'];
//            $data['color_id']=$product['color'];
//            $data['size_id']=$product['size'];
////            $data['unit_id']=$product['id'];
//            $data['qty']=$product['quantity'];
//            $data['price']=$product['price'];
//            $data['total_price']=$product['price'] * $product['quantity'];
//            $data['dis_type']=$product['discount_type'];
//            $data['dis']=$product['discount'];
//            $data['tax_type']=$product['tax_type'];
//            $data['tax']=$product['tax'];
//            $data['vat_type']=$product['vat_type'];
//            $data['vat']=$product['vat'];
//            $data['pur_id']=$store->id;
//
//            // Fetch all unsold serials for the product
//            $pro_serials = ProductSerial::where('product_id', $product['id'])
//                ->where('is_sold', '0')
//                ->whereIn('serial_number', $product['serial']) // Filter by the provided serial numbers
//                ->get();
//
//// Loop through the fetched serials and mark them as sold
//            foreach ($pro_serials as $pro_serial) {
//                $pro_serial->update(['is_sold' => '1']);
//            }
//
//            $tranjection=ProductTransection::createOrUpdateUser($data,'SAL',$store->id);
//            $stock=Stock::createOrUpdateUser($data);
//        }
//        session()->forget('purchase_walkin');
//        session()->forget('sale_additional');
//        session()->forget('sale_products');
//        session()->forget('bank_info');
//
//        return redirect()->route('purchasOrderCreate')->with('success','Purchas create successfully');
//    }


    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'vendor' => 'required_without_all:wkname|nullable|string|max:255',
            'wkname' => 'required_without_all:vendor|nullable|string|max:255',
        ], [
            'vendor.required_without_all' => 'Either vendor or wkname must be provided.',
            'wkname.required_without_all' => 'Either wkname or vendor must be provided.',
        ]);

        // Check user permissions
        abort_if(!auth()->user()->can('create purchase'), 403, __('User does not have the right permissions.'));

        // Prepare amount details
        $amounts = session()->get('sale_additional');
        $request['total'] = $amounts['grand_total'];
        $bankAmount = session()->get('bank_info');
        $amount = [
            'type' => $request->payment_type == 'bank' ? 'received' : 'redeived',
            'vendor_type' => $request->vendor_type,
            'name' => $request->vendor ?? $request->wkname,
            'date' => $request->issue_date,
            'due_date' => $request->due_date,
            'amount' => $request->due_amount + $request->payment_amount,
            'paid_amount' => $request->payment_amount,
            'due_amount' => $request->due_amount,
            'status' => $request->payment_amount == 0 ? 'unpaid' : ($request->payment_amount >= $request->due_amount + $request->payment_amount ? 'paid' : 'partial'),
            'bank_type' => $request->payment_type == 'bank' ? $bankAmount['bank_type'] : 'cash',
            'bank_id' => $request->payment_type == 'bank' ? $bankAmount['bank_id'] : '',
        ];

        try {
            // Start a transaction
            DB::transaction(function () use ($request, $amounts, $bankAmount, $amount) {
                // Update bank balance if payment is by bank
                if ($request->payment_type == 'bank') {
                    $this->updateBankBalance($bankAmount);
                }

                // Create invoice and store
                $invoice = Invoice::createOrUpdateUser($amount);
                $store = Sale::createOrUpdateUser($request, $invoice->id);

                // Process session products
                $sessionProducts = session()->get('sale_products', []);
                foreach ($sessionProducts as $product) {
                    $this->processProduct($product, $store->id);
                }

                // Clear session data
                session()->forget(['purchase_walkin', 'sale_additional', 'sale_products', 'bank_info']);
            });

            return redirect()->route('sales.index')->with('success', 'Purchase created successfully');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error and return error message
            return back()->with('error', $e->getMessage());
        }
    }

    protected function processProduct($product, $storeId)
    {
        // Prepare the data array
        $data = [
            'product_id' => $product['id'],
            'color_id' => $product['color'],
            'size_id' => $product['size'],
            'qty' => $product['quantity'],
            'price' => $product['price'],
            'total_price' => $product['price'] * $product['quantity'],
            'dis_type' => $product['discount_type'],
            'dis' => $product['discount'],
            'tax_type' => $product['tax_type'],
            'tax' => $product['tax'],
            'vat_type' => $product['vat_type'],
            'vat' => $product['vat'],
            'pur_id' => $storeId,
        ];

        // Start a transaction for product processing
        DB::transaction(function () use ($product, $data, $storeId) {
            // Update product serials
            ProductSerial::where('product_id', $product['id'])
                ->where('is_sold', '0')
                ->whereIn('serial_number', $product['serial'])
                ->update(['is_sold' => '1']);

            // Create or update the product transaction
            ProductTransection::createOrUpdateUser($data, 'SAL', $storeId);

            // Check and update stock quantity
            $stock = Stock::where('product_id', $product['id'])->first();
            if ($stock) {
                if ($stock->sotck_qty >= $data['qty']) {
                    $stock->sotck_qty -= $data['qty'];
                    $stock->save(); // Use save() instead of update() for better consistency
                } else {
                    // Throw an exception for insufficient stock
                    throw new \Exception('Insufficient stock quantity for product ID: ' . $product['id']);
                }
            } else {
                // Throw an exception if stock is not found
                throw new \Exception('Product not found for product ID: ' . $product['id']);
            }
        });
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
//        return $id;
//        $product=Product::find($id);
        $purchas=Purchas::find($id);
        if (empty($purchas->wkname)){
            $sup=explode('-',$purchas->vendor);
            if ($sup[0] == 'sup'){
                $supplier=Supplier::find($sup[1])->first();
            }else{
                $supplier=Customer::find($sup[1])->first();
            }
        }else{
            $supplier='';
        }
        $pro_tran=ProductTransection::where('pur_id',$purchas->id)->get();
//        return $pro_tran;
        return view('admin.purchas.view',[
            'purchas'=>$purchas,
            'supplier'=>$supplier,
            'pro_trans'=>$pro_tran,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!auth()->user()->can('update purchase'),403,__('User does not have the right permissions.'));

        $purchas=Purchas::find($id);
        $pro_tran=ProductTransection::where('pur_id',$purchas->id)->get();
        $inv=Invoice::find($purchas->inv_id);
        foreach ($pro_tran as $pro){
            // Update the product data
            $product=Product::where('id',$pro->product_id)->first();
            if (!empty($product->purmode)){
                $sessionProducts[$pro->product_id]['serial_method'] = 'yes';
                $pro_serial=ProductSerial::where('product_id',$pro->product_id)->where('pur_id',$id)->get();
                foreach ($pro_serial as $serial){
                    $sessionProducts[$pro->product_id]['serial'][]=$serial->serial_number;
                }
//                return $sessionProducts;
            }else{
                $sessionProducts[$pro->product_id]['serial_method'] = '';
            }

            $sessionProducts[$pro->product_id]['id'] = intval($pro->product_id);
            $sessionProducts[$pro->product_id]['name'] = $product->name;
            $sessionProducts[$pro->product_id]['price'] = $pro->price;
//            if ($product->purmode)

            $sessionProducts[$pro->product_id]['quantity'] = $pro->qty;
            $sessionProducts[$pro->product_id]['discount_type'] = $pro->dis_type;
            $sessionProducts[$pro->product_id]['discount'] = $pro->dis;
            $sessionProducts[$pro->product_id]['vat_type'] = $pro->vat_type;
            $sessionProducts[$pro->product_id]['vat'] = $pro->vat;
            $sessionProducts[$pro->product_id]['tax_type'] = $pro->tax_type;
            $sessionProducts[$pro->product_id]['tax'] = $pro->tax;

            $sessionProducts[$pro->product_id]['color'] = '';
            $sessionProducts[$pro->product_id]['size'] = '';
            $sessionProducts[$pro->product_id]['warranty_days'] = '';

            // Save updated data back to the session
            session()->put('sale_products', $sessionProducts);
        }

        $sessionData['subtotal'] = $purchas->sub_total;
        $sessionData['discount'] = $purchas->discount;
        $sessionData['vat'] = $purchas->vat;
        $sessionData['tax'] = $purchas->tax;
        $sessionData['speed_money'] = $purchas->speed_money;
        $sessionData['freight'] = $purchas->freight;
        $sessionData['fractional_discount'] = $purchas->fractional_dis;
//        $grand_total=($grand_total+($all_vat + $all_tax)+$all_subtotal) - $all_dis;
        $sessionData['grand_total'] = floatval($purchas->total);

        session()->put('sale_additional', $sessionData);

        $info=session()->get('bank_info');
        $info['bank_type']=$inv->bank_type;
        $info['bank_id']=$inv->bank_id;
        $info['bank_name']=$inv->name;
        $info['bank_amount']=$inv->amount;
        $info['payment_amount']=$inv->paid_amount;
//            $info['due']=$request->payment_amount;
        session()->put('bank_info',$info);
//        $sessionProducts = session()->get('sale_products', []);
//        return $sessionProducts;

//        foreach ($pro_tran as $product){
//                return $product;
//            $stock=Stock::where('pur_id',$id)->where('product_id',$product->product_id)->first();
//            $stock->sotck_qty = $stock->sotck_qty - $product->qty;
//            $stock->update();
//            $product->delete();
//            $serial=ProductSerial::where('product_id',$product->product_id)->get();
//            foreach ($serial as $sr){
//                $sr->delete();
//            }
//        }
//        $invoice=Invoice::where('id',$delete->inv_id)->first();

        if (empty($purchas->wkname)){
            $sup=explode('-',$purchas->vendor);
            if ($sup[0] == 'sup'){
                $supplier=Supplier::find($sup[1])->first();
            }else{
                $supplier=Customer::find($sup[1])->first();
            }
        }else{
            $supplier='';
        }
        return view('admin.purchas.purchas_order.edit',[
            'customers'=>Customer::get(),
            'purchas'=>$purchas,
            'supplier'=>$supplier,
            'suppliers'=>Supplier::get(),
            'products' => Product::get(),
            'colors' => Color::get(),
            'sizes' => Size::get(),
            'units' => Unit::get()
        ]);
    }

    public function purchas_return(string $id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('update purchase'),403,__('User does not have the right permissions.'));


//                return $request;
//        abort_if(!auth()->user()->can('create category'),403,__('User does not have the right permissions.'));
        $amounts = session()->get('sale_additional');
//        return $amounts;
        $request['total']=$amounts['grand_total'];


        $bank_amount = session()->get('bank_info');

        if ($request->payment_type == 'bank'){
            $amount['type']='payment';
            $amount['bank_type']=$bank_amount['bank_type'];
            $amount['bank_id']=$bank_amount['bank_id'];
            $amount['vendor_type']=$request->vendor_type;
            if ($request->vendor_type == 'other'){
                $amount['name']=$request->vendor_name;
            }else{
                $amount['name']=$request->vendor;
            }
            $amount['date']=$request->issue_date;
            $amount['due_date']=$request->due_date;
            $amount['amount']=$request->due_amount + $request->payment_amount;
            $amount['paid_amount']=$request->payment_amount;
            $amount['due_amount']=$request->due_amount;

            if ($request->payment_amount == 0){
                $amounts['status']='unpaid';
                $request['status']=0;
            }
            elseif($request->payment_amount == $request->due_amount + $request->payment_amount){
                $amount['status']='paid';
                $request['status']=1;
            }elseif ($request->payment_amount < $request->due_amount + $request->payment_amount){
                $amount['status']='partial';
                $request['status']=2;
            }

            if (isset($bank_amount['bank_type']) && $bank_amount['bank_type']=='bank'){
                $bank=BankAccount::where('id',$bank_amount['bank_id'])->first();
                $bank_name=Bank::where('id',$bank->bank_id)->first();

                $bank->balance=$bank->balance - $bank_amount['payment_amount'];
                $bank->update();
            }elseif (isset($bank_amount['bank_type']) && $bank_amount['bank_type']=='mobile'){
                $bank=BankMobile::where('id',$bank_amount['bank_id'])->first();
                $bank->balance=$bank->balance - $bank_amount['payment_amount'];
                $bank->update();
            }
        }else{
            $amount['type']='payment';
            $amount['bank_type']='cash';
            $amount['bank_id']='';
            $amount['vendor_type']=$request->vendor_type;
            if ($request->vendor_type == 'other'){
                $amount['name']=$request->vendor_name;
            }else{
                $amount['name']=$request->vendor;
            }
            $amount['date']=$request->issue_date;
            $amount['due_date']=$request->due_date;
            $amount['amount']=$request->due_amount + $request->payment_amount;
            $amount['paid_amount']=$request->payment_amount;
            $amount['due_amount']=$request->due_amount;

            if ($request->payment_amount == 0){
                $amount['status']='unpaid';
                $request['status']=0;
            }
            elseif($request->payment_amount == $request->due_amount + $request->payment_amount){
                $amount['status']='paid';
                $request['status']=1;
            }elseif ($request->payment_amount < $request->due_amount + $request->payment_amount){
                $amount['status']='partial';
                $request['status']=2;
            }
        }

        $pur=Purchas::find($id);

        $invoice=Invoice::createOrUpdateUser($amount,$pur->inv_id);
        $store=Purchas::createOrUpdateUser($request,$invoice->id,$pur->id);
        $sessionProducts = session()->get('sale_products', []);
        $pro_tran=ProductTransection::where('pur_id',$pur->id)->get();
        $stocks=Stock::where('pur_id',$pur->id)->get();
//        $sessionProducts = session()->put('sale_products', []);

        foreach ($sessionProducts as $key=>$product){

//            return $product['serial'];
            $data['product_id']=$product['id'];
            $data['color_id']=$product['color'];
            $data['size_id']=$product['size'];
//            $data['unit_id']=$product['id'];
            $data['qty']=$product['quantity'];
            $data['price']=$product['price'];
            $data['total_price']=$product['price'] * $product['quantity'];
            $data['dis_type']=$product['discount_type'];
            $data['dis']=$product['discount'];
            $data['tax_type']=$product['tax_type'];
            $data['tax']=$product['tax'];
            $data['vat_type']=$product['vat_type'];
            $data['vat']=$product['vat'];
            $data['pur_id']=$store->id;
//            $pro_serial=ProductSerial::where('product_id',$product['id'])->get();
//            foreach ($pro_serial as $serial){
//                $serial->delete();
//            }
//            foreach ($product['serial'] as $poserial){
//                $serial['product_id']=$product['id'];
//                $serial['serial_number']=$poserial;
//                $serial['emei_number']=' ';
//                $serial['is_sold']='0';
//                $serial['status']=' ';
//                $serial=ProductSerial::createOrUpdateUser($serial);
//            }
            // Delete existing serials and add new ones if serials are defined
            if (isset($product['serial']) && is_array($product['serial'])) {
                ProductSerial::where('product_id', $product['id'])->where('pur_id',$pur->id)->delete();
                foreach ($product['serial'] as $poserial) {
                    $serial = [
                        'product_id' => $product['id'],
                        'serial_number' => $poserial,
                        'emei_number' => ' ',
                        'is_sold' => '0',
                        'status' => ' ',
                    ];
                    ProductSerial::createOrUpdateUser($serial,$id); // Assuming this method exists
                }
            }
            foreach ($pro_tran as $pro){
                if ($pro->product_id == $product['id']){
                    $tranjection=ProductTransection::createOrUpdateUser($data,'pur',$store->id ,$pro->id);
                }
            }
            foreach ($stocks as $st){
                if ($st->product_id == $product['id']){
//                    $tranjection=ProductTransection::createOrUpdateUser($data,'pur',$store->id ,$pro->id);
                    $stock=Stock::createOrUpdateUser($data,$st->id);
                }
            }
        }
        session()->forget('purchase_walkin');
        session()->forget('sale_additional');
        session()->forget('sale_products');
        session()->forget('bank_info');


        return redirect()->route('purchases.index')->with('success','Purchase Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
//        return $id;
        abort_if(!auth()->user()->can('delete purchase'),403,__('User does not have the right permissions.'));
        $delete=Purchas::find($id);
        $pro_trns=ProductTransection::where('trans_type','pur')->where('pur_id',$id)->get();
        foreach ($pro_trns as $product){

            $stock=Stock::where('pur_id',$id)->where('product_id',$product->product_id)->first();
//                return $stock;
            $stock->sotck_qty=$stock->sotck_qty - $product->qty;
            $stock->update();
            $product->delete();
            $serial=ProductSerial::where('product_id',$product->product_id)->get();
            foreach ($serial as $sr){
                $sr->delete();
            }
        }
        $invoice=Invoice::where('id',$delete->inv_id)->first();
        if (isset($invoice->bank_type) && $invoice->bank_type =='bank'){
            $bank=BankAccount::where('id',$invoice->bank_id)->first();
            $bank->balance=$bank->balance + $invoice->paid_amount;
            $bank->update();
        }elseif (isset($invoice->bank_type) && $invoice->bank_type =='mobile'){
            $bank=BankMobile::where('id',$invoice->bank_id)->first();
            $bank->balance=$bank->balance + $invoice->paid_amount;
            $bank->update();
        }

        $invoice->delete();
//        $pro_trns->delete();
        $delete->delete();

//            return $invoice;
//            if (file_exists($delete->image)){
//                unlink(public_path($delete->image));
//            }
//            $delete->delete();
        return redirect()->route('purchases.index')->with('error','Product delete successfully');
    }


    public function get_sale_product_data(Request $request)
    {
//        return $request;
        $productId = $request->input('product_id');
        $product = Product::find($productId);

//        return $product;
        if(!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }

        $sessionProducts = session()->get('sale_products', []);
        $allamounts = session()->get('ssn_additional');
//        return $sessionProducts;
        if (!isset($sessionProducts[$productId])) {
            $productData = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => number_format($product->price, 0, '.', ''),
                'quantity' => 1,
                'serial_method' => $product->purmode == null? '':'yes',
                'serial' => $product->purmode == null ? [] : [''], // Check if serial_method is null, set serial to an empty array, otherwise initialize with one empty value
                'discount_type' => '',
                'discount' => 0,
                'vat_type' => '',
                'vat' => 0,
                'tax_type' => '',
                'tax' => 0,
                'size' => '',
                'color' =>'',
                'warranty_days' => ''
            ];
            $sessionProducts[$productId] = $productData;
        }else{
            return response()->json(['status' => true, 'products' => array_reverse($sessionProducts)]);
        }
//        return $product;

        $sessionProducts[$productId] = $productData;
        session(['sale_products' => $sessionProducts]);

        return response()->json(['status' => true, 'products' => array_reverse($sessionProducts)]);
    }

    public function delete_sale_product_data(Request $request)
    {
        $productId = $request->input('product_id');
        $products = session()->get('sale_products', []);
        if (isset($products[$productId])) {
            unset($products[$productId]);
            session()->put('sale_products', $products);
            return response()->json(['success' => true, 'products' => array_reverse($products)]);
        }
        return response()->json(['success' => false]);
    }

    public function sale_update_quantity(Request $request)
    {
//        return $request;
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $sessionProducts = session()->get('sale_products', []);
        if ($quantity < 1) {
            return response()->json(['status' => true, 'products' => array_reverse($sessionProducts)]);
//            return response()->json(['status' => false, 'message' => 'Invalid quantity']);
        }
//        return $quantity;
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }

        if (isset($sessionProducts[$productId])) {
            $stock_qty=Stock::where('product_id',$productId)->first();
          if ($stock_qty->sotck_qty >0){
              $oldQuantity = $sessionProducts[$productId]['quantity'];
              $sessionProducts[$productId]['quantity'] = $quantity;
//            return $sessionProducts[$productId]['serial_method'];
              if ($sessionProducts[$productId]['serial_method'] != ''){
//                return $sessionProducts;
                  if ($quantity > $oldQuantity) {
                      // Quantity increased, append empty serial numbers
                      for ($x = $oldQuantity + 1; $x <= $quantity; $x++) {
                          $sessionProducts[$productId]['serial'][] = '';
                      }
                  } elseif ($quantity < $oldQuantity) {
                      // Quantity decreased, truncate the serial numbers array
                      $sessionProducts[$productId]['serial'] = array_slice($sessionProducts[$productId]['serial'], 0, $quantity);
                  }
              }


              // Update session with the new products array
              session(['sale_products' => $sessionProducts]);

              return response()->json(['status' => true, 'products' => array_reverse($sessionProducts)]);
          }else{
              return response()->json(['status' => false, 'message' => 'Product not found in your stock']);
          }
        }

        return response()->json(['status' => false, 'message' => 'Product not found']);
    }

    public function sale_update_product_price(Request $request)
    {
        $productId = $request->input('product_id');
        $newPrice = $request->input('price');

        $sessionProduct = session()->get('sale_products', []);
        if (isset($sessionProduct[$productId])) {
            $sessionProduct[$productId]['price'] = $newPrice;
            session()->put('sale_products', $sessionProduct);
            $sessionProducts = session()->get('sale_products', []);
            return response()->json(['status' => true, 'products' => array_reverse($sessionProducts)]);
//            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false, 'message' => 'Product not found.']);
    }

    public function sale_update_pdata(Request $request)
    {
//        return $request;
        $productId = $request->input('product_id');
        $discountType = $request->input('discount_type');
        $discount = $request->input('discount');
        $vatType = $request->input('vat_type');
        $vat = $request->input('vat');
        $taxType = $request->input('tax_type');
        $tax = $request->input('tax');
        $color = $request->input('color');
        $size = $request->input('size');
        $warrantyDays = $request->input('warranty_days');

        $sessionProducts = session()->get('sale_products', []);

        // Check if the product exists in the session
        if (isset($sessionProducts[$productId])) {
            // Update the product data
            $sessionProducts[$productId]['discount_type'] = $discountType;
            $sessionProducts[$productId]['discount'] = $discount;
            $sessionProducts[$productId]['vat_type'] = $vatType;
            $sessionProducts[$productId]['vat'] = $vat;
            $sessionProducts[$productId]['tax_type'] = $taxType;
            $sessionProducts[$productId]['tax'] = $tax;
            $sessionProducts[$productId]['color'] = $color;
            $sessionProducts[$productId]['size'] = $size;
            $sessionProducts[$productId]['warranty_days'] = $warrantyDays;

            // Save updated data back to the session
            session()->put('sale_products', $sessionProducts);

            return response()->json(['status' => true, 'product' => $sessionProducts[$productId]]);
        }

        return response()->json(['status' => false, 'message' => 'Product not found']);
    }

    public function sale_fetch_product_data(Request $request)
    {
        $product_id = $request->input('id');
        $sessionProduct = session()->get('sale_products', []);
        if (isset($sessionProduct[$product_id])) {
            return response()->json([
                'status' => true,
                'product' => $sessionProduct[$product_id]
            ]);
        }

        return response()->json(['status' => false]);
    }

    public function sale_calculate_summary()
    {
        $products = session()->get('sale_products', []);
//        return $products;
        $grand_total=0;
        $all_subtotal=0;
        $all_vat=0;
        $all_tax=0;
        $all_dis=0;
        foreach ($products as $product){
            $subt=floatval($product['price']) * floatval($product['quantity']);
            $all_subtotal = $all_subtotal + $subt;
            if (isset($product['discount_type']) && $product['discount_type'] == 'percent'){
                $dis=($subt / 100 )* floatval($product['discount']) ?:0;
                $all_dis=$all_dis+$dis;
            }else{
                $all_dis=$all_dis+$product['discount'];
            }
            if ($product['vat'] > 0 && $product['vat_type'] == 'percent'){
                $vat=($subt / 100 )* floatval($product['vat']) ?:0;
                $all_vat=$all_vat+$vat;
            }else{
                $all_vat=$all_vat+$product['vat'];
            }
            if ($product['tax'] > 0 && $product['tax_type'] == 'percent'){
                $vat=($subt / 100 )* floatval($product['tax']) ?:0;
                $all_tax=$all_tax+$vat;
            }else{
                $all_tax=$all_tax+$product['tax'];
            }

        }
//        return '$all_subtotal';

        $sessionData['subtotal'] = $all_subtotal;
        $sessionData['discount'] =$all_dis;
        $sessionData['vat'] = $all_vat;
        $sessionData['tax'] = $all_tax;
        $sessionData['speed_money'] = 0;
        $sessionData['freight'] = 0;
        $sessionData['fractional_discount'] = 0;
        $grand_total=($grand_total+($all_vat + $all_tax)+$all_subtotal) - $all_dis;
        $sessionData['grand_total'] = floatval($grand_total);

        session()->put('sale_additional', $sessionData);
        $all_amount =session()->get('sale_additional', []);
        return response()->json(['status' => true, 'data' => $all_amount]);
    }

    public function sell_update_summary(Request $request)
    {
        $reference = $request->input('reference');
        $note = $request->input('note');
        $subtotal = $request->input('subtotal');
        $discount = $request->input('discount');
        $vat = $request->input('vat');
        $tax = $request->input('tax');
        $speed_money = $request->input('speed_money');
        $freight = $request->input('freight');
        $fractional_discount = $request->input('fractional_discount');

        $sessionData = session()->get('sale_additional');

        $sessionData['reference'] = $reference;
        $sessionData['note'] = $note;
        $sessionData['subtotal'] = intval($subtotal);
        $sessionData['discount'] = intval($discount);
        $sessionData['vat'] = intval($vat);
        $sessionData['tax'] = intval($tax);
        $sessionData['speed_money'] = intval($speed_money);
        $sessionData['freight'] = intval($freight);
        $sessionData['fractional_discount'] = intval($fractional_discount);

        $sessionData['grand_total'] = intval(($subtotal + $vat + $tax + $speed_money + $freight) - ($fractional_discount + $discount));

        session()->put('sale_additional', $sessionData);

        return response()->json(['status' => true, 'data' => $sessionData]);
    }
//    public function store_serial_sell(Request $request)
//    {
//        $productId = $request->input('product_id');
//        $serialNumber = $request->input('serial_number');
//        $index = $request->input('index');
//        // Retrieve session data
//        $ssn_products = session()->get('sale_products', []);
//
//        // Check for uniqueness
//        foreach ($ssn_products as $product) {
//            if ($product['id'] == $productId) {
//                if (in_array($serialNumber, $product['serial'])) {
////                    return $serialNumber;
//                    return response()->json(['unique' => false]);
//                } else {
//                    $pro_serials=ProductSerial::where('product_id',$productId)->where('is_sold','0')->get();
////return $pro_serials;
//                    foreach ($pro_serials as $serial){
////                        return $serial->serial_number;
//                        if ($serial->serial_number == $serialNumber){
//                            $ssn_products[$productId]['serial'][$index] = $serialNumber;
//                            session()->put('sale_products', $ssn_products);
//                            return response()->json(['unique' => true,'products' => array_reverse($ssn_products)]);
//                        }
//
//                    }
//                    return response()->json(['unique' => false]);
//                }
//            }
//        }
//
//        return response()->json(['unique' => true]);
//    }

    public function store_serial_sell(Request $request)
    {
        $productId = $request->input('product_id');
        $serialNumber = $request->input('serial_number');
        $index = $request->input('index');

        // Retrieve session data
        $ssn_products = session()->get('sale_products', []);

        // Find the product in the session data
        $product = collect($ssn_products)->firstWhere('id', $productId);

        if ($product) {
            // Check if the serial number is already in the product's serial list
            if (in_array($serialNumber, $product['serial'])) {
                return response()->json(['unique' => false]);
            }

            // Check if the serial number exists and is unsold in the database
            $pro_serial = ProductSerial::where('product_id', $productId)
                ->where('serial_number', $serialNumber)
                ->where('is_sold', '0')
                ->first();
//return $pro_serial;
            if ($pro_serial) {
                // Update the serial number in the session data
                $ssn_products = collect($ssn_products)->map(function ($prod) use ($productId, $serialNumber, $index) {
                    if ($prod['id'] == $productId) {
                        $prod['serial'][$index] = $serialNumber;
                    }
                    return $prod;
                })->all();

                // Update session data
                session()->put('sale_products', $ssn_products);

                return response()->json(['unique' => true, 'products' => array_reverse($ssn_products)]);
            }
        }

        return response()->json(['unique' => false]);
    }


    public function remove_sell_serial(Request $request)
    {
//return $request;
        $productId = $request->input('product_id');
        $index = $request->input('index');

        $sessionProducts = session()->get('sale_products', []);
        if (isset($sessionProducts[$productId]) && $sessionProducts[$productId]['quantity'] > 1) {
            $sessionProducts[$productId]['quantity'] =intval($sessionProducts[$productId]['quantity'] ) - 1;
            if (isset($sessionProducts[$productId]) && isset($sessionProducts[$productId]['serial'][$index])) {
                // Remove the specific serial number
                unset($sessionProducts[$productId]['serial'][$index]);

                // Reindex the serial array to avoid gaps in the keys
                $sessionProducts[$productId]['serial'] = array_values($sessionProducts[$productId]['serial']);
            }

        }
//        session(['sale_products' => $sessionProducts]);
        // Update the session with the modified data
        session()->put('sale_products', $sessionProducts);
        return response()->json(['status' => true, 'products' => array_reverse($sessionProducts)]);
    }

    public function sale_product_clear_all()
    {
        session()->forget('sale_products');
        session()->forget('sale_additional');
        $sessionProducts = session()->get('sale_products', []);
        return response()->json(['status' => true, 'products' => array_reverse($sessionProducts)]);
//        return response()->json(['status' => true]);
    }

    public function sale_destroy_all_ssn()
    {
        session()->forget('purchase_walkin');
        session()->forget('sale_additional');
        session()->forget('sale_products');
        $sessionProducts = session()->get('sale_products', []);
        return response()->json(['status' => true, 'products' => array_reverse($sessionProducts)]);
//        return response()->json(['status' => 'success', 'message' => 'Sessions cleared successfully']);
    }
}
