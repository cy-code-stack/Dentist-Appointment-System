<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif !important;
        font-size: 10.5pt !important;
    }
    p, td, th{
        padding: 0;
        margin: 0;
    }
    .page-break {
        page-break-after: always;
    }
    .line{
        display: block;
        width: 15rem;
        border-bottom: 1px solid #000000;
        z-index: 100 !important;
        background-size: cover;
        background-color: transparent;
        mix-blend-mode: multiply !important;
    }
</style>
@stack('top-script')
<body>
    <div>
        <div class="d-flex align-items-center">
            <div class="col col-lg-12">
                <div style="text-align: center;">
                    <img src="{{ asset('images/logo.png') }}" alt="company-logo" width="100" style="display: block; margin: 0 auto;">
                    <p class="mb-0 fw-semibold" style="font-size: 30px; font-weight: bolder; text-align: center;">Graces Dental Clinic</p>
                    <p class="mb-0 fw-semibold" style="font-size: 18px; font-weight: bold; text-align: center;">Appointment History</p>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>