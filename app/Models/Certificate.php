<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_registration_id',
        'doctor_id',
        'type',
        'file_path',
        'original_name',
    ];

    public function patientRegistration()
    {
        return $this->belongsTo(PatientRegistration::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
