@extends('admin.layout')
@section('title', 'Daftar Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-dark mb-0">Daftar Kategori Event</h2>
        <p class="text-muted">Lihat semua kategori event yang tersedia.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" style="background:var(--primary-admin)">
        <i class="fas fa-plus me-2"></i> Tambah Kategori
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="py-3 px-3">ID</th>
                        <th class="py-3 px-3">Nama Kategori</th>
                        <th class="py-3 px-3">Jumlah Event Terkait</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td class="align-middle p-3">{{ $category->id }}</td>
                        <td class="align-middle fw-bold p-3">{{ $category->name }}</td>
                        <td class="align-middle p-3">{{ $category->events_count }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center p-5">
                            <i class="fas fa-tags fa-3x text-muted mb-3"></i><br>
                            Belum ada data kategori.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white">
        {{ $categories->links() }}
    </div>
</div>
@endsection 