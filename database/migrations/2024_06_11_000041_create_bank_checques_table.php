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
        Schema::create('bank_checques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bank_account_id')->nullable();
            $table->string('quntity')->nullable();
            $table->tinyInteger('is_serial')->nullable();
            $table->string('reference')->nullable();
            $table->string('issue_date')->nullable();
            $table->string('amount')->nullable();
            $table->text('note')->nullable();
            $table->text('user_id')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('bank_checques');
    }
};
