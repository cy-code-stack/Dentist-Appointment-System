@extends('layouts.master')
@section('title', 'Sign in')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/Auth/auth.css') }}">
@endsection

@section('content')
    <div class="container-fluid min-vh-100">
        <!-- Company Logo and Description -->
        <div class="company-logo text-center py-4">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="logo-img" class="img-fluid mx-auto d-block" style="max-height: 100px;">
                <p class="text-primary fw-semibold fs-2 mb-0">Graces Dental Clinic</p>
            </a>
            <p class="fs-4 fw-medium">Sign in</p>
            <p class="fs-6">Make certain that your account is already verified before entering your credentials.</p>
        </div>

        <!-- Sign-In Form -->
        <div class="logo-txt container d-flex flex-column justify-content-center align-items-center mt-4">
            <!-- Form Section -->
            <div class="col-12 col-lg-7 bg-info rounded-4 p-4">
                <form action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    <div class="input-container mt-3">
                        <!-- Email Input -->
                        <div class="input-item mb-3">
                            <label for="email" class="form-label text-white">Email</label>
                            <input type="email" name="email" id="email" class="form-control p-3" placeholder="E-mail">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Password Input -->
                        <div class="input-item mb-2">
                            <label for="" class="form-label text-white">Password</label>
                            <div class="input-icon d-flex align-items-center">
                                <input type="password" name="password" id="password" class="form-control p-3"
                                    placeholder="Password">
                                <i class="fa-regular fa-eye text-black-50" id="togglePassword"></i>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="mb-3 d-flex justify-content-end">
                            <a href="{{ route('forgot') }}">
                                <p class="text-white fs-6">Forgot Password?</p>
                            </a>
                        </div>

                        <!-- Submit Button and Sign-up Link -->
                        <div class="sign-in-btn mb-3">
                            <button type="submit" class="btn w-100 btn-primary text-white fs-5 mt-2 mb-3">Sign in</button>
                            <p class="fs-6 text-center mb-3">
                                <small class="me-2">Don't have an account?</small>
                                <a href="{{ route('signup') }}" class="fw-semibold text-white"><small>Sign up</small></a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
    
        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye icon class
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    
@endsection
