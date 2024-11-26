@extends('layouts.master')
@section('title', 'Sign up')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/Auth/auth.css') }}">
@endsection

@section('content')
    <div class="container-fluid overflow-hidden">
        <div class="company-logo align-items-center text-center py-1">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="logo-img" class="image-fluid mx-auto d-block mt-2" style="max-height: 130px;">
                <p class="text-primary fw-semibold fs-2 mb-0">Graces Dental Clinic</p>
            </a>
            <p class="fs-4 fw-medium mb-0">Sign up</p>
            <p class="fs-6 mb-0">Please enter your credentials in the input.</p>
            <p class="fs-6 mb-0">Already have an account? <a href="{{ route('signin') }}" class="fw-semibold text-primary">Sign in</a></p>
        </div>

        <div class="logo-txt-sign-up container d-flex justify-content-center align-items-center">
            <div class="sign-up-cont col-12 col-md-10 col-lg-10 bg-info rounded-4 p-3">
                <form action="{{ route('storeData') }}" method="POST" id="signupForm">
                    @csrf
                    <div class="input-container">
                        <div class="d-flex flex-column flex-md-row">
                            <div class="main-cred col-12 col-md-5 mb-3">
                                <div class="input-item">
                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname*" required>
                                    @error('firstname')
                                        <div class="text-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="main-cred col-12 col-md-4 mb-3">
                                <div class="input-item">
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname*" required>
                                    @error('lastname')
                                        <div class="text-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="main-cred col-12 col-md-3 mb-3">
                                <div class="input-item">
                                    <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="M.I (Optional)">
                                    @error('middle_name')
                                        <div class="text-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="input-item mb-2">
                            <input type="text" name="home_address" id="home_address" class="form-control" placeholder="Permanent Address*" required>
                            @error('home_address')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="input-item mb-2">
                            <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="09xxxxxxxxx*" required>
                            @error('phone_number')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="d-flex flex-column flex-md-row justify-content-between mb-2">
                            <div class="input-item col-12 col-md-6 mb-2">
                                <input type="text" name="age" id="age" class="form-control" placeholder="Age*" required>
                                @error('age')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="input-item col-12 col-md-6 mb-2">
                                <select class="form-select" name="sex" id="sex" aria-label="sex" required>
                                    <option selected class="text-black-50">Gender*</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Prefer not to Say">Prefer not to say</option>
                                </select>
                                @error('sex')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-md-row justify-content-between mb-2">
                            <div class="input-item col-12 col-md-6 mb-2">
                                <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Occupation (N/A if not applicable)" required>
                                @error('occupation')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="input-item col-12 col-md-6 mb-2">
                                <select class="form-select" name="marital_status" id="marital_status" aria-label="marital_status" required>
                                    <option selected class="text-black-50">Marital Status*</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widow">Widow</option>
                                    <option value="Prefer not to Say">Prefer not to say</option>
                                </select>
                                @error('marital_status')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                @enderror
                            </div>
                        </div>


                        <div class="input-item mb-2">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email*" required>
                            @error('email')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="input-icon d-flex align-items-center mb-2">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Password">
                                <i class="fa-regular fa-eye text-black-50" id="togglePassword"></i>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-item mb-2">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password*" required>
                            @error('password_confirmation')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="sign-in-btn">
                            <button type="submit" class="btn btn-primary w-100 text-white fs-5 mt-2">Sign up</button>
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
