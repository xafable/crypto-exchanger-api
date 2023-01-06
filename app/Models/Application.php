<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    function _status(){
        return $this->hasOne(Status::class,'title','status');
    }

    function fromCoin(){
        return $this->hasOne(CoinLov::class,'coin_title','from_coin_title')
            ->select('*')
            ->selectRaw('? as amount', [$this->from_coin_amount])
            ->where('blockchain','=',$this->from_blockchain);
    }







}
