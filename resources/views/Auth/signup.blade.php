@extends('layouts.master')
@section('title', 'Sign up')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/Auth/auth.css') }}">
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .form-title {
            color: #0d6efd;
            font-weight: 600;
        }
        .form-subtitle {
            color: #6c757d;
        }
        .form-control {
            border-radius: 0.375rem;
            box-shadow: none;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        .btn-primary {
            border-radius: 0.375rem;
        }
        .toggle-icon {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid overflow-hidden py-4">
        <div class="company-logo text-center mb-4">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="logo-img" class="img-fluid mx-auto" style="max-height: 100px;">
                <p class="form-title fs-2 mt-2">Graces Dental Clinic</p>
            </a>
            <p class="form-subtitle fs-4 mb-1">Sign up</p>
            <p class="form-subtitle fs-6 mb-1">Please enter your credentials below.</p>
            <p class="form-subtitle fs-6">Already have an account? <a href="{{ route('signin') }}" class="text-primary fw-semibold">Sign in</a></p>
        </div>

        <div class="form-container bg-info p-4 rounded shadow">
            <form action="{{ route('storeData') }}" method="POST" id="signupForm">
                @csrf
                <div class="row g-1 mb-2">
                    <div class="col-md-4">
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name*" required>
                        @error('firstname') <div class="text-danger"><small>{{ $message }}</small></div> @enderror
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name*" required>
                        @error('lastname') <div class="text-danger"><small>{{ $message }}</small></div> @enderror
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="M.I (Optional)">
                        @error('middle_name') <div class="text-danger"><small>{{ $message }}</small></div> @enderror
                    </div>
                </div>

                <div class="mb-2">
                    <input type="text" name="home_address" id="home_address" class="form-control" placeholder="Permanent Address*" required>
                    @error('home_address') <div class="text-danger"><small>{{ $message }}</small></div> @enderror
                </div>

                <div class="row g-1 mb-2">
                    <div class="col-md-6">
                        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" required>
                        @error('phone_number') <div class="text-danger"><small>{{ $message }}</small></div> @enderror
                    </div>
                    <div class="col-md-6">
                        <input type="date" name="birthdate" id="birthdate" class="form-control" placeholder="Birthday" required>
                        @error('birthdate') <div class="text-danger"><small>{{ $message }}</small></div> @enderror
                    </div>
                </div>

                <div class="row g-1 mb-2">
                    <div class="col-md-6">
                        <input type="number" name="age" id="age" class="form-control" placeholder="Age*" readonly>
                        @error('age') <div class="text-danger"><small>{{ $message }}</small></div> @enderror
                    </div>
                    <div class="col-md-6">
                        <select class="form-select" name="sex" id="sex" required>
                            <option disabled selected>Gender*</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Prefer not to Say">Prefer not to say</option>
                        </select>
                        @error('sex') <div class="text-danger"><small>{{ $message }}</small></div> @enderror
                    </div>
                </div>

                <div class="row g-1 mb-2">
                    <div class="col-md-6">
                        <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Occupation*" required>
                        @error('occupation') <div class="text-danger"><small>{{ $message }}</small></div> @enderror
                    </div>
                    <div class="col-md-6">
                        <select class="form-select" name="marital_status" id="marital_status" required>
                            <option disabled selected>Marital Status*</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widow">Widow</option>
                            <option value="Prefer not to Say">Prefer not to say</option>
                        </select>
                        @error('marital_status') <div class="text-danger"><small>{{ $message }}</small></div> @enderror
                    </div>
                </div>

                <div class="mb-2">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email*" required>
                    @error('email') <div class="text-danger"><small>{{ $message }}</small></div> @enderror
                </div>

                <div class="position-relative mb-2">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password*" required>
                    <i class="fa fa-eye toggle-icon" id="togglePassword"></i>
                    @error('password') <div class="text-danger"><small>{{ $message }}</small></div> @enderror
                </div>

                <div class="mb-3">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password*" required>
                    @error('password_confirmation') <div class="text-danger"><small>{{ $message }}</small></div> @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Sign Up</button>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        document.getElementById('birthdate').addEventListener('change', function () {
            const birthdate = new Date(this.value);
            const today = new Date();
            
            let age = today.getFullYear() - birthdate.getFullYear();
            const monthDiff = today.getMonth() - birthdate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
                age--;
            }
            
            document.getElementById('age').value = age >= 0 ? age : '';
        });
    </script>
@endsection
