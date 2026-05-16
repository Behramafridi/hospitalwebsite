@extends('admins.layout1.app')

@section('title', 'Doctor Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Doctor Dashboard</h1>
  
</div>



<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Assigned Appointments</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
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
                            @foreach($assignedAppointments as $appointment)
                            <tr>
                              <td> {{ $appointment->id }} </td>  
                              <td> {{ $appointment->appointmentType }} <br> {{ $appointment->appointmentDate }} {{ $appointment->timeSlot }} </td>  
                              <td> {{ $appointment->appointmentType }} <br> {{ $appointment->appointmentDate }} {{ $appointment->timeSlot }} </td>  
                              <td> {{ $appointment->patient_first_name }} {{ $appointment->patient_last_name }}  
                                <br> {{ $appointment->mobile }} <br> {{ $appointment->registeremail }} 
                              </td>  
                              <td> payment </td>  
                              <td> status </td>  
                              <td>doctor</td>
                              <td> image </td>  
                              <td>
                                  <a href="{{ route('doctor.registration.show', $appointment->id) }}" class="btn btn-sm btn-info text-white">
                                      <i class="bi bi-eye"></i> View
                                  </a>
                              </td>  
                              
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($assignedAppointments->isEmpty())
                        <div class="text-center py-4">
                            <p class="text-muted">No appointments assigned to you yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
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

table {
    font-size: 0.875rem;
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

.bg-primary {
    background-color: #0d6efd !important;
}

.text-primary {
    color: #0d6efd !important;
}
</style>
@endpush

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
