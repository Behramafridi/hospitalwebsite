<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'register_id',
        'address_id',
        'phone_id',
        'signature_id',
        'appoinment_id',
        'employee_id',
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Role checking methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isDoctor()
    {
        return $this->role === 'doctor';
    }

    public function isPatient()
    {
        return $this->role === 'patient';
    }

    // Relationship
    public function register()
    {
        return $this->belongsTo(Register::class);
    }

    public function employee()
    {
        return $this->belongsTo(Register::class, 'employee_id');
    }

    public function patientRegistration()
    {
        return $this->belongsTo(PatientRegistration::class, 'appoinment_id');
    }

    public function addressRegister()
    {
        return $this->belongsTo(Register::class, 'address_id');
    }

    public function phoneRegister()
    {
        return $this->belongsTo(Register::class, 'phone_id');
    }

    public function signatureRegister()
    {
        return $this->belongsTo(Register::class, 'signature_id');
    }
}
