@extends('layouts.dashboard')
@section('title', isset($product) ? "Редактировать статью ID {$product->id}" : 'Добавить статью')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ isset($product) ? "Редактировать статью ID {$product->id}" : 'Добавить статью' }}</h3>

        <div class="mt-8"></div>

        <div class="mt-8">
            <form method="POST" action="{{ isset($product) ? route("admin.products.update", $product->id) : route("admin.products.store") }}" class="space-y-5 mt-5" enctype="multipart/form-data">
                @csrf

                @isset($product)
                    @method('PUT')
                @endisset

                <input name="name" type="text" class="w-full h-12 border rounded px-3 @error('name') border-red-500 @enderror" placeholder="Название" value="{{ $product->name ?? old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror

                <input name="country" type="text" class="w-full h-12 rounded px-3 @error('country') border-red-500 @enderror" placeholder="Страна-изготовитель" value="{{ $product->country ?? old('country') }}" required>
                @error('country')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror

                <input name="year" type="number" class="w-full h-12 border rounded px-3 @error('year') border-red-500 @enderror" placeholder="Год изготовления" value="{{ $product->year ?? old('year') }}" required>
                @error('year')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror

                <input name="model" type="text" class="w-full h-12 border rounded px-3 @error('model') border-red-500 @enderror" placeholder="Модель" value="{{ $product->model ?? old('model') }}" required>
                @error('model')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror

                <input name="quantity" type="number" class="w-full h-12 border rounded px-3 @error('quantity') border-red-500 @enderror" placeholder="Количество товара" value="{{ $product->quantity ?? old('quantity') }}" required>
                @error('quantity')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror

                <input name="price" type="number" class="w-full h-12 border rounded px-3 @error('price') border-red-500 @enderror" placeholder="Цена" value="{{ $product->price ?? old('price') }}" required>
                @error('price')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror

                <select name="category" class="w-full h-12 border rounded px-3 @error('category') border-red-500 @enderror" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(isset($product) && $product->category()->first()->id === $category->id) selected @endif >{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror

                @isset($product)
                    <div>
                        <img class="h-64 w-64" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                    </div>
                @endisset

                <input name="image" type="file" class="w-full h-12" placeholder="Изображение">
                @error('image')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
