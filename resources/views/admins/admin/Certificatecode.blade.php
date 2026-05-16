@php
    $doctor = $registration->doctor;
    $doctorName = $doctor->name ?? 'N/A';
    $doctorID = $doctor->register_id ?? 'N/A';
    $doctorPhone = $doctor->phoneRegister->phone ?? 'N/A';
    $doctorAddress = $doctor->addressRegister->address ?? 'N/A';
    $doctorSignature = $doctor->signatureRegister->signature ?? null;
@endphp

<!-- Common CSS for PDF generation -->
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

    /* Professional Certificate Card Styles */
    .cert-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
    }

    .cert-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1) !important;
        border-color: rgba(13, 110, 253, 0.2) !important;
    }

    .download-icon-wrapper {
        transition: all 0.3s ease;
    }

    .hover-overlay:hover .download-icon-wrapper {
        transform: scale(1.1);
        background-color: #0d6efd !important;
    }

    .hover-overlay:hover i.bi-file-earmark-pdf-fill {
        opacity: 0.8;
    }

    .animate-bounce-slow {
        animation: bounce-slow 2s infinite;
    }

    @keyframes bounce-slow {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-3px);
        }
    }
</style>

<!-- Invoice Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 8px; border: none; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
            <div class="modal-header py-3" style="border-bottom: 2px solid #f0f0f0;">
                <h6 class="modal-title fw-bold" id="invoiceModalLabel" style="color: #2b3a55; font-size: 1rem;">Invoice
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-md-5">
                <!-- Logo -->
                <div class="mb-5 d-flex align-items-center">
                    <div
                        style="width: 45px; height: 45px; background: conic-gradient(#4fd1c5 0%, #4fd1c5 33%, #90cdf4 33%, #90cdf4 66%, #a0aec0 66%, #a0aec0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative;">
                        <div style="width: 30px; height: 30px; background-color: white; border-radius: 50%;"></div>
                        <div
                            style="width: 8px; height: 8px; background-color: white; border-radius: 50%; position: absolute; bottom: 5px; left: 5px;">
                        </div>
                    </div>
                    <span class="fs-4 fw-bold ms-2" style="color: #38b2ac; letter-spacing: 0.5px;">CallDoc</span>
                </div>

                <div class="row mb-5">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Doctor Info</h6>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Registration ID:
                            {{ $registration->doctor->register_id ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Name:
                            {{ $registration->doctor->name ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Role:
                            {{ ucfirst($registration->doctor->role ?? 'N/A') }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Phone No:
                            {{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Address:
                            {{ $registration->doctor->addressRegister->address ?? 'N/A' }}
                        </p>
                        <div class="mb-1"
                            style="color: #718096; font-size: 0.9rem; display: flex; align-items: flex-start;">
                            <span class="me-2">Signature:</span>
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . ($registration->doctor->signatureRegister->signature ?? '')) }}"
                                    alt="Signature"
                                    style="max-height: 40px; border-radius: 4px; border: 1px solid #e2e8f0; padding: 2px;">
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Patient Info</h6>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Name:</span>
                            <span style="color: #718096;">{{ $registration->patient_first_name }}
                                {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Address:</span>
                            <span style="color: #718096;">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Appointment ID:</span>
                            <span style="color: #718096;">{{ $registration->id }}</span>
                        </div>
                        <div class="d-flex mb-0" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Invoice ID:</span>
                            <span style="color: #718096;">INV-00{{ $registration->id }}</span>
                        </div>
                    </div>
                </div>

                <div class="mb-4 text-start">
                    <p style="color: #718096; font-size: 0.9rem;">Appointment Date:
                        {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('d M, y') }}
                    </p>
                </div>

                <div class="table-responsive mb-5">
                    <table class="table" style="border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
                        <thead>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <th class="border-0 fw-normal py-3"
                                    style="color: #718096; font-size: 0.9rem; padding-left: 0;">Description</th>
                                <th class="border-0 fw-normal py-3 text-end"
                                    style="color: #718096; font-size: 0.9rem; padding-right: 0;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-0 py-4" style="color: #4a5568; font-size: 0.9rem; padding-left: 0;">
                                    Telephone Consultation - Paid by the Customer Already.</td>
                                <td class="border-0 py-4 text-end"
                                    style="color: #4a5568; font-size: 0.9rem; padding-right: 0;"></td>
                            </tr>
                            <tr style="border-top: 1px solid #e2e8f0;">
                                <td class="border-0 py-3" style="color: #4a5568; font-size: 0.9rem; padding-left: 0;">
                                    Total</td>
                                <td class="border-0 py-3 text-end"
                                    style="color: #4a5568; font-size: 0.9rem; padding-right: 0;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="color: #718096; font-size: 0.85rem;">
                    <p class="mb-1">Thanks for choosing CallDoc!</p>
                    <p class="mb-4">Visit www.calldoc.ie to book an appointment with our doctors</p>
                    <p class="mb-0">All enquires must be directed to billing@calldoc.ie</p>
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0 pb-4 pe-4 pb-md-5 pe-md-5 d-flex justify-content-end gap-2">
                <button type="button" class="btn text-white fw-bold px-4 py-2"
                    onclick="generatePDF(this.closest('.modal').id)"
                    style="background-color: #d81b60; font-size: 0.75rem; border-radius: 6px; letter-spacing: 0.5px;">GENERATE</button>
                <button type="button" class="btn text-white fw-bold px-4 py-2" data-bs-dismiss="modal"
                    style="background-color: #718096; font-size: 0.75rem; border-radius: 6px; letter-spacing: 0.5px;">CANCEL</button>
            </div>
        </div>
    </div>
</div>


<!-- start code second model  -->

<div class="modal fade" id="EDREFERRALModel" tabindex="-1" aria-labelledby="EDREFERRALModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"
            style="border-radius: 12px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.15); background-color: #fff;">
            <div class="modal-header border-0 pb-0 pe-4 pt-4">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-md-5" id="referralLetterContent">
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
                        <span style="color: #495057; font-size: 1.1rem;">ED Referral</span>
                    </div>
                </div>

                <div class="row mb-5">
                    <!-- Left: Doctor Info -->
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Doctor Info</h6>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Registration ID:
                            {{ $registration->doctor->register_id ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Name:
                            {{ $registration->doctor->name ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Role:
                            {{ ucfirst($registration->doctor->role ?? 'Doctor') }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Phone No:
                            {{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Address:
                            {{ $registration->doctor->addressRegister->address ?? 'N/A' }}
                        </p>
                        <div class="mb-1"
                            style="color: #718096; font-size: 0.9rem; display: flex; align-items: flex-start;">
                            <span class="me-2">Signature:</span>
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . ($registration->doctor->signatureRegister->signature ?? '')) }}"
                                    alt="Signature"
                                    style="max-height: 40px; border-radius: 4px; border: 1px solid #e2e8f0; padding: 2px;">
                            @else
                                N/A
                            @endif
                        </div>
                    </div>

                    <!-- Right: Patient Info -->
                    <div class="col-md-6 ps-md-4">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Patient Info</h6>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Name:</span>
                            <span style="color: #718096;">{{ $registration->patient_first_name }}
                                {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Address:</span>
                            <span style="color: #718096;">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Contact:</span>
                            <span style="color: #718096;">{{ $registration->mobile ?: 'N/A' }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">DOB:</span>
                            <span
                                style="color: #718096;">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('M d, y') : 'N/A' }}</span>
                        </div>

                        <div class="d-flex mb-0 mt-3 pt-2" style="font-size: 0.9rem; border-top: 1px dashed #e2e8f0;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Appointment ID:</span>
                            <span style="color: #718096;">{{ $registration->id }}</span>
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
                        <span style="color: #495057; font-size: 0.95rem;">Dear Doctor, I am referring this patient with
                            the following history.</span>
                    </div>
                </div>

                <!-- Tool Editor Section -->
                <div class="border rounded mb-5" style="overflow: hidden;">
                    <input type="file" id="referralImageInput" accept="image/*" style="display: none;">
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
                            onclick="document.getElementById('referralImageInput').click()" title="Insert Image"><i
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
                    <div id="referralEditor" contenteditable="true" class="form-control border-0 p-4"
                        style="min-height: 300px; font-size: 1rem; color: #333; line-height: 1.6; border-radius: 0; overflow-y: auto;">
                        <p class="mb-2"><strong>Past Medical history:</strong></p>
                        <p class="mb-2"><strong>Subjective:</strong></p>
                        <p class="mb-2"><strong>Objective:</strong></p>
                        <p class="mb-2"><strong>Assessment:</strong></p>
                        <p class="mb-2"><strong>Plan:</strong></p>
                        <p class="mt-4">Having accessed this patient, I feel that assessment is necessary and I will be
                            grateful if the patient is seen by your team.</p>
                    </div>
                </div>

                <!-- Sign-off Section -->
                <div class="mt-5">
                    <p class="mb-1" style="color: #6c757d;">Thanks,</p>
                    <p class="mb-4" style="color: #6c757d;">Your s Sincerely</p>

                    <div class="mt-4">
                        <p class="mb-1 small" style="color: #adb5bd;">Signed</p>
                        @if(!empty($registration->doctor->signatureRegister->signature))
                            <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                alt="Signature" style="max-height: 100px; margin-bottom: 5px;">
                        @else
                            <div style="height: 80px; width: 250px; border-bottom: 2px solid #f1f3f5; margin-bottom: 15px;">
                            </div>
                        @endif
                        <p class="mb-0 fw-bold text-dark">{{ $registration->doctor->name ?? 'N/A' }}</p>
                        <p class="mb-0 small" style="color: #6c757d;">IMC:
                            {{ $registration->doctor->register_id ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
            <!-- Controls -->
            <div class="modal-footer border-0 p-4 pe-5 pb-5 d-flex justify-content-end gap-3">
                <button type="button" class="btn text-white fw-bold px-5 py-2" onclick="generatePDF('EDREFERRALModel')"
                    id="generateBtn_EDREFERRALModel"
                    style="background-color: #d81b60; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px;">GENERATE</button>
                <button type="button" class="btn btn-light fw-bold px-5 py-2" data-bs-dismiss="modal"
                    style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px; color: #6c757d;">CANCEL</button>
            </div>
        </div>
    </div>
</div>

<!-- end code second model  -->


<!-- start code third model  -->


<div class="modal fade" id="PATHOLOGYREQUISITIONModel" tabindex="-1" aria-labelledby="PATHOLOGYREQUISITIONModel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"
            style="border-radius: 12px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.15); background-color: #fff;">
            <div class="modal-header border-0 pb-0 pe-4 pt-4">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-md-5" id="pathologyLetterContent">
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
                        <span style="color: #495057; font-size: 1.1rem;">Pathology Requisition</span>
                    </div>
                </div>

                <div class="row mb-5">
                    <!-- Left: Doctor Info -->
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Doctor Info</h6>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Registration ID:
                            {{ $registration->doctor->register_id ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Name:
                            {{ $registration->doctor->name ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Role:
                            {{ ucfirst($registration->doctor->role ?? 'Doctor') }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Phone No:
                            {{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Address:
                            {{ $registration->doctor->addressRegister->address ?? 'N/A' }}
                        </p>
                        <div class="mb-1"
                            style="color: #718096; font-size: 0.9rem; display: flex; align-items: flex-start;">
                            <span class="me-2">Signature:</span>
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . ($registration->doctor->signatureRegister->signature ?? '')) }}"
                                    alt="Signature"
                                    style="max-height: 40px; border-radius: 4px; border: 1px solid #e2e8f0; padding: 2px;">
                            @else
                                N/A
                            @endif
                        </div>
                    </div>

                    <!-- Right: Patient Info -->
                    <div class="col-md-6 ps-md-4">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Patient Info</h6>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Name:</span>
                            <span style="color: #718096;">{{ $registration->patient_first_name }}
                                {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Address:</span>
                            <span style="color: #718096;">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Contact:</span>
                            <span style="color: #718096;">{{ $registration->mobile ?: 'N/A' }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">DOB:</span>
                            <span
                                style="color: #718096;">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('M d, y') : 'N/A' }}</span>
                        </div>

                        <div class="d-flex mb-0 mt-3 pt-2" style="font-size: 0.9rem; border-top: 1px dashed #e2e8f0;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Appointment ID:</span>
                            <span style="color: #718096;">{{ $registration->id }}</span>
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
                        <span style="color: #495057; font-size: 0.95rem;">Dear Pathologist, please perform the
                            investigations as requested below for this patient.</span>
                    </div>
                </div>

                <!-- Tool Editor Section -->
                <div class="border rounded mb-5" style="overflow: hidden;">
                    <input type="file" id="pathologyImageInput" accept="image/*" style="display: none;">
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
                            onclick="document.getElementById('pathologyImageInput').click()" title="Insert Image"><i
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
                    <div id="pathologyEditor" contenteditable="true" class="form-control border-0 p-4"
                        style="min-height: 300px; font-size: 1rem; color: #333; line-height: 1.6; border-radius: 0; overflow-y: auto;">
                        <p class="mb-4"><strong>SPECIMEN TYPE: BLOOD / SWAB / URINE</strong></p>
                        <p class="mb-3">Please perform and report on the following investigations.</p>
                        <p class="mb-4 text-muted">[Specify Test Required]</p>
                        <p class="mt-5"><strong>Clinical note, clinical details must be supplied.</strong></p>
                    </div>
                </div>

                <!-- Sign-off Section -->
                <div class="mt-5">
                    <p class="mb-1" style="color: #6c757d;">Thanks,</p>
                    <p class="mb-4" style="color: #6c757d;">Yours Sincerely</p>

                    <div class="mt-4">
                        <p class="mb-1 small" style="color: #adb5bd;">Signed</p>
                        @if(!empty($registration->doctor->signatureRegister->signature))
                            <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                alt="Signature" style="max-height: 100px; margin-bottom: 5px;">
                        @else
                            <div style="height: 80px; width: 250px; border-bottom: 2px solid #f1f3f5; margin-bottom: 15px;">
                            </div>
                        @endif
                        <p class="mb-0 fw-bold text-dark">{{ $registration->doctor->name ?? 'N/A' }}</p>
                        <p class="mb-0 small" style="color: #6c757d;">IMC:
                            {{ $registration->doctor->register_id ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
            <!-- Controls -->
            <div class="modal-footer border-0 p-4 pe-5 pb-5 d-flex justify-content-end gap-3">
                <button type="button" class="btn text-white fw-bold px-5 py-2"
                    onclick="generatePDF('PATHOLOGYREQUISITIONModel')" id="generateBtn_PATHOLOGYREQUISITIONModel"
                    style="background-color: #d81b60; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px;">GENERATE</button>
                <button type="button" class="btn btn-light fw-bold px-5 py-2" data-bs-dismiss="modal"
                    style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px; color: #6c757d;">CANCEL</button>
            </div>
        </div>
    </div>
</div>
<!-- end code third model  -->




<!-- start code fourth model  -->
<div class="modal fade" id="RADIOGRAPHYREFERREDModel" tabindex="-1" aria-labelledby="RADIOGRAPHYREFERREDModel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"
            style="border-radius: 12px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.15); background-color: #fff;">
            <div class="modal-header border-0 pb-0 pe-4 pt-4">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-md-5" id="radiographyLetterContent">
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
                        <span style="color: #495057; font-size: 1.1rem;">RADIOGRAPHY REFERRED</span>
                    </div>
                </div>

                <div class="row mb-5">
                    <!-- Left: Doctor Info -->
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Doctor Info</h6>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Registration ID:
                            {{ $registration->doctor->register_id ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Name:
                            {{ $registration->doctor->name ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Role:
                            {{ ucfirst($registration->doctor->role ?? 'Doctor') }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Phone No:
                            {{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Address:
                            {{ $registration->doctor->addressRegister->address ?? 'N/A' }}
                        </p>
                        <div class="mb-1"
                            style="color: #718096; font-size: 0.9rem; display: flex; align-items: flex-start;">
                            <span class="me-2">Signature:</span>
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . ($registration->doctor->signatureRegister->signature ?? '')) }}"
                                    alt="Signature"
                                    style="max-height: 40px; border-radius: 4px; border: 1px solid #e2e8f0; padding: 2px;">
                            @else
                                N/A
                            @endif
                        </div>
                    </div>

                    <!-- Right: Patient Info -->
                    <div class="col-md-6 ps-md-4">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Patient Info</h6>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Name:</span>
                            <span style="color: #718096;">{{ $registration->patient_first_name }}
                                {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Address:</span>
                            <span style="color: #718096;">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Contact:</span>
                            <span style="color: #718096;">{{ $registration->mobile ?: 'N/A' }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">DOB:</span>
                            <span
                                style="color: #718096;">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('M d, y') : 'N/A' }}</span>
                        </div>

                        <div class="d-flex mb-0 mt-3 pt-2" style="font-size: 0.9rem; border-top: 1px dashed #e2e8f0;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Appointment ID:</span>
                            <span style="color: #718096;">{{ $registration->id }}</span>
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
                        <span style="color: #495057; font-size: 0.95rem;">Dear Radiologist, please perform the
                            examinations as requested below for this patient.</span>
                    </div>
                </div>

                <!-- Tool Editor Section -->
                <div class="border rounded mb-5" style="overflow: hidden;">
                    <input type="file" id="radiographyImageInput" accept="image/*" style="display: none;">
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
                            onclick="document.getElementById('radiographyImageInput').click()" title="Insert Image"><i
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
                    <div id="radiographyEditor" contenteditable="true" class="form-control border-0 p-4"
                        style="min-height: 300px; font-size: 1rem; color: #333; line-height: 1.6; border-radius: 0; overflow-y: auto;">
                        <p class="mb-4"><strong>EXAMINATION REQUIRED:</strong> [e.g., Chest X-Ray / MRI Head]</p>
                        <p class="mb-4"><strong>CLINICAL INDICATIONS:</strong></p>
                        <p class="mb-4 text-muted">[Specify Clinical Details]</p>
                        <p class="mb-4"><strong>LMP (If Applicable):</strong> [Date]</p>
                        <p class="mt-5"><strong>Clinical note, clinical details must be supplied.</strong></p>
                    </div>
                </div>

                <!-- Sign-off Section -->
                <div class="mt-5">
                    <p class="mb-1" style="color: #6c757d;">Thanks,</p>
                    <p class="mb-4" style="color: #6c757d;">Yours Sincerely</p>

                    <div class="mt-4">
                        <p class="mb-1 small" style="color: #adb5bd;">Signed</p>
                        @if(!empty($registration->doctor->signatureRegister->signature))
                            <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                alt="Signature" style="max-height: 100px; margin-bottom: 5px;">
                        @else
                            <div style="height: 80px; width: 250px; border-bottom: 2px solid #f1f3f5; margin-bottom: 15px;">
                            </div>
                        @endif
                        <p class="mb-0 fw-bold text-dark">{{ $registration->doctor->name ?? 'N/A' }}</p>
                        <p class="mb-0 small" style="color: #6c757d;">IMC:
                            {{ $registration->doctor->register_id ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
            <!-- Controls -->
            <div class="modal-footer border-0 p-4 pe-5 pb-5 d-flex justify-content-end gap-3">
                <button type="button" class="btn text-white fw-bold px-5 py-2"
                    onclick="generatePDF('RADIOGRAPHYREFERREDModel')" id="generateBtn_RADIOGRAPHYREFERREDModel"
                    style="background-color: #d81b60; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px;">GENERATE</button>
                <button type="button" class="btn btn-light fw-bold px-5 py-2" data-bs-dismiss="modal"
                    style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px; color: #6c757d;">CANCEL</button>
            </div>
        </div>
    </div>
</div>
<!-- end code fourth model  -->



<!-- start code fifth model  -->

<div class="modal fade" id="FITTOWORKCERTIFICATEModel" tabindex="-1" aria-labelledby="FITTOWORKCERTIFICATEModel"
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
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Doctor Info</h6>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Registration ID:
                            {{ $registration->doctor->register_id ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Name:
                            {{ $registration->doctor->name ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Role:
                            {{ ucfirst($registration->doctor->role ?? 'Doctor') }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Phone No:
                            {{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Address:
                            {{ $registration->doctor->addressRegister->address ?? 'N/A' }}
                        </p>
                        <div class="mb-1"
                            style="color: #718096; font-size: 0.9rem; display: flex; align-items: flex-start;">
                            <span class="me-2">Signature:</span>
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . ($registration->doctor->signatureRegister->signature ?? '')) }}"
                                    alt="Signature"
                                    style="max-height: 40px; border-radius: 4px; border: 1px solid #e2e8f0; padding: 2px;">
                            @else
                                N/A
                            @endif
                        </div>
                    </div>

                    <!-- Right: Patient Info -->
                    <div class="col-md-6 ps-md-4">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Patient Info</h6>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Name:</span>
                            <span style="color: #718096;">{{ $registration->patient_first_name }}
                                {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Address:</span>
                            <span style="color: #718096;">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Contact:</span>
                            <span style="color: #718096;">{{ $registration->mobile ?: 'N/A' }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">DOB:</span>
                            <span
                                style="color: #718096;">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('M d, y') : 'N/A' }}</span>
                        </div>

                        <div class="d-flex mb-0 mt-3 pt-2" style="font-size: 0.9rem; border-top: 1px dashed #e2e8f0;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Appointment ID:</span>
                            <span style="color: #718096;">{{ $registration->id }}</span>
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
                    <p class="mb-4" style="color: #6c757d;">Yours Sincerely</p>

                    <div class="mt-4">
                        <p class="mb-1 small" style="color: #adb5bd;">Signed</p>
                        @if(!empty($registration->doctor->signatureRegister->signature))
                            <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                alt="Signature" style="max-height: 100px; margin-bottom: 5px;">
                        @else
                            <div style="height: 80px; width: 250px; border-bottom: 2px solid #f1f3f5; margin-bottom: 15px;">
                            </div>
                        @endif
                        <p class="mb-0 fw-bold text-dark">{{ $registration->doctor->name ?? 'N/A' }}</p>
                        <p class="mb-0 small" style="color: #6c757d;">IMC:
                            {{ $registration->doctor->register_id ?? 'N/A' }}
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


<div class="modal fade" id="MEDICALCERTIFICATEModel" tabindex="-1" aria-labelledby="MEDICALCERTIFICATEModel"
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
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Doctor Info</h6>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Registration ID:
                            {{ $registration->doctor->register_id ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Name:
                            {{ $registration->doctor->name ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Role:
                            {{ ucfirst($registration->doctor->role ?? 'Doctor') }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Phone No:
                            {{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Address:
                            {{ $registration->doctor->addressRegister->address ?? 'N/A' }}
                        </p>
                        <div class="mb-1"
                            style="color: #718096; font-size: 0.9rem; display: flex; align-items: flex-start;">
                            <span class="me-2">Signature:</span>
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . ($registration->doctor->signatureRegister->signature ?? '')) }}"
                                    alt="Signature"
                                    style="max-height: 40px; border-radius: 4px; border: 1px solid #e2e8f0; padding: 2px;">
                            @else
                                N/A
                            @endif
                        </div>
                    </div>

                    <!-- Right: Patient Info -->
                    <div class="col-md-6 ps-md-4">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Patient Info</h6>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Name:</span>
                            <span style="color: #718096;">{{ $registration->patient_first_name }}
                                {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Address:</span>
                            <span style="color: #718096;">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Contact:</span>
                            <span style="color: #718096;">{{ $registration->mobile ?: 'N/A' }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">DOB:</span>
                            <span
                                style="color: #718096;">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('M d, y') : 'N/A' }}</span>
                        </div>

                        <div class="d-flex mb-0 mt-3 pt-2" style="font-size: 0.9rem; border-top: 1px dashed #e2e8f0;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Appointment ID:</span>
                            <span style="color: #718096;">{{ $registration->id }}</span>
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
                    <p class="mb-4" style="color: #6c757d;">Yours Sincerely</p>

                    <div class="mt-4">
                        <p class="mb-1 small" style="color: #adb5bd;">Signed</p>
                        @if(!empty($registration->doctor->signatureRegister->signature))
                            <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                alt="Signature" style="max-height: 100px; margin-bottom: 5px;">
                        @else
                            <div style="height: 80px; width: 250px; border-bottom: 2px solid #f1f3f5; margin-bottom: 15px;">
                            </div>
                        @endif
                        <p class="mb-0 fw-bold text-dark">{{ $registration->doctor->name ?? 'N/A' }}</p>
                        <p class="mb-0 small" style="color: #6c757d;">IMC:
                            {{ $registration->doctor->register_id ?? 'N/A' }}
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

<div class="modal fade" id="SPECIALISTREFERRALModel" tabindex="-1" aria-labelledby="SPECIALISTREFERRALModel"
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
                    <div class="col-md-6 mb-4 mb-md-0">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Doctor Info</h6>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Registration ID:
                            {{ $registration->doctor->register_id ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Name:
                            {{ $registration->doctor->name ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Role:
                            {{ ucfirst($registration->doctor->role ?? 'Doctor') }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Phone No:
                            {{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}
                        </p>
                        <p class="mb-1" style="color: #718096; font-size: 0.9rem;">Address:
                            {{ $registration->doctor->addressRegister->address ?? 'N/A' }}
                        </p>
                        <div class="mb-1"
                            style="color: #718096; font-size: 0.9rem; display: flex; align-items: flex-start;">
                            <span class="me-2">Signature:</span>
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . ($registration->doctor->signatureRegister->signature ?? '')) }}"
                                    alt="Signature"
                                    style="max-height: 40px; border-radius: 4px; border: 1px solid #e2e8f0; padding: 2px;">
                            @else
                                N/A
                            @endif
                        </div>
                    </div>

                    <!-- Right: Patient Info -->
                    <div class="col-md-6 ps-md-4">
                        <h6 class="fw-bold mb-3" style="color: #4a5568;">Patient Info</h6>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Name:</span>
                            <span style="color: #718096;">{{ $registration->patient_first_name }}
                                {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Address:</span>
                            <span style="color: #718096;">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Contact:</span>
                            <span style="color: #718096;">{{ $registration->mobile ?: 'N/A' }}</span>
                        </div>
                        <div class="d-flex mb-1" style="font-size: 0.9rem;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">DOB:</span>
                            <span
                                style="color: #718096;">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('M d, y') : 'N/A' }}</span>
                        </div>

                        <div class="d-flex mb-0 mt-3 pt-2" style="font-size: 0.9rem; border-top: 1px dashed #e2e8f0;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Appointment ID:</span>
                            <span style="color: #718096;">{{ $registration->id }}</span>
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
                    <p class="mb-4" style="color: #6c757d;">Yours Sincerely</p>

                    <div class="mt-4">
                        <p class="mb-1 small" style="color: #adb5bd;">Signed</p>
                        @if(!empty($registration->doctor->signatureRegister->signature))
                            <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                alt="Signature" style="max-height: 100px; margin-bottom: 5px;">
                        @else
                            <div style="height: 80px; width: 250px; border-bottom: 2px solid #f1f3f5; margin-bottom: 15px;">
                            </div>
                        @endif
                        <p class="mb-0 fw-bold text-dark">{{ $registration->doctor->name ?? 'N/A' }}</p>
                        <p class="mb-0 small" style="color: #6c757d;">IMC:
                            {{ $registration->doctor->register_id ?? 'N/A' }}
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
<!-- html2pdf Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    function generatePDF(elementId, passedType) {
        const element = document.getElementById(elementId);
        const btn = event.currentTarget || event.target;

        let type = passedType;
        if (!type || typeof type !== 'string') {
            if (elementId === 'invoiceModal') type = 'Invoice';
            else if (elementId === 'EDREFERRALModel') type = 'ED Referral';
            else if (elementId === 'PATHOLOGYREQUISITIONModel') type = 'Pathology Requisition';
            else if (elementId === 'RADIOGRAPHYREFERREDModel') type = 'Radiography Referred';
            else if (elementId === 'FITTOWORKCERTIFICATEModel') type = 'Fit To Work Certificate';
            else if (elementId === 'MEDICALCERTIFICATEModel') type = 'Medical Certificate';
            else if (elementId === 'SPECIALISTREFERRALModel') type = 'Specialist Referral';
            else type = 'Certificate';
        }

        const modalElement = btn.closest('.modal');
        const backdrop = document.querySelector('.modal-backdrop');

        // Hide toolbars and specific UI buttons
        const ignoreElements = element.querySelectorAll('.modal-footer, .btn-close');
        ignoreElements.forEach(el => el.setAttribute('data-html2canvas-ignore', 'true'));

        const editors = element.querySelectorAll('[contenteditable="true"]');
        editors.forEach(editor => {
            if (editor.parentElement) {
                Array.from(editor.parentElement.children).forEach(child => {
                    if (child !== editor) child.setAttribute('data-html2canvas-ignore', 'true');
                });
            }
            // Temporarily strip dynamic scrolling & edits for flawless PDF scraping
            editor.setAttribute('data-original-editable', 'true');
            editor.removeAttribute('contenteditable');
            editor.dataset.originalOverflow = editor.style.overflowY || '';
            editor.style.overflowY = 'visible';
            editor.style.minHeight = 'auto';
            editor.style.height = 'auto';
        });

        // Temporarily bypass fixed modal constraints
        const originalModalStyle = {
            position: modalElement.style.position,
            overflow: modalElement.style.overflow,
            height: modalElement.style.height,
            top: modalElement.style.top,
            left: modalElement.style.left,
            transform: modalElement.style.transform
        };
        modalElement.style.position = 'absolute';
        modalElement.style.overflow = 'visible';
        modalElement.style.height = 'auto';
        modalElement.style.top = '0';
        modalElement.style.left = '0';
        modalElement.style.transform = 'none';

        // Fix Top Empty Space: scroll to top so html2canvas ignores body offset
        const originalScroll = { x: window.scrollX, y: window.scrollY };
        window.scrollTo(0, 0);

        const list = document.getElementById('certificate-list');
        const tempId = 'cert_loading_' + Date.now();

        if (list) {
            const placeholderText = list.querySelector('.placeholder-text');
            if (placeholderText) placeholderText.remove();

            const loadingDiv = document.createElement('div');
            loadingDiv.className = 'col-md-3 mb-3';
            loadingDiv.id = tempId;
            loadingDiv.innerHTML = `
                <div class="card h-100 border-0 shadow-sm cert-card" style="border-radius: 20px; background: #fff; overflow: hidden; border: 1.5px dashed #4fd1c5 !important;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3 d-flex justify-content-center position-relative">
                            <div style="width: 80px; height: 80px; background-color: #f7fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; opacity: 0.8;">
                                <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size: 2.5rem;"></i>
                            </div>
                            <div class="spinner-border text-primary" style="position: absolute; width: 80px; height: 80px; top: 0; left: 50%; margin-left: -40px; border-width: 2.5px;" role="status"></div>
                        </div>
                        <h6 class="fw-bold mb-1 text-truncate" style="color: #2d3748; font-size: 1.1rem; letter-spacing: -0.01em;">${type}</h6>
                        <div class="mt-3">
                            <i class="bi bi-cloud-arrow-down text-primary animate-bounce-slow" style="font-size: 1.2rem; opacity: 0.6;"></i>
                            <span class="d-block small text-muted mt-1 fw-medium" style="font-size: 0.75rem;">Saving to Cloud...</span>
                        </div>
                    </div>
                </div>
            `;
            list.prepend(loadingDiv);

            const certTab = document.getElementById('certificate-tab');
            if (certTab) certTab.click();
        }

        let captureTarget = modalElement.querySelector('.modal-content') || element;

        // Dynamic one-page calculus: perfectly shrink wrap exactly the document height!
        const elementHeight = captureTarget.scrollHeight || captureTarget.offsetHeight;
        const elementWidth = captureTarget.scrollWidth || captureTarget.offsetWidth || 800;
        const heightRatio = elementHeight / elementWidth;

        // We add a tiny 2mm buffer to prevent fractional pixel overflow from pushing a second page
        const singlePagePdfHeight = (210 * heightRatio) + 2;

        const filename = `${type.replace(/\s+/g, '_')}_${new Date().getTime()}.pdf`;
        const opt = {
            margin: 0, // CRITICAL FIX: 0 margin prevents html2pdf from creating an empty 2nd page
            filename: filename,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: {
                scale: 2,
                useCORS: true,
                logging: false,
                letterRendering: true,
                windowHeight: elementHeight,
                scrollY: 0,
                y: 0
            },
            // Using a dynamic array naturally prevents ANY page breaks, guaranteeing 1 continuous page
            jsPDF: { unit: 'mm', format: [210, singlePagePdfHeight], orientation: 'portrait' }
        };

        setTimeout(() => {
            html2pdf().set(opt).from(captureTarget).toPdf().get('pdf').outputPdf('datauristring').then(function (pdfBase64) {

                // Restore Editor states
                editors.forEach(editor => {
                    if (editor.getAttribute('data-original-editable')) {
                        editor.setAttribute('contenteditable', 'true');
                        editor.style.overflowY = editor.dataset.originalOverflow;
                        editor.style.minHeight = '300px';
                        editor.removeAttribute('data-original-editable');
                    }
                });

                modalElement.style.position = originalModalStyle.position;
                modalElement.style.overflow = originalModalStyle.overflow;
                modalElement.style.height = originalModalStyle.height;
                modalElement.style.top = originalModalStyle.top;
                modalElement.style.left = originalModalStyle.left;
                modalElement.style.transform = originalModalStyle.transform;

                window.scrollTo(originalScroll.x, originalScroll.y);

                if (modalElement) {
                    const modalInstance = bootstrap.Modal.getInstance(modalElement);
                    if (modalInstance) modalInstance.hide();

                    modalElement.style.opacity = '';
                    modalElement.style.pointerEvents = '';
                    if (backdrop) backdrop.style.opacity = '';
                }

                // Helper to convert Data URI to Blob for more robust downloads
                function dataUriToBlob(dataUri) {
                    const byteString = atob(dataUri.split(',')[1]);
                    const mimeString = dataUri.split(',')[0].split(':')[1].split(';')[0];
                    const ab = new ArrayBuffer(byteString.length);
                    const ia = new Uint8Array(ab);
                    for (let i = 0; i < byteString.length; i++) {
                        ia[i] = byteString.charCodeAt(i);
                    }
                    return new Blob([ab], { type: mimeString });
                }

                // Native trigger to instantly auto download file using Blob (fixes many browser download errors)
                const pdfBlob = dataUriToBlob(pdfBase64);
                const blobUrl = URL.createObjectURL(pdfBlob);
                const downloadLink = document.createElement('a');
                downloadLink.href = blobUrl;
                downloadLink.download = opt.filename;
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
                // Clean up the URL object after 10 seconds (enough for download to start)
                setTimeout(() => URL.revokeObjectURL(blobUrl), 10000);

                // Start backend storage payload asynchronously
                const storeRoute = "{{ ($is_doctor ?? false) ? route('doctor.certificate.store') : route('admin.certificate.store') }}";
                fetch(storeRoute, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        patient_registration_id: "{{ $registration->patient_registration_id ?? $registration->id ?? '' }}",
                        type: type,
                        pdf_data: pdfBase64,
                        original_name: opt.filename
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const loadingItem = document.getElementById(tempId);
                            if (loadingItem) {
                                const pdfUrl = data.certificate.url;
                                loadingItem.innerHTML = `
                                <div class="card h-100 border-0 shadow-sm cert-card" style="border-radius: 20px; background: #fff; overflow: hidden; position: relative;">
                                    <div class="card-body p-4 text-center">
                                        <div class="mb-4 d-flex justify-content-center">
                                            <a href="${pdfUrl}" download="${data.certificate.original_name}" class="text-decoration-none bg-light p-3 rounded-circle d-inline-block shadow-sm hover-overlay position-relative" style="transition: all 0.3s ease;">
                                                <i class="bi bi-file-earmark-pdf-fill text-danger" style="font-size: 2.8rem; filter: drop-shadow(0 2px 4px rgba(220, 53, 69, 0.2));"></i>
                                                <div class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center download-icon-wrapper shadow-blue" style="width: 32px; height: 32px; border: 2px solid white; transform: translate(6px, 6px);">
                                                    <i class="bi bi-download" style="font-size: 0.9rem;"></i>
                                                </div>
                                            </a>
                                        </div>
                                        
                                        <h6 class="fw-bold mb-1 text-truncate" style="color: #1a202c; font-size: 1.15rem; letter-spacing: -0.0125em;">${data.certificate.type}</h6>
                                        <p class="text-muted small mb-4 text-truncate px-2" style="font-size: 0.8rem; font-weight: 500; opacity: 0.7;">Click icon to download</p>
                                        
                                        <div class="d-grid px-3 pb-2 pt-1 border-top" style="border-color: rgba(0,0,0,0.03) !important;">
                                            <a class="btn btn-link text-decoration-none shadow-none fw-bold p-0 d-flex align-items-center justify-content-center gap-2 mt-3" href="${pdfUrl}" download="${data.certificate.original_name}" style="color: #0d6efd; font-size: 0.85rem; letter-spacing: 0.5px;">
                                                <i class="bi bi-cloud-arrow-down-fill" style="font-size: 1rem;"></i> DOWNLOAD PDF
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            `;
                                loadingItem.id = 'cert_' + data.certificate.id;
                            }
                        }
                    })
                    .catch(err => {
                        console.error('Error saving cert:', err);
                        const loadingItem = document.getElementById(tempId);
                        if (loadingItem) loadingItem.remove();
                    });
            });
        }, 500);
    }
</script>