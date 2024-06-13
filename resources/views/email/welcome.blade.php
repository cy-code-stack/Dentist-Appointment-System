<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email OTP</title>
</head>
<body>
    <h1>ONE TIME PASSWORD</h1>
    <p>Your account has been successfully verified, just copy the OTP and you can now log in. 
        Please visit our website and enter your email and password, and click "Sign In."
        If you have any questions or encounter any issues, please contact at Oconrenegrace@gmail.com or 092 9603 3673. 
        Thank you for choosing Graces Dental Clinic.</p>
    <p>Your name: {{ $get_user_firstname }} {{ $get_user_lastname }}</p>
    <p>Your email: {{ $get_user_email }} </p>
    <h4>Your OTP is: {{ $validToken }}</h4>
</body>
</html>