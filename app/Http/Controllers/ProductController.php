<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    public function index()
    {
        $products = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->select(
                'products.*',
                'categories.name as category_name',
                'suppliers.supplier_name as supplier_name'
            )
            ->get();

        return view('viewproducts', compact('products'));
    }

    public function create()
    {
        $categories = DB::table('categories')->get();
        $suppliers = DB::table('suppliers')->get();

        return view('category.addproduct', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|integer',
            'supplier_id'  => 'required|integer',
            'price'        => 'required|numeric|min:0',
            'quantity'     => 'required|integer|min:0',
            'status'       => 'required|string|max:255',
        ]);

        DB::table('products')->insert([
            'product_name' => $validated['product_name'],
            'category_id'  => $validated['category_id'],
            'supplier_id'  => $validated['supplier_id'],
            'price'        => $validated['price'],
            'quantity'     => $validated['quantity'],
            'status'       => $validated['status'],
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return redirect()->route('viewproducts')->with('success', 'Product item added successfully!');
    }

    // Show the edit form for a single product
    public function edit($id)
    {
        // Fetch product record
        $product = DB::table('products')->where('id', $id)->first();

        // Abort with 404 if product doesn't exist
        if (!$product) {
            abort(404, 'Product not found');
        }

        // Fetch categories and suppliers for dropdowns
        $categories = DB::table('categories')->get();
        $suppliers = DB::table('suppliers')->get();

        return view('editproduct', compact('product', 'categories', 'suppliers'));
    }

    // Handle product update request
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|integer',
            'supplier_id'  => 'required|integer',
            'price'        => 'required|numeric|min:0',
            'quantity'     => 'required|integer|min:0',
            'status'       => 'required|string|max:255',
        ]);

        DB::table('products')->where('id', $id)->update([
            'product_name' => $validated['product_name'],
            'category_id'  => $validated['category_id'],
            'supplier_id'  => $validated['supplier_id'],
            'price'        => $validated['price'],
            'quantity'     => $validated['quantity'],
            'status'       => $validated['status'],
            'updated_at'   => now(),
        ]);

        return redirect()->route('viewproducts')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('viewproducts')->with('success', 'Product item deleted successfully!');
    }

 public function sell(Request $request, $id)
{
    $validated = $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $product = DB::table('products')->where('id', $id)->first();

    if (!$product || $product->quantity < $validated['quantity']) {
        return back()->with('error', 'Insufficient stock or invalid product!');
    }

    DB::transaction(function () use ($product, $validated, $request) {
        $quantitySold = $validated['quantity'];
        $unitPrice = $product->price;
        $totalPrice = $unitPrice * $quantitySold;

        // 1. Insert header record in 'bills' table
        $billId = DB::table('bills')->insertGetId([
            'sale_date'    => now()->toDateString(),
            'total_amount' => $totalPrice,
            'user_id'      => $request->user()?->id, // Authenticated cashier ID
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // 2. Insert line item in 'sales' table linked to $billId
        DB::table('sales')->insert([
            'product_id'  => $product->id,
            'quantity'    => $quantitySold,
            'unit_price'  => $unitPrice,
            'total_price' => $totalPrice,
            'sale_id'     => $billId, // Foreign key referencing bills.id
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // 3. Deduct product inventory
        DB::table('products')
            ->where('id', $product->id)
            ->decrement('quantity', $quantitySold);
    });

    return redirect()->route('viewproducts')->with('success', 'Sale recorded successfully!');
}
}
