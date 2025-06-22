@extends('layouts.navbar')
@section('title', 'Event Kampus PNP')

@section('content')
<!-- Hero Section -->
<div class="bg-light-custom py-5">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold text-dark">Temukan Event Terbaik Kampus</h1>
        <p class="lead text-secondary col-lg-8 mx-auto">Jelajahi berbagai seminar, workshop, dan kompetisi untuk menambah wawasan dan pengalamanmu di Politeknik Negeri Padang.</p>
        <a href="#events" class="btn btn-primary btn-lg mt-3">Lihat Event Terbaru</a>
    </div>
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
            <div class="col-lg-2 col-md-4 col-6">
                <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none">
                    <div class="card text-center p-3 h-100 border-0 shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <i class="fas {{ $icon }} fa-3x text-primary mb-3"></i>
                            <h6 class="fw-bold text-dark">{{ $category->name }}</h6>
                        </div>
                    </div>
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
                <div class="card h-100 shadow-sm border-0">
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
                        <a href="{{ route('events.detail', $event->id) }}" class="btn btn-outline-primary mt-auto">
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