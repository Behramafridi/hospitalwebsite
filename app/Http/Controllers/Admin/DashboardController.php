<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Sample data for the dashboard
        $stats = [
            'total_users' => 125,
            'new_users' => 12,
            'total_doctors' => 8,
            'available_doctors' => 6,
            'total_appointments' => 342,
            'today_appointments' => 15,
        ];

        // Sample recent appointments
        $recentAppointments = [
            (object)[
                'id' => 1,
                'patient_name' => 'John Smith',
                'doctor_name' => 'Dr. Sarah Johnson',
                'appointment_date' => now(),
                'status' => 'scheduled'
            ],
            // Add more sample data as needed
        ];

        // Sample recent users
        $recentUsers = [
            (object)[
                'name' => 'New User',
                'role' => 'patient',
                'created_at' => now()->subDays(1)
            ],
            // Add more sample data as needed
        ];

        return view('admins.admin.dashboard', compact('stats', 'recentAppointments', 'recentUsers'));
    }
}
