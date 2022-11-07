@extends('layouts.main')
@section('title', 'Ваши заказы')
@section('content')
    <div class="flex justify-center">
        <span class="mb-8 text-2xl">Заказы</span>
    </div>
    @foreach($orders as $order)
        <div class="mx-auto max-w-xl p-5 mb-4 bg-gray-50 rounded-lg border border-gray-100">
            <div class="flex items-center justify-between">
                <time class="text-lg font-semibold text-gray-900">{{ $order->created_at->format('d F Y, H:i') }}</time>
                <span class="text-sm text-green-500">{{ $order->status }}</span>
            </div>
            <ol class="mt-3 divide-y divider-gray-200">
                @foreach($order->item()->get() as $item)
                    @php
                        $product = $item->product()->first();
                    @endphp
                    <li>
                        <a href="{{ route('show.product', $product->id) }}" class="flex justify-between mt-6 block items-center p-3 sm:flex hover:bg-gray-100">
                            <div class="flex">
                                <img class="h-20 w-20 object-cover rounded" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                <div class="mx-3">
                                    <div class="text-base font-normal"><span class="font-medium text-gray-900">{{ $product->name }}</span></div>
                                    <span class="inline-flex items-center text-xs font-normal text-gray-500">
                                        Количество: {{ $item->quantity }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-gray-600 ml-auto">${{ $item->price }}</span>
                                <span class="text-sm text-gray-400 ml-auto">(${{ $product->price }})</span>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ol>
            @if ($order->status === 'Новый')
                <div class="flex justify-end">
                    <a href="{{ route('delete.order', $order->id) }}" class="text-sm text-red-500">Удалить заказ</a>
                </div>
            @endif
        </div>
    @endforeach
@endsection
