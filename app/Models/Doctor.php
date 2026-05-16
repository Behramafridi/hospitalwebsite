<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'register_id',
        'patient_registration_id',
        'appointmentType',
        'appointmentDate',
        'timeSlot',
        'registeremail',
        'registerpassword',
        'extra_severity',
        'pdf',
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
        'google_meet_link',
    ];

    public function register()
    {
        return $this->belongsTo(Register::class, 'register_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'register_id', 'register_id');
    }

    public function doctorCertificates()
    {
        return $this->hasMany(DoctorCertificate::class, 'patient_registration_id', 'patient_registration_id');
    }

    public function adminCertificates()
    {
        return $this->hasMany(Certificate::class, 'patient_registration_id', 'patient_registration_id');
    }
}
