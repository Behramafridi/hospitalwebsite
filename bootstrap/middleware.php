<?php

return [
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
    'doctor' => \App\Http\Middleware\DoctorMiddleware::class,
    'patient' => \App\Http\Middleware\PatientMiddleware::class,
];
