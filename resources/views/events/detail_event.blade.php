@extends('layouts.navbar')
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
        border-color: rgba(0,0,0,0.05);
        padding-left: 0;
        padding-right: 0;
    }
    .card-img-top-detail {
        max-height: 450px;
        object-fit: cover;
        border-radius: .5rem .5rem 0 0;
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

        <!-- Card Tunggal Untuk Semua Konten -->
        <div class="card shadow-lg border-0 mx-auto" style="max-width: 800px;">
            <!-- Poster Event -->
            <img src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://via.placeholder.com/1200x450?text=Poster+Event' }}" class="card-img-top-detail" alt="{{ $event->title }}">
            
            <div class="card-body p-4 p-md-5">
                <div class="row g-5">
                    <!-- Kolom Kiri: Deskripsi Event -->
                    <div class="col-lg-7">
                        <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary-emphasis fw-semibold mb-3">{{ $event->category->name }}</span>
                        <h1 class="fw-bolder mb-3">{{ $event->title }}</h1>
                        <hr>
                        <h4 class="fw-bold mt-4 mb-3">Deskripsi Event</h4>
                        <p class="text-secondary" style="white-space: pre-wrap; line-height: 1.8;">{{ $event->description }}</p>
                    </div>

                    <!-- Kolom Kanan: Informasi & Aksi -->
                    <div class="col-lg-5">
                        <!-- Tombol Pendaftaran -->
                        <div class="card shadow-sm border-light bg-light text-center p-4 mb-4">
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
                            <div class="mt-3 text-dark">Sisa Kuota: <span class="fw-bold fs-5">{{ $event->available_slots }}</span></div>
                        </div>

                        <!-- Detail Informasi -->
                        <h5 class="fw-bold mb-3">Detail Informasi</h5>
                        <ul class="list-group list-group-flush info-list">
                            <li class="list-group-item d-flex align-items-start pb-3">
                                <i class="fas fa-calendar-alt fa-fw me-3 text-primary mt-1 fs-5"></i>
                                <div><strong>Tanggal:</strong><br><span class="text-secondary">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}</span></div>
                            </li>
                            <li class="list-group-item d-flex align-items-start py-3">
                                <i class="fas fa-clock fa-fw me-3 text-primary mt-1 fs-5"></i>
                                <div><strong>Waktu:</strong><br><span class="text-secondary">{{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB</span></div>
                            </li>
                            <li class="list-group-item d-flex align-items-start py-3">
                                <i class="fas fa-map-marker-alt fa-fw me-3 text-primary mt-1 fs-5"></i>
                                <div><strong>Lokasi:</strong><br><span class="text-secondary">{{ $event->location->location_name }}</span></div>
                            </li>
                            <li class="list-group-item d-flex align-items-start pt-3">
                                <i class="fas fa-user-friends fa-fw me-3 text-primary mt-1 fs-5"></i>
                                <div><strong>Penyelenggara:</strong><br><span class="text-secondary">{{ $event->organizer ?? 'Panitia' }}</span></div>
                            </li>
                        </ul>

                        <!-- Tombol Kembali -->
                        <div class="d-grid mt-5">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection