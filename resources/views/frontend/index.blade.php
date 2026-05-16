<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCall | Elite Medical Excellence</title>
    <meta name="description" content="Premium healthcare solutions and professional medical services at MediCall.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- CSS Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <!-- Header / Navigation -->
    <header id="main-header">
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
        <section class="services section-padding">
            <div class="container">
                <div class="row mb-5 align-items-end">
                    <div class="col-lg-6">
                        <h6 class="text-uppercase fw-bold mb-3" style="color: var(--primary-light); letter-spacing: 2px;">DEPARTMENTS</h6>
                        <h2 class="fw-bold fs-1" style="color: var(--primary);">Comprehensive Medical <br>Expertise</h2>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <p class="text-muted mb-0">Explore our wide range of medical services designed to provide you with the best care possible.</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <i class="fa-solid fa-heart-pulse"></i>
                            <h3>Cardiology</h3>
                            <p>Complete heart care from prevention to complex surgery using cutting-edge technology.</p>
                            <a href="{{ route('service') }}" class="btn p-0 text-primary fw-bold" style="text-transform: none; letter-spacing: 0;">Explore Dept <i class="fas fa-arrow-right-long ms-2"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <i class="fa-solid fa-brain"></i>
                            <h3>Neurology</h3>
                            <p>Expert management of brain and nervous system disorders with advanced clinical research.</p>
                            <a href="{{ route('service') }}" class="btn p-0 text-primary fw-bold" style="text-transform: none; letter-spacing: 0;">Explore Dept <i class="fas fa-arrow-right-long ms-2"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <i class="fa-solid fa-child-reaching"></i>
                            <h3>Pediatrics</h3>
                            <p>Specialized and compassionate care for our youngest patients in a friendly environment.</p>
                            <a href="{{ route('service') }}" class="btn p-0 text-primary fw-bold" style="text-transform: none; letter-spacing: 0;">Explore Dept <i class="fas fa-arrow-right-long ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works (Premium Dark Theme) -->
        <section class="how-it-works section-padding">
            <div class="container">
                <div class="text-center mb-5 pb-4">
                    <h2 class="fw-bold fs-1 mb-3">Your Journey to <span style="color: var(--secondary);">Better Health</span></h2>
                    <p style="color: rgba(255,255,255,0.6);">A seamless process designed for your convenience and care.</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="step-card">
                            <div class="step-number">01</div>
                            <h4 class="fw-bold mb-3">Online Booking</h4>
                            <p class="text-muted mb-0">Easily schedule your consultation through our secure online platform anytime, anywhere.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="step-card">
                            <div class="step-number">02</div>
                            <h4 class="fw-bold mb-3">Expert Consultation</h4>
                            <p class="text-muted mb-0">Meet with our world-class specialists for a detailed diagnosis and personalized care plan.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="step-card">
                            <div class="step-number">03</div>
                            <h4 class="fw-bold mb-3">Ongoing Support</h4>
                            <p class="text-muted mb-0">Receive comprehensive follow-up care and access to your medical records through our portal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section-padding" style="background: var(--bg-white);">
            <div class="container">
                <div class="glass-card p-5 p-lg-5 text-center shadow-lg border-0" style="background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white;">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h2 class="fw-bold fs-1 mb-4">Start Your Healing Journey Today</h2>
                            <p class="fs-5 mb-5 opacity-75">Connect with our medical team for professional advice and world-class care that you deserve.</p>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="{{ route('appointment') }}" class="btn btn-primary">BOOK AN APPOINTMENT <i class="fa-solid fa-calendar-plus"></i></a>
                                <a href="tel:+35319609912" class="btn btn-outline" style="border-color: white; color: white;">CALL +353 1 960 9912</a>
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>