@extends('layouts.navbar')
@section('title', 'Event Kategori: ' . $category->name)

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="fw-bold text-dark-gray">Kategori: {{ $category->name }}</h1>
            <p class="text-muted">Menampilkan semua event yang akan datang dalam kategori ini.</p>
            <hr class="mx-auto" style="width: 100px; border-top: 3px solid var(--primary-color);">
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
                        <small class="text-muted fw-bold">{{ \Carbon\Carbon::parse($event->event_date)->isoFormat('dddd, D MMM Y') }}</small>
                    </div>
                    <h5 class="card-title fw-bold my-2 flex-grow-1">{{ $event->title }}</h5>
                    <div class="d-flex align-items-center text-muted small mb-3">
                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                        <span>{{ $event->location->location_name }}</span>
                    </div>
                    <a href="{{ route('events.detail', $event->id) }}" class="btn btn-primary mt-auto">
                        <i class="fas fa-eye me-2"></i>Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">Belum ada event yang akan datang untuk kategori ini.</h4>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                <i class="fas fa-home me-2"></i>Lihat Semua Event
            </a>
        </div>
        @endforelse
    </div>

    @if($events->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $events->links() }}
    </div>
    @endif
</div>
@endsection 