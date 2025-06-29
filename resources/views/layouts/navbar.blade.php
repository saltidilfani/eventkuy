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
            --primary-color: #FF6B08; /* Warna oranye utama */
            --primary-hover: #E66007;
            --secondary-color: #f4f7f6;
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --border-color: #ecf0f1;
            --font-family: 'Poppins', sans-serif;
        }

        body {
            font-family: var(--font-family);
            background-color: #FFFFFF;
            color: var(--text-dark);
        }

        .navbar {
            background-color: #ffffff; /* Mengembalikan background navbar menjadi putih */
            box-shadow: 0 2px 15px rgba(0,0,0,0.05); /* Bayangan halus */
            font-weight: 500;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important; /* Mengembalikan warna logo menjadi oranye */
        }

        .navbar .nav-link {
            color: var(--text-dark); /* Mengembalikan warna link menjadi gelap */
            padding-left: 1rem;
            padding-right: 1rem;
            position: relative;
            transition: color 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: var(--primary-color); /* Warna link saat di-hover menjadi oranye */
        }

        .navbar .nav-link.active {
            color: var(--primary-color); /* Warna link aktif menjadi oranye */
            font-weight: 600;
        }
        
        .navbar .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -8px; 
            left: 1rem;
            right: 1rem;
            height: 3px;
            background-color: var(--primary-color); /* Garis bawah aktif menjadi oranye */
            border-radius: 2px;
        }
        
        .dropdown-menu {
            border-radius: .5rem;
            border: 1px solid var(--border-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 107, 8, 0.3);
        }
        
        /* Memperkuat gaya untuk kondisi tombol aktif/focus */
        .btn-primary:focus,
        .btn-primary:active,
        .btn-primary.active,
        .btn-primary:active:focus {
            background-color: #6c757d !important; /* Warna abu-abu */
            border-color: #6c757d !important;
            color: #fff !important;
            box-shadow: none !important; /* Menghapus bayangan fokus (glow) */
        }

        .section-title {
            font-weight: 700;
            color: var(--text-dark);
        }
        
        .section-subtitle {
            color: var(--text-light);
        }

        .card {
            border: 1px solid var(--border-color);
            box-shadow: 0 5px 25px rgba(44, 62, 80, 0.08);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(44, 62, 80, 0.12);
        }
        
        .bg-light-custom {
             background-color: var(--secondary-color);
        }

        footer {
            background-color: var(--text-dark);
            color: #fff;
        }

        /* Gaya baru untuk ikon kategori bulat */
        .category-icon-wrapper {
            width: 90px;
            height: 90px;
            background-color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: all 0.3s ease-out;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .category-icon-wrapper i {
            color: var(--primary-color);
            transition: color 0.3s ease-out;
        }

        .category-link:hover .category-icon-wrapper {
            background-color: var(--primary-color);
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(255, 107, 8, 0.25);
        }

        .category-link:hover .category-icon-wrapper i {
            color: #ffffff;
        }

        .category-link h6 {
            transition: color 0.3s ease-out;
        }

        .category-link:hover h6 {
            color: var(--primary-color) !important;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Navbar dengan warna dan struktur yang sudah disesuaikan -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fs-4" href="{{ route('home') }}">
                <i class="fas fa-rocket me-2"></i>EventKuy
            </a>

            <!-- Tombol Toggler untuk Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <!-- Menu Navigasi di Tengah -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('events.all') ? 'active' : '' }}" href="{{ route('events.all') }}">Events</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li> -->
                </ul>

                <!-- Ikon Profil di Kanan -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdownProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle fa-2x"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownProfile">
                            @guest
                                <li><a class="dropdown-item" href="{{ route('login') }}"><i class="fas fa-sign-in-alt fa-fw me-2"></i>Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}"><i class="fas fa-user-plus fa-fw me-2"></i>Register</a></li>
                            @else
                                <li class="dropdown-header">Halo, {{ Auth::user()->name }}</li>
                                <li><hr class="dropdown-divider"></li>
                                @if(Auth::user()->isAdmin())
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-tachometer-alt fa-fw me-2"></i>Admin Dashboard
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">@csrf</form>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout
                                    </a>
                                </li>
                            @endguest
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="text-white text-center py-4 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Event Kampus Politeknik Negeri Padang. By Salti Dilfani | 2301093007.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>