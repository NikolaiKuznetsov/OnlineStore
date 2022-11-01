@extends('layouts.main')
@section('title', 'Интернет магазин')
@section('content')
    <div class="container mx-auto px-6">
        <div class="mt-16">
            <h3 class="text-gray-600 text-2xl font-medium">Основные товары</h3>
            @include('partials.card', ['products' => $products])
        </div>
    </div>
@endsection
