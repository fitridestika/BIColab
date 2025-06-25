@extends('layouts.index')

@section('title', 'Healthcare BI Dashboard')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Dashboard Kehadiran Dokter</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">Statistik Kehadiran</div>
    </div>
  </div>

  <!-- Statistik Hari Ini -->
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-user-md"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header"><h4>Dokter Hadir</h4></div>
          <div class="card-body">{{ $hadir ?? 0 }}</div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fas fa-calendar-minus"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header"><h4>Cuti</h4></div>
          <div class="card-body">{{ $cuti ?? 0 }}</div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="fas fa-user-slash"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header"><h4>Tidak Hadir</h4></div>
          <div class="card-body">{{ $tidakHadir ?? 0 }}</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Grafik & Pie Chart -->
  <div class="row">
    <!-- Grafik Kehadiran -->
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4>Grafik Kehadiran Dokter</h4>
          <form method="GET" action="{{ route('dashboard_des') }}">
            <div class="form-group mb-0">
              <select class="form-control form-control-sm" name="periode" onchange="this.form.submit()">
                <option value="today" {{ request('periode') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                <option value="yesterday" {{ request('periode') == 'yesterday' ? 'selected' : '' }}>Kemarin</option>
                <option value="7days" {{ request('periode') == '7days' || request('periode') == null ? 'selected' : '' }}>7 Hari Terakhir</option>
              </select>
            </div>
          </form>
        </div>
        <div class="card-body">
          <canvas id="chartKehadiran" height="350" style="min-width: 800px"></canvas>
        </div>
      </div>
    </div>

    <!-- Pie Chart Kehadiran Hari Ini -->
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <h4>Distribusi Kehadiran</h4>
        </div>
        <div class="card-body">
          <canvas id="pieKehadiran" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<!-- Chart.js & Plugin Persentase -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Line Chart
    const ctx = document.getElementById('chartKehadiran').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: @json($labels),
        datasets: [
          {
            label: 'Hadir',
            data: @json($hadirPerHari),
            borderColor: '#36A2EB',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderWidth: 2,
            fill: true
          },
          {
            label: 'Cuti',
            data: @json($cutiPerHari),
            borderColor: '#FFCE56',
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            borderWidth: 2,
            fill: true
          },
          {
            label: 'Tidak Hadir',
            data: @json($tidakHadirPerHari),
            borderColor: '#FF6384',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderWidth: 2,
            fill: true
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            max: 10,
            ticks: {
              stepSize: 1,
              precision: 0
            }
          }
        }
      }
    });

    // Pie Chart dengan Persentase
    const pieCtx = document.getElementById('pieKehadiran').getContext('2d');
    new Chart(pieCtx, {
      type: 'pie',
      data: {
        labels: ['Hadir', 'Cuti', 'Tidak Hadir'],
        datasets: [{
          data: [{{ $hadir ?? 0 }}, {{ $cuti ?? 0 }}, {{ $tidakHadir ?? 0 }}],
          backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384'],
          borderColor: ['#fff', '#fff', '#fff'],
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom'
          },
          datalabels: {
            color: '#fff',
            formatter: (value, context) => {
              const data = context.chart.data.datasets[0].data;
              const total = data.reduce((acc, val) => acc + val, 0);
              const percentage = total ? ((value / total) * 100).toFixed(1) : 0;
              return percentage + '%';
            },
            font: {
              weight: 'bold',
              size: 14
            }
          }
        }
      },
      plugins: [ChartDataLabels]
    });
  });
</script>
@endpush
