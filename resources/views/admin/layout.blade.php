<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Event Kampus PNP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --oren-pnp: #FF8000;
            --oren-pnp-dark: #e06d00;
            --oren-pnp-light: #fff3e0;
        }
        .bg-oren { background: var(--oren-pnp) !important; }
        .text-oren { color: var(--oren-pnp) !important; }
        .btn-oren {
            background: var(--oren-pnp);
            color: #fff;
            border: none;
        }
        .btn-oren:hover {
            background: var(--oren-pnp-dark);
            color: #fff;
        }
        .btn-outline-oren {
            color: var(--oren-pnp);
            border-color: var(--oren-pnp);
        }
        .btn-outline-oren:hover {
            background: var(--oren-pnp);
            color: #fff;
        }
        .navbar-oren {
            background: var(--oren-pnp);
        }
        .sidebar-oren {
            background: var(--oren-pnp-dark);
        }
        .card-oren {
            border-left: 4px solid var(--oren-pnp);
        }
        .nav-link.active {
            background: var(--oren-pnp) !important;
            color: #fff !important;
        }
        .nav-link:hover {
            background: var(--oren-pnp-light) !important;
            color: var(--oren-pnp) !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-oren navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/admin/dashboard">
                <i class="fas fa-cogs me-2"></i>Admin Event PNP
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/events">
                            <i class="fas fa-calendar me-1"></i>Events
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/categories">
                            <i class="fas fa-tags me-1"></i>Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/locations">
                            <i class="fas fa-map-marker-alt me-1"></i>Locations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/registrations">
                            <i class="fas fa-clipboard-list me-1"></i>Registrations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users">
                            <i class="fas fa-users me-1"></i>Users
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="navbar-text me-3">
                            <i class="fas fa-user me-1"></i>{{ auth()->user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/" target="_blank">
                            <i class="fas fa-external-link-alt me-1"></i>Lihat Website
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2024 Event Kampus Politeknik Negeri Padang</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 