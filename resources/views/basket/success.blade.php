@extends('layouts.main')
@section('title', $message)
@section('content')
    <div class="container mx-auto px-6">
        <div class="text-green-500 text-2xl flex justify-center items-center">
            <span>{{ $message }}</span>
        </div>
    </div>
@endsection
