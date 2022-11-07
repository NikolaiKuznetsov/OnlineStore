@extends('layouts.main')
@section('title', 'Корзина')
@section('content')
    <div class="container mx-auto px-6">
        <h3 class="text-gray-700 text-2xl font-medium">Корзина</h3>
        <div class="flex flex-col lg:flex-row mt-8">
            <div class="w-full order-1 lg:w-1/2">
                <div class="border rounded-md max-w-md w-full px-4 py-3">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-700 font-medium">Количество товара в козине ({{ $count }})</h3>
                    </div>
                    @foreach($products as $index => $product)
                        <div class="flex justify-between mt-6">
                            <div class="flex">
                                <img class="h-20 w-20 object-cover rounded" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                <div class="mx-3">
                                    <h3 class="text-sm text-gray-600">{{ $product->name }}</h3>
                                    <div class="flex items-center mt-2">
                                        <button class="text-gray-500 focus:outline-none focus:text-gray-600" onclick="cartAdd({{ $product->id }})">
                                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </button>
                                        <span id="quantity-{{ $carts[$index]->id }}" class="text-gray-700 mx-2">{{ $carts[$index]->quantity }}</span>
                                        <button class="text-gray-500 focus:outline-none focus:text-gray-600" onclick="reduceQuantity({{ $carts[$index]->id }})">
                                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <span class="text-gray-600">${{ $carts[$index]->quantity * $product->price }}</span>
                        </div>
                    @endforeach
                    <div class="flex items-center justify-end mt-2">
                        <h3 class="text-gray-700 font-medium">ИТОГО: ${{ $total }}</h3>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/2 order-2 lg:mt-0 mt-5">
                <div class="flex lg:justify-end">
                    <form id="checkout-form" action="{{ route('save.order') }}" method="POST" class="lg:w-3/4">
                        @csrf
                        <div class="mt-2">
                            <h4 class="text-sm text-gray-500 font-medium">Введите пароль от Вашей учётной записи для оформления заказа</h4>
                            <div class="mt-6 flex">
                                <label class="block flex-1">
                                    <input id="password" name="password" type="password" class="border p-1.5 block w-full rounded-md focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 mt-1" placeholder="Пароль" required>
                                    <p id="password-message" class="text-red-500 text-xs italic"></p>
                                </label>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-8">
                            <button type="submit" class="flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                <span>Сформировать заказ</span>
                                <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
