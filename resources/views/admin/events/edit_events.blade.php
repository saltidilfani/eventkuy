@extends('layouts.admin')
@section('title', 'Edit Event')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-dark mb-0">Edit Event</h2>
        <p class="text-muted">Perbarui data event di bawah ini.</p>
    </div>
    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Event</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $event->title) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" rows="8" required>{{ old('description', $event->description) }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="location_id" class="form-label">Lokasi</label>
                        <select name="location_id" id="location_id" class="form-select" required>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ $event->location_id == $location->id ? 'selected' : '' }}>{{ $location->location_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="event_date" class="form-label">Tanggal</label>
                        <input type="date" name="event_date" id="event_date" class="form-control" value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="event_time" class="form-label">Waktu</label>
                        <input type="time" name="event_time" id="event_time" class="form-control" value="{{ old('event_time', $event->event_time) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="organizer" class="form-label">Penyelenggara</label>
                        <input type="text" name="organizer" id="organizer" class="form-control" value="{{ old('organizer', $event->organizer) }}">
                    </div>
                    <div class="mb-3">
                        <label for="max_participants" class="form-label">Kuota Peserta</label>
                        <input type="number" name="max_participants" id="max_participants" class="form-control" value="{{ old('max_participants', $event->max_participants) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="poster" class="form-label">Ganti Poster (Opsional)</label>
                        <input type="file" name="poster" class="form-control">
                        @if($event->poster)
                            <img src="{{ asset('storage/' . $event->poster) }}" alt="Poster" class="img-thumbnail mt-2" width="150">
                        @endif
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="background:var(--primary-admin)">Update Event</button>
        </form>
    </div>
</div>
@endsection 