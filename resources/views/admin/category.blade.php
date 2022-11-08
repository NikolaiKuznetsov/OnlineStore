@extends('layouts.dashboard')
@section('title', 'Создание/редактирование категорий')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Создание/редактирование категорий</h3>

        <div class="mt-8">
            <a href="{{ route('admin.categories.create') }}" class="text-indigo-600 hover:text-indigo-900">Добавить</a>
        </div>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Категории
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                        @foreach($categories as $category)
                            <tr class="border-b border-gray-200">
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-md leading-5 text-gray-900">{{ $category->name }}</div>
                                    <div class="text-sm leading-5 text-gray-600">slug: {{ $category->slug }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium flex flex-col">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-indigo-600 hover:text-indigo-900 pb-3">Редактировать</a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-8">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
