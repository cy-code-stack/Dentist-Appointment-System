<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Print</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
            padding: 0;
            font-size: 12px;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .header img {
            max-width: 80px;
        }

        .header h2 {
            font-size: 18px;
            margin: 5px 0;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .payment-history h3 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ public_path('images/logo.png') }}" alt="company-logo">
            <h2>Grace's Dental Clinic</h2>
            <h3>Dental Invoice</h3>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details">
            <div class="left">
                <p><label>Bill to</label></p>
                <p><label>Name:</label> {{ $patient->firstname }} {{$patient->middle_initial}}. {{$patient->lastname}}</p>
                <p><label>Email:</label> {{ $patient->email }}</p>
                <p><label>Service Rendered:</label> {{$services->services_name}}</p>
                <p><label>Address:</label> {{$patient->home_address}}</p>
                <p><label>Phone:</label> {{'0' . $patient->phone_number}}</p>
            </div>
            <div class="right">
                <p><label>Marital Status:</label> {{ $patient->occupation }}</p>
                <p><label>Occupation:</label> {{ $patient->marital_status }}</p>
                <p><label>Gender:</label> {{ $patient->sex }}</p>
                <p><label>Invoice No:</label> {{$invoiceId}}</p>
                <p><label>Date:</label> {{ now()->format('F j, Y') }}</p>
            </div>
        </div>

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th>Tooth</th>
                    <th>Surface</th>
                    <th>Fee</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $paymentAppointments as $paymentAppointment )
                <tr>
                    <td>{{$paymentAppointment->tooth}}</td>
                    <td>{{$paymentAppointment->surface}}</td>
                    <td>{{number_format($paymentAppointment->fee)}}</td>
                    <td>{{number_format($paymentAppointment->balance)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Payment History -->
        <div class="payment-history">
            <h3>Payment History</h3>
            <table>
                <thead>
                    <tr>
                        <th>Tooth</th>
                        <th>Payment Date</th>
                        <th>Paid</th>
                        <th>Payment Method</th>
                        <th>Reference Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $paymentAppointments as $paymentAppointment )
                        @foreach ( $paymentAppointment->items as $item )
                        <tr>
                            <td>{{$paymentAppointment->tooth}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->payment_date)->format('F j, Y') }}</td>
                            <td>{{ number_format($item->paid) }}</td>
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
