<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007BFF;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .content {
            padding: 20px;
            line-height: 1.6;
            color: #333333;
        }
        .footer {
            background-color: #f1f1f1;
            color: #555555;
            text-align: center;
            padding: 10px;
            font-size: 12px;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <h1>Booking Appointment Successfully Done</h1>
        </div>

        <!-- Content Section -->
        <div class="content">
            <p>Dear <strong>{{ $bookmailData['name'] }}</strong>,</p>
            <p>Your appointment has been successfully set. Please go to the clinic and present this confirmation to the assistant for verification.</p>
            <p><em>Note: This is on a First Come, First Serve Basis. Thank you.</em></p>

            <h2>Appointment Details:</h2>
            <ul>
                <li><strong>Service Name:</strong> {{ $bookmailData['services_name'] }}</li>
                <li><strong>Date and Time:</strong> {{ $bookmailData['time'] }}</li>
                <li><strong>Status:</strong> {{ $bookmailData['status'] }}</li>
            </ul>

            <p>If you have any questions, feel free to contact us at Oconrenegrace@gmail.com || 092 9603 3673.</p>
        </div>

        <div class="footer-content">
            <h3>Graces Dental Clinic</h3>
            <p>Eleventh Street Business Complex, 2nd Floor, National Highway, Purok 5, San Francisco Poblacion, Panabo, Davao del Norte, Philippines</p>
            <p>Email: <a href="mailto:Oconrenegrace@gmail.com">Oconrenegrace@gmail.com</a></p>
            <p>Phone: <a href="tel:+639296033673">092 9603 3673</a></p>
        </div>
    </div>
</body>
</html>
