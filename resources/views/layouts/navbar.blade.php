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
        .navbar .container {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important; /* Mengembalikan warna logo menjadi oranye */
            margin-right: 2rem;
        }
        .navbar .navbar-nav {
            gap: 0.7rem;
        }
        .navbar .nav-link {
            color: var(--text-dark); /* Mengembalikan warna link menjadi gelap */
            padding-left: 1rem;
            padding-right: 1rem;
            position: relative;
            transition: color 0.3s ease;
        }
        .navbar .nav-link:last-child {
            margin-right: 0;
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
            background: #f4f7f6 !important;
            color: var(--text-dark);
        }
        .dropdown-menu .dropdown-item:active, .dropdown-menu .dropdown-item:focus, .dropdown-menu .dropdown-item:hover {
            background: var(--primary-color) !important;
            color: #fff !important;
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

        /* Footer Styles */
        footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #FF6B08, #FFC837, #FF6B08);
        }

        footer .navbar-brand:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        footer a:hover {
            color: #FFC837 !important;
            transition: color 0.3s ease;
        }

        footer .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        footer .social-links a:hover {
            background: #FF6B08;
            transform: translateY(-3px);
        }

        footer iframe {
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        @media (max-width: 768px) {
            footer .text-md-end {
                text-align: center !important;
            }
            footer .text-md-start {
                text-align: center !important;
            }
        }
        @media (max-width: 991.98px) {
            .navbar .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
        @media (max-width: 768px) {
            .navbar {
                padding-top: 0.7rem;
                padding-bottom: 0.7rem;
            }
            .navbar .nav-link {
                padding-left: 0.7rem;
                padding-right: 0.7rem;
            }
        }
        footer .social-links a.social-fb:hover {
            background: linear-gradient(45deg, #1877f3 0%, #3b5998 100%);
            color: #fff !important;
        }
        footer .social-links a.social-tw:hover {
            background: linear-gradient(45deg, #1da1f2 0%, #0e71c8 100%);
            color: #fff !important;
        }
        footer .social-links a.social-ig:hover {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            color: #fff !important;
        }
        footer .social-links a.social-yt:hover {
            background: linear-gradient(45deg, #ff0000 0%, #c4302b 100%);
            color: #fff !important;
        }
        footer .social-links a i {
            font-size: 1.35rem;
            vertical-align: middle;
            transition: color 0.2s;
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
                        <a class="nav-link {{ Request::routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('events.all') ? 'active' : '' }}" href="{{ route('events.all') }}">Events</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('events.submit.form') ? 'active' : '' }}" href="{{ route('events.submit.form') }}">
                            Create Events
                        </a>
                    </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('contact.show') ? 'active' : '' }}" href="{{ route('contact.show') }}">Contact</a>
                    </li>
                </ul>
                <!-- Search Form -->
                <form class="d-flex align-items-center ms-lg-3 my-2 my-lg-0 position-relative" action="{{ route('events.all') }}" method="GET" style="max-width: 260px; min-width: 120px;">
                    <span class="position-absolute start-0 top-50 translate-middle-y ps-3 text-muted" style="z-index:2;"><i class="fas fa-search"></i></span>
                    <input class="form-control form-control-sm ps-5 py-2" type="search" name="search" placeholder="Cari event kampus..." aria-label="Search" style="border-radius: 2rem; border: 1.5px solid #fff; background: #fff; min-width: 120px; box-shadow: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#FF6B08'" onblur="this.style.borderColor='#fff'">
                </form>

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

    <footer class="text-white mt-auto" style="background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);">
        <div class="container py-5">
            <!-- Main Footer Content -->
            <div class="row g-4 mb-4">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6">
                    <div class="mb-4">
                        <a href="{{ route('home') }}" class="navbar-brand text-white fs-4 mb-3 d-inline-block">
                            <i class="fas fa-rocket me-2"></i>EventKuy
                        </a>
                        <p class="text-light mb-3" style="line-height: 1.6;">
                            Platform event kampus terdepan untuk Politeknik Negeri Padang. 
                            Temukan dan ikuti berbagai event menarik di kampus Anda.
                        </p>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt text-warning me-3"></i>
                            <span class="text-light small">Jl. Kampus Politeknik Negeri Padang, Limau Manis, Pauh, Padang, Sumatera Barat 25164</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-phone text-warning me-3"></i>
                            <span class="text-light small">(0751) 72590</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-envelope text-warning me-3"></i>
                            <span class="text-light small">info@eventkuy.com</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="text-white fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('home') }}" class="text-light text-decoration-none small">
                                <i class="fas fa-chevron-right me-2 text-warning"></i>Home
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('about') }}" class="text-light text-decoration-none small">
                                <i class="fas fa-chevron-right me-2 text-warning"></i>About
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('events.all') }}" class="text-light text-decoration-none small">
                                <i class="fas fa-chevron-right me-2 text-warning"></i>Events
                            </a>
                        </li>
                        @auth
                        <li class="mb-2">
                            <a href="{{ route('events.submit.form') }}" class="text-light text-decoration-none small">
                                <i class="fas fa-chevron-right me-2 text-warning"></i>Ajukan Event
                            </a>
                        </li>
                        @endauth
                        <li class="mb-2">
                            <a href="{{ route('contact.show') }}" class="text-light text-decoration-none small">
                                <i class="fas fa-chevron-right me-2 text-warning"></i>Contact
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-bold mb-3">Social Media</h6>
                    <div class="social-links">
                        <a href="https://facebook.com/eventkuy" class="text-light text-decoration-none social-fb" title="Facebook" target="_blank" rel="noopener">
                            <i class="fab fa-facebook-f fa-lg"></i>
                        </a>
                        <a href="https://twitter.com/eventkuy" class="text-light text-decoration-none social-tw" title="Twitter" target="_blank" rel="noopener">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a href="https://instagram.com/eventkuy" class="text-light text-decoration-none social-ig" title="Instagram" target="_blank" rel="noopener">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                        <a href="https://youtube.com/@eventkuy" class="text-light text-decoration-none social-yt" title="YouTube" target="_blank" rel="noopener">
                            <i class="fab fa-youtube fa-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Maps -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-bold mb-3">Lokasi Kami</h6>
                    <div class="ratio ratio-4x3 rounded overflow-hidden shadow" style="min-height: 220px;">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.3456789012345!2d100.466151!3d-0.9145679!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b7be9e52a171%3A0x609ef1cc57a38e32!2sPoliteknik%20Negeri%20Padang!5e0!3m2!1sid!2sid!4v1689000000000!5m2!1sid!2sid" 
                            style="border:0; min-height: 220px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi Politeknik Negeri Padang">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <hr class="my-4" style="border-color: rgba(255,255,255,0.2);">

            <!-- Bottom Footer -->
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-light small mb-0">
                        &copy; {{ date('Y') }} EventKuy PNP by Salti Dilfani. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="text-light small mb-0">
                        Made with <i class="fas fa-heart text-danger"></i> for PNP Community
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>