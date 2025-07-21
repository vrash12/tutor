<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin') – Children’s Hub</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="flex h-screen bg-gray-100">

  {{-- Sidebar --}}
  <aside class="w-64 bg-white shadow-md">
    <div class="px-6 py-4 text-2xl font-bold">
      Children’s Hub
    </div>
    <nav class="mt-6">
      <a href="{{ route('admin.dashboard') }}"
         class="block px-6 py-2 hover:bg-gray-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200' : '' }}">
        Dashboard
      </a>
      <a href="{{ route('admin.parents') }}"
         class="block px-6 py-2 hover:bg-gray-200 {{ request()->routeIs('admin.parents*') ? 'bg-gray-200' : '' }}">
        Parents
      </a>
      <a href="{{ route('admin.students') }}"
         class="block px-6 py-2 hover:bg-gray-200 {{ request()->routeIs('admin.students*') ? 'bg-gray-200' : '' }}">
        Students
      </a>
      <a href="{{ route('admin.classes') }}"
         class="block px-6 py-2 hover:bg-gray-200 {{ request()->routeIs('admin.classes*') ? 'bg-gray-200' : '' }}">
        Classes
      </a>
      <a href="{{ route('admin.schedules') }}"
         class="block px-6 py-2 hover:bg-gray-200 {{ request()->routeIs('admin.schedules*') ? 'bg-gray-200' : '' }}">
        Schedules
      </a>
      <a href="{{ route('admin.reports') }}"
         class="block px-6 py-2 hover:bg-gray-200 {{ request()->routeIs('admin.reports*') ? 'bg-gray-200' : '' }}">
        Reports
      </a>
      <a href="{{ route('admin.announcement.form') }}"
         class="block px-6 py-2 hover:bg-gray-200 {{ request()->routeIs('admin.announcement.*') ? 'bg-gray-200' : '' }}">
        Announcements
      </a>
    </nav>
  </aside>

  {{-- Main content --}}
  <div class="flex-1 flex flex-col">
    {{-- Header --}}
    <header class="bg-white shadow-sm p-4 flex justify-between items-center">
      <h1 class="text-2xl font-semibold">@yield('title')</h1>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
      </form>
    </header>

    {{-- Page body --}}
    <main class="p-6 overflow-auto">
      @if(session('status'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
          {{ session('status') }}
        </div>
      @endif

      @yield('content')
    </main>
  </div>

</body>
</html>
