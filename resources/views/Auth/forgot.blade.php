@extends('layouts.master')
@section('title', 'Forgot')
@section('css')
<link rel="stylesheet" href="{{ asset('css/Auth/auth.css') }}">
@endsection

@section('content')
    <div class="container-fluid min-vh-100">
        <div class="forgot-container container d-flex justify-content-center">
            <div class="forgot col-lg-8 rounded-4">
                <img src="{{ asset('images/forgot-pass.png') }}" class="image-fluid mx-auto d-block" alt="forgot-pass">
                <p class="fs-4 fw-medium text-center text-primary">Forgot Password</p>
                <p class="fs-6 text-center">Enter your email and you can reset your password</p>
                <form action="{{ route('user-forgot') }}" method="POST">
                    @csrf
                    <div class="input-container">
                        <div class="input-item mb-3">
                            <label for="" class="form-label">Email</label>
                            <div class="input-icon d-flex align-items-center">
                                <input type="email" name="email" id="email" class="form-control p-3" placeholder="Enter your email" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="active-btn d-md-flex justify-content-md-end">
                            <button class="btn btn-primary" type="submit">Reset your password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection