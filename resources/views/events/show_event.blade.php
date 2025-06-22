@extends('layouts.publik')
@section('title', $event->title)

@push('styles')
<style>
    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
    }
    .breadcrumb-item a:hover {
        text-decoration: underline;
    }
    .info-list .list-group-item {
        background-color: transparent;
        border: none;
        padding-left: 0;
        padding-right: 0;
    }
    .card-img-top {
        max-height: 350px;
        object-fit: cover;
    }
    .share-btn {
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        border-radius: 50%;
        padding: 0;
    }
</style>
@endpush

@section('content')
<div class="bg-light-custom">
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.show', $event->category->id) }}">{{ $event->category->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($event->title, 30) }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Main Content Card: Diubah menjadi col-lg-7 -->
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 h-100">
                    <img src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://via.placeholder.com/800x350?text=Poster+Event' }}" class="card-img-top" alt="{{ $event->title }}">
                    <div class="card-body p-4 p-md-5">
                        <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary-emphasis fw-semibold mb-2">{{ $event->category->name }}</span>
                        <h2 class="fw-bold">{{ $event->title }}</h2>
                        
                        <hr class="my-4">
                        
                        <h4 class="fw-bold mb-3">Deskripsi Event</h4>
                        <p class="text-secondary" style="white-space: pre-wrap; line-height: 1.8;">{{ $event->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar: Tetap col-lg-4 -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 2rem;">
                    <!-- Registration Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4 text-center">
                            @if($event->available_slots > 0)
                                @auth
                                    @if(auth()->user()->registrations()->where('event_id', $event->id)->exists())
                                        <button class="btn btn-success btn-lg w-100" disabled><i class="fas fa-check-circle me-2"></i> Anda Sudah Terdaftar</button>
                                    @else
                                        <a href="{{ route('events.register', $event->id) }}" class="btn btn-primary btn-lg w-100 shadow">Daftar Sekarang</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 shadow">Login untuk Mendaftar</a>
                                @endguest
                            @else
                                <button class="btn btn-secondary btn-lg w-100" disabled>Pendaftaran Ditutup</button>
                            @endif
                            <div class="mt-3">Sisa Kuota: <span class="fw-bold fs-5">{{ $event->available_slots }}</span></div>
                        </div>
                    </div>

                    <!-- Details Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Detail Informasi</h5>
                            <ul class="list-group info-list">
                                <li class="list-group-item d-flex align-items-start">
                                    <i class="fas fa-calendar-alt fa-fw me-3 text-primary mt-1"></i>
                                    <div><strong>Tanggal:</strong><br>{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}</div>
                                </li>
                                <li class="list-group-item d-flex align-items-start">
                                    <i class="fas fa-clock fa-fw me-3 text-primary mt-1"></i>
                                    <div><strong>Waktu:</strong><br>{{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB</div>
                                </li>
                                <li class="list-group-item d-flex align-items-start">
                                    <i class="fas fa-map-marker-alt fa-fw me-3 text-primary mt-1"></i>
                                    <div><strong>Lokasi:</strong><br>{{ $event->location->location_name }}</div>
                                </li>
                                <li class="list-group-item d-flex align-items-start">
                                    <i class="fas fa-user-friends fa-fw me-3 text-primary mt-1"></i>
                                    <div><strong>Penyelenggara:</strong><br>{{ $event->organizer ?? 'Panitia' }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>

                     <!-- Back to Home Button Card -->
                    <div class="card shadow-sm border-0">
                         <div class="card-body">
                             <div class="d-grid">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Halaman Utama
                                </a>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection