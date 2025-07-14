@extends('layouts.navbar')
@section('title', 'Notifikasi & Riwayat')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Notifikasi & Riwayat</h2>

    <h5 class="mb-2">Riwayat Pendaftaran Event</h5>
    @if($registrations->count() > 0)
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-sm align-middle">
            <thead class="table-light">
                <tr>
                    <th>Event</th>
                    <th>Lokasi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Waktu Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $reg)
                <tr>
                    <td>{{ $reg->event->title }}</td>
                    <td>{{ $reg->event->location->location_name }}</td>
                    <td>{{ $reg->event->event_date->format('d M Y') }}</td>
                    <td><span class="badge bg-success">Terdaftar</span></td>
                    <td>{{ $reg->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="alert alert-info">Belum ada pendaftaran event.</div>
    @endif

    <h5 class="mb-2 mt-4">Event yang Anda Ajukan</h5>
    @if($submittedEvents->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered table-sm align-middle">
            <thead class="table-light">
                <tr>
                    <th>Poster</th>
                    <th>Event</th>
                    <th>Lokasi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Waktu Pengajuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submittedEvents as $event)
                <tr>
                    <td style="width:60px">
                        @if($event->poster)
                            <img src="{{ Storage::url($event->poster) }}" alt="{{ $event->title }}" style="width:50px; height:50px; object-fit:cover; border-radius:6px;">
                        @else
                            <span class="text-muted"><i class="fas fa-image"></i></span>
                        @endif
                    </td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->location->location_name }}</td>
                    <td>{{ $event->event_date->format('d M Y') }}</td>
                    <td>
                        @if($event->status == 'pending')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @elseif($event->status == 'approved')
                            <span class="badge bg-success">Disetujui</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>{{ $event->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="alert alert-info">Belum ada event yang diajukan.</div>
    @endif
</div>
@endsection 