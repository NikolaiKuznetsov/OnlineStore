@extends('layouts.dashboard')
@section('title', $title)
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ $title }}</h3>

        <div class="mt-8"></div>

        <div class="mt-8">
            <form class="space-y-5 mt-5">
                @csrf
                <input name="name" type="text" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Название" value="{{ $product->name }}">

                <input name="country" type="text" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Страна-изготовитель" value="{{ $product->country }}">

                <input name="year" type="number" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Год изготовления" value="{{ $product->year }}">

                <input name="model" type="text" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Модель" value="{{ $product->model }}">

                <input name="quantity" type="number" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Количество товара" value="{{ $product->quantity }}">

                <input name="price" type="number" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Цена" value="{{ $product->price }}">

                <select name="category" class="w-full h-12 border border-gray-800 rounded px-3">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($product->category === $category->id) selected @endif >{{ $category->name }}</option>
                    @endforeach
                </select>

                <div>
                    <img class="h-64 w-64" src="https://images.unsplash.com/photo-1571171637578-41bc2dd41cd2?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80">
                </div>

                <input type="file" class="w-full h-12" placeholder="Изображение"/>

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
