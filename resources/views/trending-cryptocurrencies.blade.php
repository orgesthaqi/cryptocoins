@extends('layouts.app')

@section('title', 'Trending')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="flex flex-col mt-8">
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
                        <a href="?start={{ $pageStart == 0 ? 1 : $pageStart }}&limit=100&page={{ $i }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-blue-400 hover:text-white {{ (request('page') == $i || !request('page') && $i == 1) ? 'bg-blue-400 text-white' : '' }}">
                            {{ $i }}
                        </a>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
