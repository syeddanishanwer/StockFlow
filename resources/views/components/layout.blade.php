<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon/apple-touch-icon.png') }}">

    <title>@yield('title', 'StockFlow')</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Icons (ensure you have this) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 280px;
            flex-shrink: 0;
            background: white;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .main-content {
            flex: 1;
            padding: 24px;
            background: #f8fafc;
            min-height: 100vh;
        }

        /* Enhanced Sidebar Styles */
        .sidebar-header {
            padding: 24px 20px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .brand-mark {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border-radius: 12px;
            color: white;
            font-size: 1.4rem;
            transition: transform 0.2s;
        }

        .brand-mark:hover .brand-icon {
            transform: scale(1.05);
        }

        .brand-copy {
            display: flex;
            flex-direction: column;
        }

        .brand-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
        }

        .brand-subtitle {
            font-size: 0.7rem;
            color: #94a3b8;
            font-weight: 400;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            color: #475569;
            border-radius: 10px;
            transition: all 0.2s ease;
            text-decoration: none;
            margin-bottom: 4px;
            position: relative;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .nav-link:hover {
            background: #f1f5f9;
            color: #0f172a;
            transform: translateX(4px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #eef2ff, #e0e7ff);
            color: #4f46e5;
            font-weight: 600;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 70%;
            background: #4f46e5;
            border-radius: 0 4px 4px 0;
        }

        .nav-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            font-size: 1.2rem;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        /* Different icon backgrounds for each nav item */
        .nav-link:nth-child(1) .nav-icon {
            background: #eef2ff;
            color: #4f46e5;
        }

        .nav-link:nth-child(2) .nav-icon {
            background: #ecfdf5;
            color: #059669;
        }

        .nav-link:nth-child(3) .nav-icon {
            background: #fef3c7;
            color: #d97706;
        }

        .nav-link:hover .nav-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        .nav-link.active .nav-icon {
            background: #4f46e5 !important;
            color: white !important;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .nav-text {
            flex: 1;
        }

        /* Sidebar User Section */
        .sidebar-user {
            padding: 16px 20px;
            border-top: 1px solid #f1f5f9;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e2e8f0;
        }

        .sidebar-user strong {
            font-size: 0.9rem;
            color: #0f172a;
            display: block;
            line-height: 1.2;
        }

        .sidebar-user small {
            font-size: 0.7rem;
            color: #94a3b8;
            display: block;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(0.8);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .sidebar-footer-text {
            font-size: 0.75rem;
            color: #94a3b8;
        }

        /* Optional: Add a subtle gradient to active state text */
        .nav-link.active .nav-text {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 240px;
            }

            .nav-link {
                padding: 10px 14px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="admin-wrapper">
<!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
            <div class="sidebar-header">
                <a class="brand-mark" href="{{ route('dashboard') }}" aria-label="Dashboard">
                    <span class="brand-icon"><img src="{{ asset('images/favicon/favicon.ico') }}" alt="StockFlow Logo"
                            width="24" height="24">
                    </span>
                    <span class="brand-copy">
                        <span class="brand-title">StockFlow</span>
                        <span class="brand-subtitle">Inventory Management</span>
                    </span>
                </a>
            </div>

            <nav class="sidebar-nav">
                <!-- Dashboard -->
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}" aria-current="page">
                    <span class="nav-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Dashboard</span>
                </a>

                <!-- Categories -->
                <!-- Note: Update href with route('viewcategories') once created -->
                <a class="nav-link {{ request()->is('*categories*') ? 'active' : '' }}"
                    href="#">
                    <span class="nav-icon"><i class="bi bi-tags-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Categories</span>
                    @if (isset($categoryCount) && $categoryCount > 0)
                        <span class="badge bg-secondary rounded-pill"
                            style="font-size: 0.6rem; padding: 2px 8px;">{{ $categoryCount }}</span>
                    @endif
                </a>

                <!-- Suppliers -->
                <a class="nav-link {{ request()->routeIs('viewsuppliers') || request()->routeIs('addsupplier') ? 'active' : '' }}"
                    href="{{ route('viewsuppliers') }}">
                    <span class="nav-icon"><i class="bi bi-building-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Suppliers</span>
                    @if (isset($supplierCount) && $supplierCount > 0)
                        <span class="badge bg-warning text-dark rounded-pill"
                            style="font-size: 0.6rem; padding: 2px 8px;">{{ $supplierCount }}</span>
                    @endif
                </a>

                <!-- Stock Items (Products) -->
                <a class="nav-link {{ request()->routeIs('viewstock') || request()->routeIs('addstock') ? 'active' : '' }}"
                    href="{{ route('viewstock') }}">
                    <span class="nav-icon"><i class="bi bi-box-seam-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Stock Items</span>
                    @if ($stockCount > 0)
                        <span class="badge bg-danger rounded-pill"
                            style="font-size: 0.6rem; padding: 2px 8px;">{{ $stockCount }}</span>
                    @endif
                </a>

                <!-- Invoices & Bills -->
                <!-- Note: Update href with route('viewbills') once created -->
                <a class="nav-link {{ request()->is('*bills*') || request()->is('*sales*') ? 'active' : '' }}"
                    href="#">
                    <span class="nav-icon"><i class="bi bi-receipt" aria-hidden="true"></i></span>
                    <span class="nav-text">Invoices & Bills</span>
                    @if (isset($billCount) && $billCount > 0)
                        <span class="badge bg-info text-dark rounded-pill"
                            style="font-size: 0.6rem; padding: 2px 8px;">{{ $billCount }}</span>
                    @endif
                </a>

                <!-- Users -->
                <a class="nav-link {{ request()->routeIs('viewusers') || request()->routeIs('addusers') ? 'active' : '' }}"
                    href="{{ route('viewusers') }}">
                    <span class="nav-icon"><i class="bi bi-people-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Users</span>
                    @if ($userCount > 0)
                        <span class="badge bg-primary rounded-pill"
                            style="font-size: 0.6rem; padding: 2px 8px;">{{ $userCount }}</span>
                    @endif
                </a>
            </nav>

            <div class="sidebar-user">
                <form action="{{ route('logout') }}" method="POST" class="w-100">
                    @csrf
                    <button type="submit" class="btn btn-link text-decoration-none w-100 p-0"
                        style="border: none; background: none;">
                        <div class="d-flex align-items-center gap-3 px-2 py-2 rounded-3"
                            style="transition: all 0.2s; width: 100%; cursor: pointer;">
                            <img class="sidebar-user-avatar" src="{{ asset('images/avatar/avatar.jpg') }}"
                                alt="Admin">
                            <div class="text-start flex-grow-1">
                                <strong class="d-block text-dark" style="font-size: 0.9rem;">Admin</strong>
                                <small class="text-danger d-flex align-items-center gap-1" style="font-size: 0.7rem;">
                                    <i class="bi bi-box-arrow-right"></i>
                                    Sign Out
                                </small>
                            </div>
                        </div>
                    </button>
                </form>
            </div>
        </aside>

            <div class="sidebar-footer">
                <span class="status-dot"></span>
                <span class="sidebar-footer-text">System running smoothly</span>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
