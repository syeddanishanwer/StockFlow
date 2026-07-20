@extends('components.layout')

@section('title', 'Add Supplier')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">SUPPLIER MANAGEMENT</h2>
        <a href="{{ route('viewsuppliers') }}" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-eye"></i> View Suppliers
        </a>
    </div>

    <div class="row">
        <!-- Supplier Registration Form -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent fw-bold">Register New Supplier</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('addsupplier.save') }}">
                        @csrf
                        
                        <!-- Supplier Name Field -->
                        <div class="mb-3">
                            <label class="form-label">Supplier / Company Name</label>
                            <input type="text" 
                                   class="form-control @error('supplier_name') is-invalid @enderror" 
                                   name="supplier_name" 
                                   value="{{ old('supplier_name') }}">
                            @error('supplier_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   name="phone" 
                                   value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address Field -->
                        <div class="mb-3">
                            <label class="form-label">Business Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      name="address" 
                                      rows="3">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary px-4">Save Supplier</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Utility Guidelines Sidebar -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-header bg-transparent fw-bold border-0">Supplier Integrity</div>
                <div class="card-body">
                    <p class="mb-2"><strong>Accurate Records:</strong> Ensure phone lines are accurate for placing dynamic inventory purchase updates.</p>
                    <p class="mb-0"><strong>Stock Linkage:</strong> Once saved, this entity will show up inside your "Add Stock Item" selection workflow.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection