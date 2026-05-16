<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.index');
    }

    public function appointment()
    {
        return view('frontend.appointment_wizard');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function service()
    {
        return view('frontend.Services');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function corporate()
    {
        return view('frontend.corporate');
    }

    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $user = \Illuminate\Support\Facades\Auth::user();
        
        // If the user is logged in and checking their own email, it's NOT a "duplicate register" error
        if ($user && $user->email === $email) {
            return response()->json(['exists' => false]);
        }
        
        $exists = User::where('email', $email)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function loginWizard(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 1. Try standard Laravel authentication
        if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json([
                'success' => true,
                'redirect' => route('home'),
                'new_csrf_token' => csrf_token()
            ]);
        }

        // 2. SELF-HEALING LOGIC
        // If Auth fails, check PatientRegistration table for legacy plain-text password match
        $patient = \App\Models\PatientRegistration::where('registeremail', $request->email)
            ->where('registerpassword', $request->password)
            ->first();

        if ($patient) {
            // Match found in patient records! 
            // Create/Update the User account with a properly hashed password
            $user = \App\Models\User::updateOrCreate(
                ['email' => $request->email],
                [
                    'name' => $patient->full_name ?? $patient->patient_first_name ?? 'Patient',
                    'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                    'role' => 'patient',
                    'appoinment_id' => $patient->id
                ]
            );

            // Log the user in manually
            \Illuminate\Support\Facades\Auth::login($user);
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'redirect' => route('home'),
                'new_csrf_token' => csrf_token()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'The provided credentials do not match our records.'
        ]);
    }
}
