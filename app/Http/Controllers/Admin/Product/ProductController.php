<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Color;
use App\Models\Manufacture;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!auth()->user()->can('view product'),403,__('User does not have the right permissions.'));
        return view('admin.product.product.index', [
            'products'=>Product::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create product'),403,__('User does not have the right permissions.'));

        return view('admin.product.product.create',[
            'brands' => Brand::all(),
            'categories' => Category::all(),
            'subCategories' => SubCategory::all(),
            'childCategories' => ChildCategory::all(),
            'colors' => Color::all(),
            'sizes' => Size::all(),
            'units'=> Unit::all(),
            'manufacturers'=> Manufacture::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//                return $request;
        abort_if(!auth()->user()->can('create category'),403,__('User does not have the right permissions.'));
        $store=Product::createOrUpdateUser($request);
//        return $store;

        return redirect()->route('product.index')->with('success','Product create successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product=Product::find($id);
        return view('admin.product.product.show',[
            'product'=>$product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!auth()->user()->can('update product'),403,__('User does not have the right permissions.'));

        $product=Product::find($id);
        return view('admin.product.product.edit',[
            'product'=>$product,
            'brands' => Brand::all(),
            'categories' => Category::all(),
            'subCategories' => SubCategory::all(),
            'childCategories' => ChildCategory::all(),
            'colors' => Color::all(),
            'sizes' => Size::all(),
            'units'=> Unit::all(),
            'manufacturers'=> Manufacture::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!auth()->user()->can('update product'),403,__('User does not have the right permissions.'));
        $store=Product::createOrUpdateUser($request,$id);
//        return $store;

        return redirect()->route('product.index')->with('success','Product Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        {
//        return $id;
            abort_if(!auth()->user()->can('delete product'),403,__('User does not have the right permissions.'));
            $delete=Product::find($id);
            if (file_exists($delete->image)){
                unlink(public_path($delete->image));
            }

            $delete->delete();
            return redirect()->route('product.index')->with('error','Product delete successfully');
        }
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

    public function select_product()
    {
//        abort_if(!auth()->user()->can('view product'),403,__('User does not have the right permissions.'));
        return view('admin.product.product.select_product', [
            'products' => Product::get(),
            'colors' => Color::get(),
            'sizes' => Size::get(),
            'units' => Unit::get()
        ]);
    }

    public function filter_products(Request $request)
    {
        $query = $request->input('query', '');

        if ($query === 'All') {
            $products = Product::all();
        } else {
            $products = Product::where('name', 'like', $query . '%')->get();
        }

        $html = view('partials.pur_product_list', compact('products'))->render();

        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }

    public function get_product_data(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if(!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }

        $sessionProducts = session()->get('purchase_products', []);
        if (!isset($sessionProducts[$productId])) {
            $productData = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => number_format($product->price, 0, '.', ''),
                'quantity' => 1,
                'serial_method' => 'auto',
                'serial' => [],
                'discount_type' => $product->discount_type,
                'discount' => number_format($product->discount, 0, '.', ''),
                'vat_type' => '',
                'vat' => '',
                'tax_type' => '',
                'tax' => $product->tax,
                'size' => $product->size->name,
                'color' => $product->color->name,
                'warranty_days' => ''
            ];
            $sessionProducts[$productId] = $productData;
        }

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
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        if ($quantity < 1) {
            return response()->json(['status' => false, 'message' => 'Invalid quantity']);
        }

        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }

        // Check if the requested quantity is greater than the available quantity
        if ($quantity > $product->quantity) {
            $quantity = $product->quantity;
        }

        $sessionProducts = session()->get('purchase_products', []);

        if (isset($sessionProducts[$productId])) {
            $sessionProducts[$productId]['quantity'] = $quantity;
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
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false, 'message' => 'Product not found.']);
    }

    public function update_pdata(Request $request)
    {
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

        $totals = array_reduce($products, function ($acc, $product) {
            $price = intval($product['price']);
            $quantity = intval($product['quantity']);
            $subtotal = $price * $quantity;

            $acc['subtotal'] += $subtotal;
            $acc['totalVat'] += ($subtotal * (intval($product['vat']) / 100)) ?: 0;
            $acc['totalTax'] += ($subtotal * (intval($product['tax']) / 100)) ?: 0;

            if ($product['discount_type'] === 'percent') {
                $acc['totalDiscount'] += $subtotal * (intval($product['discount']) / 100);
            } else {
                $acc['totalDiscount'] += intval($product['discount']);
            }

            return $acc;
        }, ['subtotal' => 0, 'totalDiscount' => 0, 'totalVat' => 0, 'totalTax' => 0]);

        $finalSubtotal = $totals['subtotal'] - $totals['totalDiscount'];

        $sessionData = session()->get('purchase_additional', []);
        $speed_money = $sessionData['speed_money'] ?? 0;
        $freight = $sessionData['freight'] ?? 0;
        $fractional_discount = $sessionData['fractional_discount'] ?? 0;

        $sessionData['subtotal'] = intval($finalSubtotal);
        $sessionData['discount'] = intval($totals['totalDiscount']);
        $sessionData['vat'] = intval($totals['totalVat']);
        $sessionData['tax'] = intval($totals['totalTax']);
        $sessionData['speed_money'] = intval($speed_money);
        $sessionData['freight'] = intval($freight);
        $sessionData['fractional_discount'] = intval($fractional_discount);

        $sessionData['grand_total'] = intval(($finalSubtotal + $totals['totalVat'] + $totals['totalTax'] + $speed_money + $freight) - $fractional_discount);

        session()->put('purchase_additional', $sessionData);

        return response()->json(['status' => true, 'data' => $sessionData]);
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

        $sessionData = session()->get('purchase_additional', []);

        $sessionData['reference'] = $reference;
        $sessionData['note'] = $note;
        $sessionData['subtotal'] = intval($subtotal);
        $sessionData['discount'] = intval($discount);
        $sessionData['vat'] = intval($vat);
        $sessionData['tax'] = intval($tax);
        $sessionData['speed_money'] = intval($speed_money);
        $sessionData['freight'] = intval($freight);
        $sessionData['fractional_discount'] = intval($fractional_discount);

        $sessionData['grand_total'] = intval(($subtotal + $vat + $tax + $speed_money + $freight) - $fractional_discount);

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

    public function update_serial_method(Request $request)
    {
        $productId = $request->input('product_id');
        $serialMethod = $request->input('serial_method');
        $products = session()->get('purchase_products', []);
        $products[$productId]['serial_method'] = $serialMethod;
        session()->put('purchase_products', $products);
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


    /**
     * Display a listing of the resource.
     */
//    public function index()
//    {
//        abort_if(!auth()->user()->can('view product'),403,__('User does not have the right permissions.'));
//        return view('admin.product.product.index', [
//            'products'=>Product::get()
//        ]);
//    }
//
//
//    public function select_product()
//    {
////        abort_if(!auth()->user()->can('view product'),403,__('User does not have the right permissions.'));
//        return view('admin.product.product.select_product', [
//            'products'=>Product::get()
//        ]);
//    }
//    public function pro_qty_change(Request $request, string $id)
//    {
////        return $request->qty;
//        $currentData = session()->get('purches_item', []);
//        $amountdata=session()->get('amount_data');
//        foreach($currentData as $key=>$data){
//            if ($data['product_id'] == $id){
//                $product=Product::find($id);
//                $inc_val=$request->qty - $data['product_qty'];
//                $price=($product->price * $request->qty) - $data['product_price'];
//                $currentData[$key]['product_qty'] = $request->qty;
//                $currentData[$key]['product_price'] = $product->price * $request->qty;
//                $item2=[
//                    'total_item'=>$amountdata['total_item'] + ($inc_val),
//                    'total_taka'=>$amountdata['total_taka'] + $price,
//                ];
////                unset($currentData[$key]);
////                $i++;
//                // Update the product_qty (for example, increment by 1)
//
//
//
//                $amount_data=$item2;
//
//                // Save the updated data back to the session
////                    session()->put('purches_item', $currentData);
//            }
//        }
//        session()->put('purches_item', $currentData);
//        session()->put('amount_data', $amount_data);
//
//        $product_data= session()->get('purches_item');
//        $amount_data= session()->get('amount_data');
//
////        return $amount_data;
//        return response(['data'=>$product_data,'amount'=>$amount_data]);
//    }
//    public function delete_select_product(string $id)
//    {
//        $currentData = session()->get('purches_item', []);
//        $amountdata=session()->get('amount_data');
////        return $amountdata;
//        foreach($currentData as $key=>$data){
//            if ($data['product_id'] == $id){
//                $item2=[
//                    'total_item'=>$amountdata['total_item'] - $data['product_qty'],
//                    'total_taka'=>$amountdata['total_taka'] - $data['product_price'],
//                ];
//                unset($currentData[$key]);
////                $i++;
//                // Update the product_qty (for example, increment by 1)
////                $currentData[$key]['product_id'] = $data['product_qty'] + 1;
////                $currentData[$key]['product_price'] = $data['product_price'] + $product->price;
//
//
//                $amount_data=$item2;
//
//                // Save the updated data back to the session
////                    session()->put('purches_item', $currentData);
//            }
//        }
//        session()->put('purches_item', $currentData);
//        session()->put('amount_data', $amount_data);
//
//        $product_data= session()->get('purches_item');
//        $amount_data= session()->get('amount_data');
////        return $amountdata;
//        return response(['data'=>$product_data,'amount'=>$amount_data]);
//
//    }
//    public function get_product(string $id)
//    {
//        $product=Product::find($id);
////session()->forget('purches_item');
////session()->forget('amount_data');
////return
//        $currentData = session()->get('purches_item', []);
//        $amountdata=session()->get('amount_data');
////return $currentData;
//        if(!empty($currentData)){
////            return 'saro';
//            $i=0;
//            foreach($currentData as $key=>$data){
//                if ($data['product_id'] == $product->id){
//                    $i++;
//                    // Update the product_qty (for example, increment by 1)
//                    $currentData[$key]['product_qty'] = $data['product_qty'] + 1;
//                    $currentData[$key]['product_price'] = $data['product_price'] + $product->price;
//                    $item2=[
//                        'total_item'=>$amountdata['total_item']+1,
//                        'total_taka'=>$amountdata['total_taka']+$product->price,
//                    ];
//
//                    $amount_data=$item2;
//
//                    // Save the updated data back to the session
////                    session()->put('purches_item', $currentData);
//                }
//            }
//            if ($i==0){
//                $item=[
//                    'product_id'=>$product->id,
//                    'product_name'=>$product->name,
//                    'product_price'=>$product->price,
//                    'product_image'=>$product->image,
//                    'product_qty'=>1,
//                ];
//
////                foreach ($amountdata as $key =>$adata){
////
////                }
////                $amountdata['total_item']=$amountdata['total_item']+1;
////                $amountdata['total_taka']=$amountdata['total_taka']+$product->price;
//                $item2=[
//                    'total_item'=>$amountdata['total_item']+1,
//                    'total_taka'=>$amountdata['total_taka']+$product->price,
//                ];
//
//                $amount_data=$item2;
//                $currentData[] = $item;
//            }
//        }else{
//            $item=[
//                'product_id'=>$product->id,
//                'product_name'=>$product->name,
//                'product_price'=>$product->price,
//                'product_image'=>$product->image,
//                'product_qty'=>1,
//            ];
//            $item2=[
//                'total_item'=>1,
//                'total_taka'=>$product->price,
//            ];
//
//            $amount_data=$item2;
//            $currentData[] = $item;
////            session()->put('purches_item', $currentData);
//        }
//        session()->put('purches_item', $currentData);
//        session()->put('amount_data', $amount_data);
//
//
//$product_data= session()->get('purches_item');
//$amount_data= session()->get('amount_data');
//
//
////        if (empty(session()->get('purches_item'))){
////            $currentData[] = $item;
////            session()->put('purches_item', $currentData);
//////            session()->put(['data'=>$item]);
////        }else{
////            // Retrieve the current session data or initialize an empty array if not set
////            $currentData = session()->get('purches_item', []);
////
////// Append the new item to the existing array
////            $currentData[] = $item;
////
////// Store the updated array back into the session
////            session()->put('purches_item', $currentData);
////        }
//////        session(['data'=>$product]);
////
//////        session([ 'data' => $cart]);
////
////        return session()->get('purches_item');
//
//        return response(['data'=>$product_data,'amount'=>$amount_data]);
//
//
//    }
//
//
//    /**
//     * Show the form for creating a new resource.
//     */
//    public function create()
//    {
//        abort_if(!auth()->user()->can('create product'),403,__('User does not have the right permissions.'));
//
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
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(Request $request)
//    {
////                return $request;
//        abort_if(!auth()->user()->can('create category'),403,__('User does not have the right permissions.'));
//        $store=Product::createOrUpdateUser($request);
////        return $store;
//
//        return redirect()->route('product.index')->with('success','Product create successfully');
//    }
//
//    /**
//     * Display the specified resource.
//     */
//    public function show(string $id)
//    {
//        $product=Product::find($id);
//        return view('admin.product.product.show',[
//            'product'=>$product,
//        ]);
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(string $id)
//    {
//        abort_if(!auth()->user()->can('update product'),403,__('User does not have the right permissions.'));
//
//        $product=Product::find($id);
//        return view('admin.product.product.edit',[
//            'product'=>$product,
//            'brands' => Brand::all(),
//            'categories' => Category::all(),
//            'subCategories' => SubCategory::all(),
//            'childCategories' => ChildCategory::all(),
//            'colors' => Color::all(),
//            'sizes' => Size::all(),
//            'units'=> Unit::all(),
//            'manufacturers'=> Manufacture::all()
//        ]);
//    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(Request $request, string $id)
//    {
//        abort_if(!auth()->user()->can('update product'),403,__('User does not have the right permissions.'));
//        $store=Product::createOrUpdateUser($request,$id);
////        return $store;
//
//        return redirect()->route('product.index')->with('success','Product Update successfully');
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(string $id)
//    {
//        {
////        return $id;
//            abort_if(!auth()->user()->can('delete product'),403,__('User does not have the right permissions.'));
//            $delete=Product::find($id);
//        if (file_exists($delete->image)){
//            unlink(public_path($delete->image));
//        }
//
//            $delete->delete();
//            return redirect()->route('product.index')->with('error','Product delete successfully');
//        }
//    }
//
//    public function get_sub_cat(string $id)
//    {
//        $sub_cat=SubCategory::where('category_id',$id)->get();
//
//        return response(['data'=>$sub_cat]);
//    }
//    public function get_child_cat(string $id)
//    {
//        $child_cat=ChildCategory::where('sub_cat_id',$id)->get();
//
//        return response(['data'=>$child_cat]);
//    }
}
