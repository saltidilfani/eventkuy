@extends('layouts.navbar')

@section('content')
<style>
    .contact-card-ek {
        max-width: 520px;
        margin: 48px auto 48px auto;
        border-radius: 1.25rem;
        box-shadow: 0 6px 32px rgba(255,107,8,0.10), 0 2px 8px rgba(44,62,80,0.08);
        background: #fff;
        padding: 2.5rem 2rem 2rem 2rem;
        transition: box-shadow 0.2s, transform 0.2s;
        border: none;
        position: relative;
        overflow: hidden;
    }
    .contact-card-ek:before {
        content: '';
        position: absolute;
        top: -60px; left: -60px;
        width: 180px; height: 180px;
        background: linear-gradient(135deg, #FF6B08 0%, #FFC837 100%);
        opacity: 0.08;
        border-radius: 50%;
        z-index: 0;
    }
    .contact-title-ek {
        font-weight: 800;
        font-size: 2.1rem;
        margin-bottom: 0.5rem;
        color: #FF6B08;
        text-align: center;
        letter-spacing: 0.5px;
    }
    .contact-desc-ek {
        color: #6c757d;
        font-size: 1.08rem;
        margin-bottom: 2rem;
        text-align: center;
    }
    .form-label {
        font-weight: 600;
        color: #FF6B08;
    }
    .form-control:focus {
        border-color: #FF6B08;
        box-shadow: 0 0 0 0.2rem rgba(255,107,8,.13);
    }
    .btn-ek {
        background: linear-gradient(90deg, #FF6B08 0%, #FFC837 100%);
        border: none;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #fff;
        border-radius: 2rem;
        transition: background 0.2s, transform 0.2s;
        box-shadow: 0 2px 8px #ffb86b33;
    }
    .btn-ek:hover {
        background: linear-gradient(90deg, #ff7f32 0%, #FFB86B 100%);
        color: #fff;
        transform: translateY(-2px) scale(1.03);
    }
    .input-icon-ek {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #FFB86B;
        font-size: 1.15rem;
        z-index: 2;
    }
    .input-group-ek {
        position: relative;
    }
    .input-group-ek .form-control {
        padding-left: 2.4rem;
        background: #fff8f3;
        border-radius: 1rem;
        border: 1.5px solid #ffe0c2;
        font-size: 1.05rem;
    }
    .alert-success {
        text-align: center;
        font-weight: 600;
        border-radius: 10px;
        background: #FFB86B;
        color: #fff;
        border: none;
        box-shadow: 0 2px 8px #ffb86b33;
    }
    @media (max-width: 600px) {
        .contact-card-ek { padding: 1.5rem 0.5rem; }
        .contact-title-ek { font-size: 1.4rem; }
    }
</style>

<div class="contact-card-ek animate__animated animate__fadeInUp">
    <div class="contact-title-ek">
        <i class="fas fa-paper-plane"></i> Hubungi Kami
    </div>
    <div class="contact-desc-ek">
        Punya pertanyaan, kritik, atau saran? Kirim pesan ke tim <b>EventKuy</b> melalui form berikut. Kami siap membantu kamu!
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success mb-3">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.send') }}" autocomplete="off" novalidate>
        @csrf
        <div class="mb-3 input-group-ek">
            <span class="input-icon-ek"><i class="fas fa-user"></i></span>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" placeholder="Nama Lengkap" required value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 input-group-ek">
            <span class="input-icon-ek"><i class="fas fa-envelope"></i></span>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" placeholder="Alamat Email" required value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 input-group-ek">
            <span class="input-icon-ek"><i class="fas fa-comment-dots"></i></span>
            <input type="text" class="form-control @error('subject') is-invalid @enderror"
                   id="subject" name="subject" placeholder="Subjek Pesan" required value="{{ old('subject') }}">
            @error('subject')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 input-group-ek">
            <span class="input-icon-ek" style="top:18px;"><i class="fas fa-pencil-alt"></i></span>
            <textarea class="form-control @error('message') is-invalid @enderror"
                      id="message" name="message" rows="4" placeholder="Tulis pesan Anda di sini..." required>{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-ek w-100 py-2 mt-2">
            <i class="fas fa-paper-plane"></i> Kirim Pesan
        </button>
    </form>
</div>

{{-- FontAwesome CDN untuk icon modern --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- Animasi CSS (optional) --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endsection 