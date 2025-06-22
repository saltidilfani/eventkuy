@extends('admin.layout')
@section('title', 'Edit Lokasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-dark mb-0">Edit Lokasi</h2>
        <p class="text-muted">Perbarui data lokasi di bawah ini.</p>
    </div>
    <a href="{{ route('admin.locations.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.locations.update', $location->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="location_name" class="form-label">Nama Lokasi</label>
                <input type="text" name="location_name" id="location_name" class="form-control @error('location_name') is-invalid @enderror" value="{{ old('location_name', $location->location_name) }}" required>
                @error('location_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address', $location->address) }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="background:var(--primary-admin)">Update Lokasi</button>
        </form>
    </div>
</div>
@endsection 