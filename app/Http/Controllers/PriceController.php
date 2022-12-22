<?php

namespace App\Http\Controllers;

use App\Services\CoinGecko;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    function index(CoinGecko $coinGecko){

        return response()->json([
            'data' => $coinGecko->getPriceList()
        ]);
    }
}
