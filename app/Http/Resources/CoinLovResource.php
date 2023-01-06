<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoinLovResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title' => $this->coin_title,
            'shortTitle' => $this->coin_short_title,
            'available' => $this->available * mt_rand (0.9*10, 1.1*10) / 10 ,
            'walletAddress'=> $this->wallet_address,
            'blockchain'=>$this->blockchain,
            'amount'=>$this->amount,
            'minimalExchange' => $this->minimal_exchange
        ];
    }
}
