{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login – Children’s Hub</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="w-full max-w-sm bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Parent Login</h2>

    @if ($errors->any())
      <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
      @csrf

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium mb-1">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
               class="w-full px-3 py-2 border rounded focus:outline-none focus:ring">
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium mb-1">Password</label>
        <input id="password" type="password" name="password" required
               class="w-full px-3 py-2 border rounded focus:outline-none focus:ring">
      </div>

      <div class="flex items-center justify-between mb-6">
        <label class="inline-flex items-center text-sm">
          <input type="checkbox" name="remember" class="form-checkbox">
          <span class="ml-2">Remember Me</span>
        </label>
        <a href="#" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
      </div>

      <button type="submit"
              class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Login
      </button>
    </form>
  </div>
</body>
</html>
