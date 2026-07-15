<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="StockFlow authentication page">
    <title>Login | Inventory Management System</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="auth-body">
    <button class="icon-button theme-toggle auth-theme-toggle" type="button" data-theme-toggle
        aria-label="Switch color theme" title="Switch color theme">
        <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
    </button>
    <main class="auth-page">
        <section class="auth-card">
            <a class="auth-brand" href="index.html"><span class="brand-icon"><i class="bi bi-grid-1x2-fill"
                        aria-hidden="true"></i></span><span><strong>Inventory Management System</strong><small>Sign in
                        to your admin workspace.</small></span></a>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Login failed!</strong> Please check your credentials and try again.
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('login.match') }}" class="needs-validation" novalidate>
                @csrf
                <div class="mb-4">
                    <p class="eyebrow mb-1">Secure Access</p>
                    <h1 class="h3 mb-1">Login</h1>
                    <p class="text-muted mb-0">Sign in to your admin workspace.</p>
                </div>
                <div class="mb-3"><label class="form-label" for="loginEmail">Email address</label><input
                        class="form-control" id="loginEmail" name="email" type="email" required>
                    <div class="invalid-feedback">Enter a valid email.</div>
                    <!-- Show error for email -->
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between"><label class="form-label"
                            for="loginPassword">Password</label><a class="small fw-semibold"
                            href="forgot-password.html">Forgot?</a></div><input class="form-control" id="loginPassword"
                        name="password" type="password" minlength="6" required>
                    <div class="invalid-feedback">Password must be at least 6 characters.</div>
                    <!-- Show error for password -->
                    @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check mb-4"><input class="form-check-input" type="checkbox" id="rememberMe"><label
                        class="form-check-label" for="rememberMe">Remember me</label></div>
                <button class="btn btn-primary w-100" type="submit"><i class="bi bi-box-arrow-in-right"
                        aria-hidden="true"></i> Sign In</button>
            </form>

        </section>
    </main>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
