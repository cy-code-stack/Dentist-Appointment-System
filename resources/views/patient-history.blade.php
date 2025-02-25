<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Print</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            width: 100%;
            padding: 10px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px 0;  /* Smaller padding */
            margin-bottom: 16px;  /* Smaller margin */
            border-bottom: 2px solid #ddd;
        }

        .header-left {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 4px;  /* Smaller gap */
        }

        .header-right {
            text-align: center;
        }

        .header-left img {
            max-width: 90px;  /* Smaller logo */
        }

        .header-right p {
            font-size: 1.5rem;  /* Smaller font size */
            font-weight: 700;
            letter-spacing: 1px;  /* Adjusted letter spacing */
            margin: 0;
        }
        .invoice-details {
            width: 100%;
            margin-bottom: 15px;
        }

        .invoice-details .left, .invoice-details .right {
            width: 48%;
            display: inline-block;
            vertical-align: top;
        }

        .invoice-details label {
            font-weight: bold;
        }

        .invoice-details p {
            margin: 3px 0;
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

        .info-group label {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .info-group span {
            font-weight: 400;
            color: #333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
            padding: 5px;
        }

        .table th, .table td {
            text-align: left;
            border: 1px solid #dee2e6;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table td {
            font-size: 12px;
        }

        .container-lg {
            width: 100%;
            max-width: 1140px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-2">
        <!-- Header Section -->
        <div class="header">
            <div class="header-left">
                <img src="../public/images/logo.png" alt="company-logo">
                <p class="fs-5 fw-semibold mb-0">Graces Dental Clinic</p>
            </div>
            <div class="header-right">
                <p class="text-center fs-3 fw-bold mb-0">Dental Patient History</p>
            </div>
        </div>

         <!-- Invoice Details Section -->
         <div class="invoice-details">
            <div class="left">
                <p><label>Bill to</label></p>
                <p><label>Name:</label> {{ $patient->firstname }} {{$patient->middle_initial}}. {{$patient->lastname}}</p>
                <p><label>Email:</label> {{ $patient->email }}</p>
                <p><label>Address:</label> {{$patient->home_address}}</p>
                <p><label>Phone:</label> {{'0' . $patient->phone_number}}</p>
            </div>
            <div class="right">
                <p><label>Marital Status:</label> {{ $patient->occupation }}</p>
                <p><label>Occupation:</label> {{ $patient->marital_status }}</p>
                <p><label>Gender:</label> {{ $patient->sex }}</p>
                <p><label>Date:</label> {{ now()->format('F j, Y') }}</p>
            </div>
        </div>
            <div class="container-lg">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Service Rendered</th>
                            <th scope="col">Tooth</th>
                            <th scope="col">Surface</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $item )
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y') }}</td>
                                <td>{{ $item->services->services_name }}</td>
                                <td>{{ $item->tooth }}</td>
                                <td>{{ $item->surface }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</body>
</html>
