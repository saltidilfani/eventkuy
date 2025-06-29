<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #FF6B08;         /* Warna oranye utama */
            --primary-hover: #E66007;         /* Oranye gelap */
            --primary-light: #FFF3E0;         /* Oranye sangat terang */
            --secondary-color: #f8f9fa;
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --border-color: #ecf0f1;
            --sidebar-bg: #2c3e50;
            --sidebar-link: #ecf0f1;
            --sidebar-link-hover: #ffffff;
            --sidebar-link-active: var(--primary-color);
            --content-bg: #f8f9fa;
            --card-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--content-bg);
            color: var(--text-dark);
        }
        
        /* Sidebar Styling */
        #sidebar {
            min-width: 280px;
            max-width: 280px;
            background: linear-gradient(135deg, var(--sidebar-bg) 0%, #34495e 100%);
            color: #fff;
            transition: var(--transition);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        #sidebar.active {
            margin-left: -280px;
        }
        
        #sidebar .sidebar-header {
            padding: 2rem 1.5rem;
            background: rgba(255,255,255,0.05);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        #sidebar .sidebar-header h3 {
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }
        
        #sidebar ul.components {
            padding: 1.5rem 0;
        }
        
        #sidebar ul p {
            color: rgba(255,255,255,0.6);
            padding: 0.75rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
        }
        
        #sidebar ul li a {
            padding: 1rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            color: var(--sidebar-link);
            border-left: 3px solid transparent;
            transition: var(--transition);
            text-decoration: none;
        }
        
        #sidebar ul li a:hover {
            color: var(--sidebar-link-hover);
            background: rgba(255, 107, 8, 0.1);
            border-left-color: var(--primary-color);
            transform: translateX(5px);
        }
        
        #sidebar ul li.active > a {
            color: var(--sidebar-link-hover);
            background: var(--primary-color);
            border-left-color: #fff;
            box-shadow: 0 4px 15px rgba(255, 107, 8, 0.3);
        }
        
        #sidebar ul li a i {
            width: 20px;
            margin-right: 0.75rem;
        }
        
        /* Main Content */
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        
        #content {
            flex-grow: 1;
            padding: 2rem;
            min-height: 100vh;
            transition: var(--transition);
            min-width: 0;
        }
        
        /* Top Navbar */
        .top-navbar {
            background: #fff;
            border-radius: 1rem;
            box-shadow: var(--card-shadow);
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
        }
        
        .btn-toggle-sidebar {
            background: var(--primary-color);
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem;
            color: white;
            transition: var(--transition);
        }
        
        .btn-toggle-sidebar:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 107, 8, 0.3);
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.2);
        }
        
        .card-header {
            background: #fff;
            border-bottom: 1px solid var(--border-color);
            border-radius: 1rem 1rem 0 0 !important;
            padding: 1.5rem;
        }
        
        /* Buttons */
        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 0.75rem;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            transition: var(--transition);
        }
        
        .btn-primary:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 107, 8, 0.3);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 0.75rem;
            font-weight: 500;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }
        
        /* Stats Cards */
        .stats-card {
            border-radius: 1rem;
            border: none;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            overflow: hidden;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.2);
        }
        
        .stats-card .card-body {
            padding: 1.5rem;
        }
        
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        
        /* Tables */
        .table {
            border-radius: 1rem;
            overflow: hidden;
        }
        
        .table thead th {
            background: var(--primary-light);
            border: none;
            font-weight: 600;
            color: var(--text-dark);
            padding: 1rem;
        }
        
        .table tbody td {
            padding: 1rem;
            border-color: var(--border-color);
            vertical-align: middle;
        }
        
        /* Alerts */
        .alert {
            border: none;
            border-radius: 1rem;
            padding: 1rem 1.5rem;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
        }
        
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }
        
        /* Form Controls */
        .form-control, .form-select {
            border-radius: 0.75rem;
            border: 1px solid var(--border-color);
            padding: 0.75rem 1rem;
            transition: var(--transition);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 8, 0.25);
        }
        
        /* Badges */
        .badge {
            border-radius: 0.5rem;
            font-weight: 500;
            padding: 0.5rem 0.75rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -280px;
            }
            #sidebar.active {
                margin-left: 0;
            }
            #content {
                padding: 1rem;
            }
        }

        /* === BUTTON UTAMA (ORANYE) === */
.btn-primary,
.btn-primary:focus,
.btn-primary:active,
.btn-primary:focus-visible {
    background-color: #FF6B08 !important;
    border-color: #FF6B08 !important;
    color: #fff !important;
    box-shadow: none !important;
    outline: none !important;
}
.btn-primary:hover {
    background-color: #E66007 !important;
    border-color: #E66007 !important;
    color: #fff !important;
}

/* === BUTTON OUTLINE ORANYE === */
.btn-outline-primary,
.btn-outline-primary:focus,
.btn-outline-primary:active,
.btn-outline-primary:focus-visible {
    color: #FF6B08 !important;
    border-color: #FF6B08 !important;
    background-color: #fff !important;
    box-shadow: none !important;
    outline: none !important;
}
.btn-outline-primary:hover {
    background-color: #FF6B08 !important;
    color: #fff !important;
    border-color: #FF6B08 !important;
}
.btn-outline-secondary:hover {
    background-color: #7f8c8d !important;
    color: #fff !important;
    border-color: #7f8c8d !important;
}
        
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <h3>
                    <i class="fas fa-rocket me-2"></i>
                    EventKuy Admin
                </h3>
            </div>
            <ul class="list-unstyled components">
                <li class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                <p>Manajemen</p>
                <li class="{{ Request::routeIs('admin.events.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.events.index') }}">
                        <i class="fas fa-calendar-check"></i>
                        Events
                    </a>
                </li>
                <li class="{{ Request::routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="fas fa-tags"></i>
                        Categories
                    </a>
                </li>
                <li class="{{ Request::routeIs('admin.locations.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.locations.index') }}">
                        <i class="fas fa-map-marked-alt"></i>
                        Locations
                    </a>
                </li>
                <li class="{{ Request::routeIs('admin.registrations.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.registrations.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        Pendaftaran
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled CTAs">
                <li class="px-3">
                    <a href="{{ url('/') }}" class="btn btn-outline-light w-100">
                        <i class="fas fa-external-link-alt me-2"></i>
                        Lihat Situs
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Top Navbar -->
            <nav class="top-navbar">
                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" id="sidebarCollapse" class="btn-toggle-sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="stats-icon me-3" style="background: var(--primary-color); width: 40px; height: 40px; font-size: 1rem;">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <strong>{{ Auth::user()->name }}</strong>
                                <div class="small text-muted">Administrator</div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" style="border-radius: 1rem;" aria-labelledby="dropdownUser1">
                            <li>
                                <form action="{{ route('logout') }}" method="POST" id="logout-form-admin">@csrf</form>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
                                    <i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
    @stack('scripts')
</body>
</html> 