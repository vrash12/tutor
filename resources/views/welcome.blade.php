<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Children's Hub</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="text-center p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-4">Welcome to Children's Hub</h1>
        <p class="mb-6">A safe, fun, and interactive learning environment for toddlers.</p>
        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Parent Login
        </a>
    </div>
</body>
</html>
