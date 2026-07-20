@extends('components.layout')

@section('title', 'View Stock Items')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">STOCK ITEMS</h2>
        <a href="{{ route('addstock') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add New Item
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Supplier</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stockItems as $item)
                            <tr>
                                <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $item->product_name }}</td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary">
                                        {{ $item->category->name ?? 'Unassigned' }}
                                    </span>
                                </td>
                                <td class="text-muted">
                                    {{ $item->supplier->supplier_name ?? '—' }}
                                </td>
                                <td>
                                    <span class="{{ $item->quantity < 5 ? 'text-danger fw-bold' : '' }}">
                                        {{ $item->quantity }}
                                    </span>
                                </td>
                                <td class="fw-bold">
                                    ${{ number_format($item->price, 2) }}
                                </td>
                                <td>
                                    <span class="badge {{ $item->status === 'active' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} text-capitalize">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group" role="group">
                                        <a href="#" class="btn btn-outline-secondary btn-sm"><i class="bi bi-pencil"></i></a>
                                        <button type="button" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="bi bi-box-seam display-4 d-block mb-3 text-secondary"></i>
                                    No stock items found in the inventory database.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection