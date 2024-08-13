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
        Schema::create('product_transections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trans_type')->nullable();
            $table->string('trans_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('color_id')->nullable();
            $table->string('size_id')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('qty')->nullable();
            $table->string('price')->nullable();
            $table->string('total_price')->nullable();
            $table->string('dis_type')->nullable();
            $table->string('dis')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('tax')->nullable();
            $table->string('vat_type')->nullable();
            $table->string('vat')->nullable();
            $table->string('pro_in')->nullable();
            $table->string('pro_out')->nullable();
            $table->string('pro_sell')->nullable();
            $table->string('pro_loc')->nullable();
            $table->unsignedBigInteger('purchas_id')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('branch_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_transections');
    }
};
