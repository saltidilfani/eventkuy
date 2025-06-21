@extends('layouts.public')
@section('title', 'Login Akun')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center text-white" style="background-image: linear-gradient(to top right, #FF8008, #FFC837);">
                        <div class="text-center p-5">
                            <i class="fas fa-rocket fa-4x mb-4"></i>
                            <h2 class="h1">Event PNP</h2>
                            <p>Satu platform untuk semua event dan kegiatan di lingkungan Politeknik Negeri Padang.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold">Selamat Datang!</h3>
                                <p class="text-muted">Login untuk melanjutkan.</p>
                            </div>
                            @if($errors->any())<div class="alert alert-danger py-2 small">Email atau password salah.</div>@endif
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                    <label for="email">Alamat Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                </div>
                                <div class="d-grid"><button type="submit" class="btn btn-oren btn-lg">Login</button></div>
                            </form>
                            <div class="text-center mt-4"><p class="small">Belum punya akun? <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color:var(--oren-pnp);">Buat akun baru</a></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 