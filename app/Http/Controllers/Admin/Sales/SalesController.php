<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductSerial;
use App\Models\Sale;
use App\Models\Size;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function store_serial_sell(Request $request)
    {
        $productId = $request->input('product_id');
        $serialNumber = $request->input('serial_number');
        $index = $request->input('index');
        // Retrieve session data
        $ssn_products = session()->get('purchase_products', []);

        // Check for uniqueness
        foreach ($ssn_products as $product) {
            if ($product['id'] == $productId) {
                if (in_array($serialNumber, $product['serial'])) {
//                    return $serialNumber;
                    return response()->json(['unique' => false]);
                } else {
                    $pro_serials=ProductSerial::where('product_id',$productId)->where('is_sold','0')->get();
//return $pro_serials;
                    foreach ($pro_serials as $serial){
//                        return $serial->serial_number;
                        if ($serial->serial_number == $serialNumber){
                            $ssn_products[$productId]['serial'][$index] = $serialNumber;
                            session()->put('purchase_products', $ssn_products);
                            return response()->json(['unique' => true,'products' => array_reverse($ssn_products)]);
                        }

                    }
                    return response()->json(['unique' => false]);
                }
            }
        }

        return response()->json(['unique' => true]);
    }
}
