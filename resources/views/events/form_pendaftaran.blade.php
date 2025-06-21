@extends('layouts.public')
@section('title', 'Formulir Pendaftaran Event')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4 p-md-5">
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

                    <form method="POST" action="{{ route('events.register.store', $event->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor HP (Opsional)</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-oren btn-lg">Lanjutkan ke Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 