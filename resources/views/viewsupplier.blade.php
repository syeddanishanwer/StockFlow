@extends('components.layout')

@section('title', 'View Suppliers')

@section('content')
<div class="container-fluid px-4">
    <!-- Action Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">SUPPLIERS</h2>
        <a href="{{ route('addsupplier') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add New Supplier
        </a>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Supplier Card Wrapper -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 80px;">#</th>
                            <th>Supplier Name</th>
                            <th>Phone Contact</th>
                            <th>Business Address</th>
                            <th class="text-end pe-4" style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $supplier)
                            <tr>
                                <td class="ps-4 text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-primary">{{ $supplier->supplier_name }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td class="text-secondary text-truncate" style="max-width: 300px;">
                                    {{ $supplier->address }}
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group" role="group">
                                        <a href="#" class="btn btn-outline-secondary btn-sm" title="Edit Data">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" title="Remove Record">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-building display-4 d-block mb-3 text-secondary"></i>
                                    No registered suppliers found in the database system layout.
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