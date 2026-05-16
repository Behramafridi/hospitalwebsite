<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service | MediCall Excellence</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    
    <style>
        .legal-hero {
            background: linear-gradient(rgba(29, 131, 127, 0.9), rgba(29, 131, 127, 0.9)), url('https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=1920&q=80');
            background-size: cover;
            background-position: center;
            padding: 140px 0 80px;
            color: white;
            text-align: center;
        }

        .legal-content-card {
            background: white;
            padding: 4rem;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }

        .legal-section {
            margin-bottom: 3rem;
        }

        .legal-section h2 {
            color: var(--primary);
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
            border-bottom: 2px solid var(--bg-page);
            padding-bottom: 0.5rem;
        }

        .legal-section h3 {
            color: var(--primary-light);
            margin-bottom: 1rem;
            font-size: 1.25rem;
            font-weight: 700;
        }

        .legal-section p {
            color: var(--text-dark);
            opacity: 0.85;
            margin-bottom: 1.2rem;
            line-height: 1.8;
        }

        .legal-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 1.5rem;
        }

        .legal-list li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
            opacity: 0.85;
        }

        .legal-list li::before {
            content: "\f05d";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 0;
            color: var(--primary-light);
        }

        .emergency-alert {
            background: #fff5f5;
            border-left: 5px solid #fc8181;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .legal-content-card {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header id="main-header">
        <div class="header-top d-none d-lg-block">
            <div class="container text-center text-lg-start">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-4">
                        <a href="mailto:info@citycentral.ie"><i class="fa-regular fa-envelope me-2"></i> info@citycentral.ie</a>
                        <a href="tel:+35319609912"><i class="fa-solid fa-phone me-2"></i> +353 1 960 9912</a>
                    </div>
                    <div class="d-flex gap-4">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-nav">
            <div class="container">
                <nav class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('home') }}" class="text-decoration-none d-flex align-items-center gap-2">
                        <div style="background: var(--primary-light); width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-plus text-white fs-4"></i>
                        </div>
                        <span class="fs-4 fw-bold" style="color: var(--primary); font-family: 'Outfit';">CITY <span style="color: var(--primary-light);">CENTRAL</span></span>
                    </a>

                    <ul class="nav-links mb-0 d-none d-lg-flex">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('about')}}">About</a></li>
                        <li><a href="{{route('service')}}">Services</a></li>
                        <li><a href="#">Doctors</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                    </ul>

                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}" class="btn btn-outline d-none d-sm-flex">SIGN IN</a>
                        <a href="{{ route('appointment') }}" class="btn btn-primary">BOOK NOW</a>
                        <button class="btn d-lg-none p-2 shadow-none" id="mobileMenuToggle" style="color: var(--primary);"><i class="fa-solid fa-bars fs-3"></i></button>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Mobile Nav -->
    <div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
    <div class="mobile-nav-drawer" id="mobileNavDrawer">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <span class="fs-4 fw-bold" style="color: var(--primary);">MENU</span>
            <button class="btn p-0" id="closeMobileMenu"><i class="fa-solid fa-xmark fs-2 text-primary"></i></button>
        </div>
        <ul class="mobile-nav-links p-0">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('about')}}">About</a></li>
            <li><a href="{{route('service')}}">Services</a></li>
            <li><a href="#">Doctors</a></li>
            <li><a href="{{route('contact')}}">Contact</a></li>
        </ul>
        <div class="mt-5 d-flex flex-column gap-3">
            <a href="{{ route('login') }}" class="btn btn-outline w-100 justify-content-center">SIGN IN</a>
            <a href="{{ route('appointment') }}" class="btn btn-primary w-100 justify-content-center">BOOK NOW</a>
        </div>
    </div>

    <main>
        <!-- Legal Hero -->
        <section class="legal-hero">
            <div class="container">
                <h6 class="text-uppercase fw-bold mb-3" style="letter-spacing: 3px; color: var(--secondary);">Compliance & Agreement</h6>
                <h1>Terms of Service</h1>
                <p class="lead opacity-75 mx-auto" style="max-width: 700px;">Please read our terms and conditions carefully before using our medical consultation services.</p>
            </div>
        </section>

        <!-- Content Section -->
        <section class="section-padding pt-0" style="background: var(--bg-page);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="legal-content-card">
                            
                            <div class="emergency-alert">
                                <h5 class="text-danger fw-bold mb-2"><i class="fa-solid fa-circle-exclamation me-2"></i> EMERGENCY NOTICE</h5>
                                <p class="mb-0 text-dark">In case of life-threatening emergencies, please dial <strong>999</strong> or <strong>112</strong> immediately. Our online services are not intended for acute trauma or emergency care.</p>
                            </div>

                            <div class="legal-section">
                                <h2>1. Online Doctor Services</h2>
                                <h3>1.1 Overview</h3>
                                <p>Welcome to MediCall's online doctor services, designed to provide convenient healthcare solutions. By utilizing our platform, you acknowledge and agree to adhere to the terms and conditions outlined herein. Our services are exclusively available to residents of the Republic of Ireland.</p>
                                <h3>1.2 Eligibility</h3>
                                <p>To access our services, you must be 18 years or older and a resident of the Republic of Ireland. You agree to provide truthful and accurate information regarding your identity and medical history.</p>
                            </div>

                            <div class="legal-section">
                                <h2>2. Privacy and Data Protection</h2>
                                <p>Your privacy is our priority. All medical data is handled according to our Privacy Policy and clinical confidentiality standards. We employ advanced encryption to ensure your patient records remain secure.</p>
                            </div>

                            <div class="legal-section">
                                <h2>3. Patient Responsibilities</h2>
                                <p>As a patient using our platform, you commit to the following:</p>
                                <ul class="legal-list">
                                    <li>Providing truthful and comprehensive responses to all medical questionnaires.</li>
                                    <li>Following the instructions provided by our physicians regarding prescribed medications.</li>
                                    <li>Informing us immediately of any adverse reactions to treatments.</li>
                                    <li>Maintaining the confidentiality of your account credentials.</li>
                                    <li>Treating our medical staff with respect and dignity.</li>
                                </ul>
                            </div>

                            <div class="legal-section">
                                <h2>4. Physician Commitments</h2>
                                <p>Our physicians commit to professional responsibility and clinical excellence. We only prescribe medications when medically appropriate based on the information provided. We reserve the right to decline prescriptions if an in-person consultation is deemed necessary for patient safety.</p>
                            </div>

                            <div class="legal-section">
                                <h2>5. Medication and Prescriptions</h2>
                                <p>Prescriptions issued through our platform are at the sole discretion of the treating physician. Certain controlled medications will not be issued online. It is the patient's responsibility to ensure they understand the dosage and administration instructions.</p>
                            </div>

                            <div class="text-center mt-5">
                                <p class="small text-muted">Last Updated: May 11, 2026</p>
                                <div class="d-flex justify-content-center gap-3 mt-4">
                                    <a href="{{ route('contact') }}" class="btn btn-primary">I HAVE QUESTIONS</a>
                                    <a href="{{ route('home') }}" class="btn btn-outline">BACK TO HOME</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <a href="{{ route('home') }}" class="text-decoration-none d-flex align-items-center gap-2 mb-4">
                        <div style="background: var(--primary-light); width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-plus text-white fs-5"></i>
                        </div>
                        <span class="fs-4 fw-bold text-white">CITY CENTRAL</span>
                    </a>
                    <p style="color: #94a3b8; line-height: 1.8;">Leading the way in medical excellence since 2001. We provide compassionate care combined with cutting-edge medical technology.</p>
                </div>
                
                <div class="col-lg-2 offset-lg-1 col-md-4">
                    <div class="footer-links">
                        <h4>Legal</h4>
                        <ul class="p-0">
                            <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms') }}">Terms of Service</a></li>
                            <li><a href="#">Patient Rights</a></li>
                            <li><a href="#">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4">
                    <div class="footer-links">
                        <h4>Quick Links</h4>
                        <ul class="p-0">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('service') }}">Services</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4">
                    <div class="footer-links">
                        <h4>Contact Us</h4>
                        <p style="color: #94a3b8; font-size: 0.9rem;"><i class="fa-solid fa-location-dot text-primary-light me-3"></i> 123 Healthcare Ave, IE</p>
                        <p style="color: #94a3b8; font-size: 0.9rem;"><i class="fa-solid fa-phone text-primary-light me-3"></i> +353 1 960 9912</p>
                        <p style="color: #94a3b8; font-size: 0.9rem;"><i class="fa-solid fa-envelope text-primary-light me-3"></i> info@citycentral.ie</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5 pt-5 border-top border-secondary opacity-25">
                <p class="small mb-0">&copy; 2026 City Central Hospital. Designed for Medical Excellence.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile Menu Logic
        const toggle = document.getElementById('mobileMenuToggle');
        const close = document.getElementById('closeMobileMenu');
        const drawer = document.getElementById('mobileNavDrawer');
        const overlay = document.getElementById('mobileNavOverlay');

        toggle.addEventListener('click', () => {
            drawer.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        const closeMenu = () => {
            drawer.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        };

        close.addEventListener('click', closeMenu);
        overlay.addEventListener('click', closeMenu);
    </script>
</body>

</html>