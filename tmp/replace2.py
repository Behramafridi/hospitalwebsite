file_path = r'c:\xampp\htdocs\doctorproject\resources\views\admins\admin\Certificatecode.blade.php'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

target = """                <div class="row mb-5">
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
                </div>"""

replacement = """                <div class="row mb-5">
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
                            <span style="color: #718096;">{{ $registration->bod_of_birth ? \Carbon\Carbon::parse($registration->bod_of_birth)->format('M d, y') : 'N/A' }}</span>
                        </div>

                        <div class="d-flex mb-0 mt-3 pt-2" style="font-size: 0.9rem; border-top: 1px dashed #e2e8f0;">
                            <span class="fw-bold" style="color: #4a5568; width: 120px;">Appointment ID:</span>
                            <span style="color: #718096;">{{ $registration->id }}</span>
                        </div>
                    </div>
                </div>"""

num_replacements = content.count(target)
content = content.replace(target, replacement)
print(f'Made {num_replacements} replacements')

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)
