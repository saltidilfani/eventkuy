@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">Tambah Kategori</div>
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" name="name" class="form-control" required>
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold rounded-3">
                <i class="fas fa-save me-2"></i> Simpan Kategori
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection 