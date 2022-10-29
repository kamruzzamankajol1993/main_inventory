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
        Schema::create('purchasereturns', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_lot_number')->nullable();
            $table->string('vendor_id')->nullable();
            $table->string('request_id')->nullable();
            $table->string('purchase_date')->nullable();
            $table->string('total_product')->nullable();
            $table->string('total_quantity')->nullable();
            $table->string('total_buy_price')->nullable();
            $table->string('term')->nullable();
            $table->string('total_due')->nullable();
            $table->string('total_paid')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('purchasereturns');
    }
};
