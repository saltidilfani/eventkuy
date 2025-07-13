@extends('layouts.admin')
@section('title', 'Detail Event - ' . $event->title)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">
            <i class="fas fa-calendar-alt me-2"></i>Detail Event
        </h2>
        <div>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
            @if($event->status === 'pending')
                <a href="{{ route('admin.events.pending') }}" class="btn btn-warning">
                    <i class="fas fa-clock me-2"></i>Pending Events
                </a>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Detail Event -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i>Informasi Event
                    </h6>
                    <div>
                        @if($event->status === 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($event->status === 'approved')
                            <span class="badge bg-success">Approved</span>
                        @elseif($event->status === 'rejected')
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="text-primary mb-3">{{ $event->title }}</h4>
                            <div class="mb-3">
                                <strong>Deskripsi:</strong>
                                <p class="text-muted">{{ $event->description }}</p>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong><i class="fas fa-calendar me-2"></i>Tanggal:</strong>
                                    <p class="text-muted">{{ $event->event_date->format('d/m/Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong><i class="fas fa-clock me-2"></i>Waktu:</strong>
                                    <p class="text-muted">{{ $event->event_time }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong><i class="fas fa-tag me-2"></i>Kategori:</strong>
                                    <p class="text-muted">{{ $event->category->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong><i class="fas fa-map-marker-alt me-2"></i>Lokasi:</strong>
                                    <p class="text-muted">{{ $event->location->location_name }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong><i class="fas fa-users me-2"></i>Penyelenggara:</strong>
                                    <p class="text-muted">{{ $event->organizer ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong><i class="fas fa-user-friends me-2"></i>Maksimal Peserta:</strong>
                                    <p class="text-muted">{{ $event->max_participants }} orang</p>
                                </div>
                            </div>
                            @if($event->submittedBy)
                            <div class="mb-3">
                                <strong><i class="fas fa-user me-2"></i>Diajukan Oleh:</strong>
                                <p class="text-muted">{{ $event->submittedBy->name }} ({{ $event->submittedBy->email }})</p>
                            </div>
                            @endif
                            <div class="mb-3">
                                <strong><i class="fas fa-calendar-plus me-2"></i>Tanggal Dibuat:</strong>
                                <p class="text-muted">{{ $event->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if($event->poster)
                                <img src="{{ asset('storage/' . $event->poster) }}" 
                                     alt="Poster {{ $event->title }}" 
                                     class="img-fluid rounded shadow">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                     style="height: 200px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Action Buttons -->
            @if($event->status === 'pending')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-cogs me-2"></i>Aksi
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.events.approve', $event->id) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="btn btn-success w-100" 
                                onclick="return confirm('Setujui event ini?')">
                            <i class="fas fa-check me-2"></i>Setujui Event
                        </button>
                    </form>
                    <form action="{{ route('admin.events.reject', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100" 
                                onclick="return confirm('Tolak event ini?')">
                            <i class="fas fa-times me-2"></i>Tolak Event
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 