<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Event Kampus PNP')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- Custom CSS -->
    <style>
        :root {
            --bs-primary-rgb: 255, 107, 8;
            --bs-primary: #FF6B08;
            --bs-primary-dark: #E66007;
            --bs-light-gray: #f8f9fa;
            --bs-dark-gray: #343a40;
            --bs-font-sans-serif: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bs-light-gray);
            font-family: var(--bs-font-sans-serif);
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            font-weight: 500;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--bs-primary) !important;
        }

        .btn-oren {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
            color: #fff;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-oren:hover {
            background-color: var(--bs-primary-dark);
            border-color: var(--bs-primary-dark);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 107, 8, 0.3);
        }
        
        .btn-outline-oren {
            border-color: var(--bs-primary);
            color: var(--bs-primary);
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-outline-oren:hover {
            background-color: var(--bs-primary);
            color: #fff;
        }

        .card {
            border: none;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .category-card {
            background-color: #fff;
            border-radius: 15px;
        }
        .category-card .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: rgba(255, 107, 8, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--bs-primary);
            transition: all 0.3s ease;
        }
        .category-card:hover .icon-circle {
            background-color: var(--bs-primary);
            color: #fff;
        }

        footer {
            background-color: var(--bs-dark-gray);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand fs-4" href="/"><i class="fas fa-rocket me-2"></i>Event PNP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-oren ms-2">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->role === 'admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-tachometer-alt fa-fw me-2"></i>Admin Dashboard
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="text-white text-center py-4 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Event Kampus Politeknik Negeri Padang. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 