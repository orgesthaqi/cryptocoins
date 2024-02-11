<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CoinGeckoController extends Controller
{
    public function trending_crypto(Request $request)
    {
        $client = new Client();

        $url = "https://api.coingecko.com/api/v3/search/trending";

        $headers = [
            'Accepts' => 'application/json',
            'x-cg-pro-api-key' => env('COINGECKO_API_KEY')
        ];

        $response = $client->request('GET', $url, ['headers' => $headers]);
        $responseBody = json_decode($response->getBody()->getContents());

        return view('coingecko.trending-crypto', ['data' => $responseBody]);
    }
}
