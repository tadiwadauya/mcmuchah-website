<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Inquiry</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222;">
    <h2>New Contact Inquiry</h2>

    <p><strong>Name:</strong> {{ $inquiry->name }}</p>
    <p><strong>Email:</strong> {{ $inquiry->email ?: 'N/A' }}</p>
    <p><strong>Phone:</strong> {{ $inquiry->phone ?: 'N/A' }}</p>
    <p><strong>Subject:</strong> {{ $inquiry->subject ?: 'N/A' }}</p>

    <h3>Message</h3>
    <p style="white-space: pre-wrap;">{{ $inquiry->message }}</p>
</body>
</html>