<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | MediCall Excellence</title>
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
        .contact-hero {
            background: linear-gradient(rgba(29, 131, 127, 0.9), rgba(29, 131, 127, 0.9)), url('https://images.unsplash.com/photo-1516549655169-df83a0774514?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            padding: 160px 0 100px;
            color: white;
            text-align: center;
        }

        .contact-hero h1 {
            font-size: clamp(2.5rem, 6vw, 4rem);
            margin-bottom: 1.5rem;
        }

        .contact-wrapper {
            margin-top: -60px;
            position: relative;
            z-index: 10;
        }

        .info-box {
            background: white;
            padding: 3rem;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            height: 100%;
            border: 1px solid var(--border);
        }

        .contact-form-box {
            background: white;
            padding: 3.5rem;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
        }

        .contact-method {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .method-icon {
            width: 60px;
            height: 60px;
            background: var(--bg-page);
            color: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            transition: var(--transition);
        }

        .contact-method:hover .method-icon {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .form-control {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            transition: var(--transition);
        }

        .form-control:focus {
            background: white;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 4px rgba(29, 131, 127, 0.1);
        }

        .map-container {
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            height: 400px;
            border: 1px solid var(--border);
        }

        @media (max-width: 768px) {
            .contact-form-box, .info-box {
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
                        <li><a href="{{route('contact')}}" class="active">Contact</a></li>
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
        <!-- Contact Hero -->
        <section class="contact-hero">
            <div class="container">
                <h6 class="text-uppercase fw-bold mb-3" style="letter-spacing: 3px; color: var(--secondary);">Get In Touch</h6>
                <h1>We Are Here For You</h1>
                <p class="lead opacity-75 mx-auto" style="max-width: 700px;">Have questions about our services or need to book a specialized consultation? Reach out to our team.</p>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="section-padding" style="background: var(--bg-page);">
            <div class="container">
                <div class="contact-wrapper">
                    <div class="row g-4">
                        <div class="col-lg-5">
                            <div class="info-box">
                                <h3 class="fw-bold mb-5">Contact Information</h3>
                                
                                <div class="contact-method">
                                    <div class="method-icon"><i class="fa-solid fa-location-dot"></i></div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Our Location</h5>
                                        <p class="mb-0 text-muted">18 BEHAN HOUSE, ARDEN ROAD,<br>TULLAMORE, IRELAND</p>
                                    </div>
                                </div>

                                <div class="contact-method">
                                    <div class="method-icon"><i class="fa-solid fa-phone"></i></div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Phone Number</h5>
                                        <p class="mb-0 text-muted">+353 1 960 9912</p>
                                    </div>
                                </div>

                                <div class="contact-method">
                                    <div class="method-icon"><i class="fa-solid fa-envelope"></i></div>
                                    <div>
                                        <h5 class="fw-bold mb-1">Email Address</h5>
                                        <p class="mb-0 text-muted">info@citycentral.ie</p>
                                    </div>
                                </div>

                                <hr class="my-5 opacity-25">

                                <h5 class="fw-bold mb-4">Opening Hours</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Monday - Friday</span>
                                    <span class="fw-bold">08:00 - 20:00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Saturday</span>
                                    <span class="fw-bold">09:00 - 18:00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Sunday</span>
                                    <span class="fw-bold">Emergency Only</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="contact-form-box">
                                <h3 class="fw-bold mb-4">Send Us a Message</h3>
                                <p class="text-muted mb-5">Fill out the form below and our medical administration team will get back to you within 24 hours.</p>
                                
                                <form action="#" method="POST">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-bold small text-uppercase" style="letter-spacing: 1px;">Your Name</label>
                                                <input type="text" class="form-control" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label fw-bold small text-uppercase" style="letter-spacing: 1px;">Email Address</label>
                                                <input type="email" class="form-control" placeholder="example@mail.com">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold small text-uppercase" style="letter-spacing: 1px;">Subject</label>
                                                <input type="text" class="form-control" placeholder="How can we help?">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label fw-bold small text-uppercase" style="letter-spacing: 1px;">Message</label>
                                                <textarea class="form-control" rows="5" placeholder="Tell us more about your inquiry..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="submit" class="btn btn-primary px-5">SEND MESSAGE <i class="fa-solid fa-paper-plane ms-2"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="section-padding pt-0" style="background: var(--bg-page);">
            <div class="container">
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2414.076840673479!2d-7.4878!3d53.273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x485dd0f9b69b5963%3A0x7d6a5e1e1e1e1e1e!2sTullamore%2C%20Co.%20Offaly!5e0!3m2!1sen!2sie!4v1620000000000!5m2!1sen!2sie" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
                <p class="small mb-0">&copy; 2026 City Central Hospital. All rights reserved.</p>
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