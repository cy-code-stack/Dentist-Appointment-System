<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
</head>
<body>
    <h2>FORGOT PASSWORD</h2>
    <p>In Order to reset your password your must click the <b>"Click here to reset your password"</b> thank you.</p>
    <p>Your email: {{ $user_email }} </p>
    <a href="{{ route('reset', $token) }}" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">Click here to reset your password</a>
</body>
</html>