<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained()->onDelete('cascade');
            $table->foreignId('productId')->constrained()->onDelete('cascade');
            $table->integer('offerPrice,');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bid_offers');
    }
}
