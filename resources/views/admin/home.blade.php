@extends('layouts.dashboard')
@section('title', $title)
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ $title }}</h3>

        <div class="mt-8"></div>
    </div>
@endsection
