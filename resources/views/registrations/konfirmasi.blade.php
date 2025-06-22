@extends('layouts.navbar')
@section('title', 'Konfirmasi Pendaftaran: ' . $event->title)

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Konfirmasi Pendaftaran</h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="alert alert-info">
                        Harap periksa kembali detail pendaftaran Anda untuk event <strong>{{ $event->title }}</strong> sebelum mengonfirmasi.
                    </div>
                    
                    <hr>

                    <dl class="row">
                        <dt class="col-sm-4">Nama Peserta</dt>
                        <dd class="col-sm-8">{{ auth()->user()->name }}</dd>

                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">{{ auth()->user()->email }}</dd>

                        <dt class="col-sm-4">Nomor Telepon/WA</dt>
                        <dd class="col-sm-8">{{ $registrationData['phone'] }}</dd>
                        
                        @if(!empty($registrationData['institution']))
                        <dt class="col-sm-4">Asal Institusi/Jurusan</dt>
                        <dd class="col-sm-8">{{ $registrationData['institution'] }}</dd>
                        @endif

                        @if(!empty($registrationData['notes']))
                        <dt class="col-sm-4">Catatan Tambahan</dt>
                        <dd class="col-sm-8"><i>"{{ $registrationData['notes'] }}"</i></dd>
                        @endif
                    </dl>
                    
                    <hr>

                    <form action="{{ route('events.register.confirm.store', $event->id) }}" method="POST">
                        @csrf
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                             <a href="{{ route('events.register', $event->id) }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i> Kembali & Edit
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-check-circle me-2"></i> Konfirmasi & Daftar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 