<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Doctor Appointment System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            /* Premium Medical Background */
            background-color: #3fafb1;
            color: #d8ebef;
            background-image: url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            position: relative;
        }

        /* Glassmorphism Overlay for the body */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(63, 175, 177, 0.6) 0%, rgba(15, 23, 42, 0.8) 100%);
            z-index: 1;
        }

        .container {
            position: relative;
            z-index: 2;
        }

        .login-wrapper {
            display: flex;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.4);
            max-width: 900px;
            margin: 0 auto;
        }

        .login-image-section {
            background: rgba(255, 255, 255, 0.05);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 50%;
            text-align: center;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Doctor Image Animation Container */
        .img-container {
            position: relative;
            width: 280px;
            height: 280px;
            margin-bottom: 25px;
        }

        /* Decorative animated elements around the image */
        .circle-1,
        .circle-2 {
            position: absolute;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .circle-1 {
            width: 250px;
            height: 250px;
            border: 2px dashed rgba(255, 255, 255, 0.5);
            animation: spin 20s linear infinite;
        }

        .circle-2 {
            width: 280px;
            height: 280px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            animation: pulse-ring 3s ease-out infinite;
        }

        @keyframes spin {
            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        @keyframes pulse-ring {
            0% {
                width: 200px;
                height: 200px;
                opacity: 1;
            }

            100% {
                width: 350px;
                height: 350px;
                opacity: 0;
            }
        }

        /* Floating animation for the doctor image */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animated-doctor-img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #ffffff;
            animation: float 4s ease-in-out infinite;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            z-index: 3;
        }

        /* Floating + symbol */
        .floating-icon {
            position: absolute;
            font-size: 30px;
            color: #fff;
            animation: float 3s ease-in-out infinite;
            z-index: 4;
            filter: drop-shadow(0 5px 10px rgba(0, 0, 0, 0.3));
        }

        .icon-1 {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .icon-2 {
            bottom: 20%;
            right: 10%;
            animation-delay: 1s;
            font-size: 24px;
        }

        .icon-3 {
            top: 30%;
            right: 15%;
            animation-delay: 2s;
            font-size: 20px;
        }

        .login-info h2 {
            color: #ffffff;
            font-weight: 700;
            font-size: 26px;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .login-info p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 15px;
            line-height: 1.6;
        }

        .login-container {
            width: 50%;
            padding: 50px 40px;
            background: rgba(255, 255, 255, 0.95);
            position: relative;
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-header img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin-bottom: 15px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .login-header h3 {
            color: #1e293b;
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .login-header p {
            color: #64748b;
            font-size: 15px;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .input-group-text {
            background-color: transparent;
            border-right: none;
            color: #64748b;
        }

        .form-control {
            padding: 12px 15px;
            font-size: 15px;
            border-radius: 0 8px 8px 0;
            border-left: none;
            border-color: #dee2e6;
            transition: all 0.3s ease;
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: #0d6efd;
            box-shadow: none;
        }

        .input-group-text {
            border-radius: 8px 0 0 8px;
        }

        .btn-primary {
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            letter-spacing: 0.5px;
            background-color: #d8ebef !important;
            background: #d8ebef !important;
            color: #3fafb1 !important;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(63, 175, 177, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(63, 175, 177, 0.4);
            background-color: #c4e4e9 !important;
            background: #c4e4e9 !important;
            color: #3fafb1 !important;
        }

        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }

            .login-image-section,
            .login-container {
                width: 100%;
            }

            .login-image-section {
                padding: 40px 20px;
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .login-container {
                padding: 40px 20px;
            }

            .img-container {
                width: 200px;
                height: 200px;
            }

            .circle-1 {
                width: 180px;
                height: 180px;
            }

            .animated-doctor-img {
                width: 140px;
                height: 140px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-wrapper">
            <!-- Left Side with Animated Doctor Image -->
            <div class="login-image-section position-relative">
                <i class="fas fa-plus-circle floating-icon icon-1"></i>
                <i class="fas fa-heartbeat floating-icon icon-2"></i>
                <i class="fas fa-stethoscope floating-icon icon-3"></i>

                <div class="img-container">
                    <div class="circle-1"></div>
                    <div class="circle-2"></div>
                    <!-- Animated Doctor Image -->
                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=1000&q=80"
                        alt="Doctor Animation" class="animated-doctor-img">
                </div>
                <div class="login-info">
                    <h2>Premium Care</h2>
                    <p>Access your dashboard to manage appointments, connect with patients, and deliver exceptional
                        care.</p>
                </div>
            </div>

            <!-- Right Side with Login Form -->
            <div class="login-container">
                <div class="login-header">
                    <!-- Retaining original logo as per original code context, styled properly -->
                    <img src="image.jpg" alt="Logo" onerror="this.style.display='none'">
                    <h3>Welcome Back login </h3>
                    <p>Enter your credentials to continue</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger border-0 rounded-3 shadow-sm d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <small>{{ $errors->first() }}</small>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" required autofocus placeholder="Email Address">
                        </div>
                        @error('email')
                            <div class="text-danger mt-1 small">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required placeholder="••••••••">
                        </div>
                        @error('password')
                            <div class="text-danger mt-1 small">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-muted" for="remember" style="font-size: 14px;">Remember
                                me</label>
                        </div>
                        <a href="#" class="text-decoration-none"
                            style="font-size: 14px; color: #0d6efd; font-weight: 500; transition: color 0.2s;">Forgot
                            Password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        Sign In <i class="fas fa-arrow-right ms-1"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>