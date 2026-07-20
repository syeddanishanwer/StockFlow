@extends('components.layout')

@section('title', 'Add User')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">USER MANAGEMENT</h2>
            <a href="{{ route('viewusers') }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-eye"></i> View Users
            </a>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent fw-bold">Add User</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('adduser.save') }}">
                            @csrf
                            
                            <!-- Full Name -->
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       name="name"
                                       value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Username -->
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       name="username" 
                                       value="{{ old('username') }}">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" 
                                           class="form-control" 
                                           name="password_confirmation">
                                </div>
                            </div>

                            <!-- Role Select -->
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select @error('role') is-invalid @enderror" name="role">
                                    <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary px-4">Create User</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-header bg-transparent fw-bold border-0">Access Checklist</div>
                    <div class="card-body">
                        <p class="mb-2"><strong>Assign Role:</strong> Start with the least privileged role.</p>
                        <p class="mb-3"><strong>Username:</strong> Must be completely unique across the platform.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection