<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;


// Login page (GET)
Route::get('/', function () {
    return view('welcome');
})->name('login');

// Login form submission (POST)
Route::post('/loginmatch', [AuthController::class, 'match'])->name('login.match');

// Products Routes with grouped authentication middleware
Route::middleware('auth')->group(function () {

    // Dashboard (GET) – safe to refresh
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/view-product', [productController::class, 'index'])->name('viewproducts');
    Route::get('/add-product', [productController::class, 'create'])->name('addproducts');
    Route::post('/add-product', [productController::class, 'store']);
    Route::get('/products/{product}/edit', [productController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [productController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [productController::class, 'destroy'])->name('products.destroy');
    Route::post('/products/{id}/sell', [productController::class, 'sell'])->name('products.sell')->middleware('auth');

    Route::get('/view-users', [UserController::class, 'index'])->name('viewusers');
    Route::get('/add-user', [UserController::class, 'create'])->name('addusers');
    Route::post('/add-user', [UserController::class, 'store']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


    // Quick Store Routes
    Route::post('/categories/store', function (Request $request) {
        $request->validate(['name' => 'required|string|max:255']);
        DB::table('categories')->insert([
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return back()->with('success', 'Category created successfully!');
    })->name('categories.store');

    Route::post('/suppliers/store', function (Request $request) {
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'phone'         => 'nullable|string|max:50',
            'address'       => 'nullable|string|max:500',
        ]);

        DB::table('suppliers')->insert([
            'supplier_name' => $validated['supplier_name'],
            'phone'         => $validated['phone'] ?? null,
            'address'       => $validated['address'] ?? null,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return back()->with('success', 'Supplier created successfully!');
    })->name('suppliers.store');

    // Category Update & Delete Routes
    Route::put('/categories/{id}', function (Request $request, $id) {
        $request->validate(['category_name' => 'required|string|max:255']);

        DB::table('categories')->where('id', $id)->update([
            'name' => $request->category_name,
            'updated_at'    => now()
        ]);
        return back()->with('success', 'Category updated successfully!');
    })->name('categories.update');

    Route::delete('/categories/{id}', function ($id) {
        DB::table('categories')->where('id', $id)->delete();
        return back()->with('success', 'Category deleted successfully!');
    })->name('categories.destroy');

    // Supplier Update & Delete Routes
    Route::put('/suppliers/{id}', function (Request $request, $id) {
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'phone'         => 'nullable|string|max:50',
            'address'       => 'nullable|string|max:500',
        ]);

        DB::table('suppliers')->where('id', $id)->update([
            'supplier_name' => $validated['supplier_name'],
            'phone'         => $validated['phone'] ?? null,
            'address'       => $validated['address'] ?? null,
            'updated_at'    => now()
        ]);
        return back()->with('success', 'Supplier updated successfully!');
    })->name('suppliers.update');

    Route::delete('/suppliers/{id}', function ($id) {
        DB::table('suppliers')->where('id', $id)->delete();
        return back()->with('success', 'Supplier deleted successfully!');
    })->name('suppliers.destroy');

    // For a custom logout
    Route::post('/logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});
