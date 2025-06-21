@extends('layouts.public')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-lg">
                <img src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://via.placeholder.com/800x400' }}" class="card-img-top" alt="{{ $event->title }}">
                <div class="card-body p-5">
                    <h1 class="card-title fw-bold mb-3">{{ $event->title }}</h1>
                    <div class="d-flex flex-wrap text-muted mb-4">
                        <span class="me-4"><i class="fas fa-calendar-alt me-2"></i>{{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}</span>
                        <span class="me-4"><i class="fas fa-clock me-2"></i>{{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB</span>
                        <span class="me-4"><i class="fas fa-map-marker-alt me-2"></i>{{ $event->location->location_name }}</span>
                        <span class="me-4"><i class="fas fa-tags me-2"></i>{{ $event->category->name }}</span>
                    </div>

                    <p class="card-text fs-5" style="white-space: pre-wrap;">{{ $event->description }}</p>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1"><strong>Penyelenggara:</strong> {{ $event->organizer ?? 'Tidak disebutkan' }}</p>
                            <p class="mb-0"><strong>Sisa Kuota:</strong> {{ $event->available_slots }}</p>
                        </div>
                        <div>
                            @if($event->available_slots > 0)
                                <a href="{{ route('events.register', $event->id) }}" class="btn btn-primary btn-lg px-5 shadow">Daftar Sekarang</a>
                            @else
                                <button class="btn btn-secondary btn-lg px-5" disabled>Pendaftaran Ditutup</button>
                            @endif
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