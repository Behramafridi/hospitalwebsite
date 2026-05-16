@extends('admins.layouts.app')

@push('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<style>
    .dt-buttons {
        margin-bottom: 15px;
        gap: 5px;
    }
    .dt-button {
        border-radius: 4px !important;
        padding: 5px 12px !important;
        font-size: 13px !important;
        display: inline-flex !important;
        align-items: center !important;
    }
</style>
@endpush

@section('title', 'Admin Dashboard')

@section('content')


@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form action="{{ route('admin.assign.doctor') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Appointment Table</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="appointmentTable" class="table table-striped table-hover table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Appointment Detail</th>
                                    <th>Delivery Details</th>
                                    <th>Patient Detail</th>
                                    <th>Payment Detail</th>
                                    <th>Status</th>
                                    <th>Assign Doctor</th>
                                   
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
    </div>
</form>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#appointmentTable').DataTable({
        dom: '<"d-flex justify-content-between align-items-center mb-3"Bf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
        buttons: [
            {
                extend: 'copyHtml5',
                className: 'btn btn-secondary btn-sm',
                text: '<i class="bi bi-clipboard me-1"></i> Copy'
            },
            {
                extend: 'excelHtml5',
                className: 'btn btn-success btn-sm',
                text: '<i class="bi bi-file-earmark-excel me-1"></i> Excel'
            },
            {
                extend: 'csvHtml5',
                className: 'btn btn-info btn-sm text-white',
                text: '<i class="bi bi-file-earmark-text me-1"></i> CSV'
            },
            {
                extend: 'pdfHtml5',
                className: 'btn btn-danger btn-sm',
                text: '<i class="bi bi-file-earmark-pdf me-1"></i> PDF'
            }
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records..."
        }
    });
});
</script>
@endpush
@endsection
