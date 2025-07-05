@extends('layouts.admin')
@section('title', 'Tambah Event Baru')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-dark mb-0">Tambah Event Baru</h2>
        <p class="text-muted">Isi form di bawah untuk menambahkan event baru.</p>
    </div>
    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Event <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                         @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="8" required>{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">Pilih Kategori...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                         @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="location_id" class="form-label">Lokasi <span class="text-danger">*</span></label>
                        <select name="location_id" id="location_id" class="form-select @error('location_id') is-invalid @enderror" required>
                            <option value="">Pilih Lokasi...</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>{{ $location->location_name }}</option>
                            @endforeach
                        </select>
                         @error('location_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="event_date" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="event_date" id="event_date" class="form-control @error('event_date') is-invalid @enderror" value="{{ old('event_date') }}" required>
                         @error('event_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="event_time" class="form-label">Waktu <span class="text-danger">*</span></label>
                        <input type="time" name="event_time" id="event_time" class="form-control @error('event_time') is-invalid @enderror" value="{{ old('event_time') }}" required>
                         @error('event_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="organizer" class="form-label">Penyelenggara</label>
                        <input type="text" name="organizer" id="organizer" class="form-control @error('organizer') is-invalid @enderror" value="{{ old('organizer') }}">
                         @error('organizer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="max_participants" class="form-label">Kuota Peserta <span class="text-danger">*</span></label>
                        <input type="number" name="max_participants" id="max_participants" class="form-control @error('max_participants') is-invalid @enderror" value="{{ old('max_participants', 100) }}" required>
                         @error('max_participants')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="poster" class="form-label">Poster</label>
                        <input type="file" name="poster" class="form-control @error('poster') is-invalid @enderror">
                        @error('poster')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            

            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-save me-1"></i> Simpan Event
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 