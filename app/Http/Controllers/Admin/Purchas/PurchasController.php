<?php

namespace App\Http\Controllers\Admin\Purchas;

use App\Http\Controllers\Admin\Product\SizeController;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\BankCheque;
use App\Models\BankMobile;
use App\Models\BankTransaction;
use App\Models\Color;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductSerial;
use App\Models\ProductTransection;
use App\Models\Purchas;
use App\Models\Size;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNan;
use function Symfony\Component\String\s;

class PurchasController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view purchase'),403,__('User does not have the right permissions.'));
        return view('admin.purchas.index', [
            'purchases' => Purchas::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create purchase'),403,__('User does not have the right permissions.'));

//        return view('admin.product.product.create',[
//            'brands' => Brand::all(),
//            'categories' => Category::all(),
//            'subCategories' => SubCategory::all(),
//            'childCategories' => ChildCategory::all(),
//            'colors' => Color::all(),
//            'sizes' => Size::all(),
//            'units'=> Unit::all(),
//            'manufacturers'=> Manufacture::all()
//        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//                return $request;
        abort_if(!auth()->user()->can('create purchase'),403,__('User does not have the right permissions.'));
        $amounts = session()->get('purchase_additional');
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



//        $invoice=Invoice::createOrUpdateUser($amount);
//        $store=Purchas::createOrUpdateUser($request,$invoice->id);
        $sessionProducts = session()->get('purchase_products', []);
//        $sessionProducts = session()->put('purchase_products', []);
        return $sessionProducts;
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

            foreach ($product['serial'] as $poserial){
                $serial['product_id']=$product['id'];
                $serial['serial_number']=$poserial;
                $serial['emei_number']=' ';
                $serial['is_sold']='0';
                $serial['status']=' ';
            $serial=ProductSerial::createOrUpdateUser($serial);
            }

            $tranjection=ProductTransection::createOrUpdateUser($data,'pur',$store->id);
            $stock=Stock::createOrUpdateUser($data);
        }
        session()->forget('purchase_walkin');
        session()->forget('purchase_additional');
        session()->forget('purchase_products');
        session()->forget('bank_info');

        return redirect()->route('purchasOrderCreate')->with('success','Purchas create successfully');
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
        foreach ($pro_tran as $pro){
            // Update the product data
            $product=Product::where('id',$pro->product_id)->first();
            if (!empty($product->purmode)){
                $sessionProducts[$pro->product_id]['serial_method'] = 'manual';
                $pro_serial=ProductSerial::where('product_id',$pro->product_id)->get();
                foreach ($pro_serial as $serial){
                    $sessionProducts[$pro->product_id]['serial'][]=$serial->serial_number;
                }
//                return $sessionProducts;
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
            session()->put('purchase_products', $sessionProducts);
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

        session()->put('purchase_additional', $sessionData);
//        $sessionProducts = session()->get('purchase_products', []);
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
        $amounts = session()->get('purchase_additional');
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
        $sessionProducts = session()->get('purchase_products', []);
        $pro_tran=ProductTransection::where('pur_id',$pur->id)->get();
        $stocks=Stock::where('pur_id',$pur->id)->get();
//        $sessionProducts = session()->put('purchase_products', []);

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
            $pro_serial=ProductSerial::where('product_id',$product['id'])->get();
            foreach ($pro_serial as $serial){
                $serial->delete();
            }
            foreach ($product['serial'] as $poserial){
                $serial['product_id']=$product['id'];
                $serial['serial_number']=$poserial;
                $serial['emei_number']=' ';
                $serial['is_sold']='0';
                $serial['status']=' ';
                $serial=ProductSerial::createOrUpdateUser($serial);
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
        session()->forget('purchase_additional');
        session()->forget('purchase_products');
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
            $pro_trns=ProductTransection::where('trans_type','pur')->where('trans_id',$id)->get();
            foreach ($pro_trns as $product){
//                return $product;
                $stock=Stock::where('pur_id',$id)->where('product_id',$product->product_id)->first();
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

    public function get_sub_cat(string $id)
    {
        $sub_cat=SubCategory::where('category_id',$id)->get();

        return response(['data'=>$sub_cat]);
    }
    public function get_child_cat(string $id)
    {
        $child_cat=ChildCategory::where('sub_cat_id',$id)->get();

        return response(['data'=>$child_cat]);
    }

    public function purchasOrderCreate()
    {
//        session()->forget('purchase_walkin');
//        session()->forget('purchase_additional');
//        session()->forget('purchase_products');
//        abort_if(!auth()->user()->can('view product'),403,__('User does not have the right permissions.'));
        return view('admin.purchas.purchas_order.create', [
            'customers'=>Customer::get(),
            'suppliers'=>Supplier::get(),
            'products' => Product::get(),
            'colors' => Color::get(),
            'sizes' => Size::get(),
            'units' => Unit::get()
        ]);
    }

    public function filter_products(Request $request)
    {
        $query = $request->input('query', '');

//        $products = Product::where('name', 'LIKE', "%{$query}%")
//            ->orWhere('description', 'LIKE', "%{$query}%")
//            ->orWhere('category', 'LIKE', "%{$query}%")
//            ->orWhere('sub_category_id', 'LIKE', "%{$query}%")
//            ->orWhere('child_category_id', 'LIKE', "%{$query}%")
//            ->get();

        if ($query === 'All') {
            $products = Product::all();
        } else {

            $products = Product::where('name', 'LIKE', "%{$query}%")->get();
        }
        $html = view('admin.partials.pur_product_list', compact('products'))->render();

        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }

    public function get_product_data(Request $request)
    {
//        return $request;
        $productId = $request->input('product_id');
        $product = Product::find($productId);

//        return $product;
        if(!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }

        $sessionProducts = session()->get('purchase_products', []);
        $allamounts = session()->get('ssn_additional');
//        return $sessionProducts;
        if (!isset($sessionProducts[$productId])) {
            $productData = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => number_format($product->price, 0, '.', ''),
                'quantity' => 1,
                'serial_method' => $product->purmode,
                'serial' => [],
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
        session(['purchase_products' => $sessionProducts]);

        return response()->json(['status' => true, 'products' => array_reverse($sessionProducts)]);
    }

    public function delete_product_data(Request $request)
    {
        $productId = $request->input('product_id');
        $products = session()->get('purchase_products', []);
        if (isset($products[$productId])) {
            unset($products[$productId]);
            session()->put('purchase_products', $products);
            return response()->json(['success' => true, 'products' => array_reverse($products)]);
        }
        return response()->json(['success' => false]);
    }

    public function update_quantity(Request $request)
    {
//        return $request;
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

//        return $quantity;
//        if (isNan($quantity)){
//            $quantity=1;
//        }else{
//            $quantity=0;
//        }
//        return $quantity;
        $sessionProducts = session()->get('purchase_products', []);
        if ($quantity < 1) {
            return response()->json(['status' => true, 'products' => array_reverse($sessionProducts)]);
//            return response()->json(['status' => false, 'message' => 'Invalid quantity']);
        }
//        return $quantity;
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }

        // Check if the requested quantity is greater than the available quantity
//        if ($quantity > $product->quantity) {
//            $quantity = $product->quantity;
//        }else{
//            $quantity = $product->quantity;
//        }


//return $sessionProducts[$productId];
        if (isset($sessionProducts[$productId])) {
            $sessionProducts[$productId]['quantity'] = $quantity;
            for ($x = 1; $x <= $sessionProducts[$productId]['quantity']; $x++){

                $sessionProducts[$productId]['serial'][]='';
            }
            session(['purchase_products' => $sessionProducts]);
            return response()->json(['status' => true, 'products' => array_reverse($sessionProducts)]);
        }

        return response()->json(['status' => false, 'message' => 'Product not found']);
    }

    public function update_product_price(Request $request)
    {
        $productId = $request->input('product_id');
        $newPrice = $request->input('price');

        $sessionProduct = session()->get('purchase_products', []);
        if (isset($sessionProduct[$productId])) {
            $sessionProduct[$productId]['price'] = $newPrice;
            session()->put('purchase_products', $sessionProduct);
            $sessionProducts = session()->get('purchase_products', []);
            return response()->json(['status' => true, 'products' => array_reverse($sessionProducts)]);
//            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false, 'message' => 'Product not found.']);
    }

    public function update_pdata(Request $request)
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

        $sessionProducts = session()->get('purchase_products', []);

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
            session()->put('purchase_products', $sessionProducts);

            return response()->json(['status' => true, 'product' => $sessionProducts[$productId]]);
        }

        return response()->json(['status' => false, 'message' => 'Product not found']);
    }

    public function fetch_product_data(Request $request)
    {
        $product_id = $request->input('id');
        $sessionProduct = session()->get('purchase_products', []);
        if (isset($sessionProduct[$product_id])) {
            return response()->json([
                'status' => true,
                'product' => $sessionProduct[$product_id]
            ]);
        }

        return response()->json(['status' => false]);
    }

    public function calculate_summary()
    {
        $products = session()->get('purchase_products', []);
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

        session()->put('purchase_additional', $sessionData);
        $all_amount =session()->get('purchase_additional', []);
        return response()->json(['status' => true, 'data' => $all_amount]);
//        return $all_amount;
//return $products;
//        $totals = array_reduce($products, function ($acc, $product) {
//            $price = intval($product['price']);
//            $quantity = intval($product['quantity']);
//            $subtotal = $price * $quantity;
//
//            $acc['subtotal'] += $subtotal;
//            $acc['totalVat'] += ($subtotal * (intval($product['vat']) / 100)) ?: 0;
//            $acc['totalTax'] += ($subtotal * (intval($product['tax']) / 100)) ?: 0;
//
//            if ($product['discount_type'] === 'percent') {
//                $acc['totalDiscount'] += $subtotal * (intval($product['discount']) / 100);
//            } else {
//                $acc['totalDiscount'] += intval($product['discount']);
//            }
//
//            return $acc;
//        }, ['subtotal' => 0, 'totalDiscount' => 0, 'totalVat' => 0, 'totalTax' => 0]);
//
//        $finalSubtotal = $totals['subtotal'] - $totals['totalDiscount'];
//
//        $sessionData = session()->get('purchase_additional', []);
//        $speed_money = $sessionData['speed_money'] ?? 0;
//        $freight = $sessionData['freight'] ?? 0;
//        $fractional_discount = $sessionData['fractional_discount'] ?? 0;
//
//        $sessionData['subtotal'] = intval($finalSubtotal);
//        $sessionData['discount'] = intval($totals['totalDiscount']);
//        $sessionData['vat'] = intval($totals['totalVat']);
//        $sessionData['tax'] = intval($totals['totalTax']);
//        $sessionData['speed_money'] = intval($speed_money);
//        $sessionData['freight'] = intval($freight);
//        $sessionData['fractional_discount'] = intval($fractional_discount);
//
//        $sessionData['grand_total'] = intval(($finalSubtotal + $totals['totalVat'] + $totals['totalTax'] + $speed_money + $freight) - $fractional_discount);
//
//        session()->put('purchase_additional', $sessionData);
//
//        return response()->json(['status' => true, 'data' => $sessionData]);
    }

    public function update_summary(Request $request)
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

        $sessionData = session()->get('purchase_additional');

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

        session()->put('purchase_additional', $sessionData);

        return response()->json(['status' => true, 'data' => $sessionData]);
    }

    // provide customer/supplier list in json
    public function walkin_search_api(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('walk_in');
        if ($type === 'customer') {
            $customers = Customer::where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->orWhere('mobile', 'LIKE', "%{$query}%")
                ->orWhere('cmobile', 'LIKE', "%{$query}%")
                ->orWhere('nid', 'LIKE', "%{$query}%")
                ->limit(10)
                ->get(['id', 'name', 'balance', 'image']);
            return response()->json(['walkin' => $customers]);
        } elseif ($type === 'supplier') {
            $suppliers = Supplier::where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->orWhere('mobile', 'LIKE', "%{$query}%")
                ->orWhere('nid', 'LIKE', "%{$query}%")
                ->limit(10)
                ->get(['id', 'name', 'balance', 'image']);
            return response()->json(['walkin' => $suppliers]);
        }
        return response()->json(['error' => 'Invalid type'], 400);
    }

    public function store_walkin_into_session(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $balance = $request->input('balance');
        $type = $request->input('type');
        $sessionData = session()->get('purchase_walkin', []);
        $sessionData['id'] = $id;
        $sessionData['name'] = $name;
        $sessionData['balance'] = $balance;
        $sessionData['type'] = $type;
        session()->put('purchase_walkin', $sessionData);
        return response()->json(['status' => true]);
    }

    //Serial
    public function remove_serial(Request $request)
    {
//return $request;
        $productId = $request->input('product_id');
        $index = $request->input('index');

        $sessionProducts = session()->get('purchase_products', []);
        if (isset($sessionProducts[$productId]) && $sessionProducts[$productId]['quantity'] > 1) {
            $sessionProducts[$productId]['quantity'] =intval($sessionProducts[$productId]['quantity'] ) - 1;
            if (isset($sessionProducts[$productId]) && isset($sessionProducts[$productId]['serial'][$index])) {
                // Remove the specific serial number
                unset($sessionProducts[$productId]['serial'][$index]);

                // Reindex the serial array to avoid gaps in the keys
                $sessionProducts[$productId]['serial'] = array_values($sessionProducts[$productId]['serial']);
            }

            }
//        session(['purchase_products' => $sessionProducts]);
        // Update the session with the modified data
        session()->put('purchase_products', $sessionProducts);
        return response()->json(['status' => true, 'products' => array_reverse($sessionProducts)]);
    }

    public function storeSerialInSession(Request $request)
    {
        $productId = $request->input('product_id');
        $serialNumber = $request->input('serial_number');
        $index = $request->input('index');
//return $request;
        // Retrieve session data
        $ssn_products = session()->get('purchase_products', []);
//return $ssn_products;
        // Check for uniqueness
        foreach ($ssn_products as $product) {
//            return $product;
            if ($product['id'] == $productId) {

                if (in_array($serialNumber, $product['serial'])) {
                    return response()->json(['unique' => false]);
                } else {
                    $ssn_products[$productId]['serial'][$index] = $serialNumber;
                    session()->put('purchase_products', $ssn_products);
                    return response()->json(['unique' => true,'products' => array_reverse($ssn_products)]);
                }
            }
        }

        return response()->json(['unique' => true]);
    }
//End Serial


    public function update_serial_method(Request $request)
    {
        $productId = $request->input('product_id');
        $serialMethod = $request->input('serial_method');
        $pro=Product::where('id',$productId)->first();
        $products = session()->get('purchase_products', []);
        if ($products['serial_method'] != null){
            $products[$productId]['serial_method'] = 'yes';
        }

        session()->put('purchase_products', $products);
        return response()->json(['status' => true]);
    }

    public function store_serials(Request $request)
    {
        $productId = $request->input('id');
        $serialNumbers = $request->input('serials', []);
        $sessionProducts = session()->get('purchase_products', []);

        if (isset($sessionProducts[$productId])) {
            $sessionProducts[$productId]['serial'] = $serialNumbers;
            session()->put('purchase_products', $sessionProducts);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
    }



    public function get_vendor(string $str)
    {
        if ($str == 'cus'){
            $vendor=Customer::get();
        }elseif ($str == 'sup'){
            $vendor=Supplier::get();
        }
        return response()->json(['status' => true, 'data' => $vendor]);
    }

    public function bank_type(string $str)
    {
//        return $str;
        if ($str == 'bank'){
            $bank=BankAccount::get();
        }elseif ($str == 'mobile'){
            $bank=BankMobile::get();
        }elseif ($str == 'cheque'){
//            return 'sarowar';
            $bank=BankCheque::all();
//            return $bank;
        }
        return response()->json(['status' => true, 'data' => $bank]);
    }

    public function get_bank_details(Request $request)
    {
        if ($request->bank_type == 'bank'){
            $bank=BankAccount::where('id',$request->id)->first();
            $bank_name='';
        }elseif ($request->bank_type == 'mobile'){
            $bank=BankMobile::where('id',$request->id)->first();
            $bank_name='';
        }elseif ($request->bank_type == 'cheque'){
            $bank=BankCheque::where('id',$request->id)->first();
            $bank_name=Bank::where('id',$bank->bank_account_id)->first();
        }
        return response()->json(['status' => true, 'data' => $bank,'bank_name'=>$bank_name]);
    }

    public function submit_bank_amount(Request $request)
    {
//        if ($request->bank_type == 'bank'){

            $info=session()->get('bank_info');
            $info['bank_type']=$request->bank_type;
            $info['bank_id']=$request->bank_id;
            $info['bank_name']=$request->bank_name;
            $info['bank_amount']=$request->bank_amount;
            $info['payment_amount']=$request->payment_amount;
//            $info['due']=$request->payment_amount;
            session()->put('bank_info',$info);
//            return session()->get('bank_info');
//            $bank=BankAccount::where('id',$request->bank_id)->first();
//            $bank_name=Bank::where('id',$bank->bank_id)->first();
//
//
//            $bank->balance=$bank->balance - $request->payment_amount;
//            $bank->update();
//
//            $data['account_no']=$bank->account_no;
//            $data['account_name']=$bank->account_holder;
//            $data['bank_name']=$bank_name->name;
//            $data['branch_name']=$bank->branch_name;
//            $data['amount']=$request->payment_amount;
//            $data['currency']='BDT';
//            $data['transaction_date']=today();
//            $data['status']='payment';
////            $data['note']=$bank->account_no;
//            $data['user_id']=$bank->user_id;
//            $data['branch_id']=$bank->branch_id;
//            $data['company_id']=$bank->company_id;
////            return $data;
//            $bank_data=BankTransaction::createOrUpdateBankTransaction($data);
//            return $bank_name;

//
//        }elseif ($request->bank_type == 'mobile'){
//            $bank=BankMobile::where('id',$request->bank_id)->first();
//            $bank_name='';
//        }elseif ($request->bank_type == 'cheque'){
//            $bank=BankCheque::where('id',$request->bank_id)->first();
//        }
        return response()->json(['status' => true]);
    }
    public function product_clear_all()
    {
        session()->forget('purchase_products');
        return response()->json(['status' => true]);
    }

    public function destroy_all_ssn()
    {
        session()->forget('purchase_walkin');
        session()->forget('purchase_additional');
        session()->forget('purchase_products');
        return response()->json(['status' => 'success', 'message' => 'Sessions cleared successfully']);
    }
}
