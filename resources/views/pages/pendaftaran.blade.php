@extends('layouts.navbar')
@section('title', 'Form Pendaftaran: ' . $event->title)

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-white px-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.detail', $event->id) }}">{{ $event->title }}</a></li>
                    <li class="breadcrumb-item active">Pendaftaran</li>
                </ol>
            </nav>

            <div class="card shadow-lg border-0 rounded-3">
                <!-- Header Card -->
                <div class="card-header bg-gradient-primary text-white py-4 rounded-top-3" style="background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                <i class="fas fa-user-plus fa-2x"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-1">Form Pendaftaran Event</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body p-5">
                    <!-- Event Info Card -->
                    <div class="card bg-light border-0 mb-4">
                <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center mb-3 mb-md-0">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block">
                                        <i class="fas fa-calendar-check fa-2x text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <h5 class="fw-bold text-dark mb-2">{{ $event->title }}</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">
                                                <i class="fas fa-calendar-alt fa-fw me-2 text-primary"></i>
                                                {{ \Carbon\Carbon::parse($event->event_date)->isoFormat('dddd, D MMMM Y') }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">
                                                <i class="fas fa-clock fa-fw me-2 text-primary"></i>
                                                {{ $event->event_time }}
                                            </p>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-muted">
                                        <i class="fas fa-map-marker-alt fa-fw me-2 text-primary"></i>
                                        {{ $event->location->location_name }}
                                    </p>
                                </div>
                            </div>
                    </div>
                    </div>

                    <!-- Registration Form -->
                    <form action="{{ route('events.register.store', $event->id) }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- User Info Section -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-dark mb-3">
                                    <i class="fas fa-user fa-fw me-2 text-primary"></i>
                                    Informasi Peserta
                                </h6>

                        <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input type="text" id="name" class="form-control bg-light" value="{{ auth()->user()->name }}" disabled>
                                    </div>
                        </div>

                        <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" id="email" class="form-control bg-light" value="{{ auth()->user()->email }}" disabled>
                                    </div>
                                </div>
                        </div>

                            <!-- Contact & Additional Info Section -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-dark mb-3">
                                    <i class="fas fa-phone fa-fw me-2 text-primary"></i>
                                    Informasi Kontak & Tambahan
                                </h6>
                        
                        <div class="mb-3">
                                    <label for="phone" class="form-label fw-semibold">
                                        Nomor Telepon/WhatsApp <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-phone text-muted"></i>
                                        </span>
                                        <input type="tel" name="phone" id="phone" 
                                               class="form-control @error('phone') is-invalid @enderror" 
                                               value="{{ old('phone') }}" 
                                               placeholder="08xxxxxxxxxx" required>
                                    </div>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                                    <label for="institution" class="form-label fw-semibold">Asal Institusi/Jurusan</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-graduation-cap text-muted"></i>
                                        </span>
                                        <input type="text" name="institution" id="institution" 
                                               class="form-control @error('institution') is-invalid @enderror" 
                                               value="{{ old('institution') }}"
                                               placeholder="Contoh: Teknik Informatika PNP">
                                    </div>
                             @error('institution')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Notes Section -->
                        <div class="mb-4">
                            <label for="notes" class="form-label fw-semibold">
                                <i class="fas fa-sticky-note fa-fw me-2 text-primary"></i>
                                Catatan Tambahan
                            </label>
                            <textarea name="notes" id="notes" 
                                      class="form-control @error('notes') is-invalid @enderror" 
                                      rows="3" 
                                      placeholder="Tulis catatan tambahan jika ada (opsional)...">{{ old('notes') }}</textarea>
                             @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg py-3 fw-semibold">
                                <i class="fas fa-arrow-right me-2"></i>
                                Lanjutkan ke Konfirmasi
                            </button>
                            <a href="{{ route('events.detail', $event->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali ke Detail Event
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 