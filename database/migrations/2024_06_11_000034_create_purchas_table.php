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
        Schema::create('purchas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('inv_id')->nullable();
            $table->string('vendor_type')->nullable();
            $table->string('vendor')->nullable();
            $table->string('dis_type')->nullable();
            $table->string('discount')->nullable();
            $table->string('vat_type')->nullable();
            $table->string('vat')->nullable();
            $table->string('tax_type')->nullable();
            $table->string('tax')->nullable();
            $table->string('speed_money')->nullable();
            $table->string('others_name')->nullable();
            $table->string('other_amount')->nullable();
            $table->string('issue_date')->nullable();
            $table->string('freight')->nullable();
            $table->string('less')->nullable();
            $table->string('add_money')->nullable();
            $table->string('cur_id')->nullable();
            $table->string('ref')->nullable();
            $table->longText('note')->nullable();
            $table->string('date')->nullable();
            $table->string('due_date')->nullable();
            $table->string('due')->nullable();
            $table->string('total')->nullable();
            $table->string('sub_total')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('purchas');
    }
};
