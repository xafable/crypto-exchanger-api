<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApplicationResource;
use App\Http\Resources\FakeApplicationResource;
use App\Models\Application;
use App\Models\FakeApplication;
use App\Services\CoinGecko;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ApplicationController extends Controller
{
    function create(Request $request,CoinGecko $coinGecko){

        $toCoinAmount = $coinGecko->getPrice(
            $request->fromCoinTitle,
            $request->toCoinTitle,
            $request->fromCoinAmount);

        $application = Application::query()
            ->create([
                'from_coin_title'=>$request->fromCoinTitle,
                'to_coin_title'=>$request->toCoinTitle,
                'from_coin_amount'=>$request->fromCoinAmount,
                'to_coin_amount'=>$toCoinAmount,
                'from_blockchain'=>$request->fromBlockchain,
                'to_blockchain'=>$request->toBlockchain,
                'applicant_wallet_address'=>$request->applicantWalletAddress,
                'applicant_email'=>$request->applicantEmail,
                'applicant_info'=>$request->applicantInfo,
                'status'=>'waiting',
                'created_at'=> Carbon::now(),
                'updated_at'=> null,
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Application created. We are waiting for your payment.',
            'data' => new ApplicationResource($application)
        ]);

    }

    function get($id) {
        return response()->json([
            'success' => true,
            'data' => new ApplicationResource(Application::query()
                ->find($id))
        ]);
    }

    function getFakes(){

        FakeApplication::factory()->count(10)->create();

        return response()->json([
            'success' => true,
            'data' => FakeApplicationResource::collection(FakeApplication::query()
                ->paginate(10))
        ]);
    }
}
