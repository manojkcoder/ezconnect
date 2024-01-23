<!DOCTYPE html>
<html>
<head>
    <title>Contact Request Received</title>
</head>
<body>
    <h2>You have a new contact request from {{ $contactRequest->name }}</h2>
    <br/>
    Here are the details:
    <br/>
    Name: {{ $contactRequest->name }}
    <br/>
    Email: {{ $contactRequest->email }}
    <br/>
    Phone: {{ $contactRequest->phone }}
    @if($contactRequest->company)
        <br/>
        Company: {{ $contactRequest->company }}
    @endif
    @if($contactRequest->title)
        <br/>
        Title: {{ $contactRequest->title }}
    @endif
    <br/>
    Message: {{ $contactRequest->message }}
</body>
</html>