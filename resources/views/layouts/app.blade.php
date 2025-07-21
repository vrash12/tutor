<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Children’s Hub')</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="min-h-screen bg-gray-100 flex flex-col">

  {{-- Navbar --}}
  <nav class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <a href="{{ route('welcome') }}" class="text-2xl font-bold">
        Children’s Hub
      </a>
      <div class="space-x-4">
        @auth
          <a href="{{ route('home') }}" class="text-gray-700 hover:underline">Home</a>
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-red-600 hover:underline">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        @endauth
      </div>
    </div>
  </nav>

  {{-- Page Content --}}
  <main class="flex-1 container mx-auto px-4 py-6">
    @if(session('status'))
      <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
        {{ session('status') }}
      </div>
    @endif

    @yield('content')
  </main>

</body>
</html>
