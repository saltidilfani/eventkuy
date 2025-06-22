@extends('layouts.admin')
@section('title', 'Manajemen Pendaftaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-dark mb-0">Manajemen Pendaftaran</h2>
        <p class="text-muted">Lihat semua data peserta yang terdaftar di event.</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="py-3">Event</th>
                        <th class="py-3">Nama Peserta</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">No. Telepon</th>
                        <th class="py-3">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $registration)
                    <tr>
                        <td class="align-middle fw-bold">{{ $registration->event->title }}</td>
                        <td class="align-middle">{{ $registration->user->name }}</td>
                        <td class="align-middle">{{ $registration->user->email }}</td>
                        <td class="align-middle">{{ $registration->phone }}</td>
                        <td class="align-middle">{{ $registration->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center p-4">
                            <i class="fas fa-users-slash fa-2x text-muted mb-2"></i><br>
                            Belum ada data pendaftaran.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
             {{ $registrations->links() }}
        </div>
    </div>
</div>
@endsection 