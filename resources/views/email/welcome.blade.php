<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #666;
        }
        .otp {
            color: #007bff;
            font-weight: bold;
        }
        .contact-info {
            margin-top: 10px;
            font-size: 14px;
        }
        h1 {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Graces Dental Clinic</h1>
        </div>
        <div class="content">
            <h1>One-Time Password</h1>
            <p>Dear {{ $get_user_firstname }} {{ $get_user_lastname }},</p>
            <p>Your account has been successfully verified. To complete your login, please copy the OTP below and paste it into the designated field on our website.</p>
            <p>
                Visit our website and log in using your email and password. If you have any questions or encounter any issues, feel free to contact us via email at 
                <strong>oconrenegrace@gmail.com</strong> or call us at <strong>092 9603 3673</strong>.
            </p>
            <p>Thank you for choosing Graces Dental Clinic. We are dedicated to providing the best care for your dental needs.</p>
            <h4>Your OTP is: <span class="otp">{{ $validToken }}</span></h4>
            <div class="contact-info">
                <p><strong>Your Name:</strong> {{ $get_user_firstname }} {{ $get_user_lastname }}</p>
                <p><strong>Your Email:</strong> {{ $get_user_email }}</p>
            </div>
        </div>
        <div class="footer">
            <div class="footer-content">
                <h3>Graces Dental Clinic</h3>
                <p>Eleventh Street Business Complex, 2nd Floor, National Highway, Purok 5, San Francisco Poblacion, Panabo, Davao del Norte, Philippines</p>
                <p>Email: <a href="mailto:Oconrenegrace@gmail.com">Oconrenegrace@gmail.com</a></p>
                <p>Phone: <a href="tel:+639296033673">092 9603 3673</a></p>
            </div>
        </div>
    </div>
</body>
</html>
