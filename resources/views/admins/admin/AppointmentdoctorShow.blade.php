@extends('admins.layout1.app')

@section('title', 'Appointment Details')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container-fluid py-0 px-0"
        style="background-color: #f8f9fa; min-height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <!-- Top Action Bar -->
        <div class="d-flex justify-content-between align-items-center px-4 py-3 bg-white border-bottom shadow-sm">
            <a href="{{ route('admin.appointment') }}" class="btn btn-primary"
                style="background-color:#0dcaf0; border: none; font-weight: 600; font-size: 0.85rem; padding: 8px 20px;">VIEW
                APPOINTMENTS</a>

        </div>

        <!-- Appointment Header -->
        <div class="px-4 py-2" style="background-color:#0dcaf0; color: white;">
            <h6 class="mb-0 fw-bold py-1">Appointment</h6>
        </div>

        <div class="container-fluid px-4 py-4">
            <div class="row g-4">
                <!-- Main Content (Left Column) -->
                <div class="col-lg-8">
                    <!-- Scheduled Info -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 4px;">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3" style="color: #333;">Scheduled On</h4>
                            <div class="d-flex flex-column gap-1 text-muted">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar3 me-2" style="color: #666;"></i>
                                    <span>{{ \Carbon\Carbon::parse($registration->appointmentDate)->format('j-F-Y') }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-clock me-2" style="color: #666;"></i>
                                    <span>{{ $registration->timeSlot ?: 'Time not set' }}</span>
                                </div>
                                <div class="mt-2">
                                    <span class="fw-bold text-dark">Type:</span>
                                    <span>{{ $registration->appointmentType ?: 'N/A' }}</span>
                                </div>
                                @if($registration->extraDetails && $registration->extraDetails->google_meet_link)
                                    <div class="mt-3 p-3 rounded" style="background-color: #f1f3f4; border: 1px solid #dadce0;">
                                        <div class="small text-muted mb-1"><i class="fa-solid fa-video me-1"></i> Google Meet
                                            Connection</div>
                                        <a href="{{ $registration->extraDetails->google_meet_link }}" target="_blank"
                                            class="text-decoration-none fw-bold" style="color: #1a73e8; font-size: 1rem;">
                                            {{ $registration->extraDetails->google_meet_link }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Tabs Section -->
                    <div class="card border-0 shadow-sm" style="border-radius: 4px;">
                        <div class="card-header bg-white border-0 pt-3">
                            <ul class="nav nav-tabs border-0" id="registrationTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active fw-bold px-4" id="account-tab" data-bs-toggle="tab"
                                        href="#account" role="tab"
                                        style="color: #d81b60; border-bottom: 2px solid #0dcaf0 !important; background: transparent;">Account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-muted fw-bold px-4" id="consultation-tab" data-bs-toggle="tab"
                                        href="#consultation" role="tab" style="border: none;">Consultation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-muted fw-bold px-4" id="photos-tab" data-bs-toggle="tab"
                                        href="#photos" role="tab" style="border: none;">Photos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-muted fw-bold px-4" id="pharmacy-tab" data-bs-toggle="tab"
                                        href="#pharmacy" role="tab" style="border: none;">Pharmacy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-muted fw-bold px-4" id="history-tab" data-bs-toggle="tab"
                                        href="#history" role="tab" style="border: none;">History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-muted fw-bold px-4" id="certificate-tab" data-bs-toggle="tab"
                                        href="#certificate" role="tab" style="border: none;">Certificate </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4 border-top">
                            <div class="tab-content" id="registrationTabsContent">
                                <!-- Account Tab -->
                                <div class="tab-pane fade show active" id="account" role="tabpanel">
                                    <div class="row gy-3">
                                        <div class="col-md-12">
                                            <div class="d-flex mb-2">
                                                <span class="fw-bold me-2" style="width: 150px; color: #555;">Name:</span>
                                                <span class="text-dark">{{ $registration->patient_first_name }}
                                                    {{ $registration->patient_last_name }} </span>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <span class="fw-bold me-2" style="width: 150px; color: #555;">Email:</span>
                                                <span class="text-dark">{{ $registration->registeremail }}</span>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <span class="fw-bold me-2" style="width: 150px; color: #555;">Mobile:</span>
                                                <span class="text-dark">{{ $registration->mobile }}</span>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <span class="fw-bold me-2" style="width: 150px; color: #555;">Secondary
                                                    Mobile:</span>
                                                <span class="text-dark">{{ $registration->mobile ?: 'N/A' }}</span>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <span class="fw-bold me-2" style="width: 150px; color: #555;">Date of
                                                    Birth:</span>
                                                <span class="text-dark">{{ $registration->bod_of_birth }}</span>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <span class="fw-bold me-2" style="width: 150px; color: #555;">Gender:</span>
                                                <span class="text-dark">{{ $registration->patient_foam_gender }}</span>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <span class="fw-bold me-2"
                                                    style="width: 150px; color: #555;">Address:</span>
                                                <span class="text-dark">{{ $registration->address ?: 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Consultation Tab -->
                                <div class="tab-pane fade" id="consultation" role="tabpanel">
                                    <h6 class="fw-bold text-muted mb-3">What are your current symptom(s)?</h6>
                                    <p>{{ $registration->textarea ?: 'No consultation notes provided.' }}</p>

                                    <h6 class="fw-bold text-muted mb-3">Have you had any medical conditions or undergone
                                        surgeries previously?</h6>
                                    <p>{{ $registration->hasMedicalHistory }} {{ $registration->medicalHistoryDetails }}</p>

                                    <h6 class="fw-bold text-muted mb-3">Are you currently using any prescribed medications?
                                    </h6>
                                    <p>{{ $registration->hasMedications }} {{ $registration->medicationDetails }}</p>

                                    <h6 class="fw-bold text-muted mb-3">Do you know of any allergies you might have?</h6>
                                    <p>{{ $registration->hasAllergies }} {{ $registration->allergyDetails }}</p>


                                </div>
                                <!-- Photos Tab -->
                                <div class="tab-pane fade" id="photos" role="tabpanel">
                                    <h6 class="fw-bold text-muted mb-3">Photos</h6>
                                    @if($registration->image)
                                        <div class="mb-3 text-start">

                                            <a href="{{ asset('storage/' . $registration->image) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $registration->image) }}"
                                                    alt="Database Symptoms Photo" class="img-fluid rounded shadow-sm border"
                                                    style="max-width: 500px; height: auto;">
                                            </a>
                                            <p class="mt-2 small text-muted"><i class="bi bi-info-circle me-1"></i> Click to
                                                view full resolution</p>
                                            <button type="button" class="btn btn-sm btn-info text-white fw-bold mt-2"
                                                onclick="addPhotoToReferral('{{ asset('storage/' . $registration->image) }}')">
                                                <i class="bi bi-plus-circle me-1"></i> Add to Referral
                                            </button>
                                        </div>
                                    @else
                                        <p class="text-muted">No photos found in database for this registration.</p>
                                    @endif
                                </div>
                                <!-- end photos tab code -->
                                <!-- Pharmacy Tab -->
                                <div class="tab-pane fade" id="pharmacy" role="tabpanel">
                                    @if($registration->prescriptionDelivery === 'Collect at Pharmacy')
                                        <h6 class="fw-bold text-muted mb-3">Selected Pharmacy Details</h6>
                                        <div class="row gy-3">
                                            <div class="col-md-12">
                                                <div class="d-flex mb-2">
                                                    <span class="fw-bold me-2"
                                                        style="width: 150px; color: #555;">Country:</span>
                                                    <span class="text-dark">{{ $registration->pharmacyCountry }}</span>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <span class="fw-bold me-2" style="width: 150px; color: #555;">Pharmacy
                                                        Name:</span>
                                                    <span class="text-dark">{{ $registration->pharmacyName }}</span>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <span class="fw-bold me-2" style="width: 150px; color: #555;">Phone
                                                        Number:</span>
                                                    <span class="text-dark">{{ $registration->pharmacyPhone }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <h6 class="fw-bold text-muted mb-3">Prescription Delivery</h6>
                                        <p>{{ $registration->prescriptionDelivery ?: 'No delivery preference selected.' }}</p>
                                    @endif
                                </div>
                                <!-- end pharmacy -->
                                @php /* <!-- start pharmacy code  --> */ @endphp


                                <!-- end pharmacy code -->
                                <div class="tab-pane fade" id="history" role="tabpanel">
                                    <h6 class="fw-bold text-muted mb-3">History</h6>
                                    <div class="table-responsive">
                                        <table class="table history-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px;">ID</th>
                                                    <th>Appointment Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($history as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <span
                                                                class="date-highlight">{{ \Carbon\Carbon::parse($item->appointmentDate)->format('j-F-Y') }}</span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('patient.registration.show', $item->id) }}"
                                                                class="text-decoration-none text-dark">view</a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center text-muted">No history details
                                                            provided.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Other tabs can be added here -->

                                <div class="tab-pane fade" id="certificate" role="tabpanel">
                                    <h6 class="fw-bold text-muted mb-3">Certificates History</h6>
                                    <div class="table-responsive">
                                        <div id="certificate-list" class="row g-3">
                                            @forelse($registration->doctorCertificates as $cert)
                                                <div class="col-md-3 mb-4" id="cert_{{ $cert->id }}">
                                                    <div class="card h-100 border-0 shadow-sm cert-card"
                                                        style="border-radius: 20px; background: #fff; overflow: hidden; position: relative;">
                                                        <div class="card-body p-4 text-center">
                                                            <div class="mb-4 d-flex justify-content-center">
                                                                <a href="{{ asset('storage/' . $cert->file_path) }}"
                                                                    download="{{ $cert->original_name }}"
                                                                    class="text-decoration-none bg-light p-3 rounded-circle d-inline-block shadow-sm hover-overlay position-relative"
                                                                    style="transition: all 0.3s ease;">
                                                                    <i class="bi bi-file-earmark-pdf-fill text-danger"
                                                                        style="font-size: 2.8rem; filter: drop-shadow(0 2px 4px rgba(220, 53, 69, 0.2));"></i>
                                                                    <div class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center download-icon-wrapper"
                                                                        style="width: 32px; height: 32px; border: 2px solid white; transform: translate(6px, 6px);">
                                                                        <i class="bi bi-download"
                                                                            style="font-size: 0.9rem;"></i>
                                                                    </div>
                                                                </a>
                                                            </div>

                                                            <h6 class="fw-bold mb-1 text-truncate"
                                                                style="color: #1a202c; font-size: 1.15rem; letter-spacing: -0.0125em;">
                                                                {{ $cert->type }}
                                                            </h6>
                                                            <p class="text-muted small mb-4 text-truncate px-2"
                                                                style="font-size: 0.8rem; font-weight: 500; opacity: 0.7;">Click
                                                                icon to download</p>

                                                            <div class="d-grid px-2 pb-2 pt-1 border-top"
                                                                style="border-color: rgba(0,0,0,0.03) !important;">
                                                                <a class="btn btn-link text-decoration-none shadow-none fw-bold p-0 d-flex align-items-center justify-content-center gap-2 mt-3"
                                                                    href="{{ asset('storage/' . $cert->file_path) }}"
                                                                    download="{{ $cert->original_name }}"
                                                                    style="color: #0d6efd; font-size: 0.85rem; letter-spacing: 0.5px;">
                                                                    <i class="bi bi-cloud-arrow-down-fill"
                                                                        style="font-size: 1rem;"></i> DOWNLOAD PDF
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center py-5 placeholder-text">
                                                    <i class="bi bi-file-earmark-pdf text-muted"
                                                        style="font-size: 4rem; opacity: 0.2;"></i>
                                                    <p class="text-muted mt-3 fw-bold">No certificates generated yet.</p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Prescription Section -->
                    <div class="card border-0 shadow-sm mt-4" style="border-radius: 4px; overflow: hidden;">
                        <div class="card-header border-0 px-4 py-2" style="background-color: #0dcaf0; color: white;">
                            <h6 class="mb-0 fw-bold">Prescription</h6>
                        </div>
                        <div class="card-body p-4 bg-white">
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>


                                        <p class="text-muted small mb-0">{{ $registration->foam_textarea }}</p>
                                    </div>
                                    <button class="btn btn-link text-dark p-0"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>

                            <div class="row align-items-center mb-3">
                                <div class="col-auto">
                                    <span class="fw-bold text-muted small">Drug</span>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select form-select-sm border" style="border-radius: 2px;">
                                        <option>Choose Drug</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Editor UI Mockup -->
                            <div class="border" style="border-radius: 2px;">
                                <div class="bg-light p-2 border-bottom d-flex gap-2">
                                    <button class="btn btn-sm btn-white border px-2 py-0">B</button>
                                    <button class="btn btn-sm btn-white border px-2 py-0"><i>I</i></button>
                                    <button class="btn btn-sm btn-white border px-2 py-0"><u>U</u></button>
                                    <div class="vr"></div>
                                    <i class="bi bi-justify text-muted"></i>
                                    <i class="bi bi-list-ul text-muted"></i>
                                    <i class="bi bi-list-ol text-muted"></i>
                                </div>
                                <textarea class="form-control border-0" rows="6" style="resize: none;"></textarea>
                            </div>
                            <button class="btn btn-sm mt-3 px-4"
                                style="background-color: #0dcaf0; color: white; border-radius: 2px; font-weight: 600; font-size: 0.75rem;">SAVE
                                DRUG</button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar (Right Column) -->
                <div class="col-lg-4">
                    <!-- Certificate Generation -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 4px; overflow: hidden;">
                        <div class="card-header border-0 px-4 py-2" style="background-color:#0dcaf0; color: white;">
                            <h6 class="mb-0 fw-bold">Certificate / Referral Generation</h6>
                        </div>
                        <div class="card-body p-3 bg-white">
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-outline-primary text-primary fw-bold py-2"
                                    data-bs-toggle="modal" data-bs-target="#invoiceModal"
                                    style="border-color: #0d6efd; font-size: 0.7rem; border-radius: 4px; letter-spacing: 0.5px;">INVOICE</button>
                                <button type="button" class="btn btn-outline-primary text-primary fw-bold py-2"
                                    data-bs-toggle="modal" data-bs-target="#EDREFERRALModel"
                                    style="border-color: #0d6efd; font-size: 0.7rem; border-radius: 4px; letter-spacing: 0.5px;">ED
                                    REFERRAL</button>

                                <button type="button" class="btn btn-outline-primary text-primary fw-bold py-2"
                                    data-bs-toggle="modal" data-bs-target="#PATHOLOGYREQUISITIONModel"
                                    style="border-color: #0d6efd; font-size: 0.7rem; border-radius: 4px; letter-spacing: 0.5px;">PATHOLOGY
                                    REQUISITION</button>

                                <button type="button" class="btn btn-outline-primary text-primary fw-bold py-2"
                                    data-bs-toggle="modal" data-bs-target="#RADIOGRAPHYREFERREDModel"
                                    style="border-color: #0d6efd; font-size: 0.7rem; border-radius: 4px; letter-spacing: 0.5px;">RADIOGRAPHY
                                    REFERRED</button>

                                <button type="button" class="btn btn-outline-primary text-primary fw-bold py-2"
                                    data-bs-toggle="modal" data-bs-target="#FITTOWORKCERTIFICATEModel"
                                    style="border-color: #0d6efd; font-size: 0.7rem; border-radius: 4px; letter-spacing: 0.5px;">FIT
                                    TO WORK CERTIFICATE</button>
                                <button type="button" class="btn btn-outline-primary text-primary fw-bold py-2"
                                    data-bs-toggle="modal" data-bs-target="#MEDICALCERTIFICATEModel"
                                    style="border-color: #0d6efd; font-size: 0.7rem; border-radius: 4px; letter-spacing: 0.5px;">MEDICAL
                                    CERTIFICATE</button>
                                <button type="button" class="btn btn-outline-primary text-primary fw-bold py-2"
                                    data-bs-toggle="modal" data-bs-target="#SPECIALISTREFERRALModel"
                                    style="border-color: #0d6efd; font-size: 0.7rem; border-radius: 4px; letter-spacing: 0.5px;">SPECIALIST
                                    REFERRAL</button>




                            </div>
                        </div>
                    </div>

                    <!-- Assign To Doctor -->
                    <!-- <div class="card border-0 shadow-sm" style="border-radius: 4px; overflow: hidden;">
                                                                                                <div class="card-header border-0 px-4 py-2" style="background-color:#0dcaf0; color: white;">
                                                                                                    <h6 class="mb-0 fw-bold">Assign To Doctor</h6>
                                                                                                </div>
                                                                                                <div class="card-body p-4 bg-white">
                                                                                                    <form action="{{ route('admin.assign.doctor') }}" method="POST">
                                                                                                        @csrf
                                                                                                        <input type="hidden" name="registration_ids[]" value="{{ $registration->id }}">
                                                                                                         <td>
                                                                                                                    <select name="doctor_ids[{{ $registration->id }}]" class="form-select form-select-sm">
                                                                                                                        <option value="">Select Doctor</option>
                                                                                                                        @foreach($doctors as $doctor)
                                                                                                                            <option value="{{ $doctor->id }}">
                                                                                                                                {{ $doctor->name }} (ID: {{ $doctor->register_id }})
                                                                                                                            </option>
                                                                                                                        @endforeach
                                                                                                                    </select>
                                                                                                                </td>
                                                                                                        <button type="submit" class="btn fw-bold px-4 text-white" style="background-color: #0dcaf0; border-radius: 2px; font-size: 0.75rem;">ASSIGN</button>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div> -->
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .nav-tabs .nav-link {
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .form-select,
        .form-control {
            font-size: 0.85rem;
        }

        .btn {
            transition: all 0.2s ease;
        }

        .btn:hover {
            opacity: 0.9;
        }

        @media (max-width: 991.98px) {

            .col-lg-8,
            .col-lg-4 {
                width: 100%;
            }
        }

        /* History Table Styles */
        .history-table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .history-table thead th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 700;
            border-bottom: 2px solid #eee;
            padding: 12px 8px;
            text-transform: capitalize;
        }

        .history-table tbody td {
            padding: 12px 8px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .date-highlight {
            background-color: #00ccff;
            /* Bright blue highlight */
            color: white;
            padding: 2px 8px;
            border-radius: 0;
            font-weight: 500;
        }

        .history-table tbody tr:hover {
            background-color: #fcfcfc;
        }

        /* Hover effect for Certificate / Referral Generation buttons */
        .d-grid.gap-2>button.btn-outline-primary:hover {
            background-color: #0dcaf0 !important;
            color: white !important;
            border-color: #0dcaf0 !important;
        }
    </style>






    <!-- start code fourth model  -->


    @include('admins.admin.Certificatecode', ['is_doctor' => true])

    <!-- end code fourth model  -->



    <!-- start code fifth model  -->


    <!-- end code seven model -->
@endsection