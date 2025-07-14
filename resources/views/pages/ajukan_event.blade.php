@extends('layouts.navbar')
@section('title', 'Ajukan Event Baru')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-white rounded-top-4" style="background: linear-gradient(135deg, #FF6B08 0%, #FFC837 100%);">
                    <h3 class="mb-0 fw-bold">Ajukan Event Baru</h3>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div style="background:#28a745;color:white;padding:12px 18px;border-radius:8px;margin-bottom:18px;font-weight:600;box-shadow:0 2px 8px rgba(40,167,69,0.3);">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('events.submit.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Event</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="event_date" class="form-label">Tanggal Event</label>
                                <input type="date" class="form-control" id="event_date" name="event_date" value="{{ old('event_date') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="event_time" class="form-label">Waktu</label>
                                <input type="time" class="form-control" id="event_time" name="event_time" value="{{ old('event_time') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="location_id" class="form-label">Lokasi</label>
                                <select class="form-select" id="location_id" name="location_id" required>
                                    <option value="">Pilih Lokasi</option>
                                    @foreach($locations as $loc)
                                        <option value="{{ $loc->id }}" {{ old('location_id') == $loc->id ? 'selected' : '' }}>{{ $loc->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="organizer" class="form-label">Penyelenggara</label>
                            <input type="text" class="form-control" id="organizer" name="organizer" value="{{ old('organizer') }}">
                        </div>
                        <div class="mb-3">
                            <label for="max_participants" class="form-label">Maksimal Peserta</label>
                            <input type="number" class="form-control" id="max_participants" name="max_participants" min="1" value="{{ old('max_participants', 100) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="poster" class="form-label">Poster Event (opsional)</label>
                            <input type="file" class="form-control" id="poster" name="poster" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Ajukan Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 