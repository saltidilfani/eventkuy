@extends('layouts.navbar')
@section('title', 'About Us')

@section('content')
<div class="about-hero position-relative py-5" style="background: linear-gradient(120deg, #FFF3E6 60%, #f4f7f6 100%); min-height: 320px;">
    <div class="container position-relative z-2">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-7 text-center">
                <h1 class="fw-bold mb-3 display-4" style="color:#FF6B08; letter-spacing:1px;">Tentang EventKuy</h1>
                <p class="lead text-secondary mb-4">Platform digital event kampus Politeknik Negeri Padang yang inovatif, mudah, dan inspiratif untuk semua civitas akademika.</p>
            </div>
        </div>
    </div>
    <div class="about-hero-bg position-absolute top-0 start-0 w-100 h-100"
     style="z-index:1; opacity:0.10; background:url('{{ asset('images/foto2.jpg') }}') center/cover no-repeat;">
</div>
</div>
<div class="container py-5">
    <!-- Card Founder, Visi & Misi -->
    <div class="row justify-content-center mb-5 g-4 align-items-center about-fadein">
        <div class="col-lg-4 text-center mb-4 mb-lg-0">
            <div class="about-founder-card p-4 bg-white shadow rounded-4 d-flex flex-column align-items-center">
            <img src="{{ asset('images/nana.jpg') }}" alt="Founder EventKuy" class="about-avatar mb-3" style="width:120px; height:120px; object-fit:cover; border-radius:50%; border:4px solid #FF6B08; background:#fff;">
                <h5 class="fw-bold mb-1 mt-2" style="color:#FF6B08;">Salti Dilfani</h5>
                <div class="text-muted small mb-2">Founder & Developer</div>
                <div class="d-flex justify-content-center gap-3 mt-2">
                    <a href="#" class="text-oren fs-4"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-oren fs-4"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/naxssty/" class="text-oren fs-4"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 h-100 about-card-blur rounded-4" style="background:linear-gradient(120deg,#FFF3E6 80%,#f4f7f6 100%);">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-bullseye text-oren fs-3 me-2"></i>
                    <h4 class="fw-bold mb-0" style="color:#FF6B08;">Visi</h4>
                </div>
                <blockquote class="blockquote mb-4 ps-3 border-start border-4" style="border-color:#FF6B08 !important; background:rgba(255,107,8,0.04);">
                    <p class="mb-0">Menjadi platform event kampus terdepan yang inovatif, inklusif, dan inspiratif di Indonesia.</p>
                </blockquote>
                <div class="d-flex align-items-center mb-3 mt-4">
                    <i class="fas fa-rocket text-oren fs-3 me-2"></i>
                    <h4 class="fw-bold mb-0" style="color:#FF6B08;">Misi</h4>
                </div>
                <ul class="mb-0 ps-3">
                    <li>Menghubungkan mahasiswa dengan event berkualitas dan relevan.</li>
                    <li>Mendukung pengembangan soft skill dan jejaring kampus.</li>
                    <li>Mendorong kolaborasi dan partisipasi aktif civitas akademika.</li>
                    <li>Menyediakan sistem pendaftaran event yang mudah, cepat, dan transparan.</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Card Fitur Grid -->
    <div class="row justify-content-center mb-5 about-fadein">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm p-4 px-md-5 text-center about-card-blur rounded-4" style="background:rgba(244,247,246,0.97);">
                <h3 class="fw-bold mb-4" style="color:#FF6B08;"><i class="fas fa-star me-2"></i>Kenapa Memilih EventKuy?</h3>
                <div class="row g-4 mt-2">
                    <div class="col-md-3 col-6">
                        <div class="about-feature-card h-100 p-3 rounded-4 shadow-sm bg-white border-bottom border-3 border-oren d-flex flex-column align-items-center justify-content-center">
                            <div class="about-feature-icon mb-2"><i class="fas fa-bolt"></i></div>
                            <div class="fw-semibold">Cepat & Mudah</div>
                            <div class="text-muted small">Daftar event hanya dalam beberapa klik.</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="about-feature-card h-100 p-3 rounded-4 shadow-sm bg-white border-bottom border-3 border-oren d-flex flex-column align-items-center justify-content-center">
                            <div class="about-feature-icon mb-2"><i class="fas fa-users"></i></div>
                            <div class="fw-semibold">Komunitas Aktif</div>
                            <div class="text-muted small">Bergabung dengan ribuan peserta kampus.</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="about-feature-card h-100 p-3 rounded-4 shadow-sm bg-white border-bottom border-3 border-oren d-flex flex-column align-items-center justify-content-center">
                            <div class="about-feature-icon mb-2"><i class="fas fa-calendar-check"></i></div>
                            <div class="fw-semibold">Event Terupdate</div>
                            <div class="text-muted small">Info event selalu terbaru & terpercaya.</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="about-feature-card h-100 p-3 rounded-4 shadow-sm bg-white border-bottom border-3 border-oren d-flex flex-column align-items-center justify-content-center">
                            <div class="about-feature-icon mb-2"><i class="fas fa-shield-alt"></i></div>
                            <div class="fw-semibold">Aman & Transparan</div>
                            <div class="text-muted small">Data dan proses pendaftaran terjamin.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Card Kolaborasi -->
    <div class="row justify-content-center mb-5 about-fadein">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm p-4 px-md-5 about-card-blur d-flex flex-column flex-md-row align-items-center justify-content-between rounded-4" style="background:linear-gradient(120deg,#FFF3E6 80%,#f4f7f6 100%);">
                <div class="flex-shrink-0 mb-3 mb-md-0 me-md-4 text-center" style="width:90px;">
                    <img src="https://cdn-icons-png.flaticon.com/512/1256/1256650.png" alt="Kolaborasi" style="width:70px;">
                </div>
                <div class="flex-grow-1">
                    <h4 class="fw-bold mb-2" style="color:#FF6B08;">Bergabung & Berkontribusi</h4>
                    <p class="mb-3 text-secondary">EventKuy terbuka untuk kolaborasi dengan seluruh organisasi, komunitas, dan individu di <span class="fw-semibold">Politeknik Negeri Padang</span>. Ingin mengadakan event, menjadi relawan, atau punya ide pengembangan? <span class="text-oren">Hubungi kami</span> dan jadilah bagian dari perubahan positif di kampus kita!</p>
                </div>
                <div class="flex-shrink-0 mt-3 mt-md-0 ms-md-4">
                    <a href="mailto:info@eventkuy.com" class="btn btn-oren shadow-sm px-4 py-2 fw-semibold" style="background:#FF6B08;color:#fff;border-radius:2rem; font-size:1.1rem;">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Card Kontak -->
    <div class="row justify-content-center mb-5 about-fadein">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 text-center about-card-blur rounded-4" style="background:#fff;">
                <div class="mb-3">
                    <i class="fas fa-envelope-open-text text-oren" style="font-size:2.5rem;"></i>
                </div>
                <h5 class="fw-bold mb-3">Hubungi Kami</h5>
                <p class="mb-2"><i class="fas fa-envelope me-2 text-oren"></i>info@eventkuy.com</p>
                <p class="mb-2"><i class="fas fa-map-marker-alt me-2 text-oren"></i>Jl. Kampus Politeknik Negeri Padang, Limau Manis, Pauh, Padang</p>
                <div class="d-flex justify-content-center gap-3 mt-2">
                    <a href="#" class="text-oren fs-3"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-oren fs-3"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/naxssty/" class="text-oren fs-3"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .about-card-blur {
        backdrop-filter: blur(2px);
        border-radius: 1.25rem;
        transition: box-shadow 0.3s, transform 0.3s;
    }
    .about-card-blur:hover, .about-feature-card:hover {
        box-shadow: 0 8px 32px rgba(255,107,8,0.13), 0 2px 8px rgba(44,62,80,0.08);
        transform: translateY(-2px) scale(1.015);
    }
    .about-feature-icon {
        width: 54px; height: 54px; border-radius: 50%; background: #FFF3E6; color: #FF6B08; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 0.5rem auto; box-shadow: 0 2px 8px rgba(255,107,8,0.08);
        transition: background 0.2s, color 0.2s;
    }
    .about-feature-card:hover .about-feature-icon {
        background: #FF6B08;
        color: #fff;
    }
    .about-avatar { box-shadow: 0 4px 24px rgba(44,62,80,0.10); }
    .text-oren { color: #FF6B08 !important; }
    .border-oren { border-color: #FF6B08 !important; }
    .about-hero-bg { pointer-events: none; }
    .btn-oren:hover, .btn-oren:focus { background:#ff7f32 !important; color:#fff !important; }
    .about-fadein { animation: aboutFadeIn 0.8s cubic-bezier(.4,0,.2,1); }
    @keyframes aboutFadeIn {
        from { opacity:0; transform:translateY(30px); }
        to { opacity:1; transform:none; }
    }
</style>
@endsection 