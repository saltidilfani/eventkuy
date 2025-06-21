@extends('layouts.public')
@section('title', 'Event Kampus PNP')

@section('content')
<!-- Hero Section -->
<div class="container-fluid bg-white py-5">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold text-dark-gray">Temukan Event Terbaik Kampus</h1>
        <p class="lead text-muted col-lg-8 mx-auto">Jelajahi berbagai seminar, workshop, dan kompetisi untuk menambah wawasan dan pengalamanmu di Politeknik Negeri Padang.</p>
        <a href="#events" class="btn btn-oren btn-lg mt-3">Lihat Event Terbaru</a>
    </div>
</div>

<!-- Events Section -->
<section id="events" class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold text-dark-gray mb-3">Event Terbaru</h2>
                <hr class="mx-auto" style="width: 100px; border-top: 3px solid var(--bs-primary);">
            </div>
        </div>
        
        <div class="row">
            @forelse($events as $event)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <!-- Jika ada poster, tampilkan. Jika tidak, kosong.
                         Tambahkan field 'poster' di seeder jika ingin ada gambar.
                    @if($event->poster)
                        <img src="{{ asset('storage/' . $event->poster) }}" class="card-img-top" alt="Poster Event" style="height: 200px; object-fit: cover;">
        @endif
                    -->
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge rounded-pill text-bg-primary bg-opacity-10 text-primary-emphasis fw-semibold">{{ $event->category->name }}</span>
                            <small class="text-muted">{{ $event->event_date->format('d M Y') }}</small>
                        </div>
                        <h5 class="card-title fw-bold my-2 flex-grow-1">{{ $event->title }}</h5>
                        <div class="d-flex align-items-center text-muted small mb-3">
                            <i class="fas fa-map-marker-alt text-oren me-2"></i>
                            <span>{{ $event->location->location_name }}</span>
                        </div>
                        <a href="{{ route('events.detail', $event->id) }}" class="btn btn-outline-oren mt-auto">
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

<!-- Categories Section -->
<section id="categories" class="py-5 bg-white">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold text-dark-gray mb-3">Jelajahi Berdasarkan Kategori</h2>
                <hr class="mx-auto" style="width: 100px; border-top: 3px solid var(--bs-primary);">
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse($categories->where('events_count', '>', 0) as $category)
            <div class="col-lg-2 col-md-4 col-6">
                <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none text-dark">
                    <div class="card text-center p-3 h-100 category-card">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <div class="icon-circle mb-3 mx-auto">
                                <i class="fas fa-tag fa-lg"></i>
                            </div>
                            <h6 class="fw-bold">{{ $category->name }}</h6>
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
@endsection
