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
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id')->nullable();
            $table->string('sotck_qty')->nullable();
            $table->string('pur_id')->nullable();
            $table->string('sell_qty')->nullable();
            $table->string('purches_ret')->nullable();
            $table->string('sell_ret')->nullable();
            $table->string('transfer')->nullable();
            $table->string('available')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('size_id')->nullable();
            $table->string('color_id')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
