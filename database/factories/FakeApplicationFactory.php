<?php

namespace Database\Factories;

use App\Models\CoinLov;
use App\Models\FakeApplication;
use App\Services\CoinGecko;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FakeApplicationFactory extends Factory
{

    protected $model = FakeApplication::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fromCoin = CoinLov::query()
            ->inRandomOrder()
            ->first();

        $toCoin = CoinLov::query()
            ->where('coin_title','<>',$fromCoin->coin_title)
            ->inRandomOrder()
            ->first();

        $fromCoinAmount = fake()->randomFloat(null,$fromCoin->minimal_exchange,$fromCoin->available);
        $coinGecko = new CoinGecko();
        $toCoinAmount = $coinGecko->getPrice($fromCoin->coin_title,$toCoin->coin_title,$fromCoinAmount);

        return [
            'from_coin_title' =>$fromCoin->coin_title,
            'from_coin_amount' => $fromCoinAmount,
            'to_coin_title' => $toCoin->coin_title,
            'to_coin_amount' => $toCoinAmount,
            'applicant_email' => fake()->unique()->Email(),
            'created_at' => Carbon::now(),
            'updated_at' => null,
        ];
    }
}
