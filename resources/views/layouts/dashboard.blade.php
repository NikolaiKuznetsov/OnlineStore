<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/scripts.js') }}" defer></script>
    </head>
    <body>
        <div>
            <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
                @include('admin.partials.navbar')

                <div class="flex-1 flex flex-col overflow-hidden">
                    @include('admin.partials.header')
                    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
