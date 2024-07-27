@extends('layouts.master')
@section('title', 'Reset')
@section('css')
<link rel="stylesheet" href="{{ asset('css/Auth/auth.css') }}">
@endsection

@section('content')
    <div class="container-fluid min-vh-100">
        <div class="forgot-container container d-flex justify-content-center">
            <div class="forgot col-lg-8 rounded-4">
                <img src="{{ asset('images/forgot-pass.png') }}" class="image-fluid mx-auto d-block" alt="forgot-pass">
                <p class="fs-4 fw-medium text-center text-primary">Reset Password</p>
                <p class="fs-6 text-center">Enter your new and old password</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('changePass') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="container">
                        <div class="input-item">
                            <div class="input-icon align-items-center">
                                <div class="input-item mb-1">
                                    <label for="" class="form-label text-black mb-1">Email</label>
                                    <div class="input-icon d-flex align-items-center">
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Enter your email">
                                    </div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-item mb-1">
                                    <label for="" class="form-label text-black mb-1">New Password</label>
                                    <div class="input-icon d-flex align-items-center">
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Enter your new password">
                                        <i class="fa-regular fa-eye text-black-50" id="togglePassword"></i>
                                    </div>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-item mb-1">
                                    <label for="" class="form-label text-black mb-1">Confirm Password</label>
                                    <div class="input-icon d-flex align-items-center">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control" placeholder="Confirm password">
                                    </div>
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="active-btn d-md-flex mt-3 justify-content-md-end">
                            <button class="btn btn-primary" type="submit">Change your password</button>
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
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection