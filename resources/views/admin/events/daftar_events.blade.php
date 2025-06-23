@extends('layouts.admin')
@section('title', 'Manajemen Event')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col-md-6">
        <h2 class="text-dark mb-0">Manajemen Event</h2>
        <p class="text-muted">Kelola, cari, dan lihat semua event di sini.</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary" style="background:var(--primary-admin)">
            <i class="fas fa-plus me-2"></i> Tambah Event Baru
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <form action="{{ route('admin.events.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul event..." value="{{ $search }}">
                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
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
                        <th class="py-3 px-3">Status</th>
                        <th class="py-3 px-3">Pendaftar</th>
                        <th class="py-3 px-3">Tanggal</th>
                        <th class="py-3 px-3 text-end">Aksi</th>
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
                            @if($event->event_date->isFuture())
                                <span class="badge bg-success">Akan Datang</span>
                            @elseif($event->event_date->isToday())
                                <span class="badge bg-warning">Hari Ini</span>
                            @else
                                <span class="badge bg-secondary">Selesai</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            <span class="fw-bold">{{ $event->registrations_count }}</span> / {{ $event->max_participants }}
                        </td>
                        <td class="align-middle">{{ $event->event_date->format('d M Y') }}</td>
                        <td class="text-end align-middle p-3">
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus event ini?');">
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('events.detail', $event->id) }}" target="_blank" class="btn btn-sm btn-info" title="Lihat"><i class="fas fa-eye"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
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