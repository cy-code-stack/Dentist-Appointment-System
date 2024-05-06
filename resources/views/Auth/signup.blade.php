@extends('layouts.master')
@section('title', 'Sign up')
@section('css')
<link rel="stylesheet" href="{{ asset('css/Auth/auth.css') }}">
@endsection

@section('content')
<div class="container-fluid min-vh-100">
    <div class="logo-txt container d-flex justify-content-center align-items-center">
        <div class="col col-lg-4 d-flex flex-column d-flex justify-content-center align-items-center bg-white">
            <img src="{{ asset('images/sign-in.png') }}" class="image-fluid mx-auto d-block" alt="login-logo">
            <p class="fs-2 fw-medium text-center">Sign up</p>
            <p class="fs-6 text-center">Please enter your credentials in the input.</p>
        </div>
        <div class="sign-up-cont col col-lg-5 bg-info rounded-end-4 p-4">
            <form action="" method="post">
                <div class="input-container">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="main-cred col-lg-6">
                            <div class="input-item mb-1">
                                <label for="" class="form-label text-white">Firstname</label>
                                <div class="input-icon d-flex align-items-center">
                                    <input type="text" name="fname" id="fname" class="form-control me-2" placeholder="firstname">
                                </div>
                            </div>
                        </div>
                        <div class="main-cred col-lg-6">
                            <div class="input-item mb-1">
                                <label for="" class="form-label text-white">Lastname</label>
                                <div class="input-icon d-flex align-items-center">
                                    <input type="text" name="lname" id="lname" class="form-control" placeholder="lastname">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input-item mb-1">
                        <label for="" class="form-label text-white mb-1">Home Address</label>
                        <div class="input-icon d-flex align-items-center">
                            <input type="text" name="hAddress" id="hAddress" class="form-control" placeholder="Complete Home Address">
                        </div>
                    </div>
                    <div class="input-item mb-1">
                        <label for="" class="form-label text-white mb-1">Phone Number</label>
                        <div class="input-icon d-flex align-items-center">
                            <input type="text" name="phNumber" id="phNumber" class="form-control" placeholder="09123456789">
                        </div>
                    </div>
                    <div class="input-item mb-1">
                        <label for="" class="form-label text-white mb-1">Email</label>
                        <div class="input-icon d-flex align-items-center">
                            <input type="email" name="email" id="email" class="form-control" placeholder="youremail@gmail.com">
                        </div>
                    </div>
                    <div class="input-item mb-1">
                        <label for="" class="form-label text-white mb-1">Password</label>
                        <div class="input-icon d-flex align-items-center">
                            <input type="password" name="password" id="password" class="form-control" placeholder="password">
                        </div>
                    </div>
                    <div class="input-item mb-1">
                        <label for="" class="form-label text-white mb-1">Confirm Password</label>
                        <div class="input-icon d-flex align-items-center">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="password">
                        </div>
                    </div>
                    <div class="sign-in-btn mb-2">
                        <button type="button" class="btn w-100 text-white fs-5 mt-2">Sign up</button>
                    </div>
                </div>
            </form>
            <div class="sign-in-btn">
                <p class="fs-6 mb-1 fw-medium text-dark text-center">Already have an account?</p>
                <a href="{{ route('signin') }}"><button class="btn btn-outline-primary  w-100 text-white fs-5 mt-2">Sign in</button></a>
            </div>
        </div>
    </div>
</div>
@endsection