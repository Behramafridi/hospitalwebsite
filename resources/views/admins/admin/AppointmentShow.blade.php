@extends('admins.layouts.app')

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
                                        href="#certificate" role="tab" style="border: none;">Certificate</a>
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

                                    @if($registration->appointmentType === 'Counselling Therapy' && $registration->extraDetails)
                                        <div class="mt-4 p-3 rounded"
                                            style="background-color: #f0f9ff; border-left: 5px solid #007bff;">
                                            <h5 class="fw-bold text-primary mb-3">Counselling Therapy Details</h5>

                                            <h6 class="fw-bold text-muted mb-1">Reason for Counseling:</h6>
                                            <p class="mb-3">{{ $registration->extraDetails->counseling_reason ?: 'N/A' }}</p>

                                            <h6 class="fw-bold text-muted mb-1">Previous Therapy:</h6>
                                            <p class="mb-3">{{ $registration->extraDetails->previous_therapy ?: 'N/A' }}</p>

                                            <h6 class="fw-bold text-muted mb-1">Emergency Contact:</h6>
                                            <p class="mb-0">{{ $registration->extraDetails->emergency_contact ?: 'N/A' }}</p>
                                        </div>
                                    @endif

                                    @if($registration->extraDetails && ($registration->extraDetails->extra_area || $registration->extraDetails->extra_symptoms))
                                        <div class="mt-4 p-3 rounded"
                                            style="background-color: #fff9db; border-left: 5px solid #fab005;">
                                            <h5 class="fw-bold text-warning mb-3">Extra Condition Details</h5>
                                            <p><strong>Area:</strong> {{ $registration->extraDetails->extra_area }}</p>
                                            <p><strong>Symptoms:</strong> {{ $registration->extraDetails->extra_symptoms }}</p>
                                            <p><strong>Severity:</strong> {{ $registration->extraDetails->extra_severity }}</p>
                                        </div>
                                    @endif
                                </div>
                                <!-- Photos Tab -->
                                <div class="tab-pane fade" id="photos" role="tabpanel">
                                    <h6 class="fw-bold text-muted mb-3">Photos</h6>
                                    @php
                                        $imagePath = $registration->image ?? $registration->pdf ?? null;
                                        $imageUrl = null;
                                        if ($imagePath) {
                                            if (strpos($imagePath, 'http://') === 0 || strpos($imagePath, 'https://') === 0) {
                                                $imageUrl = $imagePath;
                                            } elseif (strpos($imagePath, 'storage/') === 0) {
                                                $imageUrl = asset($imagePath);
                                            } else {
                                                $imageUrl = asset('storage/' . $imagePath);
                                            }
                                        }
                                    @endphp
                                    @if($imageUrl)
                                        <div class="mb-3 text-start">
                                            <a href="{{ $imageUrl }}" target="_blank" class="d-inline-block position-relative photo-hover-container">
                                                <img src="{{ $imageUrl }}"
                                                    alt="Database Symptoms Photo" class="img-fluid rounded shadow border"
                                                    style="max-width: 500px; height: auto; transition: all 0.3s ease;">
                                            </a>
                                            <p class="mt-2 small text-muted"><i class="bi bi-info-circle me-1"></i> Click to
                                                view full resolution</p>
                                            <button type="button" class="btn btn-sm btn-info text-white fw-bold mt-2"
                                                onclick="addPhotoToReferral('{{ $imageUrl }}')">
                                                <i class="bi bi-plus-circle me-1"></i> Add to Referral
                                            </button>
                                        </div>
                                    @else
                                        <p class="text-muted">No photos found in database for this registration.</p>
                                    @endif

                                    <style>
                                        .photo-hover-container:hover img {
                                            transform: scale(1.015);
                                            box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
                                            border-color: #0dcaf0 !important;
                                        }
                                    </style>
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

                                <!-- Certificate Tab -->
                                <div class="tab-pane fade" id="certificate" role="tabpanel">
                                    <h6 class="fw-bold mb-4" style="color: #333;">Patient Certificate Details</h6>
                                    <div id="certificate-list" class="row g-3">
                                        @forelse($registration->certificates as $cert)
                                            <div class="col-md-3 mb-4" id="cert_{{ $cert->id }}">
                                                <div class="card h-100 border-0 shadow-sm cert-card"
                                                    style="border-radius: 20px; background: #fff; overflow: hidden; position: relative;">
                                                    <div class="card-body p-4 text-center">
                                                        <!-- Professional Download Icon Overlay -->
                                                        <div class="mb-4 d-flex justify-content-center">
                                                            <a href="{{ asset('storage/' . $cert->file_path) }}"
                                                                download="{{ $cert->original_name }}"
                                                                class="text-decoration-none bg-light p-3 rounded-circle d-inline-block shadow-sm hover-overlay position-relative"
                                                                style="transition: all 0.3s ease;">
                                                                <i class="bi bi-file-earmark-pdf-fill text-danger"
                                                                    style="font-size: 2.8rem; filter: drop-shadow(0 2px 4px rgba(220, 53, 69, 0.2));"></i>
                                                                <div class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center download-icon-wrapper"
                                                                    style="width: 32px; height: 32px; border: 2px solid white; transform: translate(6px, 6px);">
                                                                    <i class="bi bi-download" style="font-size: 0.9rem;"></i>
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

                    <!-- Prescription Section -->
                    <div class="card border-0 shadow-sm mt-4" style="border-radius: 4px; overflow: hidden;">
                        <div class="card-header border-0 px-4 py-2" style="background-color: #0dcaf0; color: white;">
                            <h6 class="mb-0 fw-bold">Prescription</h6>
                        </div>
                        <div class="card-body p-4 bg-white">
                            <!-- Added Drugs List -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h6 class="fw-bold mb-0" style="color: #4a5568;"><p class="text-muted small mb-0">{{ $registration->foam_textarea }}</p></h6>
                                        
                                    </div>
                                    <div class="d-flex gap-2 align-items-center">
                                        <button id="downloadFoamBtn" class="btn btn-link text-info p-0" title="Download This Note"><i class="bi bi-file-earmark-pdf-fill" style="font-size: 1.1rem;"></i></button>
                                        <button class="btn btn-link text-dark p-0"><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- Drug Selection -->
                            <div class="mb-3">
                                <label class="fw-bold text-muted small mb-2 d-block">SEARCH AND CHOOSE DRUG</label>
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                                    <input type="text" id="drugSearch" class="form-control border-start-0 shadow-none" placeholder="Search drug name..." style="border-radius: 0 4px 4px 0;" autocomplete="off">
                                </div>
                                <div id="drugSearchResults" class="list-group shadow-sm mt-1" style="display: none; max-height: 250px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: 4px;"></div>
                            </div>

                            <!-- Editor UI -->
                            <div class="border" style="border-radius: 4px;">
                                <div class="bg-light p-2 border-bottom d-flex gap-2 align-items-center">
                                    <button class="btn btn-sm btn-white border bg-white px-2 py-0"><i class="bi bi-type-bold"></i></button>
                                    <button class="btn btn-sm btn-white border bg-white px-2 py-0"><i class="bi bi-type-italic"></i></button>
                                    <button class="btn btn-sm btn-white border bg-white px-2 py-0"><i class="bi bi-type-underline"></i></button>
                                    <div class="vr mx-1"></div>
                                    <i class="bi bi-list-ul text-muted small"></i>
                                    <i class="bi bi-list-ol text-muted small"></i>
                                </div>
                                <textarea id="drugInstructions" class="form-control border-0 shadow-none" rows="6" style="resize: none;" placeholder="Enter dosage instructions..."></textarea>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-4 d-flex flex-wrap gap-2 align-items-center">
                                <button id="saveDrugBtn" class="btn btn-sm text-white px-3 fw-bold" style="background-color: #d81b60; border-radius: 4px; font-size: 0.75rem;">SAVE DRUG</button>
                                <button id="downloadCurrentBtn" class="btn btn-sm btn-outline-info px-2 py-1" title="Download Current Note" style="border-radius: 4px; border-width: 1.5px;"><i class="bi bi-file-earmark-pdf-fill"></i></button>
                                <button class="btn btn-sm text-white px-3 fw-bold" style="background-color: #d81b60; border-radius: 4px; font-size: 0.75rem;">SAVE PRESCRIPTION</button>
                                <button class="btn btn-sm text-white px-3 fw-bold" style="background-color: #ffc107; border-radius: 4px; font-size: 0.75rem;">PRINT PRESCRIPTION</button>
                                <button class="btn btn-sm text-white px-3 fw-bold" style="background-color: #dc3545; border-radius: 4px; font-size: 0.75rem;">SEND PHARMACY</button>
                            </div>

                            <div class="d-flex flex-wrap gap-2 mt-3 pt-2">
                                <button class="btn btn-sm px-3 fw-bold" style="border: 1.5px solid #dc3545; color: #dc3545; background: transparent; border-radius: 4px; font-size: 0.75rem;">CANCELLED</button>
                                <button class="btn btn-sm px-3 fw-bold" style="border: 1.5px solid #0dcaf0; color: #0dcaf0; background: transparent; border-radius: 4px; font-size: 0.75rem;">END APPOINTMENT</button>
                            </div>

                            <!-- Current Prescription Table -->
                            <div class="mt-5 border-top pt-4">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead>
                                            <tr class="text-muted small border-bottom">
                                                <th class="fw-bold pb-3" style="font-size: 0.7rem; text-transform: uppercase;">Prescribed By</th>
                                                <th class="fw-bold pb-3" style="font-size: 0.7rem; text-transform: uppercase;">Prescribed At</th>
                                                <th class="fw-bold pb-3 text-end" style="font-size: 0.7rem; text-transform: uppercase;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="prescribedDrugsBody">
                                            <!-- Prescribed drugs will appear here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                    <div class="card border-0 shadow-sm" style="border-radius: 4px; overflow: hidden;">
                        <div class="card-header border-0 px-4 py-2" style="background-color:#0dcaf0; color: white;">
                            <h6 class="mb-0 fw-bold">Assign To Doctor</h6>
                        </div>
                        <div class="card-body p-4 bg-white">
                            <form action="{{ route('admin.assign.doctor') }}" method="POST">
                                @csrf
                                <input type="hidden" name="registration_ids[]" value="{{ $registration->id }}">
                                <td>
                                    <select name="doctor_ids[{{ $registration->id }}]"
                                        class="form-select form-select-sm doctor-select"
                                        data-registration-id="{{ $registration->id }}">
                                        <option value="">Select Doctor</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}"
                                                data-register-id="{{ $doctor->register_id ?? 'N/A' }}"
                                                data-name="{{ $doctor->name ?? 'N/A' }}"
                                                data-role="{{ ucfirst($doctor->role ?? 'N/A') }}"
                                                data-phone="{{ $doctor->phoneRegister->phone ?? 'N/A' }}"
                                                data-address="{{ $doctor->addressRegister->address ?? 'N/A' }}"
                                                data-signature="{{ $doctor->signatureRegister->signature ?? '' }}">
                                                {{ $doctor->name }} (ID: {{ $doctor->register_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <button type="submit" class="btn fw-bold px-4 text-white"
                                    style="background-color: #0dcaf0; border-radius: 2px; font-size: 0.75rem;">ASSIGN</button>
                            </form>
                        </div>
                    </div>
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
        /* Vintage Medical Report Design System */
        .doc-modal-content, 
        #FITTOWORKCERTIFICATEModel .modal-content,
        #MEDICALCERTIFICATEModel .modal-content,
        #SPECIALISTREFERRALModel .modal-content {
            border-radius: 2px !important;
            border: 1px solid #b59b73 !important;
            outline: 2px solid #b59b73 !important;
            outline-offset: -8px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3) !important;
            background-color: #fcf9f2 !important; /* Cream paper color */
            overflow: hidden;
            font-family: 'Georgia', 'Times New Roman', serif !important;
            color: #3e3226 !important;
        }

        .doc-modal-header, .modal-header {
            background-color: transparent !important;
            border-bottom: 2px solid #b59b73 !important;
            padding: 24px 32px;
        }

        .doc-modal-body, .modal-body {
            padding: 40px 60px;
            color: #3e3226 !important;
            background-color: transparent !important;
        }

        /* Branding */
        .doc-brand {
            display: flex;
            align-items: center;
            justify-content: center; /* Centered like a classic report */
            margin-bottom: 40px;
            border-bottom: 2px double #b59b73;
            padding-bottom: 20px;
        }

        .doc-logo-circle,
        .modal-body .mb-5.d-flex.align-items-center > div:first-child {
            width: 60px !important;
            height: 60px !important;
            background: transparent !important;
            border-radius: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #b59b73 !important;
            font-size: 2.5rem !important;
            margin-right: 20px !important;
            box-shadow: none !important;
        }

        /* Hide the modern gradient circles in the last 3 modals */
        .modal-body .mb-5.d-flex.align-items-center > div:first-child > div {
            display: none !important;
        }

        .doc-brand-name, 
        .modal-body .mb-5.d-flex.align-items-center span.fs-2 {
            font-size: 2.5rem !important;
            font-weight: bold !important;
            color: #3e3226 !important;
            letter-spacing: 0.1em !important;
            text-transform: uppercase !important;
            font-family: 'Georgia', 'Times New Roman', serif !important;
        }

        .doc-brand-tag {
            color: #b59b73 !important;
        }

        /* Document Header */
        .doc-header-strip {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding: 20px 0;
            border-bottom: 1px dashed #b59b73 !important;
        }

        .doc-type-badge, 
        .modal-body .mb-5 > div[style*="border"] {
            background: transparent !important;
            color: #3e3226 !important;
            padding: 5px 0 !important;
            border: none !important;
            border-radius: 0 !important;
            font-weight: bold !important;
            font-size: 1.2rem !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
            border-bottom: 2px solid #b59b73 !important;
            text-align: center;
        }
        
        .modal-body .mb-5 > div[style*="border"] span {
            color: #3e3226 !important;
            font-weight: bold !important;
        }

        .doc-meta-pills {
            display: flex;
            gap: 20px;
        }

        .doc-meta-pill {
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            border-radius: 0 !important;
            font-size: 0.95rem !important;
            color: #5c4e40 !important;
            border-bottom: 1px dotted #b59b73 !important;
        }

        .doc-meta-pill strong {
            color: #3e3226 !important;
        }

        /* Layout Grids */
        .doc-info-grid, 
        .modal-body .row.mb-5 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            margin-bottom: 40px !important;
        }
        
        .modal-body .row.mb-5 {
            display: flex !important;
        }

        .doc-section-head, 
        h6.fw-bold.mb-3[style*="color: #343a40"] {
            font-size: 1.1rem !important;
            font-weight: bold !important;
            color: #3e3226 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            margin-bottom: 20px !important;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #b59b73 !important;
            padding-bottom: 5px !important;
        }

        .doc-section-head i {
            margin-right: 10px;
            color: #b59b73;
            font-size: 1.2rem;
        }

        .doc-card,
        .col-md-6 > div[style*="color: #6c757d"] {
            background: transparent !important;
            border: none !important;
            border-radius: 0 !important;
            padding: 10px 0 !important;
            color: #3e3226 !important;
        }

        .doc-row,
        .d-flex.mb-2, .d-flex.mb-3 {
            display: flex;
            margin-bottom: 15px !important;
            font-size: 1rem !important;
            line-height: 1.5;
            border-bottom: 1px dotted #b59b73 !important;
            padding-bottom: 5px !important;
        }

        .doc-label,
        .fw-bold.text-dark[style*="width: 80px"] {
            width: 130px !important;
            font-weight: bold !important;
            color: #5c4e40 !important;
            flex-shrink: 0;
            text-transform: uppercase !important;
            font-size: 0.85rem !important;
        }

        .doc-value,
        .d-flex.mb-2 span:not(.fw-bold), .d-flex.mb-3 span:not(.fw-bold) {
            color: #2c241c !important;
            font-weight: normal !important;
            font-style: italic !important;
        }

        /* Table Styling */
        .doc-table-container {
            margin: 40px 0;
            border: 2px solid #b59b73 !important;
            border-radius: 0 !important;
            overflow: hidden;
            background: transparent !important;
        }

        .doc-table {
            width: 100%;
            border-collapse: collapse;
        }

        .doc-table th {
            background: #f4ebd8 !important;
            padding: 15px 20px !important;
            text-align: left;
            font-size: 0.9rem !important;
            font-weight: bold !important;
            color: #3e3226 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
            border-bottom: 2px solid #b59b73 !important;
        }

        .doc-table td {
            padding: 15px 20px !important;
            color: #3e3226 !important;
            border-bottom: 1px solid #e0d5c1 !important;
        }

        .doc-table tr:last-child td {
            border-bottom: none !important;
        }

        .doc-total-row {
            background: #f4ebd8 !important;
        }

        .doc-total-label {
            font-weight: bold !important;
            color: #3e3226 !important;
            text-align: right;
            padding-right: 48px !important;
            text-transform: uppercase !important;
        }

        .doc-total-value {
            font-weight: bold !important;
            color: #b59b73 !important;
            font-size: 1.3rem !important;
        }

        /* Editor Styling */
        .doc-editor-wrapper,
        .border.rounded.mb-5 {
            margin-top: 40px !important;
            border: 1px solid #b59b73 !important;
            border-radius: 0 !important;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.4) !important;
        }

        .doc-editor-toolbar,
        .bg-light.p-2.border-bottom {
            background: #e0d5c1 !important;
            padding: 10px !important;
            border-bottom: 1px solid #b59b73 !important;
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .doc-toolbar-btn,
        .bg-light.p-2.border-bottom .btn {
            width: 32px !important;
            height: 32px !important;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent !important;
            border: 1px solid transparent !important;
            border-radius: 2px !important;
            color: #5c4e40 !important;
            cursor: pointer;
            transition: all 0.2s;
        }

        .doc-toolbar-btn:hover,
        .bg-light.p-2.border-bottom .btn:hover {
            border-color: #b59b73 !important;
            background: #f4ebd8 !important;
            color: #2c241c !important;
        }

        .doc-editor-area,
        .form-control.border-0.p-4 {
            padding: 30px !important;
            min-height: 250px !important;
            outline: none;
            color: #2c241c !important;
            line-height: 1.8 !important;
            font-size: 1.1rem !important;
            font-family: 'Georgia', 'Times New Roman', serif !important;
            background: transparent !important;
        }

        /* Signatures */
        .doc-footer-area,
        .modal-body .mt-5 {
            margin-top: 60px !important;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            border-top: 2px solid #b59b73 !important;
            padding-top: 30px !important;
        }
        
        .modal-body .mt-5 {
            flex-direction: row;
            align-items: flex-end;
            justify-content: space-between;
        }
        
        .modal-body .mt-5 > p {
            display: none !important; /* Hide 'Thanks' and 'Your Sincerely' as it's already structured in left/right */
        }

        .doc-signature-block,
        .mt-4 {
            text-align: left;
        }

        .doc-sig-img,
        .mt-4 img {
            max-height: 80px !important;
            margin-bottom: 10px !important;
            filter: sepia(1) hue-rotate(-30deg) saturate(1.5) contrast(1.2) !important;
        }

        .doc-sig-line,
        .mt-4 > div[style*="border-bottom"] {
            width: 250px !important;
            height: 1px !important;
            background: transparent !important;
            border-bottom: 1px solid #b59b73 !important;
            margin-bottom: 10px !important;
        }

        .doc-sig-name,
        .mb-0.fw-bold.text-dark {
            font-weight: bold !important;
            color: #2c241c !important;
            font-size: 1.1rem !important;
            font-style: italic !important;
            font-family: 'Georgia', 'Times New Roman', serif !important;
        }

        .doc-sig-meta,
        .mb-0.small[style*="color: #6c757d"] {
            font-size: 0.9rem !important;
            color: #5c4e40 !important;
            text-transform: uppercase !important;
        }

        /* Notes/Footer */
        .doc-disclaimer,
        .mb-4 > div[style*="background-color: #f8fafc"],
        .mb-4 > div[style*="padding: 12px 20px"] {
            margin-top: 40px !important;
            padding: 20px !important;
            background: transparent !important;
            border: 1px dashed #b59b73 !important;
            border-radius: 0 !important;
            color: #5c4e40 !important;
            font-size: 0.95rem !important;
            font-style: italic !important;
            text-align: center !important;
        }

        .doc-legal-footer {
            margin-top: 40px !important;
            text-align: center !important;
            color: #8c7b65 !important;
            font-size: 0.85rem !important;
            border-top: 1px solid #e0d5c1 !important;
            padding-top: 20px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
        }

        /* Buttons */
        .doc-btn-primary, .doc-btn-generate,
        .modal-footer .btn.text-white {
            background: #b59b73 !important;
            color: #fbf8f1 !important;
            border: 2px solid #8c7b65 !important;
            padding: 10px 30px !important;
            border-radius: 0 !important;
            font-weight: bold !important;
            letter-spacing: 0.1em !important;
            text-transform: uppercase !important;
            transition: all 0.3s;
            font-family: 'Georgia', serif !important;
            box-shadow: none !important;
        }

        .doc-btn-primary:hover, .doc-btn-generate:hover,
        .modal-footer .btn.text-white:hover {
            background: #8c7b65 !important;
            color: #fff !important;
        }

        .doc-btn-secondary,
        .modal-footer .btn-light {
            background: transparent !important;
            color: #5c4e40 !important;
            border: 2px solid #b59b73 !important;
            padding: 10px 30px !important;
            border-radius: 0 !important;
            font-weight: bold !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
            transition: all 0.2s;
            font-family: 'Georgia', serif !important;
        }

        .doc-btn-secondary:hover,
        .modal-footer .btn-light:hover {
            background: #e0d5c1 !important;
            color: #2c241c !important;
        }

        @media (max-width: 768px) {
            .doc-modal-body, .modal-body { padding: 30px 20px !important; }
            .doc-info-grid, .modal-body .row.mb-5 { grid-template-columns: 1fr; gap: 24px !important; flex-direction: column !important; }
            .doc-header-strip { flex-direction: column; align-items: flex-start; gap: 20px; }
        }
    </style>

    <!-- Invoice Modal -->
    <!-- Invoice Modal -->
    <div class="modal fade" id="OLD_invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content doc-modal-content">
                <div class="doc-modal-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title fw-bold" id="invoiceModalLabel" style="color: #1e293b;">Appointment Invoice</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="doc-modal-body">
                    <!-- Branding -->
                    <div class="doc-brand">
                        <div class="doc-logo-circle">
                            <i class="bi bi-shield-plus"></i>
                        </div>
                        <span class="doc-brand-name">Call<span class="doc-brand-tag">Doc</span></span>
                    </div>

                    <!-- Header Strip -->
                    <div class="doc-header-strip">
                        <div class="doc-type-badge">Invoice / Receipt</div>
                        <div class="doc-meta-pills">
                            <div class="doc-meta-pill"><strong>ID:</strong> #{{ $registration->id }}</div>
                            <div class="doc-meta-pill"><strong>INV:</strong> INV-00{{ $registration->id }}</div>
                            <div class="doc-meta-pill"><strong>Date:</strong> {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('d M, Y') }}</div>
                        </div>
                    </div>

                    <div class="doc-info-grid">
                        <!-- Provider Info -->
                        <div>
                            <div class="doc-section-head"><i class="bi bi-hospital"></i> Healthcare Provider</div>
                            <div class="doc-card">
                                <div class="doc-row">
                                    <div class="doc-label">Name:</div>
                                    <div class="doc-value">{{ $registration->doctor->name ?? 'N/A' }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Reg ID:</div>
                                    <div class="doc-value">{{ $registration->doctor->register_id ?? 'N/A' }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Role:</div>
                                    <div class="doc-value">{{ ucfirst($registration->doctor->role ?? 'N/A') }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Contact:</div>
                                    <div class="doc-value">{{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}</div>
                                </div>
                                <div class="doc-row mt-2">
                                    <div class="doc-label">Address:</div>
                                    <div class="doc-value" style="font-size: 0.85rem; line-height: 1.4;">{{ $registration->doctor->addressRegister->address ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Recipient Info -->
                        <div>
                            <div class="doc-section-head"><i class="bi bi-person-circle"></i> Patient Details</div>
                            <div class="doc-card">
                                <div class="doc-row">
                                    <div class="doc-label">Name:</div>
                                    <div class="doc-value">{{ $registration->patient_first_name }} {{ $registration->patient_last_name }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Contact:</div>
                                    <div class="doc-value">{{ $registration->mobile ?: 'N/A' }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Email:</div>
                                    <div class="doc-value" style="font-size: 0.85rem;">{{ $registration->registeremail ?: 'N/A' }}</div>
                                </div>
                                <div class="doc-row mt-2">
                                    <div class="doc-label">Address:</div>
                                    <div class="doc-value" style="font-size: 0.85rem; line-height: 1.4;">{{ $registration->address ?: 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Services Table -->
                    <div class="doc-table-container">
                        <table class="doc-table">
                            <thead>
                                <tr>
                                    <th>Description of Service</th>
                                    <th class="text-end">Status / Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="fw-bold">Telephone Consultation</div>
                                        <div class="text-muted small">Standard medical review and digital health service</div>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge rounded-pill bg-success px-3">PAID</span>
                                    </td>
                                </tr>
                                <tr class="doc-total-row">
                                    <td class="doc-total-label">Total Outstanding Amount</td>
                                    <td class="text-end doc-total-value">€0.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Disclaimer -->
                    <div class="doc-disclaimer">
                        <div class="fw-bold mb-1"><i class="bi bi-info-circle-fill me-2"></i> Billing Notes</div>
                        <p class="mb-0 small">This is a system-generated receipt for a prepaid online consultation. For any billing enquiries or reconciliation, please contact <strong>billing@calldoc.ie</strong> quoting your Appointment ID #{{ $registration->id }}.</p>
                    </div>

                    <!-- Footer -->
                    <div class="doc-legal-footer">
                        <p class="mb-1">Thank you for choosing CallDoc Healthcare Services.</p>
                        <p class="mb-0">www.calldoc.ie | Secure Digital Healthcare Solutions</p>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-5 px-5 d-flex justify-content-end gap-3">
                    <button type="button" class="doc-btn-generate" onclick="generatePDF(this.closest('.modal').id)">
                        <i class="bi bi-file-earmark-pdf me-2"></i>GENERATE PDF
                    </button>
                    <button type="button" class="doc-btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ED Referral Modal -->
    <div class="modal fade" id="EDREFERRALModel" tabindex="-1" aria-labelledby="EDREFERRALModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content doc-modal-content">
                <div class="doc-modal-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title fw-bold" id="EDREFERRALModelLabel" style="color: #1e293b;">ED Referral</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="doc-modal-body" id="referralLetterContent">
                    <!-- Branding -->
                    <div class="doc-brand">
                        <div class="doc-logo-circle">
                            <i class="bi bi-hospital"></i>
                        </div>
                        <span class="doc-brand-name">Call<span class="doc-brand-tag">Doc</span></span>
                    </div>

                    <!-- Header Strip -->
                    <div class="doc-header-strip">
                        <div class="doc-type-badge">Emergency Referral</div>
                        <div class="doc-meta-pills">
                            <div class="doc-meta-pill"><strong>ID:</strong> #{{ $registration->id }}</div>
                            <div class="doc-meta-pill"><strong>Date:</strong> {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('d M, Y') }}</div>
                        </div>
                    </div>

                    <div class="doc-info-grid">
                        <!-- Doctor Info -->
                        <div>
                            <div class="doc-section-head"><i class="bi bi-person-badge"></i> Referring Physician</div>
                            <div class="doc-card">
                                <div class="doc-row">
                                    <div class="doc-label">Name:</div>
                                    <div class="doc-value">{{ $registration->doctor->name ?? 'Dr Sohail Wahid' }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Clinic:</div>
                                    <div class="doc-value">CallDoc Ltd</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Phone:</div>
                                    <div class="doc-value">{{ $registration->doctor->phoneRegister->phone ?? '+353871085185' }}</div>
                                </div>
                                <div class="doc-row mt-2">
                                    <div class="doc-label">Address:</div>
                                    <div class="doc-value" style="font-size: 0.85rem; line-height: 1.4;">{{ $registration->doctor->addressRegister->address ?? '18 BEHAN HOUSE, ARDEN ROAD, TULLAMORE, OFFALY R35 T6C3, IRELAND' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Patient Info -->
                        <div>
                            <div class="doc-section-head"><i class="bi bi-person"></i> Patient Details</div>
                            <div class="doc-card">
                                <div class="doc-row">
                                    <div class="doc-label">Name:</div>
                                    <div class="doc-value">{{ $registration->patient_first_name }} {{ $registration->patient_last_name }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">DOB:</div>
                                    <div class="doc-value">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('d M, Y') : 'N/A' }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Contact:</div>
                                    <div class="doc-value">{{ $registration->mobile ?: 'N/A' }}</div>
                                </div>
                                <div class="doc-row mt-2">
                                    <div class="doc-label">Address:</div>
                                    <div class="doc-value" style="font-size: 0.85rem; line-height: 1.4;">{{ $registration->address ?: 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 15px 20px; color: #475569; font-style: italic;">
                            Dear Doctor, I am referring this patient with the following history.
                        </div>
                    </div>

                    <!-- Clinical Editor -->
                    <div class="doc-section-head"><i class="bi bi-journal-medical"></i> Clinical Details & Assessment</div>
                    <div class="doc-editor-wrapper">
                        <div class="doc-editor-toolbar">
                            <button type="button" class="doc-toolbar-btn" onclick="document.execCommand('bold', false, null)" title="Bold"><i class="bi bi-type-bold"></i></button>
                            <button type="button" class="doc-toolbar-btn" onclick="document.execCommand('italic', false, null)" title="Italic"><i class="bi bi-type-italic"></i></button>
                            <button type="button" class="doc-toolbar-btn" onclick="document.execCommand('underline', false, null)" title="Underline"><i class="bi bi-type-underline"></i></button>
                            <div class="vr mx-1" style="border-left: 1px solid #e2e8f0; height: 20px; margin: 7px 0;"></div>
                            <button type="button" class="doc-toolbar-btn" onclick="document.execCommand('insertUnorderedList', false, null)" title="Bullets"><i class="bi bi-list-ul"></i></button>
                            <button type="button" class="doc-toolbar-btn" onclick="document.execCommand('insertOrderedList', false, null)" title="Numbering"><i class="bi bi-list-ol"></i></button>
                            <div class="vr mx-1" style="border-left: 1px solid #e2e8f0; height: 20px; margin: 7px 0;"></div>
                            <button type="button" class="doc-toolbar-btn" onclick="document.execCommand('removeFormat', false, null)" title="Clear Formatting"><i class="bi bi-eraser"></i></button>
                        </div>
                        <div id="referralEditor" contenteditable="true" class="doc-editor-area">
                            <p><strong>Past Medical history:</strong></p>
                            <p><strong>Subjective:</strong></p>
                            <p><strong>Objective:</strong></p>
                            <p><strong>Assessment:</strong></p>
                            <p><strong>Plan:</strong></p>
                            <p class="mt-4">Having accessed this patient, I feel that assessment is necessary and I will be grateful if the patient is seen by your team.</p>
                        </div>
                    </div>

                    <!-- Footer Area -->
                    <div class="doc-footer-area">
                        <div class="doc-signature-block">
                            <div class="doc-section-head">Authorised Signature</div>
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . ($registration->doctor->signatureRegister->signature)) }}" alt="Signature" class="doc-sig-img">
                            @else
                                <div class="doc-sig-line"></div>
                            @endif
                            <div class="doc-sig-name">{{ $registration->doctor->name ?? 'Dr Sohail Wahid' }}</div>
                            <div class="doc-sig-meta">IMC: {{ $registration->doctor->register_id ?? '427774' }}</div>
                        </div>
                        <div class="text-end text-muted small">
                            <p class="mb-0">Electronically Signed</p>
                            <p class="mb-0">{{ now()->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-5 px-5 d-flex justify-content-end gap-3">
                    <button type="button" class="doc-btn-generate" onclick="generatePDF('EDREFERRALModel')" id="generateBtn_EDREFERRALModel">
                        <i class="bi bi-file-earmark-pdf me-2"></i>GENERATE PDF
                    </button>
                    <button type="button" class="doc-btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </div>
    </div>v>

    <!-- end code second model  -->


    <!-- start code third model  -->


    <!-- Pathology Requisition Modal -->
    <div class="modal fade" id="PATHOLOGYREQUISITIONModel" tabindex="-1" aria-labelledby="PATHOLOGYREQUISITIONModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content doc-modal-content">
                <div class="doc-modal-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title fw-bold" id="PATHOLOGYREQUISITIONModelLabel" style="color: #1e293b;">Pathology Requisition</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="doc-modal-body" id="pathologyLetterContent">
                    <!-- Branding -->
                    <div class="doc-brand">
                        <div class="doc-logo-circle">
                            <i class="bi bi-microscope"></i>
                        </div>
                        <span class="doc-brand-name">Call<span class="doc-brand-tag">Doc</span></span>
                    </div>

                    <!-- Header Strip -->
                    <div class="doc-header-strip">
                        <div class="doc-type-badge">Pathology Request</div>
                        <div class="doc-meta-pills">
                            <div class="doc-meta-pill"><strong>ID:</strong> #{{ $registration->id }}</div>
                            <div class="doc-meta-pill"><strong>Date:</strong> {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('d M, Y') }}</div>
                        </div>
                    </div>

                    <div class="doc-info-grid">
                        <!-- Provider Info -->
                        <div>
                            <div class="doc-section-head"><i class="bi bi-person-badge"></i> Requesting Physician</div>
                            <div class="doc-card">
                                <div class="doc-row">
                                    <div class="doc-label">Name:</div>
                                    <div class="doc-value">{{ $registration->doctor->name ?? 'Dr Sohail Wahid' }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Clinic:</div>
                                    <div class="doc-value">CallDoc Ltd</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Phone:</div>
                                    <div class="doc-value">{{ $registration->doctor->phoneRegister->phone ?? '+353871085185' }}</div>
                                </div>
                                <div class="doc-row mt-2">
                                    <div class="doc-label">Address:</div>
                                    <div class="doc-value" style="font-size: 0.85rem; line-height: 1.4;">{{ $registration->doctor->addressRegister->address ?? '18 BEHAN HOUSE, ARDEN ROAD, TULLAMORE, OFFALY R35 T6C3, IRELAND' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Patient Info -->
                        <div>
                            <div class="doc-section-head"><i class="bi bi-person"></i> Patient Details</div>
                            <div class="doc-card">
                                <div class="doc-row">
                                    <div class="doc-label">Name:</div>
                                    <div class="doc-value">{{ $registration->patient_first_name }} {{ $registration->patient_last_name }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">DOB:</div>
                                    <div class="doc-value">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('d M, Y') : 'N/A' }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Contact:</div>
                                    <div class="doc-value">{{ $registration->mobile ?: 'N/A' }}</div>
                                </div>
                                <div class="doc-row mt-2">
                                    <div class="doc-label">Address:</div>
                                    <div class="doc-value" style="font-size: 0.85rem; line-height: 1.4;">{{ $registration->address ?: 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 15px 20px; color: #475569; font-style: italic;">
                            Dear Pathologist, please perform the investigations as requested below for this patient.
                        </div>
                    </div>

                    <!-- Clinical Editor -->
                    <div class="doc-section-head"><i class="bi bi-card-checklist"></i> Requested Investigations</div>
                    <div class="doc-editor-wrapper">
                        <div class="doc-editor-toolbar">
                            <button type="button" class="doc-toolbar-btn" onclick="document.execCommand('bold', false, null)" title="Bold"><i class="bi bi-type-bold"></i></button>
                            <button type="button" class="doc-toolbar-btn" onclick="document.execCommand('underline', false, null)" title="Underline"><i class="bi bi-type-underline"></i></button>
                            <div class="vr mx-1" style="border-left: 1px solid #e2e8f0; height: 20px; margin: 7px 0;"></div>
                            <button type="button" class="doc-toolbar-btn" onclick="document.execCommand('insertUnorderedList', false, null)" title="Bullets"><i class="bi bi-list-ul"></i></button>
                            <div class="vr mx-1" style="border-left: 1px solid #e2e8f0; height: 20px; margin: 7px 0;"></div>
                            <button type="button" class="doc-toolbar-btn" onclick="document.getElementById('pathologyImageInput').click()" title="Insert Image"><i class="bi bi-image"></i></button>
                            <button type="button" class="doc-toolbar-btn" onclick="document.execCommand('removeFormat', false, null)" title="Clear Formatting"><i class="bi bi-eraser"></i></button>
                        </div>
                        <input type="file" id="pathologyImageInput" accept="image/*" style="display: none;">
                        <div id="pathologyEditor" contenteditable="true" class="doc-editor-area">
                            <p><strong>SPECIMEN TYPE: BLOOD / SWAB / URINE</strong></p>
                            <p class="mb-3">Please perform and report on the following investigations.</p>
                            <p class="mb-4 text-muted">[Specify Test Required]</p>
                            <p class="mt-5"><strong>Clinical note, clinical details must be supplied.</strong></p>
                        </div>
                    </div>

                    <!-- Footer Area -->
                    <div class="doc-footer-area">
                        <div class="doc-signature-block">
                            <div class="doc-section-head">Authorised Signature</div>
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . ($registration->doctor->signatureRegister->signature)) }}" alt="Signature" class="doc-sig-img">
                            @else
                                <div class="doc-sig-line"></div>
                            @endif
                            <div class="doc-sig-name">{{ $registration->doctor->name ?? 'Dr Sohail Wahid' }}</div>
                            <div class="doc-sig-meta">IMC: {{ $registration->doctor->register_id ?? '427774' }}</div>
                        </div>
                        <div class="text-end text-muted small">
                            <p class="mb-0">Electronically Requested</p>
                            <p class="mb-0">{{ now()->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-5 px-5 d-flex justify-content-end gap-3">
                    <button type="button" class="doc-btn-generate" onclick="generatePDF('PATHOLOGYREQUISITIONModel')" id="generateBtn_PATHOLOGYREQUISITIONModel">
                        <i class="bi bi-file-earmark-pdf me-2"></i>GENERATE PDF
                    </button>
                    <button type="button" class="doc-btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end code third model  -->




    <!-- start code fourth model  -->
    <!-- Radiography Referral Modal -->
    <div class="modal fade" id="RADIOGRAPHYREFERREDModel" tabindex="-1" aria-labelledby="RADIOGRAPHYREFERREDModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content doc-modal-content">
                <div class="doc-modal-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title fw-bold" id="RADIOGRAPHYREFERREDModelLabel" style="color: #1e293b;">Radiography Referral</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="doc-modal-body" id="radiographyLetterContent">
                    <!-- Branding -->
                    <div class="doc-brand">
                        <div class="doc-logo-circle">
                            <i class="bi bi-x-diamond-fill"></i>
                        </div>
                        <span class="doc-brand-name">Call<span class="doc-brand-tag">Doc</span></span>
                    </div>

                    <!-- Header Strip -->
                    <div class="doc-header-strip">
                        <div class="doc-type-badge">Radiology Request</div>
                        <div class="doc-meta-pills">
                            <div class="doc-meta-pill"><strong>ID:</strong> #{{ $registration->id }}</div>
                            <div class="doc-meta-pill"><strong>Date:</strong> {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('d M, Y') }}</div>
                        </div>
                    </div>

                    <div class="doc-info-grid">
                        <!-- Provider Info -->
                        <div>
                            <div class="doc-section-head"><i class="bi bi-person-badge"></i> Requesting Physician</div>
                            <div class="doc-card">
                                <div class="doc-row">
                                    <div class="doc-label">Name:</div>
                                    <div class="doc-value">{{ $registration->doctor->name ?? 'Dr Sohail Wahid' }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Clinic:</div>
                                    <div class="doc-value">CallDoc Ltd</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Phone:</div>
                                    <div class="doc-value">{{ $registration->doctor->phoneRegister->phone ?? '+353871085185' }}</div>
                                </div>
                                <div class="doc-row mt-2">
                                    <div class="doc-label">Address:</div>
                                    <div class="doc-value" style="font-size: 0.85rem; line-height: 1.4;">{{ $registration->doctor->addressRegister->address ?? '18 BEHAN HOUSE, ARDEN ROAD, TULLAMORE, OFFALY R35 T6C3, IRELAND' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Patient Info -->
                        <div>
                            <div class="doc-section-head"><i class="bi bi-person"></i> Patient Details</div>
                            <div class="doc-card">
                                <div class="doc-row">
                                    <div class="doc-label">Name:</div>
                                    <div class="doc-value">{{ $registration->patient_first_name }} {{ $registration->patient_last_name }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">DOB:</div>
                                    <div class="doc-value">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('d M, Y') : 'N/A' }}</div>
                                </div>
                                <div class="doc-row">
                                    <div class="doc-label">Contact:</div>
                                    <div class="doc-value">{{ $registration->mobile ?: 'N/A' }}</div>
                                </div>
                                <div class="doc-row mt-2">
                                    <div class="doc-label">Address:</div>
                                    <div class="doc-value" style="font-size: 0.85rem; line-height: 1.4;">{{ $registration->address ?: 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 15px 20px; color: #475569; font-style: italic;">
                            Dear Radiologist, please perform the examinations as requested below for this patient.
                        </div>
                    </div>

                    <!-- Clinical Editor -->
                    <div class="doc-section-head"><i class="bi bi-camera-reels"></i> Radiology Examination Details</div>
                    <div class="doc-editor-wrapper">
                        <div class="doc-editor-toolbar">
                            <button type="button" class="doc-toolbar-btn" onclick="document.execCommand('bold', false, null)" title="Bold"><i class="bi bi-type-bold"></i></button>
                            <button type="button" class="doc-toolbar-btn" onclick="document.execCommand('underline', false, null)" title="Underline"><i class="bi bi-type-underline"></i></button>
                            <div class="vr mx-1" style="border-left: 1px solid #e2e8f0; height: 20px; margin: 7px 0;"></div>
                            <button type="button" class="doc-toolbar-btn" onclick="document.getElementById('radiographyImageInput').click()" title="Insert Image"><i class="bi bi-image"></i></button>
                            <button type="button" class="doc-toolbar-btn" onclick="document.execCommand('removeFormat', false, null)" title="Clear Formatting"><i class="bi bi-eraser"></i></button>
                        </div>
                        <input type="file" id="radiographyImageInput" accept="image/*" style="display: none;">
                        <div id="radiographyEditor" contenteditable="true" class="doc-editor-area">
                            <p><strong>EXAMINATION REQUIRED:</strong> [e.g., Chest X-Ray / MRI Head]</p>
                            <p><strong>CLINICAL INDICATIONS:</strong></p>
                            <p class="mb-4 text-muted">[Specify Clinical Reason for Request]</p>
                            <p><strong>LMP (If Applicable):</strong> [Date]</p>
                            <p class="mt-5"><strong>Clinical note: clinical details must be supplied for radiation safety & interpretation.</strong></p>
                        </div>
                    </div>

                    <!-- Footer Area -->
                    <div class="doc-footer-area">
                        <div class="doc-signature-block">
                            <div class="doc-section-head">Authorised Signature</div>
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . ($registration->doctor->signatureRegister->signature)) }}" alt="Signature" class="doc-sig-img">
                            @else
                                <div class="doc-sig-line"></div>
                            @endif
                            <div class="doc-sig-name">{{ $registration->doctor->name ?? 'Dr Sohail Wahid' }}</div>
                            <div class="doc-sig-meta">IMC: {{ $registration->doctor->register_id ?? '427774' }}</div>
                        </div>
                        <div class="text-end text-muted small">
                            <p class="mb-0">Electronically Signed</p>
                            <p class="mb-0">{{ now()->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-5 px-5 d-flex justify-content-end gap-3">
                    <button type="button" class="doc-btn-generate" onclick="generatePDF('RADIOGRAPHYREFERREDModel')" id="generateBtn_RADIOGRAPHYREFERREDModel">
                        <i class="bi bi-file-earmark-pdf me-2"></i>GENERATE PDF
                    </button>
                    <button type="button" class="doc-btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end code fourth model  -->



    <!-- start code fifth model  -->

    <div class="modal fade" id="OLD_FITTOWORKCERTIFICATEModel" tabindex="-1" aria-labelledby="FITTOWORKCERTIFICATEModel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"
                style="border-radius: 12px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.15); background-color: #fff;">
                <div class="modal-header border-0 pb-0 pe-4 pt-4">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 p-md-5" id="fitToWorkLetterContent">
                    <!-- Logo Header -->
                    <div class="mb-5 d-flex align-items-center">
                        <div style="position: relative; width: 45px; height: 45px;">
                            <div
                                style="width: 45px; height: 45px; background: conic-gradient(#4fd1c5 0%, #4fd1c5 33%, #90cdf4 33%, #90cdf4 66%, #a0aec0 66%, #a0aec0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative;">
                                <div style="width: 30px; height: 30px; background-color: white; border-radius: 50%;"></div>
                                <div
                                    style="width: 8px; height: 8px; background-color: white; border-radius: 50%; position: absolute; bottom: 5px; left: 5px;">
                                </div>
                            </div>
                        </div>
                        <span class="fs-2 fw-bold ms-3" style="color: #4fd1c5; letter-spacing: -0.5px;">CallDoc</span>
                    </div>

                    <!-- Title Box -->
                    <div class="mb-5">
                        <div
                            style="border: 1px solid #ced4da; border-radius: 8px; padding: 10px 20px; display: inline-block; min-width: 400px; max-width: 100%;">
                            <span style="color: #495057; font-size: 1.1rem;">FIT TO WORK CERTIFICATE</span>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <!-- Left: Doctor Info -->
                        <div class="col-md-6 pe-md-4">
                            <h6 class="fw-bold mb-3" style="color: #343a40;">Doctor Info</h6>
                            <div style="color: #6c757d; font-size: 0.95rem; line-height: 1.6;">
                                <p class="mb-1 text-dark fw-bold">{{ $registration->doctor->name ?? 'Dr Sohail Wahid' }}</p>
                                <p class="mb-1">CallDoc Ltd</p>
                                <p class="mb-1">
                                    {{ $registration->doctor->addressRegister->address ?? '18 BEHAN HOUSE, ARDEN ROAD, TULLAMORE, OFFALY R35 T6C3, IRELAND' }}
                                </p>
                                <p class="mb-0">{{ $registration->doctor->phoneRegister->phone ?? '+353871085185' }}</p>
                            </div>
                        </div>

                        <!-- Right: Patient Info -->
                        <div class="col-md-6 ps-md-4">
                            <h6 class="fw-bold mb-3" style="color: #343a40;">Patient Info</h6>
                            <div style="color: #6c757d; font-size: 0.95rem;">
                                <div class="d-flex mb-2">
                                    <span class="fw-bold text-dark" style="width: 80px;">Name:</span>
                                    <span>{{ $registration->patient_first_name }}
                                        {{ $registration->patient_last_name }}</span>
                                </div>
                                <div class="d-flex mb-2">
                                    <span class="fw-bold text-dark" style="width: 80px;">Address:</span>
                                    <span>{{ $registration->address ?: 'N/A' }}</span>
                                </div>
                                <div class="d-flex mb-2">
                                    <span class="fw-bold text-dark" style="width: 80px;">Contact:</span>
                                    <span>{{ $registration->mobile ?: 'N/A' }}</span>
                                </div>
                                <div class="d-flex mb-3">
                                    <span class="fw-bold text-dark" style="width: 80px;">DOB:</span>
                                    <span>{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('M d, y') : 'N/A' }}</span>
                                </div>

                                <div class="mt-4 pt-2">
                                    <span class="fw-bold text-dark">Appointment ID:</span>
                                    <span>{{ $registration->id }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p style="color: #6c757d; font-size: 0.95rem;">Appointment Date:
                            {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('M d, y') }}
                        </p>
                    </div>

                    <!-- Intro Text Box -->
                    <div class="mb-4">
                        <div style="border: 1px solid #ced4da; border-radius: 8px; padding: 12px 20px;">
                            <span style="color: #495057; font-size: 0.95rem;">To whom it may concern, this is a medical
                                certificate of fitness for work for the above named patient.</span>
                        </div>
                    </div>

                    <!-- Tool Editor Section -->
                    <div class="border rounded mb-5" style="overflow: hidden;">
                        <input type="file" id="fitToWorkImageInput" accept="image/*" style="display: none;">
                        <div class="bg-light p-2 border-bottom d-flex align-items-center gap-2 flex-wrap">
                            <div class="btn-group btn-group-sm bg-white border rounded">
                                <button type="button" class="btn btn-light" title="Format Painter"><i
                                        class="bi bi-magic"></i></button>
                                <button type="button" class="btn btn-light"><i class="bi bi-caret-down-fill"
                                        style="font-size: 0.6rem;"></i></button>
                            </div>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('bold', false, null)" title="Bold"><i
                                    class="bi bi-type-bold"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('underline', false, null)" title="Underline"><i
                                    class="bi bi-type-underline"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('removeFormat', false, null)" title="Clear Formatting"><i
                                    class="bi bi-eraser"></i></button>
                            <div class="vr mx-1"></div>
                            <select class="form-select form-select-sm border bg-white" style="width: 110px;"
                                onchange="document.execCommand('fontName', false, this.value)">
                                <option value="Arial">Arial</option>
                                <option value="Segoe UI" selected>Segoe UI</option>
                                <option value="Times New Roman">Times New Roman</option>
                            </select>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('foreColor', false, '#ffc107')" title="Text Color"><i
                                    class="bi bi-fonts text-warning"></i></button>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('insertUnorderedList', false, null)" title="Bullet List"><i
                                    class="bi bi-list-ul"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('insertOrderedList', false, null)" title="Numbered List"><i
                                    class="bi bi-list-ol"></i></button>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('justifyLeft', false, null)" title="Align Left"><i
                                    class="bi bi-justify-left"></i></button>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border" title="Table"><i
                                    class="bi bi-grid-3x3"></i></button>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="let url=prompt('Enter URL'); if(url) document.execCommand('createLink', false, url)"
                                title="Link"><i class="bi bi-link-45deg"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.getElementById('fitToWorkImageInput').click()" title="Insert Image"><i
                                    class="bi bi-image"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border" title="Insert Video"><i
                                    class="bi bi-camera-video"></i></button>
                        </div>
                        <div class="bg-white" style="border-bottom: 1px solid #dee2e6; padding: 5px 10px;">
                            <button type="button" class="btn btn-sm btn-light border"><i
                                    class="bi bi-arrows-fullscreen"></i></button>
                            <button type="button" class="btn btn-sm btn-light border"><i
                                    class="bi bi-code-slash"></i></button>
                            <button type="button" class="btn btn-sm btn-light border"><i
                                    class="bi bi-question-circle"></i></button>
                        </div>
                        <div id="fitToWorkEditor" contenteditable="true" class="form-control border-0 p-4"
                            style="min-height: 300px; font-size: 1rem; color: #333; line-height: 1.6; border-radius: 0; overflow-y: auto;">
                            <p class="mb-4">I hereby certify that I have medically examined the above named patient.</p>
                            <p class="mb-4">In my opinion, they are <strong>FIT</strong> to resume work duties as of
                                <strong>{{ date('d M, Y') }}</strong>.
                            </p>
                            <p class="mb-3"><strong>Additional Notes:</strong></p>
                            <p class="mb-4 text-muted">[Specify any restrictions or special requirements]</p>
                        </div>
                    </div>

                    <!-- Sign-off Section -->
                    <div class="mt-5">
                        <p class="mb-1" style="color: #6c757d;">Thanks,</p>
                        <p class="mb-4" style="color: #6c757d;">Your Sincerely</p>

                        <div class="mt-4">
                            <p class="mb-1 small" style="color: #adb5bd;">Signed</p>
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                    alt="Signature" style="max-height: 100px; margin-bottom: 5px;">
                            @else
                                <div style="height: 80px; width: 250px; border-bottom: 2px solid #f1f3f5; margin-bottom: 15px;">
                                </div>
                            @endif
                            <p class="mb-0 fw-bold text-dark">{{ $registration->doctor->name ?? 'Dr Sohail Wahid' }}</p>
                            <p class="mb-0 small" style="color: #6c757d;">IMC:
                                {{ $registration->doctor->register_id ?? '427774' }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Controls -->
                <div class="modal-footer border-0 p-4 pe-5 pb-5 d-flex justify-content-end gap-3">
                    <button type="button" class="btn text-white fw-bold px-5 py-2"
                        onclick="generatePDF('FITTOWORKCERTIFICATEModel')" id="generateBtn_FITTOWORKCERTIFICATEModel"
                        style="background-color: #d81b60; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px;">GENERATE</button>
                    <button type="button" class="btn btn-light fw-bold px-5 py-2" data-bs-dismiss="modal"
                        style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px; color: #6c757d;">CANCEL</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end code fifth model  -->



    <!-- start sixth model  -->


    <div class="modal fade" id="OLD_MEDICALCERTIFICATEModel" tabindex="-1" aria-labelledby="MEDICALCERTIFICATEModel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"
                style="border-radius: 12px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.15); background-color: #fff;">
                <div class="modal-header border-0 pb-0 pe-4 pt-4">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 p-md-5" id="medicalLetterContent">
                    <!-- Logo Header -->
                    <div class="mb-5 d-flex align-items-center">
                        <div style="position: relative; width: 45px; height: 45px;">
                            <div
                                style="width: 45px; height: 45px; background: conic-gradient(#4fd1c5 0%, #4fd1c5 33%, #90cdf4 33%, #90cdf4 66%, #a0aec0 66%, #a0aec0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative;">
                                <div style="width: 30px; height: 30px; background-color: white; border-radius: 50%;"></div>
                                <div
                                    style="width: 8px; height: 8px; background-color: white; border-radius: 50%; position: absolute; bottom: 5px; left: 5px;">
                                </div>
                            </div>
                        </div>
                        <span class="fs-2 fw-bold ms-3" style="color: #4fd1c5; letter-spacing: -0.5px;">CallDoc</span>
                    </div>

                    <!-- Title Box -->
                    <div class="mb-5">
                        <div
                            style="border: 1px solid #ced4da; border-radius: 8px; padding: 10px 20px; display: inline-block; min-width: 400px; max-width: 100%;">
                            <span style="color: #495057; font-size: 1.1rem;">MEDICAL CERTIFICATE</span>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <!-- Left: Doctor Info -->
                        <div class="col-md-6 pe-md-4">
                            <h6 class="fw-bold mb-3" style="color: #343a40;">Doctor Info</h6>
                            <div style="color: #6c757d; font-size: 0.95rem; line-height: 1.6;">
                                <p class="mb-1 text-dark fw-bold">{{ $registration->doctor->name ?? 'Dr Sohail Wahid' }}</p>
                                <p class="mb-1">CallDoc Ltd</p>
                                <p class="mb-1">
                                    {{ $registration->doctor->addressRegister->address ?? '18 BEHAN HOUSE, ARDEN ROAD, TULLAMORE, OFFALY R35 T6C3, IRELAND' }}
                                </p>
                                <p class="mb-0">{{ $registration->doctor->phoneRegister->phone ?? '+353871085185' }}</p>
                            </div>
                        </div>

                        <!-- Right: Patient Info -->
                        <div class="col-md-6 ps-md-4">
                            <h6 class="fw-bold mb-3" style="color: #343a40;">Patient Info</h6>
                            <div style="color: #6c757d; font-size: 0.95rem;">
                                <div class="d-flex mb-2">
                                    <span class="fw-bold text-dark" style="width: 80px;">Name:</span>
                                    <span>{{ $registration->patient_first_name }}
                                        {{ $registration->patient_last_name }}</span>
                                </div>
                                <div class="d-flex mb-2">
                                    <span class="fw-bold text-dark" style="width: 80px;">Address:</span>
                                    <span>{{ $registration->address ?: 'N/A' }}</span>
                                </div>
                                <div class="d-flex mb-2">
                                    <span class="fw-bold text-dark" style="width: 80px;">Contact:</span>
                                    <span>{{ $registration->mobile ?: 'N/A' }}</span>
                                </div>
                                <div class="d-flex mb-3">
                                    <span class="fw-bold text-dark" style="width: 80px;">DOB:</span>
                                    <span>{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('M d, y') : 'N/A' }}</span>
                                </div>

                                <div class="mt-4 pt-2">
                                    <span class="fw-bold text-dark">Appointment ID:</span>
                                    <span>{{ $registration->id }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p style="color: #6c757d; font-size: 0.95rem;">Appointment Date:
                            {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('M d, y') }}
                        </p>
                    </div>

                    <!-- Intro Text Box -->
                    <div class="mb-4">
                        <div style="border: 1px solid #ced4da; border-radius: 8px; padding: 12px 20px;">
                            <span style="color: #495057; font-size: 0.95rem;">To whom it may concern, this is a medical
                                certificate for the above named patient.</span>
                        </div>
                    </div>

                    <!-- Tool Editor Section -->
                    <div class="border rounded mb-5" style="overflow: hidden;">
                        <input type="file" id="medicalImageInput" accept="image/*" style="display: none;">
                        <div class="bg-light p-2 border-bottom d-flex align-items-center gap-2 flex-wrap">
                            <div class="btn-group btn-group-sm bg-white border rounded">
                                <button type="button" class="btn btn-light" title="Format Painter"><i
                                        class="bi bi-magic"></i></button>
                                <button type="button" class="btn btn-light"><i class="bi bi-caret-down-fill"
                                        style="font-size: 0.6rem;"></i></button>
                            </div>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('bold', false, null)" title="Bold"><i
                                    class="bi bi-type-bold"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('underline', false, null)" title="Underline"><i
                                    class="bi bi-type-underline"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('removeFormat', false, null)" title="Clear Formatting"><i
                                    class="bi bi-eraser"></i></button>
                            <div class="vr mx-1"></div>
                            <select class="form-select form-select-sm border bg-white" style="width: 110px;"
                                onchange="document.execCommand('fontName', false, this.value)">
                                <option value="Arial">Arial</option>
                                <option value="Segoe UI" selected>Segoe UI</option>
                                <option value="Times New Roman">Times New Roman</option>
                            </select>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('foreColor', false, '#ffc107')" title="Text Color"><i
                                    class="bi bi-fonts text-warning"></i></button>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('insertUnorderedList', false, null)" title="Bullet List"><i
                                    class="bi bi-list-ul"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('insertOrderedList', false, null)" title="Numbered List"><i
                                    class="bi bi-list-ol"></i></button>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('justifyLeft', false, null)" title="Align Left"><i
                                    class="bi bi-justify-left"></i></button>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border" title="Table"><i
                                    class="bi bi-grid-3x3"></i></button>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="let url=prompt('Enter URL'); if(url) document.execCommand('createLink', false, url)"
                                title="Link"><i class="bi bi-link-45deg"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.getElementById('medicalImageInput').click()" title="Insert Image"><i
                                    class="bi bi-image"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border" title="Insert Video"><i
                                    class="bi bi-camera-video"></i></button>
                        </div>
                        <div class="bg-white" style="border-bottom: 1px solid #dee2e6; padding: 5px 10px;">
                            <button type="button" class="btn btn-sm btn-light border"><i
                                    class="bi bi-arrows-fullscreen"></i></button>
                            <button type="button" class="btn btn-sm btn-light border"><i
                                    class="bi bi-code-slash"></i></button>
                            <button type="button" class="btn btn-sm btn-light border"><i
                                    class="bi bi-question-circle"></i></button>
                        </div>
                        <div id="medicalEditor" contenteditable="true" class="form-control border-0 p-4"
                            style="min-height: 300px; font-size: 1rem; color: #333; line-height: 1.6; border-radius: 0; overflow-y: auto;">
                            <p class="mb-4">I hereby certify that I have medically examined the above named patient on this
                                date.</p>
                            <p class="mb-4"><strong>DIAGNOSIS / CLINICAL FINDINGS:</strong></p>
                            <p class="mb-4 text-muted">[Enter clinical details here]</p>
                            <p class="mb-4">They are advised to rest for <strong>[Number]</strong> days starting from
                                <strong>{{ date('d M, Y') }}</strong>.
                            </p>
                            <p class="mt-5"><strong>Doctor's Remarks:</strong></p>
                        </div>
                    </div>

                    <!-- Sign-off Section -->
                    <div class="mt-5">
                        <p class="mb-1" style="color: #6c757d;">Thanks,</p>
                        <p class="mb-4" style="color: #6c757d;">Your Sincerely</p>

                        <div class="mt-4">
                            <p class="mb-1 small" style="color: #adb5bd;">Signed</p>
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                    alt="Signature" style="max-height: 100px; margin-bottom: 5px;">
                            @else
                                <div style="height: 80px; width: 250px; border-bottom: 2px solid #f1f3f5; margin-bottom: 15px;">
                                </div>
                            @endif
                            <p class="mb-0 fw-bold text-dark">{{ $registration->doctor->name ?? 'Dr Sohail Wahid' }}</p>
                            <p class="mb-0 small" style="color: #6c757d;">IMC:
                                {{ $registration->doctor->register_id ?? '427774' }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Controls -->
                <div class="modal-footer border-0 p-4 pe-5 pb-5 d-flex justify-content-end gap-3">
                    <button type="button" class="btn text-white fw-bold px-5 py-2"
                        onclick="generatePDF('MEDICALCERTIFICATEModel')" id="generateBtn_MEDICALCERTIFICATEModel"
                        style="background-color: #d81b60; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px;">GENERATE</button>
                    <button type="button" class="btn btn-light fw-bold px-5 py-2" data-bs-dismiss="modal"
                        style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px; color: #6c757d;">CANCEL</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end sixth model  -->


    <!-- start code seven model -->

    <div class="modal fade" id="OLD_SPECIALISTREFERRALModel" tabindex="-1" aria-labelledby="SPECIALISTREFERRALModel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"
                style="border-radius: 12px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.15); background-color: #fff;">
                <div class="modal-header border-0 pb-0 pe-4 pt-4">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 p-md-5" id="specialistReferralLetterContent">
                    <!-- Logo Header -->
                    <div class="mb-5 d-flex align-items-center">
                        <div style="position: relative; width: 45px; height: 45px;">
                            <div
                                style="width: 45px; height: 45px; background: conic-gradient(#4fd1c5 0%, #4fd1c5 33%, #90cdf4 33%, #90cdf4 66%, #a0aec0 66%, #a0aec0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative;">
                                <div style="width: 30px; height: 30px; background-color: white; border-radius: 50%;"></div>
                                <div
                                    style="width: 8px; height: 8px; background-color: white; border-radius: 50%; position: absolute; bottom: 5px; left: 5px;">
                                </div>
                            </div>
                        </div>
                        <span class="fs-2 fw-bold ms-3" style="color: #4fd1c5; letter-spacing: -0.5px;">CallDoc</span>
                    </div>

                    <!-- Title Box -->
                    <div class="mb-5">
                        <div
                            style="border: 1px solid #ced4da; border-radius: 8px; padding: 10px 20px; display: inline-block; min-width: 400px; max-width: 100%;">
                            <span style="color: #495057; font-size: 1.1rem;">SPECIALIST REFERRAL</span>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <!-- Left: Doctor Info -->
                        <div class="col-md-6 pe-md-4">
                            <h6 class="fw-bold mb-3" style="color: #343a40;">Doctor Info</h6>
                            <div style="color: #6c757d; font-size: 0.95rem; line-height: 1.6;">
                                <p class="mb-1 text-dark fw-bold">{{ $registration->doctor->name ?? 'Dr Sohail Wahid' }}</p>
                                <p class="mb-1">CallDoc Ltd</p>
                                <p class="mb-1">
                                    {{ $registration->doctor->addressRegister->address ?? '18 BEHAN HOUSE, ARDEN ROAD, TULLAMORE, OFFALY R35 T6C3, IRELAND' }}
                                </p>
                                <p class="mb-0">{{ $registration->doctor->phoneRegister->phone ?? '+353871085185' }}</p>
                            </div>
                        </div>

                        <!-- Right: Patient Info -->
                        <div class="col-md-6 ps-md-4">
                            <h6 class="fw-bold mb-3" style="color: #343a40;">Patient Info</h6>
                            <div style="color: #6c757d; font-size: 0.95rem;">
                                <div class="d-flex mb-2">
                                    <span class="fw-bold text-dark" style="width: 80px;">Name:</span>
                                    <span>{{ $registration->patient_first_name }}
                                        {{ $registration->patient_last_name }}</span>
                                </div>
                                <div class="d-flex mb-2">
                                    <span class="fw-bold text-dark" style="width: 80px;">Address:</span>
                                    <span>{{ $registration->address ?: 'N/A' }}</span>
                                </div>
                                <div class="d-flex mb-2">
                                    <span class="fw-bold text-dark" style="width: 80px;">Contact:</span>
                                    <span>{{ $registration->mobile ?: 'N/A' }}</span>
                                </div>
                                <div class="d-flex mb-3">
                                    <span class="fw-bold text-dark" style="width: 80px;">DOB:</span>
                                    <span>{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('M d, y') : 'N/A' }}</span>
                                </div>

                                <div class="mt-4 pt-2">
                                    <span class="fw-bold text-dark">Appointment ID:</span>
                                    <span>{{ $registration->id }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p style="color: #6c757d; font-size: 0.95rem;">Appointment Date:
                            {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('M d, y') }}
                        </p>
                    </div>

                    <!-- Intro Text Box -->
                    <div class="mb-4">
                        <div style="border: 1px solid #ced4da; border-radius: 8px; padding: 12px 20px;">
                            <span style="color: #495057; font-size: 0.95rem;">Dear Colleague, I am referring this patient
                                for further specialist consultation and management as detailed below.</span>
                        </div>
                    </div>

                    <!-- Tool Editor Section -->
                    <div class="border rounded mb-5" style="overflow: hidden;">
                        <input type="file" id="specialistReferralImageInput" accept="image/*" style="display: none;">
                        <div class="bg-light p-2 border-bottom d-flex align-items-center gap-2 flex-wrap">
                            <div class="btn-group btn-group-sm bg-white border rounded">
                                <button type="button" class="btn btn-light" title="Format Painter"><i
                                        class="bi bi-magic"></i></button>
                                <button type="button" class="btn btn-light"><i class="bi bi-caret-down-fill"
                                        style="font-size: 0.6rem;"></i></button>
                            </div>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('bold', false, null)" title="Bold"><i
                                    class="bi bi-type-bold"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('underline', false, null)" title="Underline"><i
                                    class="bi bi-type-underline"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('removeFormat', false, null)" title="Clear Formatting"><i
                                    class="bi bi-eraser"></i></button>
                            <div class="vr mx-1"></div>
                            <select class="form-select form-select-sm border bg-white" style="width: 110px;"
                                onchange="document.execCommand('fontName', false, this.value)">
                                <option value="Arial">Arial</option>
                                <option value="Segoe UI" selected>Segoe UI</option>
                                <option value="Times New Roman">Times New Roman</option>
                            </select>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('foreColor', false, '#ffc107')" title="Text Color"><i
                                    class="bi bi-fonts text-warning"></i></button>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('insertUnorderedList', false, null)" title="Bullet List"><i
                                    class="bi bi-list-ul"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('insertOrderedList', false, null)" title="Numbered List"><i
                                    class="bi bi-list-ol"></i></button>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.execCommand('justifyLeft', false, null)" title="Align Left"><i
                                    class="bi bi-justify-left"></i></button>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border" title="Table"><i
                                    class="bi bi-grid-3x3"></i></button>
                            <div class="vr mx-1"></div>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="let url=prompt('Enter URL'); if(url) document.execCommand('createLink', false, url)"
                                title="Link"><i class="bi bi-link-45deg"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border"
                                onclick="document.getElementById('specialistReferralImageInput').click()"
                                title="Insert Image"><i class="bi bi-image"></i></button>
                            <button type="button" class="btn btn-sm btn-light bg-white border" title="Insert Video"><i
                                    class="bi bi-camera-video"></i></button>
                        </div>
                        <div class="bg-white" style="border-bottom: 1px solid #dee2e6; padding: 5px 10px;">
                            <button type="button" class="btn btn-sm btn-light border"><i
                                    class="bi bi-arrows-fullscreen"></i></button>
                            <button type="button" class="btn btn-sm btn-light border"><i
                                    class="bi bi-code-slash"></i></button>
                            <button type="button" class="btn btn-sm btn-light border"><i
                                    class="bi bi-question-circle"></i></button>
                        </div>
                        <div id="specialistReferralEditor" contenteditable="true" class="form-control border-0 p-4"
                            style="min-height: 300px; font-size: 1rem; color: #333; line-height: 1.6; border-radius: 0; overflow-y: auto;">
                            <p class="mb-4"><strong>REASON FOR REFERRAL:</strong></p>
                            <p class="mb-4 text-muted">[Enter detailed reason for referral]</p>
                            <p class="mb-4"><strong>CLINICAL FINDINGS & HISTORY:</strong></p>
                            <p class="mb-4 text-muted">[Enter clinical findings and relevant history]</p>
                            <p class="mt-5"><strong>Doctor's Notes:</strong></p>
                        </div>
                    </div>

                    <!-- Sign-off Section -->
                    <div class="mt-5">
                        <p class="mb-1" style="color: #6c757d;">Thanks,</p>
                        <p class="mb-4" style="color: #6c757d;">Your Sincerely</p>

                        <div class="mt-4">
                            <p class="mb-1 small" style="color: #adb5bd;">Signed</p>
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                    alt="Signature" style="max-height: 100px; margin-bottom: 5px;">
                            @else
                                <div style="height: 80px; width: 250px; border-bottom: 2px solid #f1f3f5; margin-bottom: 15px;">
                                </div>
                            @endif
                            <p class="mb-0 fw-bold text-dark">{{ $registration->doctor->name ?? 'Dr Sohail Wahid' }}</p>
                            <p class="mb-0 small" style="color: #6c757d;">IMC:
                                {{ $registration->doctor->register_id ?? '427774' }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Controls -->
                <div class="modal-footer border-0 p-4 pe-5 pb-5 d-flex justify-content-end gap-3">
                    <button type="button" class="btn text-white fw-bold px-5 py-2"
                        onclick="generatePDF('SPECIALISTREFERRALModel')" id="generateBtn_SPECIALISTREFERRALModel"
                        style="background-color: #d81b60; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px;">GENERATE</button>
                    <button type="button" class="btn btn-light fw-bold px-5 py-2" data-bs-dismiss="modal"
                        style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px; color: #6c757d;">CANCEL</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end code seven model -->


    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Handle doctor selection changes
                const doctorSelects = document.querySelectorAll('.doctor-select');

                doctorSelects.forEach(select => {
                    select.addEventListener('change', function () {
                        const selectedOption = this.options[this.selectedIndex];
                        if (selectedOption.value) {
                            const data = {
                                registerId: selectedOption.getAttribute('data-register-id'),
                                name: selectedOption.getAttribute('data-name'),
                                role: selectedOption.getAttribute('data-role'),
                                phone: selectedOption.getAttribute('data-phone'),
                                address: selectedOption.getAttribute('data-address'),
                                signature: selectedOption.getAttribute('data-signature')
                            };

                            // Update all modals
                            updateModalsDoctorInfo(data);
                        }
                    });
                });

                function updateModalsDoctorInfo(data) {
                    const modals = document.querySelectorAll('.modal');
                    const signatureUrl = data.signature ? `{{ asset('storage/') }}/${data.signature}` : null;

                    modals.forEach(modal => {
                        const doctorInfoCol = modal.querySelector('.col-md-6');
                        if (!doctorInfoCol) return;

                        // Find and update paragraphs
                        const paragraphs = doctorInfoCol.querySelectorAll('p.mb-1');
                        if (paragraphs.length >= 5) {
                            paragraphs[0].innerHTML = `Registration ID: ${data.registerId}`;
                            paragraphs[1].innerHTML = `Name: ${data.name}`;
                            paragraphs[2].innerHTML = `Role: ${data.role}`;
                            paragraphs[3].innerHTML = `Phone No: ${data.phone}`;
                            paragraphs[4].innerHTML = `Address: ${data.address}`;
                        }

                        // Find and update signature
                        const sigDiv = doctorInfoCol.querySelector('.mb-1[style*="display: flex"]');
                        if (sigDiv) {
                            if (signatureUrl) {
                                sigDiv.innerHTML = `<span class="me-2">Signature:</span><img src="${signatureUrl}" alt="Signature" style="max-height: 40px; border-radius: 4px; border: 1px solid #e2e8f0; padding: 2px;">`;
                            } else {
                                sigDiv.innerHTML = `<span class="me-2">Signature:</span>N/A`;
                            }
                        }
                    });
                }
            });

            function generatePDF(modalId) {
                const modal = document.getElementById(modalId);
                // Use specific content container if available for cleaner capture
                const content = modal.querySelector('#referralLetterContent') ||
                    modal.querySelector('#pathologyLetterContent') ||
                    modal.querySelector('#radiographyLetterContent') ||
                    modal.querySelector('#fitToWorkLetterContent') ||
                    modal.querySelector('#medicalLetterContent') ||
                    modal.querySelector('#specialistReferralLetterContent') ||
                    modal.querySelector('.modal-body') ||
                    modal.querySelector('.modal-content');

                if (!content) {
                    alert('Could not find content to generate PDF.');
                    return;
                }

                // 1. Visual Feedback (0.5s feel)
                const btn = document.getElementById(`generateBtn_${modalId}`) || modal.querySelector('button[onclick*="generatePDF"]');
                const originalBtnHtml = btn ? btn.innerHTML : 'GENERATE';
                if (btn) {
                    btn.disabled = true;
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>SUBMITTING...';
                }

                // 2. Prepare content for clean capture (hide toolbars/cursors)
                if (document.activeElement) document.activeElement.blur();
                const toolbars = content.querySelectorAll('.btn-group, .vr, .bg-light.p-2.border-bottom, .bg-white[style*="border-bottom"], select, .bg-white button');
                toolbars.forEach(el => el.style.visibility = 'hidden');

                const opt = {
                    margin: [15, 15],
                    filename: `Document_${modalId.replace('Model', '')}_${Date.now()}.pdf`,
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: {
                        scale: 2,
                        useCORS: true,
                        letterRendering: true,
                        backgroundColor: '#ffffff',
                        scrollY: 0,
                        scrollX: 0
                    },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                    pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
                };

                // 3. Generate and Process (Ensure all data is captured)
                const originalHeight = content.style.height;
                const originalOverflow = content.style.overflow;
                content.style.height = 'auto';
                content.style.overflow = 'visible';

                // Expand all internal editors/textareas to prevent truncation
                const editors = content.querySelectorAll('[contenteditable="true"], .form-control, textarea');
                editors.forEach(ed => {
                    ed.style.height = 'auto';
                    ed.style.overflow = 'visible';
                });

                html2pdf().set(opt).from(content).toPdf().get('pdf').then(function (pdf) {
                    content.style.height = originalHeight;
                    content.style.overflow = originalOverflow;
                    editors.forEach(ed => {
                        ed.style.height = '';
                        ed.style.overflow = 'auto';
                    });
                }).outputPdf('datauristring').then(function (pdfData) {
                    // Restore toolbars immediately
                    toolbars.forEach(el => el.style.visibility = 'visible');
                    if (btn) {
                        btn.disabled = false;
                        btn.innerHTML = originalBtnHtml;
                    }

                    // 4. Instant Download (Fix for "Failed - Forbidden" data URI limits)
                    try {
                        const byteString = atob(pdfData.split(',')[1]);
                        const mimeString = pdfData.split(',')[0].split(':')[1].split(';')[0];
                        const ab = new ArrayBuffer(byteString.length);
                        const ia = new Uint8Array(ab);
                        for (let i = 0; i < byteString.length; i++) {
                            ia[i] = byteString.charCodeAt(i);
                        }
                        const blob = new Blob([ab], {type: mimeString});
                        const url = window.URL.createObjectURL(blob);

                        const link = document.createElement('a');
                        link.href = url;
                        link.download = opt.filename;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        setTimeout(() => window.URL.revokeObjectURL(url), 1000);
                    } catch (e) {
                        console.error('Error creating blob download', e);
                        const link = document.createElement('a');
                        link.href = pdfData;
                        link.download = opt.filename;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }

                    // 5. Determine Certificate Type
                    let certType = 'Certificate';
                    if (modalId === 'EDREFERRALModel') {
                        certType = 'ED Referral';
                    } else if (modalId === 'PATHOLOGYREQUISITIONModel') {
                        certType = 'Pathology Requisition';
                    } else if (modalId === 'RADIOGRAPHYREFERREDModel') {
                        certType = 'Radiography Referral';
                    } else if (modalId === 'MEDICALCERTIFICATEModel') {
                        certType = 'Medical Certificate';
                    } else if (modalId === 'SPECIALISTREFERRALModel') {
                        certType = 'Specialist Referral';
                    } else if (modalId === 'FITTOWORKCERTIFICATEModel') {
                        certType = 'Fit to Work Certificate';
                    } else {
                        const modalTitle = modal.querySelector('.modal-title') || modal.querySelector('h6');
                        if (modalTitle) certType = modalTitle.innerText.trim();
                    }

                    // 6. Save to Backend via AJAX (No reload)
                    fetch('{{ route("admin.certificate.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            patient_registration_id: '{{ $registration->id }}',
                            type: certType,
                            pdf_data: pdfData,
                            original_name: opt.filename
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // 7. Dynamic UI Refresh
                                const rowDiv = document.getElementById('certificate-list');
                                if (rowDiv) {
                                    if (rowDiv.querySelector('.placeholder-text')) rowDiv.innerHTML = '';

                                    const previewContainer = document.createElement('div');
                                    previewContainer.className = 'col-lg-3 col-md-4 col-sm-6 mb-4';
                                    previewContainer.innerHTML = `
                                                                                                                                                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; background: #fff; overflow: hidden;">
                                                                                                                                                                <div class="card-body p-4 text-center">
                                                                                                                                                                    <div class="mb-3 d-flex justify-content-center">
                                                                                                                                                                        <a href="${data.certificate.url}" download="${data.certificate.original_name}" class="text-decoration-none">
                                                                                                                                                                            <div style="width: 80px; height: 80px; background-color: #fff5f5; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s; cursor: pointer; border: 1.5px solid #ffe6e6;" 
                                                                                                                                                                                 onmouseover="this.style.backgroundColor='#ffe6e6'" onmouseout="this.style.backgroundColor='#fff5f5'">
                                                                                                                                                                                <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size: 2.5rem;"></i>
                                                                                                                                                                            </div>
                                                                                                                                                                        </a>
                                                                                                                                                                    </div>

                                                                                                                                                                    <!-- Title & Filename -->
                                                                                                                                                                    <h6 class="fw-bold mb-1 text-truncate" style="color: #1a202c; font-size: 1.1rem; letter-spacing: -0.02em;">${data.certificate.type}</h6>
                                                                                                                                                                    <p class="text-muted small mb-4 text-truncate px-2" style="font-size: 0.8rem; opacity: 0.8;">${data.certificate.original_name}</p>

                                                                                                                                                                    <!-- Action Buttons -->
                                                                                                                                                                    <div class="d-flex justify-content-center gap-3">
                                                                                                                                                                        <!-- View Button -->
                                                                                                                                                                        <a href="${data.certificate.url}" target="_blank" 
                                                                                                                                                                           class="btn d-flex flex-column align-items-center justify-content-center" 
                                                                                                                                                                           style="width: 65px; height: 65px; border: 1.5px solid #0061ff; border-radius: 50%; color: #0061ff; background: #fff; padding: 0; transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                                                                                                                                                                            <i class="bi bi-eye" style="font-size: 1.4rem; line-height: 1;"></i>
                                                                                                                                                                            <span style="font-size: 0.7rem; font-weight: 700; margin-top: 2px;">View</span>
                                                                                                                                                                        </a>

                                                                                                                                                                        <!-- Save Button -->
                                                                                                                                                                        <a href="${data.certificate.url}" download="${data.certificate.original_name}" 
                                                                                                                                                                           class="btn d-flex flex-column align-items-center justify-content-center" 
                                                                                                                                                                           style="width: 65px; height: 65px; background: linear-gradient(135deg, #0061ff 0%, #00c6ff 100%); border-radius: 50%; color: white; padding: 0; border: none; transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 4px 15px rgba(0, 97, 255, 0.3);">
                                                                                                                                                                            <i class="bi bi-download" style="font-size: 1.4rem; line-height: 1;"></i>
                                                                                                                                                                            <span style="font-size: 0.7rem; font-weight: 700; margin-top: 2px;">Save</span>
                                                                                                                                                                        </a>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                            </div>
                                                                                                                                                        `;
                                    rowDiv.prepend(previewContainer);
                                }

                                // 8. Final Transitions (Snappy closure)
                                const certTabElement = document.getElementById('certificate-tab');
                                if (certTabElement) {
                                    const tab = new bootstrap.Tab(certTabElement);
                                    tab.show();
                                }

                                const modalInstance = bootstrap.Modal.getInstance(modal);
                                if (modalInstance) {
                                    setTimeout(() => modalInstance.hide(), 300); // 0.3s snappy delay for transition
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error saving certificate:', error);
                            if (btn) btn.innerHTML = originalBtnHtml;
                        });
                });
            }

            // Certification Modals Image Handlers
            ['referral', 'pathology', 'radiography', 'fitToWork', 'medical', 'specialistReferral'].forEach(type => {
                document.getElementById(`${type}ImageInput`)?.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (event) {
                            const img = document.createElement('img');
                            img.src = event.target.result;
                            img.style.maxWidth = '100%';
                            img.style.height = 'auto';
                            img.style.borderRadius = '8px';
                            img.style.marginTop = '15px';
                            img.style.marginBottom = '15px';
                            img.className = 'certificate-attached-image';

                            const editor = document.getElementById(`${type}Editor`);
                            if (editor) {
                                editor.focus();
                                const selection = window.getSelection();
                                if (selection.rangeCount > 0 && selection.anchorNode && editor.contains(selection.anchorNode)) {
                                    const range = selection.getRangeAt(0);
                                    range.insertNode(img);
                                    range.collapse(false);
                                } else {
                                    editor.appendChild(img);
                                }
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });

            // Add photo from gallery to referral tool
            window.addPhotoToReferral = function (imgUrl) {
                const editor = document.getElementById('referralEditor');
                if (!editor) {
                    const modalEl = document.getElementById('EDREFERRALModel');
                    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                    modal.show();
                    setTimeout(() => {
                        const newEditor = document.getElementById('referralEditor');
                        if (newEditor) insertImageToEditor(newEditor, imgUrl);
                    }, 500);
                } else {
                    insertImageToEditor(editor, imgUrl);
                }
                function insertImageToEditor(editorElem, url) {
                    const img = document.createElement('img');
                    img.src = url;
                    img.style.maxWidth = '100%';
                    img.style.height = 'auto';
                    img.style.borderRadius = '8px';
                    img.style.marginTop = '15px';
                    img.style.marginBottom = '15px';
                    img.className = 'referral-attached-image';
                    editorElem.appendChild(img);
                    editorElem.focus();
                }
            };
        </script>
        <script src="{{ asset('js/prescription-data.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const drugSearch = document.getElementById('drugSearch');
                const drugSearchResults = document.getElementById('drugSearchResults');
                const drugInstructions = document.getElementById('drugInstructions');
                const saveDrugBtn = document.getElementById('saveDrugBtn');
                const prescribedDrugsBody = document.getElementById('prescribedDrugsBody');
                let selectedDrug = null;
                let savedPrescriptions = [];

                const doctorName = "{{ $registration->doctor->name ?? 'N/A' }}";
                const registrationId = "{{ $registration->id }}";

                // Check if drugData is loaded
                if (typeof drugData === 'undefined') {
                    console.error('drugData is not defined. Make sure prescription-data.js is loaded.');
                    return;
                }

                function addPrescriptionRowToTable(prescription) {
                    const tr = document.createElement('tr');
                    tr.className = 'border-bottom';
                    tr.dataset.id = prescription.id;
                    
                    // Format date
                    const date = new Date(prescription.created_at);
                    const dateString = date.toLocaleDateString('en-GB', { 
                        day: '2-digit', month: 'short', year: 'numeric',
                        hour: '2-digit', minute: '2-digit'
                    });

                    tr.innerHTML = `
                        <td class="py-3">
                            <span class="small fw-bold text-dark d-block">${doctorName}</span>
                            <span class="small text-muted d-block" style="font-size: 0.75rem; margin-top: 2px;"><strong>Medication:</strong> ${prescription.drug_name}</span>
                            <span class="small text-muted d-block" style="font-size: 0.7rem; margin-top: 1px; opacity: 0.8;">${prescription.dosage_instructions.replace(/\n/g, '<br>')}</span>
                        </td>
                        <td class="py-3">
                            <span class="small text-dark d-block fw-medium" style="font-size: 0.75rem;">${dateString}</span>
                        </td>
                        <td class="py-3 text-end">
                            <div class="d-flex gap-3 justify-content-end align-items-center">
                                <a href="#" class="text-info download-prescription" title="Download Prescription" style="font-size: 1.15rem;"><i class="bi bi-file-earmark-pdf-fill"></i></a>
                                <a href="#" class="text-success" title="View Details" style="font-size: 1.1rem;"><i class="bi bi-eye"></i></a>
                                <button class="btn btn-link text-danger p-0 delete-drug" data-id="${prescription.id}" title="Delete" style="font-size: 1.1rem;"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    `;

                    prescribedDrugsBody.appendChild(tr);
                    savedPrescriptions.push(prescription);

                    // Add download functionality
                    tr.querySelector('.download-prescription').addEventListener('click', function(e) {
                        e.preventDefault();
                        downloadPrescription(prescription.id);
                    });

                    // Add delete functionality
                    tr.querySelector('.delete-drug').addEventListener('click', function() {
                        const id = this.dataset.id;
                        if (confirm('Are you sure you want to delete this prescription?')) {
                            fetch(`/doctor/prescription/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    tr.remove();
                                } else {
                                    alert('Failed to delete prescription');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred while deleting');
                            });
                        }
                    });
                }

                // Load existing prescriptions
                @if(isset($registration->prescriptions))
                    @foreach($registration->prescriptions as $p)
                        addPrescriptionRowToTable({
                            id: "{{ $p->id }}",
                            drug_name: `{!! addslashes($p->drug_name) !!}`,
                            dosage_instructions: `{!! addslashes($p->dosage_instructions) !!}`,
                            created_at: "{{ $p->created_at }}"
                        });
                    @endforeach
                @endif

                function populateDrugs(filter = '') {
                    const filteredDrugs = drugData.filter(drug => 
                        drug.name.toLowerCase().includes(filter.toLowerCase())
                    ).slice(0, 300); 

                    drugSearchResults.innerHTML = '';

                    if (filteredDrugs.length === 0) {
                        drugSearchResults.innerHTML = '<div class="list-group-item text-muted small p-2">No matching drugs found</div>';
                        drugSearchResults.style.display = 'block';
                        return;
                    }

                    filteredDrugs.forEach(drug => {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = 'list-group-item list-group-item-action border-0 py-2 px-3 small';
                        btn.style.fontSize = '0.85rem';
                        btn.textContent = drug.name;
                        btn.addEventListener('click', function() {
                            selectDrug(drug);
                        });
                        drugSearchResults.appendChild(btn);
                    });
                    
                    drugSearchResults.style.display = 'block';
                }

                function selectDrug(drug) {
                    selectedDrug = drug;
                    drugSearch.value = drug.name;
                    
                    const line1 = drug.line1 || '';
                    const desc = drug.desc || '';
                    drugInstructions.value = line1 + (line1 && desc ? "\n\n" : "") + desc;
                    
                    drugSearchResults.style.display = 'none';
                }

                drugSearch.addEventListener('focus', function() {
                    populateDrugs(this.value);
                });

                drugSearch.addEventListener('input', function() {
                    populateDrugs(this.value);
                });

                document.addEventListener('click', function(e) {
                    if (!drugSearch.contains(e.target) && !drugSearchResults.contains(e.target)) {
                        drugSearchResults.style.display = 'none';
                    }
                });

                saveDrugBtn.addEventListener('click', function() {
                    const drugName = drugSearch.value;
                    const instructions = drugInstructions.value;

                    if (!drugName.trim()) {
                        alert('Please search and select a drug.');
                        return;
                    }

                    if (!instructions.trim()) {
                        alert('Please enter dosage instructions.');
                        return;
                    }

                    // Save to database via AJAX
                    fetch('{{ route('doctor.prescription.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            patient_registration_id: registrationId,
                            drug_name: drugName,
                            dosage_instructions: instructions
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            addPrescriptionRowToTable(data.prescription);
                            // Clear inputs
                            drugSearch.value = '';
                            drugInstructions.value = '';
                            selectedDrug = null;
                            drugSearchResults.style.display = 'none';
                        } else {
                            alert('Failed to save prescription: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while saving');
                    });
                });

                // Download icon for initial foam textarea
                const downloadFoamBtn = document.getElementById('downloadFoamBtn');
                if (downloadFoamBtn) {
                    downloadFoamBtn.addEventListener('click', function() {
                        const content = `{!! addslashes($registration->foam_textarea) !!}`;
                        if (!content.trim()) {
                            alert('No data to download.');
                            return;
                        }
                        generatePDFFromText('Initial Prescription Note', content);
                    });
                }

                // Download icon for current textarea
                const downloadCurrentBtn = document.getElementById('downloadCurrentBtn');
                if (downloadCurrentBtn) {
                    downloadCurrentBtn.addEventListener('click', function() {
                        const content = drugInstructions.value;
                        const name = drugSearch.value || 'Prescription Note';
                        if (!content.trim()) {
                            alert('Please enter some instructions first.');
                            return;
                        }
                        generatePDFFromText(name, content);
                    });
                }

                function generatePDFFromText(title, content) {
                    const element = document.createElement('div');
                    element.style.position = 'fixed';
                    element.style.left = '-9999px';
                    element.style.top = '0';
                    element.style.width = '800px';
                    element.style.padding = '40px';
                    element.style.backgroundColor = 'white';
                    element.style.fontFamily = 'Arial, sans-serif';
                    element.style.color = '#333';
                    element.innerHTML = `
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 3px solid #4fd1c5; padding-bottom: 20px;">
                            <!-- Left Logo -->
                            <div style="display: flex; align-items: center;">
                                <div style="width: 45px; height: 45px; background: conic-gradient(#4fd1c5 0%, #4fd1c5 33%, #90cdf4 33%, #90cdf4 66%, #a0aec0 66%, #a0aec0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative;">
                                    <div style="width: 30px; height: 30px; background-color: white; border-radius: 50%;"></div>
                                    <div style="width: 8px; height: 8px; background-color: white; border-radius: 50%; position: absolute; bottom: 5px; left: 5px;"></div>
                                </div>
                                <span style="font-size: 24px; font-weight: bold; color: #4fd1c5; margin-left: 10px;">CallDoc</span>
                            </div>
                            
                            <div style="text-align: center;">
                                <h2 style="margin: 0; color: #2d3748; font-size: 20px; text-transform: uppercase; letter-spacing: 2px;">Prescription Record</h2>
                            </div>

                            <!-- Right Logo -->
                            <div style="display: flex; align-items: center; flex-direction: row-reverse;">
                                <div style="width: 45px; height: 45px; background: conic-gradient(#4fd1c5 0%, #4fd1c5 33%, #90cdf4 33%, #90cdf4 66%, #a0aec0 66%, #a0aec0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative;">
                                    <div style="width: 30px; height: 30px; background-color: white; border-radius: 50%;"></div>
                                    <div style="width: 8px; height: 8px; background-color: white; border-radius: 50%; position: absolute; bottom: 5px; left: 5px;"></div>
                                </div>
                                <span style="font-size: 24px; font-weight: bold; color: #4fd1c5; margin-right: 10px;">CallDoc</span>
                            </div>
                        </div>

                        <div style="margin-bottom: 30px; display: flex; justify-content: space-between;">
                            <div style="width: 50%;">
                                <h4 style="color: #4a5568; margin-bottom: 10px; border-bottom: 1px solid #eee;">Patient Information</h4>
                                <p style="margin: 5px 0;"><strong>Name:</strong> {{ $registration->patient_first_name }} {{ $registration->patient_last_name }}</p>
                                <p style="margin: 5px 0;"><strong>Patient ID:</strong> #{{ $registration->id }}</p>
                            </div>
                            <div style="text-align: right; width: 50%;">
                                <h4 style="color: #4a5568; margin-bottom: 10px; border-bottom: 1px solid #eee;">Doctor Information</h4>
                                <p style="margin: 5px 0;"><strong>Dr.</strong> ${doctorName}</p>
                                <p style="margin: 5px 0;"><strong>Date:</strong> ${new Date().toLocaleString()}</p>
                            </div>
                        </div>

                        <div style="margin-bottom: 40px; min-height: 250px;">
                            <h3 style="color: #2d3748; border-bottom: 1px solid #edf2f7; padding-bottom: 10px; margin-top: 0;">Medication / Instructions</h3>
                            <p style="font-size: 1.15rem; font-weight: bold; color: #1a202c; margin-top: 15px;">${title}</p>
                            <div style="margin-top: 15px; background: #f7fafc; padding: 25px; border-radius: 8px; line-height: 1.7; border-left: 5px solid #4fd1c5; font-size: 1rem;">
                                ${content.replace(/\\n/g, '<br>').replace(/\n/g, '<br>')}
                            </div>
                        </div>

                        <div style="margin-top: 50px; border-top: 1px solid #eee; padding-top: 20px; display: flex; justify-content: space-between;">
                            <div style="width: 60%;">
                                <p style="font-size: 0.85rem; color: #718096; margin: 0;">This is an official clinical document generated by CallDoc.</p>
                                <p style="font-size: 0.85rem; color: #718096; margin: 0;">Verification: www.calldoc.ie/verify</p>
                            </div>
                            <div style="text-align: right; width: 40%;">
                                @if(!empty($registration->doctor->signatureRegister->signature))
                                    <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}" style="max-height: 70px; margin-bottom: 5px;">
                                @endif
                                <p style="margin: 0; font-weight: bold;">Dr. ${doctorName}</p>
                                <p style="margin: 0; font-size: 0.8rem; color: #666;">IMC Registration: {{ $registration->doctor->register_id ?? 'N/A' }}</p>
                            </div>
                        </div>
                    `;

                    document.body.appendChild(element);

                    const opt = {
                        margin: 0.5,
                        filename: `Prescription_${title.replace(/\s+/g, '_')}.pdf`,
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2, useCORS: true, letterRendering: true },
                        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                    };

                    html2pdf().set(opt).from(element).save().then(() => {
                        document.body.removeChild(element);
                    });
                }

                function downloadPrescription(id) {
                    const p = savedPrescriptions.find(item => item.id == id);
                    if (!p) {
                        alert('Prescription data not found.');
                        return;
                    }
                    generatePDFFromText(p.drug_name, p.dosage_instructions);
                }
            });
        </script>
        @include('admins.admin.Certificatecode', ['is_doctor' => false])
    @endpush
@endsection