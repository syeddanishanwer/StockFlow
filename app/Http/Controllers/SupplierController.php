<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the suppliers.
     */
    public function index()
    {
        $suppliers = Supplier::where('status','active')->get();
        return view('viewsupplier', compact('suppliers'));
    }

    /**
     * Show the form for creating a new supplier.
     */
    public function create()
    {
        return view('category.addsupplier');
    }

    /**
     * Store a newly created supplier in the database.
     */
    public function store(Request $request)
    {
        // Validates input values directly against your table requirements
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'phone'         => 'required|string|max:255',
            'address'       => 'required|string|max:500',
        ]);

        // Clean mass assignment execution
        Supplier::create($validated);

        return redirect()->route('viewsuppliers')->with('success', 'Supplier registered successfully!');
    }

    public function deactivate ($id){
        
    // Change the status
    $user = Supplier::findOrFail($id);
    $user->status='inactive';
    $user->save();
    return redirect()->back()->with('success','User deactivated successfully.');  
    }
}