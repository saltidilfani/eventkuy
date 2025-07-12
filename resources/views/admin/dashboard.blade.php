@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold text-dark mb-2">Dashboard</h2>
        <p class="text-muted mb-0">Selamat datang kembali, {{ Auth::user()->name }}! Berikut ringkasan aktivitas terbaru.</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-5">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-muted fw-semibold text-uppercase mb-1" style="font-size: 0.8rem;">Total Events</div>
                        <div class="h3 fw-bold text-dark mb-0">{{ $totalEvents }}</div>
                        <div class="text-success small mt-1">
                            <i class="fas fa-arrow-up me-1"></i>12% dari bulan lalu
                        </div>
                    </div>
                    <div class="stats-icon ms-3" style="background: linear-gradient(135deg, #FF6B08, #E66007);">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-muted fw-semibold text-uppercase mb-1" style="font-size: 0.8rem;">Total Users</div>
                        <div class="h3 fw-bold text-dark mb-0">{{ $totalUsers }}</div>
                    </div>
                    <div class="stats-icon ms-3" style="background: linear-gradient(135deg, #FF6B08, #E66007);">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-muted fw-semibold text-uppercase mb-1" style="font-size: 0.8rem;">Total Pendaftaran</div>
                        <div class="h3 fw-bold text-dark mb-0">{{ $totalRegistrations }}</div>
                    </div>
                    <div class="stats-icon ms-3" style="background: linear-gradient(135deg, #FF6B08, #E66007);">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="text-muted fw-semibold text-uppercase mb-1" style="font-size: 0.8rem;">Event Akan Datang</div>
                        <div class="h3 fw-bold text-dark mb-0">{{ $recentEvents->count() }}</div>
                    </div>
                    <div class="stats-icon ms-3" style="background: linear-gradient(135deg, #FF6B08, #E66007);">
                        <i class="fas fa-clock"></i>
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
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background:var(--primary-light)">
                <h6 class="m-0 fw-bold" style="color:var(--primary-color)">Distribusi Event per Kategori</h6>
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
            <div class="card-header py-3" style="background:var(--primary-light)">
                <h6 class="m-0 fw-bold" style="color:var(--primary-color)">Event Terbaru</h6>
            </div>
            <div class="card-body">
                <table class="table table-hover mb-4">
                    @forelse($recentEvents as $event)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div class="stats-icon" style="background: linear-gradient(135deg, #FF6B08, #E66007); width: 45px; height: 45px;">
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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-muted p-4">Belum ada event terbaru.</td>
                        </tr>
                    @endforelse
                </table>
                <div class="text-center mt-3">
                    <a href="{{ route('admin.events.index') }}" class="small text-primary">Lihat Semua Event &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</div>

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
                    backgroundColor: [
                        '#FF6B08', '#E66007', '#f6c23e', '#36b9cc', '#e74a3b', '#858796', '#5a5c69', '#f8f9fc'
                    ],
                    hoverBackgroundColor: [
                        '#E66007', '#FF6B08', '#dda20a', '#2c9faf', '#be2617', '#60616f', '#37383e', '#d4d5d8'
                    ],
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
                        callbacks: {
                            label: function(context) {
                                // Ambil label dan value
                                var label = context.label || '';
                                var value = context.parsed || 0;
                                var total = context.chart._metasets[context.datasetIndex].total || 1;
                                var percent = ((value / total) * 100).toFixed(1) + '%';
                                // Tampilkan label dan value dengan span warna hitam
                                return label + ': ' + '%c' + percent;
                            },
                            labelTextColor: function(context) {
                                // Hanya value (presentase) yang hitam
                                return '#000';
                            }
                        },
                        // Custom rendering agar value (presentase) hitam
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                var value = context.parsed || 0;
                                var total = context.dataset.data.reduce((a, b) => a + b, 0);
                                var percent = ((value / total) * 100).toFixed(1) + '%';
                                return label + ': ' + percent;
                            },
                            labelTextColor: function(context) {
                                return '#000';
                            }
                        }
                    },
                },
                cutout: '80%',
            },
        });
    });
</script>
@endpush

@endsection 