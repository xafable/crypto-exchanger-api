<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins_lov', function (Blueprint $table) {
            $table->id();
            $table->string('coin_title');
            $table->string('coin_short_title');
            $table->string('coin_gecko_id');
            $table->string('wallet_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.p
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_wallet_adresses_lov');
    }
};
