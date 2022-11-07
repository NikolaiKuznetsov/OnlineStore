@extends('layouts.main')
@section('title', $product->name)
@section('content')
    <div class="container mx-auto px-6">
        <div class="md:flex">
            <div class="w-full h-64 md:w-1/2 lg:h-96">
                <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
            </div>
            <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                <h3 class="text-gray-700 uppercase text-lg">{{ $product->name }}</h3>
                <span class="text-gray-500 mt-3">${{ $product->price }}</span>
                <hr class="my-3">
                <div id="detailed-pricing" class="overflow-x-auto w-full">
                    <div class="overflow-hidden min-w-max">
                        <div class="grid grid-cols-2 gap-x-16 py-5 text-sm text-gray-500 border-b border-gray-200">
                            <div class="text-gray-700 font-semibold">Страна-производитель:</div>
                            <div>{{ $product->country }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-x-16 py-5 text-sm text-gray-500 border-b border-gray-200">
                            <div class="text-gray-700 font-semibold">Год выпуска:</div>
                            <div>{{ $product->year }}</div>
                        </div>
                        <div class="grid grid-cols-2 gap-x-16 py-4 text-sm text-gray-700 border-b border-gray-200">
                            <div class="text-gray-700 font-semibold">Модель:</div>
                            <div>{{ $product->model }}</div>
                        </div>
                    </div>
                </div>
                @auth('web')
                    <div class="flex items-center mt-6">
                        <button class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500" onclick="cartAdd({{ $product->id }})">Добавить в корзину</button>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
