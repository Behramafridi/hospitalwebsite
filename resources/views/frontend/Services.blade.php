<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services | MediCall Excellence</title>
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
                        <li><a href="{{route('service')}}" class="active">Services</a></li>
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
        <!-- Service Hero -->
        <section class="service-hero">
            <div class="container">
                <h6 class="text-uppercase fw-bold mb-3" style="letter-spacing: 3px; color: var(--secondary);">Comprehensive Care</h6>
                <h1>Specialized Medical Services</h1>
                <p class="lead opacity-75 mx-auto" style="max-width: 700px;">Our clinical departments are staffed with experts dedicated to your health and recovery using modern medical standards.</p>
            </div>
        </section>

        <!-- Services Grid -->
        <section class="section-padding" style="background: var(--bg-page);">
            <div class="container">
                <div class="service-grid-premium">
                    <div class="service-item-card">
                        <div class="service-icon-box"><i class="fa-solid fa-truck-medical"></i></div>
                        <h4 class="fw-bold mb-3">Emergency Care</h4>
                        <p class="mb-0 opacity-75">Available 24/7 with a dedicated trauma team and advanced life support for critical medical situations.</p>
                    </div>
                    <div class="service-item-card">
                        <div class="service-icon-box"><i class="fa-solid fa-user-doctor"></i></div>
                        <h4 class="fw-bold mb-3">General Practice</h4>
                        <p class="mb-0 opacity-75">Comprehensive family health services including routine checkups, vaccinations, and preventive care.</p>
                    </div>
                    <div class="service-item-card">
                        <div class="service-icon-box"><i class="fa-solid fa-flask-vial"></i></div>
                        <h4 class="fw-bold mb-3">Diagnostic Lab</h4>
                        <p class="mb-0 opacity-75">Fully automated laboratory providing precise and timely results for wide-ranging medical investigations.</p>
                    </div>
                    <div class="service-item-card">
                        <div class="service-icon-box"><i class="fa-solid fa-brain"></i></div>
                        <h4 class="fw-bold mb-3">Neurology</h4>
                        <p class="mb-0 opacity-75">Expert management of disorders affecting the nervous system, brain, and spinal cord with modern tech.</p>
                    </div>
                    <div class="service-item-card">
                        <div class="service-icon-box"><i class="fa-solid fa-heart-pulse"></i></div>
                        <h4 class="fw-bold mb-3">Cardiology</h4>
                        <p class="mb-0 opacity-75">Specialized heart care including diagnostics, treatment, and cardiac rehabilitation programs.</p>
                    </div>
                    <div class="service-item-card">
                        <div class="service-icon-box"><i class="fa-solid fa-pills"></i></div>
                        <h4 class="fw-bold mb-3">Pharmacy</h4>
                        <p class="mb-0 opacity-75">In-house pharmacy offering authentic medications, professional consultation, and prescription refills.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us / Features -->
        <section class="section-padding">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <h6 class="text-uppercase fw-bold mb-3" style="color: var(--primary-light);">CLINICAL EXCELLENCE</h6>
                        <h2 class="fw-bold mb-4 fs-1">Setting the Standard for Medical Services</h2>
                        <p class="mb-5">We are committed to delivering healthcare services that combine advanced medical technology with compassionate care. Our clinical staff undergoes continuous training to stay at the forefront of medical innovation.</p>
                        
                        <div class="feature-list">
                            <div class="feature-list-item">
                                <div class="feature-icon-small"><i class="fa-solid fa-clock-rotate-left"></i></div>
                                <div>
                                    <h4 class="fw-bold mb-2">Patient-First Approach</h4>
                                    <p class="mb-0 opacity-75 text-sm">Every treatment plan is tailored to the individual needs and comfort of our patients.</p>
                                </div>
                            </div>
                            <div class="feature-list-item">
                                <div class="feature-icon-small"><i class="fa-solid fa-award"></i></div>
                                <div>
                                    <h4 class="fw-bold mb-2">Certified Specialists</h4>
                                    <p class="mb-0 opacity-75 text-sm">Our medical team consists of board-certified professionals with international experience.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="glass-card overflow-hidden" style="border-radius: var(--radius-lg);">
                            <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Medical Technology" style="width: 100%; height: auto;">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section-padding" style="background: var(--bg-page);">
            <div class="container">
                <div class="glass-card p-5 text-center shadow-lg border-0" style="background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white;">
                    <h2 class="fw-bold fs-1 mb-4">Need Personalized Care?</h2>
                    <p class="fs-5 mb-5 opacity-75">Connect with our specialized doctors to discuss your health requirements today.</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('appointment') }}" class="btn btn-primary" style="background: white; color: var(--primary);">SCHEDULE A CONSULTATION</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline" style="border-color: white; color: white;">GET IN TOUCH</a>
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
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="btn p-0 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white;"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="btn p-0 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white;"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="btn p-0 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white;"><i class="fa-brands fa-instagram"></i></a>
                    </div>
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