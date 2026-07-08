<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CallDoc - Appointment Wizard</title>
    <meta name="description"
        content="Advanced healthcare solutions and professional medical services at City Central Hospital.">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS for specific components -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* CSS Variables - MediCall Brand */
        :root {
            --primary: #0f172a;
            --primary-light: #0ea5e9;
            --secondary: #38bdf8;
            --accent: #f59e0b;
            --bg-white: #ffffff;
            --bg-light: #f8fafc;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --white: #ffffff;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            /* keep legacy aliases for any existing references */
            --primary-color: #0ea5e9;
            --primary-hover: #0284c7;
        }

        /* ========== HEADER ========== */
        #main-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }

        .header-top {
            background: var(--primary);
            padding: 8px 0;
            font-size: 0.82rem;
        }

        .header-top a {
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            transition: var(--transition);
        }

        .header-top a:hover { color: #fff; }

        .main-nav { padding: 14px 0; }

        /* Desktop nav links */
        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-main);
            font-weight: 500;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
            transition: var(--transition);
            position: relative;
            padding-bottom: 4px;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-light);
            transition: var(--transition);
            border-radius: 2px;
        }

        .nav-links a:hover,
        .nav-links a.active { color: var(--primary-light); }
        .nav-links a:hover::after,
        .nav-links a.active::after { width: 100%; }

        /* ========== MOBILE DRAWER ========== */
        .mobile-nav-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 2000;
            display: none;
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .mobile-nav-drawer {
            position: fixed;
            top: 0;
            right: -310px;
            width: 290px;
            height: 100%;
            background: #fff;
            z-index: 2001;
            padding: 36px 28px;
            transition: right 0.35s cubic-bezier(0.4,0,0.2,1);
            box-shadow: -8px 0 40px rgba(0,0,0,0.15);
            overflow-y: auto;
        }

        .mobile-nav-drawer.active { right: 0; }

        .mobile-nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mobile-nav-links li { margin-bottom: 1.25rem; }

        .mobile-nav-links a {
            text-decoration: none;
            color: var(--primary);
            font-size: 1.1rem;
            font-weight: 600;
            display: block;
            transition: var(--transition);
        }

        .mobile-nav-links a:hover { color: var(--primary-light); padding-left: 6px; }

        /* ========== BUTTONS ========== */
        .btn-primary, .btn.btn-primary {
            background: linear-gradient(135deg, var(--primary-light), var(--secondary));
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            transition: var(--transition);
        }

        .btn-primary:hover, .btn.btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(14,165,233,0.35);
            color: #fff;
        }

        .btn-outline, .btn.btn-outline {
            border: 2px solid var(--primary-light);
            color: var(--primary-light);
            font-weight: 600;
            border-radius: 10px;
            background: transparent;
            transition: var(--transition);
        }

        .btn-outline:hover, .btn.btn-outline:hover {
            background: var(--primary-light);
            color: #fff;
        }

        /* ========== WIZARD STEPS ========== */
        .wizard-step-content { display: none; }

        .wizard-step-content.active {
            display: block;
            animation: fadeSlideIn 0.45s ease both;
        }

        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Step cards */
        .service-card {
            border-radius: 20px;
            transition: var(--transition);
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border: none;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
        }

        .card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.68) 0%, rgba(0,0,0,0.28) 100%);
            z-index: 1;
        }

        .card-content {
            position: relative;
            z-index: 2;
            padding: 30px 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card-title  { font-size: 1.4rem; margin-bottom: 1rem !important; }
        .card-text   { font-size: 0.92rem; opacity: 0.95; line-height: 1.6; }

        /* ========== FOOTER ========== */
        footer {
            background: var(--primary);
            color: #fff;
            padding: 70px 0 28px;
        }

        .footer-links h4 {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 1.4rem;
            position: relative;
            color: #fff;
        }

        .footer-links h4::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 36px;
            height: 2px;
            background: var(--primary-light);
            border-radius: 2px;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links ul li { margin-bottom: 0.7rem; }

        .footer-links ul li a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .footer-links ul li a:hover {
            color: var(--primary-light);
            padding-left: 4px;
        }

        /* ========== RESPONSIVE ========== */
        /* Tablet (≤ 991px): hide desktop nav links, show hamburger */
        @media (max-width: 991px) {
            .nav-links { display: none !important; }

            .main-nav .btn.d-none.d-sm-flex {
                /* Keep SIGN IN visible on tablet */
                display: flex !important;
                font-size: 0.82rem;
                padding: 0.55rem 0.9rem !important;
            }
        }

        /* Mobile (≤ 767px) */
        @media (max-width: 767px) {
            .main-nav .btn.d-none.d-sm-flex { display: none !important; }

            .container.py-5 { padding-top: 2rem !important; padding-bottom: 2rem !important; }

            .card-body { padding: 1.5rem !important; }

            h2.fw-bold { font-size: 1.5rem; }
            h4.fw-bold { font-size: 1.2rem; }

            /* Time slots wrap nicely */
            #timeSlotsContainer .btn { font-size: 0.78rem; padding: 6px 10px; }

            /* Registration step columns: full width on mobile */
            #content-step-5 .col-md-6,
            #content-step-5 .col-md-4 { flex: 0 0 100%; max-width: 100%; }

            /* DOB selects on one row */
            #content-step-5 .d-flex.gap-2 { flex-wrap: wrap; }
            #content-step-5 .d-flex.gap-2 .form-select { min-width: 90px; }

            /* Wizard indicator badges */
            #steps-indicator .badge { width: 38px; height: 38px; font-size: 0.85rem; }

            /* Footer columns stack */
            footer .col-lg-4,
            footer .col-lg-2,
            footer .col-lg-3 { margin-bottom: 2rem; }
        }

        /* Small phones (≤ 480px) */
        @media (max-width: 480px) {
            .main-nav { padding: 10px 0; }
            .main-nav span.fs-4 { font-size: 1.1rem !important; }
            .main-nav [style*="width: 45px"] { width: 36px !important; height: 36px !important; }

            .btn-primary, .btn-outline {
                width: 100%;
                text-align: center;
            }

            #content-step-6 .d-sm-flex {
                flex-direction: column !important;
                gap: 1rem;
            }

            #content-step-6 .btn { width: 100%; }
        }

        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Header Styles */
        .top-header {
            background-color: #f8f9fa;
            padding: 15px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .logo-text {
            font-size: 28px;
            font-weight: 600;
            color: #4fc3c8;
            margin: 0;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background-color: #4fc3c8;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .logo-icon i {
            color: white;
            font-size: 24px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .contact-icon {
            width: 45px;
            height: 45px;
            border: 2px solid #4fc3c8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4fc3c8;
        }

        .contact-info h6 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .contact-info p {
            margin: 0;
            font-size: 14px;
            color: #4fc3c8;
            font-weight: 500;
        }

        .btn-sign-in {
            background-color: #4fc3c8;
            color: white;
            padding: 12px 30px;
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            transition: all 0.3s;
        }

        .btn-sign-in:hover {
            background-color: #3da8ad;
            color: white;
        }

        .btn-appointment {
            background-color: #4fc3c8;
            color: white;
            padding: 12px 25px;
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            transition: all 0.3s;
        }

        .btn-appointment:hover {
            background-color: #3da8ad;
            color: white;
        }

        /* Navbar Styles */
        .navbar-custom {
            background-color: var(--primary-color);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .nav-link {
            color: var(--white);
            font-weight: 600;
            font-size: 1.1rem;
            padding: 0.5rem 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-custom .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: var(--white);
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            opacity: 0.8;
        }

        .navbar-custom .nav-link:hover::after {
            width: 80%;
        }

        /* Steps Indicator Styles inside page */
        .step {
            cursor: pointer;
            transition: all 0.3s;
        }

        /* Wizard / Steps Styles */
        .wizard-step-content {
            display: none;
        }

        .wizard-step-content.active {
            display: block;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Cards Styles */
        .service-card {
            border-radius: 20px;
            transition: all 0.4s ease;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border: none;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.3) 100%);
            z-index: 1;
        }

        .card-content {
            position: relative;
            z-index: 2;
            padding: 30px 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 1rem !important;
        }

        .card-text {
            font-size: 0.95rem;
            opacity: 0.95;
            line-height: 1.6;
        }

        .badge {
            transition: all 0.3s ease;
            font-size: 0.85rem;
        }

        .service-card:hover .badge {
            transform: scale(1.05);
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .contact-item {
                margin-bottom: 15px;
            }

            .btn-sign-in,
            .btn-appointment {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        @media (max-width: 576px) {
            .logo-text {
                font-size: 24px;
            }

            .contact-info h6 {
                font-size: 14px;
            }

            .contact-info p {
                font-size: 13px;
            }

            .is-invalid {
                border-color: #dc3545 !important;
            }

            .btn-pulse {
                animation: pulse-animation 1s infinite;
            }

            @keyframes pulse-animation {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.05);
                }

                100% {
                    transform: scale(1);
                }
            }
        }



        .service-hero {
            background: linear-gradient(rgba(29, 131, 127, 0.85), rgba(29, 131, 127, 0.85)), url('https://images.unsplash.com/photo-1504813184591-01572f98c85f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            padding: 160px 0 100px;
            color: white;
            text-align: center;
        }

        .service-hero h1 {
            font-size: clamp(2.5rem, 6vw, 4rem);
            margin-bottom: 1.5rem;
        }

        .service-grid-premium {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: -60px;
            position: relative;
            z-index: 10;
        }

        .service-item-card {
            background: white;
            padding: 3.5rem 2rem;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid var(--border);
            text-align: center;
        }

        .service-item-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .service-icon-box {
            width: 90px;
            height: 90px;
            background: var(--bg-page);
            color: var(--primary);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 2.5rem;
            transition: var(--transition);
        }

        .service-item-card:hover .service-icon-box {
            background: var(--primary);
            color: white;
            transform: rotateY(180deg);
        }

        .feature-list-item {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }

        .feature-list-item:hover {
            background: white;
            box-shadow: var(--shadow-sm);
        }

        .feature-icon-small {
            width: 60px;
            height: 60px;
            flex-shrink: 0;
            background: var(--accent);
            color: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <br>
    <br>
    <br>

    <!-- Header -->
    <header id="main-header" style="margin-top:-6%">
        <!-- Top Info Bar -->
        <div class="header-top d-none d-lg-block">
            <div class="container">
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

        <!-- Main Nav -->
        <div class="main-nav">
            <div class="container">
                <nav class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('home') }}" class="text-decoration-none d-flex align-items-center gap-2">
                        <div style="background: var(--primary-light); width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-plus text-white fs-4"></i>
                        </div>
                        <span class="fs-4 fw-bold" style="color: var(--primary); font-family: 'Outfit';">CITY <span style="color: var(--primary-light);">CENTRAL</span></span>
                    </a>

                    <ul class="nav-links mb-0">
                        <li><a href="{{route('home')}}" class="active">Home</a></li>
                        <li><a href="{{route('about')}}">About</a></li>
                        <li><a href="{{route('service')}}">Services</a></li>
                        <li><a href="#">Doctors</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                    </ul>

                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}" class="btn btn-outline d-none d-sm-flex" style="padding: 0.75rem 1.5rem;">SIGN IN</a>
                        <a href="{{ route('appointment') }}" class="btn btn-primary" style="padding: 0.75rem 1.5rem;">BOOK NOW</a>
                        <button class="btn d-lg-none p-2" id="mobileMenuToggle" style="color: var(--primary);"><i class="fa-solid fa-bars fs-3"></i></button>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Mobile Navigation Drawer -->
    <div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
    <div class="mobile-nav-drawer" id="mobileNavDrawer">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <span class="fs-4 fw-bold" style="color: var(--primary);">MENU</span>
            <button class="btn p-0" id="closeMobileMenu"><i class="fa-solid fa-xmark fs-2 text-primary"></i></button>
        </div>
        <ul class="mobile-nav-links">
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
        <!-- Hero Section with Premium Slider -->
        <section class="hero">
            <div class="slider-container">
                <!-- Slide 1 -->
                <div class="slide active" style="background-image: url('OIP (4).jpg');">
                    <div class="container">
                        <div class="hero-content">
                            <h1>Excellence in <br><span style="color: var(--secondary);">Modern Care</span></h1>
                            <p>Delivering state-of-the-art medical solutions with a patient-first philosophy and world-class expertise.</p>
                            <div class="hero-btns">
                                <a href="{{ route('appointment') }}" class="btn btn-primary">START CONSULTATION <i class="fa-solid fa-arrow-right"></i></a>
                                <a href="{{ route('service') }}" class="btn btn-outline" style="border-color: white; color: white;">OUR SPECIALITIES</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="slide" style="background-image: url('OIP.jpg');">
                    <div class="container">
                        <div class="hero-content">
                            <h1>Precision <br><span style="color: var(--secondary);">Diagnostics</span></h1>
                            <p>Advanced imaging and laboratory services for accurate diagnosis and personalized treatment plans.</p>
                            <div class="hero-btns">
                                <a href="{{ route('appointment') }}" class="btn btn-primary">BOOK A TEST <i class="fa-solid fa-calendar-check"></i></a>
                                <a href="{{ route('about') }}" class="btn btn-outline" style="border-color: white; color: white;">LEARN MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Navigation Controls -->
            <div style="position: absolute; bottom: 150px; right: 5%; z-index: 100; display: flex; flex-direction: column; gap: 1rem;">
                <button id="prevSlide" class="btn rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: rgba(255,255,255,0.1); backdrop-filter: blur(5px); color: white; border: 1px solid rgba(255,255,255,0.2);">
                    <i class="fas fa-chevron-up"></i>
                </button>
                <button id="nextSlide" class="btn rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: var(--primary-light); color: white; border: none;">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
        </section>

        <!-- Stats Section (Floating) -->
        <section class="container floating-info">
            <div class="stats">
                <div class="row g-4 text-center">
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <h3 class="counter" data-target="15000">0</h3>
                            <p>Patients Cared</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <h3 class="counter" data-target="250">0</h3>
                            <p>Expert Doctors</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item border-start-md">
                            <h3 class="counter" data-target="98">0</h3>
                            <p>Success Rate %</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item border-start-md">
                            <h3 class="counter" data-target="25">0</h3>
                            <p>Years Excellence</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services Section -->
      

        <!-- How It Works (Premium Dark Theme) -->
      

      
    </main>
    <!-- Header / Navigation -->

    <div class="container py-4 py-md-5 mt-3 mt-md-5">

        <!-- STEP 1: Book Appointment -->
        <div id="content-step-1" class="wizard-step-content active">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-3 p-md-5">
                    <h2 class="fw-bold mb-4">Select Date and Time</h2>
                    <div class="mb-4">
                        <label class="form-label fw-semibold" for="appointmentType">Select Appointment Type</label>
                        <select class="form-select form-select-lg" name="appointmentType" id="appointmentType">
                            <option selected value="">Choose Appointment Type</option>
                            <option value="Telephone Consultation">Telephone Consultation</option>
                            <option value="Video Consultation">Video Consultation</option>
                            <option value="Order Counselling Therapy Coming Soon">Order Counselling Therapy Coming Soon
                            </option>

                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold" for="appointmentDate">Select Appointment Date</label>
                        <input type="date" id="appointmentDate" name="appointmentDate"
                            class="form-control form-control-lg">
                    </div>
                    <div id="timeSlots" class="d-none">
                        <label class="form-label fw-semibold mb-3" for="timeSlot">Select Time Slot</label>
                        <div class="d-flex flex-wrap gap-2" name="timeSlot" id="timeSlotsContainer">
                            <!-- Time slots generated by JS -->
                        </div>
                    </div>
                    <div class="text-end mb-4 mt-4">
                        <button class="btn btn-info text-white px-4 py-2" onclick="nextStep(2)">Next</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- STEP 2: Account Page -->
        <div id="content-step-2" class="wizard-step-content">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10 col-12">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="fw-bold mb-0" id="wizard-account-title">Create Account</h3>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-info active" id="btn-mode-register"
                                        onclick="setWizardAccountMode('register')">Register</button>
                                    <button type="button" class="btn btn-outline-info" id="btn-mode-login"
                                        onclick="setWizardAccountMode('login')">Login</button>
                                </div>
                            </div>

                            <p class="text-muted mb-4" id="wizard-account-desc">Please provide your email and create a
                                password to continue with your appointment registration.</p>

                            <!-- Login Success Message -->
                            <div id="login-success-msg"
                                class="alert alert-success d-none mb-4 py-2 px-3 align-items-center"
                                style="font-size: 0.95rem; border-left: 4px solid #198754;">
                                <i class="fa-solid fa-circle-check me-2 fs-5"></i>
                                <div><strong>Logged in!</strong> Proceeding to next step...</div>
                            </div>

                            <!-- Account Found Alert -->
                            <div id="account-found-alert"
                                class="alert alert-info d-none mb-4 py-3 px-3 align-items-center shadow-sm"
                                style="font-size: 0.95rem; border-left: 4px solid #0dcaf0; background-color: #f0faff;">
                                <i class="fa-solid fa-circle-info me-2 fs-5 text-info"></i>
                                <div><strong>Account Detected!</strong> This email is already registered. Please login
                                    with your password to continue.</div>
                            </div>

                            <!-- Registration Input Block -->
                            <div id="registration-inputs" class="row g-3 mb-4">
                                <div class="col-md-6 col-12">
                                    <label class="form-label fw-semibold" for='reg_email' id="label-email">E-mail
                                        Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-lg" name='reg_email'
                                        id='reg_email' placeholder="Enter Email">
                                    <div id="email-error" class="text-danger mt-1 d-none" style="font-size: 0.85rem;">
                                        This email is already registered.</div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label fw-semibold" for='reg_password' id="label-password">Create
                                        New Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-lg" name='reg_password'
                                            id='reg_password' placeholder="Password">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="togglePassword('reg_password')">Show</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Login Input Block -->
                            <div id="login-inputs" class="row g-3 mb-4 d-none">
                                <div class="col-md-6 col-12">
                                    <label class="form-label fw-semibold" for='login_email'
                                        id="label-login-email">E-mail Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-lg" name='login_email'
                                        id='login_email' placeholder="Enter Login Email">
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label fw-semibold" for='login_password'
                                        id="label-login-password">Enter Password <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-lg"
                                            name='login_password' id='login_password' placeholder="Login Password">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="togglePassword('login_password')">Show</button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between gap-2 mb-2">
                                <button class="btn btn-secondary px-4 py-2" onclick="prevStep(1)">Previous</button>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-info text-white px-5 py-2 d-none" id="wizard-login-submit"
                                        onclick="handleWizardLogin()">Login</button>
                                    <button class="btn btn-info text-white px-5 py-2" id="wizard-next-btn"
                                        onclick="nextStep(3)">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- STEP 3: Cards -->
        @include('frontend.appointmentcardsfoam')

        <!-- STEP 4: Medical Form -->
        <div id="content-step-4" class="wizard-step-content">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-3 p-md-4">
                    <h4 class="fw-bold mb-4">Reservation</h4>
                    <form id="medicalForm" action="{{ route('appointment.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="textarea">What are your current symptom(s)?</label>
                            <textarea class="form-control" name="textarea" id="textarea" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="image">Feel free to upload photos of your symptoms if you
                                wish for the
                                doctor's evaluation.</label>
                            <input type="file" class="form-control" name="image" id="image"
                                onchange="previewImage(this)">
                            <div id="imagePreviewContainer" class="mt-2 d-none">
                                <img id="imagePreview" src="#" alt="Image Preview"
                                    style="max-width: 200px; max-height: 200px;" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="hasMedicalHistory">Have you had any medical conditions or
                                undergone surgeries previously?</label>
                            <select class="form-select" name="hasMedicalHistory" id="hasMedicalHistory">
                                <option selected disabled>Choose Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="mb-3 d-none" id="medicalHistoryDetailsContainer">
                            <label class="form-label" for="medicalHistoryDetails">Please provide details about your
                                medical conditions or surgeries</label>
                            <textarea class="form-control" name="medicalHistoryDetails" id="medicalHistoryDetails"
                                rows="3" placeholder="Enter details here..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="hasMedications">Are you currently using any prescribed
                                medications?</label>
                            <select class="form-select" name="hasMedications" id="hasMedications">
                                <option selected disabled>Choose Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="mb-3 d-none" id="medicationDetailsContainer">
                            <label class="form-label" for="medicationDetails">Please list your current
                                medications</label>
                            <textarea class="form-control" name="medicationDetails" id="medicationDetails" rows="3"
                                placeholder="Enter medications here..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="hasAllergies">Do you know of any allergies you might
                                have?</label>
                            <select class="form-select" name="hasAllergies" id="hasAllergies">
                                <option selected disabled>Choose Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="mb-3 d-none" id="allergyDetailsContainer">
                            <label class="form-label" for="allergyDetails">Please list your allergies</label>
                            <textarea class="form-control" name="allergyDetails" id="allergyDetails" rows="3"
                                placeholder="Enter allergies here..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="medicalPrescriptionDelivery">Select Prescription Delivery (in
                                case
                                medication is required)</label>
                            <select class="form-select" name="prescriptionDelivery" id="medicalPrescriptionDelivery">
                                <option selected disabled>Choose Option</option>
                                <option value="Collect at Pharmacy">Collect at Pharmacy</option>
                                <option value="Clinic Pickup">Clinic Pickup</option>
                            </select>
                        </div>

                        <div id="pharmacyOptionsContainer" class="d-none">
                            <div class="mb-3">
                                <label class="form-label" for="pharmacyCountry">Select Business State</label>
                                <select class="form-select" name="pharmacyCountry" id="pharmacyCountry">
                                    <option selected disabled>Choose Business State</option>
                                    <option value="Carlow">Carlow</option>
                                    <option value="Cavan">Cavan</option>
                                    <option value="Clare">Clare</option>
                                    <option value="Cork">Cork</option>
                                    <option value="Donegal">Donegal</option>
                                    <option value="Dublin">Dublin</option>
                                    <option value="Galway">Galway</option>
                                    <option value="Kerry">Kerry</option>
                                    <option value="Kildare">Kildare</option>
                                    <option value="Kilkenny">Kilkenny</option>
                                    <option value="Laois">Laois</option>
                                    <option value="Leitrim">Leitrim</option>
                                    <option value="Limerick">Limerick</option>
                                    <option value="Longford">Longford</option>
                                    <option value="Louth">Louth</option>
                                    <option value="Mayo">Mayo</option>
                                    <option value="Meath">Meath</option>
                                    <option value="Monaghan">Monaghan</option>
                                    <option value="Offaly">Offaly</option>
                                    <option value="Roscommon">Roscommon</option>
                                    <option value="Sligo">Sligo</option>
                                    <option value="Tipperary">Tipperary</option>
                                    <option value="Waterford">Waterford</option>
                                    <option value="Westmeath">Westmeath</option>
                                    <option value="Wexford">Wexford</option>
                                    <option value="Wicklow">Wicklow</option>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="pharmacyName">Select Pharmacy</label>
                                <select class="form-select" name="pharmacyName" id="pharmacyName">
                                    <option selected disabled>Choose Pharmacy</option>
                                </select>
                                <input type="hidden" name="pharmacyPhone" id="pharmacyPhone">
                            </div>

                            <!-- Styled Pharmacy Info Box -->
                            <div id="pharmacyInfoBox" class="p-4 rounded text-white shadow-sm mb-3 d-none"
                                style="background-color:#0dcaf0;">
                                <p class="mb-2" style="font-size: 1.1rem;">Name: <span id="pharmacyInfoName"></span></p>
                                <p class="mb-2" style="font-size: 1.1rem;">County: <span id="pharmacyInfoCounty"></span>
                                </p>
                                <p class="mb-0" style="font-size: 1.1rem;">Phone: <span id="pharmacyInfoPhone"></span>
                                </p>
                            </div>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms">
                            <label class="form-check-label" for="terms">I Accept Terms & Conditions and Drug Policy
                                Including Control Drug</label>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <!-- Back button logic depends on previous step logic -->
                            <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Previous</button>
                            <button type="button" class="btn btn-info text-white" onclick="nextStep(5)">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- STEP 5: Registration Form -->
        <div id="content-step-5" class="wizard-step-content">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-3 p-md-4">
                    <h4 class="fw-bold mb-4">Registration</h4>
                    <form id="registrationForm5" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="patient_first_name *" class="form-label">Patient First Name * <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="patient_first_name"
                                    name="patient_first_name" required>
                            </div>

                            <div class="col-md-6">
                                <label for="patient_last_name" class="form-label">Patient Last Name * <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="patient_last_name" name="patient_last_name"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="bod_of_birth">Patient Date of Birth <span
                                        class="text-danger">*</span></label>
                                <div class="d-flex gap-2">
                                    <select class="form-select" id="dob_date" required>
                                        <option selected disabled value="">Date</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ sprintf('%02d', $i) }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <select class="form-select" id="dob_month" required>
                                        <option selected disabled value="">Month</option>
                                        @php
                                            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                        @endphp
                                        @foreach ($months as $index => $month)
                                            <option value="{{ sprintf('%02d', $index + 1) }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-select" id="dob_year" required>
                                        <option selected disabled value="">Year</option>
                                        @for ($i = date('Y'); $i >= 1900; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <input type="hidden" name="bod_of_birth" id="bod_of_birth">
                            </div>

                            <div class="col-md-6">
                                <label for="mobile" class="form-label">Mobile* <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="mobile" name="mobile" required>
                            </div>
                            <div class="col-md-4">
                                <label for="patient_foam_gender" class="form-label">Gender <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="patient_foam_gender" name="patient_foam_gender"
                                    required>
                                    <option selected disabled value="">Choose Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>

                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="media" class="form-label">Where did you hear about us? <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="media" name="media" required>
                                    <option selected disabled value="">Choose Referece</option>
                                    <option value="Google">Google</option>
                                    <option value="Friend and Family">Friend and Family</option>
                                    <option value="Instagram and Facebook">Instagram and Facebook</option>
                                    <option value="Other">Other</option>
                                    <option value="Phamarcy">Phamarcy</option>
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4 form-label">

                                <label for="foam_textarea"></label>
                                <textarea class="form-control" name="foam_textarea" id="foam_textarea"></textarea>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-secondary" onclick="prevStep(4)">Previous</button>
                            <button type="button" name="submit" id="submit" class="btn btn-info text-white"
                                onclick="submitRegistration('registrationForm5')">Book Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- STEP 6: Success Message -->
        <div id="content-step-6" class="wizard-step-content">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5 text-center">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle"
                            style="width: 100px; height: 100px;">
                            <i class="fa-solid fa-check text-success fs-1"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-3">Appointment Successfully Booked!</h2>
                    <p class="text-muted fs-5 mb-5">Your appointment has been successfully scheduled. You can now sign
                        in to your dashboard to view and manage your appointments.</p>

                    <div id="zoom-link-container" class="d-none text-start bg-light p-4 rounded-3 mb-4 mx-auto"
                        style="max-width: 500px; border: 1px solid #e0e0e0; font-family: monospace; font-size: 1.1rem; line-height: 1.6;">
                        <div>Join Zoom Meeting</div>
                        <div class="mb-3"><a href="#" id="success-zoom-link" target="_blank"
                                class="text-break text-primary text-decoration-none"></a></div>
                        <div>Meeting ID: <span id="success-meeting-id"></span></div>
                        <div>Passcode: <span id="success-zoom-password"></span></div>
                    </div>

                    <div class="d-grid gap-3 d-sm-flex justify-content-center">
                        <a href="{{ route('login') }}" class="btn btn-info text-white px-5 py-3 fw-bold rounded-pill">
                            <i class="fa-solid fa-right-to-bracket me-2"></i> Sign In to Dashboard
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary px-5 py-3 rounded-pill">
                            Go Back Home
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wizard Indicators (Common) -->
        <div class="d-flex justify-content-center gap-3 mt-5" id="steps-indicator">
            <a href="javascript:void(0)" onclick="goToStep(1)" id="step1"
                class="badge rounded-circle bg-info p-3 text-white text-decoration-none step">1</a>
            <a href="javascript:void(0)" onclick="goToStep(2)" id="step2"
                class="badge rounded-circle bg-secondary p-3 text-white text-decoration-none step">2</a>
            <a href="javascript:void(0)" onclick="goToStep(3)" id="step3"
                class="badge rounded-circle bg-secondary p-3 text-white text-decoration-none step d-none">3</a>
            <a href="javascript:void(0)" onclick="goToStep(4)" id="step4"
                class="badge rounded-circle bg-secondary p-3 text-white text-decoration-none step">4</a>
            <a href="javascript:void(0)" onclick="goToStep(5)" id="step5"
                class="badge rounded-circle bg-secondary p-3 text-white text-decoration-none step">5</a>
        </div>

    </div>

    <!-- Modals (from cards.html) -->
    <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modal1Label">Web Development Registration</h5><button type="button"
                        class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registrationForm1" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                        </div>

                        <div class="mb-3">
                            <label for="height" class="form-label">Height</label>
                            <input type="text" class="form-control" id="height" name="height" required>
                        </div>

                        <div class="mb-3">
                            <label for="weight" class="form-label">Weight</label><input type="text" class="form-control"
                                name="weight" id="weight" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Gmail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="phone" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="allergies" class="form-label">Do you have any allergies?</label>
                            <select class="form-select" id="allergies" name="allergies" required>
                                <option selected disabled value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="medication" class="form-label">Are you currently taking any medication?</label>
                            <select class="form-select" id="medication" name="medication" required>
                                <option selected disabled value="">Choose Gender</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option selected disabled value="">Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitRegistration(1)">Book
                        Appointment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modal2Label">Digital Marketing Registration</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registrationForm2" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                        </div>
                        <div class="mb-3">
                            <label for="height" class="form-label">Height</label>
                            <input type="text" class="form-control" id="height" name="height" required>
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="text" class="form-control" id="weight" name="weight" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Gmail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="Phone" class="form-label">Phone</label>
                            <input type="Phone" class="form-control" id="Phone" name="Phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Do you have any allergies?</label>
                            <select class="form-select" name="allergies" required>
                                <option selected disabled value="">Choose Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Are you currently taking any medication?</label>
                            <select class="form-select" name="medication" required>
                                <option selected disabled value="">Choose Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option selected disabled value="">Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="submitRegistration(2)">Book
                        Appointment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3 -->
    <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modal3Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="modal3Label">Graphic Design Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registrationForm3" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                        </div>
                        <div class="mb-3">
                            <label for="height" class="form-label">Height</label>
                            <input type="text" class="form-control" id="height" name="height" required>
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="text" class="form-control" id="weight" name="weight" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Gmail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="Phone" class="form-label">Phone</label>
                            <input type="Phone" class="form-control" id="Phone" name="Phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Do you have any allergies?</label>
                            <select class="form-select" name="allergies" required>
                                <option selected disabled value="">Choose Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Are you currently taking any medication?</label>
                            <select class="form-select" name="medication" required>
                                <option selected disabled value="">Choose Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option selected disabled value="">Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning" onclick="submitRegistration(3)">Book
                        Appointment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 4 -->
    <div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="modal4Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="modal4Label">Mobile App Development Registration</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registrationForm4" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                        </div>
                        <div class="mb-3">
                            <label for="height" class="form-label">Height</label>
                            <input type="text" class="form-control" id="height" name="height" required>
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="text" class="form-control" id="weight" name="weight" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Gmail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="Phone" class="form-label">Phone</label>
                            <input type="Phone" class="form-control" id="Phone" name="Phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Do you have any allergies?</label>
                            <select class="form-select" name="allergies" required>
                                <option selected disabled value="">Choose Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Are you currently taking any medication?</label>
                            <select class="form-select" name="medication" required>
                                <option selected disabled value="">Choose Option</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option selected disabled value="">Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" onclick="submitRegistration(4)">Book Appointment</button>
                </div>
            </div>
        </div>
    </div>




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
                    <p style="color: #94a3b8; line-height: 1.8;">Leading the way in medical excellence since 2001. We provide compassionate care combined with cutting-edge medical technology to ensure the best outcomes for our patients.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="btn btn-primary p-0 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-primary p-0 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="btn btn-primary p-0 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 offset-lg-1 col-md-4 footer-links">
                    <h4>Department</h4>
                    <ul>
                        <li><a href="#">Cardiology</a></li>
                        <li><a href="#">Neurology</a></li>
                        <li><a href="#">Pediatrics</a></li>
                        <li><a href="#">Orthopedics</a></li>
                        <li><a href="#">Dermatology</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('service') }}">Services</a></li>
                        <li><a href="#">Our Doctors</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 footer-links">
                    <h4>Contact Us</h4>
                    <p style="color: #94a3b8; font-size: 0.95rem; margin-bottom: 1.5rem;"><i class="fa-solid fa-location-dot text-primary-light me-3"></i> 123 Healthcare Ave, Dublin 1, IE</p>
                    <p style="color: #94a3b8; font-size: 0.95rem; margin-bottom: 1.5rem;"><i class="fa-solid fa-phone text-primary-light me-3"></i> +353 1 960 9912</p>
                    <p style="color: #94a3b8; font-size: 0.95rem;"><i class="fa-solid fa-envelope text-primary-light me-3"></i> info@citycentral.ie</p>
                </div>
            </div>
            
            <div class="text-center mt-5 pt-5 border-top border-secondary opacity-50">
                <p class="small mb-0">&copy; 2026 City Central Hospital. Designed for Medical Excellence.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Navigation Drawer -->
    <div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
    <div class="mobile-nav-drawer" id="mobileNavDrawer">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <span class="fs-5 fw-bold" style="color: var(--primary);">MENU</span>
            <button class="btn p-0" id="closeMobileMenu"><i class="fa-solid fa-xmark fs-4" style="color: var(--primary-light);"></i></button>
        </div>
        <ul class="mobile-nav-links">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('about')}}">About</a></li>
            <li><a href="{{route('service')}}">Services</a></li>
            <li><a href="#">Doctors</a></li>
            <li><a href="{{route('contact')}}">Contact</a></li>
        </ul>
        <div class="mt-5 d-flex flex-column gap-3">
            <a href="{{ route('login') }}" class="btn btn-outline w-100 text-center">SIGN IN</a>
            <a href="{{ route('appointment') }}" class="btn btn-primary w-100 text-center">BOOK NOW</a>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (single load) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        /* ===== Mobile Menu Toggle ===== */
        (function() {
            const toggle  = document.getElementById('mobileMenuToggle');
            const close   = document.getElementById('closeMobileMenu');
            const drawer  = document.getElementById('mobileNavDrawer');
            const overlay = document.getElementById('mobileNavOverlay');

            function openMenu() {
                drawer.classList.add('active');
                overlay.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
            function closeMenu() {
                drawer.classList.remove('active');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }

            if (toggle)  toggle.addEventListener('click', openMenu);
            if (close)   close.addEventListener('click', closeMenu);
            if (overlay) overlay.addEventListener('click', closeMenu);
        })();
    </script>
    <script>
        let currentStep = 1;
        let wizardAccountMode = 'register';

        function setWizardAccountMode(mode, keepError = false) {
            wizardAccountMode = mode;
            const title = document.getElementById('wizard-account-title');
            const desc = document.getElementById('wizard-account-desc');
            const nextBtn = document.getElementById('wizard-next-btn');
            const loginSubmit = document.getElementById('wizard-login-submit');
            const btnRegister = document.getElementById('btn-mode-register');
            const btnLogin = document.getElementById('btn-mode-login');

            // Containers
            const regInputs = document.getElementById('registration-inputs');
            const loginInputs = document.getElementById('login-inputs');

            // Errors/Alerts
            const emailError = document.getElementById('email-error');
            const accountFoundAlert = document.getElementById('account-found-alert');
            const regEmailInput = document.getElementById('reg_email');

            if (mode === 'login') {
                title.textContent = "Login";
                desc.textContent = "Please enter your credentials to access your account and book an appointment.";
                if (nextBtn) nextBtn.classList.add('d-none');
                if (loginSubmit) loginSubmit.classList.remove('d-none');
                if (btnRegister) btnRegister.classList.remove('active');
                if (btnLogin) btnLogin.classList.add('active');

                // Show Login inputs, hide Registration
                if (regInputs) regInputs.classList.add('d-none');
                if (loginInputs) loginInputs.classList.remove('d-none');

                if (!keepError) {
                    if (accountFoundAlert) accountFoundAlert.classList.add('d-none');
                    if (emailError) emailError.classList.add('d-none');
                    if (regEmailInput) regEmailInput.classList.remove('is-invalid');
                }
            } else {
                title.textContent = "Create Account";
                desc.textContent = "Please provide your email and create a password to continue with your appointment registration.";
                if (nextBtn) nextBtn.classList.remove('d-none');
                if (loginSubmit) loginSubmit.classList.add('d-none');
                if (btnRegister) btnRegister.classList.add('active');
                if (btnLogin) btnLogin.classList.remove('active');

                // Show Registration inputs, hide Login
                if (regInputs) regInputs.classList.remove('d-none');
                if (loginInputs) loginInputs.classList.add('d-none');

                if (!keepError) {
                    if (emailError) emailError.classList.add('d-none');
                    if (regEmailInput) regEmailInput.classList.remove('is-invalid');
                    if (accountFoundAlert) accountFoundAlert.classList.add('d-none');
                }
            }
        }

        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.wizard-step-content').forEach(el => el.classList.remove('active'));
            // Show target step
            const target = document.getElementById(`content-step-${step}`);
            if (target) target.classList.add('active');

            // Update indicators state colors
            document.querySelectorAll('.step').forEach(s => {
                s.classList.remove('bg-info');
                s.classList.add('bg-secondary');
            });
            const activeInd = document.getElementById(`step${step}`);
            if (activeInd) {
                activeInd.classList.remove('bg-secondary');
                activeInd.classList.add('bg-info');
            }

            // Scroll to top
            window.scrollTo(0, 0);
            currentStep = step;
        }

        async function nextStep(step) {
            const appType = document.getElementById('appointmentType').value;
            // Enhanced logic for Step 2
            if (currentStep === 2) {
                // If already logged in, skip checks
                if (window.wizardLoggedIn) {
                    proceedToNextStep();
                    return;
                }

                // If in login mode, rely on Login button
                if (wizardAccountMode === 'login') {
                    handleWizardLogin();
                    return;
                }

                const emailInput = document.getElementById('reg_email');
                const passwordInput = document.getElementById('reg_password');
                const email = emailInput.value.trim();
                const password = passwordInput.value.trim();
                const emailError = document.getElementById('email-error');

                if (!email || !password) {
                    alert("Please fill in both Email and Password fields.");
                    return;
                }

                // Final Duplicate Check on Next click
                try {
                    const response = await fetch("/check-email", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ email: email })
                    });
                    const data = await response.json();

                    if (data.exists) {
                        const accountFoundAlert = document.getElementById('account-found-alert');
                        if (accountFoundAlert) accountFoundAlert.classList.remove('d-none');

                        emailError.textContent = "this email already exit";
                        emailError.classList.remove('d-none');
                        emailInput.classList.add('is-invalid');

                        // Switch to login but block next
                        setWizardAccountMode('login', true);

                        // Populate login email
                        const loginEmailInput = document.getElementById('login_email');
                        if (loginEmailInput) loginEmailInput.value = email;

                        return; // BLOCK PROGRESS
                    } else {
                        proceedToNextStep();
                    }
                } catch (error) {
                    console.error('Error checking email:', error);
                    proceedToNextStep(); // Fallback
                }
            } else {
                showStep(step);
            }

            function proceedToNextStep() {
                let next = step;
                if (appType.includes('Telephone') || appType.includes('Video')) {
                    next = 4;
                } else if (appType.includes('Counselling')) {
                    next = 3;
                } else {
                    next = 4;
                }
                showStep(next);
            }
        }

        async function handleWizardLogin() {
            const email = document.getElementById('login_email').value.trim();
            const password = document.getElementById('login_password').value.trim();

            if (!email || !password) {
                alert("Please enter both Email and Password to login.");
                return;
            }

            try {
                // Show loading state on button
                const loginBtn = document.getElementById('wizard-login-submit');
                const originalText = loginBtn.innerHTML;
                loginBtn.disabled = true;
                loginBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Logging in...';

                const response = await fetch("/login-wizard", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email: email, password: password })
                });

                if (response.status === 419) {
                    location.reload();
                    return;
                }
                const data = await response.json();

                if (data.success) {
                    // Update CSRF tokens in the DOM to prevent mismatch
                    if (data.new_csrf_token) {
                        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                        if (csrfMeta) csrfMeta.setAttribute('content', data.new_csrf_token);

                        // Update ALL hidden token inputs across all forms
                        document.querySelectorAll('input[name="_token"]').forEach(input => {
                            input.value = data.new_csrf_token;
                        });

                        // Set a global variable for reference
                        window.currentCsrfToken = data.new_csrf_token;
                    }

                    // Show success UI
                    const successMsg = document.getElementById('login-success-msg');
                    const emailInput = document.getElementById('login_email');
                    const passInput = document.getElementById('login_password');
                    const nextBtn = document.getElementById('wizard-next-btn');

                    if (successMsg) successMsg.classList.remove('d-none');
                    // Show success state on button
                    loginBtn.innerHTML = '<i class="fa-solid fa-check"></i> Logged In';

                    // Mark as logged in via wizard to skip duplicate email check in nextStep
                    window.wizardLoggedIn = true;

                    // Automatically proceed to next step after a short delay
                    setTimeout(() => {
                        nextStep(3);
                    }, 800);
                } else {
                    loginBtn.disabled = false;
                    loginBtn.innerHTML = originalText;
                    alert(data.message || "The provided credentials do not match our records.");
                }
            } catch (error) {
                console.error('Error logging in:', error);
                alert("An error occurred during login. Please try again.");
                const loginBtn = document.getElementById('wizard-login-submit');
                if (loginBtn) {
                    loginBtn.disabled = false;
                    loginBtn.innerHTML = 'Login';
                }
            }
        }

        function prevStep(step) {
            const appType = document.getElementById('appointmentType').value;
            if (currentStep === 5) {
                step = 4;
            } else if (currentStep === 4) {
                // Telephone and Video both skip Step 3, so back to 2
                step = 2;
            } else if (currentStep === 3) {
                step = 2;
            }
            showStep(step);
        }

        function goToStep(step) {
            // Logic to prevent jumping ahead? For now allow.
            showStep(step);
        }

        function togglePassword(id) {
            const pass = document.getElementById(id);
            if (pass) {
                pass.type = pass.type === "password" ? "text" : "password";
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const appointmentType = document.getElementById('appointmentType');
            const appointmentDate = document.getElementById('appointmentDate');
            if (appointmentDate) {
                const today = new Date().toISOString().split('T')[0];
                appointmentDate.setAttribute('min', today);
            }
            const timeSlotsContainer = document.getElementById('timeSlotsContainer');
            const timeSlotsSection = document.getElementById('timeSlots');
            const step3 = document.getElementById('step3');
            const step4 = document.getElementById('step4');

            // Time Slots Generation (mimicking original logic)
            // Original logic generated 08:00 to 20:00 every 15 mins
            const timeSlots = [];
            for (let h = 8; h <= 20; h++) {
                for (let m = 0; m < 60; m += 15) {
                    if (h === 20 && m > 0) break;
                    const time = `${h.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')}`;
                    timeSlots.push(time);
                }
            }

            function generateTimeSlots() {
                timeSlotsContainer.innerHTML = '';
                timeSlots.forEach(time => {
                    const btn = document.createElement('button');
                    btn.className = 'btn btn-outline-info';
                    btn.textContent = time;
                    btn.onclick = function () {
                        document.querySelectorAll('#timeSlotsContainer button').forEach(b => {
                            b.classList.remove('btn-info', 'text-white');
                            b.classList.add('btn-outline-info');
                        });
                        this.classList.remove('btn-outline-info');
                        this.classList.add('btn-info', 'text-white');
                    };
                    timeSlotsContainer.appendChild(btn);
                });
            }

            // Date Change
            appointmentDate.addEventListener('change', function () {
                if (this.value) {
                    timeSlotsSection.classList.remove('d-none');
                    generateTimeSlots();
                } else {
                    timeSlotsSection.classList.add('d-none');
                }
            });

            // Type Change - Toggle Indicators
            appointmentType.addEventListener('change', function () {
                const value = this.value;
                const step5 = document.getElementById('step5');
                if (value.includes('Counselling')) {
                    // Show Step 3, Hide Step 4 and 5
                    step3.classList.remove('d-none');
                    step4.classList.add('d-none');
                    if (step5) step5.classList.add('d-none');
                } else if (value.includes('Telephone') || value.includes('Video')) {
                    // Show Step 4 and 5, Hide Step 3
                    step4.classList.remove('d-none');
                    if (step5) step5.classList.remove('d-none');
                    step3.classList.add('d-none');
                } else {
                    // Default
                    step4.classList.remove('d-none');
                    if (step5) step5.classList.remove('d-none');
                    step3.classList.add('d-none');
                }
            });

            // Conditional Form Fields Logic
            const hasMedicalHistory = document.getElementById('hasMedicalHistory');
            const medicalHistoryDetailsContainer = document.getElementById('medicalHistoryDetailsContainer');

            const hasMedications = document.getElementById('hasMedications');
            const medicationDetailsContainer = document.getElementById('medicationDetailsContainer');

            const hasAllergies = document.getElementById('hasAllergies');
            const allergyDetailsContainer = document.getElementById('allergyDetailsContainer');

            if (hasMedicalHistory) {
                hasMedicalHistory.addEventListener('change', function () {
                    medicalHistoryDetailsContainer.classList.toggle('d-none', this.value !== 'Yes');
                });
            }

            if (hasMedications) {
                hasMedications.addEventListener('change', function () {
                    medicationDetailsContainer.classList.toggle('d-none', this.value !== 'Yes');
                });
            }

            if (hasAllergies) {
                hasAllergies.addEventListener('change', function () {
                    allergyDetailsContainer.classList.toggle('d-none', this.value !== 'Yes');
                });
            }

            const pharmacyInfoName = document.getElementById('pharmacyInfoName');
            const pharmacyInfoCounty = document.getElementById('pharmacyInfoCounty');
            const pharmacyInfoPhone = document.getElementById('pharmacyInfoPhone');
            const hiddenPharmacyPhone = document.getElementById('pharmacyPhone');

            const pharmacyData = {
    "Carlow": [
        {
            "name": "Arthur Kennedy Chemist",
            "street": "Main Street,",
            "city": "Hacketstown",
            "county": "Carlow",
            "phone": "596471282"
        },
        {
            "name": "Askea Pharmacy",
            "street": "Tullow Road, Carlow",
            "city": "Carlow",
            "county": "Carlow",
            "phone": "599142333"
        },
        {
            "name": "Bagenalstown Pharmacy",
            "street": "4 Main street bagenalstown,",
            "city": "Bagenalstown",
            "county": "Carlow",
            "phone": "599721955"
        },
        {
            "name": "Ballon Pharmacy",
            "street": "Unit 3 , Main Street",
            "city": "Ballon",
            "county": "Carlow",
            "phone": "599159673"
        },
        {
            "name": "Beechwood Nursing Home",
            "street": "Rathvindon,",
            "city": "Leighlinbridge",
            "county": "Carlow",
            "phone": "599722366"
        },
        {
            "name": "Borris Lodge Nursing Home",
            "street": "Borris,",
            "city": "Carlow",
            "county": "Carlow",
            "phone": "(059) 97 73112"
        },
        {
            "name": "CAHG PHARMACY",
            "street": "Tullow Industrial estate,",
            "city": "Tullow",
            "county": "Carlow",
            "phone": "599151251"
        },
        {
            "name": "Chemco Pharmacy",
            "street": "Sandhills Shopping center,",
            "city": "Carlow",
            "county": "Carlow",
            "phone": "599173030"
        },
        {
            "name": "Chemco Pharmacy",
            "street": "Unit 1b, , Graigue Village centre,",
            "city": "Graiguecullen",
            "county": "Carlow",
            "phone": "599131567"
        },
        {
            "name": "Chemist Warehouse Carlow",
            "street": "Unit 2, Four lakes retail park , Dublin Road",
            "city": "Carlow",
            "county": "Carlow",
            "phone": "046 901 5732"
        },
        {
            "name": "CORLESS PHARMACY",
            "street": "44 Dublin street, Carlow",
            "city": "Carlow",
            "county": "Carlow",
            "phone": "(059) 9131734"
        },
        {
            "name": "Fairgreen CarePlus",
            "street": "Church St,",
            "city": "Bagenalstown",
            "county": "Carlow",
            "phone": "599721505"
        },
        {
            "name": "Healy's Pharmacy",
            "street": "24 Main street,",
            "city": "Bagenalstown",
            "county": "Carlow",
            "phone": "059 9721408"
        },
        {
            "name": "Kelly's Pharmacy",
            "street": "Kennedy Avenue,",
            "city": "Carlow",
            "county": "Carlow",
            "phone": "599143007"
        },
        {
            "name": "Kellys Pharmacy",
            "street": "Unit 3 Staplestown road,",
            "city": "Carlow Town",
            "county": "Carlow",
            "phone": "599141979"
        },
        {
            "name": "Kellys Pharmacy",
            "street": "Unit 9 Barrow valley retail park,",
            "city": "Graiguecullen",
            "county": "Carlow",
            "phone": "599179702"
        },
        {
            "name": "Leighlin Pharmacy",
            "street": "St. Lazerians street,",
            "city": "Leighlinbridge",
            "county": "Carlow",
            "phone": "599720543"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "21 Tullow st,",
            "city": "Carlow",
            "county": "Carlow",
            "phone": "00 353 59 9131467"
        },
        {
            "name": "Odeacodycoffey.Gp@Healthmail.Ie",
            "street": "Medical Centre, Bachelors Walk",
            "city": "Bagenalstown",
            "county": "Carlow",
            "phone": "599721650"
        }
    ],
    "Cavan": [
        {
            "name": "Arvagh Medical Centre",
            "street": "Broad Road,",
            "city": "Arvagh",
            "county": "Cavan",
            "phone": "494335146"
        },
        {
            "name": "Arvagh Pharmacy",
            "street": "Main Street, Arvagh",
            "city": "Cavan",
            "county": "Cavan",
            "phone": "494328550"
        },
        {
            "name": "Ballyconnell Dental Surgery",
            "street": "Main Street,",
            "city": "Ballyconnell",
            "county": "Cavan",
            "phone": "00353 499526793"
        },
        {
            "name": "Ballyhaise Pharmacy",
            "street": "The Square ,",
            "city": "Ballyhaise",
            "county": "Cavan",
            "phone": "494351984"
        },
        {
            "name": "Ballyjamesduff",
            "street": "Ballyjamesduff Family practice,granard  road, Ballyjamesduff",
            "city": "Ballyjamesduff",
            "county": "Cavan",
            "phone": "498544595"
        },
        {
            "name": "Belturbet Medical Practice",
            "street": "Deanery Street,",
            "city": "Belturbet",
            "county": "Cavan",
            "phone": "499522317"
        },
        {
            "name": "Belturbet Pharmacy",
            "street": "Lower Bridge st, Belturbet",
            "city": "Cavan",
            "county": "Cavan",
            "phone": "499524477"
        },
        {
            "name": "BLACKLION HEALTH CENTRE",
            "street": "Main Street,",
            "city": "Blacklion",
            "county": "Cavan",
            "phone": "071 9853218"
        },
        {
            "name": "Boots",
            "street": "91 Main st,",
            "city": "Cavan",
            "county": "Cavan",
            "phone": "494380699"
        },
        {
            "name": "Browne's Pharmacy",
            "street": "26 Market st,",
            "city": "Cootehill",
            "county": "Cavan",
            "phone": "049 555 6666"
        },
        {
            "name": "Callans Pharmacy",
            "street": "Main St, Kingscourt",
            "city": "Kingscourt",
            "county": "Cavan",
            "phone": "042 96673285289"
        },
        {
            "name": "Cara Pharmacy",
            "street": "77 Main street, Cavan",
            "city": "Cavan",
            "county": "Cavan",
            "phone": "494331176"
        },
        {
            "name": "Cara Pharmacy",
            "street": "Main Street, Ballyconnell",
            "city": "Ballyconnell",
            "county": "Cavan",
            "phone": "499526159"
        },
        {
            "name": "Cara Pharmacy",
            "street": "Main Street ,",
            "city": "Bailieborough",
            "county": "Cavan",
            "phone": "429665551"
        },
        {
            "name": "Dr Geoffrey Bourke",
            "street": "Health Centre,",
            "city": "Ballyconnell",
            "county": "Cavan",
            "phone": "049 9522642"
        },
        {
            "name": "Dunaree Pharmacy",
            "street": "Kingscourt Primary care centre, Kells Road",
            "city": "Kingscourt",
            "county": "Cavan",
            "phone": "429668565"
        },
        {
            "name": "Foster'S Pharmacy",
            "street": "Main Street,",
            "city": "Arva",
            "county": "Cavan",
            "phone": "494335308"
        },
        {
            "name": "Fosters",
            "street": "Main Street, Corlespratten",
            "city": "Carrigallen",
            "county": "Cavan",
            "phone": "494339078"
        },
        {
            "name": "Gormleys",
            "street": "Main Street,",
            "city": "Ballyjamesduff",
            "county": "Cavan",
            "phone": "498544027"
        },
        {
            "name": "Greenes Pharmacy",
            "street": "Chaple St,",
            "city": "Ballyjamesduff",
            "county": "Cavan",
            "phone": "498544415"
        },
        {
            "name": "Haven Pharmacy Brennans",
            "street": "Loughtee Business park, Cootehill Rd",
            "city": "Cavan Town",
            "county": "Cavan",
            "phone": "049 4373912"
        },
        {
            "name": "Jamesons Totalhealth Pharmacy",
            "street": "Main St, Bailieborough",
            "city": "Bailieborough",
            "county": "Cavan",
            "phone": "042 9665443"
        },
        {
            "name": "Lynch'S Pharmacy",
            "street": "Virginia Shopping centre,",
            "city": "Virginia",
            "county": "Cavan",
            "phone": "049 8548708"
        },
        {
            "name": "MacManus Pharmacy",
            "street": "Macmanus Pharmacy, 12 Townhall street",
            "city": "Cavan",
            "county": "Cavan",
            "phone": "049-4331317"
        },
        {
            "name": "MacManus Pharmacy",
            "street": "Main St, Ballyconnell",
            "city": "Ballyconnell",
            "county": "Cavan",
            "phone": "049 9526355"
        },
        {
            "name": "MacManus Pharmacy",
            "street": "Main St belturbet, Belturbet",
            "city": "Cavan",
            "county": "Cavan",
            "phone": "499522139"
        },
        {
            "name": "Markeys Pharmacy",
            "street": "24 Bridge street, Cootehill",
            "city": "Cootheill",
            "county": "Cavan",
            "phone": "495555422"
        }
    ],
    "Clare": [
        {
            "name": "Abbey Medical Centre",
            "street": "Westgate Business park,, Kilrush Road,",
            "city": "Ennis,",
            "county": "Clare",
            "phone": "065 6829975"
        },
        {
            "name": "Abbey Medical Centre",
            "street": "Westgate Business park,, Kilrush Road,",
            "city": "Ennis,",
            "county": "Clare",
            "phone": "065 6829975"
        },
        {
            "name": "Alexandra Dental Practice",
            "street": "Unit 5, Shannon Town centre",
            "city": "Shannon",
            "county": "Clare",
            "phone": "61708461"
        },
        {
            "name": "Ardlea Medical Practice",
            "street": "79 O'connell st,",
            "city": "Ennis",
            "county": "Clare",
            "phone": "065 6844455"
        },
        {
            "name": "Athlunkard House Nursing Home",
            "street": "St Nicholas, Westbury",
            "city": "Co Clare via limerick",
            "county": "Clare",
            "phone": "61345150"
        },
        {
            "name": "Ballycasey Pharmacy",
            "street": "Ballycasey Crescent,",
            "city": "Shannon",
            "county": "Clare",
            "phone": "61363853"
        },
        {
            "name": "Ballyvaughan Medical Centre",
            "street": "Ballyvaughan,",
            "city": "Ballyvaughan",
            "county": "Clare",
            "phone": "065 7077035"
        },
        {
            "name": "Boots",
            "street": "40-42 O'connell street,",
            "city": "Ennis",
            "county": "Clare",
            "phone": "656868394"
        },
        {
            "name": "Burren Pharmacy",
            "street": "The Square,",
            "city": "Ennis",
            "county": "Clare",
            "phone": "657074104"
        },
        {
            "name": "C&F Pharmacy",
            "street": "Market Place,",
            "city": "Ennis",
            "county": "Clare",
            "phone": "656829328"
        },
        {
            "name": "CLARECASTLE PHARMACY",
            "street": "Barrack St, Clarecastle",
            "city": "Clarecastle",
            "county": "Clare",
            "phone": "065 6842211"
        },
        {
            "name": "Corbally Pharmacy",
            "street": "Applegreen Service station, Corbally Pharmacy",
            "city": "Shannon Banks",
            "county": "Clare",
            "phone": "61349930"
        },
        {
            "name": "Duffys Pharmacy",
            "street": "Unit 13, Tesco Shopping centre",
            "city": "Ennis",
            "county": "Clare",
            "phone": "065 6828833"
        },
        {
            "name": "Fennells Pharmacy",
            "street": "Oconnells Square,",
            "city": "Ennis",
            "county": "Clare",
            "phone": "656797621"
        },
        {
            "name": "Fennells Pharmacy Clareabbey",
            "street": "Vision House, Clareabbey",
            "city": "Clarecastle",
            "county": "Clare",
            "phone": "656866601"
        },
        {
            "name": "Flynn's Life Pharmacy",
            "street": "Gort Road,",
            "city": "Ennis",
            "county": "Clare",
            "phone": "656864477"
        },
        {
            "name": "Green Cross Pharmacy",
            "street": "Convent Hill Centre",
            "city": "Killaloe",
            "county": "Clare",
            "phone": "61620128"
        },
        {
            "name": "Haven Pharmacy Hollys",
            "street": "23 Abbey st,",
            "city": "Ennis",
            "county": "Clare",
            "phone": "656828568"
        },
        {
            "name": "Hetherton Pharmacy Ltd",
            "street": "Church Street, Kilmihil",
            "city": "Kilmihil",
            "county": "Clare",
            "phone": "659050006"
        },
        {
            "name": "Hurst Pharmacy",
            "street": "36 O`curry street, Dough",
            "city": "Kilkee",
            "county": "Clare",
            "phone": "659083551"
        },
        {
            "name": "Keatings Careplus Pharmacy",
            "street": "Westbury Centre , Corbally",
            "city": "Clare",
            "county": "Clare",
            "phone": "61348616"
        },
        {
            "name": "Kilrush Pharmacy",
            "street": "Frances St,",
            "city": "Kilrush",
            "county": "Clare",
            "phone": "659051029"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Skycourt S.C.,",
            "city": "Shannon",
            "county": "Clare",
            "phone": "061 360716"
        },
        {
            "name": "MacMahon'S Pharmacy",
            "street": "Main Street,",
            "city": "Kildysart",
            "county": "Clare",
            "phone": "(065) 683 2110"
        },
        {
            "name": "Malones Totalhealth Pharmacy",
            "street": "Frances St,",
            "city": "Kilrush",
            "county": "Clare",
            "phone": "065 9052552"
        },
        {
            "name": "Marie Kelly Pharmacy",
            "street": "Main Street, Miltown Malby",
            "city": "Miltown Malby",
            "county": "Clare",
            "phone": "065 7084440"
        },
        {
            "name": "Mc Loughlins Pharmacy",
            "street": "Unit 4,dunnes Stores shopping centre, O'connell St.,",
            "city": "Ennis",
            "county": "Clare",
            "phone": "(065) 6829511"
        }
    ],
    "Cork": [
        {
            "name": "Aghada Pharmacy",
            "street": "1 Lower aghada,",
            "city": "Aghada",
            "county": "Cork",
            "phone": "214662515"
        },
        {
            "name": "Airport Dental,",
            "street": "Rathmacullig West, Farmers Cross",
            "city": "Ballygarvan",
            "county": "Cork",
            "phone": "214322854"
        },
        {
            "name": "Airport Medical Cork",
            "street": "Rathmacullig West, Farmers Cross",
            "city": "Cork",
            "county": "Cork",
            "phone": "21963987"
        },
        {
            "name": "Aisling Holland Physiotherapy Macroom",
            "street": "Unit 3 Macroom enterprise centre,, Bowl Road",
            "city": "Macroom",
            "county": "Cork",
            "phone": "873877626"
        },
        {
            "name": "Allcare Late Night Wilton",
            "street": "4 Cardinal way, Wilton",
            "city": "Cork",
            "county": "Cork",
            "phone": "214344575"
        },
        {
            "name": "Allcare O'Reillys Pharmacy",
            "street": "17 Pearse square,",
            "city": "Fermoy",
            "county": "Cork",
            "phone": "025 31890"
        },
        {
            "name": "Allcare Turners Cross",
            "street": "1 Ossary place, Evergreen Rd.,",
            "city": "Turners Cross",
            "county": "Cork",
            "phone": "214317941"
        },
        {
            "name": "Amberley Home And Cottages",
            "street": "Acres, Fermoy",
            "city": "Co Cork",
            "county": "Cork",
            "phone": "2540900"
        },
        {
            "name": "AMS Diagnostics",
            "street": "1 Cleve business park, Monahan Road",
            "city": "Cork City",
            "county": "Cork",
            "phone": "021 4297686"
        },
        {
            "name": "Apple Dental Wellness",
            "street": "Apple Industrial est., Hollyhill",
            "city": "Cork",
            "county": "Cork",
            "phone": "214229833"
        },
        {
            "name": "Araglen House Nursing Home",
            "street": "Loumanagh, Boherbue",
            "city": "Mallow",
            "county": "Cork",
            "phone": "2976771"
        },
        {
            "name": "Ard Na Mara",
            "street": "Ballyhimkin ,",
            "city": "Ladysbridge",
            "county": "Cork",
            "phone": "021-4646366"
        },
        {
            "name": "Ardfallen Pharmacy",
            "street": "Unit 2 Ardfallen mall, Douglas Road",
            "city": "Cork",
            "county": "Cork",
            "phone": "021 429 2256"
        },
        {
            "name": "Ardrum Clinic",
            "street": "Ardrum House , Bishopstown Road",
            "city": "Cork",
            "county": "Cork",
            "phone": "214800888"
        },
        {
            "name": "Ardrum Clinic",
            "street": "Ardrum House , Bishopstown Road",
            "city": "Cork",
            "county": "Cork",
            "phone": "214800888"
        },
        {
            "name": "Arena Clinic",
            "street": "Mardyke Arena ucc, Mardyke Walk, western road",
            "city": "Cork",
            "county": "Cork",
            "phone": "(021) 4904760"
        },
        {
            "name": "Atlantic Nutrition & Therapy Clinic",
            "street": "Cois Na mara,, Harbourview",
            "city": "Kilbrittain",
            "county": "Cork",
            "phone": "872313521"
        },
        {
            "name": "Ballincollig Allcare Pharmacy",
            "street": "Main Street",
            "city": "Ballincollig",
            "county": "Cork",
            "phone": "214874050"
        },
        {
            "name": "Ballincollig Community Nursing Unit",
            "street": "Murphys Barracks road,",
            "city": "Ballincollig",
            "county": "Cork",
            "phone": "214620600"
        },
        {
            "name": "Ballincollig Community Nursing Unit",
            "street": "Murphys Barracks road,",
            "city": "Ballincollig",
            "county": "Cork",
            "phone": "214620600"
        },
        {
            "name": "Ballincollig Dental",
            "street": "East Gate , Ballincollig",
            "city": "Cork",
            "county": "Cork",
            "phone": "214810404"
        },
        {
            "name": "Ballincollig Physiotherapy",
            "street": "Unit 8,, Bar Rna sraide,",
            "city": "Ballincollig",
            "county": "Cork",
            "phone": "021 487 4848"
        },
        {
            "name": "Ballincurrig Care Centre",
            "street": "Ballincurrig, Leamlara",
            "city": "Midleton",
            "county": "Cork",
            "phone": "021 4642130"
        },
        {
            "name": "BallineenEnniskeane",
            "street": "Ballineen, Co Cork",
            "city": "Co Cork",
            "county": "Cork",
            "phone": "023 8847106"
        },
        {
            "name": "Ballintemple Allcare Pharmacy",
            "street": "1a Maryville, Ballintemple",
            "city": "Cork City",
            "county": "Cork",
            "phone": "021 4292573"
        },
        {
            "name": "Ballycotton Medical Centre",
            "street": "Ballycotton,",
            "city": "Midleton",
            "county": "Cork",
            "phone": "214647806"
        },
        {
            "name": "Ballymodan Family Practice",
            "street": "Ballymodan Place,",
            "city": "Bandon",
            "county": "Cork",
            "phone": "238844577"
        },
        {
            "name": "Ballyvourney",
            "street": "Co Cork,",
            "city": "Ballyvourney",
            "county": "Cork",
            "phone": "2645687"
        },
        {
            "name": "Bandon Medical Clinic",
            "street": "11 Oliver plunkett st.,",
            "city": "Bandon",
            "county": "Cork",
            "phone": "238842253"
        },
        {
            "name": "Bandon Medical Hall",
            "street": "5/6 Bridge street ,",
            "city": "Bandon",
            "county": "Cork",
            "phone": "238841115"
        },
        {
            "name": "Bantry Pharmacy",
            "street": "Bantry Primary care centre, Dromleigh South",
            "city": "Bantry",
            "county": "Cork",
            "phone": "2789020"
        },
        {
            "name": "Bantry Physiotherapy Clinic",
            "street": "Glengarriff Road,",
            "city": "Bantry",
            "county": "Cork",
            "phone": "087 7038725"
        },
        {
            "name": "Beaumont Residential Care",
            "street": "Woodvale Road, Beaumont",
            "city": "Cork",
            "county": "Cork",
            "phone": "214292195"
        },
        {
            "name": "Belvedere Dental Care",
            "street": "Belvedere Lawn, Douglas Road",
            "city": "Cork",
            "county": "Cork",
            "phone": "214295556"
        },
        {
            "name": "Berehaven Pharmacy",
            "street": "7 Main street,",
            "city": "Castletownbere",
            "county": "Cork",
            "phone": "2771554"
        },
        {
            "name": "Bishopscourt Residential Care, Ltd",
            "street": "Liskillea, Waterfall",
            "city": "Near Cork",
            "county": "Cork",
            "phone": "(021)4885833"
        },
        {
            "name": "Bishopstown Dental Clinic",
            "street": "Inverell, Bishopstown Road",
            "city": "Cork",
            "county": "Cork",
            "phone": "214543364"
        },
        {
            "name": "Bishopstown Pharmacy",
            "street": "Bishopstown Road,",
            "city": "Bishopstown",
            "county": "Cork",
            "phone": "214343344"
        },
        {
            "name": "Blackpool Bridge Surgery",
            "street": "83 Thomas davis st., Blackpool",
            "city": "Cork.",
            "county": "Cork",
            "phone": "021 4303543"
        },
        {
            "name": "Blackpool Late Night Pharmacy",
            "street": "Unit 4 City square, Watercourse Road",
            "city": "Blackpool",
            "county": "Cork",
            "phone": "214500009"
        },
        {
            "name": "Blackpool Medical Centre",
            "street": "90 Great william o'brien st., Blackpool",
            "city": "Cork",
            "county": "Cork",
            "phone": "214505118"
        },
        {
            "name": "Blackpool Physiotherapy & Sports Injury Clinic",
            "street": "Unit 5a Kilnap business pk, Mallow Road",
            "city": "Cork",
            "county": "Cork",
            "phone": "852802877"
        },
        {
            "name": "Blackrock Medical Centre",
            "street": "74 Skehard road, Blackrock",
            "city": "Cork",
            "county": "Cork",
            "phone": "+353214892996"
        },
        {
            "name": "Blackrock Medical Centre",
            "street": "74 Skehard road, Blackrock",
            "city": "Cork",
            "county": "Cork",
            "phone": "+353214892996"
        },
        {
            "name": "Blair's Hill Nursing Home",
            "street": "Sunday's Well,",
            "city": "Cork City",
            "county": "Cork",
            "phone": "214304229"
        },
        {
            "name": "Bluetts Pharmacy",
            "street": "1 Pearse st,",
            "city": "Clonakilty",
            "county": "Cork",
            "phone": "+353876454078"
        },
        {
            "name": "Bon Secours Care Village",
            "street": "Mount Desert, Lee Road",
            "city": "Cork",
            "county": "Cork",
            "phone": "021 454 1566"
        },
        {
            "name": "Bon Secours Pharmacy",
            "street": "College Road, Cork",
            "city": "Cork",
            "county": "Cork",
            "phone": "214801758"
        },
        {
            "name": "Boots",
            "street": "71/72 Patrick st,",
            "city": "Cork",
            "county": "Cork",
            "phone": "(021) 4275523"
        },
        {
            "name": "Boots",
            "street": "Half Moon st, Cork",
            "city": "Cork City",
            "county": "Cork",
            "phone": "021 4273736 ext 3"
        },
        {
            "name": "Boots",
            "street": "13/14 Douglas court sc,",
            "city": "Douglas",
            "county": "Cork",
            "phone": "021 4364584"
        },
        {
            "name": "Boots",
            "street": "Unit 7 Owenabue mall, Main St",
            "city": "Carrigaline",
            "county": "Cork",
            "phone": "(021) 437 6678"
        },
        {
            "name": "Boots",
            "street": "Merchants Quay shopping centre,",
            "city": "Cork",
            "county": "Cork",
            "phone": "021 427 2212"
        },
        {
            "name": "Boots Bandon",
            "street": "12-13 South main st,",
            "city": "Bandon",
            "county": "Cork",
            "phone": "238829382"
        },
        {
            "name": "Boots Blackpool",
            "street": "Blackpool Retail park,",
            "city": "Blackpool",
            "county": "Cork",
            "phone": "214212036"
        },
        {
            "name": "Boots Macroom",
            "street": "Fairgreen Plaza,",
            "city": "Macroom",
            "county": "Cork",
            "phone": "2643984"
        },
        {
            "name": "Boots Macroom",
            "street": "Fairgreen Plaza,",
            "city": "Macroom",
            "county": "Cork",
            "phone": "2643984"
        },
        {
            "name": "Boots Mahon Point",
            "street": "Unit 48-49, Mahon Point sc",
            "city": "Cork",
            "county": "Cork",
            "phone": "214614413"
        },
        {
            "name": "Boots Midleton",
            "street": "26-27 Main st,",
            "city": "Midleton",
            "county": "Cork",
            "phone": "214637943"
        },
        {
            "name": "Boots Mitchelstown",
            "street": "The Living health centre, Fermoy Rd.",
            "city": "Mitchelstown",
            "county": "Cork",
            "phone": "(025) 86797"
        },
        {
            "name": "Boots Pharmacy",
            "street": "108-109 Davis street, Mallow",
            "city": "Cork",
            "county": "Cork",
            "phone": "2250633"
        },
        {
            "name": "Boots The Chemist",
            "street": "1-2 Exchange house, Main Street",
            "city": "Ballincollig",
            "county": "Cork",
            "phone": "214214312"
        },
        {
            "name": "BOOTS WILTON",
            "street": "Units 37-39 Wilton shopping centre, Wilton",
            "city": "Cork",
            "county": "Cork",
            "phone": "214546500"
        },
        {
            "name": "Bourkes Pharmacy",
            "street": "Iona Park, Mayfield",
            "city": "Mayfield",
            "county": "Cork",
            "phone": "214502862"
        },
        {
            "name": "Brodericks Pharmacy",
            "street": "84 Barrack street, Cork City",
            "city": "Cork",
            "county": "Cork",
            "phone": "021 4316011"
        },
        {
            "name": "Brookes",
            "street": "29 South main st,",
            "city": "Bandon",
            "county": "Cork",
            "phone": "238841136"
        },
        {
            "name": "Brosnans Pharmacy",
            "street": "36 Main street, Midleton",
            "city": "Midleton",
            "county": "Cork",
            "phone": "214633033"
        },
        {
            "name": "Buttevant Pharmacy",
            "street": "Main Street,",
            "city": "Buttevant",
            "county": "Cork",
            "phone": "2223448"
        },
        {
            "name": "Cara Pharmacy",
            "street": "14 Uam var avenue, Bishopstown",
            "city": "Bishopstown",
            "county": "Cork",
            "phone": "214347247"
        },
        {
            "name": "CarePlus Pharmacy Cloyne",
            "street": "The Square,",
            "city": "Cloyne",
            "county": "Cork",
            "phone": "214652543"
        },
        {
            "name": "Carrigaline Careplus Pharmacy",
            "street": "Carrigaline Primary care centre,",
            "city": "Carrigaline",
            "county": "Cork",
            "phone": "214757083"
        },
        {
            "name": "Carrignavar Pharmacy",
            "street": "Unit 3 And 4 , Main Street carrignavar",
            "city": "Cork",
            "county": "Cork",
            "phone": "3.53214E+11"
        },
        {
            "name": "Carrigtwohill Pharmacy",
            "street": "Unit 2/3, Carrigtwohill shopping centre,,",
            "city": "Carrigtwohill",
            "county": "Cork",
            "phone": "+353214533755"
        },
        {
            "name": "CASTLE PHARMACY",
            "street": "N0 4 Main street,",
            "city": "Castlemartyr",
            "county": "Cork",
            "phone": "214667800"
        },
        {
            "name": "CHC Pharmacy",
            "street": "Charleville Health centre, Rathgoggin South",
            "city": "Charleville",
            "county": "Cork",
            "phone": "6389764"
        },
        {
            "name": "Chemco Pharmacy",
            "street": "New Road, Bandon",
            "city": "Bandon",
            "county": "Cork",
            "phone": "238843969"
        },
        {
            "name": "Chemist Warehouse",
            "street": "Unit 3 West city retail park , Innishmore Lawn",
            "city": "Ballincollig",
            "county": "Cork",
            "phone": "021 212 9808"
        },
        {
            "name": "Classes Lake Pharmacy",
            "street": "Classes Lake retail centre, Bridewood",
            "city": "Ovens",
            "county": "Cork",
            "phone": "021 4877848"
        },
        {
            "name": "Clearys Pharmacy",
            "street": "33/34 Main st, Skibbereen",
            "city": "Skibbereen",
            "county": "Cork",
            "phone": "2821543"
        },
        {
            "name": "Clockgate Pharmacy",
            "street": "76 North main street,",
            "city": "Youghal",
            "county": "Cork",
            "phone": "2481188"
        },
        {
            "name": "Cloghroe Pharmacy Ltd",
            "street": "Cloghroe Pharmacy, Woodlands, Cloghroe",
            "city": "Blarney",
            "county": "Cork",
            "phone": "214382244"
        },
        {
            "name": "Clonakilty Pharmacy",
            "street": "29 Pearse street,",
            "city": "Clonakilty",
            "county": "Cork",
            "phone": "238858560"
        },
        {
            "name": "Coachford Pharmacy",
            "street": "Coachford,",
            "city": "Coachford",
            "county": "Cork",
            "phone": "217434710"
        },
        {
            "name": "Cobh CarePlus Pharmacy",
            "street": "3, East beach,",
            "city": "Cobh",
            "county": "Cork",
            "phone": "214811341"
        },
        {
            "name": "Coens Pharmacy",
            "street": "Wolfe Tone square, Wolfe Tone square, bantry, co cork",
            "city": "Bantry",
            "county": "Cork",
            "phone": "2750531"
        },
        {
            "name": "College Road Pharmacy",
            "street": "63, College Road",
            "city": "Cork",
            "county": "Cork",
            "phone": "214340455"
        },
        {
            "name": "Collins Kinsale Pharmacy",
            "street": "12 Marketsq,",
            "city": "Kinsale",
            "county": "Cork",
            "phone": "214772077"
        },
        {
            "name": "COPEDILLONSCROSS",
            "street": "256 Old youghal road,",
            "city": "Cork",
            "county": "Cork",
            "phone": "876257107"
        },
        {
            "name": "Cotters Pharmacy",
            "street": "48 Main street,",
            "city": "Carrigtwohill",
            "county": "Cork",
            "phone": "(021) 4883351"
        },
        {
            "name": "Cross Allcare Pharmacy",
            "street": "The Square,",
            "city": "Castletownbere",
            "county": "Cork",
            "phone": "027 70024"
        },
        {
            "name": "Crowley's Pharmacy",
            "street": "Supervalu S.C., Faxbridge",
            "city": "Clonakilty",
            "county": "Cork",
            "phone": "023 889 5055"
        },
        {
            "name": "Crowleys Pharmacy",
            "street": "Market Square,",
            "city": "Dunmanway",
            "county": "Cork",
            "phone": "238845471"
        },
        {
            "name": "Crowleys Pharmacy",
            "street": "Unit 3, Ave de Rennes, Mahon",
            "city": "Mahon",
            "county": "Cork",
            "phone": "021 4359748"
        },
        {
            "name": "Dalton'S Pharmacy",
            "street": "Unit 11/12 North main street shopping centre, North Main street",
            "city": "Cork",
            "county": "Cork",
            "phone": "(021) 4276066"
        },
        {
            "name": "Dan Mc Carthy's Pharmacy",
            "street": "91 Patrick street,",
            "city": "Cork city",
            "county": "Cork",
            "phone": "214273774"
        },
        {
            "name": "Deasy\u2019s Careplus Pharmacy",
            "street": "Ballymakeera,",
            "city": "Macroom",
            "county": "Cork",
            "phone": "2645421"
        },
        {
            "name": "Deasy's Pharmacy",
            "street": "99 Shandon street,",
            "city": "99 Shandon street",
            "county": "Cork",
            "phone": "214304535"
        },
        {
            "name": "Deasys Pharmacy",
            "street": "Main St,",
            "city": "Macroom",
            "county": "Cork",
            "phone": "2641048"
        },
        {
            "name": "Deasys Pharmacy",
            "street": "2 St main st,",
            "city": "Bandon",
            "county": "Cork",
            "phone": "238841288"
        },
        {
            "name": "Dennehy's Cross Pharmacy",
            "street": "Dennehy's Cross, Wilton Road",
            "city": "Cork",
            "county": "Cork",
            "phone": "214865963"
        },
        {
            "name": "Dillons Cross Pharmacy",
            "street": "256 Old youghal rd, Dillons Cross",
            "city": "Cork",
            "county": "Cork",
            "phone": "214501744"
        },
        {
            "name": "Doneraile Pharmacy",
            "street": "Doneraile, Doneraile Pharmacy",
            "city": "Doneraile,co Cork",
            "county": "Cork",
            "phone": "2224125"
        },
        {
            "name": "Doody\u2019s Pharmacy",
            "street": "10 Lower cork street,",
            "city": "Mitchelstown",
            "county": "Cork",
            "phone": "2524124"
        },
        {
            "name": "Douglas Allcare Pharmacy",
            "street": "Clermont, Douglas Road",
            "city": "Cork",
            "county": "Cork",
            "phone": "214292329"
        },
        {
            "name": "Drimoleague Pharmacy",
            "street": "Main Street,",
            "city": "Drimoleague",
            "county": "Cork",
            "phone": "2831116"
        },
        {
            "name": "Drinagh Pharmacy",
            "street": "Market Street,",
            "city": "Skibbereen",
            "county": "Cork",
            "phone": "028 23333"
        },
        {
            "name": "Drinagh Pharmacy",
            "street": "Main Street,",
            "city": "Schull",
            "county": "Cork",
            "phone": "2828108"
        },
        {
            "name": "Drinagh Pharmacy",
            "street": "Sackville Street,",
            "city": "Dunmanway",
            "county": "Cork",
            "phone": "238855560"
        },
        {
            "name": "Drinagh Pharmacy Bantry",
            "street": "New Street,",
            "city": "Bantry",
            "county": "Cork",
            "phone": "2750113"
        },
        {
            "name": "Duanes Pharmacy",
            "street": "4 Strand st, Kanturk",
            "city": "Kanturk",
            "county": "Cork",
            "phone": "2920852"
        },
        {
            "name": "Duffy's Pharmacy",
            "street": "Main Street, Castletownroche",
            "city": "Mallow",
            "county": "Cork",
            "phone": "022 26172"
        },
        {
            "name": "Elmwood Pharmacy (O'Sullivans)",
            "street": "Elmwood Medical centre, Frankfield",
            "city": "Douglas",
            "county": "Cork",
            "phone": "021-4894834"
        },
        {
            "name": "Falvey's Pharmacy",
            "street": "17 Bridge street ,",
            "city": "Cork",
            "county": "Cork",
            "phone": "214501438"
        },
        {
            "name": "Falveys Pharmacy",
            "street": "Douglas Village shopping centre,",
            "city": "Douglas",
            "county": "Cork",
            "phone": "214894184"
        },
        {
            "name": "Fermoy Medical Hall",
            "street": "61-63 Mccurtain Street,",
            "city": "Fermoy",
            "county": "Cork",
            "phone": "(025)30963"
        },
        {
            "name": "Fitzgibbons Pharmacy",
            "street": "34 Lower cork street, Mitchelstown",
            "city": "Mitchelstown",
            "county": "Cork",
            "phone": "2524253"
        },
        {
            "name": "Flemings Pharmacy Ltd",
            "street": "Douglas Rd,",
            "city": "Cork",
            "county": "Cork",
            "phone": "214230026"
        },
        {
            "name": "Gallwey's Pharmacy",
            "street": "49 Peare street,",
            "city": "Clonakilty",
            "county": "Cork",
            "phone": "238833361"
        },
        {
            "name": "Gibbs Pharmacy",
            "street": "15 Midleton street,",
            "city": "Cobh",
            "county": "Cork",
            "phone": "214811475"
        },
        {
            "name": "Gibson O'Connor Dermatologists",
            "street": "Suite 12, The Lee clnic",
            "city": "Lee Road",
            "county": "Cork",
            "phone": "214941566"
        },
        {
            "name": "Glengarriff Pharmacy",
            "street": "Glengarriff, Co Cork",
            "city": "Cork",
            "county": "Cork",
            "phone": "2763744"
        },
        {
            "name": "Glenheights Pharmacy",
            "street": "4 College shopping centre, Glenheights Road",
            "city": "Ballyvolane",
            "county": "Cork",
            "phone": "021 4932918"
        },
        {
            "name": "Hamilton's Pharmacy",
            "street": "74 Bridge st,",
            "city": "Skibbereen",
            "county": "Cork",
            "phone": "2822552"
        },
        {
            "name": "Harrington's Pharmacy",
            "street": "Main Street ,",
            "city": "Ballincollig",
            "county": "Cork",
            "phone": "214875830"
        },
        {
            "name": "Harringtons Clonakilty",
            "street": "1 Ashe street, Clonakilty",
            "city": "Clonakilty",
            "county": "Cork",
            "phone": "238833318"
        },
        {
            "name": "Harringtons Pharmacy",
            "street": "Timoleague,",
            "city": "Bandon",
            "county": "Cork",
            "phone": "238846261"
        },
        {
            "name": "Haven Pharmacy Burke's",
            "street": "North Square,",
            "city": "Macroom",
            "county": "Cork",
            "phone": "2641503"
        },
        {
            "name": "Haven Pharmacy Riverview",
            "street": "Unit 4 Riverview sc,",
            "city": "Bandon",
            "county": "Cork",
            "phone": "238844877"
        },
        {
            "name": "Hickey's Ballyphehane",
            "street": "66 Tory top road, Ballyphehane",
            "city": "Cork",
            "county": "Cork",
            "phone": "021-4315970"
        },
        {
            "name": "Hickey'S Pharmacy",
            "street": "Unit 16 Castlewest shopping centre, Ballincollig",
            "city": "Ballincollig",
            "county": "Cork",
            "phone": "214879302"
        },
        {
            "name": "Hickey's Pharmacy",
            "street": "5c Baker's road, Gurranabraher",
            "city": "Cork",
            "county": "Cork",
            "phone": "021 4303238"
        },
        {
            "name": "Hickey's Pharmacy Mayfield",
            "street": "Supervalu Sc, Mayfield",
            "city": "Cork",
            "county": "Cork",
            "phone": "(021) 4551450"
        },
        {
            "name": "Holland's Pharmacy",
            "street": "Templehill, Lower Ballinlough road",
            "city": "Cork",
            "county": "Cork",
            "phone": "214294828"
        },
        {
            "name": "Horgan's Pharmacy",
            "street": "Unit 3/4, Parkwest",
            "city": "Mallow",
            "county": "Cork",
            "phone": "2242903"
        },
        {
            "name": "Horgan's Pharmacy",
            "street": "Strand Street,",
            "city": "Kanturk",
            "county": "Cork",
            "phone": "(029) 50144"
        },
        {
            "name": "Horgans Pharmacy",
            "street": "6 Barrack st, Southgate Bridge",
            "city": "Cork",
            "county": "Cork",
            "phone": "021 4316094"
        },
        {
            "name": "Horgans Pharmacy",
            "street": "South Main street,",
            "city": "Bandon",
            "county": "Cork",
            "phone": "023 8842105"
        },
        {
            "name": "Innishannon Pharmacy",
            "street": "Main St,",
            "city": "Innishannon",
            "county": "Cork",
            "phone": "214775560"
        },
        {
            "name": "Irwins Pharmacy",
            "street": "77 Shandon st., 1 Northmall",
            "city": "Cork",
            "county": "Cork",
            "phone": "214304165"
        },
        {
            "name": "Irwins Pharmacy",
            "street": "Unit 1 Mayfield shopping centre,",
            "city": "Mayfield",
            "county": "Cork",
            "phone": "214506633"
        },
        {
            "name": "Irwins Pharmacy",
            "street": "Togher, Village Centre",
            "city": "Cork",
            "county": "Cork",
            "phone": "214962777"
        },
        {
            "name": "James Pettit Pharmacy",
            "street": "27 Main Street,",
            "city": "Charleville",
            "county": "Cork",
            "phone": "063-81248"
        },
        {
            "name": "Janet Altmann Physiotherapy",
            "street": "Ard Na goithe, , Corran",
            "city": "Waterfall",
            "county": "Cork",
            "phone": "892415152"
        },
        {
            "name": "Johnson's Pharmacy",
            "street": "Victoria Cross, Cork",
            "city": "Cork City",
            "county": "Cork",
            "phone": "214541004"
        },
        {
            "name": "Joyces Pharmacy",
            "street": "40 Main street, Mallow",
            "city": "Mallow",
            "county": "Cork",
            "phone": "2221554"
        },
        {
            "name": "Kellehers Pharmacy",
            "street": "Main Street,",
            "city": "Ballincollig",
            "county": "Cork",
            "phone": "021 4871782"
        },
        {
            "name": "Kerrs Pharmacy",
            "street": "21 Main street, Dunmanway",
            "city": "Dunmanway",
            "county": "Cork",
            "phone": "023 8845144"
        },
        {
            "name": "Killeagh Pharmacy",
            "street": "Main Street,",
            "city": "Killeagh",
            "county": "Cork",
            "phone": "2495117"
        },
        {
            "name": "Leeview Pharmacy",
            "street": "Eastside Centre, Ballincollig",
            "city": "Ballincollig",
            "county": "Cork",
            "phone": "214878612"
        },
        {
            "name": "Life Railway View Pharmacy",
            "street": "Railway View,",
            "city": "Macroom",
            "county": "Cork",
            "phone": "026 41080"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Lough S/c, Togher",
            "city": "Cork",
            "county": "Cork",
            "phone": "021 4964629"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "21 Main st,",
            "city": "Midleton",
            "county": "Cork",
            "phone": "214631586"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Supervalu S.c, New Road",
            "city": "Kinsale",
            "county": "Cork",
            "phone": "(021) 4773939"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Unit 9 Hollyhill S C, Hollyhill",
            "city": "Cork",
            "county": "Cork",
            "phone": "214392266"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "8 Grand Parade,",
            "city": "Cork",
            "county": "Cork",
            "phone": "021 4274563"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Ballincollig,",
            "city": "Ballincollig",
            "county": "Cork",
            "phone": "021 4872104"
        },
        {
            "name": "Lloyds Pharmacy Charleville",
            "street": "Unit 12 , Charleville Town centre",
            "city": "Charleville",
            "county": "Cork",
            "phone": "6332794"
        },
        {
            "name": "Lloyds Pharmacy Youghal",
            "street": "102 North main st,",
            "city": "Youghal",
            "county": "Cork",
            "phone": "2492189"
        },
        {
            "name": "Lynchs Pharmacy",
            "street": "Broadale, Maryborough Hill",
            "city": "Douglas",
            "county": "Cork",
            "phone": "(021)4366923"
        },
        {
            "name": "Lyons Pharmacy",
            "street": "43 McCurtain Street",
            "city": "Fermoy",
            "county": "Cork",
            "phone": "+3532551633"
        },
        {
            "name": "Mackessy's Pharmacy",
            "street": "New Street,",
            "city": "Newmarket",
            "county": "Cork",
            "phone": "2960622"
        },
        {
            "name": "Mari Mina Pharmacy",
            "street": "Main Street,",
            "city": "Rathcormac",
            "county": "Cork",
            "phone": "(025)37599"
        },
        {
            "name": "Mari Mina Youghal",
            "street": "97 North main st,",
            "city": "Youghal",
            "county": "Cork",
            "phone": "024 85000"
        },
        {
            "name": "Martin Walsh Allcare Pharmacy",
            "street": "Main Street,",
            "city": "Carrigaline",
            "county": "Cork",
            "phone": "214372227"
        },
        {
            "name": "MARTIN WALSH ALLCARE SC",
            "street": "7a Supervalu shopping centre, Carrigaline",
            "city": "Carrigaline",
            "county": "Cork",
            "phone": "214834242"
        },
        {
            "name": "Mary Shinnick-North Gate Pharmacy",
            "street": "12 North main street,",
            "city": "Cork",
            "county": "Cork",
            "phone": "(021) 427 3415"
        },
        {
            "name": "Matt Murphy's Pharmacy",
            "street": "The Medical hall, Main Street",
            "city": "Macroom",
            "county": "Cork",
            "phone": "2641000"
        },
        {
            "name": "Mc Elligott Pharmacy",
            "street": "Ashdale House, Shean Lower",
            "city": "Blarney",
            "county": "Cork",
            "phone": "214385307"
        },
        {
            "name": "Mccarthys Pharmacy",
            "street": "Castle Square,",
            "city": "Carrigtwohill",
            "county": "Cork",
            "phone": "214882378"
        },
        {
            "name": "Mullins",
            "street": "Main Street,",
            "city": "Charleville",
            "county": "Cork",
            "phone": "6381258"
        },
        {
            "name": "O'Hanlon's Pharmacy",
            "street": "11a Gurranabraher rd,",
            "city": "Gurranabraher",
            "county": "Cork",
            "phone": "214302168"
        },
        {
            "name": "OJC Medics Limited",
            "street": "The Cork clinic, suite 2, clinic a, Western Road",
            "city": "Cork",
            "county": "Cork",
            "phone": "021 4343731"
        },
        {
            "name": "Pharmacyfirstplus Northside",
            "street": "Onslow Gardens, Glenwood Drive",
            "city": "Cork",
            "county": "Cork",
            "phone": "214398135"
        }
    ],
    "Donegal": [
        {
            "name": "Abbey Glebe Dental",
            "street": "The Glebe ,",
            "city": "Donegal Town",
            "county": "Donegal",
            "phone": "749721508"
        },
        {
            "name": "Annagry Pharmacy",
            "street": "Unit 4 Ionad gno, Annagry",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "749562654"
        },
        {
            "name": "Anne McLaughlin Opticians",
            "street": "Robertson Hall, Port Road",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "074 9126526"
        },
        {
            "name": "Aras Ghaoth Dobhair Nursing Home",
            "street": "Meenaniller, Meenaniller",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "749560624"
        },
        {
            "name": "Aras Mhic Shuibhne",
            "street": "Mullinasole, Laghey",
            "city": "Donegal",
            "county": "Donegal",
            "phone": "749734810"
        },
        {
            "name": "\u00c1ras U\u00ed Dhomhnaill Nursing Home",
            "street": "Loughnakey,",
            "city": "Milford",
            "county": "Donegal",
            "phone": "749163288"
        },
        {
            "name": "Archview Lodge Nursing Home",
            "street": "Drumany,",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "749160750"
        },
        {
            "name": "Argus Opticians",
            "street": "Upper Main street,",
            "city": "Donegal Town",
            "county": "Donegal",
            "phone": "749725725"
        },
        {
            "name": "ARK Medical Centre",
            "street": "Pearse Rd,",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "749128180"
        },
        {
            "name": "Arranmore Health Centre",
            "street": "Arranmore Island,",
            "city": "Ballintra",
            "county": "Donegal",
            "phone": "749520535"
        },
        {
            "name": "Arranmorehc.pn@healthmail.ie",
            "street": "Ballintra, Arranmore Island",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "749520535"
        },
        {
            "name": "Ballyraine Pharmacy",
            "street": "Ramelton Rd,",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "749106444"
        },
        {
            "name": "Ballyraineadmin@Healthmail.ie",
            "street": "Ballyraine,",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "(074) 9129393"
        },
        {
            "name": "Bayview Family Practice",
            "street": "Health Campus, College Street",
            "city": "Ballyshannon",
            "county": "Donegal",
            "phone": "071 9851600"
        },
        {
            "name": "Bayview Family Practice",
            "street": "Belleek Road,",
            "city": "Ballyshannon",
            "county": "Donegal",
            "phone": "(071)9851600"
        },
        {
            "name": "Beach Hill Manor PNH",
            "street": "Lisfannon, Fahan",
            "city": "Buncrana",
            "county": "Donegal",
            "phone": "074 93 20300"
        },
        {
            "name": "Begley's Pharmacy",
            "street": "The Diamond, Donegal Town",
            "city": "Donegal",
            "county": "Donegal",
            "phone": "749721232"
        },
        {
            "name": "Bonners Pharmacy",
            "street": "Main Street,",
            "city": "Ballybofey",
            "county": "Donegal",
            "phone": "749131027"
        },
        {
            "name": "Boots",
            "street": "4-6 Lower main street,",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "749125499"
        },
        {
            "name": "Boots",
            "street": "Unit 8, Retail Park",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "749125631"
        },
        {
            "name": "Brennans Pharmacy",
            "street": "Main Street,",
            "city": "Creeslough",
            "county": "Donegal",
            "phone": "749138610"
        },
        {
            "name": "Brennans Pharmacy",
            "street": "Clonmany,",
            "city": "Clonmany",
            "county": "Donegal",
            "phone": "749378584"
        },
        {
            "name": "Brennans Pharmacy",
            "street": "Ardaravan Square,",
            "city": "Buncrana",
            "county": "Donegal",
            "phone": "749322222"
        },
        {
            "name": "Brittons Pharmacy",
            "street": "Main Street,",
            "city": "Donegal Town",
            "county": "Donegal",
            "phone": "749721008"
        },
        {
            "name": "Cara Pharmacy",
            "street": "Main St,",
            "city": "Killybegs",
            "county": "Donegal",
            "phone": "749731009"
        },
        {
            "name": "Cara Pharmacy",
            "street": "Unit 5/6, Glebe Sc",
            "city": "Donegal Town",
            "county": "Donegal",
            "phone": "749721112"
        },
        {
            "name": "Cara Pharmacy",
            "street": "Main Street,",
            "city": "Bundoran",
            "county": "Donegal",
            "phone": "719841776"
        },
        {
            "name": "Carn Pharmacy",
            "street": "1 Millbrae Business Park,",
            "city": "Carndonagh",
            "county": "Donegal",
            "phone": "749374962"
        },
        {
            "name": "Carrigart Pharmacy",
            "street": "Main Street, Carrigart",
            "city": "Carrigart",
            "county": "Donegal",
            "phone": "749155772"
        },
        {
            "name": "Central Pharmacy",
            "street": "3 Court house manor, Justice Walsh  road",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "749103970"
        },
        {
            "name": "Chemist Connect Bridgend",
            "street": "Unit 5 Devlin complex, Bridgend",
            "city": "Donegal",
            "county": "Donegal",
            "phone": "749368744"
        },
        {
            "name": "Dorrians Pharmacy",
            "street": "The Diamond,",
            "city": "Ballyshannon",
            "county": "Donegal",
            "phone": "719851444"
        },
        {
            "name": "Duffy's Pharmacy",
            "street": "Mccarter's Road,",
            "city": "Buncrana",
            "county": "Donegal",
            "phone": "749321639"
        },
        {
            "name": "Eske Pharmacy",
            "street": "Main Street,",
            "city": "Donegal Town",
            "county": "Donegal",
            "phone": "749722033"
        },
        {
            "name": "Flatley's Pharmacy",
            "street": "Stranorlar, Lifford",
            "city": "Lifford",
            "county": "Donegal",
            "phone": "074 9131795"
        },
        {
            "name": "Flynn's Pharmacy",
            "street": "Main Street,",
            "city": "Dunfanaghy",
            "county": "Donegal",
            "phone": "749136986"
        },
        {
            "name": "Flynns Pharmacy",
            "street": "Falcarragh,",
            "city": "Falcarragh",
            "county": "Donegal",
            "phone": "749135778"
        },
        {
            "name": "Foyle",
            "street": "The Square,",
            "city": "Moville",
            "county": "Donegal",
            "phone": "749382929"
        },
        {
            "name": "Foyleview (Healthwise) Pharmacy",
            "street": "Bridge St,",
            "city": "Lifford",
            "county": "Donegal",
            "phone": "749141030"
        },
        {
            "name": "Garrett O'Donnell Pharmacy",
            "street": "Main Street,",
            "city": "Glenties",
            "county": "Donegal",
            "phone": "749551289"
        },
        {
            "name": "Glencar Pharmacy",
            "street": "Glencar,",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "749168666"
        },
        {
            "name": "Gweedore Pharmacy",
            "street": "Gweedore,",
            "city": "Gweedore",
            "county": "Donegal",
            "phone": "749531254"
        },
        {
            "name": "Hannons Pharmacy",
            "street": "Main St,",
            "city": "Moville",
            "county": "Donegal",
            "phone": "749382649"
        },
        {
            "name": "Haven Pharmacy",
            "street": "Shore Road,",
            "city": "Killybegs",
            "county": "Donegal",
            "phone": "749732640"
        },
        {
            "name": "Healthwise Pharmacy Dungloe",
            "street": "Greenes Corner,",
            "city": "Dungloe",
            "county": "Donegal",
            "phone": "749522255"
        },
        {
            "name": "Healthwise Pharmacy Retail Park",
            "street": "Unit 9 Milford retail park,",
            "city": "Milford",
            "county": "Donegal",
            "phone": "749116010"
        },
        {
            "name": "Inish Pharmacy",
            "street": "Carndonagh Shopping centre, Inish Pharmacy",
            "city": "Carndonagh",
            "county": "Donegal",
            "phone": "749329324"
        },
        {
            "name": "Inish Pharmacy Buncrana",
            "street": "Railway Road,",
            "city": "Buncrana",
            "county": "Donegal",
            "phone": "749362784"
        },
        {
            "name": "Inish Pharmacy Muff",
            "street": "Main Street,",
            "city": "Muff",
            "county": "Donegal",
            "phone": "749327721"
        },
        {
            "name": "Kellys Pharmacy",
            "street": "The Diamond,",
            "city": "Ardara",
            "county": "Donegal",
            "phone": "749541120"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Unit 4, Pearse Road",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "749102070"
        },
        {
            "name": "Magees Pharmacy",
            "street": "27 Upper main st,",
            "city": "Letterkenny",
            "county": "Donegal",
            "phone": "749121409"
        },
        {
            "name": "Maguires Pharmacy",
            "street": "15 Main street,",
            "city": "Ballyshannon",
            "county": "Donegal",
            "phone": "719851265"
        },
        {
            "name": "Mc Cormicks Pharmacy",
            "street": "Main St,",
            "city": "Milford",
            "county": "Donegal",
            "phone": "749153134"
        },
        {
            "name": "Mc Elwee Pharmacy",
            "street": "17 Main street,",
            "city": "Dungloe",
            "county": "Donegal",
            "phone": "07495 21032"
        },
        {
            "name": "Mc Neills Pharmacy",
            "street": "51 The diamond, Carndonagh",
            "city": "Carndonagh",
            "county": "Donegal",
            "phone": "749374120"
        }
    ],
    "Dublin": [
        {
            "name": "17 Fairview Strand",
            "street": "Fairview,",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "18331086"
        },
        {
            "name": "17 Fairview Strand",
            "street": "Fairview,",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "18331086"
        },
        {
            "name": "24DOC Medical Clinic",
            "street": "21a Store street, Dublin 1",
            "city": "Dublin 1",
            "county": "Dublin",
            "phone": "076 602 0068 / 01 855 9291"
        },
        {
            "name": "3Dental",
            "street": "Red Cow house, Naas Road",
            "city": "Dublin 22",
            "county": "Dublin",
            "phone": "14851033"
        },
        {
            "name": "8 Beaufort Downs",
            "street": "Rathfarnham,",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "851720139"
        },
        {
            "name": "AC Boles Ltd.",
            "street": "390 South circular road, Dolphins Barn",
            "city": "Dublin 8",
            "county": "Dublin",
            "phone": "14532053"
        },
        {
            "name": "Ace And Tate",
            "street": "30 Exchequer st, D02 A038",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "14854214"
        },
        {
            "name": "Aclare House",
            "street": "4/5 Tivoli terrace south,",
            "city": "Dun Laoghaire",
            "county": "Dublin",
            "phone": "12801345"
        },
        {
            "name": "Active Works Physical Therapy Clinic",
            "street": "14 The laurels, Seapark Mount prospect ave",
            "city": "Clontarf",
            "county": "Dublin",
            "phone": "18330726"
        },
        {
            "name": "ActiveLife Pharmacy",
            "street": "27 A talbot mall, Talbot Street",
            "city": "Dublin N1",
            "county": "Dublin",
            "phone": "18782674"
        },
        {
            "name": "Adams Pharmacy",
            "street": "11 Main st,",
            "city": "Raheny",
            "county": "Dublin",
            "phone": "18313831"
        },
        {
            "name": "Adelaide Dental",
            "street": "54 Adelaide road,",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "16766849"
        },
        {
            "name": "Adrian Dunne Pharmacy",
            "street": "Tesco Shopping centre,",
            "city": "Lucan",
            "county": "Dublin",
            "phone": "(01) 628 2766"
        },
        {
            "name": "Adrian Dunne Pharmacy",
            "street": "394 Collins avenue,",
            "city": "Whitehall",
            "county": "Dublin",
            "phone": "18378143"
        },
        {
            "name": "Adrian Dunne Pharmacy",
            "street": "7 Ballinteer business park, Ballinteer Ave",
            "city": "Ballinteer",
            "county": "Dublin",
            "phone": "12951932"
        },
        {
            "name": "Adrian Dunne Pharmacy",
            "street": "Main St,",
            "city": "Rush",
            "county": "Dublin",
            "phone": "18437295"
        },
        {
            "name": "Adrian Dunne Pharmacy Baldoyle",
            "street": "Unit 4, The Racecourse shopping centre",
            "city": "Baldoyle",
            "county": "Dublin",
            "phone": "(01) 8392851"
        },
        {
            "name": "Advance Pharmacy",
            "street": "14 Lower drumcondra road,",
            "city": "Drumcondra",
            "county": "Dublin",
            "phone": "18600006"
        },
        {
            "name": "Age Action",
            "street": "10 Grattan crescent,",
            "city": "Inchicore",
            "county": "Dublin",
            "phone": "01 4756989"
        },
        {
            "name": "Aileen Good Life Pharmacy",
            "street": "Unit 13 Supervalu shopping centre,",
            "city": "Sundrive Road",
            "county": "Dublin",
            "phone": "14929731"
        },
        {
            "name": "Ailesbury Nursing Home",
            "street": "58 Park Avenue",
            "city": "Sandymount",
            "county": "Dublin",
            "phone": "12692289"
        },
        {
            "name": "Airton Medical",
            "street": "192b Glenview park, Tallaght",
            "city": "Dublin 24",
            "county": "Dublin",
            "phone": "19636996"
        },
        {
            "name": "Alan O Mahony",
            "street": "11a The cairn , Clifflands",
            "city": "Rush",
            "county": "Dublin",
            "phone": "863518518"
        },
        {
            "name": "Alexandra Dental",
            "street": "77 Morehampton Road, Donnybrook",
            "city": "Dublin 4",
            "county": "Dublin",
            "phone": "01 6680630"
        },
        {
            "name": "Alfa Medics",
            "street": "Northside Shopping centre, Oscar Traynor road",
            "city": "Dublin 17",
            "county": "Dublin",
            "phone": "18474388"
        },
        {
            "name": "Allcare Clearwater Pharmacy",
            "street": "Clearwater Shopping centre, Finglas",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01 823 9160"
        },
        {
            "name": "Allcare O'Connell Street",
            "street": "5 Lower o'connell street,",
            "city": "Dublin 1",
            "county": "Dublin",
            "phone": "(01) 874 8456"
        },
        {
            "name": "Allcare Pharmacy",
            "street": "6 Thorncastle street, Ringsend",
            "city": "Dublin 4",
            "county": "Dublin",
            "phone": "01 6684304"
        },
        {
            "name": "Allcare Pharmacy Balbriggan",
            "street": "Unit 5, Drogheda street,",
            "city": "Balbriggan",
            "county": "Dublin",
            "phone": "01 8411588"
        },
        {
            "name": "Allens Pharmacy",
            "street": "10 Summerhill Parade,",
            "city": "Dublin 1",
            "county": "Dublin",
            "phone": "18555249"
        },
        {
            "name": "Allergy Ireland",
            "street": "Old Dublin road , Stillorgan",
            "city": "Co Dublin",
            "county": "Dublin",
            "phone": "01-2000500"
        },
        {
            "name": "Allergy4All",
            "street": "Suite 36, Beacon for kids, Beacon Hospital",
            "city": "Sandymount",
            "county": "Dublin",
            "phone": "860736297"
        },
        {
            "name": "Allergy4All",
            "street": "Suite 36, Beacon for kids, Beacon Hospital",
            "city": "Sandymount",
            "county": "Dublin",
            "phone": "860736297"
        },
        {
            "name": "Allview Healthcare",
            "street": "Unit 11-13, The hyde building, the park,, Carrickmines",
            "city": "Dublin 18",
            "county": "Dublin",
            "phone": "12248100"
        },
        {
            "name": "Allview Healthcare",
            "street": "Unit 11-13, The hyde building, the park,, Carrickmines",
            "city": "Dublin 18",
            "county": "Dublin",
            "phone": "12248100"
        },
        {
            "name": "Alone",
            "street": "Olympic House , Pleasant Street",
            "city": "Dublin 8",
            "county": "Dublin",
            "phone": "818222024"
        },
        {
            "name": "Altadore Nursing Home",
            "street": "Upper Glenageary road, Glenageary",
            "city": "Co Dublin",
            "county": "Dublin",
            "phone": "(01)2842233"
        },
        {
            "name": "Ana Liffey Drug Project",
            "street": "51 Middle abbey street,",
            "city": "Dublin 1",
            "county": "Dublin",
            "phone": "085 859 0103"
        },
        {
            "name": "Ana Liffey Drug Project",
            "street": "51 Middle abbey street,",
            "city": "Dublin 1",
            "county": "Dublin",
            "phone": "085 859 0103"
        },
        {
            "name": "Anam Cara Housing With Care",
            "street": "St Canices road, Glasnevin",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "8572362"
        },
        {
            "name": "Andrew Buckleys Total Health Pharmacy",
            "street": "14 St endas drive,",
            "city": "Rathfarnham",
            "county": "Dublin",
            "phone": "01 4933433"
        },
        {
            "name": "Andrew Norris",
            "street": "Beacon Dental clinic, Beacon Consultants clinic",
            "city": "Sandyford",
            "county": "Dublin",
            "phone": "876616071"
        },
        {
            "name": "Anna Gaynor House",
            "street": "Our Lady's hospice & care services,",
            "city": "Harold's Cross",
            "county": "Dublin",
            "phone": "14068700"
        },
        {
            "name": "Annabeg Nursing Home",
            "street": "Meadow Court,",
            "city": "Ballybrack",
            "county": "Dublin",
            "phone": "01 2720201"
        },
        {
            "name": "Anne'S Lane Dental",
            "street": "2 Anne's lane, Anne's Lane dental",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "16718581"
        },
        {
            "name": "AnovoCare Nursing Home",
            "street": "Stockhole Lane, Cloghran",
            "city": "Swords",
            "county": "Dublin",
            "phone": "15630400"
        },
        {
            "name": "Applewood Medical Centre",
            "street": "Applewood Village,",
            "city": "Swords",
            "county": "Dublin",
            "phone": "18139624"
        },
        {
            "name": "Applewood Medical Centre",
            "street": "Applewood Village,",
            "city": "Swords",
            "county": "Dublin",
            "phone": "18139624"
        },
        {
            "name": "AR Ibrahim Practice",
            "street": "52 Ardara avenue,",
            "city": "Dublin 13",
            "county": "Dublin",
            "phone": "18471647"
        },
        {
            "name": "AR Ibrahim Practice",
            "street": "52 Ardara avenue,",
            "city": "Dublin 13",
            "county": "Dublin",
            "phone": "18471647"
        },
        {
            "name": "Ardara Family Practice",
            "street": "52 Ardara avenue,",
            "city": "The Donahies",
            "county": "Dublin",
            "phone": "18471647"
        },
        {
            "name": "Ardara Family Practice",
            "street": "52 Ardara avenue,",
            "city": "The Donahies",
            "county": "Dublin",
            "phone": "18471647"
        },
        {
            "name": "Ashford House Nursing Home",
            "street": "6 Tivoli terrace east,",
            "city": "Dun Laoghaire",
            "county": "Dublin",
            "phone": "01 2809877"
        },
        {
            "name": "Ashtown Medical Centre",
            "street": "Unit 2, The river centre, Rathborne Place, ashtown",
            "city": "Dublin 15",
            "county": "Dublin",
            "phone": "(01) 899 6249"
        },
        {
            "name": "Ashtown Medical Centre",
            "street": "Unit 2, The river centre, Rathborne Place, ashtown",
            "city": "Dublin 15",
            "county": "Dublin",
            "phone": "18996249"
        },
        {
            "name": "Ashwood Medical Centre",
            "street": "19, Ashwood road , Clondalkin",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01 4573335"
        },
        {
            "name": "AVEC Homecare Pharmacy",
            "street": "Unit 3, Horizon logistics park,",
            "city": "Harristown",
            "county": "Dublin",
            "phone": "01 8449997"
        },
        {
            "name": "AYA MDM",
            "street": "Chi Crumlin, Cooley Road",
            "city": "Crumlin",
            "county": "Dublin",
            "phone": "871999013"
        },
        {
            "name": "Aylesbury Clinic",
            "street": "Aylesbury Shopping centre, Tallaght",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "14521761"
        },
        {
            "name": "Balally Pharmacy",
            "street": "Unit 9 Balally shopping centre, Blackthorn Drive",
            "city": "Sandyford",
            "county": "Dublin",
            "phone": "(01)2954084"
        },
        {
            "name": "Balbriggan Braces",
            "street": "61 Drogheda street,",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01 6905496"
        },
        {
            "name": "Balbriggan Medical Centre",
            "street": "Clonard Street,",
            "city": "Balbriggan",
            "county": "Dublin",
            "phone": "01 8412460"
        },
        {
            "name": "Baldoylegp",
            "street": "Racecourse Shopping centre, Baldoyle",
            "city": "Dublin 13",
            "county": "Dublin",
            "phone": "01 8397655"
        },
        {
            "name": "Ballinteer Medical",
            "street": "Ballinteer Rd, Dublin 16",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "15079977"
        },
        {
            "name": "Ballybrack Medical Centre",
            "street": "4 Church road,",
            "city": "Ballybrack Village",
            "county": "Dublin",
            "phone": "01 2826904"
        },
        {
            "name": "Ballybrack Medical Hall",
            "street": "22 Church road,",
            "city": "Ballybrack",
            "county": "Dublin",
            "phone": "12823587"
        },
        {
            "name": "Ballyfermot Chapelizod Partnership",
            "street": "4 Drumfinn park, Drumfinn Avenue, ballyfermot, dublin 10",
            "city": "Ballyfermot",
            "county": "Dublin",
            "phone": "877044650"
        },
        {
            "name": "Ballyfermot Chapelizod Partnership",
            "street": "4 Drumfinn park,",
            "city": "Ballyfermot",
            "county": "Dublin",
            "phone": "16235612"
        },
        {
            "name": "Ballyfermot Dental Practice",
            "street": "276 Ballyfermot road, Ballyfermot",
            "city": "Dublin 10",
            "county": "Dublin",
            "phone": "16265776"
        },
        {
            "name": "Ballyfermot Pharmacy",
            "street": "Unit 3 Tesco shopping centre,",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "16166111"
        },
        {
            "name": "Ballymun Child And Family Resource Agency",
            "street": "Shangan Green, Ballymun",
            "city": "Dublin 9",
            "county": "Dublin",
            "phone": "(01) 852 7183"
        },
        {
            "name": "Balrothery Pharmacy",
            "street": "Coach Road,",
            "city": "Balrothery",
            "county": "Dublin",
            "phone": "18020753"
        },
        {
            "name": "Banks Pharmacy",
            "street": "195 Philipsburgh ave, Fairview",
            "city": "Fairview",
            "county": "Dublin",
            "phone": "(01)8378650"
        },
        {
            "name": "Barrett Opticians",
            "street": "107c New cabra road,",
            "city": "Cabra",
            "county": "Dublin",
            "phone": "(01) 838 4287"
        },
        {
            "name": "Barrymore House Pharmacy",
            "street": "217 North circular road,",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "863856609"
        },
        {
            "name": "Bartra Northwood Residential Home",
            "street": "Old Ballymun road, Northwood, Santry",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "2234670"
        },
        {
            "name": "Bates Health Express Pharmacy",
            "street": "Aylesbury Sc, Tallaght",
            "city": "Dublin 24",
            "county": "Dublin",
            "phone": "01 4610278"
        },
        {
            "name": "Bath Avenue Medical Centre",
            "street": "4 Bath avenue, Sandymount",
            "city": "Dublin 4",
            "county": "Dublin",
            "phone": "16686990"
        },
        {
            "name": "Bawnogue Life Pharmacy",
            "street": "Unit 6 Bawnogue shopping centre,",
            "city": "Clondalkin",
            "county": "Dublin",
            "phone": "(01) 457 1549"
        },
        {
            "name": "Baxter Healthcare Pharmacy",
            "street": "Unit 7 Deansgrange business park, Kill Lane",
            "city": "Blackrock",
            "county": "Dublin",
            "phone": "01 2065533"
        },
        {
            "name": "BEACON PHARMACY FARMERS",
            "street": "34 The mall, Beacon Court",
            "city": "Sandyford",
            "county": "Dublin",
            "phone": "12930155"
        },
        {
            "name": "Beaumont Lodge Residential Home",
            "street": "Kilmore Road, Artane",
            "city": "Artane",
            "county": "Dublin",
            "phone": "15632190"
        },
        {
            "name": "Beaumont Park Clinic",
            "street": "Beaumont Woods, Beaumont",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01/8378158"
        },
        {
            "name": "Beechfield Manor Nursing Home",
            "street": "Shanganagh Road, Shankill",
            "city": "Shankill",
            "county": "Dublin",
            "phone": "12824874"
        },
        {
            "name": "Beechlawn House Nursing Home",
            "street": "High Park, grace park road, Drumcondra, Dublin 9",
            "city": "Dublin 9",
            "county": "Dublin",
            "phone": "8369622"
        },
        {
            "name": "Beechlawn Medical Centre",
            "street": "Carrickbrennan Road, Monkstown",
            "city": "Blackrock",
            "county": "Dublin",
            "phone": "(01) 2713316"
        },
        {
            "name": "Beechtree Nursing Home",
            "street": "Oldtown,  Co dublin",
            "city": "County Dublin",
            "county": "Dublin",
            "phone": "18433634"
        },
        {
            "name": "Beechview Medical Ltd",
            "street": "Beechview,",
            "city": "Blanchardstown Village",
            "county": "Dublin",
            "phone": "15989412"
        },
        {
            "name": "Beechwood Dental",
            "street": "9 Dunville ave, Beechwood Dental",
            "city": "Ranelagh",
            "county": "Dublin",
            "phone": "14967526"
        },
        {
            "name": "Belarmine Pharmacy",
            "street": "Unit 22 Belarmine plaza, Stepaside",
            "city": "Dublin 18",
            "county": "Dublin",
            "phone": "01 295 0819"
        },
        {
            "name": "BELGRAVE CLINIC",
            "street": "3 Charleaton road, Ranelagh",
            "city": "Dublin 6",
            "county": "Dublin",
            "phone": "14975666"
        },
        {
            "name": "Belmont House",
            "street": "Galloping Green, Stillorgan",
            "city": "Stillorgan",
            "county": "Dublin",
            "phone": "01-2784393"
        },
        {
            "name": "Beneavin House Nursing Home",
            "street": "Beneavin Road, Glasnevin",
            "city": "Dublin 11",
            "county": "Dublin",
            "phone": "01 8648516"
        },
        {
            "name": "Beneavin Lodge Nursing Home",
            "street": "Beneavin Road, Ballygall",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01-8648577"
        },
        {
            "name": "Beneavin Manor",
            "street": "Beneavin Road, Glasnevin",
            "city": "Dublin 11",
            "county": "Dublin",
            "phone": "19123010"
        },
        {
            "name": "Bespoke Dental",
            "street": "Marine Court centre, The Green",
            "city": "Malahide",
            "county": "Dublin",
            "phone": "18061312"
        },
        {
            "name": "Bhagwan's Pharmacy",
            "street": "Ballinteer Rd,",
            "city": "Ballinteer",
            "county": "Dublin",
            "phone": "12984378"
        },
        {
            "name": "Birchview Surgery",
            "street": "33 Birchview close,",
            "city": "Kilnamanagh",
            "county": "Dublin",
            "phone": "14520890"
        },
        {
            "name": "Blackglen Medical",
            "street": "Unit 7, Blackglen village centre,",
            "city": "Sandyford",
            "county": "Dublin",
            "phone": "16214224"
        },
        {
            "name": "Blackglen Pharmacy",
            "street": "Unit 1, Blackglen village centre,",
            "city": "Sandyford",
            "county": "Dublin",
            "phone": "(01)2921751"
        },
        {
            "name": "Blackhall Pharmacy",
            "street": "13 Ellis quay,",
            "city": "Dublin 7",
            "county": "Dublin",
            "phone": "(01) 6722600"
        },
        {
            "name": "Blackrock Clinic Eye Department",
            "street": "Rock Road, Rock Road, intake, blackrock, a94 e4x7",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "012064541 / 012064542"
        },
        {
            "name": "Blackrock Clinic Pharmacy",
            "street": "Blackrock Clinc, Rock Road blackrock",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "12064360"
        },
        {
            "name": "Blackrock Clinic Specialist Dentistry",
            "street": "Suite 20, The Blackrock clinic",
            "city": "Blackrock",
            "county": "Dublin",
            "phone": "12881619"
        },
        {
            "name": "Blackrock DXA",
            "street": "Suite 3, Blackrock clinic, Rock Road",
            "city": "Blackrock",
            "county": "Dublin",
            "phone": "879067112"
        },
        {
            "name": "Blackrock Healthcare",
            "street": "41 Main street,",
            "city": "Blackrock",
            "county": "Dublin",
            "phone": "12789369"
        },
        {
            "name": "Blackrock Medical Centre",
            "street": "2 Frascati park, Blackrock",
            "city": "Co Dublin",
            "county": "Dublin",
            "phone": "12888363"
        },
        {
            "name": "Blackrock Medical Clinic",
            "street": "34 Main street, Blackrock",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "12884943"
        },
        {
            "name": "Blanchardstown PhysioCare",
            "street": "32 Clonsilla road, Blanchardstown",
            "city": "Dublin 15",
            "county": "Dublin",
            "phone": "15310001"
        },
        {
            "name": "Bluebell Pharmacy",
            "street": "4 La touche road, Bluebell",
            "city": "Bluebell",
            "county": "Dublin",
            "phone": "14501188"
        },
        {
            "name": "Boles Pharmacy",
            "street": "20 Lr drumcondra rd,",
            "city": "Drumcondra",
            "county": "Dublin",
            "phone": "18302040"
        },
        {
            "name": "Bon Secours Hospital Dublin",
            "street": "Pharmacy Department, Bon Secours hopital",
            "city": "Glasnevin",
            "county": "Dublin",
            "phone": "8065338"
        },
        {
            "name": "Bonnybrook Pharmacy",
            "street": "Unit 1b Northside retail park, Coolock Drive, coolock",
            "city": "Dublin 17",
            "county": "Dublin",
            "phone": "18488266"
        },
        {
            "name": "Boot's The Chemist",
            "street": "Unit B1 nutgrove shopping centre, Rathfarnham",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01-4933100"
        },
        {
            "name": "Booterstown Dental",
            "street": "115 Rock rd, Blackrock",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "12885746"
        },
        {
            "name": "Booterstown Pharmacy",
            "street": "87c Booterstown avenue, Blackrock",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "12834243"
        },
        {
            "name": "Boots",
            "street": "Liffey Valley shopping centre,",
            "city": "Liffey Valley",
            "county": "Dublin",
            "phone": "16231255"
        },
        {
            "name": "Boots",
            "street": "245 The square, Tallaght",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "14585635"
        },
        {
            "name": "Boots",
            "street": "134 Lower baggot street,",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "16618443"
        },
        {
            "name": "Boots",
            "street": "Liffey Valley shopping centre,",
            "city": "Liffey Valley",
            "county": "Dublin",
            "phone": "16231255"
        },
        {
            "name": "Boots",
            "street": "280-288 Harolds cross road, Harolds Cross road",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "14904451"
        },
        {
            "name": "Boots",
            "street": "Unit 6 Charlestown sc, Finglas",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "18340319"
        },
        {
            "name": "Boots",
            "street": "Castle Centre, Drimnagh Road",
            "city": "Dublin 12",
            "county": "Dublin",
            "phone": "(01) 4651852"
        },
        {
            "name": "Boots",
            "street": "Retail Unit 1, 13-17 Dawson street",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "(01)6798463"
        },
        {
            "name": "Boots",
            "street": "32 Upper Baggot Street,",
            "city": "32 Upper Baggot Street",
            "county": "Dublin",
            "phone": "(01)6600175"
        },
        {
            "name": "Boots",
            "street": "2-4 Church road,",
            "city": "Malahide",
            "county": "Dublin",
            "phone": "18168846"
        },
        {
            "name": "Boots",
            "street": "The Park retail retail park,",
            "city": "Carrickmines",
            "county": "Dublin",
            "phone": "01 2958678"
        },
        {
            "name": "Boots Balbriggan",
            "street": "Millfield Sc,",
            "city": "Balbriggan",
            "county": "Dublin",
            "phone": "18416085"
        },
        {
            "name": "Boots Balbriggan",
            "street": "Millfield Sc,",
            "city": "Balbriggan",
            "county": "Dublin",
            "phone": "18416085"
        },
        {
            "name": "Boots Blanchardstown",
            "street": "Unit 223-224 Blanchardstown shopping centre ,",
            "city": "Blanchardstown",
            "county": "Dublin",
            "phone": "01 8222052"
        },
        {
            "name": "Boots Blanchardstown",
            "street": "Unit 223-224 Blanchardstown shopping centre ,",
            "city": "Blanchardstown",
            "county": "Dublin",
            "phone": "01 8222052"
        },
        {
            "name": "Boots Chemist",
            "street": "20 Henry st, Dublin 1",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "(01)8729891"
        },
        {
            "name": "BOOTS DONNYBROOK",
            "street": "75 Moorehampton road,",
            "city": "Donnybrook",
            "county": "Dublin",
            "phone": "16675806"
        },
        {
            "name": "Boots Dun Laoghaire",
            "street": "Bloomfield Shopping centre, Dun Laoghaire",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "12302717"
        },
        {
            "name": "Boots Grafton Street",
            "street": "12 Grafton street,",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "(01) 6773049"
        },
        {
            "name": "Boots Jervis",
            "street": "Jervis St , Dublin 2",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "18781029"
        },
        {
            "name": "Boots Pharmacy",
            "street": "Grange Road,",
            "city": "Donaghmede",
            "county": "Dublin",
            "phone": "18482340"
        },
        {
            "name": "Boots Pharmacy",
            "street": "Unit 27, The Mill centre",
            "city": "Clondalkin",
            "county": "Dublin",
            "phone": "14577611"
        },
        {
            "name": "Boots Pharmacy",
            "street": "Frascati Shopping centre,",
            "city": "Blackrock",
            "county": "Dublin",
            "phone": "12108223"
        },
        {
            "name": "Boots Pharmacy",
            "street": "Roselawn Shopping centre,, Roselawn Road",
            "city": "Dublin 15",
            "county": "Dublin",
            "phone": "01 8214345"
        },
        {
            "name": "Boots Pharmacy",
            "street": "Roselawn Shopping centre,, Roselawn Road",
            "city": "Dublin 15",
            "county": "Dublin",
            "phone": "01 8214345"
        },
        {
            "name": "Boots Pharmacy",
            "street": "302 Lower rathmines rd,",
            "city": "Rathmines",
            "county": "Dublin",
            "phone": "(01)4969700"
        },
        {
            "name": "Boots Pharmacy",
            "street": "Omni Park sc,",
            "city": "Santry",
            "county": "Dublin",
            "phone": "(01)8163215"
        },
        {
            "name": "Boots Pharmacy",
            "street": "Unit 20 Ilac centre,",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "(01) 8047082"
        },
        {
            "name": "Boots Pharmacy Swords",
            "street": "Swords Pavilions, Unit G6",
            "city": "Swords",
            "county": "Dublin",
            "phone": "18904560"
        },
        {
            "name": "Boots Pharmacy Swords",
            "street": "Swords Pavilions, Unit G6",
            "city": "Swords",
            "county": "Dublin",
            "phone": "18904560"
        },
        {
            "name": "Boots Phibsborough",
            "street": "Phibsborough Place,",
            "city": "Phibsborough",
            "county": "Dublin",
            "phone": "01-8117536"
        },
        {
            "name": "Boots Stephens Green",
            "street": "Unit 113, Stepehs Green s.c.",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "14751868"
        },
        {
            "name": "Boots Stephens Green",
            "street": "Unit 113, Stepehs Green s.c.",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "14751868"
        },
        {
            "name": "Boots Stephens Green",
            "street": "Unit 113, Stepehs Green s.c.",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "14751868"
        },
        {
            "name": "Boots Tallaght Level 3",
            "street": "Unit 319 The square shopping centre, Tallaght",
            "city": "Tallaght",
            "county": "Dublin",
            "phone": "14622155"
        },
        {
            "name": "Boots The Chemist",
            "street": "Unit 5-7 Park pointe shopping centre, Glenageary",
            "city": "Glenageary",
            "county": "Dublin",
            "phone": "(01)2143978"
        },
        {
            "name": "Boylan's Pharmacy",
            "street": "9 Claddagh green, Ballyfermot",
            "city": "Ballyfermot",
            "county": "Dublin",
            "phone": "01-6264988"
        },
        {
            "name": "Bradley's Pharmacy",
            "street": "5 Lower kilmacud road,",
            "city": "Stillorgan",
            "county": "Dublin",
            "phone": "01 2882113"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "Unit 2 The crescent , Church Road",
            "city": "Mulhuddart",
            "county": "Dublin",
            "phone": "01 6404015"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "63 Lower mounttown road, Dun Laoghaire",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01 2805563"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "157 Killester ave, Killester",
            "city": "Dublin 5",
            "county": "Dublin",
            "phone": "01 8312603"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "2a Fortfield road, Kimmage",
            "city": "Dublin 6w",
            "county": "Dublin",
            "phone": "01 4908098"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "50 Lower Dorset Street, Dublin 1",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01 8557167"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "Unit 1, Dutch village, Clondalkin",
            "city": "Dublin 22",
            "county": "Dublin",
            "phone": "01 4643105"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "Blanchardstown Shopping centre, Blanchardstown",
            "city": "Dublin 15",
            "county": "Dublin",
            "phone": "01 8200088"
        },
        {
            "name": "Bradys Pharmacy",
            "street": "12 Camden street upper, Dublin 2",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "(01) 475 1531"
        },
        {
            "name": "Bradys Pharmacy",
            "street": "Unit 3 Skerries point centre, Kellys Bay",
            "city": "Skerries",
            "county": "Dublin",
            "phone": "18493017"
        },
        {
            "name": "Brecan Pharmacy",
            "street": "Unit 2 Brecan house, Drogheda Street",
            "city": "Balbriggan",
            "county": "Dublin",
            "phone": "16904090"
        },
        {
            "name": "Brennan's Life Pharmacy",
            "street": "1 Fairways mall,",
            "city": "Donabate",
            "county": "Dublin",
            "phone": "+35318436365"
        },
        {
            "name": "Brian Cronin",
            "street": "Kilbarrack,",
            "city": "Kilbarrack",
            "county": "Dublin",
            "phone": "876023609"
        },
        {
            "name": "Bricin Military Hospital",
            "street": "Infirmary Road, Stonebatter",
            "city": "Dublin 7",
            "county": "Dublin",
            "phone": "(01) 804 6936"
        },
        {
            "name": "Brookfield Pharmacy",
            "street": "Unit 3 Sundale s.c.,",
            "city": "Tallaght",
            "county": "Dublin",
            "phone": "(01)4628318"
        },
        {
            "name": "Brookwood Pharmacy",
            "street": "42 Brookwood rise, Artane",
            "city": "Artane",
            "county": "Dublin",
            "phone": "18311898"
        },
        {
            "name": "Burkes Pharmacy",
            "street": "21-23 Ranelagh,",
            "city": "Ranelagh",
            "county": "Dublin",
            "phone": "14972190"
        },
        {
            "name": "Burnetts Pharmacy",
            "street": "Burnetts Pharmacy, , 42 Lower georges street",
            "city": "Dun Laoghaire",
            "county": "Dublin",
            "phone": "12801124"
        },
        {
            "name": "Byrne's Pharmacy",
            "street": "4 Merrion road, Ballsbridge",
            "city": "Dublin 4",
            "county": "Dublin",
            "phone": "(01) 6683287"
        },
        {
            "name": "Caddens Pharmacy",
            "street": "Unit 1, Tower SC",
            "city": "Clondalkin",
            "county": "Dublin",
            "phone": "14573794"
        },
        {
            "name": "Cahills Allcare Pharmacy",
            "street": "36 Camdens street lower,",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "(01)4753160"
        },
        {
            "name": "Capel  Street Pharmacy",
            "street": "138 Capel street,",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "15510001"
        },
        {
            "name": "Cappagh Pharmacy",
            "street": "Unit 5 The shops, Barry Avenue",
            "city": "Finglas",
            "county": "Dublin",
            "phone": "18140803"
        },
        {
            "name": "Cara Pharmacy",
            "street": "Unit 1 Pottery road, Dun Laoghaire",
            "city": "Co Dublin",
            "county": "Dublin",
            "phone": "(01) 202 3330"
        },
        {
            "name": "CAREPLUS PHARMACY CLONSILLA",
            "street": "Unit 4 Lidl centre, Clonsilla Link road",
            "city": "Clonsilla",
            "county": "Dublin",
            "phone": "15843809"
        },
        {
            "name": "Castle Pharmacy Dalkey",
            "street": "4 Ulverton place, Ulverton Road",
            "city": "Dalkey",
            "county": "Dublin",
            "phone": "15522091"
        },
        {
            "name": "Chambers Pharmacy",
            "street": "127 Ballymun road  ,",
            "city": "Glasnevin",
            "county": "Dublin",
            "phone": "18378081"
        },
        {
            "name": "Chapelizod Pharmacy",
            "street": "Chapelizod,",
            "city": "Chapelizod",
            "county": "Dublin",
            "phone": "16203324"
        },
        {
            "name": "Cheeverstown Pharmacy",
            "street": "Kilvare,",
            "city": "Templeogue",
            "county": "Dublin",
            "phone": "01 4993715"
        },
        {
            "name": "Chemist Warehouse",
            "street": "5 Henry street,",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "15828510"
        },
        {
            "name": "Chemist Warehouse",
            "street": "220 Dun laoghaire shopping centre, George's Street upper",
            "city": "Dun Laoghaire",
            "county": "Dublin",
            "phone": "(01) 582 8515"
        },
        {
            "name": "Chemist Warehouse",
            "street": "Unit 8b Westend retail park, Snugborough Road",
            "city": "Blanchardstown",
            "county": "Dublin",
            "phone": "01 5828500"
        },
        {
            "name": "CHO9 CVC",
            "street": "National Show centre ,",
            "city": "Swords",
            "county": "Dublin",
            "phone": "879703782"
        },
        {
            "name": "City Pharmacy",
            "street": "14 Dame street, Dame street",
            "city": "Dame street",
            "county": "Dublin",
            "phone": "16704523"
        },
        {
            "name": "Cleary'S Pharmacy",
            "street": "Unit 1 Strand centre, Strand Road",
            "city": "Portmarnock",
            "county": "Dublin",
            "phone": "18461466"
        },
        {
            "name": "Clonsilla Pharmacy",
            "street": "Weavers Row, Clonsilla",
            "city": "Dublin 15",
            "county": "Dublin",
            "phone": "18227585"
        },
        {
            "name": "Clonsilla Pharmacy",
            "street": "Weavers Row, Clonsilla",
            "city": "Dublin 15",
            "county": "Dublin",
            "phone": "18227585"
        },
        {
            "name": "Clonsilla Pharmacy",
            "street": "Weavers Row, Clonsilla",
            "city": "Dublin 15",
            "county": "Dublin",
            "phone": "18227585"
        },
        {
            "name": "Clontarf Pharmacy",
            "street": "192 Clontarf road clontarf, Dublin 3",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "18333711"
        },
        {
            "name": "Collis Pharmacy",
            "street": "350 North circular road,",
            "city": "Phibsboro",
            "county": "Dublin",
            "phone": "18300295"
        },
        {
            "name": "Complete Care Pharmacy",
            "street": "110 Main street,",
            "city": "Mulhuddart",
            "county": "Dublin",
            "phone": "01 5982149"
        },
        {
            "name": "Compounding CHI Crumlin",
            "street": "Chi At crumlin,",
            "city": "Dublin 12",
            "county": "Dublin",
            "phone": "01 4096687"
        },
        {
            "name": "Compounding.Connolly",
            "street": "Connolly Hospital,",
            "city": "Blanchardstown",
            "county": "Dublin",
            "phone": "(01) 646 6010"
        },
        {
            "name": "Conefrey's CarePlus Pharmacy",
            "street": "136 Pearse street,",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "16773234"
        },
        {
            "name": "Conway's Pharmacy",
            "street": "93 Swords road,",
            "city": "Whitehall",
            "county": "Dublin",
            "phone": "18375379"
        },
        {
            "name": "Coombe Community Pharmacy",
            "street": "Unit 2, Earls court, Reuben St",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "14427572"
        },
        {
            "name": "Corduff Pharmacy",
            "street": "Unit 1 Corduff shopping centre, Corduff",
            "city": "Blanchardstown",
            "county": "Dublin",
            "phone": "(01)8203569"
        },
        {
            "name": "Corr's Pharmacy",
            "street": "Clonshaugh Shopping centre,",
            "city": "Coolock",
            "county": "Dublin",
            "phone": "18487688"
        },
        {
            "name": "Corrigan's Pharmacy",
            "street": "80 Malahide road,",
            "city": "Clontarf",
            "county": "Dublin",
            "phone": "(01)8338803"
        },
        {
            "name": "Corrs Pharmacy",
            "street": "Elmfield Rise,",
            "city": "Clarehall",
            "county": "Dublin",
            "phone": "18487000"
        },
        {
            "name": "COSGROVES PHARMACY",
            "street": "105 Monkstown road, 105 Monkstown road",
            "city": "Monkstown",
            "county": "Dublin",
            "phone": "01 2801106"
        },
        {
            "name": "Costello'S  Pharmacy",
            "street": "25 Marino mart, Marino",
            "city": "Dublin 3",
            "county": "Dublin",
            "phone": "01 8338571"
        },
        {
            "name": "Crescent Pharmacy",
            "street": "68 Willow park crescent, Glasnevin",
            "city": "Glasnevin",
            "county": "Dublin",
            "phone": "18346057"
        },
        {
            "name": "Cromcastle Pharmacy",
            "street": "69 Cromcastle road, Coolock",
            "city": "Dublin 5",
            "county": "Dublin",
            "phone": "18673256"
        },
        {
            "name": "Cronins Careplus Pharmacy",
            "street": "1 Edenmore shopping centre,",
            "city": "Raheny",
            "county": "Dublin",
            "phone": "01 8478521"
        },
        {
            "name": "Crowleys Pharmacy",
            "street": "207 Decies road,",
            "city": "Ballyfermot",
            "county": "Dublin",
            "phone": "16264528"
        },
        {
            "name": "Crumlin Road Pharmacy",
            "street": "251 Crumlin road,",
            "city": "Dublin 12",
            "county": "Dublin",
            "phone": "14560019"
        },
        {
            "name": "Cullen's Pharmacy",
            "street": "Primary Care centre, , Navan Rd",
            "city": "Dublin 7",
            "county": "Dublin",
            "phone": "18386460"
        },
        {
            "name": "Dalkey Pharmacy",
            "street": "3 Railway rd, Dalkey",
            "city": "Dalkey",
            "county": "Dublin",
            "phone": "(01)2859433"
        },
        {
            "name": "Dalys Pharmacy",
            "street": "109 Cabra road,",
            "city": "Cabra",
            "county": "Dublin",
            "phone": "(01) 868 0245"
        },
        {
            "name": "Dargans Pharmacy",
            "street": "19 Berkeley street,",
            "city": "Dublin 7",
            "county": "Dublin",
            "phone": "(01) 8301169"
        },
        {
            "name": "Decies Pharmacy",
            "street": "43 Decies road,",
            "city": "Ballyfermot",
            "county": "Dublin",
            "phone": "16161340"
        },
        {
            "name": "Declan O'Sullivan Pharmacy",
            "street": "Ballymount Road, Walkinstown Cross",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "14501494"
        },
        {
            "name": "Deveneys Pharmacy",
            "street": "16 Upper rathmines road, Rathmines",
            "city": "Dublin 6",
            "county": "Dublin",
            "phone": "14126069"
        },
        {
            "name": "Dodder Park Allcare Pharmacy",
            "street": "5 Dodder park drive ,",
            "city": "Rathfarnham",
            "county": "Dublin",
            "phone": "14926125"
        },
        {
            "name": "DONABATE PHARMACY",
            "street": "Unit 1 Ballalease north, Portrane Road",
            "city": "Donabate",
            "county": "Dublin",
            "phone": "18085333"
        },
        {
            "name": "Donaghmede Allcare Pharmacy",
            "street": "Donaghmede Shopping centre, Donaghmede",
            "city": "Donaghmede",
            "county": "Dublin",
            "phone": "18476181"
        },
        {
            "name": "Donnapark Ltd T/A Smiths Pharmacy",
            "street": "121 Braemor rd, Churchtown",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "102968590"
        },
        {
            "name": "Donnelly's Pharmacy",
            "street": "Unit 103 Kingsford cross, Strand Road",
            "city": "Portmarnock",
            "county": "Dublin",
            "phone": "18463906"
        },
        {
            "name": "Dorans Pharmacy",
            "street": "Tesco Shopping centre, Churchview Road",
            "city": "Ballybrack",
            "county": "Dublin",
            "phone": "01 2353042"
        },
        {
            "name": "Dowling's Pharmacy",
            "street": "6 Lower baggot street,",
            "city": "Baggot St",
            "county": "Dublin",
            "phone": "16785612"
        },
        {
            "name": "Doyle's Pharmacy",
            "street": "3 Vernon Avenue, Clontarf",
            "city": "Clontarf",
            "county": "Dublin",
            "phone": "18333269"
        },
        {
            "name": "Drimnagh Pharmacy",
            "street": "125 Galtymore road, Drimnagh",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01 4651980"
        },
        {
            "name": "Dunlaoghaire Pharmacy",
            "street": "56 Upper george\u2019s st, Dunlaoghaire",
            "city": "Co Dublin",
            "county": "Dublin",
            "phone": "12844861"
        },
        {
            "name": "Dunville Pharmacy Ltd",
            "street": "32 To 34 dunville avenue, Ranelagh",
            "city": "Dublin 6",
            "county": "Dublin",
            "phone": "14971289"
        },
        {
            "name": "Edward Mac McManus",
            "street": "U2a Alliance row, Ballymun Plaza",
            "city": "Ballymun",
            "county": "Dublin",
            "phone": "18428006"
        },
        {
            "name": "Edward Mac McManus Pharmacy",
            "street": "Civic Centre,",
            "city": "Ballymun",
            "county": "Dublin",
            "phone": "01 8579488"
        },
        {
            "name": "Ellis",
            "street": "Greenhill S C,",
            "city": "St James Rd",
            "county": "Dublin",
            "phone": "14438846"
        },
        {
            "name": "Emmet Mccann",
            "street": "Northwood Avenue , Gullivers Santry",
            "city": "Santry",
            "county": "Dublin",
            "phone": "18429615"
        },
        {
            "name": "Errigal Pharmacy Ltd",
            "street": "16 Errigal rd, Drimnagh",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01-4557345"
        },
        {
            "name": "Evelyn Bradley Pharmacy",
            "street": "48 St brigids road, Artane",
            "city": "Artane",
            "county": "Dublin",
            "phone": "18311667"
        },
        {
            "name": "Finnegan's Pharmacy",
            "street": "41 Sallynoggin road , Sallynoggin",
            "city": "Sallynoggin",
            "county": "Dublin",
            "phone": "(01) 2854560"
        },
        {
            "name": "Finnstown Pharmacy",
            "street": "Unit 4 Finnstown centre, Lucan",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "15059414"
        },
        {
            "name": "Fitzmaurices Pharmacy",
            "street": "150 Church road,",
            "city": "East Wall",
            "county": "Dublin",
            "phone": "18741266"
        },
        {
            "name": "Flanagan's Instore Pharmacy",
            "street": "Clearwater Pharmacy, Clearwater Shopping center",
            "city": "Finglas",
            "county": "Dublin",
            "phone": "18068872"
        },
        {
            "name": "Flanagan's Pharmacy",
            "street": "18 Berkley road, Phibsboro",
            "city": "Dublin 7",
            "county": "Dublin",
            "phone": "18824360"
        },
        {
            "name": "Foley's Chemist",
            "street": "136 Parnell street,",
            "city": "Dublin 1",
            "county": "Dublin",
            "phone": "01 8746972"
        },
        {
            "name": "Foley's of Clontarf Pharmacy",
            "street": "63 Clontarf rd, Clontarf",
            "city": "Clontarf",
            "county": "Dublin",
            "phone": "18336384"
        },
        {
            "name": "Foleys Pharmacy",
            "street": "Applewood Village,",
            "city": "Swords",
            "county": "Dublin",
            "phone": "(01) 8084389"
        },
        {
            "name": "Foleys Pharmacy",
            "street": "Unit 8 Palmerstown S C, Palmerstown",
            "city": "Palmerstown",
            "county": "Dublin",
            "phone": "16260642"
        },
        {
            "name": "Foleys Pharmacy",
            "street": "Ballyowen Castle shopping centre,",
            "city": "Lucan",
            "county": "Dublin",
            "phone": "16213083"
        },
        {
            "name": "Foleys Pharmacy",
            "street": "39 Meath street, 39 Meath street",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01 4542133"
        },
        {
            "name": "Foodys Pharmacy",
            "street": "Harcourt Building, Harcourt St",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "01-4161918"
        },
        {
            "name": "Fortfield Pharmacy",
            "street": "48 Fortfield pk,",
            "city": "Terenure",
            "county": "Dublin",
            "phone": "14900789"
        },
        {
            "name": "Freyne's Chemist",
            "street": "Orchard Road, Orchard Road",
            "city": "Clondalkin",
            "county": "Dublin",
            "phone": "14574868"
        },
        {
            "name": "Gallery Quay Pharmacy",
            "street": "Unit G6 gallery quay , Grand Canal dock",
            "city": "Pearse Street, dublin 2",
            "county": "Dublin",
            "phone": "17071883"
        },
        {
            "name": "Galtymore Allcare Pharmacy",
            "street": "131 Galtymore road, Drimnagh",
            "city": "Dublin 12",
            "county": "Dublin",
            "phone": "(01)4557306"
        },
        {
            "name": "Gaynor's Allcare Pharmacy",
            "street": "Unit 2, 69 Main street, ,",
            "city": "Lusk",
            "county": "Dublin",
            "phone": "01 843 7911"
        },
        {
            "name": "Gilsenan'S Allcare Pharmacy",
            "street": "1/2 Town centre mall, Main Street",
            "city": "Swords",
            "county": "Dublin",
            "phone": "(01) 8408880"
        },
        {
            "name": "Goatstown Pharmacy",
            "street": "Unit 5, The goat centre, Lwr Kilmacud rd",
            "city": "Goatstown",
            "county": "Dublin",
            "phone": "01 2965244"
        },
        {
            "name": "Gordon Ryan",
            "street": "114 Lower rathmines rd, 114 lower rathmines rd",
            "city": "Dublin 6",
            "county": "Dublin",
            "phone": "01 4979999"
        },
        {
            "name": "Gormley Pharmacy",
            "street": "5 Nolan avenue , Churchtown",
            "city": "Dublin 14",
            "county": "Dublin",
            "phone": "12985085"
        },
        {
            "name": "Grange Clinic",
            "street": "Grange Road, Donaghmede",
            "city": "Dublin 13",
            "county": "Dublin",
            "phone": "01 8480033"
        },
        {
            "name": "GRANGE PHARMACY",
            "street": "2 Clonkeen rd,",
            "city": "Deansgrange",
            "county": "Dublin",
            "phone": "12893137"
        },
        {
            "name": "Grants Pharmacy",
            "street": "Unit 11, Finglas main shopping centre, Main St",
            "city": "Dublin 11",
            "county": "Dublin",
            "phone": "18340642"
        },
        {
            "name": "Grattan Pharmacy",
            "street": "13 Grattan cres,",
            "city": "Inchicore",
            "county": "Dublin",
            "phone": "14533984"
        },
        {
            "name": "GREEN PARK PHARMACY",
            "street": "Green Park shopping centre, Clondalkin",
            "city": "Dublin 22",
            "county": "Dublin",
            "phone": "14642364"
        },
        {
            "name": "Greendale Pharmacy",
            "street": "3 Kish house, Greendale Road",
            "city": "Raheny",
            "county": "Dublin",
            "phone": "18396038"
        },
        {
            "name": "GREENHILLS PHARMACY",
            "street": "133 St peters rd, Walkinstown",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "14560039"
        },
        {
            "name": "Greenlea Clinic",
            "street": "118 Greenlea road, Terenure",
            "city": "Dublin 6w",
            "county": "Dublin",
            "phone": "14907989"
        },
        {
            "name": "Greenlea Pharmacy",
            "street": "116 Greenlea road, Terenure",
            "city": "Terenure",
            "county": "Dublin",
            "phone": "01-4909273"
        },
        {
            "name": "Hanover Quay Pharmacy",
            "street": "Unit 4 The marker, Forbes Street",
            "city": "Dublin 2",
            "county": "Dublin",
            "phone": "01 6798414"
        },
        {
            "name": "HARTSTOWN PHARMACY",
            "street": "Unit 2 Hartstown shopping centre, Clonsilla",
            "city": "Dublin 15",
            "county": "Dublin",
            "phone": "18202860"
        },
        {
            "name": "Haven Pharmacy Brennans",
            "street": "Taylor's Lane, Ballyboden",
            "city": "Dublin 16",
            "county": "Dublin",
            "phone": "14932001"
        },
        {
            "name": "Haven Pharmacy Cassidys",
            "street": "James St,",
            "city": "James St",
            "county": "Dublin",
            "phone": "16753787"
        },
        {
            "name": "Haven Pharmacy Cassidys",
            "street": "449 South circular road, Rialto",
            "city": "Dublin 8",
            "county": "Dublin",
            "phone": "14532403"
        },
        {
            "name": "Haven Pharmacy Dohertys",
            "street": "2 Shantalla road, Beaumont",
            "city": "Dublin 9",
            "county": "Dublin",
            "phone": "18371931"
        },
        {
            "name": "HAVEN PHARMACY FARMERS",
            "street": "Ballyogan Road, Sandyford",
            "city": "Dublin 18",
            "county": "Dublin",
            "phone": "12941002"
        },
        {
            "name": "HAVEN PHARMACY FARMERS",
            "street": "56 Main street, Dundrum",
            "city": "Dublin 14",
            "county": "Dublin",
            "phone": "01-2987337"
        },
        {
            "name": "Haven Pharmacy Greenes",
            "street": "36 Main street,",
            "city": "Rathfarnham",
            "county": "Dublin",
            "phone": "01-4905256"
        },
        {
            "name": "Haven Pharmacy Loobys",
            "street": "42 Manor road,",
            "city": "Palmerstown",
            "county": "Dublin",
            "phone": "16264574"
        },
        {
            "name": "Haven Pharmacy Mcaleers",
            "street": "7 Fitzmaurice road, Ballygall",
            "city": "Finglas East",
            "county": "Dublin",
            "phone": "(01)9010898"
        },
        {
            "name": "Haven Pharmacy McLaughlins",
            "street": "153 Drimnagh road, Walkinstown",
            "city": "Dublin 12",
            "county": "Dublin",
            "phone": "01 4557354"
        },
        {
            "name": "Haven Pharmacy Moloneys",
            "street": "Grange Cross,",
            "city": "Ballytfermot",
            "county": "Dublin",
            "phone": "16264131"
        },
        {
            "name": "Haven Pharmacy Murrays",
            "street": "Unit 13, Killiney shopping centre, Rochestown Ave.,",
            "city": "Killiney",
            "county": "Dublin",
            "phone": "12852538"
        },
        {
            "name": "Haven Pharmacy Raffertys",
            "street": "Unit 8/9 Stillorgan village,",
            "city": "Stillorgan",
            "county": "Dublin",
            "phone": "12880153"
        },
        {
            "name": "Haven Pharmacy Raffertys",
            "street": "Unit 4 Cornelscourt sc,",
            "city": "Foxrock",
            "county": "Dublin",
            "phone": "12893191"
        },
        {
            "name": "Hayes Pharmacy",
            "street": "16 Hogan place,",
            "city": "Grand Canal St",
            "county": "Dublin",
            "phone": "(01) 6624883"
        },
        {
            "name": "Health Express",
            "street": "Unit 120-121 The square shopping centre, Tallaght",
            "city": "D24",
            "county": "Dublin",
            "phone": "01 459 7236"
        },
        {
            "name": "Health Express Pharmacy",
            "street": "Artane Castle s/c,",
            "city": "Artane",
            "county": "Dublin",
            "phone": "18511692"
        },
        {
            "name": "Healthlink",
            "street": "Kings Inn house, Parnell St",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "086 839 9652"
        },
        {
            "name": "Healthwave",
            "street": "Unit 2.4 Dundrum retail & office park, Sandyford Road",
            "city": "Dundrum",
            "county": "Dublin",
            "phone": "16853086"
        },
        {
            "name": "Hickey's Pharmacy",
            "street": "Unit 2 Tyrrelstown town centre, Tyrrelstown",
            "city": "Tyrrelstown",
            "county": "Dublin",
            "phone": "18856590"
        },
        {
            "name": "Hickey's Pharmacy",
            "street": "Hickeys Terenure,",
            "city": "Dublin 6W",
            "county": "Dublin",
            "phone": "14907179"
        },
        {
            "name": "Hickey's Pharmacy",
            "street": "Hickeys Tallaght, The Square, D24",
            "city": "Tallaght",
            "county": "Dublin",
            "phone": "14597444"
        },
        {
            "name": "Hickey's Pharmacy",
            "street": "Hickeys Grafton St, D2",
            "city": "Grafton street",
            "county": "Dublin",
            "phone": "16790467"
        },
        {
            "name": "Hickey'S Pharmacy",
            "street": "Supervalu Sc, Mckee Ave",
            "city": "Fingal",
            "county": "Dublin",
            "phone": "(01)8341695"
        },
        {
            "name": "Hickey's Pharmacy",
            "street": "Hickeys Finglas West, Dunnes Stores SC, D11",
            "city": "Finglas West",
            "county": "Dublin",
            "phone": "18641204"
        },
        {
            "name": "Hickeys Pharmacy",
            "street": "Hickeys Tallaght, Fortunestown (Springfield), D24",
            "city": "Tallaght",
            "county": "Dublin",
            "phone": "01/4624911"
        },
        {
            "name": "Hickeys Pharmacy",
            "street": "10 Main street, ongar village, 10 Main street",
            "city": "Ongar",
            "county": "Dublin",
            "phone": "01 8261874"
        },
        {
            "name": "Hickeys Pharmacy",
            "street": "Hickeys OConnell St, D1",
            "city": "O'Connell street",
            "county": "Dublin",
            "phone": "18730427"
        },
        {
            "name": "Hickeys Pharmacy",
            "street": "26 Oliver plunkett road, Monkstown",
            "city": "Dun Laoghaire",
            "county": "Dublin",
            "phone": "12805693"
        },
        {
            "name": "Hickeys Pharmacy",
            "street": "18 Meath street ,",
            "city": "Meath street",
            "county": "Dublin",
            "phone": "(01) 4545772"
        },
        {
            "name": "Hickeys Pharmacy",
            "street": "Hickeys Henry St, D2",
            "city": "Henry St",
            "county": "Dublin",
            "phone": "18731077"
        },
        {
            "name": "Hickeys Pharmacy",
            "street": "5 Castle crescent, Monastery Rd",
            "city": "Clondalkin",
            "county": "Dublin",
            "phone": "14592862"
        },
        {
            "name": "Hickeys Pharmacy",
            "street": "Balbriggan Primary care centre, Dublin Street",
            "city": "Balbriggan",
            "county": "Dublin",
            "phone": "(01) 5676912"
        },
        {
            "name": "Hickeys Pharmacy Cappagh",
            "street": "3 Cardiffsbridge road, Finglas West",
            "city": "Dublin 11",
            "county": "Dublin",
            "phone": "18110584"
        },
        {
            "name": "Hilltop Pharmacy",
            "street": "Station Road, Raheny",
            "city": "Dublin 5",
            "county": "Dublin",
            "phone": "78329449"
        },
        {
            "name": "Hilton's Pharmacy",
            "street": "11 Main st., Rathfarnham",
            "city": "Rathfarnham",
            "county": "Dublin",
            "phone": "(01) 4055654"
        },
        {
            "name": "Hiltons Pharmacy",
            "street": "U3 Magic carpet centre,",
            "city": "Cornelscourt",
            "county": "Dublin",
            "phone": "(01) 2898889"
        },
        {
            "name": "Home Birth",
            "street": "95 Seapoint avenue ,",
            "city": "Balckrock",
            "county": "Dublin",
            "phone": "872223100"
        },
        {
            "name": "HSE National Drug Treatment Centre",
            "street": "30-31 Pearse street ,",
            "city": "Dubliln",
            "county": "Dublin",
            "phone": "(01) 648 8645"
        },
        {
            "name": "HSQ Pharmacy",
            "street": "Heuston South quarter, Saint John's road west",
            "city": "Dublin 8",
            "county": "Dublin",
            "phone": "14411140"
        },
        {
            "name": "Hunters Life Pharmacy",
            "street": "Olivemount Terrace, Windy Arbour",
            "city": "Dundrum",
            "county": "Dublin",
            "phone": "(01)2697764"
        },
        {
            "name": "Jackson's Pharmacy",
            "street": "Whitechurch Shopping centre, Whitechurch",
            "city": "Rathfarnham",
            "county": "Dublin",
            "phone": "01 4069749"
        },
        {
            "name": "Janet Dillon Pharmacy",
            "street": "Unit 2, Norseman court, Manor Street",
            "city": "Stoneybatter",
            "county": "Dublin",
            "phone": "16794362"
        },
        {
            "name": "Jobstown Pharmacy",
            "street": "Unit 2 Kiltalown s.c., Jobstown",
            "city": "Tallaght",
            "county": "Dublin",
            "phone": "01 4598374"
        },
        {
            "name": "Johnson Pharmacy",
            "street": "Supervalu Shopping centre, Walkinstown",
            "city": "Walkinstown",
            "county": "Dublin",
            "phone": "(01)4505864"
        },
        {
            "name": "Johnstown Totalhealth Pharmacy",
            "street": "31 Johnstown road, Dun Laoghaire",
            "city": "Dun Laoghaire",
            "county": "Dublin",
            "phone": "12853774"
        },
        {
            "name": "Jordans Pharmacy",
            "street": "43 Sundrive road, Kimmage",
            "city": "Kimmage",
            "county": "Dublin",
            "phone": "14920130"
        },
        {
            "name": "Keanes Drumcondra",
            "street": "Keane's Careplus pharmacy , 9 Drumcondra road upper",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01 8359266"
        },
        {
            "name": "Keatinge'S Pharmacy",
            "street": "3 Tyrconnell road,",
            "city": "Inchicore",
            "county": "Dublin",
            "phone": "14547071"
        },
        {
            "name": "Kelly\u2019s Pharmacy",
            "street": "The Nangor centre, Cherrywood",
            "city": "Clondalkin",
            "county": "Dublin",
            "phone": "14576901"
        },
        {
            "name": "Kerins Allcare Pharmacy",
            "street": "32 Castle street,",
            "city": "Dalkey",
            "county": "Dublin",
            "phone": "12859644"
        },
        {
            "name": "Kiely's Careplus Pharmacy",
            "street": "203 Le fanu road, Ballyfermot",
            "city": "Dublin 10",
            "county": "Dublin",
            "phone": "16260949"
        },
        {
            "name": "Kiely's CarePlus Pharmacy",
            "street": "282 Ballyfermot road, ballyfermot, 282 Ballyfermot road",
            "city": "Ballyfermot",
            "county": "Dublin",
            "phone": "16264861"
        },
        {
            "name": "Killinarden Pharmacy",
            "street": "Unit 4, Killinarden shopping centre, Killinarden",
            "city": "Tallaght",
            "county": "Dublin",
            "phone": "14511544"
        },
        {
            "name": "Kilmacud totalhealth Pharmacy",
            "street": "1 A drummartin road, Kilmacud",
            "city": "Dublin 14",
            "county": "Dublin",
            "phone": "12169748"
        },
        {
            "name": "Kingswood Pharmacy",
            "street": "U6 Kingswood sc, Tallaght",
            "city": "Dublin 24",
            "county": "Dublin",
            "phone": "14623278"
        },
        {
            "name": "Kinirons Allcare Pharmacy",
            "street": "Main St,",
            "city": "Lucan",
            "county": "Dublin",
            "phone": "16280912"
        },
        {
            "name": "Kinsealy Pharmacy",
            "street": "Feltrim Shopping centre, Drynam Road",
            "city": "Swords",
            "county": "Dublin",
            "phone": "18904070"
        },
        {
            "name": "Lakelands Pharmacy",
            "street": "7 Lakelands road, , Upper Kilmacud road",
            "city": "Stillorgan",
            "county": "Dublin",
            "phone": "12882755"
        },
        {
            "name": "Lalors Pharmacy",
            "street": "69 Collins avenue, 69 Collins av",
            "city": "Donnycarney",
            "county": "Dublin",
            "phone": "18316943"
        },
        {
            "name": "Laverty's Pharmacy",
            "street": "Unit 2c, Shangan Hall",
            "city": "Ballymun",
            "county": "Dublin",
            "phone": "18623896"
        },
        {
            "name": "LEECH PHARMACY",
            "street": "43 Ranelagh,",
            "city": "Dublin 6",
            "county": "Dublin",
            "phone": "14971407"
        },
        {
            "name": "Leonards Corner Pharmacy",
            "street": "106 South circular road,",
            "city": "Dublin 8",
            "county": "Dublin",
            "phone": "14534282"
        },
        {
            "name": "LIAM MURRAY CHEMIST",
            "street": "20-21 Talbot street,",
            "city": "Dublin 1",
            "county": "Dublin",
            "phone": "01-8740711"
        },
        {
            "name": "Liberties Careplus Pharmacy",
            "street": "36 Thomas st , Merchants Quay",
            "city": "Dublin 8",
            "county": "Dublin",
            "phone": "16719203"
        },
        {
            "name": "Life Pharmacy",
            "street": "241 Swords road, Santry",
            "city": "Santry",
            "county": "Dublin",
            "phone": "18427784"
        },
        {
            "name": "Life Pharmacy",
            "street": "35/41 Parnell st,",
            "city": "Dublin 1",
            "county": "Dublin",
            "phone": "18732209"
        },
        {
            "name": "Life Pharmacy Rathmines",
            "street": "Unit 18 Swan shopping centre,",
            "city": "Rathmines",
            "county": "Dublin",
            "phone": "14972039"
        },
        {
            "name": "Limitless Health Pharmacy",
            "street": "Unit 4 Burnell court,",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01 8770898"
        },
        {
            "name": "Littlepace Pharmacy",
            "street": "Littlepace Shopping centre,",
            "city": "Clonee",
            "county": "Dublin",
            "phone": "18260944"
        },
        {
            "name": "Lloyds Leopardstown SC",
            "street": "Ballyogan Road,",
            "city": "Leopardstown",
            "county": "Dublin",
            "phone": "12921326"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Unit 1 - 2 woodview court, Dodsboro",
            "city": "Lucan",
            "county": "Dublin",
            "phone": "01 6010148"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "10 Upr Drumcondra Rd, Drumcondra",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "8373462"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "44 Tonlegee Rd, Coolock",
            "city": "Dublin 5",
            "county": "Dublin",
            "phone": "18470101"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "The Meath pcc, Heytesbury Street",
            "city": "Dublin 8",
            "county": "Dublin",
            "phone": "(01) 4730131"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Supervalu S/C, Newcastle Road",
            "city": "Lucan",
            "county": "Dublin",
            "phone": "01 6241341"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Supervalu SC, Blanchardstown",
            "city": "Blanchardstown",
            "county": "Dublin",
            "phone": "18210807"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "413 Howth rd,",
            "city": "Raheny",
            "county": "Dublin",
            "phone": "18314341"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Omni Park s.c. ,",
            "city": "Santry",
            "county": "Dublin",
            "phone": "18429857"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Nutgrove Shopping centre , Rathfarnham",
            "city": "Dublin 14",
            "county": "Dublin",
            "phone": "14942353"
        },
        {
            "name": "LLOYDS PHARMACY",
            "street": "Neilstown,",
            "city": "Clondalkin",
            "county": "Dublin",
            "phone": "01 4570994"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Mill SC, Clondalkin",
            "city": "Dublin 22",
            "county": "Dublin",
            "phone": "14577166"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Main Street,",
            "city": "Blanchardstown",
            "county": "Dublin",
            "phone": "18213318"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "169 Howth road, Supervalu SC",
            "city": "Killester",
            "county": "Dublin",
            "phone": "18330988"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "53 Kilbarrack road,",
            "city": "Kilbarrack",
            "county": "Dublin",
            "phone": "01 8325332"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "4 Fitzmaurice Rd,",
            "city": "Glasnevin",
            "county": "Dublin",
            "phone": "01 8342178"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "47 Main street, Finglas",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "18642064"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "103a New cabra road, Cabra",
            "city": "Dublin 7",
            "county": "Dublin",
            "phone": "01 8680226"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "8 The mall , Donnybrook",
            "city": "Donnybrook",
            "county": "Dublin",
            "phone": "12695236"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "11b Braemor road,",
            "city": "Churchtown",
            "county": "Dublin",
            "phone": "01 2988512"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Unit 3 Castleknock S C,",
            "city": "Castleknock",
            "county": "Dublin",
            "phone": "01 8204411"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Castlecourt Shopping centre, Castleknock",
            "city": "Castleknock",
            "county": "Dublin",
            "phone": "8200564"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Spar Shopping centre, Carpenterstown",
            "city": "D15",
            "county": "Dublin",
            "phone": "18220846"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Blackrock Shopping centre,",
            "city": "Blackrock",
            "county": "Dublin",
            "phone": "12788078"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Aylesbury S/c, Tallaght",
            "city": "Tallaght",
            "county": "Dublin",
            "phone": "01 452 1594"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Ashleaf S.C.,",
            "city": "Crumlin",
            "county": "Dublin",
            "phone": "01 4555648"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Artane Castle S C,",
            "city": "Artane",
            "county": "Dublin",
            "phone": "(01) 8314811"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Upper George's street,",
            "city": "Dun Laoghaire",
            "county": "Dublin",
            "phone": "(01) 2807352"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Unit 7, The village centre, Rathborne",
            "city": "Ashtown",
            "county": "Dublin",
            "phone": "(01) 8996982"
        },
        {
            "name": "Lloyds Pharmacy Clonskeagh",
            "street": "Bird Avenue, Clonskeagh",
            "city": "Dublin 14",
            "county": "Dublin",
            "phone": "12697086"
        },
        {
            "name": "Lloyds Pharmacy Kilbarrack S.C",
            "street": "Kilbarrack S.C, Kilbarrack",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "8481585"
        },
        {
            "name": "Lloyds Pharmacy Knocklyon",
            "street": "Knocklyon S.c., Knocklyon",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01 494 2406"
        },
        {
            "name": "Lloyds Pharmacy Northside",
            "street": "Northside Shopping centre, Coolock",
            "city": "Dublin 17",
            "county": "Dublin",
            "phone": "18476463"
        },
        {
            "name": "Lloyds Pharmacy Rowlagh",
            "street": "1 Chaplains place, Rowlagh",
            "city": "Dublin 22",
            "county": "Dublin",
            "phone": "16208502"
        },
        {
            "name": "Lloyds Pharmacy Shankill",
            "street": "Main Street",
            "city": "Shankill",
            "county": "Dublin",
            "phone": "12820236"
        },
        {
            "name": "Lloyds Pharmacy Stillorgan",
            "street": "130 Stillorgan Heath , Stillorgan",
            "city": "Co Dublin",
            "county": "Dublin",
            "phone": "12881828"
        },
        {
            "name": "Lloyds Pharmacy, Crumlin Village",
            "street": "20 St agnes road, Crumlin  Village",
            "city": "Dublin 12",
            "county": "Dublin",
            "phone": "14555260"
        },
        {
            "name": "Lombard Pharmacy",
            "street": "32 Lombard street east, Dublin 2",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "(01) 677 0781"
        },
        {
            "name": "Lonergans Pharmacy",
            "street": "3 Harty avenue, walkinstown,",
            "city": "Dublin 12",
            "county": "Dublin",
            "phone": "(01)5574949"
        },
        {
            "name": "Long Mile Road Pharmacy",
            "street": "1 Long mile road ,",
            "city": "Dublin 12",
            "county": "Dublin",
            "phone": "01-5619075"
        },
        {
            "name": "Lucan Village Pharmacy",
            "street": "4 Main street,",
            "city": "Lucan",
            "county": "Dublin",
            "phone": "16100897"
        },
        {
            "name": "Lynch\u2019s Allcare",
            "street": "Unit 6 Castleknock village centre,",
            "city": "Castleknock",
            "county": "Dublin",
            "phone": "18218564"
        },
        {
            "name": "Macken's Pharmacy",
            "street": "41 Main st,",
            "city": "Blackrock",
            "county": "Dublin",
            "phone": "(01) 288 9199"
        },
        {
            "name": "MacNamara Pharmacy",
            "street": "Supervalu Shopping centre, Raheny",
            "city": "Dublin 5",
            "county": "Dublin",
            "phone": "18329736"
        },
        {
            "name": "MacNamara Pharmacy Ltd",
            "street": "30 Main st,",
            "city": "Swords",
            "county": "Dublin",
            "phone": "18401253"
        },
        {
            "name": "MacNamara's Pharmacy",
            "street": "Dublin Road,",
            "city": "Swords",
            "county": "Dublin",
            "phone": "18132504"
        },
        {
            "name": "MACNAMARA'S PHARMACY",
            "street": "Boroimhe Shopping centre,",
            "city": "Swords",
            "county": "Dublin",
            "phone": "18406635"
        },
        {
            "name": "Magner's Pharmacy",
            "street": "175 Howth road, Killester",
            "city": "Killester",
            "county": "Dublin",
            "phone": "(01) 8333065"
        },
        {
            "name": "Magner's Pharmacy",
            "street": "Old Swiss cottage building, Swords Rd",
            "city": "Santry",
            "county": "Dublin",
            "phone": "18623988"
        },
        {
            "name": "Magners Pharmacy",
            "street": "Unit 24 Edenmore shopping centre,",
            "city": "Edenmore",
            "county": "Dublin",
            "phone": "01 8475725"
        },
        {
            "name": "Magners Pharmacy",
            "street": "16 Kincora avenue,",
            "city": "Clontarf",
            "county": "Dublin",
            "phone": "01-8339066"
        },
        {
            "name": "Mangans Pharmacy Rialto",
            "street": "Rialto Primary care centre, 383 South circular road",
            "city": "Rialto",
            "county": "Dublin",
            "phone": "01 9120921"
        },
        {
            "name": "Manor Pharmacy",
            "street": "21 Manor street, Stoneybatter",
            "city": "D07 FP21",
            "county": "Dublin",
            "phone": "16791097"
        },
        {
            "name": "Maple Pharmacy",
            "street": "Unit 3 Maple centre, Navan Road",
            "city": "Cabra",
            "county": "Dublin",
            "phone": "18823323"
        },
        {
            "name": "Market Pharmacy Smithfield",
            "street": "Unit 8b Thundercut alley, Smithfield",
            "city": "Smithfield",
            "county": "Dublin",
            "phone": "18747097"
        },
        {
            "name": "Mater Private Hospital Pharmacy",
            "street": "Eccles St,",
            "city": "Dublin 7",
            "county": "Dublin",
            "phone": "+118858532"
        },
        {
            "name": "Maxwell Pharmacy",
            "street": "28 Castle street,",
            "city": "Dalkey",
            "county": "Dublin",
            "phone": "12859833"
        },
        {
            "name": "MCAULIFFES PHARMACY",
            "street": "93 Sandymount road, Sandymount",
            "city": "Dublin",
            "county": "Dublin",
            "phone": "01 6684121"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "Unit 2 Yellow walls,",
            "city": "Malahide",
            "county": "Dublin",
            "phone": "18456990"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "Unit 1 Veronica house, Lower Main street",
            "city": "Rush",
            "county": "Dublin",
            "phone": "(01)8949100"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "Unit G24 pavilions sc,",
            "city": "Swords",
            "county": "Dublin",
            "phone": "18406555"
        },
        {
            "name": "Mccabes Pharmacy",
            "street": "Gulliver's Retail park, Northwood",
            "city": "Santry D9",
            "county": "Dublin",
            "phone": "18429615"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "Malahide Shopping centre,",
            "city": "Malahide",
            "county": "Dublin",
            "phone": "01 8453898"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "Unit 2, Griffeen centre, Griffeen Avenue",
            "city": "Lucan",
            "county": "Dublin",
            "phone": "15056449"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "Unit 2, Lidl complex, Main Road",
            "city": "Tallaght",
            "county": "Dublin",
            "phone": "14522487"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "312 Lower kimmage road, kimmage road",
            "city": "Dublin 6w",
            "county": "Dublin",
            "phone": "14906011"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "2 Sandyford hall centre, Kilgobbin Road",
            "city": "Sandyford",
            "county": "Dublin",
            "phone": "12956368"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "Level 3 Unit 17-19, Dundrum Town centre",
            "city": "Dundrum",
            "county": "Dublin",
            "phone": "12986709"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "282 Glasnevin avenue, Finglas",
            "city": "Dublin 11",
            "county": "Dublin",
            "phone": "01-8342493"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "The Diamond, Malahide",
            "city": "Malahide",
            "county": "Dublin",
            "phone": "18450807"
        },
        {
            "name": "Mccabes Pharmacy",
            "street": "Unit 1-2 Clarehall shopping centre, Malahide Road",
            "city": "Malahide",
            "county": "Dublin",
            "phone": "18473519"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "Unit 8 College view, Ballymun Road",
            "city": "Ballymun",
            "county": "Dublin",
            "phone": "01 8577011"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "Unit 1 Airside s/c,",
            "city": "Swords",
            "county": "Dublin",
            "phone": "18970682"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "Mountview S/c,",
            "city": "Blanchardstown",
            "county": "Dublin",
            "phone": "(01)8216011"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "Unit 148, Blanchardstown Shopping centre",
            "city": "Dublin 15",
            "county": "Dublin",
            "phone": "(01) 8222171"
        },
        {
            "name": "McCabes Pharmacy Citywest",
            "street": "Units 6-8 Citywest shopping centre,",
            "city": "Citywest",
            "county": "Dublin",
            "phone": "14660094"
        },
        {
            "name": "McCabes Pharmacy Ridgewoood",
            "street": "Forest Road,",
            "city": "Swords",
            "county": "Dublin",
            "phone": "18900053"
        },
        {
            "name": "McCabes Pharmacy, Springfield",
            "street": "Springfield, Tallaght",
            "city": "Tallaght",
            "county": "Dublin",
            "phone": "14940818"
        },
        {
            "name": "Mccabes Pharnacy",
            "street": "Unit 1a  Station rd,",
            "city": "Lusk",
            "county": "Dublin",
            "phone": "01 8431100"
        },
        {
            "name": "McCabes Rathbeale",
            "street": "Jc's Supermarket, Rathbeale",
            "city": "Swords",
            "county": "Dublin",
            "phone": "01 8402764"
        },
        {
            "name": "mccabes.woodstown",
            "street": "Woodstown Sc, Knocklyon",
            "city": "Knocklyon",
            "county": "Dublin",
            "phone": "14952130"
        },
        {
            "name": "McCaffreys Pharmacy",
            "street": "69 Upper george's street,",
            "city": "Dun Laoghaire",
            "county": "Dublin",
            "phone": "12845754"
        },
        {
            "name": "McCartan'S Pharmacy",
            "street": "Unit 4 Carrickhill s/c, Wendell Ave",
            "city": "Portmarnock",
            "county": "Dublin",
            "phone": "01-8461471"
        },
        {
            "name": "McCartans Pharmacy",
            "street": "Unit 1 Supervalu centre,",
            "city": "Sutton",
            "county": "Dublin",
            "phone": "1832240"
        },
        {
            "name": "McCartans Pharmacy",
            "street": "Shankill Shopping centre,",
            "city": "Shankill",
            "county": "Dublin",
            "phone": "102825411"
        },
        {
            "name": "McCartans Pharmacy",
            "street": "Unit 7/8 Northside shopping centre, Coolock",
            "city": "Coolock",
            "county": "Dublin",
            "phone": "18770872"
        },
        {
            "name": "McCartans Pharmacy",
            "street": "Unit 3 Bayside sc,",
            "city": "Bayside",
            "county": "Dublin",
            "phone": "01 8393939"
        },
        {
            "name": "McCartans Pharmacy",
            "street": "Uni 11, Block b, Castlemill Shopping centre",
            "city": "Balbriggan",
            "county": "Dublin",
            "phone": "01 6904333"
        },
        {
            "name": "McCartans Pharmacy",
            "street": "34 Fairview strand,",
            "city": "Fairview",
            "county": "Dublin",
            "phone": "01 8363577"
        },
        {
            "name": "McCartans Pharmacy Millers Glen",
            "street": "Unit 2 Millers square, Millers Glen",
            "city": "Swords",
            "county": "Dublin",
            "phone": "10001005"
        },
        {
            "name": "Newcastle-Lyons Pharmacy",
            "street": "Unit 4 Newcastle shopping centre, Newcastle-lyons Pharmacy",
            "city": "Newcastle",
            "county": "Dublin",
            "phone": "14011771"
        },
        {
            "name": "Primacare",
            "street": "Ballyowen Lane,",
            "city": "Lucan",
            "county": "Dublin",
            "phone": "16214224"
        },
        {
            "name": "Sandycove Pharmacy",
            "street": "60 Glasthule road,,",
            "city": "Dun Laoghaire",
            "county": "Dublin",
            "phone": "(01) 2801587"
        },
        {
            "name": "Superintendent",
            "street": "United Drug house , Magma Business park",
            "city": "D24xke5",
            "county": "Dublin",
            "phone": "14632300"
        }
    ],
    "Galway": [
        {
            "name": "3Dental",
            "street": "28, Briarhill business park,",
            "city": "Ballybrit",
            "county": "Galway",
            "phone": "(091) 351 033"
        },
        {
            "name": "Abbeyknockmoy Health Centre",
            "street": "Abbeyknockmoy,",
            "city": "Tuam",
            "county": "Galway",
            "phone": "093 43512"
        },
        {
            "name": "Abbeyknockmoy Health Centre",
            "street": "Abbeyknockmoy,",
            "city": "Tuam",
            "county": "Galway",
            "phone": "093 43512"
        },
        {
            "name": "Abbeyknockmoy Pharmacy Limited",
            "street": "Unit 1 Cois na habhainn, Abbeyknockmoy",
            "city": "Tuam",
            "county": "Galway",
            "phone": "9343047"
        },
        {
            "name": "Alliance Physiotherapy",
            "street": "4 Ballybane road,",
            "city": "Galway",
            "county": "Galway",
            "phone": "874030340"
        },
        {
            "name": "ALTHEIR LTD",
            "street": "Ballygar Rd,",
            "city": "Mountbellew",
            "county": "Galway",
            "phone": "909679990"
        },
        {
            "name": "An Teaghlach Uilinn",
            "street": "Church Road, Kilrainey",
            "city": "Moycullen",
            "county": "Galway",
            "phone": "91555444"
        },
        {
            "name": "Andrea Concannon Opticians",
            "street": "200 Upper salthill,",
            "city": "Galway",
            "county": "Galway",
            "phone": "91586748"
        },
        {
            "name": "Arlington House Medical Centre",
            "street": "Dublin Road, Oranmore",
            "city": "Galway",
            "county": "Galway",
            "phone": "91794694"
        },
        {
            "name": "Arlington House Medical Centre",
            "street": "Dublin Road, Oranmore",
            "city": "Galway",
            "county": "Galway",
            "phone": "91794694"
        },
        {
            "name": "Athenry Opticians",
            "street": "Unit 1 King john house , Cross St",
            "city": "Athenry",
            "county": "Galway",
            "phone": "091 850546"
        },
        {
            "name": "Ballinderry Nursing Home",
            "street": "Kilconnell,",
            "city": "Ballinasloe",
            "county": "Galway",
            "phone": "909686890"
        },
        {
            "name": "Ballybane Pharmacy",
            "street": "Ballybane Sc,",
            "city": "Galway",
            "county": "Galway",
            "phone": "(091) 757 044"
        },
        {
            "name": "Ballygar Pharmacy",
            "street": "Unit 2, High Street",
            "city": "Ballygar",
            "county": "Galway",
            "phone": "906624409"
        },
        {
            "name": "Barna Village Dental",
            "street": "Freeport, Barna",
            "city": "Galway",
            "county": "Galway",
            "phone": "91596640"
        },
        {
            "name": "Billy King Pharmacy",
            "street": "Unit 2 The mount, Dunlo Hill",
            "city": "Ballinasloe",
            "county": "Galway",
            "phone": "090 643488"
        },
        {
            "name": "Blake Manor",
            "street": "Cloughballymore House, Ballinderreen",
            "city": "Kilcolgan",
            "county": "Galway",
            "phone": "091 796 188"
        },
        {
            "name": "Bon Secours Hospital",
            "street": "Renmore,",
            "city": "Galway",
            "county": "Galway",
            "phone": "91381925"
        },
        {
            "name": "Boots",
            "street": "Galway S C, Headford Rd",
            "city": "Galway",
            "county": "Galway",
            "phone": "091 567901"
        },
        {
            "name": "Boots The Chemist",
            "street": "35 Shop street, Galway",
            "city": "Galway",
            "county": "Galway",
            "phone": "91561374"
        },
        {
            "name": "Boots The Chemist",
            "street": "Unit 13 Gateway retail park, Knocknacarra",
            "city": "Galway",
            "county": "Galway",
            "phone": "91573863"
        },
        {
            "name": "Boots Wellpark",
            "street": "Unit 10 Wellpark retail park, Old Dublin road",
            "city": "Galway",
            "county": "Galway",
            "phone": "(091)752702"
        },
        {
            "name": "Briarhill Pharmacy",
            "street": "Briarhill Shopping centre,",
            "city": "Galway",
            "county": "Galway",
            "phone": "(091)759628"
        },
        {
            "name": "Brodericks Pharmacy",
            "street": "30, Society street,",
            "city": "Ballinasloe",
            "county": "Galway",
            "phone": "909642161"
        },
        {
            "name": "Brodericks Pharmacy",
            "street": "30, Society street,",
            "city": "Ballinasloe",
            "county": "Galway",
            "phone": "909642161"
        },
        {
            "name": "Brogans Totalhealth Pharmacy",
            "street": "Main Street,",
            "city": "Loughrea",
            "county": "Galway",
            "phone": "91842527"
        },
        {
            "name": "Claddagh Pharmacy",
            "street": "8 Father griffin road,",
            "city": "Galway",
            "county": "Galway",
            "phone": "91583954"
        },
        {
            "name": "Clarke's Pharmacy",
            "street": "Unit Gf3, kilcolgan business centre, Main Road",
            "city": "Kilcolgan",
            "county": "Galway",
            "phone": "91485302"
        },
        {
            "name": "Cleary's Pharmacy",
            "street": "16 Mary st,",
            "city": "Galway",
            "county": "Galway",
            "phone": "091 562967"
        },
        {
            "name": "Cleary's Pharmacy",
            "street": "16 Mary st,",
            "city": "Galway",
            "county": "Galway",
            "phone": "091 562967"
        },
        {
            "name": "Cogaslann Agatha",
            "street": "Main Street,",
            "city": "Carraroe",
            "county": "Galway",
            "phone": "91595154"
        },
        {
            "name": "Cogaslann Agatha",
            "street": "Carna,",
            "city": "Carna",
            "county": "Galway",
            "phone": "095 32680"
        },
        {
            "name": "Cogaslann Chasla",
            "street": "Derrynea , Casla",
            "city": "Galway",
            "county": "Galway",
            "phone": "91572002"
        },
        {
            "name": "Colms Life Pharmacy",
            "street": "1 Cuirt na tra,",
            "city": "Salthill",
            "county": "Galway",
            "phone": "91501456"
        },
        {
            "name": "Connolly'S Pharmacy",
            "street": "Main Street,",
            "city": "Oranmore",
            "county": "Galway",
            "phone": "91792022"
        },
        {
            "name": "Craughwell Pharmacy",
            "street": "Main Street, Craughwell",
            "city": "Craughwell",
            "county": "Galway",
            "phone": "91876537"
        },
        {
            "name": "Dalys Pharmacy",
            "street": "The Market hall , Church St",
            "city": "Gort",
            "county": "Galway",
            "phone": "91630330"
        },
        {
            "name": "Duanes Pharmacy",
            "street": "Society St,",
            "city": "Ballinasloe",
            "county": "Galway",
            "phone": "909642148"
        },
        {
            "name": "Duddys Pharmacy",
            "street": "Brendan St,",
            "city": "Portumna",
            "county": "Galway",
            "phone": "090 974 1100"
        },
        {
            "name": "Duffy's Pharmacy",
            "street": "The Square,",
            "city": "Tuam",
            "county": "Galway",
            "phone": "93026866"
        },
        {
            "name": "Duffys Pharmacy",
            "street": "Killimor,",
            "city": "Ballinasloe",
            "county": "Galway",
            "phone": "909676054"
        },
        {
            "name": "Duggans Pharmacy",
            "street": "1 Renmore rd, Renmroe",
            "city": "Galway",
            "county": "Galway",
            "phone": "(091) 757121"
        },
        {
            "name": "E&B PHARMACY LTD",
            "street": "Main St, Eyrecourt",
            "city": "Galway",
            "county": "Galway",
            "phone": "909675146"
        },
        {
            "name": "Feelys Totalhealth Pharmacy",
            "street": "Dublin Rd,",
            "city": "Tuam",
            "county": "Galway",
            "phone": "093 24876"
        },
        {
            "name": "Flaherty's Pharmacy",
            "street": "Main Street,",
            "city": "Oughterard",
            "county": "Galway",
            "phone": "091-557602"
        },
        {
            "name": "Flanagan's Pharmacy",
            "street": "The Square, Athenry",
            "city": "Athenry",
            "county": "Galway",
            "phone": "091 844058"
        },
        {
            "name": "Flanagans PharmacyeE",
            "street": "Main St headford, Headford",
            "city": "Co Galway ireland",
            "county": "Galway",
            "phone": "+3539335437"
        },
        {
            "name": "Flanagans Totalhealth Pharmacy",
            "street": "32 Shop street,",
            "city": "Galway",
            "county": "Galway",
            "phone": "91562924"
        },
        {
            "name": "Flanneryphysio",
            "street": "Anne Flannery , Farranablake West",
            "city": "Athenry",
            "county": "Galway",
            "phone": "868119912"
        },
        {
            "name": "Garveys Pharmacy",
            "street": "Irish House, Glenamaddy",
            "city": "Via Castlerea",
            "county": "Galway",
            "phone": "094 9659012"
        },
        {
            "name": "Gilmartins Pharmacy",
            "street": "Bridge St.,",
            "city": "Gort",
            "county": "Galway",
            "phone": "091 631236"
        },
        {
            "name": "GLEESON'S PHARMACY",
            "street": "The Mall, Vicar Street",
            "city": "Tuam",
            "county": "Galway",
            "phone": "093 24988"
        },
        {
            "name": "Go West Pharmacy",
            "street": "Unit 4 West city centre, Old Seamus quirke road",
            "city": "Galway",
            "county": "Galway",
            "phone": "091 580088"
        },
        {
            "name": "Haven Pharmacy Barna",
            "street": "Barna,",
            "city": "Galway",
            "county": "Galway",
            "phone": "91590749"
        },
        {
            "name": "Haven Pharmacy Hollys",
            "street": "8 Centrepoint, liosban,, Tuam Rd",
            "city": "Galway",
            "county": "Galway",
            "phone": "91750054"
        },
        {
            "name": "Haven Pharmacy Hollys",
            "street": "7a Marina point, Ballinasloe",
            "city": "Ballinasloe",
            "county": "Galway",
            "phone": "909645676"
        },
        {
            "name": "Hayes & Hayes Totalhealth Pharmacy",
            "street": "St. Brendan\u2019s st,",
            "city": "Portumna",
            "county": "Galway",
            "phone": "909741025"
        },
        {
            "name": "Headford Careplus Pharmacy",
            "street": "Headford Careplus pharmacy, Unit 8/9 Church road",
            "city": "Headford",
            "county": "Galway",
            "phone": "9334441"
        },
        {
            "name": "Healthwise Pharmacy",
            "street": "Poolboy, Ballinasloe",
            "city": "Ballinasloe",
            "county": "Galway",
            "phone": "909645693"
        },
        {
            "name": "Healthwise Pharmacy Oranmore",
            "street": "Arlington Medical centre, Dublin Rd",
            "city": "Oranmore",
            "county": "Galway",
            "phone": "91794607"
        },
        {
            "name": "Healy's Pharmacy",
            "street": "Society Street, Society Street",
            "city": "Ballinasloe",
            "county": "Galway",
            "phone": "090 9642252"
        },
        {
            "name": "Hendricks Pharmacy",
            "street": "C/o Tesco, Dunlo Shopping centre",
            "city": "Ballinasloe",
            "county": "Galway",
            "phone": "090-9644160"
        },
        {
            "name": "High Cross Pharmacy Ltd.",
            "street": "High Street,",
            "city": "Tuam",
            "county": "Galway",
            "phone": "9324699"
        },
        {
            "name": "Howards Pharmacy",
            "street": "12 An fuaran,",
            "city": "Moycullen",
            "county": "Galway",
            "phone": "091 868955"
        },
        {
            "name": "Jill Moore Pharmacy",
            "street": "The Demesne, , Mountbellew",
            "city": "Mountbellew",
            "county": "Galway",
            "phone": "909623530"
        },
        {
            "name": "Johnstons Allcare Pharmacy",
            "street": "Unit 2 , High Street",
            "city": "Ballygar",
            "county": "Galway",
            "phone": "090 6624780"
        },
        {
            "name": "Keadys Pharmacy",
            "street": "The Square,",
            "city": "Headford",
            "county": "Galway",
            "phone": "9334772"
        },
        {
            "name": "Kelly's Pharmacy",
            "street": "Church Street,",
            "city": "Athenry",
            "county": "Galway",
            "phone": "91844012"
        },
        {
            "name": "Kilgarriff's Chemists Ltd",
            "street": "Vicar Street,",
            "city": "Tuam",
            "county": "Galway",
            "phone": "9324120"
        },
        {
            "name": "Killians Pharmacy",
            "street": "55 Main st.,",
            "city": "Loughrea",
            "county": "Galway",
            "phone": "91841589"
        },
        {
            "name": "Kinvara Pharmacy",
            "street": "Unit 2, The Crane centre",
            "city": "Kinvara",
            "county": "Galway",
            "phone": "91637397"
        },
        {
            "name": "Lackagh Pharmacy",
            "street": "Lackagh, Turloughmore",
            "city": "Galway",
            "county": "Galway",
            "phone": "91797056"
        },
        {
            "name": "Lakeshore Pharmacy",
            "street": "Barrack Street,",
            "city": "Loughrea",
            "county": "Galway",
            "phone": "91842490"
        },
        {
            "name": "Lavelle's Pharmacy",
            "street": "Queensgate, 23 Dock road",
            "city": "Galway",
            "county": "Galway",
            "phone": "91454988"
        },
        {
            "name": "Leahy'S Pharmacy",
            "street": "Dunkellin Street,",
            "city": "Loughrea",
            "county": "Galway",
            "phone": "+35391841236"
        },
        {
            "name": "Leahys Pharmacy",
            "street": "Dunlo Street,",
            "city": "Ballinasloe",
            "county": "Galway",
            "phone": "(090)9642279"
        },
        {
            "name": "Leo Walsh Pharmacy",
            "street": "Tornog, Unit 9, Headford Rd.,",
            "city": "Galway",
            "county": "Galway",
            "phone": "091 374336"
        },
        {
            "name": "Leo Walsh Pharmacy",
            "street": "Unit 105, Eyre sqaure sc, Galway",
            "city": "Galway",
            "county": "Galway",
            "phone": "91568618"
        },
        {
            "name": "Leo Walsh Pharmacy",
            "street": "Joyces S.c., , Knocknacarra",
            "city": "Galway",
            "county": "Galway",
            "phone": "091 587638"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "13 Forster street,",
            "city": "Galway",
            "county": "Galway",
            "phone": "091-567740"
        },
        {
            "name": "Lohans Pharmacy",
            "street": "60 Prospect hill,",
            "city": "Galway",
            "county": "Galway",
            "phone": "091 568 454"
        },
        {
            "name": "Loughrea Careplus Pharmacy",
            "street": "Supervalu Loughrea, Athenry Road",
            "city": "Loughrea",
            "county": "Galway",
            "phone": "91423834"
        },
        {
            "name": "MATT O FLAHERTY CHEMIST",
            "street": "16/18 William st, Galway",
            "city": "Galway",
            "county": "Galway",
            "phone": "91566670"
        },
        {
            "name": "Matt O'Flaherty",
            "street": "Unit 15 Galway shopping centre, Headford Road",
            "city": "Galway",
            "county": "Galway",
            "phone": "091 564134"
        },
        {
            "name": "Matt O'Flaherty Chemist",
            "street": "Unit 2 An creagan, Barna",
            "city": "Barna",
            "county": "Galway",
            "phone": "091 867070"
        },
        {
            "name": "Matt O'Flaherty Chemists",
            "street": "Unit 7/8 Cearnog nua,",
            "city": "Moycullen",
            "county": "Galway",
            "phone": "(091) 556664"
        },
        {
            "name": "Matt O'Flahertys",
            "street": "37 Eyre square,",
            "city": "Galway",
            "county": "Galway",
            "phone": "91563526"
        },
        {
            "name": "Mc Sharry's Pharmacy",
            "street": "Unit 5 Gateway s.c.,, Knocknacarra",
            "city": "Galway",
            "county": "Galway",
            "phone": "091 515250"
        }
    ],
    "Kerry": [
        {
            "name": "Abbeydorney Pharmacy",
            "street": "Abbeydorney,",
            "city": "Co Kerry",
            "county": "Kerry",
            "phone": "667198871"
        },
        {
            "name": "Aghadoe Physiotherapy Clinic",
            "street": "4 Ard na be, Aghadoe",
            "city": "Killarney",
            "county": "Kerry",
            "phone": "086 3402208"
        },
        {
            "name": "Ahern\u2019S Dental",
            "street": "5 Mill road,",
            "city": "Killorglin",
            "county": "Kerry",
            "phone": "669790400"
        },
        {
            "name": "Ahern'S Dental Practice",
            "street": "5 Mill rd,",
            "city": "Killorglin",
            "county": "Kerry",
            "phone": "669790400"
        },
        {
            "name": "Aherns Pharmacy",
            "street": "Farranfore,",
            "city": "Killarney",
            "county": "Kerry",
            "phone": "066 9764722"
        },
        {
            "name": "An Neidin Family Practice",
            "street": "Railway Road, Railway Road",
            "city": "Kenmare",
            "county": "Kerry",
            "phone": "646641333"
        },
        {
            "name": "Annascaul Health Centre",
            "street": "Church Avenue, Annascaul",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "669157227"
        },
        {
            "name": "ANNE Lyons",
            "street": "Market Cross,",
            "city": "Castleisland",
            "county": "Kerry",
            "phone": "066 7142488"
        },
        {
            "name": "Aras Mhuire Nursing Home",
            "street": "Greenville,",
            "city": "Listowel",
            "county": "Kerry",
            "phone": "6821470"
        },
        {
            "name": "Ardfert Medical Centre",
            "street": "Farranwilliam, Ardfert",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "667134366"
        },
        {
            "name": "Ashborough Lodge",
            "street": "Lyre Road,",
            "city": "Milltown",
            "county": "Kerry",
            "phone": "669765100"
        },
        {
            "name": "Ashe Street Physiotherapy Clinic",
            "street": "18 Ashe street,",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "667129688"
        },
        {
            "name": "Ballybunion Dental Care",
            "street": "Sandhill Road,",
            "city": "Ballybunion",
            "county": "Kerry",
            "phone": "6828746"
        },
        {
            "name": "Ballybunion Pharmacy",
            "street": "Supervalu Shopping centre, Main Street",
            "city": "Ballybunion",
            "county": "Kerry",
            "phone": "068 27437"
        },
        {
            "name": "Ballyduff Medical Centre",
            "street": "Main Street,",
            "city": "Ballyduff",
            "county": "Kerry",
            "phone": "667131211"
        },
        {
            "name": "Ballyduff Pharmacy",
            "street": "Ballyduff,",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "667131111"
        },
        {
            "name": "Barefootphysio",
            "street": "Unit 11, , 4 Park business centre,",
            "city": "Farranfore,",
            "county": "Kerry",
            "phone": "879844875"
        },
        {
            "name": "Bon Secours Pharmacy Tralee",
            "street": "Strand Road,",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "066 7149837"
        },
        {
            "name": "Bon Secours Pharmacy Tralee",
            "street": "Strand Road,",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "066 7149837"
        },
        {
            "name": "Boots",
            "street": "Unit 12b, Abbey court, , Central Plaza,",
            "city": "Tralee,",
            "county": "Kerry",
            "phone": "066 7124688"
        },
        {
            "name": "Boots Killarney",
            "street": "10/11 Deerpark retail centre,",
            "city": "Killarney",
            "county": "Kerry",
            "phone": "646620917"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "New Street, Killarney",
            "city": "Co Kerry",
            "county": "Kerry",
            "phone": "064 6634612"
        },
        {
            "name": "Brassil's Pharmacy",
            "street": "Main Street, ballyheigue, Main Street",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "667133122"
        },
        {
            "name": "Brodericks Pharmacy",
            "street": "7 William street,",
            "city": "Listowel",
            "county": "Kerry",
            "phone": "068-22888"
        },
        {
            "name": "Burns Pharmacy",
            "street": "Balloonagh Medical centre, Balloonagh Estate",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "667119526"
        },
        {
            "name": "CH Chemists",
            "street": "31 The mall,",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "(066) 7121331"
        },
        {
            "name": "Costello Pharmacy",
            "street": "Russell Street,",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "667121075"
        },
        {
            "name": "Crowleyspharmacy",
            "street": "81 Main street,",
            "city": "Castleisland",
            "county": "Kerry",
            "phone": "667141200"
        },
        {
            "name": "Grogan's Pharmacy",
            "street": "Spa Road, Dingle",
            "city": "Dingle",
            "county": "Kerry",
            "phone": "669150518"
        },
        {
            "name": "Harnetts Pharmacy",
            "street": "41 The square,",
            "city": "Listowel",
            "county": "Kerry",
            "phone": "6821335"
        },
        {
            "name": "Haven Pharmacy Brosnan's",
            "street": "19 Henry st,",
            "city": "Kenmare",
            "county": "Kerry",
            "phone": "646641318"
        },
        {
            "name": "Haven Pharmacy Kennelly'S",
            "street": "The Reeks gateway, Rock Road",
            "city": "Killarney",
            "county": "Kerry",
            "phone": "(064) 66 39427"
        },
        {
            "name": "Haven Pharmacy Kennellys",
            "street": "6 Lower castle street,",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "667121042"
        },
        {
            "name": "Haven Pharmacy O'Sullivans",
            "street": "Mill Road,",
            "city": "Killorglin",
            "county": "Kerry",
            "phone": "066 9762111"
        },
        {
            "name": "Haven Pharmacy Shanahans",
            "street": "Church St,",
            "city": "Castleisland",
            "county": "Kerry",
            "phone": "667141225"
        },
        {
            "name": "Jeffrey's Pharmacy",
            "street": "The Medical hall ,",
            "city": "Caherciveen",
            "county": "Kerry",
            "phone": "669472309"
        },
        {
            "name": "John F Mcguire",
            "street": "6 Church  st, Listowel",
            "city": "Listowel",
            "county": "Kerry",
            "phone": "6821299"
        },
        {
            "name": "Kelly's Allcare",
            "street": "9 The mall,",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "667121302"
        },
        {
            "name": "Kennelly's Pharmacy And Opticians",
            "street": "33 New street,",
            "city": "Killarney",
            "county": "Kerry",
            "phone": "646636222"
        },
        {
            "name": "Kennellys Chemists & Opticians",
            "street": "46 Main street,",
            "city": "Castleisland",
            "county": "Kerry",
            "phone": "066-7141293"
        },
        {
            "name": "Laune Pharmacy",
            "street": "Market Street,",
            "city": "Killorglin",
            "county": "Kerry",
            "phone": "066 9761131"
        },
        {
            "name": "Leahy Pharmacy",
            "street": "Oakpark,",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "667127022"
        },
        {
            "name": "Leahys Pharmacy Ballinorig",
            "street": "Unit 1b Ballinorig business park, Ballinorig",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "667128222"
        },
        {
            "name": "Lixnaw Pharmacy Ltd",
            "street": "Clogher, Lixnaw",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "667132153"
        },
        {
            "name": "Lloyds Ashe Street",
            "street": "10-11 Ashe street, Tralee",
            "city": "Kerry",
            "county": "Kerry",
            "phone": "667190931"
        },
        {
            "name": "LloydsPharmacy",
            "street": "Fairies Cross,",
            "city": "Tralee",
            "county": "Kerry",
            "phone": "667117924"
        },
        {
            "name": "Lynch Pharmacy Ltd",
            "street": "9 Lower main st.,,",
            "city": "Castleisland",
            "county": "Kerry",
            "phone": "667142479"
        },
        {
            "name": "O'Connor'S Pharmacy",
            "street": "7 Market st, listowel, 7 Market st",
            "city": "Listowel",
            "county": "Kerry",
            "phone": "068 21295"
        }
    ],
    "Kildare": [
        {
            "name": "A+A Pharmacy",
            "street": "21 William street,,",
            "city": "Athy",
            "county": "Kildare",
            "phone": "598641177"
        },
        {
            "name": "Abbey Physio Clinic",
            "street": "Unit 4, Yew tree square, Prosperous Rd",
            "city": "Clane",
            "county": "Kildare",
            "phone": "863039372"
        },
        {
            "name": "Able Bodies Physiotherapy",
            "street": "2 Georges street,",
            "city": "Newbridge",
            "county": "Kildare",
            "phone": "45435480"
        },
        {
            "name": "Ashley Lodge",
            "street": "Tully East,",
            "city": "Kildare",
            "county": "Kildare",
            "phone": "45521300"
        },
        {
            "name": "Athy Medical",
            "street": "Carlow Road ,",
            "city": "Athy",
            "county": "Kildare",
            "phone": "05986 31476"
        },
        {
            "name": "Atrium Family Practice",
            "street": "Unit 1 The atrium, Johns Lane",
            "city": "Naas",
            "county": "Kildare",
            "phone": "45250090"
        },
        {
            "name": "Audrey Dunne Life Pharmacy",
            "street": "Abbey Street,",
            "city": "Castledermot",
            "county": "Kildare",
            "phone": "599144533"
        },
        {
            "name": "Ballycane Surgery",
            "street": "Unit 2,3 Hazelmere sc, Ballycane Rd",
            "city": "Naas",
            "county": "Kildare",
            "phone": "045 856599"
        },
        {
            "name": "BEECHPARK NURSING HOME",
            "street": "Dunmurry East, Kildare Town",
            "city": "Kildare",
            "county": "Kildare",
            "phone": "045 534000"
        },
        {
            "name": "Bergins Pharmacy",
            "street": "7 Courtyard sc,",
            "city": "Newbridge",
            "county": "Kildare",
            "phone": "45438525"
        },
        {
            "name": "Berney's Chemist",
            "street": "Main Street,",
            "city": "Kilcullen",
            "county": "Kildare",
            "phone": "(045) 481497"
        },
        {
            "name": "Blake's Pharmacy",
            "street": "The Ideal centre,",
            "city": "Prosperous",
            "county": "Kildare",
            "phone": "45841958"
        },
        {
            "name": "Blakes Allcare Pharmacy",
            "street": "Main St,",
            "city": "Celbridge",
            "county": "Kildare",
            "phone": "01 6271141"
        },
        {
            "name": "BLAKES PHARMACY",
            "street": "Main St ,",
            "city": "Ballymore Eustace",
            "county": "Kildare",
            "phone": "45864247"
        },
        {
            "name": "Blakes Pharmacy",
            "street": "Oak Grove,",
            "city": "Allenwood",
            "county": "Kildare",
            "phone": "45859743"
        },
        {
            "name": "Boots",
            "street": "Unit 14/15 Whitewater s.c.,",
            "city": "Newbridge",
            "county": "Kildare",
            "phone": "(045)437765"
        },
        {
            "name": "Boots",
            "street": "Unit 1&2, Dublin Rd",
            "city": "Naas",
            "county": "Kildare",
            "phone": "45901042"
        },
        {
            "name": "Boots Pharmacy",
            "street": "Monread Shopping centre,",
            "city": "Naas",
            "county": "Kildare",
            "phone": "45899332"
        },
        {
            "name": "Boots The Chemist",
            "street": "Unit 23-24 Carton retail park,",
            "city": "Maynooth",
            "county": "Kildare",
            "phone": "(01) 6016721"
        },
        {
            "name": "Burkes Pharmacy",
            "street": "3 North main st.,",
            "city": "Naas",
            "county": "Kildare",
            "phone": "045 897259"
        },
        {
            "name": "Burkes Pharmacy",
            "street": "Unit 2, Hillcrest",
            "city": "Kilcullen",
            "county": "Kildare",
            "phone": "45480450"
        },
        {
            "name": "Callagys Pharmacy",
            "street": "Main Street , Kilcock",
            "city": "Kilcock",
            "county": "Kildare",
            "phone": "16287393"
        },
        {
            "name": "Canning's Pharmacy",
            "street": "Ballymany S.C.,",
            "city": "Newbridge",
            "county": "Kildare",
            "phone": "045 431850"
        },
        {
            "name": "Careplus Pharmacy Kilcock",
            "street": "Unit 3 , The Square",
            "city": "Kilcock",
            "county": "Kildare",
            "phone": "16519207"
        },
        {
            "name": "Castletown Pharmacy",
            "street": "McMahons Town Hill,                                                             Maynooth Road",
            "city": "Celbridge",
            "county": "Kildare",
            "phone": "16273962"
        },
        {
            "name": "Chemco Pharmacy",
            "street": "Supervalu Sc, Dublin Road",
            "city": "Celbridge",
            "county": "Kildare",
            "phone": "16276078"
        },
        {
            "name": "Clancys Pharmacy",
            "street": "4 College way, Kilcock Road",
            "city": "Clane",
            "county": "Kildare",
            "phone": "45982748"
        },
        {
            "name": "Connollys Pharmacy",
            "street": "Claregate Street, Kildare Town",
            "city": "Kildare",
            "county": "Kildare",
            "phone": "455213937"
        },
        {
            "name": "Cosgroves Pharmacy",
            "street": "Edward Street ,",
            "city": "Newbridge",
            "county": "Kildare",
            "phone": "045 431430"
        },
        {
            "name": "Curragh Pharmacy",
            "street": "Suncroft Road, Brownstown",
            "city": "The Curragh",
            "county": "Kildare",
            "phone": "45579056"
        },
        {
            "name": "DALYS",
            "street": "17 South main st,",
            "city": "Naas",
            "county": "Kildare",
            "phone": "45897239"
        },
        {
            "name": "Doyles Pharmacy",
            "street": "59 Leinster street,",
            "city": "Athy",
            "county": "Kildare",
            "phone": "598631452"
        },
        {
            "name": "Fadden's Pharmacy",
            "street": "Abbeylands Centre,",
            "city": "Clane",
            "county": "Kildare",
            "phone": "045 902112"
        },
        {
            "name": "Fairgreen Pharmacy",
            "street": "Naas,",
            "city": "Naas",
            "county": "Kildare",
            "phone": "45897489"
        },
        {
            "name": "Feerick's Pharmacy",
            "street": "Unit 2 Captains view, Captains Hill",
            "city": "Leixlip",
            "county": "Kildare",
            "phone": "+35316244761"
        },
        {
            "name": "Gaffneys Allcare",
            "street": "46 Main street,",
            "city": "Leixlip",
            "county": "Kildare",
            "phone": "01 6244561"
        },
        {
            "name": "Gleneaston Pharmacy",
            "street": "Gleneaston Lodge,",
            "city": "Leixlip",
            "county": "Kildare",
            "phone": "16060060"
        },
        {
            "name": "Griffins Pharmacy",
            "street": "Life Pharmacy, 79 Oaklawn",
            "city": "Leixlip",
            "county": "Kildare",
            "phone": "16244673"
        },
        {
            "name": "Harbour Pharmacy",
            "street": "The Harbour ,",
            "city": "Kilcock",
            "county": "Kildare",
            "phone": "16284115"
        },
        {
            "name": "Hickeys Pharmacy",
            "street": "Hickeys",
            "city": "Newbridge",
            "county": "Kildare",
            "phone": "045 431576"
        },
        {
            "name": "Hickeys Pharmacy",
            "street": "Unit 11 , Manor Mills sc",
            "city": "Maynooth",
            "county": "Kildare",
            "phone": "16293065"
        },
        {
            "name": "Home Birth",
            "street": "26 Curragh farm,",
            "city": "Newbridge",
            "county": "Kildare",
            "phone": "857297529"
        },
        {
            "name": "Hughes Pharmacy",
            "street": "Prosperous Road,",
            "city": "Clane",
            "county": "Kildare",
            "phone": "(045) 861541"
        },
        {
            "name": "Janet Dillon Pharmacy",
            "street": "Moorefield Sc,",
            "city": "Newbridge",
            "county": "Kildare",
            "phone": "045 448513"
        },
        {
            "name": "Kildare Pharmacy",
            "street": "Unit 2 Tesco shopping centre, Monasterevin Rd",
            "city": "Kildare",
            "county": "Kildare",
            "phone": "45527823"
        },
        {
            "name": "Kill Pharmacy",
            "street": "Main St,",
            "city": "Kill",
            "county": "Kildare",
            "phone": "45877474"
        },
        {
            "name": "Kinsellas Pharmacy",
            "street": "Primrose Gate, Celbridge",
            "city": "Celbridge",
            "county": "Kildare",
            "phone": "15057696"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Unit 1 Hazelmere SC,",
            "city": "Naas",
            "county": "Kildare",
            "phone": "045 856148"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Crookstown, Ballitore",
            "city": "Athy",
            "county": "Kildare",
            "phone": "598623590"
        },
        {
            "name": "Mangan's CarePlus Pharmacy",
            "street": "Maynooth Road,",
            "city": "Celbridge",
            "county": "Kildare",
            "phone": "19020601"
        },
        {
            "name": "Mangans Pharmacy",
            "street": "The Waterways,",
            "city": "Sallins",
            "county": "Kildare",
            "phone": "045 854911"
        },
        {
            "name": "Mangans Pharmacy",
            "street": "Station Road, Station Road",
            "city": "Newbridge",
            "county": "Kildare",
            "phone": "45430559"
        },
        {
            "name": "Martins Pharmacy",
            "street": "Johnstownbridge,",
            "city": "Johnstownbridge",
            "county": "Kildare",
            "phone": "469549869"
        },
        {
            "name": "MAYNOOTH CAREPLUS PHARMACY",
            "street": "Glenroyal Shopping centre, Maynooth",
            "city": "Maynooth",
            "county": "Kildare",
            "phone": "16290948"
        },
        {
            "name": "McCabes (Maddens) Pharmacy",
            "street": "51 Leinster street,",
            "city": "Athy",
            "county": "Kildare",
            "phone": "598638350"
        },
        {
            "name": "McCartan's Pharmacy",
            "street": "Unit 30b Tesco shopping centre, Maynooth",
            "city": "Maynooth",
            "county": "Kildare",
            "phone": "16286081"
        }
    ],
    "Kilkenny": [
        {
            "name": "Ailish O'Hanlon Opticians",
            "street": "Unit3, Block c,, Newpark Shopping centre",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567786754"
        },
        {
            "name": "Archersrath Nursing Home",
            "street": "Archersrath , Kilkenny",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567790137"
        },
        {
            "name": "Ayrfield Medical Practice",
            "street": "Granges Road,",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567721320"
        },
        {
            "name": "Ayrfield Pharmacy",
            "street": "Ayrfield Medical park, Granges Rd",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567712367"
        },
        {
            "name": "B. MacEneaney Ltd.",
            "street": "42 High street,",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567721179"
        },
        {
            "name": "Ballyragget Pharmacy",
            "street": "Castle St, Ballyragget",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "568830781"
        },
        {
            "name": "Barretts Pharmacy",
            "street": "Barrack Street, Barretts Pharmacy",
            "city": "Castlecomer",
            "county": "Kilkenny",
            "phone": "564441117"
        },
        {
            "name": "Boots",
            "street": "Macdonagh Junction,",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567712426"
        },
        {
            "name": "Boots The Chemist",
            "street": "36-38 High st,",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567771222"
        },
        {
            "name": "Brandonvale Pharmacy",
            "street": "The Old creamery, Main St.",
            "city": "Graiguenamanagh",
            "county": "Kilkenny",
            "phone": "599725326"
        },
        {
            "name": "Callan Pharmacy",
            "street": "Friary Walk,",
            "city": "Callan",
            "county": "Kilkenny",
            "phone": "567755002"
        },
        {
            "name": "Carroll'S Pharmacy",
            "street": "Church Street, Freshford",
            "city": "Freshford",
            "county": "Kilkenny",
            "phone": "568832135"
        },
        {
            "name": "Chemco Pharmacy Bunclody",
            "street": "Supervalu S.c., 24 Hawthorn ave.,",
            "city": "Bunclody",
            "county": "Kilkenny",
            "phone": "(053) 937 5743"
        },
        {
            "name": "Crottys Pharmacy",
            "street": "Main Street,",
            "city": "Bennettsbridge",
            "county": "Kilkenny",
            "phone": "567700574"
        },
        {
            "name": "Fallons Pharmacy",
            "street": "47 John street,",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567780007"
        },
        {
            "name": "Freshco Pharmacy",
            "street": "Beechview, Dublin Road",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "(056)7786111"
        },
        {
            "name": "Goresbridge Allcare Pharmacy",
            "street": "Main St, Goresbridge",
            "city": "Goresbridge",
            "county": "Kilkenny",
            "phone": "599775124"
        },
        {
            "name": "Gowran Pharmacy",
            "street": "Main Street, Gowran",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567726841"
        },
        {
            "name": "Harringtons Pharmacy",
            "street": "The Square, Castlecomer",
            "city": "Castlecomer",
            "county": "Kilkenny",
            "phone": "564441155"
        },
        {
            "name": "Haven Pharmacy O'Connells",
            "street": "4 Rose inn street,",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567721033"
        },
        {
            "name": "Haven Pharmacy O'Connells",
            "street": "89 High street,",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "(056)7721309"
        },
        {
            "name": "Keanes Allcare Pharmacy",
            "street": "50c John st.,",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567765287"
        },
        {
            "name": "KISSANES PHARMACY",
            "street": "Upper Main street,",
            "city": "Graiguenamanagh",
            "county": "Kilkenny",
            "phone": "599724373"
        },
        {
            "name": "Kissanes Pharmacy",
            "street": "Market Street, Thomastown",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567724000"
        },
        {
            "name": "Kissanes Pharmacy",
            "street": "Lower Main street,",
            "city": "Graiguenamanagh",
            "county": "Kilkenny",
            "phone": "599724220"
        },
        {
            "name": "Kissanes Pharmacy",
            "street": "Main Street,",
            "city": "Ballyhale",
            "county": "Kilkenny",
            "phone": "3.53875E+11"
        },
        {
            "name": "Madigans Pharmacy",
            "street": "Green Street ,",
            "city": "Callan",
            "county": "Kilkenny",
            "phone": "567755623"
        },
        {
            "name": "Madigans Pharmacy Kilkenny",
            "street": "1 Fr delahunty terrace, Old Callan rd",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567775540"
        },
        {
            "name": "Mahony's Pharmacy",
            "street": "23 High st, 23 High st",
            "city": "Kilkenny",
            "county": "Kilkenny",
            "phone": "567721029"
        }
    ],
    "Laois": [
        {
            "name": "Adrian Dunne Pharmacy",
            "street": "Main Street,",
            "city": "Portarlington",
            "county": "Laois",
            "phone": "578623124"
        },
        {
            "name": "Audrey's",
            "street": "Market Sq, 17 Triogue manor portlaoise",
            "city": "Portlaoise",
            "county": "Laois",
            "phone": "578590058"
        },
        {
            "name": "Ballard Lodge Nursing Home",
            "street": "Borris Road,",
            "city": "Portlaoise",
            "county": "Laois",
            "phone": "05786 61299"
        },
        {
            "name": "Ballylinan Pharmacy",
            "street": "Unit 2 Gracefield neighbourhood centre, Main Street",
            "city": "Ballylinan",
            "county": "Laois",
            "phone": "598661052"
        },
        {
            "name": "Boots",
            "street": "Unit 31, Laois Shopping centre",
            "city": "Portlaoise",
            "county": "Laois",
            "phone": "578688798"
        },
        {
            "name": "BRESLINS  PHARMACY",
            "street": "G8 Parkside",
            "city": "Portlaoise",
            "county": "Laois",
            "phone": "578621310"
        },
        {
            "name": "BRESLINS  PHARMACY",
            "street": "G8 Parkside",
            "city": "Portlaoise",
            "county": "Laois",
            "phone": "578621310"
        },
        {
            "name": "Casserly Pharmacy Ltd",
            "street": "Lower Main street,",
            "city": "Abbeyleix",
            "county": "Laois",
            "phone": "578731133"
        },
        {
            "name": "Chemco Pharmacy",
            "street": "Supervalu Shopping centre ,",
            "city": "Stradbally",
            "county": "Laois",
            "phone": "578625044"
        },
        {
            "name": "Chemco Pharmacy",
            "street": "Kellyville Centre,",
            "city": "Portlaoise",
            "county": "Laois",
            "phone": "578621342"
        },
        {
            "name": "Clarke's Pharmacy",
            "street": "Pound Street,",
            "city": "Rathdowney",
            "county": "Laois",
            "phone": "50548412"
        },
        {
            "name": "Clonaslee Pharmacy",
            "street": "Main Street,",
            "city": "Clonaslee",
            "county": "Laois",
            "phone": "578686990"
        },
        {
            "name": "Conroys Pharmacy",
            "street": "Main Street,",
            "city": "Mountrath",
            "county": "Laois",
            "phone": "578732177"
        },
        {
            "name": "Durrow Pharmacy",
            "street": "Mary Street,",
            "city": "Durrow",
            "county": "Laois",
            "phone": "578736125"
        },
        {
            "name": "Flynn's Medical Hall",
            "street": "Main Street,",
            "city": "Rathdowney",
            "county": "Laois",
            "phone": "0505 46172"
        },
        {
            "name": "Hughes Pharmacy",
            "street": "90-91 Main street,",
            "city": "Portlaoise",
            "county": "Laois",
            "phone": "578621332"
        },
        {
            "name": "Kilminchy Pharmacy",
            "street": "Kilminchy Court,",
            "city": "Portlaoise",
            "county": "Laois",
            "phone": "578668945"
        },
        {
            "name": "Laois Pharmacy",
            "street": "1 Dunamaise house, Lyster Square",
            "city": "Portlaoise",
            "county": "Laois",
            "phone": "578661999"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Laois Shopping centre,",
            "city": "Portlaoise",
            "county": "Laois",
            "phone": "18660212"
        },
        {
            "name": "Mc Elwees Pharmacy Portlaoise",
            "street": "Cedar Clinic , mountmellick rd , Mcelwee Pharmacy",
            "city": "Portlaoise",
            "county": "Laois",
            "phone": "578666826"
        }
    ],
    "Leitrim": [
        {
            "name": "Boots Chemist",
            "street": "Rosebank Retail park,",
            "city": "Carrick On shannon",
            "county": "Leitrim",
            "phone": "719616923"
        },
        {
            "name": "Cara Pharmacy",
            "street": "High St.,",
            "city": "Drumshanbo",
            "county": "Leitrim",
            "phone": "719641035"
        },
        {
            "name": "Cara Pharmacy",
            "street": "Railway Rd,",
            "city": "Ballinamore",
            "county": "Leitrim",
            "phone": "719644010"
        },
        {
            "name": "COXS PHARMACY",
            "street": "Bridge Street,",
            "city": "Carrick On shannon",
            "county": "Leitrim",
            "phone": "719620158"
        },
        {
            "name": "Gilberts Pharmacy",
            "street": "Main Street, Manorhamilton",
            "city": "Manorhamilton",
            "county": "Leitrim",
            "phone": "719855049"
        },
        {
            "name": "Kierans totalhealth Pharmacy",
            "street": "Main Street, Mohill",
            "city": "Mohill",
            "county": "Leitrim",
            "phone": "071 9631933"
        },
        {
            "name": "KIERANS TOTALHEALTH PHARMACY",
            "street": "Main Street,",
            "city": "Carrick On shannon",
            "county": "Leitrim",
            "phone": "719620130"
        },
        {
            "name": "Kinlough Pharmacy",
            "street": "Main Street , Kinlough",
            "city": "Leitrim",
            "county": "Leitrim",
            "phone": "719843860"
        },
        {
            "name": "MacManus Pharmacy",
            "street": "2 New line,",
            "city": "Manorhamilton",
            "county": "Leitrim",
            "phone": "719820902"
        },
        {
            "name": "Manor Chemist Geaneys Ltd",
            "street": "Main Street,",
            "city": "Manorhamilton",
            "county": "Leitrim",
            "phone": "719855058"
        },
        {
            "name": "Mc Devitts",
            "street": "High St.,",
            "city": "Ballinamore",
            "county": "Leitrim",
            "phone": "719644021"
        }
    ],
    "Limerick": [
        {
            "name": "Abbey Medical Center",
            "street": "Killarney Road , Abbeyfeale",
            "city": "Abbeyfeale",
            "county": "Limerick",
            "phone": "6831600"
        },
        {
            "name": "Abbey River House Medical Practice",
            "street": "Charlotte Quay,",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "061 410355"
        },
        {
            "name": "Abbot Close Nursing Home",
            "street": "St Mary's terrace,",
            "city": "Askeaton",
            "county": "Limerick",
            "phone": "061 601 888"
        },
        {
            "name": "Adare And District Nursing Home",
            "street": "Croagh ,",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "069 64443"
        },
        {
            "name": "Adare LM Clinic",
            "street": "Unit 2, Harveys Quay",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "61395410"
        },
        {
            "name": "Adare Pharmacy",
            "street": "Main Street,",
            "city": "Adare",
            "county": "Limerick",
            "phone": "061 396147"
        },
        {
            "name": "Ard Na Ri",
            "street": "Holycross,",
            "city": "Bruff",
            "county": "Limerick",
            "phone": "61382286"
        },
        {
            "name": "Ashdown Medical Centre",
            "street": "Courtbrack Avenue, South Circular road",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "061 301200"
        },
        {
            "name": "Ashdown Medical Centre",
            "street": "Courtbrack Ave,",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "061 301200"
        },
        {
            "name": "Ashdown Pharmacy (Limerick) Ltd",
            "street": "3 Ashdown centre, Ashbourne Avenue, south circular road,",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "61513125"
        },
        {
            "name": "Askeaton Medical Centre",
            "street": "The Quay, Askeaton",
            "city": "Co. Limerick",
            "county": "Limerick",
            "phone": "061-392267"
        },
        {
            "name": "Askeaton Medical Centre",
            "street": "The Quay,",
            "city": "Askeaton",
            "county": "Limerick",
            "phone": "61392267"
        },
        {
            "name": "Athea Medical Centre",
            "street": "Westbury House,",
            "city": "Athea",
            "county": "Limerick",
            "phone": "068 42271"
        },
        {
            "name": "Ballinacurra Pharmacy",
            "street": "Greenpark Shopping centre, Punches Cross",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "61313300"
        },
        {
            "name": "Ballycummin Pharmacy Ltd",
            "street": "Ballycummin Village,",
            "city": "Raheen",
            "county": "Limerick",
            "phone": "61226807"
        },
        {
            "name": "Barrington Dental",
            "street": "18 Barrington street, Centre",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "061 315 956"
        },
        {
            "name": "Beech Lodge Care Facility",
            "street": "Kilmallock Road,",
            "city": "Bruree",
            "county": "Limerick",
            "phone": "6390522"
        },
        {
            "name": "Beech Lodge Care Facility",
            "street": "Kilmallock Road,",
            "city": "Bruree",
            "county": "Limerick",
            "phone": "6390522"
        },
        {
            "name": "Beechwood House Nursing Home",
            "street": "Beechwood Gardens, Rathina",
            "city": "Newcastle West",
            "county": "Limerick",
            "phone": "069 62408"
        },
        {
            "name": "Bio Force Medical & Dental Clinic Ltd",
            "street": "1st Floor georges quay house, georges quay, 1st Floor georges quay house, georges quay",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "61598032"
        },
        {
            "name": "Blanaid Mac Curtain",
            "street": "The Paddocks, castleconnell, The Paddocks, castleconnell",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "`061 377696"
        },
        {
            "name": "Blossomgate Medical Centre",
            "street": "Emmett St,",
            "city": "Kilmallock",
            "county": "Limerick",
            "phone": "6398484"
        },
        {
            "name": "Bodyscan Ireland",
            "street": "Monoclinoe Business park, Ballysimon Road",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "894600181"
        },
        {
            "name": "Boots",
            "street": "Unit 3 Childers Retail Pk, Dublin Rd",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "061 422017"
        },
        {
            "name": "Boots Pharmacy",
            "street": "3-5 William st , Limerick",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "61416598"
        },
        {
            "name": "Bowe Dental Clinic",
            "street": "Roxboro, Limerick",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "61608186"
        },
        {
            "name": "Bridge Street Pharmacy",
            "street": "Bridge Street,",
            "city": "Abbeyfeale",
            "county": "Limerick",
            "phone": "068 30394"
        },
        {
            "name": "Bruff Pharmacy",
            "street": "Newtown, Bruff",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "61389542"
        },
        {
            "name": "Caherconlish Pharmacy",
            "street": "Main Street, Caherconlish",
            "city": "Caherconlish",
            "county": "Limerick",
            "phone": "61352988"
        },
        {
            "name": "Cahills Pharmacy",
            "street": "St. Marys road,",
            "city": "Newcastle West",
            "county": "Limerick",
            "phone": "(069) 77702"
        },
        {
            "name": "Cappamore Pharmacy",
            "street": "2 Moore street, Cappamore",
            "city": "Co Limerick",
            "county": "Limerick",
            "phone": "61381217"
        },
        {
            "name": "Castletroy Park Pharmacy",
            "street": "Unit 5 Castletroy park retail centre, Unit 5 Castletroy park retail centre",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "061 201010"
        },
        {
            "name": "Castletroy Pharmacy",
            "street": "4 University court, Castletroy",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "061 333030"
        },
        {
            "name": "Clarina Pharmacy",
            "street": "Clarina,",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "061 353892"
        },
        {
            "name": "D O Sullivan Pharmacy",
            "street": "Station Road ,",
            "city": "Newcastle West",
            "county": "Limerick",
            "phone": "6978829"
        },
        {
            "name": "Daarwood Pharmacy",
            "street": "Unit 4 Daarwood crescent, Gortboy",
            "city": "Newcastle West",
            "county": "Limerick",
            "phone": "6978200"
        },
        {
            "name": "Declan Hickey Chemist",
            "street": "1 John's square, Limerick",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "61413491"
        },
        {
            "name": "Deel Pharmacy",
            "street": "Church St,",
            "city": "Askeaton",
            "county": "Limerick",
            "phone": "061 398888"
        },
        {
            "name": "Dempsey's Allcare Pharmacy",
            "street": "47 Parnell street,",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "061-415732"
        },
        {
            "name": "Dooley'S Pharmacy",
            "street": "The Square,",
            "city": "Newcastle West",
            "county": "Limerick",
            "phone": "069 62042"
        },
        {
            "name": "Dooley's Pharmacy",
            "street": "Bishop Street, Newcastle West",
            "city": "Newcastle West",
            "county": "Limerick",
            "phone": "069 61563"
        },
        {
            "name": "Dooleys Pharmacy",
            "street": "The Square ,",
            "city": "Dromcollogher",
            "county": "Limerick",
            "phone": "063 83311"
        },
        {
            "name": "Doon Pharmacy Dac",
            "street": "Glebe,, Crecora",
            "city": "Crecora",
            "county": "Limerick",
            "phone": "61380155"
        },
        {
            "name": "Drom Pharmacy",
            "street": "The Square,",
            "city": "Dromcollogher",
            "county": "Limerick",
            "phone": "063 83941"
        },
        {
            "name": "Fogarty's Life Pharmacy",
            "street": "Sarsfield St,",
            "city": "Kilmallock",
            "county": "Limerick",
            "phone": "6398011"
        },
        {
            "name": "Foynes Pharmacy",
            "street": "Main Street,",
            "city": "Foynes",
            "county": "Limerick",
            "phone": "069 65572"
        },
        {
            "name": "Gannon's Pharmacy",
            "street": "Main Street,",
            "city": "Hospital",
            "county": "Limerick",
            "phone": "(061) 383142"
        },
        {
            "name": "Giltenanes Pharmacy",
            "street": "Main Street,",
            "city": "Rathkeale",
            "county": "Limerick",
            "phone": "6963437"
        },
        {
            "name": "Gleesons Totalhealth Pharmacy",
            "street": "Old Cratloe road, Limerick",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "61455488"
        },
        {
            "name": "Glin Allcare",
            "street": "Main St,",
            "city": "Glin",
            "county": "Limerick",
            "phone": "6834117"
        },
        {
            "name": "Goode'S Pharmacy",
            "street": "Main Street,",
            "city": "Abbeyfeale",
            "county": "Limerick",
            "phone": "068 31139"
        },
        {
            "name": "Grays Totalhealth Pharmacy",
            "street": "3 Castletroy court, Castletroy",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "61332210"
        },
        {
            "name": "Green Cross Pharmacy",
            "street": "Castle Centre,",
            "city": "Castleconnell",
            "county": "Limerick",
            "phone": "061 377733"
        },
        {
            "name": "Halley's CarePlus Pharmacy",
            "street": "Newtown Centre,",
            "city": "Annacotty",
            "county": "Limerick",
            "phone": "61338730"
        },
        {
            "name": "Halley's Careplus Pharmacy",
            "street": "Station Road,",
            "city": "Adare",
            "county": "Limerick",
            "phone": "061-395565"
        },
        {
            "name": "Hanley'S Chemist",
            "street": "20 Shannon street, Limerick",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "061 415409"
        },
        {
            "name": "Haven Pharmacy Lanes",
            "street": "32-33 Davis st, Limerick City",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "061-414330"
        },
        {
            "name": "Hogans Pharmacy",
            "street": "46 Upper william street,",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "61415195"
        },
        {
            "name": "J O'Sullivan Pharmacy Ltd",
            "street": "South Quay,",
            "city": "Newcastle West",
            "county": "Limerick",
            "phone": "6962172"
        },
        {
            "name": "Keatings CarePlus Pharmacy",
            "street": "Lord Edward street,",
            "city": "Kilmallock",
            "county": "Limerick",
            "phone": "6331515"
        },
        {
            "name": "Keatings Pharmacy",
            "street": "Crescent Court, St Nessans road",
            "city": "Dooradoyle",
            "county": "Limerick",
            "phone": "61228804"
        },
        {
            "name": "Kevin Davison Pharmacy Ltd",
            "street": "West Square,",
            "city": "Askeaton",
            "county": "Limerick",
            "phone": "(061)-392342"
        },
        {
            "name": "Lanes Haven Pharmacy",
            "street": "Lower Gerald griffin street,",
            "city": "Limerick City",
            "county": "Limerick",
            "phone": "061 415290"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Roxboro Shopping centre, Limerick",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "61418232"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Unit 16 Jetland S C,",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "061-329 508"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Grove Island S C, Corbally",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "(061)348921"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Castletroy Sc,",
            "city": "Castletroy",
            "county": "Limerick",
            "phone": "61336454"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Parkway Shopping centre,",
            "city": "Limerick City",
            "county": "Limerick",
            "phone": "61412023"
        },
        {
            "name": "Lloyds Pharmacy Thomondgate",
            "street": "1 - 3 Rices corner,, Thomondgate",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "061 329356"
        },
        {
            "name": "Mc Cormacks Pharmacy",
            "street": "Main Street, Ballylanders",
            "city": "Limerick",
            "county": "Limerick",
            "phone": "6246620"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "Unit 5 The crescent shopping centre,",
            "city": "Dooradoyle",
            "county": "Limerick",
            "phone": "61304044"
        },
        {
            "name": "ZEST PHARMACY",
            "street": "Kilmallock Business park,",
            "city": "Kilmallock",
            "county": "Limerick",
            "phone": "063 20450"
        }
    ],
    "Longford": [
        {
            "name": "Atrium",
            "street": "1 , 1 College park, longford",
            "city": "Longford",
            "county": "Longford",
            "phone": "043 33 45182"
        },
        {
            "name": "Atrium Medical Practice",
            "street": "1 College park,",
            "city": "Longford",
            "county": "Longford",
            "phone": "043 33 45182"
        },
        {
            "name": "Ballymahon Totalhealth Pharmacy",
            "street": "31 Main street,",
            "city": "Ballymahon",
            "county": "Longford",
            "phone": "090 6432151"
        },
        {
            "name": "Boots Pharmacy Longford",
            "street": "18 Ballymahon street, Longford",
            "city": "Longford",
            "county": "Longford",
            "phone": "433345841"
        },
        {
            "name": "C&D Medical Hall",
            "street": "Water St.,",
            "city": "Mohill",
            "county": "Longford",
            "phone": "071 9631050"
        },
        {
            "name": "Cara Pharmacy",
            "street": "12 Main st,",
            "city": "Longford",
            "county": "Longford",
            "phone": "433346797"
        },
        {
            "name": "Gannons Pharmacy",
            "street": "Earl St ,",
            "city": "Longford",
            "county": "Longford",
            "phone": "043 3345880"
        },
        {
            "name": "J O' Brien Pharmacy LTD",
            "street": "Main Street, Lanesboro",
            "city": "Co Longford",
            "county": "Longford",
            "phone": "433321131"
        },
        {
            "name": "Johnston's Pharmacy",
            "street": "Main Street, Lanesborough",
            "city": "Lanesborough",
            "county": "Longford",
            "phone": "433330775"
        },
        {
            "name": "Johnstons Allcare Pharmacy",
            "street": "Leader House, Teffia Park",
            "city": "Longford",
            "county": "Longford",
            "phone": "043 3345752"
        },
        {
            "name": "Johnstons Pharmacy",
            "street": "7 New street, Longford",
            "city": "Longford",
            "county": "Longford",
            "phone": "433347580"
        },
        {
            "name": "LLoyds Pharmacy",
            "street": "Longford SC,",
            "city": "Longford",
            "county": "Longford",
            "phone": "043 3345752"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Ballinalee Road,",
            "city": "Longford",
            "county": "Longford",
            "phone": "433343202"
        },
        {
            "name": "Loughrey'S Pharmacy",
            "street": "Harbour Row,",
            "city": "Longford",
            "county": "Longford",
            "phone": "433351206"
        },
        {
            "name": "Loughreys Careplus Pharmacy",
            "street": "20 Dublin st, Loughreys Pharmacy",
            "city": "Longford",
            "county": "Longford",
            "phone": "433342493"
        },
        {
            "name": "Loughreys Pharmacy Drumlish",
            "street": "Longford Rd,",
            "city": "Drumlish",
            "county": "Longford",
            "phone": "433329756"
        },
        {
            "name": "Mc Evoys Medical Hall",
            "street": "Main St,",
            "city": "Granard",
            "county": "Longford",
            "phone": "436686230"
        }
    ],
    "Louth": [
        {
            "name": "47 Medical Practice",
            "street": "47 Fair street,",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "(041)9837501"
        },
        {
            "name": "Allcare Pharmacy",
            "street": "Main Street, Carlingford",
            "city": "Co Louth",
            "county": "Louth",
            "phone": "042 9373259"
        },
        {
            "name": "Angela Kearney Family Dentistry",
            "street": "41 Fair street, 13 Park drive grange rath",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "041 9846333"
        },
        {
            "name": "ARAS MHUIRE NURSING FACILITY",
            "street": "Beechgrove, Drogheda",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "(041) 9842222"
        },
        {
            "name": "Ardee Pharmacy",
            "street": "27 Market st,",
            "city": "Ardee",
            "county": "Louth",
            "phone": "416856955"
        },
        {
            "name": "Ardmell Clinic",
            "street": "Upper Mell,",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "419848268"
        },
        {
            "name": "Aston Village Pharmacy",
            "street": "Unit 11 Aston green, Aston Village",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "419800480"
        },
        {
            "name": "Backhouse Pharmacy",
            "street": "71 Clanbrassil street,",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "042 9331336"
        },
        {
            "name": "Blackrock Abbey Nursing Home",
            "street": "Coclehill, Blackrock",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "429321258"
        },
        {
            "name": "Boots",
            "street": "St Laurences centre,",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "041 9810290"
        },
        {
            "name": "Boots Retail Ireland Lmt",
            "street": "The Marshes sc,",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "429328582"
        },
        {
            "name": "Boyne Grove Pharmacy",
            "street": "5 Ballsgrove shopping centre,",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "419837568"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "Market Street, Ardee",
            "city": "Co Louth",
            "county": "Louth",
            "phone": "041 6853236"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "Main Street, Dunleer",
            "city": "Dunleer",
            "county": "Louth",
            "phone": "041 6851219"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "Brand Store, Main Street",
            "city": "Blackrock",
            "county": "Louth",
            "phone": "042 9323083"
        },
        {
            "name": "BRIAN MC QUILLAN LIMITED",
            "street": "Mc Quillans pharmacy, Mc Quillans pharmacy",
            "city": "Blackrock",
            "county": "Louth",
            "phone": "429322605"
        },
        {
            "name": "Byrne\u2019S Late Night Pharmacy",
            "street": "1-3 Church street,",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "429334214"
        },
        {
            "name": "Castletown Pharmacy",
            "street": "133-135 Castletown road,",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "429353992"
        },
        {
            "name": "Cogaslann Pharmacy",
            "street": "Clanbrassil Street, Dundalk",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "429337288"
        },
        {
            "name": "Collon Pharmacy",
            "street": "Drogheda Street,",
            "city": "Collon",
            "county": "Louth",
            "phone": "419819861"
        },
        {
            "name": "Connollys Pharmacy",
            "street": "Greenacres Shopping centre, Avenue Road",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "429337370"
        },
        {
            "name": "Corr's Pharmacy",
            "street": "82 Main street,",
            "city": "Clogherhead",
            "county": "Louth",
            "phone": "419889954"
        },
        {
            "name": "Cottage Pharmacy",
            "street": "Scarlet St,",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "419810100"
        },
        {
            "name": "Donal Mc Goey Pharmacy",
            "street": "8 John street,",
            "city": "Ardee",
            "county": "Louth",
            "phone": "416871493"
        },
        {
            "name": "Donal McGoey Pharmacy",
            "street": "Market Street, Ardee",
            "city": "Ardee",
            "county": "Louth",
            "phone": "041 68 5322"
        },
        {
            "name": "DONAL MCGOEY PHARMACY",
            "street": "Main Street,",
            "city": "Dunleer",
            "county": "Louth",
            "phone": "416863871"
        },
        {
            "name": "Dromiskin Pharmacy",
            "street": "Chapel Road ,",
            "city": "Dromiskin",
            "county": "Louth",
            "phone": "042 9382599"
        },
        {
            "name": "Fair Street Pharmacy",
            "street": "29 Fair street,",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "419873998"
        },
        {
            "name": "First Choice Pharmacy",
            "street": "In-store Tesco, Matthews Lane, donore road",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "419894554"
        },
        {
            "name": "Haughey's Pharmacy",
            "street": "Unit 2/3 Demsne sc, Dundalk",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "429334933"
        },
        {
            "name": "Haven Pharmacy Grennan's",
            "street": "40 Dublin Street,",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "429330136"
        },
        {
            "name": "Healy's Pharmacy",
            "street": "Rathmullen Road,",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "419846477"
        },
        {
            "name": "Herlihy's Chemist",
            "street": "Crushrod Ave,",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "419838101"
        },
        {
            "name": "Hickey's Pharmacy",
            "street": "Hickeys Drogheda, Wheaton Hall,",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "419846211"
        },
        {
            "name": "JENKINSTOWN PHARMACY",
            "street": "Jenkinstown,",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "429380087"
        },
        {
            "name": "Kelly's Pharmacy",
            "street": "Unit 2b, College Heights, hoeys lane",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "429320747"
        },
        {
            "name": "Kevin Matthews Pharmacy",
            "street": "37 Park street,",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "(042) 9334246"
        },
        {
            "name": "Leavys Pharmacy",
            "street": "94 Clanbrassil st,",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "429331560"
        },
        {
            "name": "Louth Village Pharmacy",
            "street": "Louth Village,",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "429384473"
        },
        {
            "name": "Magee's Pharmacy",
            "street": "15 Earl street,",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "429334231"
        },
        {
            "name": "Mahers Totalhealth Chemist",
            "street": "105 West st ,",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "041 9838645"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "Adelphi Court, Longwalk",
            "city": "Dundalk",
            "county": "Louth",
            "phone": "042 9352053"
        },
        {
            "name": "McCartans Pharmacy",
            "street": "Scotchhall Shopping centre,",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "419844112"
        },
        {
            "name": "Our Lady Of Lourdes Hospital",
            "street": "Windmill Rd, Pharmacy Department,our lady of lourdes hospital",
            "city": "Drogheda",
            "county": "Louth",
            "phone": "419874663"
        }
    ],
    "Mayo": [
        {
            "name": "AbbeyBreaffy Nursing Home Ltd",
            "street": "N5 Dublin road, Castlebar",
            "city": "Mayo",
            "county": "Mayo",
            "phone": "(094) 9025029"
        },
        {
            "name": "Achill Doctors",
            "street": "Achill,",
            "city": "Achill",
            "county": "Mayo",
            "phone": "(098) 45231"
        },
        {
            "name": "Aran Health",
            "street": "Silverbridge Shopping centre, Kilcolman Road,",
            "city": "Claremorris",
            "county": "Mayo",
            "phone": "949377551"
        },
        {
            "name": "Atlantic Medical Centre",
            "street": "Emmet St,",
            "city": "Ballina",
            "county": "Mayo",
            "phone": "9693706"
        },
        {
            "name": "Ave Maria",
            "street": "Tooreen , Balyhaunis",
            "city": "Co Mayo",
            "county": "Mayo",
            "phone": "094 96 39999"
        },
        {
            "name": "BALLA MEDICAL CENTRE",
            "street": "Medical Centre, Station Road",
            "city": "Balla",
            "county": "Mayo",
            "phone": "(094) 9365146"
        },
        {
            "name": "Ballina Medical Centre",
            "street": "Kevin Barry street,",
            "city": "Ballina",
            "county": "Mayo",
            "phone": "096 22868"
        },
        {
            "name": "Ballina Pharmacy Ltd",
            "street": "Unit 7, Ballina Shopping centre",
            "city": "Ballina",
            "county": "Mayo",
            "phone": "9670116"
        },
        {
            "name": "Ballinamore House Nursing Home",
            "street": "Ballinamore, Kiltimagh",
            "city": "Kiltimagh",
            "county": "Mayo",
            "phone": "949381919"
        },
        {
            "name": "Belmullet Pharmacy (Erris Pharmacy)",
            "street": "Church Road,",
            "city": "Belmullet Town",
            "county": "Mayo",
            "phone": "9720540"
        },
        {
            "name": "Bernard Twomey Dental",
            "street": "Unit 4 Bury central, bury st, Unit 4 Bury central, bury st",
            "city": "Ballina",
            "county": "Mayo",
            "phone": "096 56058"
        },
        {
            "name": "Blackrocks Nursing Home",
            "street": "The Green,",
            "city": "Foxford",
            "county": "Mayo",
            "phone": "949257555"
        },
        {
            "name": "Body Balance Physical Therapy",
            "street": "Westport Leisure park, James Street",
            "city": "Westport",
            "county": "Mayo",
            "phone": "861557443"
        },
        {
            "name": "Boots",
            "street": "3 Silverbridge plaza, Kilcolman Road",
            "city": "Claremorris",
            "county": "Mayo",
            "phone": "949372607"
        },
        {
            "name": "Boots",
            "street": "21 Pearse street,",
            "city": "Ballina",
            "county": "Mayo",
            "phone": "096 75602"
        },
        {
            "name": "Boots Pharmacy",
            "street": "Harlequin Centre, Lough Lannagh",
            "city": "Castlebar",
            "county": "Mayo",
            "phone": "094 9060823"
        },
        {
            "name": "Boots Pharmacy",
            "street": "Harlequin Centre, Lough Lannagh",
            "city": "Castlebar",
            "county": "Mayo",
            "phone": "094 9060823"
        },
        {
            "name": "Boots Westport",
            "street": "Units3/4 Westpoint cenre,",
            "city": "Westport",
            "county": "Mayo",
            "phone": "9856774"
        },
        {
            "name": "Bridge Street Pharmacy",
            "street": "Bridge Street, Castlebar",
            "city": "Castlebar",
            "county": "Mayo",
            "phone": "949067056"
        },
        {
            "name": "Byrne'S Pharmacy",
            "street": "Main Street,",
            "city": "Kiltimagh",
            "county": "Mayo",
            "phone": "3.53949E+11"
        },
        {
            "name": "Colleran'S Pharmacy",
            "street": "The Square,",
            "city": "Charlestown",
            "county": "Mayo",
            "phone": "094-9254317"
        },
        {
            "name": "COLLERANS PHARMACY",
            "street": "Bridge St,",
            "city": "Ballyhaunis",
            "county": "Mayo",
            "phone": "949630028"
        },
        {
            "name": "Cong Pharmacy",
            "street": "Abbey Street,",
            "city": "Mayo",
            "county": "Mayo",
            "phone": "949546119"
        },
        {
            "name": "Curleys Totalhealth Pharmacy",
            "street": "Main Street,",
            "city": "Ballyhaunis",
            "county": "Mayo",
            "phone": "(094) 9630110"
        },
        {
            "name": "Doherty'S Pharmacy",
            "street": "High Street, Westport",
            "city": "Westport",
            "county": "Mayo",
            "phone": "9825003"
        },
        {
            "name": "Duffy's Pharmacy",
            "street": "Upper Main street ,",
            "city": "Ballyhaunis",
            "county": "Mayo",
            "phone": "949630766"
        },
        {
            "name": "Flynn'S Pharmacy",
            "street": "The Square,",
            "city": "Claremorris",
            "county": "Mayo",
            "phone": "949362780"
        },
        {
            "name": "Foodys Pharmacy",
            "street": "Market Square,",
            "city": "Ballina",
            "county": "Mayo",
            "phone": "9677998"
        },
        {
            "name": "Foxford Pharmacy",
            "street": "Admiral House, Cashel",
            "city": "Foxford",
            "county": "Mayo",
            "phone": "949256125"
        },
        {
            "name": "Goldens Pharmacy",
            "street": "Bridge Street, Bridge Street",
            "city": "Westport",
            "county": "Mayo",
            "phone": "9828011"
        },
        {
            "name": "HARRISON PHARMACY",
            "street": "Cq Centre, Kevin Barry st",
            "city": "Ballina",
            "county": "Mayo",
            "phone": "096 60488"
        },
        {
            "name": "Haven Pharmacy Davey'S",
            "street": "Ballyhaunis Road,",
            "city": "Claremorris",
            "county": "Mayo",
            "phone": "949371716"
        },
        {
            "name": "HealthWest Community Pharmacy",
            "street": "Healthwest Community pharmacy, Lugalisheen",
            "city": "Ballindine, Claremorris, Co. Mayo",
            "county": "Mayo",
            "phone": "949364712"
        },
        {
            "name": "Heaneys Pharmacy",
            "street": "Bridge St, Westport",
            "city": "Westport",
            "county": "Mayo",
            "phone": "9828200"
        },
        {
            "name": "Heneghans Pharmacy",
            "street": "Main Street,",
            "city": "Kiltimagh",
            "county": "Mayo",
            "phone": "949382133"
        },
        {
            "name": "Hennigan\u2019S Pharmacy",
            "street": "6, Teeling St",
            "city": "Ballina",
            "county": "Mayo",
            "phone": "9622680"
        },
        {
            "name": "Joanne Hynes Pharmacy LTD",
            "street": "Cornmarket,",
            "city": "Ballinrobe",
            "county": "Mayo",
            "phone": "094 9542088"
        },
        {
            "name": "John O'Donnell'S Pharmacy",
            "street": "Ellison St.,,",
            "city": "Castlebar",
            "county": "Mayo",
            "phone": "949024524"
        },
        {
            "name": "Kilroy's Careplus Pharmacy",
            "street": "Emmet Street,",
            "city": "Ballina",
            "county": "Mayo",
            "phone": "9656000"
        },
        {
            "name": "Lally's Pharmacy",
            "street": "Unit 1 Mill house, Mill St",
            "city": "Westport",
            "county": "Mayo",
            "phone": "9825544"
        },
        {
            "name": "Lavelles",
            "street": "Chapel Lane, Bangor Erris",
            "city": "Bangor Erris",
            "county": "Mayo",
            "phone": "9783911"
        },
        {
            "name": "Life Pharmacy Balla",
            "street": "Balla Medical centre,",
            "city": "Balla",
            "county": "Mayo",
            "phone": "949365390"
        },
        {
            "name": "Life Pharmacy Kilkelly",
            "street": "Main St,",
            "city": "Kilkelly",
            "county": "Mayo",
            "phone": "949367010"
        },
        {
            "name": "Life,Knock",
            "street": "Main Street, Knock",
            "city": "Knock",
            "county": "Mayo",
            "phone": "949376968"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "The Square,",
            "city": "Claremorris",
            "county": "Mayo",
            "phone": "949371287"
        },
        {
            "name": "MacAuliffes Pharmacy",
            "street": "Station Road,",
            "city": "Castlebar",
            "county": "Mayo",
            "phone": "949025995"
        },
        {
            "name": "Molloys Lifestyle Pharmacy",
            "street": "Davitt Quarter, Achill Sound",
            "city": "Achill",
            "county": "Mayo",
            "phone": "098 45248"
        },
        {
            "name": "The Mullagh",
            "street": "Pollagh,",
            "city": "Achill",
            "county": "Mayo",
            "phone": "9843105"
        }
    ],
    "Meath": [
        {
            "name": "Abbey House Medical Centre",
            "street": "Abbey Road,",
            "city": "Navan",
            "county": "Meath",
            "phone": "046 9051500"
        },
        {
            "name": "Abbey House Medical Centre Admin",
            "street": "Abbey Road,",
            "city": "Navan",
            "county": "Meath",
            "phone": "469051500"
        },
        {
            "name": "Abbey House Medical Centre Admin",
            "street": "Abbey Road,",
            "city": "",
            "county": "Meath",
            "phone": "469051500"
        },
        {
            "name": "Abbey Pharmacy",
            "street": "Unit 1 Navan Medical Centre, Abbey Road",
            "city": "Navan",
            "county": "Meath",
            "phone": "469093374"
        },
        {
            "name": "Adrian Dunne Pharmacy",
            "street": "Market Street,",
            "city": "Trim",
            "county": "Meath",
            "phone": "469436600"
        },
        {
            "name": "Adrian Dunne Pharmacy",
            "street": "Unit 11, Tesco S.C",
            "city": "Ashbourne",
            "county": "Meath",
            "phone": "18010336"
        },
        {
            "name": "An Fiacl\u00f3ir Deirdre",
            "street": "Athboy Medical centre,",
            "city": "Athboy",
            "county": "Meath",
            "phone": "469428872"
        },
        {
            "name": "Ashbourne Clinic, Centric Health",
            "street": "Unit 6 Ashbourne retail park,",
            "city": "Ashbourne",
            "county": "Meath",
            "phone": "01 8351444"
        },
        {
            "name": "Ashbourne Family Practice",
            "street": "Killegland Walk,",
            "city": "Ashbourne",
            "county": "Meath",
            "phone": "(01) 8352244"
        },
        {
            "name": "Ashbourne Medical Centre",
            "street": "First Floor unit 11, New Town centre",
            "city": "Ashbourne",
            "county": "Meath",
            "phone": "18352080"
        },
        {
            "name": "Ashbourne Medical Centre",
            "street": "First Floor unit 11, New Town centre",
            "city": "Ashbourne",
            "county": "Meath",
            "phone": "18352080"
        },
        {
            "name": "Athboy Family Practice",
            "street": "Main Street,",
            "city": "Athboy",
            "county": "Meath",
            "phone": "469430098"
        },
        {
            "name": "Bedford Medical Centre",
            "street": "Convent Rd, Athlumney",
            "city": "Navan",
            "county": "Meath",
            "phone": "+353879728793"
        },
        {
            "name": "Bennett Optical Ltd",
            "street": "10a Johnstown shopping centre, Johnstown",
            "city": "Navan",
            "county": "Meath",
            "phone": "469091776"
        },
        {
            "name": "Bettystown Physiotherapy",
            "street": "24 The glade, Whitefield Hall",
            "city": "Bettystown",
            "county": "Meath",
            "phone": "868152352"
        },
        {
            "name": "Boots Ashbourne",
            "street": "Unit 2b, Ashbourne town centre,",
            "city": "Ashbourne",
            "county": "Meath",
            "phone": "01 8352972"
        },
        {
            "name": "Boots Navan",
            "street": "Navan Shopping centre, Navan",
            "city": "Navan",
            "county": "Meath",
            "phone": "469059801"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "Knightsbridge Nursing home, Longwood Road",
            "city": "Trim",
            "county": "Meath",
            "phone": "046 9436585"
        },
        {
            "name": "Breens Allcare Pharmacy",
            "street": "Main Street,",
            "city": "Slane",
            "county": "Meath",
            "phone": "419824222"
        },
        {
            "name": "Burke'S Pharmacy LTD",
            "street": "Eastham Raod,",
            "city": "Bettystown",
            "county": "Meath",
            "phone": "041 981 3415"
        },
        {
            "name": "Chemist Warehouse",
            "street": "Unit 3 Blackwater retail park, Kells Road",
            "city": "Navan",
            "county": "Meath",
            "phone": "469015721"
        },
        {
            "name": "Chemist Warehouse",
            "street": "Unit 1 Ashbourne retail park , Ballybin Road",
            "city": "Ashbourne",
            "county": "Meath",
            "phone": "(01)5828506"
        },
        {
            "name": "Christine'S Pharmacy",
            "street": "33 Brews hill, Navan",
            "city": "Navan",
            "county": "Meath",
            "phone": "469063265"
        },
        {
            "name": "Clonee Pharmacy",
            "street": "Main Street,",
            "city": "Clonee",
            "county": "Meath",
            "phone": "18253019"
        },
        {
            "name": "Commons Road Pharmacy",
            "street": "Commons Road,",
            "city": "Navan",
            "county": "Meath",
            "phone": "469059428"
        },
        {
            "name": "Conaty's CarePlus Pharmacy",
            "street": "Unit 4 Supervalu complex, Navan Rd",
            "city": "Dunboyne",
            "county": "Meath",
            "phone": "16910288"
        },
        {
            "name": "Conatys CarePlus",
            "street": "Unit 1 Lidl shopping centre, Main St",
            "city": "Dunshaughlin",
            "county": "Meath",
            "phone": "8024747"
        },
        {
            "name": "Donal McGoey Pharmacy",
            "street": "Main St, Drumconrath",
            "city": "Drumconrath",
            "county": "Meath",
            "phone": "416854799"
        },
        {
            "name": "Farrell'S Pharmacy",
            "street": "Finnegan's Way,",
            "city": "Trim",
            "county": "Meath",
            "phone": "469484285"
        },
        {
            "name": "FARRELLS PHARMACY BALLIVOR LTD",
            "street": "Main Street,",
            "city": "Ballivor",
            "county": "Meath",
            "phone": "469567940"
        },
        {
            "name": "Farrells Pharmacy Longwood Ltd",
            "street": "The Health centre,",
            "city": "Longwood",
            "county": "Meath",
            "phone": "046 9560864"
        },
        {
            "name": "Gormley Pharmacy",
            "street": "Kells Shopping centre, Circular Road",
            "city": "Kells",
            "county": "Meath",
            "phone": "469240950"
        },
        {
            "name": "Haven Pharmacy Duleek",
            "street": "Main St,",
            "city": "Duleek",
            "county": "Meath",
            "phone": "(041)9823326"
        },
        {
            "name": "Haven Pharmacy Kavanaghs",
            "street": "The Gables shopping centre,",
            "city": "Dunshaughlin",
            "county": "Meath",
            "phone": "18259801"
        },
        {
            "name": "Headfort Medical Hall",
            "street": "Church Street kells, Kells",
            "city": "Kells,",
            "county": "Meath",
            "phone": "469240714"
        },
        {
            "name": "Hickey's Pharmacy",
            "street": "Hickeys Navan, Watergate St,",
            "city": "Navan",
            "county": "Meath",
            "phone": "469021126"
        },
        {
            "name": "Hickey's Pharmacy",
            "street": "Unit 6 Johnstown S C,",
            "city": "Navan",
            "county": "Meath",
            "phone": "469091177"
        },
        {
            "name": "Hickeys Pharmacy Navan SC",
            "street": "Hickeys",
            "city": "Navan SC,",
            "county": "Meath",
            "phone": "046 9071520"
        },
        {
            "name": "Keane's CarePLus Pharmacy",
            "street": "Unit 1, Johnstown Road",
            "city": "Enfield",
            "county": "Meath",
            "phone": "469542677"
        },
        {
            "name": "Kenlis Pharmacy",
            "street": "Cannon Street, Kells",
            "city": "Kells",
            "county": "Meath",
            "phone": "469247944"
        },
        {
            "name": "Lilly'S Pharmacy",
            "street": "Unit 5, Corballis s.c, Ratoath",
            "city": "Ratoath",
            "county": "Meath",
            "phone": "16896819"
        },
        {
            "name": "Lynch'S Pharmacy",
            "street": "Oliver Plunkett street,",
            "city": "Oldcastle",
            "county": "Meath",
            "phone": "498541750"
        },
        {
            "name": "Lynchs Pharmacy",
            "street": "Farrell Street,",
            "city": "Kells",
            "county": "Meath",
            "phone": "046 92 40515"
        },
        {
            "name": "Martins Pharmacy",
            "street": "Main Street,",
            "city": "Athboy",
            "county": "Meath",
            "phone": "469487629"
        },
        {
            "name": "Mc Granes Pharmacy",
            "street": "Unit 1 , Patrick Street",
            "city": "Trim",
            "county": "Meath",
            "phone": "(046) 9483756"
        },
        {
            "name": "Mc Nallys Pharmacy",
            "street": "Main Street,",
            "city": "Moynalty",
            "county": "Meath",
            "phone": "469244691"
        }
    ],
    "Monaghan": [
        {
            "name": "Avenue Pharmacy Clones",
            "street": "Jubilee Road,",
            "city": "Clones",
            "county": "Monaghan",
            "phone": "4752599"
        },
        {
            "name": "Ballybay Pharmacy",
            "street": "54-55 Main street,",
            "city": "Ballybay",
            "county": "Monaghan",
            "phone": "429741033"
        },
        {
            "name": "Blacks Allcare Pharmacy",
            "street": "24 Mill street, Church Square",
            "city": "Monaghan",
            "county": "Monaghan",
            "phone": "047 82258"
        },
        {
            "name": "Boots Pharmacy",
            "street": "15/16 Monaghan shopping centre,",
            "city": "Monaghan",
            "county": "Monaghan",
            "phone": "047 71635"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "Main Street, Carrickmacross",
            "city": "Co Monaghan",
            "county": "Monaghan",
            "phone": "042 9663421"
        },
        {
            "name": "Care Pharmacy",
            "street": "51 Main street , Ballybay",
            "city": "Ballybay",
            "county": "Monaghan",
            "phone": "429755111"
        },
        {
            "name": "Carrick Pharmacy",
            "street": "Main Street,",
            "city": "Carrickmacross",
            "county": "Monaghan",
            "phone": "042 9692552"
        },
        {
            "name": "Connolly Chemist",
            "street": "Church Square, Monaghan",
            "city": "Monaghan",
            "county": "Monaghan",
            "phone": "047-71960"
        },
        {
            "name": "Coyles Pharmacy",
            "street": "Main St,",
            "city": "Castleblayney",
            "county": "Monaghan",
            "phone": "429740094"
        },
        {
            "name": "Dolan'S Pharmacy",
            "street": "90 Glaslough st,",
            "city": "Monaghan",
            "county": "Monaghan",
            "phone": "4781741"
        },
        {
            "name": "Eakins Pharmacy",
            "street": "21 Main street,,",
            "city": "Carrickmacross",
            "county": "Monaghan",
            "phone": "429661245"
        },
        {
            "name": "Health 1st Pharmacy",
            "street": "7/8 Church square, 132 Mullaghmore road",
            "city": "Monaghan",
            "county": "Monaghan",
            "phone": "4782013"
        },
        {
            "name": "Hickeys Pharmacy",
            "street": "The Diamond,",
            "city": "Clones",
            "county": "Monaghan",
            "phone": "4751032"
        },
        {
            "name": "Leavys Pharmacy",
            "street": "West Street,",
            "city": "Castleblayney",
            "county": "Monaghan",
            "phone": "429740005"
        },
        {
            "name": "Mc Daids Pharmacy",
            "street": "Lower Fermanagh street,",
            "city": "Clones",
            "county": "Monaghan",
            "phone": "4751094"
        }
    ],
    "Offaly": [
        {
            "name": "Acebracesd",
            "street": "Clonminch House, Clonminch Hi tech park",
            "city": "Tullamore",
            "county": "Offaly",
            "phone": "579352105"
        },
        {
            "name": "Adam's Pharmacy",
            "street": "T/a Adams pharmacy, Bridge St",
            "city": "Tullamore",
            "county": "Offaly",
            "phone": "579321114"
        },
        {
            "name": "Banagher",
            "street": "Health Centre, Banagher",
            "city": "Birr",
            "county": "Offaly",
            "phone": "057 9151247"
        },
        {
            "name": "Banagher Totalhealth Pharmacy",
            "street": "Upper Main st, Banagher",
            "city": "Birr",
            "county": "Offaly",
            "phone": "579152022"
        },
        {
            "name": "Boots",
            "street": "1 Church street,",
            "city": "Tullamore",
            "county": "Offaly",
            "phone": "579327883"
        },
        {
            "name": "Calldoc",
            "street": "18 Behan house, Arden Road",
            "city": "Tullamore",
            "county": "Offaly",
            "phone": "863849264"
        },
        {
            "name": "CGH Allcare Pharmacy",
            "street": "Unit 1/2 Banagher town centre, Muckenagh",
            "city": "Banagher",
            "county": "Offaly",
            "phone": "579151608"
        },
        {
            "name": "Clonminch Pharmacy",
            "street": "Clonminch Road, Clonminch Road",
            "city": "Tullamore",
            "county": "Offaly",
            "phone": "579324822"
        },
        {
            "name": "Dolans Pharmacy",
            "street": "5, William St",
            "city": "Tullamore",
            "county": "Offaly",
            "phone": "579321526"
        },
        {
            "name": "Dolans Pharmacy",
            "street": "9/10, The Bridge center",
            "city": "Tullamore",
            "county": "Offaly",
            "phone": "57322505"
        },
        {
            "name": "Haven Pharmacy Butlers",
            "street": "Main St,",
            "city": "Birr",
            "county": "Offaly",
            "phone": "579120189"
        },
        {
            "name": "Haven Pharmacy Fahey's",
            "street": "Patrick Street,",
            "city": "Tullamore",
            "county": "Offaly",
            "phone": "057 9321540"
        },
        {
            "name": "Justin Daly Pharmacy",
            "street": "The Medical Hall, Main Street",
            "city": "Ferbane",
            "county": "Offaly",
            "phone": "906454321"
        },
        {
            "name": "Keane's CarePlus",
            "street": "Mangan's Filling station, Dublin Road",
            "city": "Edenderry",
            "county": "Offaly",
            "phone": "046 97 73758"
        },
        {
            "name": "Martyn's Totalhealth Pharmacy",
            "street": "Main Street,",
            "city": "Kilcormac",
            "county": "Offaly",
            "phone": "579135020"
        }
    ],
    "Roscommon": [
        {
            "name": "Abbey Haven Care Centre & Nursing Home",
            "street": "Carrick Road, Abbey Haven care centre & nursing home",
            "city": "Boyle",
            "county": "Roscommon",
            "phone": "719670111"
        },
        {
            "name": "Abbey Haven Care Centre & Nursing Home",
            "street": "Carrick Road, Abbey Haven care centre & nursing home",
            "city": "Boyle",
            "county": "Roscommon",
            "phone": "719670111"
        },
        {
            "name": "Abbey Medical Boyle",
            "street": "Abbeytown, Loftus Medical centre",
            "city": "Boyle",
            "county": "Roscommon",
            "phone": "071 9662230"
        },
        {
            "name": "Abbey St Medical Centre",
            "street": "Abbey St,",
            "city": "Roscommon",
            "county": "Roscommon",
            "phone": "090 6625650"
        },
        {
            "name": "Advanced Physio West",
            "street": "Crubyhill, Galway Road",
            "city": "Roscommon",
            "county": "Roscommon",
            "phone": "863758169"
        },
        {
            "name": "Alexandra Dental Care",
            "street": "., The Square",
            "city": "Roscommon",
            "county": "Roscommon",
            "phone": "906626475"
        },
        {
            "name": "Boots",
            "street": "9 Main street, Roscommon Town",
            "city": "Roscommon",
            "county": "Roscommon",
            "phone": "906665606"
        },
        {
            "name": "Brogans Chemco",
            "street": "Shop,",
            "city": "Boyle",
            "county": "Roscommon",
            "phone": "71962044"
        },
        {
            "name": "Chemco Pharmacy",
            "street": "The Medical centre, St Comans park",
            "city": "Roscommon",
            "county": "Roscommon",
            "phone": "090 6665880"
        },
        {
            "name": "Conlons",
            "street": "Athleague ,",
            "city": "Athleague",
            "county": "Roscommon",
            "phone": "90663867"
        },
        {
            "name": "CUNNINGHAMS PHARMACY",
            "street": "Monksland,",
            "city": "Athlone",
            "county": "Roscommon",
            "phone": "906490242"
        },
        {
            "name": "Elphin Pharmacy",
            "street": "Main Street, Elphin",
            "city": "Elphin",
            "county": "Roscommon",
            "phone": "719635137"
        },
        {
            "name": "Hynes Pharmacy",
            "street": "Castle Street,",
            "city": "Roscommon Town",
            "county": "Roscommon",
            "phone": "906634147"
        },
        {
            "name": "Janet Dillon Pharmacy",
            "street": "Unit 10 Carrick retail park,",
            "city": "Carrick On shannon",
            "county": "Roscommon",
            "phone": "719627775"
        },
        {
            "name": "Johnstons Allcare Pharmacy",
            "street": "Barrack Street,",
            "city": "Castlerea",
            "county": "Roscommon",
            "phone": "949620803"
        },
        {
            "name": "Kearney Chemist",
            "street": "Main Street,",
            "city": "Castlerea",
            "county": "Roscommon",
            "phone": "949620055"
        },
        {
            "name": "Mac Auliffe'S Pharmacy",
            "street": "Church St,",
            "city": "Strokestown",
            "county": "Roscommon",
            "phone": "719633107"
        },
        {
            "name": "MC DONNELLS PHARMACY",
            "street": "Bridge St, Bridge St",
            "city": "Strokestown",
            "county": "Roscommon",
            "phone": "719633195"
        },
        {
            "name": "Molloys Lifestyle Pharmacy",
            "street": "New Street,",
            "city": "Ballaghaderreen",
            "county": "Roscommon",
            "phone": "949877520"
        },
        {
            "name": "Physiotherapy",
            "street": "Castlerea,",
            "city": "Castlerea",
            "county": "Roscommon",
            "phone": "830655886"
        }
    ],
    "Sligo": [
        {
            "name": "Atlantic Dental Care",
            "street": "Unit 2 Airport business park, Airport Road",
            "city": "Strandhill",
            "county": "Sligo",
            "phone": "719168670"
        },
        {
            "name": "Ballisodare Pharmacy",
            "street": "Ballisodare,",
            "city": "Sligo",
            "county": "Sligo",
            "phone": "719133033"
        },
        {
            "name": "Ballymote Pharmacy",
            "street": "Lord Edward street,",
            "city": "Ballymote",
            "county": "Sligo",
            "phone": "071 9183320"
        },
        {
            "name": "Banada Surgery",
            "street": "Banada, Tourlestrane",
            "city": "Tubbercurry",
            "county": "Sligo",
            "phone": "719181136"
        },
        {
            "name": "Barry's Pharmacy",
            "street": "Main St,",
            "city": "Tubbercurry",
            "county": "Sligo",
            "phone": "719185021"
        },
        {
            "name": "Boots",
            "street": "10-12 Johnston court,",
            "city": "Sligo",
            "county": "Sligo",
            "phone": "719149582"
        },
        {
            "name": "Brett'S Pharmacy",
            "street": "Teeling St, Teeling St",
            "city": "Tubbercurry",
            "county": "Sligo",
            "phone": "179140130"
        },
        {
            "name": "Burke's Life Pharmacy",
            "street": "Wine St, Sligo Town",
            "city": "Sligo Town",
            "county": "Sligo",
            "phone": "+353719142313"
        },
        {
            "name": "Cara Pharmacy",
            "street": "Wine Street,",
            "city": "Sligo",
            "county": "Sligo",
            "phone": "071 914 2795"
        },
        {
            "name": "Caseys Pharmacy",
            "street": "Teeling St,",
            "city": "Ballymote",
            "county": "Sligo",
            "phone": "719183370"
        },
        {
            "name": "CHEMCO PHARMACY",
            "street": "Aldi Shopping centre , Cranmore Rd",
            "city": "Sligo",
            "county": "Sligo",
            "phone": "719149930"
        },
        {
            "name": "Currids Totalhealth Pharmacy",
            "street": "Lord Edward street,",
            "city": "Ballymote",
            "county": "Sligo",
            "phone": "719197084"
        },
        {
            "name": "Dromore West Pharmacy",
            "street": "Main St, Tullysleva",
            "city": "Dromore West",
            "county": "Sligo",
            "phone": "(096)47048"
        },
        {
            "name": "Enda Horan",
            "street": "1 Castle street, Sligo",
            "city": "Sligo",
            "county": "Sligo",
            "phone": "719142560"
        },
        {
            "name": "ENDA LANNON",
            "street": "Rathmadder,",
            "city": "Gurteen",
            "county": "Sligo",
            "phone": "719182940"
        },
        {
            "name": "Enniscrone Pharmacy",
            "street": "Main Street, Enniscrone",
            "city": "Enniscrone",
            "county": "Sligo",
            "phone": "9636568"
        },
        {
            "name": "Grange Pharmacy",
            "street": "Grange,",
            "city": "Sligo",
            "county": "Sligo",
            "phone": "071 9173838"
        },
        {
            "name": "Healthwise Pharmacy Sligo",
            "street": "Connaughton Rd,",
            "city": "Sligo",
            "county": "Sligo",
            "phone": "719138016"
        },
        {
            "name": "Higgins Pharmacy",
            "street": "Teeling Street,",
            "city": "Sligo",
            "county": "Sligo",
            "phone": "719142276"
        },
        {
            "name": "Higgins Pharmacy",
            "street": "Market Cross, Sligo Town",
            "city": "Sligo",
            "county": "Sligo",
            "phone": "71942396"
        },
        {
            "name": "Lannon Late Night Pharmacy",
            "street": "Pearse Road, Co/ Cannongs spar",
            "city": "Sligo",
            "county": "Sligo",
            "phone": "719171333"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Main Street,",
            "city": "Collooney",
            "county": "Sligo",
            "phone": "719167117"
        },
        {
            "name": "Markievicz Pharmacy",
            "street": "Holborn Hill,",
            "city": "Sligo",
            "county": "Sligo",
            "phone": "719143702"
        }
    ],
    "Tipperary": [
        {
            "name": "Acorn Lodge",
            "street": "Ballykelly,",
            "city": "Cashel",
            "county": "Tipperary",
            "phone": "062-64244"
        },
        {
            "name": "Anna Kelly Chemist",
            "street": "Martyrs Road,",
            "city": "Nenagh",
            "county": "Tipperary",
            "phone": "6734244"
        },
        {
            "name": "Ardeen Nursing Home",
            "street": "Abbey Road, Abbey Road",
            "city": "Thurles",
            "county": "Tipperary",
            "phone": "50422094"
        },
        {
            "name": "Ardfinnan Careplus Pharmacy",
            "street": "Main Street,",
            "city": "Ardfinnan",
            "county": "Tipperary",
            "phone": "6288445"
        },
        {
            "name": "Ashlawn House Nursing Home",
            "street": "Carrigatoher, Ballinderry",
            "city": "Nenagh",
            "county": "Tipperary",
            "phone": "067 31433"
        },
        {
            "name": "Ballingarry Health Centre",
            "street": "Main Street, Ballingarry",
            "city": "Thurles",
            "county": "Tipperary",
            "phone": "052 9154208"
        },
        {
            "name": "Boots Pharmacy",
            "street": "5/6 Gladstone street,",
            "city": "Clonmel",
            "county": "Tipperary",
            "phone": "526183170"
        },
        {
            "name": "Boots Thurles",
            "street": "26-29 Thurles shopping centre, Thurles",
            "city": "Thurles",
            "county": "Tipperary",
            "phone": "50424594"
        },
        {
            "name": "Bowe Dental Clinic",
            "street": "Cudville, Nenagh",
            "city": "Nenagh",
            "county": "Tipperary",
            "phone": "6732111"
        },
        {
            "name": "Clare St Pharmacy",
            "street": "Clare St,",
            "city": "Nenagh",
            "county": "Tipperary",
            "phone": "6742775"
        },
        {
            "name": "Cloughjordan Totalhealth Pharmacy",
            "street": "Main Street,",
            "city": "Cloughjordan",
            "county": "Tipperary",
            "phone": "(0505) 42511"
        },
        {
            "name": "Coffey'S Allcare Pharmacy",
            "street": "88 Castle st,",
            "city": "Roscrea",
            "county": "Tipperary",
            "phone": "50521652"
        },
        {
            "name": "Coghlan's CarePlus",
            "street": "99 Main street,",
            "city": "Carrick On suir",
            "county": "Tipperary",
            "phone": "51640040"
        },
        {
            "name": "Collins Pharmacy",
            "street": "Main Street,",
            "city": "Ballina",
            "county": "Tipperary",
            "phone": "61375505"
        },
        {
            "name": "Costigan's Pharmacy Kyle",
            "street": "3 Kylecourt, Blind St",
            "city": "Tipperary Town",
            "county": "Tipperary",
            "phone": "(062)31530"
        },
        {
            "name": "Daltons Pharmacy",
            "street": "Barrack Street,",
            "city": "Fethard",
            "county": "Tipperary",
            "phone": "052 6130001"
        },
        {
            "name": "FINNERTY PHARMACY LTD T/A MOCKLERS PHARMACY",
            "street": "Patrick St,",
            "city": "Templemore",
            "county": "Tipperary",
            "phone": "(0504) 31535"
        },
        {
            "name": "Finnertys Pharmacy",
            "street": "69-70 Kenyon street,",
            "city": "Nenagh",
            "county": "Tipperary",
            "phone": "(067) 34155"
        },
        {
            "name": "Friary Pharmacy",
            "street": "12 Main street,",
            "city": "Cashel",
            "county": "Tipperary",
            "phone": "062 62120"
        },
        {
            "name": "Gladstone Pharmacy Ltd",
            "street": "52 Gladstone street, 52 Gladstone st",
            "city": "Clonmel",
            "county": "Tipperary",
            "phone": "052 6121428"
        },
        {
            "name": "Grogans Pharmacy",
            "street": "Main Street, 18 Sli cuileann",
            "city": "Ballina-killaloe",
            "county": "Tipperary",
            "phone": "61376118"
        },
        {
            "name": "GUERINS PHARMACY LTD",
            "street": "7  Mitchel st,",
            "city": "Nenagh",
            "county": "Tipperary",
            "phone": "067 31447"
        },
        {
            "name": "HACKETTS",
            "street": "The Square,",
            "city": "Newport",
            "county": "Tipperary",
            "phone": "61378124"
        },
        {
            "name": "Haven Pharmacy Frawleys",
            "street": "11 Main street,",
            "city": "Roscrea",
            "county": "Tipperary",
            "phone": "50531733"
        },
        {
            "name": "Haven Pharmacy Lannens",
            "street": "10 New st,",
            "city": "Carrick On suir",
            "county": "Tipperary",
            "phone": "51640060"
        },
        {
            "name": "HEFFERNAN PHARMACY LTD",
            "street": "Main Street, Dundrum",
            "city": "Tipperary",
            "county": "Tipperary",
            "phone": "6271394"
        },
        {
            "name": "Hennessy's Totalhealth Pharmacy",
            "street": "Hennessy's Totalhealth pharmacy, Rosemary Square",
            "city": "Roscrea",
            "county": "Tipperary",
            "phone": "50521752"
        },
        {
            "name": "Hyland's CarePlus Pharmacy",
            "street": "Main Street,",
            "city": "Templemore",
            "county": "Tipperary",
            "phone": "0504 35781"
        },
        {
            "name": "James F OSullivan & Co Ltd",
            "street": "Main Street,",
            "city": "Fethard",
            "county": "Tipperary",
            "phone": "526132111"
        },
        {
            "name": "John Carey Pharmacist Ltd",
            "street": "Main St, Clogheen",
            "city": "Cahir",
            "county": "Tipperary",
            "phone": "527465485"
        },
        {
            "name": "Kennedys Pharmacy",
            "street": "Geraldine And john ryan ltd, 78 Main street",
            "city": "Cashel",
            "county": "Tipperary",
            "phone": "6261066"
        },
        {
            "name": "Killenaule Pharmacy",
            "street": "Main Street,",
            "city": "Killenaule",
            "county": "Tipperary",
            "phone": "052 9156209"
        },
        {
            "name": "Kirby's Pharmacy",
            "street": "3 Main street,",
            "city": "Tipperary",
            "county": "Tipperary",
            "phone": "6251142"
        },
        {
            "name": "Kissanes Pharmacy",
            "street": "52-53 Main street,",
            "city": "Tipperary Town",
            "county": "Tipperary",
            "phone": "(062) 51125"
        },
        {
            "name": "Ladyswell Pharmacy",
            "street": "Ladyswell Street,",
            "city": "Cashel",
            "county": "Tipperary",
            "phone": "062 65547"
        },
        {
            "name": "LIBERTY PHARMACY",
            "street": "34 Lower liberty sq,",
            "city": "Thurles",
            "county": "Tipperary",
            "phone": "50490604"
        },
        {
            "name": "LIoyds Pharmacy",
            "street": "Oakville Shopping centre,",
            "city": "Clonmel",
            "county": "Tipperary",
            "phone": "052/6121851"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Friar Street,",
            "city": "Thurles",
            "county": "Tipperary",
            "phone": "50422271"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "83 Main street,",
            "city": "Carrick On suir",
            "county": "Tipperary",
            "phone": "51640003"
        },
        {
            "name": "Madden'S CarePlus Pharmacy",
            "street": "3-4 Main street,",
            "city": "Roscrea",
            "county": "Tipperary",
            "phone": "(0505) 21058"
        },
        {
            "name": "Mahers Careplus Pharmacy",
            "street": "30 Liberty square, Thurles",
            "city": "Tipperary",
            "county": "Tipperary",
            "phone": "50458960"
        },
        {
            "name": "Mahers Pharmacy",
            "street": "7 O'connell st.,",
            "city": "Clonmel",
            "county": "Tipperary",
            "phone": "052 6121205"
        },
        {
            "name": "Mari Mina Pharmacy",
            "street": "Main Street,",
            "city": "Toomevara",
            "county": "Tipperary",
            "phone": "(067) 26344"
        },
        {
            "name": "Mari Mina Pharmacy",
            "street": "Kickham Street,",
            "city": "Mullinahone",
            "county": "Tipperary",
            "phone": "052 9153535"
        },
        {
            "name": "Mari Mina Pharmacy",
            "street": "The Square, Cahir",
            "city": "Cahir",
            "county": "Tipperary",
            "phone": "527441744"
        },
        {
            "name": "Marystreet Pharmacy",
            "street": "14 Marystreet ,",
            "city": "Clonmel",
            "county": "Tipperary",
            "phone": "052 6176610"
        },
        {
            "name": "MCCABES PHARMACY",
            "street": "Kickham St,",
            "city": "Thurles",
            "county": "Tipperary",
            "phone": "0505 21473"
        },
        {
            "name": "Mocklers Pharmacy",
            "street": "No 69, Liberty Square",
            "city": "Thurles",
            "county": "Tipperary",
            "phone": "0504 21421"
        }
    ],
    "Waterford": [
        {
            "name": "AJ Hallahan Ltd",
            "street": "38 & 39 Grattan square,",
            "city": "Dungarvan",
            "county": "Waterford",
            "phone": "058 41328"
        },
        {
            "name": "Ardkeen Medical Centre,",
            "street": "Ardkeen Shopping centre,, Dunmore Rd",
            "city": "Waterford",
            "county": "Waterford",
            "phone": "51874800"
        },
        {
            "name": "Ardkeen Medical Centre,",
            "street": "Ardkeen Shopping centre,, Dunmore Rd",
            "city": "Waterford",
            "county": "Waterford",
            "phone": "51874800"
        },
        {
            "name": "Barry Griffin Pharmacy",
            "street": "Supervalu Shopping centre, Barry Griffin pharmacy",
            "city": "Tramore",
            "county": "Waterford",
            "phone": "51386540"
        },
        {
            "name": "Barry Power Dental",
            "street": "42 Ballybricken,",
            "city": "Waterford",
            "county": "Waterford",
            "phone": "051 874778"
        },
        {
            "name": "Boots",
            "street": "Barronstrand Street,",
            "city": "Waterford City",
            "county": "Waterford",
            "phone": "51872255"
        },
        {
            "name": "Boots",
            "street": "Main St,",
            "city": "Tramore",
            "county": "Waterford",
            "phone": "51395000"
        },
        {
            "name": "Brennan's Pharmacy",
            "street": "Summerhill,",
            "city": "Tramore",
            "county": "Waterford",
            "phone": "051 390234"
        },
        {
            "name": "Brennan's Pharmacy",
            "street": "Summerhill,",
            "city": "Tramore",
            "county": "Waterford",
            "phone": "051 390234"
        },
        {
            "name": "Burkes Pharmacy",
            "street": "Hypercentre, Morgan Street",
            "city": "Waterford",
            "county": "Waterford",
            "phone": "51853428"
        },
        {
            "name": "Carroll'S Pharmacy",
            "street": "24 Ballybricken,",
            "city": "Waterford",
            "county": "Waterford",
            "phone": "51872079"
        },
        {
            "name": "Castle Pharmacy",
            "street": "Unit 8, Ballinakill SC dunmore road",
            "city": "Dunmore Rd",
            "county": "Waterford",
            "phone": "51821450"
        },
        {
            "name": "Cleaboy Pharmacy",
            "street": "Cleaboy Shopping complex, Cleaboy",
            "city": "Waterford",
            "county": "Waterford",
            "phone": "51358707"
        },
        {
            "name": "CLONEETY PHARMACY",
            "street": "16 Garvans terrace,",
            "city": "Dungarvan",
            "county": "Waterford",
            "phone": "5873111"
        },
        {
            "name": "Delany's Pharmacy",
            "street": "45 Johnstown,",
            "city": "Waterford",
            "county": "Waterford",
            "phone": "051 874722"
        },
        {
            "name": "Dermot O'Neill Pharmacy Portlaw Ltd",
            "street": "1 Brown street,",
            "city": "Portlaw",
            "county": "Waterford",
            "phone": "51387108"
        },
        {
            "name": "Dowlings Pharmacy",
            "street": "Ardkeen Shopping centre, Ardkeen",
            "city": "Waterford",
            "county": "Waterford",
            "phone": "051 877268"
        },
        {
            "name": "Feericks Pharmacy",
            "street": "Main Street,",
            "city": "Cappoquin",
            "county": "Waterford",
            "phone": "5854165"
        },
        {
            "name": "Gallaghers Pharmacy",
            "street": "29 Barronstrand street,",
            "city": "Waterford",
            "county": "Waterford",
            "phone": "51878103"
        },
        {
            "name": "Haven Pharmacy Branch Road",
            "street": "Lower Branch road,",
            "city": "Tramore",
            "county": "Waterford",
            "phone": "51338308"
        },
        {
            "name": "Haven Pharmacy Connolly's",
            "street": "59 Main st,",
            "city": "Dungarvan",
            "county": "Waterford",
            "phone": "5841064"
        },
        {
            "name": "Haven Pharmacy Kennys",
            "street": "Elm Pk, Ring Rd",
            "city": "Tramore",
            "county": "Waterford",
            "phone": "51330543"
        },
        {
            "name": "Hely's Pharmacy",
            "street": "Main St,",
            "city": "Cappoquin",
            "county": "Waterford",
            "phone": "5854430"
        },
        {
            "name": "Kelly'S Pharmacy",
            "street": "The Causeway, Abbeyside",
            "city": "Dungarvan",
            "county": "Waterford",
            "phone": "058 44433"
        },
        {
            "name": "Kellys Pharmacy",
            "street": "High Street,",
            "city": "Dungarvan",
            "county": "Waterford",
            "phone": "5842180"
        },
        {
            "name": "Kilcohan Pharmacy",
            "street": "Kilcohan Shopping centre, Waterford",
            "city": "Waterford",
            "county": "Waterford",
            "phone": "051-879467"
        },
        {
            "name": "Kilmeaden Pharmacy",
            "street": "Beside Centra,",
            "city": "Kilmeaden",
            "county": "Waterford",
            "phone": "51399861"
        },
        {
            "name": "KIRWANS PHARMACY",
            "street": "Main St,",
            "city": "Kilmacthomas",
            "county": "Waterford",
            "phone": "051 294256"
        },
        {
            "name": "Lismore Park Pharmacy",
            "street": "7 Tyrone road, Lismore Park",
            "city": "Waterford",
            "county": "Waterford",
            "phone": "051 370988"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Dungarvan Shopping centre,",
            "city": "Dungarvan",
            "county": "Waterford",
            "phone": "058 43171"
        },
        {
            "name": "Mari Mina Pharmacy",
            "street": "Main Street, Lismore",
            "city": "Lismore",
            "county": "Waterford",
            "phone": "5854730"
        },
        {
            "name": "Mari Mina Pharmacy",
            "street": "Dungarvan Road, Ardmore",
            "city": "Ardmore",
            "county": "Waterford",
            "phone": "2494898"
        },
        {
            "name": "Mayors Walk Local Pharmacy",
            "street": "60 Mayors walk,",
            "city": "Waterford City",
            "county": "Waterford",
            "phone": "51870785"
        }
    ],
    "Westmeath": [
        {
            "name": "Athlone Family Resource Centre CLG",
            "street": "Unit 15 Act business dev centre, Ball Alley lane",
            "city": "Athlone",
            "county": "Westmeath",
            "phone": "852512224"
        },
        {
            "name": "Athlone Opticians",
            "street": "3b Supervalu centre, Ballymahon Road",
            "city": "Athlone",
            "county": "Westmeath",
            "phone": "(090)6450696"
        },
        {
            "name": "BARRY'S PHARMACY",
            "street": "Main St,",
            "city": "Delvin",
            "county": "Westmeath",
            "phone": "449664301"
        },
        {
            "name": "Barrys Pharmacy",
            "street": "The Square,",
            "city": "Castlepollard",
            "county": "Westmeath",
            "phone": "(044)9661860"
        },
        {
            "name": "Bellview Clinic",
            "street": "Dublin Road,",
            "city": "Mullingar",
            "county": "Westmeath",
            "phone": "443936694"
        },
        {
            "name": "Bellview Pharmacy/McDaids Pharmacy",
            "street": "Old Dublin road,",
            "city": "Mullingar",
            "county": "Westmeath",
            "phone": "4"
        },
        {
            "name": "Bethany House",
            "street": "Main Street,",
            "city": "Tyrrellspass",
            "county": "Westmeath",
            "phone": "449223391"
        },
        {
            "name": "Boland Dental",
            "street": "6&7 Roslevin court , Ballymahon Road",
            "city": "Athlone",
            "county": "Westmeath",
            "phone": "906475956"
        },
        {
            "name": "Boots",
            "street": "Harbour Place shopping centre,",
            "city": "Mullingar",
            "county": "Westmeath",
            "phone": "449345580"
        },
        {
            "name": "Boots",
            "street": "Golden Island shopping centre,",
            "city": "Athlone",
            "county": "Westmeath",
            "phone": "906476955"
        },
        {
            "name": "BRETT'S - HUDSON PARK ATHLONE",
            "street": "49 Connaught street,",
            "city": "Athlone",
            "county": "Westmeath",
            "phone": "906492176"
        },
        {
            "name": "Concannons Ballymahon Road",
            "street": "Unit 2 Supwevalu, Ballymahon Road",
            "city": "Athlone",
            "county": "Westmeath",
            "phone": "906477776"
        },
        {
            "name": "Concannons Total Health Pharmacy",
            "street": "11 Mardyke street,",
            "city": "Athlone",
            "county": "Westmeath",
            "phone": "906478667"
        },
        {
            "name": "Coole Pharmacy",
            "street": "Castlepollard Road,",
            "city": "Coole",
            "county": "Westmeath",
            "phone": "449661776"
        },
        {
            "name": "Cooney's Pharmacy",
            "street": "Main St,",
            "city": "Moate",
            "county": "Westmeath",
            "phone": "906481622"
        },
        {
            "name": "Cooneys Pharmacy",
            "street": "Mullingar Road,",
            "city": "Kilbeggan",
            "county": "Westmeath",
            "phone": "579332407"
        },
        {
            "name": "Cooneys Pharmacy",
            "street": "Unit 00, City Quarter",
            "city": "Athlone",
            "county": "Westmeath",
            "phone": "090 64 20003"
        },
        {
            "name": "Cunningham's Pharmacy",
            "street": "Auburn Retail centre, Dublin Rd",
            "city": "Athlone",
            "county": "Westmeath",
            "phone": "906477739"
        },
        {
            "name": "Glasson Pharmacy",
            "street": "Glasson Village,",
            "city": "Athlone",
            "county": "Westmeath",
            "phone": "906485959"
        },
        {
            "name": "Green Street Pharmacy",
            "street": "Green Street, Lackan",
            "city": "Castlepollard",
            "county": "Westmeath",
            "phone": "+353449662968"
        },
        {
            "name": "Haven Gildeas Pharmacy",
            "street": "Main Street,",
            "city": "Killucan",
            "county": "Westmeath",
            "phone": "449376506"
        },
        {
            "name": "Haven Pharmacy Gildeas",
            "street": "Main Street,",
            "city": "Kinnegad",
            "county": "Westmeath",
            "phone": "449375102"
        },
        {
            "name": "Haven Pharmacy Mullingar",
            "street": "Austin Friars street,",
            "city": "Mullingar",
            "county": "Westmeath",
            "phone": "449349476"
        },
        {
            "name": "Home Birth",
            "street": "289 , Greenpark Meadows",
            "city": "Mullingar",
            "county": "Westmeath",
            "phone": "044 934580"
        },
        {
            "name": "Keane's Careplus Pharmacy Market Point",
            "street": "Market Point medical park, Patrick Street",
            "city": "Mullingar",
            "county": "Westmeath",
            "phone": "449341704"
        },
        {
            "name": "Keane`s Careplus Pharmacy, Green Road.",
            "street": "Unit 4 Aldi s.c., Green Road",
            "city": "Mullingar",
            "county": "Westmeath",
            "phone": "449390390"
        },
        {
            "name": "Keanes CarePlus Pharmacy",
            "street": "Primary Care centre, Harbour Street",
            "city": "Mullingar",
            "county": "Westmeath",
            "phone": "044 93 42884"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "20 Pearse street, 20 Pearse street",
            "city": "Mullingar",
            "county": "Westmeath",
            "phone": "044 9344324"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Tesco S/C,",
            "city": "Mullingar",
            "county": "Westmeath",
            "phone": "044 9348471"
        },
        {
            "name": "Mark Wright Totalhealth Pharmacy",
            "street": "Mark Wright totalhealth pharmacy, Mark Wright totalhealth pharmacy",
            "city": "Tyrrellspass",
            "county": "Westmeath",
            "phone": "044 9223116"
        },
        {
            "name": "MARY STREET PHARMACY",
            "street": "Mary Street,",
            "city": "Mullingar",
            "county": "Westmeath",
            "phone": "044 9347493"
        },
        {
            "name": "Mc Donnell's Pharmacy",
            "street": "Magazine Rd, Magazine Rd",
            "city": "Athlone",
            "county": "Westmeath",
            "phone": "3.53907E+11"
        }
    ],
    "Wexford": [
        {
            "name": "9-13 South Main Street",
            "street": "Wexford Town,",
            "city": "Wexford",
            "county": "Wexford",
            "phone": "053 9198511"
        },
        {
            "name": "Abbey Medical",
            "street": "Wexford Primary care centre, Grogans Road",
            "city": "Wexford",
            "county": "Wexford",
            "phone": "(053)9122581"
        },
        {
            "name": "Abbey Medical",
            "street": "Wexford Primary care centre, Grogans Road",
            "city": "Wexford",
            "county": "Wexford",
            "phone": "(053)9122581"
        },
        {
            "name": "Abbey Medical Wexford",
            "street": "Wexford Primary Care Centre",
            "city": "Grogan's Road",
            "county": "Wexford",
            "phone": "539122581"
        },
        {
            "name": "Abbey Street Pharmacy",
            "street": "42 Abbey st,",
            "city": "Wexford Town",
            "county": "Wexford",
            "phone": "053 9176440"
        },
        {
            "name": "Adamstown Pharmacy",
            "street": "Adamstown,",
            "city": "Enniscorthy",
            "county": "Wexford",
            "phone": "539240460"
        },
        {
            "name": "Boots Chemist",
            "street": "85-86 Main street,",
            "city": "Gorey",
            "county": "Wexford",
            "phone": "539489536"
        },
        {
            "name": "Brendan Loftus Pharmacy",
            "street": "Market Square,",
            "city": "Bunclody",
            "county": "Wexford",
            "phone": "539377529"
        },
        {
            "name": "Bridgetown Pharmacy",
            "street": "Bridgetown South,",
            "city": "Bridgetown",
            "county": "Wexford",
            "phone": "539175595"
        },
        {
            "name": "Burkes Pharmacy",
            "street": "25 South street,",
            "city": "New Ross",
            "county": "Wexford",
            "phone": "51421522"
        },
        {
            "name": "Campile Pharmacy",
            "street": "Campile,",
            "city": "New Ross",
            "county": "Wexford",
            "phone": "051 388660"
        },
        {
            "name": "CASTLEBRIDGE PHARMACY",
            "street": "No 1 The square,",
            "city": "Castlebridge",
            "county": "Wexford",
            "phone": "539179024"
        },
        {
            "name": "Clonroche Pharmacy",
            "street": "Main street,  Clonroche",
            "city": "Enniscorthy",
            "county": "Wexford",
            "phone": "539244055"
        },
        {
            "name": "Coppens Pharmacy",
            "street": "Abbey Centre,",
            "city": "Enniscorthy",
            "county": "Wexford",
            "phone": "539234959"
        },
        {
            "name": "CORACH PHARMACY",
            "street": "Maudlintown,",
            "city": "Wellingtonbridge",
            "county": "Wexford",
            "phone": "51271150"
        },
        {
            "name": "Farrell's Pharmacy",
            "street": "16 Templeshannon,",
            "city": "Enniscorthy",
            "county": "Wexford",
            "phone": "(053) 9233189"
        },
        {
            "name": "Faythe Pharmacy",
            "street": "Unit 2, 178 The Faythe",
            "city": "Wexford Town",
            "county": "Wexford",
            "phone": "053 9146746"
        },
        {
            "name": "Fehilys Pharmacy",
            "street": "28 South main street,",
            "city": "Wexford",
            "county": "Wexford",
            "phone": "539123163"
        },
        {
            "name": "Ferns Pharmacy",
            "street": "Aldercourt, Main Street  ferns",
            "city": "Enniscorthy",
            "county": "Wexford",
            "phone": "539366117"
        },
        {
            "name": "Fethard On Sea Pharmacy",
            "street": "Main Street,fethard on sea, Co Wexford",
            "city": "County Wexford",
            "county": "Wexford",
            "phone": "51397667"
        },
        {
            "name": "First Choice Pharmacy",
            "street": "Tesco Store, Distillery Road",
            "city": "Wexford",
            "county": "Wexford",
            "phone": "539166355"
        },
        {
            "name": "Fortune's Pharmacy",
            "street": "82 North main st,",
            "city": "Wexford Town",
            "county": "Wexford",
            "phone": "053 91 2354"
        },
        {
            "name": "Garahys Pharmacy",
            "street": "6 Slaney street,",
            "city": "Enniscorthy",
            "county": "Wexford",
            "phone": "539233234"
        },
        {
            "name": "Grants Pharmacy",
            "street": "Unit 4b, St Aidan's shopping centre",
            "city": "Wexford",
            "county": "Wexford",
            "phone": "539123068"
        },
        {
            "name": "Grants Pharmacy",
            "street": "The Avenue, gorey, The Avenue",
            "city": "Gorey",
            "county": "Wexford",
            "phone": "539481031"
        },
        {
            "name": "Grants Pharmacy",
            "street": "21/22 Duffry gate,",
            "city": "Enniscorthy",
            "county": "Wexford",
            "phone": "539234025"
        },
        {
            "name": "Hanlys Local Pharmacy",
            "street": "65 South street,",
            "city": "New Ross",
            "county": "Wexford",
            "phone": "051 421708"
        },
        {
            "name": "Hassett'S Allcare Pharmacy",
            "street": "9-11 North main street,",
            "city": "Wexford",
            "county": "Wexford",
            "phone": "053-9122021"
        },
        {
            "name": "Haven Pharmacy Murphys",
            "street": "Clonard Road, Wexford",
            "city": "Wexford",
            "county": "Wexford",
            "phone": "539184444"
        },
        {
            "name": "Hickey's Pharmacy",
            "street": "Unit 18, Gorey shopping centre, The Avenue",
            "city": "Gorey",
            "county": "Wexford",
            "phone": "(053) 948 3399"
        },
        {
            "name": "Irishtown Pharmacy",
            "street": "15 Irishtown,",
            "city": "New Ross",
            "county": "Wexford",
            "phone": "051 448332"
        },
        {
            "name": "Kavanagh'S Pharmacy",
            "street": "Duffry Hill,",
            "city": "Enniscorthy",
            "county": "Wexford",
            "phone": "(053)9234660"
        },
        {
            "name": "Kellys Pharmacy",
            "street": "Slaney Place,",
            "city": "Enniscorthy",
            "county": "Wexford",
            "phone": "539233137"
        },
        {
            "name": "Killeens Pharmacy",
            "street": "Killeens, Killeens",
            "city": "Wexford",
            "county": "Wexford",
            "phone": "539126428"
        },
        {
            "name": "Kilmuckridge Pharmacy",
            "street": "Main Street, Kilmuckridge",
            "city": "Gorey",
            "county": "Wexford",
            "phone": "539130023"
        },
        {
            "name": "Lloyd's Pharmacy",
            "street": "Rosslare Shopping centre,",
            "city": "Rosslare Harbour",
            "county": "Wexford",
            "phone": "539133551"
        },
        {
            "name": "LLOYDS PHARMACY",
            "street": "Wellingtonbridge,",
            "city": "Wellingtonbridge",
            "county": "Wexford",
            "phone": "51561831"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Lower Main street,",
            "city": "Gorey",
            "county": "Wexford",
            "phone": "053 842 1294"
        },
        {
            "name": "MCCABES PHARMACY",
            "street": "2 North main st, Wexford",
            "city": "Town",
            "county": "Wexford",
            "phone": "053 91 22875"
        },
        {
            "name": "McCabes Pharmacy",
            "street": "69 Main street,",
            "city": "Gorey",
            "county": "Wexford",
            "phone": "539421904"
        },
        {
            "name": "Sam McCauleys Pharmacy",
            "street": "Market Square, Bunclody",
            "city": "Bunclody",
            "county": "Wexford",
            "phone": "053 9377800"
        }
    ],
    "Wicklow": [
        {
            "name": "AcuPhysio Clinic",
            "street": "Unit 2 Southern cross business park,",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "12760001"
        },
        {
            "name": "Adrian Dunne Ashford",
            "street": "Mount Usher court,",
            "city": "Ashford",
            "county": "Wicklow",
            "phone": "40449729"
        },
        {
            "name": "Adrian Dunne Pharmacy",
            "street": "Main Street,",
            "city": "Newtownmountkennedy",
            "county": "Wicklow",
            "phone": "01 2819128"
        },
        {
            "name": "Adrian Dunne Pharmacy",
            "street": "40/41 Main st. arklow, co. wicklow,",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "40232456"
        },
        {
            "name": "Aisling House Nursing Home",
            "street": "Sea Road,",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "40233843"
        },
        {
            "name": "Allcare Pharmacy",
            "street": "46 Main street,",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "0402 32457"
        },
        {
            "name": "Applewood Physiotherapy",
            "street": "Roche's Clinic, Blacklion",
            "city": "Greystones",
            "county": "Wicklow",
            "phone": "01 2873232"
        },
        {
            "name": "Applewood Physiotherapy",
            "street": "Roche's Clinic, Blacklion",
            "city": "Greystones",
            "county": "Wicklow",
            "phone": "01 2873232"
        },
        {
            "name": "ARKLOW MEDICAL PRACTICE",
            "street": "3 Upper  main  street,",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "0402 32421"
        },
        {
            "name": "Armstrong Life Pharmacy",
            "street": "40a Wexford road,",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "40244155"
        },
        {
            "name": "Asgard Lodge Nursing Home",
            "street": "Monument Lane , Kilbride",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "0402 32901"
        },
        {
            "name": "Atlanta Nursing Home Ltd",
            "street": "Sidmonton Road,",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "01 2860398"
        },
        {
            "name": "Aughrim Pharmacy Ltd",
            "street": "Main Street, Aughrim",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "0402 36655"
        },
        {
            "name": "Avoca Pharmacy",
            "street": "Main Street , Avoca Village",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "0402 30608"
        },
        {
            "name": "Bentleydevereuxdooley@Healthmail.Ie",
            "street": "Bradshaws Lane surgery,",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "40232418"
        },
        {
            "name": "Bentleydevereuxdooley@Healthmail.Ie",
            "street": "Bradshaws Lane surgery,",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "40232418"
        },
        {
            "name": "Blainroe Lodge Nursing Home",
            "street": "Coast Road ,",
            "city": "Blainroe",
            "county": "Wicklow",
            "phone": "(0404) 600 30"
        },
        {
            "name": "Blainroe Lodge Nursing Home",
            "street": "Coast Road ,",
            "city": "Blainroe",
            "county": "Wicklow",
            "phone": "(0404) 600 30"
        },
        {
            "name": "Boghall Pharmacy",
            "street": "Boghall Shopping centre,",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "12869066"
        },
        {
            "name": "Boots Arklow",
            "street": "Bridgewater Shopping centre,",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "0402 24273"
        },
        {
            "name": "Boots Pharmacy",
            "street": "18 Church road,",
            "city": "Greystones",
            "county": "Wicklow",
            "phone": "12878290"
        },
        {
            "name": "Boots The Chemist",
            "street": "105 Main st,",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "12763843"
        },
        {
            "name": "Boots Wicklow Town",
            "street": "Abbey Street,",
            "city": "Wicklow",
            "county": "Wicklow",
            "phone": "40467355"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "Westmount Clinic, Church Hill",
            "city": "Co Wicklow",
            "county": "Wicklow",
            "phone": "0404 25122"
        },
        {
            "name": "Bradleys Pharmacy",
            "street": "Westmount Clinic, Church Hill",
            "city": "Co Wicklow",
            "county": "Wicklow",
            "phone": "0404 25122"
        },
        {
            "name": "Bray Addiction Treatment Centre Pharmacy",
            "street": "Bray Primary care centre, Killarney Road",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "17784008"
        },
        {
            "name": "Cunninghams'S Pharmacy",
            "street": "3 Killarney pk ,",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "12868038"
        },
        {
            "name": "Dargle Valley Pharmacy",
            "street": "1c Quinsboro road, Bray",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "2862210"
        },
        {
            "name": "David Dodd Pharmacy",
            "street": "Greystones Medical centre, Mill Road",
            "city": "Greystones",
            "county": "Wicklow",
            "phone": "12878612"
        },
        {
            "name": "Delgany Pharmacy",
            "street": "Unit 3 Wicklow arms complex, Main Street",
            "city": "Delgany",
            "county": "Wicklow",
            "phone": "12016489"
        },
        {
            "name": "Downeys Pharmacy",
            "street": "Tesco S C, Bray",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "01 2761167"
        },
        {
            "name": "Ferrybank Careplus Pharmacy",
            "street": "Unit 1 Ferrybank mall,",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "40233618"
        },
        {
            "name": "Fiona Roche Pharmacy",
            "street": "Roches Clinic, Blacklion",
            "city": "Greystones",
            "county": "Wicklow",
            "phone": "12870224"
        },
        {
            "name": "First Choice Pharmacy",
            "street": "Tesco Extra, Wexford Road",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "40241104"
        },
        {
            "name": "Grants Pharmacy Arklow",
            "street": "Old Wexford Road, Arklow",
            "city": "Arklow",
            "county": "Wicklow",
            "phone": "0402-20030"
        },
        {
            "name": "Grants Pharmacy Bray",
            "street": "Unit 1 Neighbourhood centre, Southern Cross road",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "12014764"
        },
        {
            "name": "Hilton's Pharmacy",
            "street": "2 Main st,",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "12864737"
        },
        {
            "name": "Kennedy'S Pharmacy",
            "street": "35 Main street,",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "(01)2829812"
        },
        {
            "name": "Kevin Carey Pharmacy",
            "street": "Main St,",
            "city": "Baltinglass",
            "county": "Wicklow",
            "phone": "596481030"
        },
        {
            "name": "Kilcoole Pharmacy Ltd",
            "street": "Main St.,",
            "city": "Kilcoole",
            "county": "Wicklow",
            "phone": "12874483"
        },
        {
            "name": "Knockrobin Pharmacy",
            "street": "Wicklow Primary care centre, Port Road",
            "city": "Wicklow Town",
            "county": "Wicklow",
            "phone": "40469557"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Novara Avenue,",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "12829301"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "The Charlesland centre,",
            "city": "Greystones",
            "county": "Wicklow",
            "phone": "12870724"
        },
        {
            "name": "Lloyds Pharmacy",
            "street": "Main Street,",
            "city": "Baltinglass",
            "county": "Wicklow",
            "phone": "596482858"
        },
        {
            "name": "Lloyds Pharmacy Greystones",
            "street": "Tesco Shopping centre,",
            "city": "Greystones",
            "county": "Wicklow",
            "phone": "01 2876791"
        },
        {
            "name": "Lloydspharmacy",
            "street": "Castle Street,",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "01 2860030"
        },
        {
            "name": "Mac Sherry's Pharmacy",
            "street": "5 Whitethorn centre,",
            "city": "Kilcoole",
            "county": "Wicklow",
            "phone": "12870400"
        },
        {
            "name": "Magee's Pharmacy",
            "street": "Main Street,",
            "city": "Enniskerry",
            "county": "Wicklow",
            "phone": "12863515"
        },
        {
            "name": "McCabes Pharmacy Bray",
            "street": "24 Quinsborough road,",
            "city": "Bray",
            "county": "Wicklow",
            "phone": "01 2862048"
        }
    ]
};

            const prescriptionDelivery = document.getElementById('medicalPrescriptionDelivery');
            const pharmacyOptionsContainer = document.getElementById('pharmacyOptionsContainer');
            const pharmacyCountry = document.getElementById('pharmacyCountry');
            const pharmacyName = document.getElementById('pharmacyName');
            const pharmacyInfoBox = document.getElementById('pharmacyInfoBox');

            function updatePharmacyInfoVisibility() {
                if (prescriptionDelivery && pharmacyCountry && pharmacyName && pharmacyInfoBox) {
                    const country = pharmacyCountry.value;
                    const isPharmacyDelivery = prescriptionDelivery.value === 'Collect at Pharmacy';

                    const selectedOption = pharmacyName.options[pharmacyName.selectedIndex];
                    const pharmacyIndex = selectedOption ? selectedOption.dataset.index : null;
                    const data = pharmacyIndex !== null ? pharmacyData[country]?.[pharmacyIndex] : null;

                    if (isPharmacyDelivery && data) {
                        if (pharmacyInfoName) pharmacyInfoName.textContent = data.name;
                        
                        let addressText = data.county;
                        if (data.street && data.city) {
                            addressText = `${data.street}, ${data.city}, ${data.county}`;
                        }
                        if (pharmacyInfoCounty) pharmacyInfoCounty.textContent = addressText;
                        
                        if (pharmacyInfoPhone) pharmacyInfoPhone.textContent = data.phone;
                        if (hiddenPharmacyPhone) hiddenPharmacyPhone.value = data.phone;
                        pharmacyInfoBox.classList.remove('d-none');
                    } else {
                        pharmacyInfoBox.classList.add('d-none');
                        if (hiddenPharmacyPhone) hiddenPharmacyPhone.value = '';
                    }
                }
            }

            if (prescriptionDelivery) {
                prescriptionDelivery.addEventListener('change', function () {
                    if (pharmacyOptionsContainer) {
                        pharmacyOptionsContainer.classList.toggle('d-none', this.value !== 'Collect at Pharmacy');
                    }
                    updatePharmacyInfoVisibility();
                });
            }

            if (pharmacyCountry) {
                pharmacyCountry.addEventListener('change', function () {
                    if (pharmacyName) {
                        pharmacyName.innerHTML = '<option selected disabled>Choose Pharmacy</option>';
                        const country = this.value;
                        if (pharmacyData[country]) {
                            pharmacyData[country].forEach((pharmacy, index) => {
                                const option = document.createElement('option');
                                let text = pharmacy.name;
                                if (pharmacy.street && pharmacy.city) {
                                    text += ` - ${pharmacy.street} ${pharmacy.city}, ${pharmacy.county}`;
                                } else if (pharmacy.county) {
                                    text += ` - ${pharmacy.county}`;
                                }
                                option.value = pharmacy.name;
                                option.textContent = text;
                                option.dataset.index = index;
                                pharmacyName.appendChild(option);
                            });
                        }
                    }
                    updatePharmacyInfoVisibility();
                });
            }

            if (pharmacyName) {
                pharmacyName.addEventListener('change', updatePharmacyInfoVisibility);
            }

            // Real-time Email Existence Check
            const regEmailInput = document.getElementById('reg_email');
            const emailError = document.getElementById('email-error');
            const nextBtn = document.getElementById('wizard-next-btn');

            if (regEmailInput) {
                regEmailInput.addEventListener('input', async function () {
                    const email = this.value.trim();
                    if (email.length < 5 || wizardAccountMode === 'login' || window.wizardLoggedIn) {
                        return;
                    }

                    try {
                        const response = await fetch("/check-email", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ email: email })
                        });

                        if (response.status === 419) {
                            location.reload();
                            return;
                        }
                        const data = await response.json();

                        if (data.exists) {
                            // Populate login email
                            const loginEmailInput = document.getElementById('login_email');
                            if (loginEmailInput) loginEmailInput.value = email;

                            // Switch to login mode and hide next button
                            setWizardAccountMode('login', true);

                            if (emailError) {
                                emailError.textContent = "This email is already registered.";
                                emailError.classList.remove('d-none');
                            }
                            regEmailInput.classList.add('is-invalid');
                        } else {
                            // If it was auto-switched, switch back if email becomes unique
                            if (wizardAccountMode === 'login' && !window.wizardLoggedIn) {
                                setWizardAccountMode('register');
                            }
                            if (emailError) emailError.classList.add('d-none');
                            regEmailInput.classList.remove('is-invalid');
                        }
                    } catch (error) {
                        console.error('Error checking email:', error);
                    }
                });
            }
        });

        async function submitRegistration(formSource) {
            if (window.event) window.event.preventDefault();
            let form;
            if (typeof formSource === 'number') {
                form = document.getElementById(`registrationForm${formSource}`);
            } else {
                form = document.getElementById(formSource);
            }

            if (!form) return;
            const formData = new FormData(form);

            // If submitting from Step 5, also include data from Step 4 (medicalForm)
            if (formSource === 'registrationForm5') {
                const medicalForm = document.getElementById('medicalForm');
                if (medicalForm) {
                    const medicalFormData = new FormData(medicalForm);
                    for (let [key, value] of medicalFormData.entries()) {
                        if (!formData.has(key)) {
                            formData.append(key, value);
                        }
                    }
                }
            }

            // Gather data from parent wizard steps (only if not already in the form)
            if (!formData.has('appointmentType')) {
                formData.append('appointmentType', document.getElementById('appointmentType').value);
            }

            // Handle Appointment Date: Prefer form's date, then Step 1 date
            if (!formData.has('appointmentDate') || !formData.get('appointmentDate')) {
                formData.set('appointmentDate', document.getElementById('appointmentDate').value);
            }

            // Get selected time slot from Step 1
            const selectedTimeBtn = document.querySelector('#timeSlotsContainer .btn-info');
            if (selectedTimeBtn) {
                formData.set('timeSlot', selectedTimeBtn.textContent);
            }

            // Force Step 2 credentials (required for registration flow)
            const rEmail = document.getElementById('reg_email');
            const rPass = document.getElementById('reg_password');
            if (rEmail) formData.set('registeremail', rEmail.value);
            if (rPass) formData.set('registerpassword', rPass.value);

            // Combine Triple-Select Date of Birth for Step 5
            if (formSource === 'registrationForm5') {
                const dobDate = document.getElementById('dob_date').value;
                const dobMonth = document.getElementById('dob_month').value;
                const dobYear = document.getElementById('dob_year').value;
                if (dobDate && dobMonth && dobYear) {
                    const dobFull = `${dobYear}-${dobMonth}-${dobDate}`;
                    formData.set('bod_of_birth', dobFull);
                    // Also set it in the hidden input just in case
                    document.getElementById('bod_of_birth').value = dobFull;
                }
            }

            // Ensure CSRF token is in the formData to prevent mismatch
            if (!formData.has('_token')) {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (token) formData.append('_token', token);
            }

            try {
                const response = await fetch("/patient-registration", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    }
                });

                if (response.status === 419) {
                    alert('Your session has expired for security reasons. The page will now reload to refresh your security token. Please try booking again after the reload.');
                    location.reload();
                    return;
                }

                let result;
                const responseText = await response.text();
                try {
                    result = JSON.parse(responseText);
                } catch (e) {
                    console.error('Failed to parse JSON:', responseText);
                    throw new Error('Server returned non-JSON response. Check console for details.');
                }

                if (result.success) {
                    // Hide the step indicators container
                    const indicators = document.getElementById('steps-indicator');
                    if (indicators) indicators.classList.add('d-none');

                    // Show success step
                    showStep(6);

                    // Optional: You could also trigger a small confetti effect or toast here if desired
                } else {
                    alert('Registration failed: ' + (result.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred during registration: ' + error.message);
            }
        }
        function previewImage(input) {
            const container = document.getElementById('imagePreviewContainer');
            const preview = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    container.classList.remove('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                container.classList.add('d-none');
            }
        }

    </script>
</body>

</html>