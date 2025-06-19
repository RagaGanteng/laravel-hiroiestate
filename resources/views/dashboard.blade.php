@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
  <!-- Sidebar -->
  

  <!-- Main Content -->
  <div class="flex-1 p-6">
    <!-- Topbar -->
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Dashboard</h1>
    </div>

    <!-- Welcome Message -->
    <div class="mt-8 mb-8 bg-white p-6 rounded-xl shadow-md">
      <h2 class="text-xl font-semibold mb-2">Welcome to HiroiEstate!</h2>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
      <div class="bg-white shadow-md p-4 rounded-xl">
        <p class="text-gray-600">Property Types</p>
        <p class="text-3xl font-bold">{{ $propertyCount }}</p>
      </div>
      <div class="bg-white shadow-md p-4 rounded-xl">
        <p class="text-gray-600">Facilities</p>
        <p class="text-3xl font-bold">{{ $facilityCount }}</p>
      </div>
      <div class="bg-white shadow-md p-4 rounded-xl">
        <p class="text-gray-600">Agents</p>
        <p class="text-3xl font-bold">{{ $agentCount }}</p>
      </div>
      <div class="bg-white shadow-md p-4 rounded-xl">
        <p class="text-gray-600">Transactions</p>
        <p class="text-3xl font-bold">{{ $transactionCount }}</p>
      </div>
    </div>

    {{-- Grafik Transaksi per Bulan --}}
    <div class="bg-white shadow rounded p-4 mb-8">
        <h2 class="text-lg font-semibold text-gray-600 mb-2">Transactions Per Month</h2>
        <canvas id="monthlyChart" height="50"></canvas>
    </div>

    {{-- Grafik Berdasarkan Status --}}
    <div class="bg-white shadow rounded p-4">
        <h2 class="text-lg font-semibold text-gray-600 mb-2">Transactions by Status</h2>
        <canvas id="statusChart" style="max-height: 300px; width: 100%;"></canvas>
    </div>
  </div>
</div>

<script>
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyLabels) !!},
            datasets: [{
                label: 'Transactions',
                data: {!! json_encode($monthlyData) !!},
                backgroundColor: '#14b8a6',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($statusCounts->keys()) !!},
            datasets: [{
                label: 'Total',
                data: {!! json_encode($statusCounts->values()) !!},
                backgroundColor: ['#22c55e', '#facc15', '#ef4444'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection
