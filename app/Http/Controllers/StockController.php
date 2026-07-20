<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Bill;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    // Renders the table view listing items
    public function index()
    {
        $stockItems = Product::with(['category', 'supplier'])->get();
        return view('viewstock', compact('stockItems'));
    }

    // Renders the form page and passes dropdown dependencies
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('category.addstock', compact('categories', 'suppliers'));
    }

    // Handles saving a brand new product item to the stone-set table
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'quantity'     => 'required|integer|min:0',
            'category_id'  => 'required|integer|exists:categories,id',
            'supplier_id'  => 'required|integer|exists:suppliers,id',
        ]);

        Product::create([
            'product_name' => $validated['product_name'],
            'price'        => $validated['price'],
            'quantity'     => $validated['quantity'],
            'category_id'  => $validated['category_id'],
            'supplier_id'  => $validated['supplier_id'],
            'status'       => 'active', // Respects your migration default constraint safely
        ]);

        return redirect()->route('viewstock')->with('success', 'Stock item added successfully!');
    }

    /**
     * Store a new transaction (Bill + corresponding Sales items)
     */
    public function storeInvoice(Request $request)
    {
        $validated = $request->validate([
            'sale_date'    => 'required|date',
            'items'        => 'required|array|min:1',
            'items.*.id'   => 'required|integer|exists:products,id',
            'items.*.qty'  => 'required|integer|min:1',
            'items.*.price'=> 'required|numeric|min:0',
        ]);

        $totalAmount = 0;
        foreach ($validated['items'] as $item) {
            $totalAmount += $item['qty'] * $item['price'];
        }

        $bill = Bill::create([
            'sale_date'    => $validated['sale_date'],
            'total_amount' => $totalAmount,
            'user_id'      => Auth::id(), 
        ]);

        foreach ($validated['items'] as $item) {
            Sale::create([
                'quantity'    => $item['qty'],
                'unit_price'  => $item['price'],
                'total_price' => $item['qty'] * $item['price'],
                'sale_id'     => $bill->id, 
                'product_id'  => $item['id'],
            ]);

            Product::where('id', $item['id'])->decrement('quantity', $item['qty']);
        }

        return redirect()->route('viewstock')->with('success', 'Invoice and sales records processed successfully!');
    }
}