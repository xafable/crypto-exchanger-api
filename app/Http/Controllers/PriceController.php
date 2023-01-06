<?php

namespace App\Http\Controllers;

use App\Http\Resources\AmountResource;
use App\Http\Resources\CoinLovResource;
use App\Models\CoinLov;
use App\Services\CoinGecko;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    function available (CoinGecko $coinGecko){
        return response()->json([
            'success' => true,
            'data' => CoinLovResource::collection(CoinLov::query()->get())
        ]);
    }

    function get(Request $request,CoinGecko $coinGecko) {
        return response()->json([
            'success' => true,
            'data' => new AmountResource($coinGecko->getPrice(
                $request->fromCoin,
                $request->toCoin,
                $request->fromAmount))
        ]);
    }
}
