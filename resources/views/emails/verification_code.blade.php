<!DOCTYPE html>
<html>
<head>
    <title>Verification Code</title>
</head>
<body>
    <p>Hello {{ $name ?? 'User' }},</p>
    <p>Thank you for registering. Please use the following code to verify your email:</p>
    <h2>{{ $code }}</h2>
    <p>If you did not register, please ignore this email.</p>
</body>
</html>
