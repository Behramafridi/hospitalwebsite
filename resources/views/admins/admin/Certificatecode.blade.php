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

    /* Premium Clinical Theme Styles */
    .clinical-document {
        background-color: #FAF8F5 !important;
        font-family: 'Georgia', 'Times New Roman', serif !important;
        padding: 40px !important;
        color: #3C3529 !important;
    }

    .clinical-header {
        border-top: 1px solid #D6C7B3;
        border-bottom: 1px solid #D6C7B3;
        padding: 15px 0;
        margin-bottom: 30px;
        text-align: center;
    }

    .clinical-logo {
        font-size: 2.2rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #3C3529;
    }

    .clinical-logo span {
        color: #B89C79;
    }

    .clinical-title-row {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        border-bottom: 2px solid #3C3529;
        padding-bottom: 5px;
        margin-bottom: 25px;
    }

    .clinical-title {
        font-size: 1.4rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #3C3529;
        margin: 0;
    }

    .clinical-meta {
        font-size: 0.85rem;
        color: #5C5549;
        font-family: Arial, sans-serif !important;
    }

    .clinical-grid {
        display: flex;
        gap: 30px;
        margin-bottom: 30px;
    }

    .clinical-col {
        flex: 1;
    }

    .clinical-section-header {
        font-size: 0.95rem;
        font-weight: 700;
        color: #9E8665;
        text-transform: uppercase;
        border-bottom: 1px solid #D6C7B3;
        padding-bottom: 5px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: Arial, sans-serif !important;
    }

    .clinical-row {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        border-bottom: 1px dotted #E6DEC3;
        font-size: 0.85rem;
        font-family: Arial, sans-serif !important;
    }

    .clinical-row-label {
        font-weight: 700;
        color: #5C5549;
        text-transform: uppercase;
    }

    .clinical-row-value {
        color: #3C3529;
        font-style: italic;
    }

    .clinical-intro-box {
        border: 1px dashed #D6C7B3;
        background-color: rgba(214, 199, 179, 0.05);
        padding: 15px 20px;
        border-radius: 4px;
        font-style: italic;
        font-size: 1rem;
        color: #5C5549;
        margin-bottom: 25px;
        text-align: center;
    }

    .clinical-details-header {
        font-size: 0.95rem;
        font-weight: 700;
        color: #5C5549;
        text-transform: uppercase;
        border-bottom: 1px solid #D6C7B3;
        padding-bottom: 5px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: Arial, sans-serif !important;
    }

    .clinical-editor-container {
        border: 1px solid #D6C7B3 !important;
        border-radius: 4px;
        background-color: #FFFFFF !important;
        margin-bottom: 30px;
    }

    .clinical-signoff {
        border-top: 1px solid #D6C7B3;
        padding-top: 20px;
        margin-top: 40px;
    }

    .clinical-signature-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-top: 20px;
    }

    .clinical-signature-col {
        width: 45%;
    }

    .clinical-signature-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #9E8665;
        text-transform: uppercase;
        border-bottom: 1px solid #D6C7B3;
        padding-bottom: 5px;
        margin-bottom: 15px;
        font-family: Arial, sans-serif !important;
    }

    .clinical-signature-name {
        font-size: 1.15rem;
        font-weight: 700;
        font-style: italic;
        color: #3C3529;
        margin: 0;
    }

    .clinical-signature-imc {
        font-size: 0.85rem;
        color: #5C5549;
        margin: 2px 0 0 0;
        font-family: Arial, sans-serif !important;
    }

    .clinical-signature-status {
        font-size: 0.8rem;
        color: #9E8665;
        text-align: right;
        font-family: Arial, sans-serif !important;
    }

    .clinical-signature-date {
        font-size: 0.85rem;
        color: #3C3529;
        font-weight: 600;
        text-align: right;
        margin-top: 2px;
        font-family: Arial, sans-serif !important;
    }

    /* Clinical Invoice Styles */
    .clinical-table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0 35px 0;
        font-family: Arial, sans-serif !important;
    }

    .clinical-table th {
        border-bottom: 2px solid #3C3529 !important;
        color: #5C5549 !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 0.85rem;
        padding: 12px 10px !important;
        text-align: left;
    }

    .clinical-table td {
        border-bottom: 1px dotted #E6DEC3 !important;
        color: #3C3529 !important;
        font-size: 0.9rem;
        padding: 15px 10px !important;
    }

    .clinical-table tr.total-row td {
        border-top: 1px solid #3C3529 !important;
        border-bottom: 2px double #3C3529 !important;
        font-weight: 700;
        font-size: 0.95rem;
        color: #3C3529 !important;
        text-transform: uppercase;
    }
