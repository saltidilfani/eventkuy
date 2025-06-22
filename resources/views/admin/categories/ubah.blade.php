@extends('admin.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ $event->title }}</h4>
    </div>
    <div class="card-body">
        <p><strong>Kategori:</strong> {{ $event->category->name }}</p>
        <p><strong>Lokasi:</strong> {{ $event->location->name }}</p>
        <p><strong>Tanggal:</strong> {{ $event->event_date->format('d M Y') }}</p>
        <p><strong>Deskripsi:</strong> {{ $event->description }}</p>
        @if($event->poster)
            <img src="{{ asset('storage/' . $event->poster) }}" alt="Poster" class="img-fluid mb-3" style="max-width:300px;">
        @endif
    </div>
</div>
@endsection 