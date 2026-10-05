@extends('components.layout')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">EDIT USER</h2>
        <a href="{{ route('viewusers') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Back to Users
        </a>
    </div>

    <div class="card col-md-8 mx-auto">
        <div class="card-header">Edit User Details</div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Full Name -->
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <!-- Username / Email -->
                <div class="mb-3">
                    <label class="form-label">Username / Email</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}" required>
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}">
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select class="form-select" name="role" required>
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <!-- Team -->
                <div class="mb-3">
                    <label class="form-label">Team</label>
                    <input type="text" class="form-control" name="team" value="{{ old('team', $user->team) }}">
                </div>

                <button type="submit" class="btn btn-primary">Update User</button>
                <a href="{{ route('viewusers') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection