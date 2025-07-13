@extends('layouts.navbar')
@section('title', 'Event Kampus PNP')

@section('content')
<!-- Hero Section -->
<div id="heroCarousel" class="carousel slide carousel-fade mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/ti1.jpg') }}" class="d-block w-100" style="height: 420px; object-fit: cover;">
            <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 top-0 start-0 end-0 bottom-0" style="background:rgba(0,0,0,0.35);">
                <h1 class="display-4 fw-bold text-white mb-3">Temukan Event Terbaik Kampus</h1>
                <p class="lead text-white col-lg-8 mx-auto mb-4">Jelajahi berbagai seminar, workshop, dan kompetisi untuk menambah wawasan dan pengalamanmu di Politeknik Negeri Padang.</p>
                <a href="#events" class="btn btn-primary btn-lg mt-2">Lihat Event Terbaru</a>
            </div>
        </div>
        <div class="carousel-item">
        <img src="{{ asset('images/foto1.jpg') }}" class="d-block w-100" style="height: 420px; object-fit: cover;">
            <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 top-0 start-0 end-0 bottom-0" style="background:rgba(0,0,0,0.35);">
                <h1 class="display-4 fw-bold text-white mb-3">Bergabung di Event Favoritmu</h1>
                <p class="lead text-white col-lg-8 mx-auto mb-4">Ayo ramaikan event kampus, perluas jaringan dan pengalaman bersama teman baru!</p>
                <a href="#events" class="btn btn-primary btn-lg mt-2">Lihat Event Terbaru</a>
            </div>
        </div>
        <div class="carousel-item">
        <img src="{{ asset('images/pnp1.jpg') }}" class="d-block w-100" style="height: 420px; object-fit: cover;">
            <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 top-0 start-0 end-0 bottom-0" style="background:rgba(0,0,0,0.35);">
                <h1 class="display-4 fw-bold text-white mb-3">EventKuy Satu Platform Semua Event</h1>
                <p class="lead text-white col-lg-8 mx-auto mb-4">Mudah cari, daftar, dan ikuti event seru di Politeknik Negeri Padang.</p>
                <a href="#events" class="btn btn-primary btn-lg mt-2">Lihat Event Terbaru</a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Categories Section (dipindahkan ke atas) -->
<section id="categories" class="py-5 bg-light-custom">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">Jelajahi Berdasarkan Kategori</h2>
                 <p class="section-subtitle">Temukan event yang paling sesuai dengan minatmu.</p>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse($categories->where('events_count', '>', 0) as $category)
                @php
                    $icon = 'fa-tag'; // Default icon
                    switch (strtolower($category->name)) {
                        case 'seminar': $icon = 'fa-chalkboard-teacher'; break;
                        case 'workshop': $icon = 'fa-cogs'; break;
                        case 'kompetisi': $icon = 'fa-trophy'; break;
                        case 'pameran seni': $icon = 'fa-palette'; break;
                        case 'festival kuliner': $icon = 'fa-utensils'; break;
                        case 'olahraga': $icon = 'fa-futbol'; break;
                    }
                @endphp
            <div class="col-lg-2 col-md-4 col-6 text-center">
                <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none category-link">
                    <div class="category-icon-wrapper">
                        <i class="fas {{ $icon }} fa-2x"></i>
                    </div>
                    <h6 class="fw-bold text-dark mt-2">{{ $category->name }}</h6>
                </a>
            </div>
            @empty
            <p class="text-center text-muted">Belum ada kategori event yang tersedia.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Events Section (sekarang di bawah Kategori) -->
<section id="events" class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">Event Terbaru</h2>
                <p class="section-subtitle">Jangan lewatkan kesempatan untuk berkembang.</p>
            </div>
        </div>
        
        <div class="row">
            @forelse($events as $event)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 event-card-bg">
                     @if($event->poster)
                        <img src="{{ asset('storage/' . $event->poster) }}" class="card-img-top" alt="Poster Event" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                           <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary-emphasis fw-semibold">{{ $event->category->name }}</span>
                            <small class="text-muted fw-bold">{{ $event->event_date->format('d M Y') }}</small>
                        </div>
                        <h5 class="card-title fw-bold my-2 flex-grow-1">{{ $event->title }}</h5>
                        <div class="d-flex align-items-center text-secondary small mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <span>{{ $event->location->location_name }}</span>
                        </div>
                        <a href="{{ route('events.detail', $event->id) }}" class="btn btn-primary mt-auto">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada event yang akan datang.</h4>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection 

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush 

<style>
    .event-card-bg {
        background: #fff !important;
        border-radius: 1rem !important;
        border-top: none !important;
        border-left: none !important;
        border-bottom: 2.5px solid #e5e7eb !important; /* Abu-abu terang */
        border-right: 2.5px solid #e5e7eb !important;
        box-shadow: none !important;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .event-card-bg:hover {
        box-shadow: 0 10px 30px rgba(44, 62, 80, 0.10), 0 5px 25px rgba(44, 62, 80, 0.06);
        transform: translateY(-5px);
    }
</style> 