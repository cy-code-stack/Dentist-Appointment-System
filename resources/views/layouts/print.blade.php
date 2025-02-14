<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid py-2">
        <div class="d-flex align-items-center mb-4">
            <div class="col col-lg-2">
                <div class="d-grid d-flex align-items-center flex-column justify-content-center gap-1">
                    <img src="{{ asset('images/logo.png')}}" alt="company-logo" width="80">
                    <p class="mb-0 fs-5 fw-semibold">Graces Dental Clinic</p>
                </div>
            </div>
            <div class="col col-lg-10">
                <p class="text-center fs-3 fw-bold text-black-50 mb-0" style="letter-spacing: 2px;">Dental Invoice</p>
            </div>
        </div>
        @yield('content')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>