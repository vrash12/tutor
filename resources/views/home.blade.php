@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-semibold mb-6">Hello, {{ Auth::user()->name }}</h2>

    @if(Auth::user()->role->name === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="block mb-4 text-blue-600 hover:underline">
            Go to Admin Dashboard
        </a>
    @else
        <a href="{{ route('parent.dashboard') }}" class="block mb-4 text-blue-600 hover:underline">
            Go to Your Dashboard
        </a>
    @endif
</div>
@endsection
