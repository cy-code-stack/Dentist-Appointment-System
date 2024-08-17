<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sched Appointment</title>
</head>
<body>
    <h2>Your Appointment has been Rescheduled</h2>
    <p>Hello {{ $appointment->patient->firstname }} {{ $appointment->patient->lastname }},</p>
    <p>Your appointment has been rescheduled. Here are the new details:</p>
    <ul>
        <li>Service: <b>{{ $servicesName }}</b></li>
        <li>Date: <b>{{ $appointment->sched_date }}</b></li>
        <li>Time: <b>{{ $appointment->sched_time }}</b></li>
        <li>Status: <b>{{ $appointment->appnt_status }}</b></li>
    </ul>
    <p>Thank you!</p>
</body>
</html>