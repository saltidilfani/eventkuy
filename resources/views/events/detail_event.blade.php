@extends('layouts.public')
@section('title', $event->title)

@section('content')
<div class="bg-light-custom py-5">
<div class="container my-5">
    <div class="row">
        <!-- Event Details -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg mb-4">
                <img src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://via.placeholder.com/800x400?text=Event+Poster' }}" class="card-img-top" alt="{{ $event->title }}">
                <div class="card-body p-4 p-md-5">
                    <span class="badge rounded-pill text-bg-primary bg-opacity-10 text-primary-emphasis fw-semibold mb-3">{{ $event->category->name }}</span>
                    <h1 class="card-title fw-bold mb-4">{{ $event->title }}</h1>
                    
                    <div class="mb-4">
                        <p class="card-text fs-5" style="white-space: pre-wrap;">{{ $event->description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 2rem;">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Detail Event</h4>
                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex">
                                <i class="fas fa-calendar-alt fa-fw me-3 text-primary mt-1"></i>
                                <div><strong>Tanggal:</strong><br>{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}</div>
                            </li>
                            <li class="mb-3 d-flex">
                                <i class="fas fa-clock fa-fw me-3 text-primary mt-1"></i>
                                <div><strong>Waktu:</strong><br>{{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB</div>
                            </li>
                            <li class="mb-3 d-flex">
                                <i class="fas fa-map-marker-alt fa-fw me-3 text-primary mt-1"></i>
                                <div><strong>Lokasi:</strong><br>{{ $event->location->location_name }}</div>
                            </li>
                             <li class="mb-3 d-flex">
                                <i class="fas fa-user-friends fa-fw me-3 text-primary mt-1"></i>
                                <div><strong>Penyelenggara:</strong><br>{{ $event->organizer ?? 'Panitia' }}</div>
                            </li>
                            <li class="d-flex">
                                <i class="fas fa-ticket-alt fa-fw me-3 text-primary mt-1"></i>
                                <div><strong>Sisa Kuota:</strong><br><span class="fw-bold fs-5">{{ $event->available_slots }}</span> Peserta</div>
                            </li>
                        </ul>
                        <hr class="my-4">
                        <div class="d-grid">
                            @if($event->available_slots > 0)
                                @auth
                                     @if(auth()->user()->registrations()->where('event_id', $event->id)->exists())
                                        <button class="btn btn-success btn-lg" disabled><i class="fas fa-check-circle me-2"></i> Anda Sudah Terdaftar</button>
                                     @else
                                        <a href="{{ route('events.register', $event->id) }}" class="btn btn-primary btn-lg shadow">Daftar Sekarang</a>
                                     @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg shadow">Login untuk Mendaftar</a>
                                @endguest
                            @else
                                <button class="btn btn-secondary btn-lg" disabled>Pendaftaran Ditutup</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    body {
        background-color: #f4f7f6;
    }
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    .card-title {
        color: #333;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>
@endpush