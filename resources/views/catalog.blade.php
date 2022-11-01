@extends('layouts.main')
@section('title', 'Каталог')
@section('content')
    <div class="container mx-auto px-6">
        <div class="mt-16">
            @include('partials.card', ['products' => $products])
            {{ $products->links() }}
        </div>
    </div>
@endsection
