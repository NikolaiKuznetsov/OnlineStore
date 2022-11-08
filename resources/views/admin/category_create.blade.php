@extends('layouts.dashboard')
@section('title', isset($category) ? "Редактировать категорию ID {$category->id}" : 'Добавить категорию')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ isset($category) ? "Редактировать категорию ID {$category->id}" : 'Добавить категорию' }}</h3>

        <div class="mt-8"></div>

        <div class="mt-8">
            <form method="POST" action="{{ isset($category) ? route("admin.categories.update", $category->id) : route("admin.categories.store") }}" class="space-y-5 mt-5">
                @csrf

                @isset($category)
                    @method('PUT')
                @endisset

                <input name="name" type="text" class="w-full h-12 border rounded px-3 @error('name') border-red-500 @enderror" placeholder="Название" value="{{ $category->name ?? old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror

                @isset($category)
                    <input name="slug" type="text" class="w-full h-12 border rounded px-3 @error('slug') border-red-500 @enderror" placeholder="slug" value="{{ $category->slug ?? old('slug') }}" required>
                    @error('slug')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                @endisset

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
