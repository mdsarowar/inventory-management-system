<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_serials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pur_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('emei_number')->nullable();
            $table->string('is_sold')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_serials');
    }
};
