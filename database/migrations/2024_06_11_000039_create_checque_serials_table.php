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
        Schema::create('checque_serials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('checque_id')->nullable();
            $table->string('checque_serial')->nullable();
            $table->string('is_used')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checque_serials');
    }
};
