@extends('layouts.master')
@section('title', 'Sign up')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/Auth/auth.css') }}">
@endsection

@section('content')
    <div class="container-fluid overflow-hidden">
        <div class="company-logo align-items-center">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="logo-img" class="image-fluid mx-auto d-block mt-2" height="130">
                <p class="text-primary text-center fw-semibold fs-2 mb-0">Graces Dental Clinic</p>
            </a>
            <p class="fs-4 fw-medium text-center mb-0">Sign up</p>
                <p class="fs-6 text-center mb-0">Please enter your credentials in the input.</p>
                <p class="fs-6 text-center mb-0">Already have an account? <a href="{{ route('signin') }}"
                        class="fw-semibold text-primary">Sign in</a></p>
        </div>
        <div class="logo-txt-sign-up container d-flex justify-content-center align-items-center">
            <div class="sign-up-img col col-lg-5 d-flex flex-column d-flex justify-content-center align-items-center bg-white">
                <img src="{{ asset('images/sign-in.png') }}" class="image-fluid mx-auto d-block" alt="sign-up-logo">
            </div>
            <div class="sign-up-cont  col col-lg-7 bg-info rounded-end-4 p-3 d-flex justify-content-center align-items-center">
                <form action="{{ route('storeData') }}" method="POST" id="signupForm">
                    @csrf
                    <div class="input-container">
                        <div class="d-flex">
                            <div class="main-cred col-lg-5">
                                <div class="input-item mb-2">
                                    {{-- <label for="" class="form-label text-white">Firstname</label> --}}
                                    <div class="input-icon d-flex align-items-center">
                                        <input type="text" name="firstname" id="firstname" class="form-control me-2" placeholder="Firstname*">
                                    </div>
                                    @error('firstname')
                                        <div class="text-danger"><small class="mb-0 p-0">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="main-cred col-lg-4">
                                <div class="input-item mb-2">
                                    {{-- <label for="" class="form-label text-white">Lastname</label> --}}
                                    <div class="input-icon d-flex align-items-center">
                                        <input type="text" name="lastname" id="lastname" class="form-control me-2" placeholder="Lastname*">
                                    </div>
                                    @error('lastname')
                                        <div class="text-danger"><small class="mb-0 p-0">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="main-cred col-lg-3">
                                <div class="input-item mb-2">
                                    {{-- <label for="" class="form-label text-white">Firstname</label> --}}
                                    <div class="input-icon d-flex align-items-center">
                                        <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="M.I (Optional)">
                                    </div>
                                    @error('middle_name')
                                        <div class="text-danger"><small class="mb-0 p-0">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="input-item mb-2">
                            {{-- <label for="" class="form-label text-white mb-1">Home Address</label> --}}
                            <div class="input-icon d-flex align-items-center">
                                <input type="text" name="home_address" id="home_address" class="form-control" placeholder="Pernament Address*">
                            </div>
                            @error('home_address')
                                <div class="text-danger"><small class="mb-0 p-0">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="input-item mb-2">
                            {{-- <label for="" class="form-label text-white mb-1">Phone Number</label> --}}
                            <div class="input-icon d-flex align-items-center">
                                <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="09xxxxxxxxx*">
                            </div>
                            @error('phone_number')
                                <div class="text-danger"><small class="mb-0 p-0">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="input-item me-2" style="width: 50%">
                                {{-- <label for="age" class="form-label text-white mb-1">Age</label> --}}
                                <div class="input-icon d-flex align-items-center">
                                    <input type="text" name="age" id="age" class="form-control" placeholder="Age*">
                                </div>
                                @error('age')
                                    <div class="text-danger"><small class="mb-0 p-0">{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="input-item" style="width: 50%">
                                {{-- <label for="sex" class="form-label text-white mb-1">Gender</label> --}}
                                <select class="form-select" name="sex" id="sex" aria-label="sex">
                                    <option selected class="text-black-50">Gender*</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value=">Prefer not to Say">Prefer not to say</option>
                                </select>
                            </div>
                            @error('sex')
                                <div class="text-danger"><small class="mb-0 p-0">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="input-item me-2" style="width: 50%">
                                {{-- <label for="occupation" class="form-label text-white mb-1">Occupation(Optional)</label> --}}
                                <div class="input-icon d-flex align-items-center">
                                    <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Occupation type N/A (if not applicable)* ">
                                </div>
                                @error('occupation')
                                    <div class="text-danger"><small class="mb-0 p-0">{{ $message }}</small></div>
                                @enderror
                            </div>
                            <div class="input-item" style="width: 50%">
                                {{-- <label for="marital_status" class="form-label text-white mb-1">Marital Status</label> --}}
                                <select class="form-select" name="marital_status" id="marital_status" aria-label="marital_status">
                                    <option selected class="text-black-50">Marital Status*</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widow">Widow</option>
                                    <option value="Prefer not to Say">Prefer not to say</option>
                                </select>
                            </div>
                            @error('marital_status')
                                <div class="text-danger"><small class="mb-0 p-0">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="input-item mb-2">
                            {{-- <label for="" class="form-label text-white mb-1">Email</label> --}}
                            <div class="input-icon d-flex align-items-center">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email*">
                            </div>
                            @error('email')
                                <div class="text-danger"><small class="mb-0 p-0">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="input-item mb-2">
                            {{-- <label for="" class="form-label text-white mb-1">Password</label> --}}
                            <div class="input-icon d-flex align-items-center">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password*">
                                <i class="fa-regular fa-eye text-black-50" id="togglePassword"></i>
                            </div>
                            @error('password')
                                <div class="text-danger"><small class="mb-0 p-0">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="input-item mb-2">
                            {{-- <label for="" class="form-label text-white mb-1">Confirm Password</label> --}}
                            <div class="input-icon d-flex align-items-center">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Confirm Password*">
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger"><small class="mb-0 p-0">{{ $message }}</small></div>
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
