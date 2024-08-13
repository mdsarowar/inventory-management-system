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
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('store_code')->nullable();
            $table->string('mobile')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('company_id');
//            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('incharge');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
