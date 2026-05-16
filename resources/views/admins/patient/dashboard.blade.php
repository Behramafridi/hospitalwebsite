@extends('admins.layout2.app')

@section('title', 'Patient Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome back, {{ Auth::user()->name }}!</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      
    </div>
</div>



<div class="row">
 
    
 
</div>

@push('styles')
<style>
.progress {
    background-color: #e9ecef;
    border-radius: 4px;
    overflow: hidden;
}

.progress-bar {
    transition: width 0.6s ease;
}

.list-group-item {
    border-left: 0;
    border-right: 0;
    padding: 1rem 1.25rem;
}

.list-group-item:first-child {
    border-top: 0;
}

.list-group-item:last-child {
    border-bottom: 0;
}

.card {
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.5rem;
    overflow: hidden;
    margin-bottom: 1.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    padding: 1rem 1.25rem;
}

.card-title {
    margin-bottom: 0;
    color: #333;
    font-weight: 600;
}

.btn-outline-primary {
    color: #0d6efd;
    border-color: #0d6efd;
}

.btn-outline-primary:hover {
    background-color: #0d6efd;
    color: white;
}

.badge {
    font-weight: 500;
    padding: 0.35em 0.65em;
}
</style>
@endpush


<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-list-task me-2"></i>My Registrations</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                                    <th>ID</th>
                                    <th>Appointment Detail</th>
                                    <th>Delivery Details</th>
                                    <th>Patient Detail</th>
                                    <th>Payment Detail</th>
                                    <th>Status</th>
                                    <th>Assign Doctor</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                    </thead>
                    <tbody>
                                @foreach($registrations as $registration)
                                <tr>
                                      <td>
                                       {{ $registration->id }}
                                    </td>
                                    <td>
                                        {{ $registration->appointmentType }} <br>{{ \Carbon\Carbon::parse($registration->appointmentDate)->format('j-F-Y') }}  {{ $registration->timeSlot }}
                                    </td>
                                   
                                  <td>
                                        {{ $registration->appointmentType }} <br>{{ \Carbon\Carbon::parse($registration->appointmentDate)->format('j-F-Y') }}  {{ $registration->timeSlot }}
                                    </td>
                                   <td>
                                        {{ $registration->patient_first_name }} {{ $registration->patient_last_name }}

                                        <br>
                                        {{ $registration->mobile }}
                                        <br>
                                        {{ $registration->registeremail }}
                                    </td>
                                  
                                    <td>
                                        payment
                                  </td>

                                   <td>
                                        @if($registration->doctor)
                                            <span class="badge bg-success">Done</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Waiting</span>
                                        @endif
                                  </td>

                                    <td>
                                        @if($registration->doctor)
                                            <span class="badge bg-success text-white p-2">
                                                <i class="bi bi-person-check me-1"></i> {{ $registration->doctor->name }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary text-white p-2">
                                                <i class="bi bi-person-dash me-1"></i> Not Assigned
                                            </span>
                                        @endif
                                  </td>
                                    <td>
                                        @if($registration->image)
                                            <a href="{{ asset('storage/' . $registration->image) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $registration->image) }}" alt="Symptoms" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                            </a>
                                        @else
                                            <span class="text-muted small">No Photo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('patient.registration.show', $registration->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
});
</script>
@endpush
@endsection
