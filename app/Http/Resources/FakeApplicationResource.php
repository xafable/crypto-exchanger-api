<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FakeApplicationResource extends JsonResource
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
            'fromCoinTitle'=> $this->from_coin_title,
            'fromCoinAmount'=> $this->from_coin_amount,
            'toCoinTitle'=> $this->to_coin_title,
            'toCoinAmount'=> $this->to_coin_amount,
            'applicantEmail'=> strtok($this->applicant_email, '@').'@***',
        ];
    }
}
