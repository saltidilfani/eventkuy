@extends('layouts.navbar')
@section('title', 'Contact')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white px-0 mb-4">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-lg-6 mb-4">
            <h3 class="fw-bold mb-3">EventKuy HQ</h3>
            <p class="mb-2"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Jl. Kampus Politeknik Negeri Padang, Limau Manis, Pauh, Padang, Sumatera Barat 25164</p>
            <p class="mb-2"><i class="fas fa-envelope me-2 text-primary"></i>info@eventkuy.com</p>
            <p class="mb-2"><i class="fas fa-phone me-2 text-primary"></i>Customer Service: 0812-3456-7890</p>
            <p class="mb-4"><i class="fas fa-handshake me-2 text-primary"></i>Kerja sama: partnership@eventkuy.com</p>
            <hr>
            <h5 class="fw-semibold mb-3">Ikuti Kami</h5>
            <a href="#" class="text-primary me-3"><i class="fab fa-facebook fa-lg"></i></a>
            <a href="#" class="text-primary me-3"><i class="fab fa-twitter fa-lg"></i></a>
            <a href="#" class="text-primary"><i class="fab fa-linkedin fa-lg"></i></a>
        </div>
        <div class="col-lg-6">
            <h4 class="fw-bold mb-3">Kirim Pesan</h4>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('contact.send') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subjek</label>
                    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" required value="{{ old('subject') }}">
                    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-primary px-4">Kirim Pesan</button>
            </form>
        </div>
    </div>
</div>
@endsection 