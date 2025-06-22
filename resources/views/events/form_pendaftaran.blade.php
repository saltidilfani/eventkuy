@extends('layouts.public')
@section('title', 'Daftar Event: ' . $event->title)

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Form Pendaftaran: {{ $event->title }}</h4>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="fas fa-edit fa-3x text-oren"></i>
                        <h3 class="mt-3">Daftar Event</h3>
                        <p class="text-muted">Isi data diri Anda untuk mengikuti event.</p>
                    </div>
                    <div class="alert alert-primary-subtle border-primary-subtle">
                        <h5 class="alert-heading">{{ $event->title }}</h5>
                        <p class="mb-1"><i class="fas fa-calendar-alt fa-fw me-2"></i>{{ \Carbon\Carbon::parse($event->event_date)->isoFormat('dddd, D MMMM Y') }}</p>
                        <p class="mb-0"><i class="fas fa-map-marker-alt fa-fw me-2"></i>{{ $event->location->location_name }}</p>
                    </div>

                    <form action="{{ route('events.register.store', $event->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Peserta</label>
                            <input type="text" id="name" class="form-control" value="{{ auth()->user()->name }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon/WA <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="institution" class="form-label">Asal Institusi/Jurusan (Opsional)</label>
                            <input type="text" name="institution" id="institution" class="form-control @error('institution') is-invalid @enderror" value="{{ old('institution') }}">
                             @error('institution')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Catatan Tambahan (Opsional)</label>
                            <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="3">{{ old('notes') }}</textarea>
                             @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Lanjutkan ke Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 