@extends('admin.layout')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2><i class="fas fa-tachometer-alt me-2 text-primary"></i>Dashboard Admin</h2>
        <p class="text-muted">Selamat datang di panel admin Eventkuy</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white border-0 shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title mb-0">{{ $totalEvents }}</h3>
                        <p class="card-text mb-0">Total Events</p>
                    </div>
                    <div class="text-end">
                        <i class="fas fa-calendar-check fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white border-0 shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title mb-0">{{ $totalUsers }}</h3>
                        <p class="card-text mb-0">Total Users</p>
                    </div>
                    <div class="text-end">
                        <i class="fas fa-users fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-white border-0 shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title mb-0">{{ $totalRegistrations }}</h3>
                        <p class="card-text mb-0">Registrations</p>
                    </div>
                    <div class="text-end">
                        <i class="fas fa-clipboard-list fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Events Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Event Terbaru</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentEvents as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->category->name }}</td>
                            <td>{{ $event->location->name }}</td>
                            <td>{{ $event->event_date->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada event terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 