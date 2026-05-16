<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = 'registers';

    protected $fillable = [
        'emp_id',
        'name',
        'emp_fname',
        'cnic',
        'phone',
        'date_of_birth',
        'email',
        'active',
        'address',
        'signature',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];
}
