<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAppointmentExtraDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_registration_id',
        'counseling_reason',
        'previous_therapy',
        'emergency_contact',
        'extra_area',
        'extra_type',
        'extra_symptoms',
        'extra_severity',
        'google_meet_link',
    ];

    public function patientRegistration()
    {
        return $this->belongsTo(PatientRegistration::class);
    }
}
