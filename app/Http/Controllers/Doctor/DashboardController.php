<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->middleware('doctor');
    }

    /**
     * Show the doctor dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $doctorRegisterId = Auth::user()->register_id;
        $assignedAppointments = \App\Models\Doctor::where('register_id', $doctorRegisterId)->get();

        // Sample data for the dashboard
        $stats = [
            'today_appointments' => $assignedAppointments->count(),
            'total_patients' => $assignedAppointments->pluck('email')->unique()->count(),
            'available_slots' => 8,
            'weekly_appointments' => 15,
            'satisfaction_rate' => 92,
            'total_slots' => 20,
        ];

        return view('admins.doctor.dashboard', compact('stats', 'assignedAppointments'));
    }

    /**
     * Show the appointment details for the doctor.
     */
    public function show($id)
    {
        $registration = \App\Models\Doctor::with([
            'doctor.phoneRegister',
            'doctor.addressRegister',
            'doctor.signatureRegister',
            'doctorCertificates',
            'adminCertificates'
        ])->findOrFail($id);
        $doctors = \App\Models\User::where('role', 'doctor')->get();

        $history = \App\Models\Doctor::where('registeremail', $registration->registeremail)
            ->orderBy('appointmentDate', 'desc')
            ->get();

        return view('admins.admin.AppointmentdoctorShow', compact('registration', 'doctors', 'history'));
    }
}