</style>

<!-- Invoice Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.15); background-color: #fff;">
            <div class="modal-header border-0 pb-0 pe-4 pt-4">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body clinical-document" id="invoiceContent">
                <!-- Logo Header -->
                <div class="clinical-header">
                    <div class="clinical-logo">CALL<span>DOC</span></div>
                </div>

                <!-- Title Box -->
                <div class="clinical-title-row">
                    <h5 class="clinical-title">Invoice</h5>
                    <div class="clinical-meta">
                        <strong>Invoice ID:</strong> INV-00{{ $registration->id }} &nbsp;&nbsp;|&nbsp;&nbsp; 
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('d M, Y') }}
                    </div>
                </div>

                <div class="clinical-grid">
                    <!-- Left: Referring Physician -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-plus-square-fill"></i> Doctor Info</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->name ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Role:</span>
                            <span class="clinical-row-value">{{ ucfirst($registration->doctor->role ?? 'N/A') }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Phone:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->addressRegister->address ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Right: Patient Details -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-person-fill"></i> Patient Details</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->patient_first_name }} {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">DOB:</span>
                            <span class="clinical-row-value">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('d M, Y') : 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Contact:</span>
                            <span class="clinical-row-value">{{ $registration->mobile ?: 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Intro Box -->
                <div class="clinical-intro-box">
                    Thanks for choosing CallDoc! Below is the statement of account for your recent consultation.
                </div>

                <!-- Invoice Details Table -->
                <div class="table-responsive">
                    <table class="clinical-table">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th class="text-end">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Telephone Consultation - Paid by the Customer Already.</td>
                                <td class="text-end">€60.00</td>
                            </tr>
                            <tr class="total-row">
                                <td>Total (Paid)</td>
                                <td class="text-end">€60.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Footer note in matching style -->
                <div style="font-size: 0.85rem; color: #5C5549; line-height: 1.6; border-top: 1px solid #D6C7B3; padding-top: 20px; font-family: Arial, sans-serif !important;">
                    <p class="mb-1"><strong>Visit:</strong> <a href="https://www.calldoc.ie" target="_blank" style="color: #9E8665; text-decoration: none;">www.calldoc.ie</a> to book an appointment with our doctors.</p>
                    <p class="mb-0"><strong>Billing Enquiries:</strong> All enquires must be directed to <a href="mailto:billing@calldoc.ie" style="color: #9E8665; text-decoration: none;">billing@calldoc.ie</a>.</p>
                </div>

                <!-- Sign-off Section -->
                <div class="clinical-signoff">
                    <div class="clinical-signature-label">Authorised Signature</div>
                    <div class="clinical-signature-row">
                        <div class="clinical-signature-col">
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                    alt="Signature" style="max-height: 70px; margin-bottom: 5px; mix-blend-mode: multiply;">
                            @else
                                <div style="height: 60px; border-bottom: 2px solid #d6c7b3; margin-bottom: 10px;"></div>
                            @endif
                            <h6 class="clinical-signature-name">{{ $registration->doctor->name ?? 'N/A' }}</h6>
                            <p class="clinical-signature-imc">IMC: {{ $registration->doctor->register_id ?? 'N/A' }}</p>
                        </div>
                        <div class="clinical-signature-col text-end">
                            <p class="clinical-signature-status">Electronically Signed</p>
                            <p class="clinical-signature-date">{{ date('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Controls -->
            <div class="modal-footer border-0 p-4 pe-5 pb-5 d-flex justify-content-end gap-3">
                <button type="button" class="btn text-white fw-bold px-5 py-2"
                    onclick="generatePDF('invoiceModal')" id="generateBtn_invoiceModal"
                    style="background-color: #d81b60; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px;">GENERATE</button>
                <button type="button" class="btn btn-light fw-bold px-5 py-2" data-bs-dismiss="modal"
                    style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px; color: #6c757d;">CANCEL</button>
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
            <div class="modal-body clinical-document" id="referralLetterContent">
                <!-- Logo Header -->
                <div class="clinical-header">
                    <div class="clinical-logo">CALL<span>DOC</span></div>
                </div>

                <!-- Title Box -->
                <div class="clinical-title-row">
                    <h5 class="clinical-title">ED Referral</h5>
                    <div class="clinical-meta">
                        <strong>ID:</strong> #{{ $registration->id }} &nbsp;&nbsp;|&nbsp;&nbsp; 
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('d M, Y') }}
                    </div>
                </div>

                <div class="clinical-grid">
                    <!-- Left: Referring Physician -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-plus-square-fill"></i> Referring Physician</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->name ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Clinic:</span>
                            <span class="clinical-row-value">CallDoc Ltd</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Phone:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->addressRegister->address ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Right: Patient Details -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-person-fill"></i> Patient Details</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->patient_first_name }} {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">DOB:</span>
                            <span class="clinical-row-value">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('d M, Y') : 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Contact:</span>
                            <span class="clinical-row-value">{{ $registration->mobile ?: 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Intro Text Box -->
                <div class="clinical-intro-box">
                    Dear Doctor, I am referring this patient with the following history.
                </div>

                <!-- Clinical Details Header -->
                <div class="clinical-details-header"><i class="bi bi-file-earmark-text-fill"></i> Clinical Details & Assessment</div>

                <!-- Tool Editor Section -->
                <div class="clinical-editor-container" style="overflow: hidden;">
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
                <div class="clinical-signoff">
                    <div class="clinical-signature-label">Authorised Signature</div>
                    <div class="clinical-signature-row">
                        <div class="clinical-signature-col">
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                    alt="Signature" style="max-height: 70px; margin-bottom: 5px; mix-blend-mode: multiply;">
                            @else
                                <div style="height: 60px; border-bottom: 2px solid #d6c7b3; margin-bottom: 10px;"></div>
                            @endif
                            <h6 class="clinical-signature-name">{{ $registration->doctor->name ?? 'N/A' }}</h6>
                            <p class="clinical-signature-imc">IMC: {{ $registration->doctor->register_id ?? 'N/A' }}</p>
                        </div>
                        <div class="clinical-signature-col text-end">
                            <p class="clinical-signature-status">Electronically Signed</p>
                            <p class="clinical-signature-date">{{ date('d/m/Y H:i') }}</p>
                        </div>
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
            <div class="modal-body clinical-document" id="pathologyLetterContent">
                <!-- Logo Header -->
                <div class="clinical-header">
                    <div class="clinical-logo">CALL<span>DOC</span></div>
                </div>

                <!-- Title Box -->
                <div class="clinical-title-row">
                    <h5 class="clinical-title">Pathology Requisition</h5>
                    <div class="clinical-meta">
                        <strong>ID:</strong> #{{ $registration->id }} &nbsp;&nbsp;|&nbsp;&nbsp; 
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('d M, Y') }}
                    </div>
                </div>

                <div class="clinical-grid">
                    <!-- Left: Referring Physician -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-plus-square-fill"></i> Referring Physician</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->name ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Clinic:</span>
                            <span class="clinical-row-value">CallDoc Ltd</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Phone:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->addressRegister->address ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Right: Patient Details -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-person-fill"></i> Patient Details</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->patient_first_name }} {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">DOB:</span>
                            <span class="clinical-row-value">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('d M, Y') : 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Contact:</span>
                            <span class="clinical-row-value">{{ $registration->mobile ?: 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Intro Text Box -->
                <div class="clinical-intro-box">
                    Dear Pathologist, please perform the investigations as requested below for this patient.
                </div>

                <!-- Clinical Details Header -->
                <div class="clinical-details-header"><i class="bi bi-file-earmark-text-fill"></i> Clinical Details & Assessment</div>

                <!-- Tool Editor Section -->
                <div class="clinical-editor-container" style="overflow: hidden;">
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
                <div class="clinical-signoff">
                    <div class="clinical-signature-label">Authorised Signature</div>
                    <div class="clinical-signature-row">
                        <div class="clinical-signature-col">
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                    alt="Signature" style="max-height: 70px; margin-bottom: 5px; mix-blend-mode: multiply;">
                            @else
                                <div style="height: 60px; border-bottom: 2px solid #d6c7b3; margin-bottom: 10px;"></div>
                            @endif
                            <h6 class="clinical-signature-name">{{ $registration->doctor->name ?? 'N/A' }}</h6>
                            <p class="clinical-signature-imc">IMC: {{ $registration->doctor->register_id ?? 'N/A' }}</p>
                        </div>
                        <div class="clinical-signature-col text-end">
                            <p class="clinical-signature-status">Electronically Signed</p>
                            <p class="clinical-signature-date">{{ date('d/m/Y H:i') }}</p>
                        </div>
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
            <div class="modal-body clinical-document" id="radiographyLetterContent">
                <!-- Logo Header -->
                <div class="clinical-header">
                    <div class="clinical-logo">CALL<span>DOC</span></div>
                </div>

                <!-- Title Box -->
                <div class="clinical-title-row">
                    <h5 class="clinical-title">Radiography Referred</h5>
                    <div class="clinical-meta">
                        <strong>ID:</strong> #{{ $registration->id }} &nbsp;&nbsp;|&nbsp;&nbsp; 
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('d M, Y') }}
                    </div>
                </div>

                <div class="clinical-grid">
                    <!-- Left: Referring Physician -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-plus-square-fill"></i> Referring Physician</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->name ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Clinic:</span>
                            <span class="clinical-row-value">CallDoc Ltd</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Phone:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->addressRegister->address ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Right: Patient Details -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-person-fill"></i> Patient Details</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->patient_first_name }} {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">DOB:</span>
                            <span class="clinical-row-value">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('d M, Y') : 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Contact:</span>
                            <span class="clinical-row-value">{{ $registration->mobile ?: 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Intro Text Box -->
                <div class="clinical-intro-box">
                    Dear Radiologist, please perform the examinations as requested below for this patient.
                </div>

                <!-- Clinical Details Header -->
                <div class="clinical-details-header"><i class="bi bi-file-earmark-text-fill"></i> Clinical Details & Assessment</div>

                <!-- Tool Editor Section -->
                <div class="clinical-editor-container" style="overflow: hidden;">
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
                <div class="clinical-signoff">
                    <div class="clinical-signature-label">Authorised Signature</div>
                    <div class="clinical-signature-row">
                        <div class="clinical-signature-col">
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                    alt="Signature" style="max-height: 70px; margin-bottom: 5px; mix-blend-mode: multiply;">
                            @else
                                <div style="height: 60px; border-bottom: 2px solid #d6c7b3; margin-bottom: 10px;"></div>
                            @endif
                            <h6 class="clinical-signature-name">{{ $registration->doctor->name ?? 'N/A' }}</h6>
                            <p class="clinical-signature-imc">IMC: {{ $registration->doctor->register_id ?? 'N/A' }}</p>
                        </div>
                        <div class="clinical-signature-col text-end">
                            <p class="clinical-signature-status">Electronically Signed</p>
                            <p class="clinical-signature-date">{{ date('d/m/Y H:i') }}</p>
                        </div>
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
            <div class="modal-body clinical-document" id="fitToWorkLetterContent">
                <!-- Logo Header -->
                <div class="clinical-header">
                    <div class="clinical-logo">CALL<span>DOC</span></div>
                </div>

                <!-- Title Box -->
                <div class="clinical-title-row">
                    <h5 class="clinical-title">Fit To Work Certificate</h5>
                    <div class="clinical-meta">
                        <strong>ID:</strong> #{{ $registration->id }} &nbsp;&nbsp;|&nbsp;&nbsp; 
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('d M, Y') }}
                    </div>
                </div>

                <div class="clinical-grid">
                    <!-- Left: Referring Physician -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-plus-square-fill"></i> Referring Physician</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->name ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Clinic:</span>
                            <span class="clinical-row-value">CallDoc Ltd</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Phone:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->addressRegister->address ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Right: Patient Details -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-person-fill"></i> Patient Details</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->patient_first_name }} {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">DOB:</span>
                            <span class="clinical-row-value">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('d M, Y') : 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Contact:</span>
                            <span class="clinical-row-value">{{ $registration->mobile ?: 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Intro Text Box -->
                <div class="clinical-intro-box">
                    To whom it may concern, this is a medical certificate of fitness for work for the above named patient.
                </div>

                <!-- Clinical Details Header -->
                <div class="clinical-details-header"><i class="bi bi-file-earmark-text-fill"></i> Clinical Details & Assessment</div>

                <!-- Tool Editor Section -->
                <div class="clinical-editor-container" style="overflow: hidden;">
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
                <div class="clinical-signoff">
                    <div class="clinical-signature-label">Authorised Signature</div>
                    <div class="clinical-signature-row">
                        <div class="clinical-signature-col">
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                    alt="Signature" style="max-height: 70px; margin-bottom: 5px; mix-blend-mode: multiply;">
                            @else
                                <div style="height: 60px; border-bottom: 2px solid #d6c7b3; margin-bottom: 10px;"></div>
                            @endif
                            <h6 class="clinical-signature-name">{{ $registration->doctor->name ?? 'N/A' }}</h6>
                            <p class="clinical-signature-imc">IMC: {{ $registration->doctor->register_id ?? 'N/A' }}</p>
                        </div>
                        <div class="clinical-signature-col text-end">
                            <p class="clinical-signature-status">Electronically Signed</p>
                            <p class="clinical-signature-date">{{ date('d/m/Y H:i') }}</p>
                        </div>
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
            <div class="modal-body clinical-document" id="medicalLetterContent">
                <!-- Logo Header -->
                <div class="clinical-header">
                    <div class="clinical-logo">CALL<span>DOC</span></div>
                </div>

                <!-- Title Box -->
                <div class="clinical-title-row">
                    <h5 class="clinical-title">Medical Certificate</h5>
                    <div class="clinical-meta">
                        <strong>ID:</strong> #{{ $registration->id }} &nbsp;&nbsp;|&nbsp;&nbsp; 
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('d M, Y') }}
                    </div>
                </div>

                <div class="clinical-grid">
                    <!-- Left: Referring Physician -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-plus-square-fill"></i> Referring Physician</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->name ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Clinic:</span>
                            <span class="clinical-row-value">CallDoc Ltd</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Phone:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->addressRegister->address ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Right: Patient Details -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-person-fill"></i> Patient Details</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->patient_first_name }} {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">DOB:</span>
                            <span class="clinical-row-value">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('d M, Y') : 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Contact:</span>
                            <span class="clinical-row-value">{{ $registration->mobile ?: 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Intro Text Box -->
                <div class="clinical-intro-box">
                    To whom it may concern, this is a medical certificate for the above named patient.
                </div>

                <!-- Clinical Details Header -->
                <div class="clinical-details-header"><i class="bi bi-file-earmark-text-fill"></i> Clinical Details & Assessment</div>

                <!-- Tool Editor Section -->
                <div class="clinical-editor-container" style="overflow: hidden;">
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
                <div class="clinical-signoff">
                    <div class="clinical-signature-label">Authorised Signature</div>
                    <div class="clinical-signature-row">
                        <div class="clinical-signature-col">
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                    alt="Signature" style="max-height: 70px; margin-bottom: 5px; mix-blend-mode: multiply;">
                            @else
                                <div style="height: 60px; border-bottom: 2px solid #d6c7b3; margin-bottom: 10px;"></div>
                            @endif
                            <h6 class="clinical-signature-name">{{ $registration->doctor->name ?? 'N/A' }}</h6>
                            <p class="clinical-signature-imc">IMC: {{ $registration->doctor->register_id ?? 'N/A' }}</p>
                        </div>
                        <div class="clinical-signature-col text-end">
                            <p class="clinical-signature-status">Electronically Signed</p>
                            <p class="clinical-signature-date">{{ date('d/m/Y H:i') }}</p>
                        </div>
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
            <div class="modal-body clinical-document" id="specialistReferralLetterContent">
                <!-- Logo Header -->
                <div class="clinical-header">
                    <div class="clinical-logo">CALL<span>DOC</span></div>
                </div>

                <!-- Title Box -->
                <div class="clinical-title-row">
                    <h5 class="clinical-title">Specialist Referral</h5>
                    <div class="clinical-meta">
                        <strong>ID:</strong> #{{ $registration->id }} &nbsp;&nbsp;|&nbsp;&nbsp; 
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($registration->appointmentDate)->format('d M, Y') }}
                    </div>
                </div>

                <div class="clinical-grid">
                    <!-- Left: Referring Physician -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-plus-square-fill"></i> Referring Physician</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->name ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Clinic:</span>
                            <span class="clinical-row-value">CallDoc Ltd</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Phone:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->phoneRegister->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->doctor->addressRegister->address ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Right: Patient Details -->
                    <div class="clinical-col">
                        <div class="clinical-section-header"><i class="bi bi-person-fill"></i> Patient Details</div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Name:</span>
                            <span class="clinical-row-value">{{ $registration->patient_first_name }} {{ $registration->patient_last_name }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">DOB:</span>
                            <span class="clinical-row-value">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('d M, Y') : 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Contact:</span>
                            <span class="clinical-row-value">{{ $registration->mobile ?: 'N/A' }}</span>
                        </div>
                        <div class="clinical-row">
                            <span class="clinical-row-label">Address:</span>
                            <span class="clinical-row-value">{{ $registration->address ?: 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Intro Text Box -->
                <div class="clinical-intro-box">
                    Dear Colleague, I am referring this patient for further specialist consultation and management as detailed below.
                </div>

                <!-- Clinical Details Header -->
                <div class="clinical-details-header"><i class="bi bi-file-earmark-text-fill"></i> Clinical Details & Assessment</div>

                <!-- Tool Editor Section -->
                <div class="clinical-editor-container" style="overflow: hidden;">
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
                <div class="clinical-signoff">
                    <div class="clinical-signature-label">Authorised Signature</div>
                    <div class="clinical-signature-row">
                        <div class="clinical-signature-col">
                            @if(!empty($registration->doctor->signatureRegister->signature))
                                <img src="{{ asset('storage/' . $registration->doctor->signatureRegister->signature) }}"
                                    alt="Signature" style="max-height: 70px; margin-bottom: 5px; mix-blend-mode: multiply;">
                            @else
                                <div style="height: 60px; border-bottom: 2px solid #d6c7b3; margin-bottom: 10px;"></div>
                            @endif
                            <h6 class="clinical-signature-name">{{ $registration->doctor->name ?? 'N/A' }}</h6>
                            <p class="clinical-signature-imc">IMC: {{ $registration->doctor->register_id ?? 'N/A' }}</p>
                        </div>
                        <div class="clinical-signature-col text-end">
                            <p class="clinical-signature-status">Electronically Signed</p>
                            <p class="clinical-signature-date">{{ date('d/m/Y H:i') }}</p>
                        </div>
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