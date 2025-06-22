@extends('layouts.navbar')
@section('title', 'Semua Event')

@section('content')
<div class="bg-light-custom py-5">
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h2 class="section-title">Semua Event Akan Datang</h2>
                <p class="section-subtitle">Temukan event yang paling cocok untukmu dari semua kategori.</p>
            </div>
            <div class="col-md-4">
                <form action="{{ route('events.all') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari event..." value="{{ $search ?? '' }}">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
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
                            <span class="badge rounded-pill text-bg-primary bg-opacity-10 text-primary-emphasis fw-semibold">{{ $event->category->name }}</span>
                            <small class="text-muted fw-bold">{{ $event->event_date->format('d M Y') }}</small>
                        </div>
                        <h5 class="card-title fw-bold my-2 flex-grow-1">{{ $event->title }}</h5>
                        <div class="d-flex align-items-center text-muted small mb-3">
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
                <i class="fas fa-search-minus fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">
                    @if(isset($search) && $search != '')
                        Event dengan judul "{{ $search }}" tidak ditemukan.
                    @else
                        Belum ada event yang akan datang saat ini.
                    @endif
                </h4>
            </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection 