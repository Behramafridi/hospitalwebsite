<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | MediCall Excellence</title>
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
            background: linear-gradient(rgba(29, 131, 127, 0.9), rgba(29, 131, 127, 0.9)), url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=1920&q=80');
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
            margin-bottom: 0.8rem;
            color: var(--text-dark);
            opacity: 0.85;
        }

        .legal-list li::before {
            content: "\f00c";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 0;
            color: var(--primary-light);
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
                <h6 class="text-uppercase fw-bold mb-3" style="letter-spacing: 3px; color: var(--secondary);">Security & Trust</h6>
                <h1>Privacy Policy</h1>
                <p class="lead opacity-75 mx-auto" style="max-width: 700px;">Your privacy is our priority. Learn how we handle and protect your personal information.</p>
            </div>
        </section>

        <!-- Content Section -->
        <section class="section-padding pt-0" style="background: var(--bg-page);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="legal-content-card">
                            <div class="legal-section">
                                <h2>1. Introduction</h2>
                                <p>Welcome to MediCall's Privacy Policy. This document explains our practices regarding the collection, usage, and disclosure of your personal information when you use our service. We utilize your personal data to enhance and provide a better healthcare experience.</p>
                                <p>By accessing and using our service, you consent to the collection and utilization of your information as described in this policy. We are committed to ensuring that your data is protected according to the highest security standards.</p>
                            </div>

                            <div class="legal-section">
                                <h2>2. Definitions</h2>
                                <h3>Account</h3>
                                <p>A distinctive user account established by you for accessing our Service or its specific features.</p>
                                <h3>Cookies</h3>
                                <p>Small files placed on your computer, mobile device, or other devices by a website. They store details of your browsing history and serve various purposes.</p>
                                <h3>Personal Data</h3>
                                <p>Encompasses any information linked to an identified or identifiable individual, specifically including health records and clinical history.</p>
                            </div>

                            <div class="legal-section">
                                <h2>3. Data Collection</h2>
                                <p>While using Our Service, We may ask You to provide Us with certain personally identifiable information that can be used to contact or identify You. This includes:</p>
                                <ul class="legal-list">
                                    <li>Email address</li>
                                    <li>First name and last name</li>
                                    <li>Phone number</li>
                                    <li>Medical history and clinical symptoms</li>
                                    <li>Address, City, and Postal code</li>
                                </ul>
                            </div>

                            <div class="legal-section">
                                <h2>4. Usage Data</h2>
                                <p>We automatically collect Usage Data when you use our Service. This may include details such as your device's IP address, browser type, the specific pages you visit, and the time spent on those pages. When accessing via mobile, we may also collect device-specific IDs and operating system information.</p>
                            </div>

                            <div class="legal-section">
                                <h2>5. Cookies and Tracking</h2>
                                <p>We employ Cookies and similar tracking technologies to monitor user activity on Our Service. These help us analyze our traffic, remember your preferences, and improve the overall patient experience.</p>
                                <p>We also partner with Microsoft Clarity to analyze user interactions through behavioral metrics and heatmaps to better optimize our services. All such data is handled according to strict confidentiality agreements.</p>
                            </div>

                            <div class="legal-section">
                                <h2>6. Data Security</h2>
                                <p>Adhering to strict data protection laws, MediCall employs secure technologies (SSL/TLS encryption) to safeguard your information. Electronic transmissions carry inherent risks, but we implement industry-leading protocols to minimize any threat to patient data integrity.</p>
                            </div>

                            <div class="text-center mt-5">
                                <p class="small text-muted">Last Updated: May 11, 2026</p>
                                <a href="{{ route('contact') }}" class="btn btn-outline mt-3">QUESTIONS? CONTACT US</a>
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
                        <h4>Specialities</h4>
                        <ul class="p-0">
                            <li><a href="#">Cardiology</a></li>
                            <li><a href="#">Neurology</a></li>
                            <li><a href="#">Emergency</a></li>
                            <li><a href="#">Pediatrics</a></li>
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