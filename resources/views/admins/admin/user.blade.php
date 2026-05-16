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
        <form action="{{ route('users.store') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-3">
                <label class="form-label">Register Name</label>
                <select name="register_id" class="form-select">
                    <option value="">Select Register</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name  }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Register Address</label>
                <select name="address_id" class="form-select">
                    <option value="">Select Address</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->address }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label"> Register Phone</label>
                <select name="phone_id" class="form-select">
                    <option value="">Select Phone</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->phone }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Register Signature</label>
                <select name="signature_id" class="form-select">
                    <option value="">Select Signature</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->signature }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Patient Registration (ID & Email)</label>
                <select name="appoinment_id" class="form-select">
                    <option value="">Select Appointment</option>
                    @foreach($appoinments as $appoinment)
                        <option value="{{ $appoinment->id }}">ID: {{ $appoinment->id }} - {{ $appoinment->registeremail }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter name" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email" required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="">Select</option>
                    <option value="admin">Admin</option>
                    <option value="patient">Patient</option>
                    <option value="doctor">Doctor</option>

                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="******" required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="******" required>
            </div>

            <div class="col-12 text-end">
                <button class="btn btn-success px-4">Add User</button>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-people me-2"></i>Users List
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Register Name</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($users) && $users->count() > 0)
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->register->name ?? 'N/A' }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'doctor' ? 'success' : 'info') }}">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this user?')"
                                                        class="m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="bi bi-people fs-1 d-block mb-2"></i>
                                            No users found. Add users using the form above.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Registration Modal -->





    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
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