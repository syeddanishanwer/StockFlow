@extends('components.layout')

@section('title', 'View Users')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">USER MANAGEMENT</h2>
            <a href="{{ route('addusers') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Add New User
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent fw-bold py-3">
                Active System Users
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <!-- 1. Combine first and last name columns from your database -->
                                    <td class="ps-4 fw-semibold">
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </td>

                                    <!-- 2. Display the email address column (since username doesn't exist in your DB) -->
                                    <td>{{ $user->email }}</td>

                                    <td>
                                        <span
                                            class="badge {{ $user->role === 'admin' ? 'bg-danger-subtle text-danger' : 'bg-info-subtle text-info' }} text-capitalize px-2.5 py-1.5">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success px-2.5 py-1.5 text-capitalize">
                                            {{ $user->status ?? 'Active' }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-outline-secondary btn-sm" title="Edit User">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                title="Delete User">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-people display-4 d-block mb-3 text-secondary"></i>
                                        No users found in the system database.
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
