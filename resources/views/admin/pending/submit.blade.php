@extends('layouts.admin')
@section('title', 'Event Pending Approval')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">
            <i class="fas fa-clock me-2"></i>Event Pending Approval
        </h2>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Event
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($events->count() > 0)
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-list me-2"></i>Daftar Event Menunggu Persetujuan ({{ $events->total() }})
                </h6>
            </div>
            <div class="card-body">
    <div class="table-responsive">
                    <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                                <th width="5%">No</th>
                                <th width="15%">Poster</th>
                                <th width="20%">Judul Event</th>
                                <th width="10%">Kategori</th>
                                <th width="15%">Lokasi</th>
                                <th width="10%">Tanggal</th>
                                <th width="10%">Penyelenggara</th>
                                <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                            @foreach($events as $index => $event)
                                <tr>
                                    <td class="text-center">{{ $events->firstItem() + $index }}</td>
                                    <td class="text-center">
                                        @if($event->poster)
                                            <img src="{{ asset('storage/' . $event->poster) }}" 
                                                 alt="Poster {{ $event->title }}" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 80px; max-height: 80px;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 80px; height: 80px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $event->title }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-user me-1"></i>
                                            Diajukan oleh: {{ $event->submittedBy->name ?? 'Unknown' }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $event->created_at->format('d/m/Y H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $event->category->name }}</span>
                                    </td>
                                    <td>{{ $event->location->location_name }}</td>
                                    <td>
                                        {{ $event->event_date->format('d/m/Y') }}
                                        <br>
                                        <small class="text-muted">{{ $event->event_time }}</small>
                                    </td>
                                    <td>{{ $event->organizer ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex flex-column align-items-center gap-1" role="group">
                                            <a href="{{ route('admin.events.show', $event->id) }}"
                                               class="btn btn-sm btn-outline-info d-flex align-items-center justify-content-center"
                                               title="Lihat Detail"
                                               style="border-radius: 0.5rem; width: 32px; height: 32px; padding:0;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.events.approve', $event->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm btn-success d-flex align-items-center justify-content-center"
                                                        title="Setujui Event"
                                                        style="border-radius: 0.5rem; width: 32px; height: 32px; padding:0;"
                                                        onclick="return confirm('Setujui event ini?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.events.reject', $event->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm btn-danger d-flex align-items-center justify-content-center"
                                                        title="Tolak Event"
                                                        style="border-radius: 0.5rem; width: 32px; height: 32px; padding:0;"
                                                        onclick="return confirm('Tolak event ini?')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
            </tbody>
        </table>
    </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
        {{ $events->links() }}
    </div>
            </div>
        </div>
    @else
        <div class="card shadow">
            <div class="card-body text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Tidak Ada Event Pending</h5>
                <p class="text-muted">Semua event sudah disetujui atau ditolak.</p>
                <a href="{{ route('admin.events.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Event
                </a>
            </div>
        </div>
    @endif
</div>
@endsection 