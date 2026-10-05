@extends('components.layout')

@section('title', 'View product Items')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">PRODUCTS</h2>
            <a href="{{ route('addproducts') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Add New Product
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Supplier</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->product_name }} </td>
                                    <td>{{ $product->category->name ?? 'N/A' }} </td>
                                    <td>{{ $product->supplier->supplier_name ?? 'N/A' }} </td>
                                    <td>${{ number_format($product->price, 2) }} </td>
                                    <td>{{ $product->quantity }} </td>
                                    <td>
                                        <span
                                            class = "badge {{ $product->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </td>

                                                                        <td>
                                        <!-- Sell Button -->
                                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                            data-bs-target="#sellProductModal{{ $product->id }}" title="Sell Item">
                                            <i class="bi bi-cart-plus"></i>
                                        </button>

                                        <!-- Edit Button -->
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-sm btn-outline-info"><i class="bi bi-pencil"></i></a>

                                        <!-- Delete Form -->
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this item?')"
                                                title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                    <!-- Sell Modal for Each Product -->
                                    <div class="modal fade" id="sellProductModal{{ $product->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('products.sell', $product->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Sell - {{ $product->product_name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Available Quantity</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $product->quantity }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Unit Price ($)</label>
                                                            <input type="text" class="form-control"
                                                                value="${{ number_format($product->price, 2) }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Quantity to Sell <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" name="quantity" class="form-control"
                                                                min="1" max="{{ $product->quantity }}"
                                                                placeholder="Enter quantity" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success"
                                                            {{ $product->quantity < 1 ? 'disabled' : '' }}>
                                                            Confirm Sale
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No product items found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
