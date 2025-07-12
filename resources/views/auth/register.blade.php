<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Akun Baru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body style="background: #fff3e6; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden my-5">
                <div class="row g-0">
                    <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center text-white" style="background: linear-gradient(135deg, #FF6B08 0%, #FFC837 100%);">
                        <div class="text-center p-5">
                            <i class="fas fa-rocket fa-4x mb-4"></i>
                            <h2 class="h1 fw-bold mb-2">EventKuy</h2>
                            <p class="mb-0">Satu platform untuk semua event dan kegiatan di lingkungan Politeknik Negeri Padang.</p>
                        </div>
                    </div>
                    <div class="col-md-6 bg-white">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold mb-1" style="color:#FF6B08;">Buat Akun Baru</h3>
                            </div>
                            @if($errors->any())<div class="alert alert-danger py-2 small"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                            <form method="POST" action="{{ route('register') }}" autocomplete="off">
                                @csrf
                                <div class="mb-3 position-relative">
                                    <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-user text-oren"></i></span>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" required autofocus>
                                    </div>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="email" class="form-label fw-semibold">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-envelope text-oren"></i></span>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-lock text-oren"></i></span>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fas fa-lock text-oren"></i></span>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
                                    </div>
                                </div>
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-lg fw-bold text-white" style="background:#FF6B08; box-shadow:0 4px 16px rgba(255,107,8,0.15); letter-spacing:1px;">Register <i class="fas fa-user-plus ms-2"></i></button>
                                </div>
                            </form>
                            <div class="text-center mt-4">
                                <p class="small mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold text-decoration-none" style="color:#FF6B08;">Login di sini</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .text-oren { color: #FF6B08 !important; }
    .input-group-text { border-radius: 0.75rem 0 0 0.75rem; }
    .form-control { border-radius: 0 0.75rem 0.75rem 0; }
    .btn:focus { box-shadow: 0 0 0 0.2rem rgba(255,107,8,0.15) !important; }
    body { background: #fff3e6; }
    @media (max-width: 767px) {
        .card.shadow-lg { border-radius: 1.25rem !important; }
        .col-md-6.bg-white { border-radius: 0 0 1.25rem 1.25rem !important; }
        .col-lg-8, .col-md-10 { padding-left: 0; padding-right: 0; }
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 