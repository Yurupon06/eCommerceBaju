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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();  
            $table->string('name', 50);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('phone', 20);
            $table->text('alamat1');
            $table->text('alamat2')->nullable();
            $table->text('alamat3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('customers');
    }
};
