<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRegistration extends Model
{
    /** @use HasFactory<\Database\Factories\PatientRegistrationFactory> */
    use HasFactory;

    protected $fillable = [
        'appointmentType',
        'appointmentDate',
        'timeSlot',
        'registeremail',
        'registerpassword',
        'textarea',
        'image',
        'hasMedicalHistory',
        'medicationDetails',
        'hasAllergies',
        'hasMedications',
        'allergyDetails',
        'medicalHistoryDetails',
        'prescriptionDelivery',
        'full_name',
        'date_of_birth',
        'height',
        'weight',
        'email',
        'phone',
        'allergies',
        'medication',
        'gender',
        'pharmacyCountry',
        'pharmacyName',
        'pharmacyPhone',
        'patient_first_name',
        'patient_last_name',
        'bod_of_birth',
        'mobile',
        'patient_foam_gender',
        'media',
        'foam_textarea',
        'doctor_id',
        'devlivaryCountry',
        'devlivaryName',
        'diagnosed_asthma',
        'asthma_diag_details',
        'current_inhales',
        'current_inhales_details',
        'night_symptoms',
        'asthma_night_details',
        'Hospital_admissions',
        'Hospital_admissions_details',
        'symptoms_frequency',
        'triggers',
        'both_sides',
        'aura_present',
        'Nausea_vomiting',
        'Current_medication',
        'by_doctor',
        'current_dose',
        'test_date',
        'symptoms_worsening',
        'planning_pregnancy',
        'year_round',
        'main_symptoms',
        'asthma_history',
        'medications_tried',
        'eye_symptoms',
        'contraception',
        'contraception_before',
        'menstrual_period',
        'you_smoke',
        'had_blood',
        'with_aura',
        'blood_pressure',
        'breastfeeding',
        'effects_before',
        'last_period',
        'your_period',
        'delaying',
        'medication_before',
        'blood_clots',
        'pregnant',
        'disorders',
        'experiencing',
        'discharge',
        'been_present',
        'episode',
        'urination',
        'recently',
        'vaginal_discharge',
        'color',
        'of_symptoms',
        'Previous_by',
        'pelvic_pain',
        'you_pregnant',
        'IUD',
        'issue_existed',
        'any_erection',
        'gradual_onset',
        'heart_disease',
        'Diabetes',
        'alcohol_intake',
        'ED_medication',
        'ejaculation',
        'Lifelong',
        'anxiety',
        'Any_erectile',
        'treatment_before',
        'loss_started',
        'Family_history',
        'hair_loss',
        'loss_products',
        'scalp_disease',
        'whiteheads',
        'Areas_affected',
        'Duration',
        'Severity',
        'any_treatments',
        'Hormonal_issues',
        'Facial_redness',
        'skin_triggers',
        'Pimples_present',
        'steroid_creams',
        'Itching_severity',
        'Childhood_eczema',
        'infections_present',
        'Location_of',
        'Nail_nvolvement',
        'Joint_pain',
        'Family',
        'Previous_treatments',
        'medical_conditions',
        'services_before',
        'services_yes',
        'services_no',
        'area',
        'type',
        'symptoms',
        'severity',
        'dob',
        'any_allergies',
        'details_any_allergies_0_text',
        'any_medication',
        'details_any_medication_1_text',
        'asthma_inhaler_details',
        'details_services_112_text',
        'details_services_111_text',
        'details_services_110_text',
        'details_services_109_text',
        'details_services_100_text',
        'google_meet_link'
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function extraDetails()
    {
        return $this->hasOne(PatientAppointmentExtraDetails::class, 'patient_registration_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function doctorCertificates()
    {
        return $this->hasMany(DoctorCertificate::class, 'patient_registration_id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'patient_registration_id');
    }
}
