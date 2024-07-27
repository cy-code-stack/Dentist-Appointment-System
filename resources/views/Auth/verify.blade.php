@extends('layouts.master')
@section('title', 'Verify')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/Auth/auth.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-2">
        <form action="{{ route('acc-verify') }}" method="POST">
            <div class="main-verify-container">
                <div class="verify-card p-4 rounded-3">
                    <div class="d-flex flex-column justify-content-center align-itemas-center">
                        <p class="text-break fs-3 fw-medium">Verify using OTP</p>
                        <p class="text-break text-center fs-6 mb-2">A One Time Password has been sent to your registered email.</p>
                        @if (session('incorrect'))
                            <div class="fw-medium text-danger text-center text-break mb-2">{{ session('incorrect') }}</div>
                        @elseif (session('expired'))
                            <div class="fw-medium text-danger text-center text-break mb-2">{{ session('expired') }}</div>
                        @endif
                        @csrf
                        <input type="text" name='token' class="form-control mb-2" placeholder="Enter the code here">
                    </div>
                    @error('token')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    
                    <div class="d-flex justify-content-end mt-2">
                        <button type="submit" class="btn btn-info text-white">Verify</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
