<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CoinMarketCapController extends Controller
{
    public function gainers_losers(Request $request)
    {
        $client = new Client();

        $start = ($request->has('start')) ? $request->start : 1;
        $limit = ($request->has('limit')) ? $request->limit : 100;
        $time_period = ($request->has('time_period')) ? $request->time_period : '24h';

        $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/trending/gainers-losers?start={$start}&limit={$limit}&time_period={$time_period}";

        $headers = [
            'Accepts' => 'application/json',
            'X-CMC_PRO_API_KEY' => env('COINMARKETCAP_API_KEY')
        ];

        $response = $client->request('GET', $url, ['headers' => $headers]);
        $responseBody = json_decode($response->getBody()->getContents());

        return view('coinmarketcap.gainers-losers', ['data' => $responseBody]);
    }

    public function trending_cryptocurrencies(Request $request)
    {
        $client = new Client();

        $start = ($request->has('start')) ? $request->start : 1;
        $limit = ($request->has('limit')) ? $request->limit : 100;
        $time_period = ($request->has('time_period')) ? $request->time_period : '24h';

        $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/trending/latest?start={$start}&limit={$limit}&time_period={$time_period}";

        $headers = [
            'Accepts' => 'application/json',
            'X-CMC_PRO_API_KEY' => env('COINMARKETCAP_API_KEY')
        ];

        $response = $client->request('GET', $url, ['headers' => $headers]);
        $responseBody = json_decode($response->getBody()->getContents());

        return view('coinmarketcap.trending-cryptocurrencies', ['data' => $responseBody]);
    }

    public function most_viewed_pages(Request $request)
    {
        $client = new Client();

        $start = ($request->has('start')) ? $request->start : 1;
        $limit = ($request->has('limit')) ? $request->limit : 100;
        $time_period = ($request->has('time_period')) ? $request->time_period : '24h';

        $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/trending/most-visited?start={$start}&limit={$limit}&time_period={$time_period}";

        $headers = [
            'Accepts' => 'application/json',
            'X-CMC_PRO_API_KEY' => env('COINMARKETCAP_API_KEY')
        ];

        $response = $client->request('GET', $url, ['headers' => $headers]);
        $responseBody = json_decode($response->getBody()->getContents());

        return view('coinmarketcap.most-viewed-pages', ['data' => $responseBody]);
    }

    public function recently_added(Request $request)
    {
        $client = new Client();

        $start = ($request->has('start')) ? $request->start : 1;
        $limit = ($request->has('limit')) ? $request->limit : 100;

        $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/new?start={$start}&limit={$limit}";

        $headers = [
            'Accepts' => 'application/json',
            'X-CMC_PRO_API_KEY' => env('COINMARKETCAP_API_KEY')
        ];

        $response = $client->request('GET', $url, ['headers' => $headers]);
        $responseBody = json_decode($response->getBody()->getContents());

        return view('coinmarketcap.recently-added', ['data' => $responseBody]);
    }
}
