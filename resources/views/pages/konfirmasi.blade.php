@extends('layouts.navbar')
@section('title', 'Konfirmasi Pendaftaran: ' . $event->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <!-- Progress Step -->
            <div class="mb-4">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="stepper-item">
                        <div class="step-counter bg-orange text-white"><i class="fas fa-edit"></i></div>
                        <div class="step-label">Isi Formulir</div>
                    </div>
                    <div class="stepper-line"></div>
                    <div class="stepper-item active">
                        <div class="step-counter bg-orange text-white"><i class="fas fa-check"></i></div>
                        <div class="step-label">Konfirmasi</div>
                    </div>
                </div>
            </div>
            <style>
                .bg-orange {
                    background: #FF6B08 !important;
                    color: #fff !important;
                }
                .stepper-item {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    flex: 1;
                }
                .step-counter {
                    width: 48px;
                    height: 48px;
                    border-radius: 50%;
                    background: #fff3e6;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.5rem;
                    color: #FF6B08;
                    margin-bottom: 6px;
                    border: 2px solid #FF6B08;
                    transition: background 0.2s, color 0.2s;
                }
                .stepper-item.active .step-counter,
                .stepper-item .step-counter.bg-orange {
                    background: #FF6B08;
                    color: #fff;
                }
                .stepper-line {
                    height: 2px;
                    background: #ffe0c2;
                    flex: 1;
                    margin: 0 12px;
                    margin-top: 22px;
                }
                .step-label {
                    font-size: 0.95rem;
                    color: #FF6B08;
                    font-weight: 600;
                }
                @media (max-width: 600px) {
                    .stepper-line { margin: 0 4px; }
                    .step-label { font-size: 0.85rem; }
                }
            </style>

            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-white border-0 rounded-top-4 pb-0">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-orange bg-opacity-10 rounded-circle p-3 d-inline-block">
                                <i class="fas fa-user-check fa-2x text-orange"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-bold text-dark">Konfirmasi Pendaftaran</h4>
                            <div class="text-muted small">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ \Carbon\Carbon::parse($event->event_date)->isoFormat('dddd, D MMMM Y') }}
                                &nbsp;|&nbsp;
                                <i class="fas fa-clock me-1"></i>
                                {{ $event->event_time }}
                                &nbsp;|&nbsp;
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $event->location->location_name }}
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .text-orange { color: #FF6B08 !important; }
                    .bg-orange.bg-opacity-10 { background: rgba(255, 107, 8, 0.10) !important; }
                </style>
                <div class="card-body p-4 p-md-5">
                    <div class="alert" style="background: #fff3e6; color: #FF6B08; border: 1px solid #FF6B08;">
                        <i class="fas fa-info-circle fa-lg me-2"></i>
                        Pastikan data di bawah sudah benar sebelum Anda mengirim pendaftaran.
                    </div>
                    <form action="{{ route('events.register.confirm.store', $event->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="bg-light rounded-3 p-3 h-100">
                                        <div class="mb-2 text-muted small">Nama Peserta</div>
                                        <div class="fw-semibold">{{ auth()->user()->name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light rounded-3 p-3 h-100">
                                        <div class="mb-2 text-muted small">Email</div>
                                        <div class="fw-semibold">{{ auth()->user()->email }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light rounded-3 p-3 h-100">
                                        <div class="mb-2 text-muted small">Nomor Telepon/WA</div>
                                        <div class="fw-semibold">{{ $registrationData['phone'] }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light rounded-3 p-3 h-100">
                                        <div class="mb-2 text-muted small">Asal Institusi/Jurusan</div>
                                        <div class="fw-semibold">
                                            {{ $registrationData['institution'] ? $registrationData['institution'] : '-' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-light rounded-3 p-3 h-100">
                                        <div class="mb-2 text-muted small">Catatan Tambahan</div>
                                        <div class="fw-semibold">
                                            {{ $registrationData['notes'] ? $registrationData['notes'] : '-' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch gap-2">
                            <a href="{{ route('events.register', $event->id) }}" class="btn btn-outline-orange flex-fill" style="border-color:#FF6B08; color:#FF6B08;">
                                <i class="fas fa-arrow-left me-2"></i>Ubah Data
                            </a>
                            <button type="submit" class="btn btn-orange btn-lg flex-fill" style="background:#FF6B08; color:#fff;">
                                <i class="fas fa-check-circle me-2"></i>Konfirmasi & Daftar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <style>
                .btn-orange {
                    background: #FF6B08 !important;
                    color: #fff !important;
                    border: none;
                }
                .btn-orange:hover, .btn-orange:focus {
                    background: #e66007 !important;
                    color: #fff !important;
                }
                .btn-outline-orange:hover, .btn-outline-orange:focus {
                    background: #FF6B08 !important;
                    color: #fff !important;
                    border-color: #FF6B08 !important;
                }
            </style>
        </div>
    </div>
</div>
@endsection 