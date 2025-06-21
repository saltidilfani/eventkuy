@extends('layouts.public')
@section('title', 'Konfirmasi Pendaftaran')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-check-circle fa-3x text-oren"></i>
                        <h3 class="mt-3">Konfirmasi Pendaftaran</h3>
                        <p class="text-muted">Pastikan data Anda sudah benar sebelum mendaftar.</p>
                    </div>
                    <div class="alert alert-warning-subtle border-warning-subtle">
                        <h5 class="alert-heading">{{ $event->title }}</h5>
                        <p class="mb-1"><i class="fas fa-calendar-alt fa-fw me-2"></i>{{ \Carbon\Carbon::parse($event->event_date)->isoFormat('dddd, D MMMM Y') }}</p>
                        <p class="mb-0"><i class="fas fa-map-marker-alt fa-fw me-2"></i>{{ $event->location->location_name }}</p>
                    </div>
                    <form method="POST" action="{{ route('events.register.confirm.store', $event->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Pendaftar</label>
                            <input type="text" class="form-control" value="{{ $registrationData['name'] }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Pendaftar</label>
                            <input type="text" class="form-control" value="{{ $registrationData['email'] }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. HP</label>
                            <input type="text" class="form-control" value="{{ $registrationData['phone'] ?? '-' }}" disabled>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-oren btn-lg">
                                <i class="fas fa-check-circle me-2"></i>Ya, Konfirmasi Pendaftaran Saya
                            </button>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('events.register', $event->id) }}" class="text-muted small">Kembali untuk Edit Data</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 