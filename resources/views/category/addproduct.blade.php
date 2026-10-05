@extends('components.layout')

@section('title', 'Add Product Item')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">INVENTORY MANAGEMENT</h2>
            <a href="{{ route('viewproducts') }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-eye"></i> View Product Items
            </a>
        </div>

        <div class="row">
            <!-- Product Item Form -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Product Item</div>
                    <div class="card-body">

                        <!-- Display Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('addproducts') }}" method="POST">
                            @csrf

                            <!-- Product Name -->
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="product_name"
                                    value="{{ old('product_name') }}" required>
                            </div>

                            <!-- Category Selection -->
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <div class="input-group">
                                    <select class="form-select" name="category_id" id="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name ?? $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <!-- View All Categories Modal Trigger -->
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#viewCategoriesModal" title="View Categories">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <!-- Add New Category Modal Trigger -->
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                        data-bs-target="#addCategoryModal" title="Add New Category">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Supplier Selection -->
                            <div class="mb-3">
                                <label class="form-label">Supplier</label>
                                <div class="input-group">
                                    <select class="form-select" name="supplier_id" id="supplier_id" required>
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->name ?? $supplier->supplier_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <!-- View All Suppliers Modal Trigger -->
                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#viewSuppliersModal" title="View Suppliers">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <!-- Add New Supplier Modal Trigger -->
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                        data-bs-target="#addSupplierModal" title="Add New Supplier">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" name="price"
                                    value="{{ old('price') }}" required>
                            </div>

                            <!-- Quantity -->
                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}"
                                    required>
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Item</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Guidelines Panel -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Product Guidelines</div>
                    <div class="card-body">
                        <p><strong>Track Inventory:</strong> Monitor product levels to prevent shortages.</p>
                        <p><strong>Supplier Management:</strong> Keep supplier details updated for quick reorders.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal: Add Category -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: View Categories List -->
    <div class="modal fade" id="viewCategoriesModal" tabindex="-1" aria-labelledby="viewCategoriesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewCategoriesModalLabel">All Categories</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @forelse($categories as $category)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $category->name ?? $category->category_name }}</strong>
                                    <span class="badge bg-primary rounded-pill ms-2">ID: {{ $category->id }}</span>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <!-- Trigger Edit Category Modal -->
                                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#editCategoryModal{{ $category->id }}" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <!-- Delete Category Form -->
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this category?')"
                                            title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">No categories found.</li>
                        @endforelse
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Dynamic Edit Modals for Each Category -->
    @foreach ($categories as $category)
        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control"
                                    value="{{ $category->name ?? $category->category_name }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    <!-- Modal: Add New Supplier -->
    <div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSupplierModalLabel">Add New Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Supplier Name -->
                        <div class="mb-3">
                            <label class="form-label">Supplier Name <span class="text-danger">*</span></label>
                            <input type="text" name="supplier_name" class="form-control"
                                placeholder="Enter supplier name" required>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="e.g. +1 555-0199">
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Enter full address..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Supplier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: View Suppliers List -->
    <div class="modal fade" id="viewSuppliersModal" tabindex="-1" aria-labelledby="viewSuppliersModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewSuppliersModalLabel">All Suppliers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @forelse($suppliers as $supplier)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $supplier->supplier_name ?? $supplier->name }}</strong>
                                    <span class="badge bg-primary rounded-pill ms-2">ID: {{ $supplier->id }}</span>
                                    @if (!empty($supplier->phone))
                                        <br><small class="text-muted"><i class="bi bi-telephone"></i>
                                            {{ $supplier->phone }}</small>
                                    @endif
                                    @if (!empty($supplier->address))
                                        <br><small class="text-muted"><i class="bi bi-geo-alt"></i>
                                            {{ $supplier->address }}</small>
                                    @endif
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <!-- Trigger Edit Supplier Modal -->
                                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                        data-bs-target="#editSupplierModal{{ $supplier->id }}" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <!-- Delete Supplier Form -->
                                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this supplier?')"
                                            title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">No suppliers found.</li>
                        @endforelse
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Dynamic Edit Modals for Each Supplier -->
    @foreach ($suppliers as $supplier)
        <div class="modal fade" id="editSupplierModal{{ $supplier->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Supplier</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Supplier Name <span class="text-danger">*</span></label>
                                <input type="text" name="supplier_name" class="form-control"
                                    value="{{ $supplier->supplier_name ?? $supplier->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ $supplier->phone }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="3">{{ $supplier->address }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Supplier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
