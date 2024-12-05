<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->ondelete('cascade')->onupdate('cascade');
            $table->datetime('shipping_date');
            $table->string('tracking_code', 20);
            $table->enum('status', ['being processed', 'Delivered', 'Done'])->default('being processed');
            $table->string('foto_kurir', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('deliveries');

    }
};
