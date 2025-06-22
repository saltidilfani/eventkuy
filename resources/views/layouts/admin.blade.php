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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-admin: #4a69bd;
            --primary-admin-hover: #3c5aa6;
            --sidebar-bg: #2c3e50;
            --sidebar-link: #ecf0f1;
            --sidebar-link-hover: #ffffff;
            --sidebar-link-active: #f1c40f;
            --content-bg: #f8f9fa;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--content-bg);
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: var(--sidebar-bg);
            color: #fff;
            transition: all 0.3s;
        }
        #sidebar.active {
            margin-left: -250px;
        }
        #sidebar .sidebar-header {
            padding: 20px;
            background: #34495e;
        }
        #sidebar ul.components {
            padding: 20px 0;
        }
        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }
        #sidebar ul li a {
            padding: 15px 20px;
            font-size: 1.1em;
            display: block;
            color: var(--sidebar-link);
            border-left: 3px solid transparent;
        }
        #sidebar ul li a:hover {
            color: var(--sidebar-link-hover);
            background: var(--primary-admin);
            text-decoration: none;
        }
        #sidebar ul li.active > a, a[aria-expanded="true"] {
            color: var(--sidebar-link-hover);
            background: var(--primary-admin);
            border-left: 3px solid var(--sidebar-link-active);
        }
        a[data-bs-toggle="collapse"] {
            position: relative;
        }
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        #content {
            flex-grow: 1;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
            min-width: 0;
        }
        .card {
            border: none;
            border-radius: .75rem;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <h3><i class="fas fa-rocket me-2"></i>EventKuy Admin</h3>
            </div>
            <ul class="list-unstyled components">
                <li class="{{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt fa-fw me-3"></i>Dashboard</a>
                </li>
                <p class="ms-3 fw-bold text-secondary text-uppercase" style="font-size: 0.8em">Manajemen</p>
                <li class="{{ Request::routeIs('admin.events.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.events.index') }}"><i class="fas fa-calendar-check fa-fw me-3"></i>Events</a>
                </li>
                <li class="{{ Request::routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}"><i class="fas fa-tags fa-fw me-3"></i>Categories</a>
                </li>
                <li class="{{ Request::routeIs('admin.locations.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.locations.index') }}"><i class="fas fa-map-marked-alt fa-fw me-3"></i>Locations</a>
                </li>
                 <li class="{{ Request::routeIs('admin.registrations.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.registrations.index') }}"><i class="fas fa-clipboard-list fa-fw me-3"></i>Pendaftaran</a>
                </li>
            </ul>
            <ul class="list-unstyled CTAs">
                 <li><a href="{{ url('/') }}" class="btn btn-outline-light w-75 mx-auto d-block">Lihat Situs</a></li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 shadow-sm">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary-admin" style="background:var(--primary-admin)">
                        <i class="fas fa-align-left"></i>
                    </button>
                     <div class="ms-auto">
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle fa-2x me-2 text-muted"></i>
                                <strong>{{ Auth::user()->name }}</strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser1">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" id="logout-form-admin">@csrf</form>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
                                        <i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign out
                                    </a>
                                </li>
                            </ul>
                        </div>
                     </div>
                </div>
            </nav>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
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