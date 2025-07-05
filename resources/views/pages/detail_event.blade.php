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
<div class="bg-light-custom min-vh-100">
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.show', $event->category->id) }}">{{ $event->category->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($event->title, 30) }}</li>
            </ol>
        </nav>

        <!-- Card Gabungan Poster & Info -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0 mb-4 p-0">
                    <div class="row g-0 align-items-stretch" style="min-height:420px;">
                        <!-- Poster di kiri, lebih besar -->
                        <div class="col-md-7 p-0" style="background:#f4f7f6;display:flex;align-items:center;justify-content:center;min-height:420px;">
                            @if($event->poster)
                                <img src="{{ asset('storage/' . $event->poster) }}"
                                     alt="{{ $event->title }}"
                                     style="width:100%;height:100%;object-fit:contain;object-position:center;display:block;">
                            @else
                                <div class="d-flex align-items-center justify-content-center" style="width:100%;height:100%;">
                                    <i class="fas fa-image fa-4x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <!-- Info di kanan -->
                        <div class="col-md-5 p-0 d-flex align-items-stretch">
                            <div class="card-body w-100 p-4 d-flex flex-column justify-content-start" style="min-height:420px;">
                                <h1 class="fw-bold mb-4" style="font-size:2rem;">{{ $event->title }}</h1>
                                <div class="mb-3 d-flex flex-wrap gap-2">
                                    <span class="badge bg-info text-dark fw-semibold">
                                        <i class="fas fa-tag me-1"></i>{{ $event->category->name }}
                                    </span>
                                    <span class="badge bg-light text-dark fw-semibold">
                                        <i class="fas fa-user-friends me-1"></i>{{ $event->organizer ?? 'Panitia Event' }}
                                    </span>
                                </div>
                                <div class="mb-4 p-3" style="background: #fff; border-radius: 1rem; box-shadow: 0 2px 12px rgba(44,62,80,0.06); border: 1px solid #f0f0f0;">
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-flex align-items-center py-2 border-bottom">
                                            <span class="me-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;background:linear-gradient(135deg,#FF6B08,#E66007);border-radius:12px;">
                                                <i class="fas fa-calendar-alt text-white fs-5"></i>
                                            </span>
                                            <div>
                                                <div class="fw-semibold text-dark small text-uppercase" style="letter-spacing:1px;">Tanggal</div>
                                                <div class="fs-6 text-secondary">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}</div>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-center py-2 border-bottom">
                                            <span class="me-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;background:linear-gradient(135deg,#FF6B08,#E66007);border-radius:12px;">
                                                <i class="fas fa-clock text-white fs-5"></i>
                                            </span>
                                            <div>
                                                <div class="fw-semibold text-dark small text-uppercase" style="letter-spacing:1px;">Waktu</div>
                                                <div class="fs-6 text-secondary">{{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB</div>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-center py-2 border-bottom">
                                            <span class="me-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;background:linear-gradient(135deg,#FF6B08,#E66007);border-radius:12px;">
                                                <i class="fas fa-map-marker-alt text-white fs-5"></i>
                                            </span>
                                            <div>
                                                <div class="fw-semibold text-dark small text-uppercase" style="letter-spacing:1px;">Lokasi</div>
                                                <div class="fs-6 text-secondary">{{ $event->location->location_name }}</div>
                                            </div>
                                        </li>
                                        @if($event->instagram)
                                        <li class="d-flex align-items-center py-2 border-bottom">
                                            <span class="me-3 d-flex align-items-center justify-content-center"
                                                  style="width:44px;height:44px;background:linear-gradient(45deg,#f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);border-radius:12px;">
                                                <i class="fab fa-instagram text-white fs-5"></i>
                                            </span>
                                            <div>
                                                <div class="fw-semibold text-dark small text-uppercase" style="letter-spacing:1px;">Instagram</div>
                                                <div class="fs-6">
                                                    <a href="https://instagram.com/{{ ltrim($event->instagram, '@') }}"
                                                       target="_blank"
                                                       class="text-decoration-none text-primary fw-semibold">
                                                        {{ '@' . ltrim($event->instagram, '@') }}
                                                        <i class="fas fa-external-link-alt ms-1 small"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                        <li class="d-flex align-items-center py-2">
                                            <span class="me-3 d-flex align-items-center justify-content-center" style="width:44px;height:44px;background:linear-gradient(135deg,#FF6B08,#E66007);border-radius:12px;">
                                                <i class="fas fa-users text-white fs-5"></i>
                                            </span>
                                            <div>
                                                <div class="fw-semibold text-dark small text-uppercase" style="letter-spacing:1px;">Sisa Kuota</div>
                                                <div class="fs-4 fw-bold text-primary">{{ $event->available_slots }}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mb-3">
                                    @if($event->available_slots > 0)
                                        @auth
                                            @if(auth()->user()->registrations()->where('event_id', $event->id)->exists())
                                                <button class="btn btn-primary btn-md w-100 mb-2" disabled>
                                                    <i class="fas fa-check-circle me-2"></i> Anda Sudah Terdaftar
                                                </button>
                                            @else
                                                <a href="{{ route('events.register', $event->id) }}" class="btn btn-primary btn-md w-100 mb-2">
                                                    <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-primary btn-md w-100 mb-2">
                                                <i class="fas fa-sign-in-alt me-2"></i>Login untuk Mendaftar
                                            </a>
                                        @endguest
                                    @else
                                        <button class="btn btn-secondary btn-md w-100 mb-2" disabled>
                                            <i class="fas fa-times-circle me-2"></i>Pendaftaran Ditutup
                                        </button>
                                    @endif
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-md w-100">
                                        <i class="fas fa-arrow-left me-2"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi Event lebar penuh di bawah, margin konsisten -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm p-4">
                    <h4 class="fw-bold mb-3">Deskripsi Event</h4>
                    <div class="text-secondary" style="font-size:1.1rem;line-height:1.8;white-space:pre-wrap;">
                        {{ $event->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection