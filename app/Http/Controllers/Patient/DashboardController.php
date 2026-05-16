<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('patient');
    }

    public function index()
    {
        try {
            $userEmail = auth()->user()->email;
            $registrations = \App\Models\PatientRegistration::where('registeremail', $userEmail)
                ->orWhere('email', $userEmail)
                ->get();
            $doctors = \App\Models\User::where('role', 'doctor')->get();

            // Sample data for the dashboard
            $stats = [
                'upcoming_appointments' => 2,
                'medical_records' => 5,
                'prescriptions' => 3,
            ];

            // Ensure all required data is available
            $data = [
                'registrations' => $registrations,
                'doctors' => $doctors,
                'stats' => $stats,
                'upcomingAppointments' => [],
                'recentRecords' => []
            ];

            return view('admins.patient.dashboard', $data);

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error in Patient Dashboard: ' . $e->getMessage());
            
            // Return view with safe defaults if there's an error
            return view('admins.patient.dashboard', [
                'registrations' => collect(),
                'doctors' => collect(),
                'stats' => [
                    'upcoming_appointments' => 0,
                    'medical_records' => 0,
                    'prescriptions' => 0,
                ],
                'upcomingAppointments' => [],
                'recentRecords' => []
            ]);
        }
    }
}
