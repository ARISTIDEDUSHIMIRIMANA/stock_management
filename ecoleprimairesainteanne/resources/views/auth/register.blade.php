@extends('layouts.app')

@section('title', 'Register')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 1rem;
        padding: 2.5rem;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: #ffffff;
    }

    .glass-card label,
    .glass-card .form-control {
        color: #ffffff;
    }

    .glass-card .form-control::placeholder {
        color: #cccccc;
    }

    .btn-gradient {
        background: linear-gradient(to right, #ff416c, #ff4b2b);
        color: white;
        border: none;
    }

    .btn-gradient:hover {
        background: linear-gradient(to right, #ff4b2b, #ff416c);
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #ff4b2b;
    }

    a.text-link {
        color: #ffaeae;
        text-decoration: underline;
    }

    a.text-link:hover {
        color: #ffffff;
    }

    /* Footer Styles */
    .custom-footer {
        background: #111827;
        color: #cbd5e1;
        padding: 2rem 0;
        margin-top: 5rem;
        border-top: 1px solid #334155;
    }

    .custom-footer h5 {
        color: #f472b6;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .custom-footer a {
        color: #94a3b8;
        text-decoration: none;
    }

    .custom-footer a:hover {
        color: #f9fafb;
        text-decoration: underline;
    }

    .footer-divider {
        border-top: 1px dashed #475569;
        margin: 2rem 0;
    }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="col-md-8 col-lg-6">
        <div class="glass-card">
            <div class="text-center mb-4">
                <h2 class="fw-bold">Create Store Manager Account</h2>
                <p style="color: #ddd;">Fill in the form below to create your account</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="role" value="store_manager">

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-secondary text-white"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control bg-transparent border-secondary @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-secondary text-white"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control bg-transparent border-secondary @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-secondary text-white"><i class="fas fa-phone"></i></span>
                        <input type="tel" class="form-control bg-transparent border-secondary @error('phone') is-invalid @enderror"
                            id="phone" name="phone" value="{{ old('phone') }}" required>
                    </div>
                    @error('phone')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-secondary text-white"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control bg-transparent border-secondary @error('password') is-invalid @enderror"
                            id="password" name="password" required>
                    </div>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                    <div class="form-text text-white">Password must be at least 8 characters long</div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-secondary text-white"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control bg-transparent border-secondary"
                            id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-gradient btn-lg">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p class="mb-0">Already have an account? 
                    <a href="{{ route('login') }}" class="text-link">Login here</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Custom Footer Section -->
<footer class="custom-footer">
    <div class="container text-center">
        <h5>Ecole Primaire Sainte Anne</h5>
        <p>Empowering school kitchens with real-time stock management</p>
        <div class="footer-divider"></div>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Use</a>
            <a href="#">Support</a>
        </div>
        <p class="mt-3 small">© {{ date('Y') }} Sainte Anne Kitchen System. All rights reserved.</p>
    </div>
</footer>
@endsection
