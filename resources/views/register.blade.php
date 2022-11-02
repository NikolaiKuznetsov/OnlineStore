@extends('layouts.main')
@section('title', 'Регистрация')
@section('content')
    <div class="w-full mt-8 flex justify-center items-center">
        <form id="reg-form" action="{{ route('process.signUp') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 min-w-[30%]">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Имя</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="Имя" value="{{ old('name') }}">
                <p id="name-message" class="text-red-500 text-xs italic"></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="surname">Фамилия</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="surname" name="surname" type="text" placeholder="Фамилия" value="{{ old('surname') }}">
                <p id="surname-message" class="text-red-500 text-xs italic"></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="patronymic">Отчество</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="patronymic" name="patronymic" type="text" placeholder="Отчество" value="{{ old('patronymic') }}">
                <p id="patronymic-message" class="text-red-500 text-xs italic"></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="login">Логин</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="login" name="login" type="text" placeholder="Username" value="{{ old('login') }}">
                <p id="login-message" class="text-red-500 text-xs italic"></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}">
                <p id="email-message" class="text-red-500 text-xs italic"></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Пароль</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="password" placeholder="**************">
                <p id="password-message" class="text-red-500 text-xs italic"></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">Подтверждение пароля</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password_confirmation" name="password_confirmation" type="password" placeholder="**************">
                <p id="password_confirmation-message" class="text-red-500 text-xs italic"></p>
            </div>
            <div class="mb-6">
                <div class="flex">
                    <div class="flex items-center h-5">
                        <input id="rules" name="rules" type="checkbox" aria-describedby="rules-checkbox-text" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <div class="ml-2 text-sm">
                        <label for="rules" class="font-medium text-gray-900 dark:text-gray-700">Я согласен с <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">правилами регистрации</a>.</label>
                        <p id="rules-checkbox-text" class="text-xs font-normal text-red-500 hidden">Вы не согласились с правилами регистрации</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Зарегистрироваться</button>
            </div>
        </form>
    </div>
@endsection
