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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Stock Item</div>
                <div class="card-body">
                    <!-- FIXED: Pointed to the proper POST saving route -->
                    <form method="POST" action="{{ route('addstock.save') }}">
                        @csrf
                        
                        <!-- Product Name -->
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}">
                            @error('product_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Category Dropdown Field -->
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Supplier Dropdown Field -->
                        <div class="mb-3">
                            <label class="form-label">Supplier</label>
                            <select class="form-select @error('supplier_id') is-invalid @enderror" name="supplier_id">
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->company_name }}</option>
                                @endforeach
                            </select>
                            @error('supplier_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Quantity in Stock -->
                        <div class="mb-3">
                            <label class="form-label">Quantity in Stock</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" min="0">
                            @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Price Field -->
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" min="0">
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection