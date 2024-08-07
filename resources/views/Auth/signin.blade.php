@extends('layouts.master')
@section('title', 'Sign in')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/Auth/auth.css') }}">
@endsection

@section('content')
    <div class="container-fluid min-vh-100">
        <div class="company-logo  align-items-center">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="logo-img" class="image-fluid mx-auto d-block mt-2" height="130">
                <p class="text-primary text-center fw-semibold fs-2 mb-0">Graces Dental Clinic</p>
            </a>
            <p class="fs-4 fw-medium text-center">Sign in</p>
                <p class="fs-6 text-center">Make certain that your account is verified by the admin before entering your
                    credentials.</p>
                <p class="fs-6 text-center">Don't have an account? <a href="{{ route('signup') }}"
                        class="fw-semibold text-primary">Sign up</a></p>
        </div>
        <div class="logo-txt container d-flex justify-content-center align-items-center">
            <div class="sign-up-img col col-lg-5 d-flex flex-column d-flex justify-content-center align-items-center bg-white">
                <img src="{{ asset('images/sign-in.png') }}" class="image-fluid mx-auto d-block" alt="sign-in-logo">
            </div>
            <div class="col col-lg-5 bg-info rounded-end-4 p-4">
                <form action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    <div class="input-container mt-3">
                        <div class="input-item mb-2">
                            <label for="" class="form-label text-white">Email</label>
                            <div class="input-icon d-flex align-items-center">
                                <input type="email" name="email" id="email" class="form-control p-3"
                                    placeholder="E-mail">
                            </div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
                        <div class="input-item mb-2 d-flex justify-content-end align-items-center">
                            {{-- <div class="remember-container">
                                <input type="checkbox" class="form-check-input">
                                <label class="form-check-label text-white">Remember</label>
                            </div> --}}
                            <a href="{{ route('forgot') }}">
                                <p class="text-white fs-6">Forgot Password</p>
                            </a>
                        </div>
                        <div class="sign-in-btn mb-2">
                            <button type="submit" class="btn w-100 btn-primary text-white fs-5 mt-2">Sign in</button>
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
