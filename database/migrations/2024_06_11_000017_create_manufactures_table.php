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
        Schema::create('manufactures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('bname')->nullable();
            $table->string('address')->nullable();
            $table->string('cperson')->nullable();
            $table->string('cmobile')->nullable();
            $table->string('email')->nullable();
            $table->string('web')->nullable();
            $table->string('rank')->nullable();
            $table->string('mainproduct')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manufactures');
    }
};
