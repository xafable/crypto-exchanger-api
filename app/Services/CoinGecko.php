<?php


namespace App\Services;


use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CoinGecko
{

    private CoinGeckoClient $client;

    function __construct(){
        $this->client = new CoinGeckoClient();
    }

    function ping(){
        return $this->client->ping();
    }

    function getPriceList(){
        return $this
            ->client
            ->simple()
            ->getPrice('bitcoin,ethereum,tether,binancecoin,ripple', 'usd');
    }

    function getPrice(){
        return $this->client->simple()->getPrice('0x,bitcoin', 'usd,rub');
    }

}
