@extends('layouts.admin')
@section('title', 'Manajemen Event')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col-md-6">
        <h2 class="text-dark mb-0">Manajemen Event</h2>
        <p class="text-muted">Kelola, cari, dan lihat semua event di sini.</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary px-4 py-2 fw-semibold" style="border-radius: 0.75rem;">
            <i class="fas fa-plus me-2"></i> Tambah Event Baru
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <form action="{{ route('admin.events.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul event..." value="{{ $search }}">
                <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="py-3 px-3">Poster</th>
                        <th class="py-3 px-3">Judul</th>
                        <th class="py-3 px-3">Pendaftar</th>
                        <th class="py-3 px-3">Status</th>
                        <th class="py-3 px-3">Tanggal</th>
                        <th class="py-3 px-2 text-center" style="font-size:0.95rem;font-weight:600;min-width:60px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                    <tr>
                        <td class="align-middle p-3">
                            <img src="{{ $event->poster ? asset('storage/' . $event->poster) : 'https://via.placeholder.com/80x80?text=N/A' }}" alt="Poster" class="img-thumbnail" width="80" height="80" style="object-fit: cover;">
                        </td>
                        <td class="align-middle">
                            <span class="fw-bold">{{ Str::limit($event->title, 40) }}</span><br>
                            <small class="text-muted">{{ $event->category->name }} | {{ $event->location->location_name }}</small>
                        </td>
                        <td class="align-middle">
                            <span class="fw-bold">{{ $event->registrations_count }}</span> / {{ $event->max_participants }}
                        </td>
                        <td class="align-middle">
                            @if($event->event_date->isFuture())
                                <span class="badge bg-success">Akan Datang</span>
                            @elseif($event->event_date->isToday())
                                <span class="badge bg-warning">Hari Ini</span>
                            @else
                                <span class="badge bg-secondary">Selesai</span>
                            @endif
                        </td>
                        <td class="align-middle">{{ $event->event_date->format('d M Y') }}</td>

                        <td class="text-end align-middle p-3">
                            <div class="d-flex flex-column align-items-end gap-1">
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center justify-content-center" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top" style="border-radius: 0.5rem; width: 32px; height: 32px; padding:0;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('events.detail', $event->id) }}" target="_blank" class="btn btn-sm btn-outline-info d-flex align-items-center justify-content-center" title="Lihat" data-bs-toggle="tooltip" data-bs-placement="top" style="border-radius: 0.5rem; width: 32px; height: 32px; padding:0;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center" title="Hapus" data-bs-toggle="tooltip" data-bs-placement="top" style="border-radius: 0.5rem; width: 32px; height: 32px; padding:0;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                            </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center p-5">
                            <i class="fas fa-search-minus fa-3x text-muted mb-3"></i><br>
                            @if($search)
                                Event dengan judul "{{ $search }}" tidak ditemukan.
                            @else
                                Belum ada data event.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        {{ $events->links() }}
    </div>
</div>
@endsection 

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush 