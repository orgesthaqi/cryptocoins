@extends('layouts.app')

@section('title', 'CoinMarketCap - Trending Gainers & Losers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="flex flex-col mt-8">
                <div class="text-right mt-2">
                    <div class="text-sm font-bold text-gray-800">Update frequency: Every 10 minutes.</div>
                </div>
                <div @click.away="open = false" x-data="{ open: false }" class="text-right mt-2 mb-3">
                    <div class="relative inline-block text-left">
                        <div>
                          <button @click="open = !open" type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                            Timeframe: {{ request('time_period') ?? '24h' }}
                            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                          </button>
                        </div>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                          <div class="py-1" role="none">
                            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                            <a href="{{ url()->current() }}?time_period=1h" class="text-gray-700 block px-4 py-2 text-sm @if(request('time_period') == '1h') bg-gray-100 text-gray-900 @else text-gray-700 @endif" role="menuitem" tabindex="-1" id="menu-item-0">1h</a>
                            <a href="{{ url()->current() }}?time_period=24h" class="text-gray-700 block px-4 py-2 text-sm @if(request('time_period') == '24h') bg-gray-100 text-gray-900 @else text-gray-700 @endif" role="menuitem" tabindex="-1" id="menu-item-0">24h</a>
                            <a href="{{ url()->current() }}?time_period=7d" class="text-gray-700 block px-4 py-2 text-sm @if(request('time_period') == '7d') bg-gray-100 @endif" role="menuitem" tabindex="-1" id="menu-item-1">7d</a>
                            <a href="{{ url()->current() }}?time_period=30d" class="text-gray-700 block px-4 py-2 text-sm @if(request('time_period') == '30d') bg-gray-100 @endif" role="menuitem" tabindex="-1" id="menu-item-2">30d</a>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        #</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Symbol</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Price</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        24h</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        7d</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        30d</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Market Cap</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                        Volume</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white">
                                @foreach($data->data as $key => $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            @if(request()->has('start'))
                                                @php $start = request()->start + ($loop->iteration - 1); @endphp

                                                <div class="text-sm leading-5 text-gray-500">
                                                    {{ $start }}
                                                </div>
                                            @else
                                                <div class="text-sm leading-5 text-gray-500">{{ $loop->iteration }}</div>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-10 h-10 rounded-full" src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{ $item->id }}.png"
                                                        alt="admin dashboard ui">
                                                </div>

                                                <div class="ml-4">
                                                    <div class="text-sm font-medium leading-5 text-gray-900">
                                                        {{ $item->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500"><b>{{ $item->symbol }}</b></div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500"><b>${{ number_format($item->quote->USD->price,2) }}</b></div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500"><b>{{ number_format($item->quote->USD->percent_change_24h,2) }}%</b></div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500"><b>{{ number_format($item->quote->USD->percent_change_7d,2) }}%</b></div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500"><b>{{ number_format($item->quote->USD->percent_change_30d,2) }}%</b></div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500"><b>${{ number_format($item->quote->USD->market_cap,2) }}</b></div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-500"><b>${{ number_format($item->quote->USD->volume_24h,2) }}</b></div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex items-center space-x-1" style="margin: 20px auto;">
                    @php
                        $start = ceil($data->status->total_count / 100);
                    @endphp

                    @for($i = 1; $i <= $start; $i++)
                        @php
                            $pageStart = (100 * ($i - 1)) + 1;
                        @endphp
                        <a href="?start={{ $pageStart == 0 ? 1 : $pageStart }}&limit=100&page={{ $i }}&time_period={{ request('time_period') ?? '24h' }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-blue-400 hover:text-white {{ (request('page') == $i || !request('page') && $i == 1) ? 'bg-blue-400 text-white' : '' }}">
                            {{ $i }}
                        </a>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
