<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Declined Appointment</title>
</head>
<body>
    <h2>Your Appointment has been Declined</h2>
    <p>Hello {{ $appoint->patient->firstname }} {{ $appoint->patient->lastname }},</p>
    <p>Your appointment has been declined. Here is the reason:</p>
    <ul>
        <li>Service: <b>{{ $servicesName }}</b></li>
        <li>Reason: <b>{{ $appoint->abort_reason }}</b></li>
        <li>Status: <b>{{ $appoint->appnt_status }}</b></li>
    </ul>
    <p>Thank you!</p>
</body>
</html>