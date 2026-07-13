@extends('components.layout')

@section('title', 'Add Stock Item')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">INVENTORY MANAGEMENT</h2>
        <a href="{{ route('viewstock') }}" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-eye"></i> View Stock Items
        </a>
    </div>

    <div class="row">
        <!-- Stock Item Form -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Stock Item</div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="product_name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" name="category">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">SKU / Barcode</label>
                            <input type="text" class="form-control" name="sku">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Supplier</label>
                            <input type="text" class="form-control" name="supplier">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quantity in Stock</label>
                            <input type="number" class="form-control" name="quantity">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reorder Level</label>
                            <input type="number" class="form-control" name="reorder_level">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Item</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Guidelines Panel -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Stock Guidelines</div>
                <div class="card-body">
                    <p><strong>Track Inventory:</strong> Monitor stock levels to prevent shortages.</p>
                    <p><strong>Set Reorder Points:</strong> Configure alerts for low stock items.</p>
                    <p><strong>Supplier Management:</strong> Keep supplier details updated for quick reorders.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection