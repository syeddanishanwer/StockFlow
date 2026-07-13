@extends('components.layout')

@section('content')
<div class="container-fluid py-4">

    <!-- Summary Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Products</h5>
                    <h2>{{ $totalProducts }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Low Stock</h5>
                    <h2>{{ $lowStockCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Today’s Sales</h5>
                    <h2>${{ number_format($todaySales, 2) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Active Users</h5>
                    <h2>{{ $activeUsers }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Trend Chart -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Sales Trend (Last 7 Days)</div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Category Breakdown -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Top Categories</div>
                <div class="card-body">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bills -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Recent Bills</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($recentSales as $bill)
                            <li class="list-group-item">
                                {{ $bill->sale_date }} - ${{ $bill->total_amount }} ({{ $bill->user->name ?? 'Unknown' }})
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Low Stock Products</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($lowStockProducts as $product)
                            <li class="list-group-item">
                                {{ $product->product_name }} ({{ $product->quantity }} left) - Supplier: {{ $product->supplier->supplier_name ?? 'N/A' }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Products -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Top Products (Last 30 Days)</div>
                <div class="card-body">
                    <canvas id="topProductsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sales Trend Chart
    new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: @json($salesLabels),
            datasets: [{
                label: 'Sales',
                data: @json($salesData),
                borderColor: 'blue',
                fill: false
            }]
        }
    });

    // Category Breakdown Chart
    new Chart(document.getElementById('categoryChart'), {
        type: 'pie',
        data: {
            labels: @json($categoryLabels),
            datasets: [{
                data: @json($categoryData),
                backgroundColor: ['red','green','blue','orange','purple']
            }]
        }
    });

    // Top Products Chart
    new Chart(document.getElementById('topProductsChart'), {
        type: 'bar',
        data: {
            labels: @json($topProductsLabels),
            datasets: [{
                label: 'Revenue',
                data: @json($topProductsData),
                backgroundColor: 'teal'
            }]
        }
    });
</script>
@endsection