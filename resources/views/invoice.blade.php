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
            display: flex;
            justify-content: space-between;
            margin: 16px 0;  /* Smaller margin */
            flex-wrap: wrap;
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
                <p class="text-center fs-3 fw-bold mb-0">Dental Implant Invoice</p>
            </div>
        </div>
         <!-- Invoice Details Section -->
        <div class="invoice-details">
            <div class="bill-to">
                <div class="info-group">
                    <label>Bill to</label>
                </div>
                <div class="info-group">
                    <label>Name:</label>
                    <span>{{$patient->firstname}} {{$patient->middle_initial}} {{$patient->lastname}}</span>
                </div>
                <div class="info-group">
                    <label>Street Address:</label>
                    <span>{{$patient->home_address}}</span>
                </div>
                <div class="info-group">
                    <label>Phone:</label>
                    <span>{{'0' . $patient->phone_number}}</span>
                </div>
            </div>
            <div class="invoice-info">
                <div class="info-group">
                    <label>Invoice No:</label>
                    <span>{{$invoiceId}}</span>
                </div>
                <div class="info-group">
                    <label>Date:</label>
                    <span>{{ now()->format('F j, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Table Section -->
            <div class="container-lg">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tooth</th>
                            <th scope="col">Surface</th>
                            <th scope="col">Fee</th>
                            <th scope="col">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ( $paymentAppointments as $paymentAppointment )
                        <tr>
                            <td>{{$paymentAppointment->tooth}}</td>
                            <td>{{$paymentAppointment->surface}}</td>
                            <td>{{$paymentAppointment->fee}}</td>
                            <td>{{$paymentAppointment->balance}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <h3>Payment History</h3>
               <!-- Table Section -->
            <div class="container-lg">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tooth</th>
                            <th scope="col">Payment Date</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Reference Number</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ( $paymentAppointments as $paymentAppointment )
                        @foreach ( $paymentAppointment->items as $item )
                            <tr>
                                <td>{{$paymentAppointment->tooth}}</td>
                                <td>{{ \Carbon\Carbon::parse($item->payment_date)->format('F j, Y') }}</td>
                                <td>{{ $item->paid }}</td>
                                <td>{{ $item->payment_method }}</td>
                                <td>{{ $item->ref_number ?? 'Not G-cash MOP' }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
      
    </div>
</body>
</html>
