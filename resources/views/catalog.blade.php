@extends('layouts.main')
@section('title', $title)
@section('content')
    <div class="container mx-auto px-6">
        <div class="hidden w-full md:block md:w-auto" id="mobile-menu">
            <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white items-center">
                <li>
                    <form method="GET">
                        <select name="sort" onchange="this.form.submit()" class="form-select appearance-none block w-full py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                            <option selected>Сортировать по:</option>
                            <option value="year">Году производства</option>
                            <option value="name">По наименованию</option>
                            <option value="price">По цене</option>
                        </select>
                    </form>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex justify-between items-center py-2 pr-4 pl-3 w-full font-medium text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto">
                        Категория <svg class="ml-1 w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <div id="dropdownNavbar" class="hidden z-10 w-44 font-normal bg-white rounded divide-y divide-gray-100 shadow">
                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('show.catalog') . '/' . $category->slug }}" class="block py-2 px-4 hover:bg-gray-100">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        @include('partials.card', ['products' => $products])
        <div class="mt-8">
            {{ $products->appends(\Request::except('page'))->render() }}
        </div>
    </div>
@endsection
