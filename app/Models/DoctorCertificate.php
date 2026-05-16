<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorCertificate extends Model
{
    protected $fillable = [
        'patient_registration_id',
        'doctor_user_id',
        'type',
        'file_path',
        'original_name',
    ];

    public function registration()
    {
        return $this->belongsTo(PatientRegistration::class, 'patient_registration_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_user_id');
    }
}
