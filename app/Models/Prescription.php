<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'patient_registration_id',
        'doctor_id',
        'drug_name',
        'dosage_instructions'
    ];

    public function registration()
    {
        return $this->belongsTo(PatientRegistration::class, 'patient_registration_id');
    }
}
