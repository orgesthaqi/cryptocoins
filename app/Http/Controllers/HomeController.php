<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }
    public function trending_cryptocurrencies(Request $request)
    {
        $client = new Client();

        $start = ($request->has('start')) ? $request->start : 1;
        $limit = ($request->has('limit')) ? $request->limit : 200;

        $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/trending/latest?start={$start}&limit={$limit}";

        $headers = [
            'Accepts' => 'application/json',
            'X-CMC_PRO_API_KEY' => env('COINMARKETCAP_API_KEY')
        ];

        $response = $client->request('GET', $url, ['headers' => $headers]);
        $responseBody = json_decode($response->getBody()->getContents());

        return view('trending-cryptocurrencies', ['data' => $responseBody]);
    }

    public function most_viewed_pages(Request $request)
    {
        $client = new Client();

        $start = ($request->has('start')) ? $request->start : 1;
        $limit = ($request->has('limit')) ? $request->limit : 200;
        $page = ($request->has('page')) ? $request->page : 1;

        $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/trending/most-visited?start={$start}&limit={$limit}";

        $headers = [
            'Accepts' => 'application/json',
            'X-CMC_PRO_API_KEY' => env('COINMARKETCAP_API_KEY')
        ];

        $response = $client->request('GET', $url, ['headers' => $headers]);
        $responseBody = json_decode($response->getBody()->getContents());

        return view('most-viewed-pages', ['data' => $responseBody]);
    }
}

