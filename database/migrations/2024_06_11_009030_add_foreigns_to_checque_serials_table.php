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
        Schema::table('checque_serials', function (Blueprint $table) {
            $table
                ->foreign('bank_checque_id')
                ->references('id')
                ->on('bank_checques')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checque_serials', function (Blueprint $table) {
            $table->dropForeign(['bank_checque_id']);
        });
    }
};
