{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <x-stat-card label="Parents" :value="$parentsCount" />
    <x-stat-card label="Students" :value="$studentsCount" />
    <x-stat-card label="Classes" :value="$classesCount" />
    <x-stat-card label="Schedules" :value="$schedulesCount" />
  </div>
@endsection
