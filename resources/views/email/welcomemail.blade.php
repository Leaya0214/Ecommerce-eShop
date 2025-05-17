<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $data['subject'] ?? 'Welcome' }}</title>
</head>
<body>
    <h2>Hello, {{ $data['name'] ?? 'User' }}</h2>
    <p>{{ $data['body'] ?? 'Thank you for joining us!' }}</p>
</body>
</html>