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
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('page_header')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('mobile')->nullable();
            $table->string('tin')->nullable();
            $table->string('vat')->nullable();
            $table->string('tin_image')->nullable();
            $table->string('license')->nullable();
            $table->string('license_image')->nullable();
            $table->string('web')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('slug')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
