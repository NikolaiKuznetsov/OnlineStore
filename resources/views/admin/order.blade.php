@extends('layouts.dashboard')
@section('title', 'Заказы')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Заказы</h3>

        <ul class="flex flex-col p-4 mt-8 md:flex-row md:text-sm md:font-medium items-center">
            <li>
                <form method="GET">
                    <select name="sort" onchange="this.form.submit()" class="form-select appearance-none block w-full py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                        <option selected>Отобразить заказы:</option>
                        <option value="Новый">Новые</option>
                        <option value="Подтвержден">Подтвержденные</option>
                        <option value="Отменен">Отмененные</option>
                    </select>
                </form>
            </li>
        </ul>

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
                                    <div class="text-md leading-5 text-gray-900">Заказ №{{ $order->id }} ({{ $order->created_at->format('d F Y, H:i') }})</div>
                                    <div class="text-sm leading-5 text-gray-600">Пользователь: {{ $order->user()->first()->name . ' ' . $order->user()->first()->surname . ' ' . $order->user()->first()->patronymic }}</div>
                                    <div class="text-sm leading-5 text-gray-600">Товаров: {{ $order->item()->count() }}</div>
                                </td>

                                <td class="px-6 py-4 text-right whitespace-no-wrap font-medium leading-5 text-sm flex flex-col">
                                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="text-indigo-600 hover:text-indigo-900 pb-3">Редактировать</a>
                                    <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 pb-3">Подтвердить</button>
                                    </form>
                                    <div>
                                        <button id="button-modal" onclick="showModalForm({{ $order->id }})" type="button" data-modal-toggle="popup-modal" class="text-red-600 hover:text-red-900">Отменить</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-8">
                    {{ $orders->appends(\Request::except('page'))->render() }}
                </div>
            </div>
        </div>
    </div>
    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Закрыть окно</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Укажите причину отмены заказа.</h3>
                    <form id="formInModal" action="{{ route('admin.orders.cancel', 1) }}" method="POST" class="px-5">
                        @csrf
                        <textarea name="comment" cols="30" rows="10"></textarea>
                        <button data-modal-toggle="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Отменить
                        </button>
                        <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Закрыть</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
