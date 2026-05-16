<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// Authentication Routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/doctor/dashboard', [App\Http\Controllers\Doctor\DashboardController::class, 'index'])->name('doctor.dashboard');
    Route::get('/doctor/appointment/{id}', [App\Http\Controllers\Doctor\DashboardController::class, 'show'])->name('doctor.registration.show');
    Route::get('/patient/dashboard', [App\Http\Controllers\Patient\DashboardController::class, 'index'])->name('patient.dashboard');
});

// Homepage redirect based on role
Route::get('/home', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->isDoctor()) {
        return redirect()->route('doctor.dashboard');
    }
    return redirect()->route('patient.dashboard');
})->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
// Route::get('/register/create', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/register/{register}/edit', [RegisterController::class, 'edit'])->name('register.edit');
Route::put('/register/{register}', [RegisterController::class, 'update'])->name('register.update');
Route::delete('/register/{register}', [RegisterController::class, 'destroy'])->name('register.destroy');



/* ===== GET ===== */
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

/* ===== POST ===== */
Route::post('/users', [UserController::class, 'store'])->name('users.store');

/* ===== UPDATE ===== */
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

/* ===== DELETE ===== */
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');




// frontend routes ..........................................................

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'home'])->name('home');
Route::get('/service', [App\Http\Controllers\Frontend\FrontendController::class, 'service'])->name('service');
Route::get('/about', [App\Http\Controllers\Frontend\FrontendController::class, 'about'])->name('about');

Route::get('/corporate', [App\Http\Controllers\Frontend\FrontendController::class, 'corporate'])->name('corporate');

Route::get('/contact', [App\Http\Controllers\Frontend\FrontendController::class, 'contact'])->name('contact');

Route::get('/appointment', [App\Http\Controllers\Frontend\FrontendController::class, 'appointment'])->name('appointment');
Route::post('/check-email', [App\Http\Controllers\Frontend\FrontendController::class, 'checkEmail'])->name('check.email');
Route::post('/login-wizard', [App\Http\Controllers\Frontend\FrontendController::class, 'loginWizard'])->name('login.wizard');

// end frontend routes ..........................................................

Route::post('/patient-registration', [App\Http\Controllers\PatientRegistrationController::class, 'store'])->name('appointment.store');
Route::get('/patient-registrations', [App\Http\Controllers\PatientRegistrationController::class, 'index'])->name('admin.appointment');
Route::post('/assign-doctor', [App\Http\Controllers\PatientRegistrationController::class, 'assignDoctor'])->name('admin.assign.doctor');
Route::get('/patient-registration/{id}', [App\Http\Controllers\PatientRegistrationController::class, 'show'])->name('patient.registration.show');
Route::post('/admin/certificate/store', [App\Http\Controllers\PatientRegistrationController::class, 'storeCertificate'])->name('admin.certificate.store');
Route::post('/doctor/certificate/store', [App\Http\Controllers\PatientRegistrationController::class, 'storeDoctorCertificate'])->name('doctor.certificate.store');
Route::post('/doctor/prescription/store', [App\Http\Controllers\PatientRegistrationController::class, 'storePrescription'])->name('doctor.prescription.store');
Route::delete('/doctor/prescription/{id}', [App\Http\Controllers\PatientRegistrationController::class, 'deletePrescription'])->name('doctor.prescription.destroy');