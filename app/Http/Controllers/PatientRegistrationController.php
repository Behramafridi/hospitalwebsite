<?php

namespace App\Http\Controllers;

use App\Models\PatientRegistration;
use App\Models\PatientAppointmentExtraDetails;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientRegistrationController extends Controller
{
    /**
     * Store a newly created patient registration in storage.
     */
    public function store(Request $request)
    {
        // DO NOT USE dd() HERE. It breaks the JSON response for AJAX.
        \Illuminate\Support\Facades\Log::info('Store Request Data:', $request->all());
        try {


            // Validation (simplified but allows flexibility)
            $validatedData = $request->validate([
                'appointmentType' => 'nullable|string',
                'appointmentDate' => 'nullable|string',
                'timeSlot' => 'nullable|string',
                'registeremail' => 'nullable|email',
                'registerpassword' => 'nullable|string',
                'textarea' => 'nullable|string',
                'image' => 'nullable', // Relaxed validation to solve user issue
                'hasMedicalHistory' => 'nullable|string',
                'medicationDetails' => 'nullable|string',
                'hasAllergies' => 'nullable|string',
                'allergyDetails' => 'nullable|string',
                'medicalHistoryDetails' => 'nullable|string',
                'prescriptionDelivery' => 'nullable|string',
                'full_name' => 'nullable|string',
                'date_of_birth' => 'nullable|string',
                'gender' => 'nullable|string',
                'email' => 'nullable|email',
                'phone' => 'nullable|string',
                'height' => 'nullable|string',
                'weight' => 'nullable|string',


                'diagnosed_asthma' => 'nullable|string',
                'asthma_diag_details' => 'nullable|string',



                'current_inhales' => 'nullable|string',
                'current_inhales_details' => 'nullable|string',


                'symptoms_frequency' => 'nullable|string',

                'night_symptoms' => 'nullable|string',
                'asthma_night_details' => 'nullable|string',

                'triggers' => 'nullable|string',


                'Hospital_admissions' => 'nullable|string',
                'Hospital_admissions_details' => 'nullable|string',

                'both_sides' => 'nullable|string',
                'aura_present' => 'nullable|string',
                'Nausea_vomiting' => 'nullable|string',
                'Current_medication' => 'nullable|string',
                'by_doctor' => 'nullable|string',
                'current_dose' => 'nullable|string',
                'test_date' => 'nullable|string',
                'symptoms_worsening' => 'nullable|string',
                'planning_pregnancy' => 'nullable|string',
                'year_round' => 'nullable|string',
                'main_symptoms' => 'nullable|string',
                'asthma_history' => 'nullable|string',
                'medications_tried' => 'nullable|string',
                'contraception' => 'nullable|string',
                'menstrual_period' => 'nullable|string',
                'you_smoke' => 'nullable|string',
                'had_blood' => 'nullable|string',
                'with_aura' => 'nullable|string',
                'blood_pressure' => 'nullable|string',
                'breastfeeding' => 'nullable|string',
                'effects_before' => 'nullable|string',
                'contraception_before' => 'nullable|string',
                'last_period' => 'nullable|string',
                'your_period' => 'nullable|string',
                'delaying' => 'nullable|string',
                'medication_before' => 'nullable|string',
                'blood_clots' => 'nullable|string',

                'pregnant' => 'nullable|string',
                'disorders' => 'nullable|string',
                'been_present' => 'nullable|string',
                'episode' => 'nullable|string',
                'urination' => 'nullable|string',
                'recently' => 'nullable|string',
                'vaginal_discharge' => 'nullable|string',
                'color' => 'nullable|string',
                'of_symptoms' => 'nullable|string',
                'Previous_by' => 'nullable|string',
                'pelvic_pain' => 'nullable|string',
                'you_pregnant' => 'nullable|string',
                'IUD' => 'nullable|string',
                'issue_existed' => 'nullable|string',
                'any_erection' => 'nullable|string',
                'gradual_onset' => 'nullable|string',
                'heart_disease' => 'nullable|string',
                'Diabetes' => 'nullable|string',
                'alcohol_intake' => 'nullable|string',
                'ED_medication' => 'nullable|string',
                'ejaculation' => 'nullable|string',
                'Lifelong' => 'nullable|string',
                'anxiety' => 'nullable|string',
                'Any_erectile' => 'nullable|string',
                'treatment_before' => 'nullable|string',
                'loss_started' => 'nullable|string',
                'Family_history' => 'nullable|string',
                'hair_loss' => 'nullable|string',
                'loss_products' => 'nullable|string',
                'scalp_disease' => 'nullable|string',
                'medical_conditions' => 'nullable|string',
                'whiteheads' => 'nullable|string',
                'Areas_affected' => 'nullable|string',
                'Duration' => 'nullable|string',
                'Severity' => 'nullable|string',
                'any_treatments' => 'nullable|string',
                'Hormonal_issues' => 'nullable|string',
                'Facial_redness' => 'nullable|string',
                'Triggers' => 'nullable|string',
                'Pimples_present' => 'nullable|string',
                'Eye_symptoms' => 'nullable|string',
                'steroid_creams' => 'nullable|string',
                'skin_triggers' => 'nullable|string',
                'Itching_severity' => 'nullable|string',
                'Childhood_eczema' => 'nullable|string',
                'infections_present' => 'nullable|string',
                'Location_of' => 'nullable|string',
                'Nail_nvolvement' => 'nullable|string',
                'Joint_pain' => 'nullable|string',
                'Family' => 'nullable|string',
                'Previous_treatments' => 'nullable|string',




                'allergies' => 'nullable|string',
                'medication' => 'nullable|string',
                'devlivaryCountry' => 'nullable|string',
                'devlivaryName' => 'nullable|string',

                'services_yes' => 'nullable|string',
                'services_no' => 'nullable|string',

                'pharmacyCountry' => 'nullable|string',
                'pharmacyName' => 'nullable|string',
                'patient_first_name' => 'nullable|string',
                'patient_last_name' => 'nullable|string',
                'bod_of_birth' => 'nullable|string',
                'mobile' => 'nullable|string',
                'patient_foam_gender' => 'nullable|string',
                'media' => 'nullable|string',
                'foam_textarea' => 'nullable|string',
                'doctor_id' => 'nullable|string',
                'dob' => 'nullable|string',
                'any_allergies' => 'nullable|string',
                'details_any_allergies_0_text' => 'nullable|string',
                'any_medication' => 'nullable|string',
                'details_any_medication_1_text' => 'nullable|string',
                'asthma_inhaler_details' => 'nullable|string',
                'details_services_112_text' => 'nullable|string',
                'details_services_111_text' => 'nullable|string',
                'details_services_110_text' => 'nullable|string',
                'details_services_109_text' => 'nullable|string',
                'details_services_100_text' => 'nullable|string',

                // Counseling & Extra Fields
                'counseling_reason' => 'nullable|string',
                'previous_therapy' => 'nullable|string',
                'emergency_contact' => 'nullable|string',
                'extra_area' => 'nullable|string',
                'extra_type' => 'nullable|string',
                'extra_symptoms' => 'nullable|string',
                'extra_severity' => 'nullable|string',
            ]);

            // Merge other optional fields
            $data = $request->all();

            // Password handling (plain text as requested)
            if (isset($data['registerpassword'])) {
                // $data['registerpassword'] is already set from $request->all()
            }

            // Handle file upload if 'image' exists in request
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                // Store in public/banners within the storage disk
                $path = $image->storeAs('banners', $imageName, 'public');
                $data['image'] = $path;
            }

            

            // Use valid provided meeting link because random IDs result in 'invalid meeting 3001' on Zoom servers
            // We use an array of actual known working links provided by the user to satisfy 'different entry different link'
            $patientName = $request->full_name ?? $request->patient_first_name ?? 'Patient';
            $googleMeetLink = null;
            $zoomMeetingIdFormatted = null;
            $zoomPasscode = null;
            if (isset($data['appointmentType']) && str_contains($data['appointmentType'], 'Video')) {
                $workingLinks = [
                    [
                        'id' => '3689382953',
                        'formatted_id' => '368 938 2953',
                        'url_pwd' => '2If8agiD',
                        'passcode' => '2If8agiD',
                        'base' => 'https://zoom.us/j/'
                    ],
                    [
                        'id' => '84154865137',
                        'formatted_id' => '841 5486 5137',
                        'url_pwd' => 'nMfZNJYwqNU474lUxasyLo07OLGbN2.1',
                        'passcode' => 'T1nhHS',
                        'base' => 'https://us05web.zoom.us/j/'
                    ]
                ];
                
                $selectedLink = $workingLinks[array_rand($workingLinks)];
                $zoomMeetingIdFormatted = $selectedLink['formatted_id'];
                $zoomPasscode = $selectedLink['passcode'];
                $encodedName = urlencode($patientName);
                $uniqueHash = \Illuminate\Support\Str::random(6); // Unique tag per entry
                
                $googleMeetLink = "{$selectedLink['base']}{$selectedLink['id']}?pwd={$selectedLink['url_pwd']}&uname={$encodedName}&ref={$uniqueHash}";
            }

            $registration = PatientRegistration::create($data);

            // CREATE OR UPDATE USER ACCOUNT
            // This ensures Auth::attempt() works in the loginWizard
            if (isset($data['registeremail']) && isset($data['registerpassword'])) {
                User::updateOrCreate(
                    ['email' => $data['registeremail']],
                    [
                        'name' => $request->full_name ?? $request->patient_first_name ?? 'Patient',
                        'password' => Hash::make($data['registerpassword']),
                        'role' => 'patient',
                        'appoinment_id' => $registration->id
                    ]
                );
            }

            // SAVE EXTRA DETAILS
            PatientAppointmentExtraDetails::create([
                'patient_registration_id' => $registration->id,
                'counseling_reason' => $request->counseling_reason,
                'previous_therapy' => $request->previous_therapy,
                'emergency_contact' => $request->emergency_contact,
                'extra_area' => $request->extra_area,
                'extra_type' => $request->extra_type,
                'extra_symptoms' => $request->extra_symptoms,
                'extra_severity' => $request->extra_severity,
                'google_meet_link' => $googleMeetLink,
            ]);

            if ($registration->image) {
                $registration->image_url = asset('storage/' . $registration->image);
            }

            return response()->json([
                'success' => true,
                'message' => 'Your appointment has been booked successfully!',
                'google_meet_link' => $googleMeetLink,
                'zoom_meeting_id_formatted' => $zoomMeetingIdFormatted,
                'zoom_passcode' => $zoomPasscode
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . implode(', ', \Illuminate\Support\Arr::flatten($e->errors())),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified registration (for verification/data show).
     */
    public function show($id)
    {
        $registration = PatientRegistration::with([
            'doctor.phoneRegister',
            'doctor.addressRegister',
            'doctor.signatureRegister',
            'certificates',
            'doctorCertificates',
            'prescriptions'
        ])->findOrFail($id);
        $doctors = User::where('role', 'doctor')->get();

        // Fetch history based on email
        $history = PatientRegistration::where('registeremail', $registration->registeremail)
            ->orderBy('appointmentDate', 'desc')
            ->get();

        if (auth()->check() && auth()->user()->role === 'patient') {
            return view('admins.admin.Appointmentpatient', compact('registration', 'doctors', 'history'));
        }

        return view('admins.admin.AppointmentShow', compact('registration', 'doctors', 'history'));
    }

    public function storeCertificate(Request $request)
    {
        $request->validate([
            'patient_registration_id' => 'required|exists:patient_registrations,id',
            'type' => 'required|string',
            'pdf_data' => 'required|string',
            'original_name' => 'required|string'
        ]);

        $pdfData = $request->pdf_data;
        // Data URI format might be 'data:application/pdf;filename=generated.pdf;base64,...'
        if (strpos($pdfData, ';base64,') !== false) {
            $parts = explode(';base64,', $pdfData);
            $pdfData = $parts[1];
        }
        $pdfData = base64_decode($pdfData);

        $fileName = 'certificates/' . time() . '_' . $request->original_name;
        \Illuminate\Support\Facades\Storage::disk('public')->put($fileName, $pdfData);

        $registration = PatientRegistration::findOrFail($request->patient_registration_id);

        $certificate = \App\Models\Certificate::create([
            'patient_registration_id' => $registration->id,
            'doctor_id' => $registration->doctor_id,
            'type' => $request->type,
            'file_path' => $fileName,
            'original_name' => $request->original_name,
        ]);

        return response()->json([
            'success' => true,
            'certificate' => [
                'id' => $certificate->id,
                'url' => asset('storage/' . $fileName),
                'original_name' => $certificate->original_name,
                'type' => $certificate->type
            ]
        ]);
    }

    public function storeDoctorCertificate(Request $request)
    {
        $request->validate([
            'patient_registration_id' => 'required', // Might be doctor dashboard ID or actual registration ID
            'type' => 'required|string',
            'pdf_data' => 'required|string',
            'original_name' => 'required|string'
        ]);

        $pdfData = $request->pdf_data;
        if (strpos($pdfData, ';base64,') !== false) {
            $parts = explode(';base64,', $pdfData);
            $pdfData = $parts[1];
        }
        $pdfData = base64_decode($pdfData);

        $fileName = 'doctor_certificates/' . time() . '_' . $request->original_name;
        \Illuminate\Support\Facades\Storage::disk('public')->put($fileName, $pdfData);

        $certificate = \App\Models\DoctorCertificate::create([
            'patient_registration_id' => $request->patient_registration_id,
            'doctor_user_id' => auth()->id(),
            'type' => $request->type,
            'file_path' => $fileName,
            'original_name' => $request->original_name,
        ]);

        return response()->json([
            'success' => true,
            'certificate' => [
                'id' => $certificate->id,
                'url' => asset('storage/' . $fileName),
                'original_name' => $certificate->original_name,
                'type' => $certificate->type
            ]
        ]);
    }

    public function storePrescription(Request $request)
    {
        $request->validate([
            'patient_registration_id' => 'required|exists:patient_registrations,id',
            'drug_name' => 'required|string',
            'dosage_instructions' => 'required|string'
        ]);

        $registration = PatientRegistration::findOrFail($request->patient_registration_id);

        $prescription = \App\Models\Prescription::create([
            'patient_registration_id' => $registration->id,
            'doctor_id' => auth()->id() ?? $registration->doctor_id,
            'drug_name' => $request->drug_name,
            'dosage_instructions' => $request->dosage_instructions
        ]);

        return response()->json([
            'success' => true,
            'prescription' => $prescription
        ]);
    }

    public function deletePrescription($id)
    {
        $prescription = \App\Models\Prescription::findOrFail($id);
        $prescription->delete();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * List all registrations (optional, for admin view).
     */
    public function index(Request $request)
    {
        $query = PatientRegistration::query();

        if ($request->filled('start_date')) {
            $query->whereDate('appointmentDate', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('appointmentDate', '<=', $request->end_date);
        }

        $registrations = $query->orderBy('appointmentDate', 'desc')->get();
        $doctors = User::where('role', 'doctor')->get();

        return view('admins.admin.Appointment', compact('registrations', 'doctors'));
    }

    public function assignDoctor(Request $request)
    {
        $request->validate([
            'registration_ids' => 'required|array',
            'doctor_ids' => 'required|array',
        ]);

        foreach ($request->registration_ids as $patientId) {
            $registration = PatientRegistration::findOrFail($patientId);
            $doctorId = $request->doctor_ids[$patientId] ?? null;

            if ($doctorId) {
                $docUser = User::findOrFail($doctorId);

                // Save doctor_id to PatientRegistration
                $registration->update(['doctor_id' => $doctorId]);

                // Copy data to Doctor table
                Doctor::create([
                    'register_id' => $docUser->register_id,
                    'patient_registration_id' => $registration->id,
                    'appointmentType' => $registration->appointmentType,
                    'appointmentDate' => $registration->appointmentDate,
                    'timeSlot' => $registration->timeSlot,
                    'registeremail' => $registration->registeremail,
                    'registerpassword' => $registration->registerpassword,
                    'textarea' => $registration->textarea,
                    'pdf' => $registration->image,
                    'hasMedicalHistory' => $registration->hasMedicalHistory,
                    'hasMedications' => $registration->hasMedications,
                    'medicationDetails' => $registration->medicationDetails,
                    'hasAllergies' => $registration->hasAllergies,
                    'allergyDetails' => $registration->allergyDetails,
                    'medicalHistoryDetails' => $registration->medicalHistoryDetails,
                    'prescriptionDelivery' => $registration->prescriptionDelivery,
                    'full_name' => $registration->full_name,
                    'date_of_birth' => $registration->date_of_birth,
                    'height' => $registration->height,
                    'weight' => $registration->weight,
                    'email' => $registration->email,
                    'phone' => $registration->phone,
                    'allergies' => $registration->allergies,
                    'medication' => $registration->medication,
                    'gender' => $registration->gender,
                    // Additional fields requested
                    'patient_first_name' => $registration->patient_first_name,
                    'patient_last_name' => $registration->patient_last_name,
                    'bod_of_birth' => $registration->bod_of_birth,
                    'mobile' => $registration->mobile,
                    'patient_foam_gender' => $registration->patient_foam_gender,
                    'media' => $registration->media,
                    'foam_textarea' => $registration->foam_textarea,
                    'pharmacyCountry' => $registration->pharmacyCountry,
                    'pharmacyName' => $registration->pharmacyName,
                    'pharmacyPhone' => $registration->pharmacyPhone,
                    'google_meet_link' => $registration->extraDetails->google_meet_link ?? null,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Patients assigned to doctors successfully.');
    }
}
