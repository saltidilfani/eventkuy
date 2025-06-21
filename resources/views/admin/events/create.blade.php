@extends('layouts.public')
@section('title', 'Konfirmasi Pendaftaran - ' . $event->title)

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                <div class="card-header bg-gradient text-white py-4" style="background-image: linear-gradient(to right, #FF8008, #FFC837);">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle fa-2x me-3"></i>
                        <div>
                            <h3 class="mb-0">Konfirmasi Pendaftaran</h3>
                            <p class="mb-0 opacity-75">Review data sebelum finalisasi</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Penting:</strong> Pastikan semua informasi di bawah ini sudah benar sebelum mengkonfirmasi pendaftaran.
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3 text-oren">Detail Event</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="fw-bold">{{ $event->title }}</h6>
                                    <p class="text-muted mb-2">{{ $event->description }}</p>
                                    <div class="mb-2">
                                        <i class="fas fa-calendar text-oren me-2"></i>
                                        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}
                                    </div>
                                    <div class="mb-2">
                                        <i class="fas fa-clock text-oren me-2"></i>
                                        <strong>Waktu:</strong> {{ $event->event_time }}
                                    </div>
                                    <div class="mb-2">
                                        <i class="fas fa-map-marker-alt text-oren me-2"></i>
                                        <strong>Lokasi:</strong> {{ $event->location->name }}
                                    </div>
                                    <div class="mb-0">
                                        <i class="fas fa-users text-oren me-2"></i>
                                        <strong>Kategori:</strong> {{ $event->category->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3 text-oren">Data Pendaftar</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <i class="fas fa-user text-oren me-2"></i>
                                        <strong>Nama:</strong> {{ auth()->user()->name }}
                                    </div>
                                    <div class="mb-2">
                                        <i class="fas fa-envelope text-oren me-2"></i>
                                        <strong>Email:</strong> {{ auth()->user()->email }}
                                    </div>
                                    <div class="mb-2">
                                        <i class="fas fa-phone text-oren me-2"></i>
                                        <strong>Telepon:</strong> {{ $registrationData['phone'] }}
                                    </div>
                                    @if(!empty($registrationData['institution']))
                                    <div class="mb-2">
                                        <i class="fas fa-building text-oren me-2"></i>
                                        <strong>Institusi:</strong> {{ $registrationData['institution'] }}
                                    </div>
                                    @endif
                                    @if(!empty($registrationData['notes']))
                                    <div class="mb-0">
                                        <i class="fas fa-sticky-note text-oren me-2"></i>
                                        <strong>Catatan:</strong> {{ $registrationData['notes'] }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('events.register.confirm.store', $event) }}">
                        @csrf
                        <input type="hidden" name="phone" value="{{ $registrationData['phone'] }}">
                        <input type="hidden" name="institution" value="{{ $registrationData['institution'] ?? '' }}">
                        <input type="hidden" name="notes" value="{{ $registrationData['notes'] ?? '' }}">
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="confirm" name="confirm" required>
                            <label class="form-check-label" for="confirm">
                                Saya menyatakan bahwa semua informasi di atas sudah benar dan saya siap mengikuti event ini
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg" id="submitBtn" disabled>
                                <i class="fas fa-check me-2"></i>Konfirmasi Pendaftaran
                            </button>
                            <a href="{{ route('events.register', $event) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Form Pendaftaran
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 