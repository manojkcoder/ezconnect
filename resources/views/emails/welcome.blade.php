<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>
<body>
    <h2>Welcome to our website, {{ $user->name }}</h2>
    <br/>
    Your registered email-id is {{ $user->email }} , Please click on the below link to set a password to access your account
    <br/>
    <a href="{{ route('password.reset', ['token' => $token, 'email' => $user->email]) }}">Verify Email</a>
</body>
</html>