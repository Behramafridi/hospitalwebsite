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
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Admin Registrations</h5>
                <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#adminFormModal">
                    <i class="bi bi-plus-circle"></i> Add New Admin
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Emp ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Emp Fname</th>
                                <th scope="col">CNIC</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Date of Birth</th>
                                <th scope="col">Email</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registers as $register)
                            <tr>
                                <td>{{ $register->emp_id }}</td>
                                <td>{{ $register->name }}</td>
                                <td>{{ $register->emp_fname }}</td>
                                <td>{{ $register->cnic }}</td>
                                <td>{{ $register->phone }}</td>
                                <td>{{ $register->date_of_birth }}</td>
                                <td>{{ $register->email }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('register.edit', $register->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('register.destroy', $register->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
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

<!-- Admin Registration Modal -->
<div class="modal fade" id="adminFormModal" tabindex="-1" aria-labelledby="adminFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="adminFormModalLabel">Register New Admin</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adminForm" method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="emp_id" class="form-label">Emp ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="emp_id" id="emp_id" placeholder="Enter emp id" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter full name" required>
                    </div>
                    <div class="mb-3">
                        <label for="emp_fname" class="form-label">Emp Fname <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="emp_fname" id="emp_fname" placeholder="Enter Emp Fname" required>
                    </div>
                    <div class="mb-3">
                        <label for="cnic" class="form-label">CNIC <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="cnic" id="cnic" placeholder="Enter CNIC" required>
                    </div>

                     <div class="mb-3">
                        <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number" >
                    </div>
                      <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" >
                    </div>
                      <div class="mb-3">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" >
                    </div>

                     <div class="mb-3">
                        <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Ente Address" >
                    </div>


                     <div class="mb-3">
                        <label for="signature" class="form-label">Signature Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="signature" id="signature" >
                    </div>
                    <div class="mb-3">
                        <label for="adminStatus" class="form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="adminStatus" name="active" value="1" checked>
                            <label class="form-check-label" for="adminStatus">
                                Active
                            </label>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" id="submit" class="btn btn-primary">Register Admin</button>
            </div>
            </form>
        </div>
    </div>
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
