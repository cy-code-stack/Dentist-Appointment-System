<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inquiry send</title>
</head>
<body>
    <h2>Graces Dental Clinic</h2>
    <h4>Name: <strong>{{ $inquiryData['name'] }} </strong></h4>
    <h4>Email: <strong>{{ $inquiryData['email'] }} </strong></h4>
    <h4>Message: <strong>{{ $inquiryData['message'] }} </strong></h4>
    <h4>Reply: <strong>{{ $inquiryData['reply'] }} </strong></h4>
</body>
</html>