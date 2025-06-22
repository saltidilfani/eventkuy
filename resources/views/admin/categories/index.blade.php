@extends('admin.layout')
@section('title', 'Manajemen Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-dark mb-0">Manajemen Kategori</h2>
        <p class="text-muted">Kelola semua kategori event di sini.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" style="background:var(--primary-admin)">
        <i class="fas fa-plus me-2"></i> Tambah Kategori
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="py-3">ID</th>
                        <th class="py-3">Nama Kategori</th>
                        <th class="py-3">Jumlah Event</th>
                        <th class="py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td class="align-middle">{{ $category->id }}</td>
                        <td class="align-middle fw-bold">{{ $category->name }}</td>
                        <td class="align-middle">{{ $category->events_count }}</td>
                        <td class="text-end">
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">Belum ada data kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
             {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection 