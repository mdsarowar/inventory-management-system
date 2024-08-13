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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('price')->nullable();
            $table->string('quantity')->nullable();
            $table->string('created_by')->nullable();
            $table->string('image')->nullable();
            $table->string('min_quantity')->nullable();
            $table->string('tex')->nullable();
            $table->string('discount_type')->nullable();
            $table->decimal('discount')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('size_id')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->unsignedBigInteger('child_category_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('manufacture_id')->nullable();
            $table->string('bname')->nullable();
            $table->string('barcode')->nullable();
            $table->string('certificate')->nullable();
            $table->string('modelno')->nullable();
            $table->string('cost')->nullable();
            $table->string('wday')->nullable();
            $table->string('pmod')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('is_serial')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
