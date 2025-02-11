@extends('layouts.master')
@section('title', 'Verify')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/Auth/auth.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-2">
        <div class="company-logo align-items-center">
            <img src="{{ asset('images/logo.png') }}" alt="logo-img" class="image-fluid mx-auto d-block mt-2" height="130">
            <p class="text-primary text-center fw-semibold fs-2 mb-0">Graces Dental Clinic</p>
            <p class="fs-4 fw-medium text-center mb-0">One time Password</p>
        </div>
        <form action="{{ route('acc-verify') }}" method="POST">
            <div class="main-verify-container">
                <div class="verify-card p-5 rounded-3">
                    <div class="d-flex flex-column justify-content-center align-itemas-center">
                        <p class="text-break fs-3 fw-medium">Verify using OTP</p>
                        <p class="text-break text-center mb-1">A One Time Password has been sent to your registered email.</p>
                        <p class="text-center mb-2">
                            Didn't receive a code? 
                            <a href="javascript:void(0);" id="resendOtp" class="text-primary fw-semibold">Resend OTP</a>
                            <span id="timer" class="text-muted" style="display: none;"></span>
                        </p>
                        @if (session('incorrect'))
                            <div class="fw-medium text-danger text-center text-break mb-2">{{ session('incorrect') }}</div>
                        @elseif (session('expired'))
                            <div class="fw-medium text-danger text-center text-break mb-2">{{ session('expired') }}</div>
                        @endif
                        @csrf
                        <input type="text" name='token' class="form-control mb-1 form-control-lg" placeholder="OTP">
                    </div>
                    @error('token')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    
                    <div class="d-flex justify-content-end mt-2">
                        <button type="submit" class="btn btn-primary btn-lg text-white w-100">Verify</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const resendBtn = document.getElementById('resendOtp');
            const timerEl = document.getElementById('timer');
            let countdown = localStorage.getItem('otpCountdown') ? parseInt(localStorage.getItem('otpCountdown')) : 0;
            let interval;

            function startCountdown() {
                resendBtn.style.display = 'none';
                timerEl.style.display = 'inline';
                interval = setInterval(() => {
                    countdown--;
                    timerEl.textContent = `Resend in ${countdown}s`;
                    localStorage.setItem('otpCountdown', countdown);

                    if (countdown <= 0) {
                        clearInterval(interval);
                        timerEl.style.display = 'none';
                        resendBtn.style.display = 'inline';
                        localStorage.removeItem('otpCountdown');
                    }
                }, 1000);
            }

            // Restore countdown if it was running
            if (countdown > 0) {
                startCountdown();
            }

            resendBtn.addEventListener('click', function () {
                fetch("{{ route('resend-otp') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        countdown = 60; // Reset countdown
                        startCountdown();
                    } else {
                        alert("Error resending OTP. Please try again later.");
                    }
                }).catch(() => {
                    alert("Network error.");
                });
            });
        });
    </script>
@endsection
