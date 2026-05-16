<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | MediCall Excellence</title>
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
        .about-hero {
            background: linear-gradient(rgba(29, 131, 127, 0.8), rgba(29, 131, 127, 0.8)), url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            padding: 150px 0 100px;
            color: white;
            text-align: center;
        }

        .about-hero h1 {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            margin-bottom: 1.5rem;
        }

        .about-image-stack {
            position: relative;
            padding: 2rem;
        }

        .about-image-main {
            border-radius: var(--radius-lg);
            width: 100%;
            height: auto;
            box-shadow: var(--shadow-lg);
        }

        .about-image-sub {
            position: absolute;
            bottom: -30px;
            right: -10px;
            width: 50%;
            border: 10px solid white;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
        }

        .value-card {
            background: white;
            padding: 3rem 2rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
            transition: var(--transition);
            text-align: center;
            height: 100%;
        }

        .value-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .value-icon {
            width: 80px;
            height: 80px;
            background: var(--bg-page);
            color: var(--primary);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 2rem;
            transition: var(--transition);
        }

        .value-card:hover .value-icon {
            background: var(--primary);
            color: white;
            transform: rotateY(180deg);
        }

        .mission-vision {
            background: white;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .mv-tab {
            padding: 3rem;
        }

        .mv-image {
            height: 100%;
            min-height: 400px;
            background: url('https://images.unsplash.com/photo-1516549655169-df83a0774514?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
        }

        @media (max-width: 991px) {
            .about-image-sub {
                display: none;
            }
            .mv-image {
                min-height: 300px;
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
                        <li><a href="{{route('about')}}" class="active">About</a></li>
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

    <!-- Page Content -->
    <main>
        <!-- Hero Section -->
        <section class="about-hero">
            <div class="container">
                <h6 class="text-uppercase fw-bold mb-3" style="letter-spacing: 3px; color: var(--secondary);">Established 2001</h6>
                <h1>Pioneering Medical Excellence</h1>
                <p class="lead opacity-75 mx-auto" style="max-width: 700px;">Dedicated to providing world-class healthcare with a human touch. Discover our journey of healing and innovation.</p>
            </div>
        </section>

        <!-- Our Story Section -->
        <section class="section-padding">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="about-image-stack">
                            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Hospital" class="about-image-main">
                            <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" alt="Medical Tech" class="about-image-sub">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h6 class="text-uppercase fw-bold mb-3" style="color: var(--primary-light);">OUR JOURNEY</h6>
                        <h2 class="fw-bold mb-4 fs-1">Two Decades of Compassionate Care</h2>
                        <p class="mb-4">Founded in 2001, City Central Hospital began with a simple yet profound vision: to provide the community with accessible, high-quality medical services that treat the person, not just the symptoms.</p>
                        <p class="mb-5">Over the years, we have grown from a small clinic into a leading multi-specialty hospital, equipped with state-of-the-art diagnostic tools and a team of globally recognized experts. Despite our growth, our core philosophy remains unchanged: every patient deserves excellence.</p>
                        
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fa-solid fa-check-circle text-primary fs-3"></i>
                                    <span class="fw-bold">Accredited Excellence</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fa-solid fa-check-circle text-primary fs-3"></i>
                                    <span class="fw-bold">24/7 Expert Support</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fa-solid fa-check-circle text-primary fs-3"></i>
                                    <span class="fw-bold">Modern Facilities</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fa-solid fa-check-circle text-primary fs-3"></i>
                                    <span class="fw-bold">Global Standards</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission Vision Section -->
        <section class="section-padding" style="background: var(--bg-page);">
            <div class="container">
                <div class="mission-vision">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="mv-tab">
                                <h3 class="fw-bold mb-4">Our Mission</h3>
                                <p class="mb-5 opacity-75">To enhance the health and well-being of the communities we serve by providing high-quality, compassionate care through clinical excellence and innovative medical practices.</p>
                                
                                <hr class="mb-5 opacity-25">
                                
                                <h3 class="fw-bold mb-4">Our Vision</h3>
                                <p class="mb-0 opacity-75">To be the hospital of choice for patients, physicians, and employees because of our preeminent patient care and treatment outcomes.</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mv-image"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="container" style="margin-top: -50px; position: relative; z-index: 10;">
            <div class="stats text-center">
                <div class="row g-4">
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <h3 class="counter" data-target="25">25</h3>
                            <p>Years Excellence</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <h3 class="counter" data-target="500">500</h3>
                            <p>Expert Doctors</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <h3 class="counter" data-target="15000">15k+</h3>
                            <p>Happy Patients</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <h3 class="counter" data-target="100">100</h3>
                            <p>Global Awards</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Core Values Section -->
        <section class="section-padding">
            <div class="container text-center">
                <h6 class="text-uppercase fw-bold mb-3" style="color: var(--primary-light);">WHAT WE STAND FOR</h6>
                <h2 class="fw-bold mb-5 fs-1">Our Core Values</h2>
                
                <div class="row g-4 text-start">
                    <div class="col-lg-4 col-md-6">
                        <div class="value-card">
                            <div class="value-icon"><i class="fa-solid fa-heart-pulse"></i></div>
                            <h4 class="fw-bold mb-3">Integrity</h4>
                            <p class="mb-0 opacity-75">We maintain the highest ethical standards in all our medical practices and patient interactions.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="value-card">
                            <div class="value-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                            <h4 class="fw-bold mb-3">Compassion</h4>
                            <p class="mb-0 opacity-75">Treating every patient with empathy, kindness, and respect as if they were our own family.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="value-card">
                            <div class="value-icon"><i class="fa-solid fa-microscope"></i></div>
                            <h4 class="fw-bold mb-3">Innovation</h4>
                            <p class="mb-0 opacity-75">Constantly embracing new medical technologies and research to improve patient outcomes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section-padding" style="background: var(--bg-white);">
            <div class="container">
                <div class="glass-card p-5 text-center shadow-lg border-0" style="background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white;">
                    <h2 class="fw-bold fs-1 mb-4">Join Our Medical Community</h2>
                    <p class="fs-5 mb-5 opacity-75">Experience the future of healthcare today with our expert medical team.</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('appointment') }}" class="btn btn-primary" style="background: white; color: var(--primary);">BOOK AN APPOINTMENT</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline" style="border-color: white; color: white;">CONTACT US</a>
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
                        <h4>Services</h4>
                        <ul class="p-0">
                            <li><a href="#">Cardiology</a></li>
                            <li><a href="#">Neurology</a></li>
                            <li><a href="#">Pediatrics</a></li>
                            <li><a href="#">Orthopedics</a></li>
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