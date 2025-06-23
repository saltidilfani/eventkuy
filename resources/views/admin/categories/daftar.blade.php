@extends('layouts.admin')
@section('title', 'Daftar Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-dark mb-0">Daftar Kategori Event</h2>
        <p class="text-muted">Lihat semua kategori event yang tersedia.</p>
    </div>
    <a href="{{ route('admin.categories.add_kategori') }}" class="btn btn-primary" style="background:var(--primary-admin)">
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
                        <th class="py-3 px-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td class="align-middle p-3">{{ $category->id }}</td>
                        <td class="align-middle fw-bold p-3">{{ $category->name }}</td>
                        <td class="align-middle p-3">{{ $category->events_count }}</td>
                        <td class="align-middle p-3 text-center">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="btn btn-sm btn-outline-warning me-1 d-inline-flex align-items-center"
                               title="Edit">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger d-inline-flex align-items-center" title="Hapus">
                                    <i class="fas fa-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center p-5">
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