<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corporate Account - City Central Hospital</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
      <header id="main-header">
        <div class="container">
            <nav>
                <a href="{{ route('home') }}" class="logo">
                    <i class="fa-solid fa-house-medical"></i>
                    <span class="logo-text">CITY CENTRAL</span>
                </a>
                <ul class="nav-links flex-grow-1 justify-content-center mb-0" style="gap: 2.5rem;">
                    <li><a href="{{route('home')}}" class="active">Home</a></li>
                    <li><a href="{{route('about')}}">About</a></li>
                    <li><a href="{{route('service')}}">Services</a></li>
                    <li><a href="#">Doctors</a></li>
                    <li><a href="{{route('contact')}}">Contact</a></li>
                </ul>
                <div class="nav-btns d-flex gap-2 align-items-center">
                    <a href="{{ route('login') }}" class="btn btn-primary">Sign In</a>
                    <a href="{{ route('appointment') }}" class="btn btn-primary">Book Appointment</a>
                </div>
                  
            </nav>
        </div>
    </header>

    <main class="container" style="margin-top: calc(var(--header-height) + 40px);">
        <section class="corporate-section" style="padding: 60px 0;">
            <div style="text-align: center; margin-bottom: 50px;">
                <h1 style="color: var(--primary-color); font-size: 2.5rem; margin-bottom: 20px;">Corporate Healthcare Solutions</h1>
                <p style="max-width: 800px; margin: 0 auto; color: #666; font-size: 1.1rem;">Partner with City Central Hospital for comprehensive health management for your employees. We offer tailored packages to ensure your workforce stays healthy and productive.</p>
            </div>

            <div class="card-grid">
                <div class="card">
                    <i class="fas fa-user-check" style="font-size: 2rem; color: var(--primary-color); margin-bottom: 20px;"></i>
                    <h3>Executive Checkups</h3>
                    <p>Comprehensive health screenings designed for busy executives, focusing on preventive care and early detection.</p>
                </div>
                <div class="card">
                    <i class="fas fa-users" style="font-size: 2rem; color: var(--primary-color); margin-bottom: 20px;"></i>
                    <h3>Group Insurance</h3>
                    <p>Seamless integration with major insurance providers to provide hassle-free medical services for your staff.</p>
                </div>
                <div class="card">
                    <i class="fas fa-building" style="font-size: 2rem; color: var(--primary-color); margin-bottom: 20px;"></i>
                    <h3>On-site Clinics</h3>
                    <p>We can help set up and manage medical facilities at your workplace for immediate employee assistance.</p>
                </div>
            </div>

            <div style="margin-top: 60px; background: #f9f9f9; padding: 40px; border-radius: 15px; text-align: center;">
                <h2 style="margin-bottom: 20px;">Interested in a Corporate Partnership?</h2>
                <p style="margin-bottom: 30px;">Contact our corporate relations team to discuss how we can support your organization's health needs.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us Today</a>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>City Central Hospital</h4>
                    <p>Commitment to care, compassion, and innovation in healthcare for over 20 years.</p>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('service') }}">Services</a></li>
                        <li><a href="{{ route('corporate') }}">Corporate</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <p><i class="fas fa-phone"></i> +1 234 567 890</p>
                    <p><i class="fas fa-envelope"></i> info@cityhospital.com</p>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Health Ave, Medic City</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 City Central Hospital. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>
