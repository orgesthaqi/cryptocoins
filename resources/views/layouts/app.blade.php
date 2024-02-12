<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss'])
</head>
<body>
    <div id="app">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                <div class="relative flex h-16 items-center justify-between">
                    <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex flex-shrink-0 items-center">
                            <img class="h-8 w-auto" src="http://cryptocoins.test/images/logo.svg" alt="Your Company">
                        </div>
                        <div class="hidden sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                @auth
                                    <a class="{{ request()->routeIs('home') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-3 text-sm font-medium text-decoration-none no-underline" href="{{ route('home') }}">Home</a>

                                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-3 text-sm font-medium text-decoration-none no-underline">
                                            <span>CoinMarketCap</span>
                                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                                            <ul class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                                                <li>
                                                    <a href="{{ route('trending-cryptocurrencies') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rounded-lg">Trending</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('most-viewed-pages') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rounded-lg">Most Visited</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('trending-crypto') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rounded-lg">Recently Added</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-3 text-sm font-medium text-decoration-none no-underline">
                                            <span>CoinGecko</span>
                                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                                            <ul class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                                                <li>
                                                    <a href="{{ route('trending-cryptocurrencies') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rounded-lg">Top Trending</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="absolute right-0 z-10 mt-3 w-48 origin-top-right">
                                        <a class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-3 text-sm font-medium text-decoration-none" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </nav>

        @if(!request()->routeIs('login'))
            <header class="bg-white shadow">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">@yield('title')</h1>
                </div>
            </header>
        @endif

        <main>
            <div>
                @yield('content')
            </div>
        </main>

        <script></script>

    </div>
</body>
</html>
