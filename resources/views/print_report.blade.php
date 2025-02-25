<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1, h2 { text-align: center; }
        h2 { border-bottom: 2px solid black; padding-bottom: 5px; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
        .report-header { text-align: center; margin-bottom: 20px; }
        .report-header img { width: 100px; display: block; margin: 0 auto; }
        .clinic-name { font-size: 30px; font-weight: bolder; }
        .report-title { font-size: 18px; font-weight: bold; }
    </style>
</head>
<body>

    <!-- Report Header -->
    <div class="report-header">
        <img src="{{ asset('images/logo.png') }}" alt="company-logo">
        <p class="clinic-name">Graces Dental Clinic</p>
        <p class="report-title">Admin Reports</p>
    </div>

    <!-- Patient Count Section -->
    <h2>Patient Count Report</h2>
    <table>
        <tr>
            <th>Month</th>
            <th>Count</th>
        </tr>
        @foreach ($patientCount as $month => $count)
            <tr>
                <td>{{ \Carbon\Carbon::create()->month($month)->format('F') }}</td> <!-- Converts number to month name -->
                <td>{{ $count }}</td>
            </tr>
        @endforeach
    </table>

    <!-- Appointment Percentage Section -->
    <h2>Appointment Percentage Report</h2>
    <table>
        <tr>
            <th>Month</th>
            <th>Percentage (%)</th>
        </tr>
        @foreach ($appointmentPercentage as $month => $percentage)
            <tr>
                <td>{{ \Carbon\Carbon::create()->month($month)->format('F') }}</td>
                <td>{{ $percentage }}%</td>
            </tr>
        @endforeach
    </table>

    <!-- Top Services Section -->
    <h2>Top Services Report</h2>
    <table>
        <tr>
            <th>Service ID</th>
            <th>Service Name</th>
            <th>Count</th>
        </tr>
        @foreach ($topServices as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->services_name }}</td>
                <td>{{ $service->services_count }}</td>
            </tr>
        @endforeach
    </table>

    <!-- Sales Report Section -->
    <h2>Sales Report</h2>
    <table>
        <tr>
            <th>Month</th>
            <th>Total Sales (PHP)</th>
        </tr>
        @foreach ($salesData as $month => $total_fee)
            <tr>
                <td>{{ \Carbon\Carbon::create()->month($month)->format('F') }}</td>
                <td>{{ number_format($total_fee, 2) }}</td>
            </tr>
        @endforeach
    </table>

</body>
</html>
