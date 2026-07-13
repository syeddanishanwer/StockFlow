<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        // You can pass data here later
        // $stockItems = Stock::all();
        // return view('viewstock', compact('stockItems'));
        
        return view('viewstock');
    }

    public function create()
    {
        return view('category.addstock');
    }

    public function store(Request $request)
    {
        // Your store logic here
        // Stock::create($request->all());
        return redirect()->route('viewstock')->with('success', 'Stock item added successfully!');
    }
}