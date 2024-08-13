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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('sup_code')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('nid')->nullable();
            $table->string('cperson')->nullable();
            $table->string('cmobile')->nullable();
            $table->string('creditlimit')->nullable();
            $table->string('balance')->nullable();
            $table->string('image')->nullable();
            $table->string('rank')->nullable();
            $table->string('address')->nullable();
            $table->longText('note')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
