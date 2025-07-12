@extends('layouts.admin')
@section('title', 'Event Pending Approval')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Event Pending Approval</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Tanggal</th>
                    <th>Penyelenggara</th>
                    <th>Diajukan Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->category->name ?? '-' }}</td>
                    <td>{{ $event->location->location_name ?? '-' }}</td>
                    <td>{{ $event->event_date->format('d M Y') }}</td>
                    <td>{{ $event->organizer }}</td>
                    <td>{{ $event->submitted_by ? ($event->submitted_by == auth()->id() ? 'Anda' : (\App\Models\User::find($event->submitted_by)?->name ?? '-') ) : '-' }}</td>
                    <td>
                        <form action="{{ route('admin.events.approve', $event->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui event ini?')"><i class="fas fa-check"></i> Approve</button>
                        </form>
                        <form action="{{ route('admin.events.reject', $event->id) }}" method="POST" class="d-inline ms-1">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tolak event ini?')"><i class="fas fa-times"></i> Reject</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Tidak ada event pending.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $events->links() }}
    </div>
</div>
@endsection 