@extends('layouts.admin')
@section('title', 'Tambah Lokasi Baru')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-dark mb-0">Tambah Lokasi Baru</h2>
        <p class="text-muted">Isi form di bawah untuk menambahkan lokasi baru.</p>
    </div>
    <a href="{{ route('admin.locations.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.locations.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="location_name" class="form-label">Nama Lokasi</label>
                <input type="text" name="location_name" id="location_name" class="form-control @error('location_name') is-invalid @enderror" value="{{ old('location_name') }}" required>
                @error('location_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address') }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="background:var(--primary-admin)">Simpan Lokasi</button>
        </form>
    </div>
</div>
@endsection 