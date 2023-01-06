<?php

namespace App\Http\Resources;

use App\Models\CoinLov;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //dd($this->fromCoin);
        $toCoin = CoinLov::query()
            ->select('*')
            ->selectRaw('? as amount', [$this->to_coin_amount])
            ->selectRaw('? as wallet_address', [$this->applicant_wallet_address])
            ->where('coin_title','=',$this->to_coin_title)
            ->where('blockchain','=',$this->to_blockchain)
            ->first();

        //dd($toCoin);



        return [
            'ApplicationId' => $this->id,
            'createdAt' => Carbon::createFromDate($this->created_at)->format('y-m-d H:i'),
            'status' => $this->_status,
            'fromCoin' => new CoinLovResource($this->fromCoin),
            'toCoin' => new CoinLovResource($toCoin)
        ];
    }
}
