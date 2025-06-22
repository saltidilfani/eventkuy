@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="text-dark">Dashboard</h2>
        <p class="text-muted">Selamat datang kembali, {{ Auth::user()->name }}! Berikut ringkasan aktivitas terbaru.</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-start border-primary border-4 h-100 shadow-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Events</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalEvents }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-start border-success border-4 h-100 shadow-sm">
             <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs fw-bold text-success text-uppercase mb-1">Total Users</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalUsers }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-start border-warning border-4 h-100 shadow-sm">
             <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs fw-bold text-warning text-uppercase mb-1">Total Pendaftaran</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalRegistrations }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-start border-info border-4 h-100 shadow-sm">
             <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs fw-bold text-info text-uppercase mb-1">Event Akan Datang</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $recentEvents->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart and Recent Events -->
<div class="row">
    <!-- Chart -->
    <div class="col-xl-7 col-lg-7">
        <div class="card shadow-sm mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 fw-bold" style="color:var(--primary-admin)">Distribusi Event per Kategori</h6>
            </div>
            <div class="card-body">
                <div class="chart-area" style="height: 350px;">
                    <canvas id="categoryDistributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Events Table -->
    <div class="col-xl-5 col-lg-5">
        <div class="card shadow-sm mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 fw-bold" style="color:var(--primary-admin)">Event Terbaru</h6>
            </div>
            <div class="card-body">
                @forelse($recentEvents as $event)
                    <div class="d-flex align-items-center {{ !$loop->last ? 'border-bottom pb-3 mb-3' : '' }}">
                        <div class="me-3">
                            <div class="bg-primary-admin text-white d-flex align-items-center justify-content-center rounded-circle" style="width: 45px; height: 45px; background:var(--primary-admin)">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="text-decoration-none text-dark fw-bold">{{ Str::limit($event->title, 30) }}</a>
                            <div class="text-muted small">
                                {{ $event->event_date->format('d M Y') }} - <span class="badge bg-light text-dark">{{ $event->category->name }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted p-4">Belum ada event terbaru.</div>
                @endforelse
                 <div class="text-center mt-3">
                    <a href="{{ route('admin.events.index') }}" class="small">Lihat Semua Event &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.text-xs {
    font-size: .8rem;
}
.text-gray-300 {
    color: #dddfeb !important;
}
.border-start {
    border-left-width: 4px !important;
}
</style>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Doughnut Chart
        var ctx = document.getElementById("categoryDistributionChart").getContext('2d');
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($categoryLabels),
                datasets: [{
                    data: @json($categoryData),
                    backgroundColor: ['#4a69bd', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69', '#f8f9fc'],
                    hoverBackgroundColor: ['#3c5aa6', '#17a673', '#2c9faf', '#dda20a', '#be2617', '#60616f', '#37383e', '#d4d5d8'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                family: 'Poppins'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                },
                cutout: '80%',
            },
        });
    });
</script>
@endpush 