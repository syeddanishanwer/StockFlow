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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- User Form -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add User</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('adduser.save') }}" class= "needs-validation" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name"
                                    value="{{ old('first_name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select" name="role">
                                    <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee
                                    </option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Team</label>
                                <input type="text" class="form-control" name="team" value="{{ old('team') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" name="notes">{{ old('notes') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Checklist Panel -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Access Checklist</div>
                    <div class="card-body">
                        <p><strong>Assign Role:</strong> Start with least privileged role.</p>
                        <p><strong>Add Team:</strong> Team ownership controls dashboards.</p>
                        <p><strong>Send Invite:</strong> Notify users with login credentials.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
