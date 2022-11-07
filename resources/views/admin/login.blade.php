<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Вход в админ-панель</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
            <div class="bg-white w-96 shadow-xl rounded p-5">
                <h1 class="text-3xl font-medium">Вход</h1>

                <form method="POST" action="{{ route('admin.process.login') }}" class="space-y-5 mt-5">
                    @csrf
                    <input name="login" type="text" class="w-full h-12 border rounded px-3 @error('login') border-red-500 @enderror" placeholder="Логин" value="{{ old('login') }}">
                    @error('login')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <input name="password" type="password" class="w-full h-12 border rounded px-3 @error('login') border-red-500 @enderror" placeholder="Пароль" />

                    <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Войти</button>
                </form>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
