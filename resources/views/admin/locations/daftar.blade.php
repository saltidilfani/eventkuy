@extends('layouts.admin')
@section('title', 'Manajemen Lokasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-dark mb-0">Manajemen Lokasi</h2>
        <p class="text-muted">Kelola semua lokasi event di sini.</p>
    </div>
    <a href="{{ route('admin.locations.create') }}" class="btn btn-primary px-4 py-2 fw-semibold" style="border-radius: 0.75rem;">
        <i class="fas fa-plus me-2"></i> Tambah Lokasi
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="py-3">ID</th>
                        <th class="py-3">Nama Lokasi</th>
                        <th class="py-3">Alamat</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($locations as $location)
                    <tr>
                        <td class="align-middle">{{ $location->id }}</td>
                        <td class="align-middle fw-bold">{{ $location->location_name }}</td>
                        <td class="align-middle">{{ $location->address }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?');">
                                <a href="{{ route('admin.locations.edit', $location->id) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i> Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">Belum ada data lokasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
             {{ $locations->links() }}
        </div>
    </div>
</div>
@endsection 