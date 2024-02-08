<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();
        if($request->has('start')) {
            $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/trending/latest?limit=".$request->start;
        } else {
            $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/trending/latest?start=1&limit=100&convert=USD";
        }

        $headers = [
            'Accepts' => 'application/json',
            'X-CMC_PRO_API_KEY' => env('COINMARKETCAP_API_KEY')
        ];

        $response = $client->request('GET', $url, ['headers' => $headers]);
        $responseBody = json_decode($response->getBody()->getContents());
        return view('home', ['data' => $responseBody->data]);
    }
}

