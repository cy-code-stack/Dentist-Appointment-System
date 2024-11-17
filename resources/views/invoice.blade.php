<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Print</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        .container-fluid {
            width: 100%;
            padding: 16px;
        }

        .d-flex {
            display: flex;
        }

        .d-grid {
            display: grid;
        }

        .align-items-center {
            align-items: center;
        }

        .flex-column {
            flex-direction: column;
        }

        .justify-content-center {
            justify-content: center;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .gap-1 {
            gap: 4px;
        }

        .gap-3 {
            gap: 12px;
        }

        .col-lg-2 {
            flex: 1;
            max-width: 16.666667%;
        }

        .col-lg-10 {
            flex: 4;
            max-width: 83.333333%;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .mb-4 {
            margin-bottom: 16px;
        }

        .py-2 {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .fs-3 {
            font-size: 1.75rem;
        }

        .fs-5 {
            font-size: 1.25rem;
        }

        .fw-bold {
            font-weight: 700;
        }

        .fw-semibold {
            font-weight: 600;
        }

        .text-center {
            text-align: center;
        }

        .container {
            width: 100%;
            max-width: 960px;
            margin: 0 auto;
            padding: 0 16px;
        }

        .container-lg {
            width: 100%;
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 16px;
        }

        .inline-block {
            display: inline-block;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 5px;
            text-align: left;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .form-label {
            font-weight: 400 !important;
            margin-right: 4px;
        }

        /* Flex Enhancements */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            margin-bottom: 16px;
            border-bottom: 1px solid #ccc;
        }

        .header-left {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 4px;
        }

        .header-right {
            text-align: center;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin: 16px 0;
        }

        .bill-to, .invoice-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-width: 48%;
        }

        .info-group {
            display: flex;
            gap: 8px;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-2">
        <!-- Header Section -->
        <div class="header">
            <div class="header-left">
                <img src="../public/images/logo.png" alt="company-logo" width="100">
                <p class="mb-0 fs-5 fw-semibold">Graces Dental Clinic</p>
            </div>
            <div class="header-right">
                <p class="text-center fs-3 fw-bold mb-0" style="letter-spacing: 2px;">Dental Implant Invoice</p>
            </div>
        </div>

        <!-- Invoice Details Section -->
        <div class="invoice-details">
            <div class="bill-to">
                <div class="info-group">
                    <label class="form-label">Bill to</label>
                </div>
                <div class="info-group">
                    <label class="form-label">Name: <span>{{ $record->appointment->patient?->firstname }} {{ $record->appointment->patient?->middle_initial }} {{ $record->appointment->patient?->lastname }}</span></label>
                </div>
                <div class="info-group">
                    <label class="form-label">Street Address: <span>{{ $record->appointment->patient?->home_address }}</span></label>
                </div>
                <div class="info-group">
                    <label class="form-label">Phone: <span>{{ '0' . $record->appointment->patient?->phone_number }}</span></label>
                </div>
            </div>
            <div class="invoice-info">
                <div class="info-group">
                    <label class="form-label">Invoice No: <span>{{ $record->id }}</span></label>
                </div>
                <div class="info-group">
                    <label class="form-label">Date:  <span>{{ now()->format('F j, Y') }}</span></label>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="container-lg">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Tooth</th>
                        <th scope="col">Surface</th>
                        <th scope="col">Treatment Rendered</th>
                        <th scope="col">Fee</th>
                        <th scope="col">Paid</th>
                        <th scope="col">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($record->paymentItems as $paymentItem)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($paymentItem?->date)->format('F j, Y') }}</td>
                            <td>{{ $paymentItem?->tooth }}</td>
                            <td>{{ $paymentItem?->surface }}</td>
                            <td>{{ $paymentItem?->treatment_rendered }}</td>
                            <td>{{ $paymentItem?->fee }}</td>
                            <td>{{ $paymentItem?->paid }}</td>
                            <td>{{ $paymentItem?->balance }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
