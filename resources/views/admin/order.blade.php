@extends('layouts.dashboard')
@section('title', 'Заказы')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Заказы</h3>

        <div class="mt-8">

        </div>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Заказы
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                        @foreach($orders as $order)
                            <tr class="border-b border-gray-200">
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    @switch($order->status)
                                        @case('Новый')
                                            <div class="text-sm font-bold italic leading-5 text-green-600">{{ $order->status }}</div>
                                            @break
                                        @case('Подтвержден')
                                            <div class="text-sm font-bold italic leading-5 text-blue-600">{{ $order->status }}</div>
                                            @break
                                        @case('Отменен')
                                            <div class="text-sm font-bold italic leading-5 text-red-600">{{ $order->status }}</div>
                                            @break
                                        @default
                                            <div class="text-sm font-bold italic leading-5 text-gray-600">{{ $order->status }}</div>
                                            @break
                                    @endswitch
                                    <div class="text-md leading-5 text-gray-900">Заказ от {{ $order->created_at->format('d F Y, H:i') }}</div>
                                    <div class="text-sm leading-5 text-gray-600">Пользователь: {{ $order->user()->first()->name . ' ' . $order->user()->first()->surname . ' ' . $order->user()->first()->patronymic }}</div>
                                    <div class="text-sm leading-5 text-gray-600">Товаров: {{ $order->item()->count() }}</div>
                                </td>

                                <td class="px-6 py-4 text-right whitespace-no-wrap font-medium leading-5 text-sm flex flex-col">
                                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="text-indigo-600 hover:text-indigo-900 pb-3">Редактировать</a>
                                    <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 pb-3">Подтвердить</button>
                                    </form>
                                    <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900">Отменить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
