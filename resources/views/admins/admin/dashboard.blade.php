@extends('admins.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Admin Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <i class="bi bi-calendar"></i> This week
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-1">Total Users</h6>
                        <h2 class="mb-0">{{ $stats['total_users'] ?? 0 }}</h2>
                    </div>
                    <i class="bi bi-people fs-1 opacity-50"></i>
                </div>
                <div class="mt-3">
                    <span class="badge bg-white text-primary">+{{ $stats['new_users'] ?? 0 }} this month</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-1">Total Doctors</h6>
                        <h2 class="mb-0">{{ $stats['total_doctors'] ?? 0 }}</h2>
                    </div>
                    <i class="bi bi-activity fs-1 opacity-50"></i>
                </div>
                <div class="mt-3">
                    <span class="badge bg-white text-success">{{ $stats['available_doctors'] ?? 0 }} available</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase mb-1">Appointments</h6>
                        <h2 class="mb-0">{{ $stats['total_appointments'] ?? 0 }}</h2>
                    </div>

                     <div>
                        <h6 class="card-title text-uppercase mb-1">Appointments</h6>
                        <h2 class="mb-0">{{ $stats['total_appointments'] ?? 0 }}</h2>
                    </div>

                    
                    <i class="bi bi-calendar-check fs-1 opacity-50"></i>
                </div>
                <div class="mt-3">
                    <span class="badge bg-white text-info">{{ $stats['today_appointments'] ?? 0 }} today</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
  
    
  
</div>


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sample data - replace with actual data from your controller
    const ctx = document.getElementById('statsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Appointments',
                data: [12, 19, 3, 5, 2, 3, 10],
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }, {
                label: 'New Users',
                data: [5, 10, 8, 12, 6, 8, 15],
                borderColor: 'rgb(54, 162, 235)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Monthly Statistics'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endpush
@endsection
