<?php


namespace App\Services;


use App\Models\CoinLov;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CoinGecko
{

    private CoinGeckoClient $client;

    function __construct(){
        $this->client = new CoinGeckoClient();
    }

    function ping() : array {
        return $this->client->ping();
    }

    function getPriceList() : array {
        return $this
            ->client
            ->simple()
            ->getPrice($this->getCoinsFromDb(), 'usd');
    }

    function getPrice(string $fromCoin,string $toCoin,float $fromCoinAmount) : float {
        $geckoId = $this->getGeckoIdFromDb($fromCoin);
        $fromCoinPrice = $this
            ->client
            ->simple()
            ->getPrice($geckoId, 'usd')[$geckoId]['usd'];

        $geckoId = $this->getGeckoIdFromDb($toCoin);
        $toCoinPrice = $this
            ->client
            ->simple()
            ->getPrice($geckoId, 'usd')[$geckoId]['usd'];

        $toCoinAmount = $fromCoinPrice/$toCoinPrice*$fromCoinAmount;

        return  $toCoinAmount;
    }

    private function getCoinsFromDb() : string {
       return CoinLov::query()
            ->get()
            ->pluck('coin_gecko_id')
            ->implode(',');
    }

    private function getGeckoIdFromDb(string $coinTitle) : string {
        return CoinLov::query()
            ->select('coin_gecko_id')
            ->where('coin_title','=',$coinTitle)
            ->value('coin_gecko_id');

    }

}
