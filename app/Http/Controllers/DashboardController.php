<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total Products
        $totalProducts = Product::count();
        
        // 2. Low Stock Items (quantity less than 10)
        $lowStockCount = Product::where('quantity', '<', 10)->count();
        
        // 3. Today's Sales Total (from bills table)
        $todaySales = Bill::whereDate('sale_date', today())->sum('total_amount');
        
        // 4. Active Users (status = 'active')
        $activeUsers = User::where('status', 'active')->count();
        
        // 5. Sales Trend (Last 7 Days) - from bills table
        $salesLabels = [];
        $salesData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $salesLabels[] = $date->format('D');
            $salesData[] = Bill::whereDate('sale_date', $date)->sum('total_amount');
        }
        
        // 6. Category Breakdown - Get sales by category
        $categoryData = Category::select('categories.name')
            ->selectRaw('COALESCE(SUM(sales.total_price), 0) as total_sales')
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->leftJoin('sales', 'products.id', '=', 'sales.product_id')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();
        
        $categoryLabels = $categoryData->pluck('name')->toArray();
        $categoryValues = $categoryData->pluck('total_sales')->toArray();
        
        // If no data, provide defaults
        if (empty($categoryLabels)) {
            $categoryLabels = ['No Data'];
            $categoryValues = [1];
        }
        
        // 7. Recent Bills (with user data)
        $recentBills = Bill::with('user')
            ->latest()
            ->take(5)
            ->get();
        
        // 8. Low Stock Products (with supplier data)
        $lowStockProducts = Product::with('supplier')
            ->where('quantity', '<', 10)
            ->where('status', 'active')
            ->take(5)
            ->get();
        
        // 9. Top 5 Products by Revenue (Last 30 days)
        $topProducts = Product::select('products.product_name')
            ->selectRaw('COALESCE(SUM(sales.total_price), 0) as revenue')
            ->leftJoin('sales', 'products.id', '=', 'sales.product_id')
            ->leftJoin('bills', 'sales.sale_id', '=', 'bills.id')
            ->where('bills.sale_date', '>=', now()->subDays(30))
            ->orWhereNull('bills.sale_date') // Include products with no sales
            ->groupBy('products.id', 'products.product_name')
            ->orderByDesc('revenue')
            ->limit(5)
            ->get();
        
        $topProductsLabels = $topProducts->pluck('product_name')->toArray();
        $topProductsData = $topProducts->pluck('revenue')->toArray();
        
        // If no data, provide defaults
        if (empty($topProductsLabels)) {
            $topProductsLabels = ['No Sales Data'];
            $topProductsData = [0];
        }
        
        return view('dashboard', [
            'totalProducts' => $totalProducts,
            'lowStockCount' => $lowStockCount,
            'todaySales' => $todaySales,
            'activeUsers' => $activeUsers,
            'salesLabels' => $salesLabels,
            'salesData' => $salesData,
            'categoryLabels' => $categoryLabels,
            'categoryData' => $categoryValues,
            'recentSales' => $recentBills, // Using bills as recent sales
            'lowStockProducts' => $lowStockProducts,
            'topProductsLabels' => $topProductsLabels,
            'topProductsData' => $topProductsData,
        ]);
    }
}