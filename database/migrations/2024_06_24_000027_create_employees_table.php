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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('nid')->nullable();
            $table->string('dob')->nullable();
            $table->string('joining_date')->nullable();
            $table->string('salary')->nullable();
            $table->string('image')->nullable();
            $table->longText('address')->nullable();
            $table->longText('per_address')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
