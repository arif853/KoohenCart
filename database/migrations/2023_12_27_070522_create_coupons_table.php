<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupons_title');
            $table->string('coupons_code');
            $table->string('start_date');
            $table->string('end_date');
            $table->tinyInteger('free_shipping')->nullable();
            $table->integer('quantity');
            $table->integer('percent_value')->nullable();
            $table->double('fixed')->nullable();
            $table->enum('discounts_type',['percent','fixed'])->default('percent');
            $table->enum('status',['0','1'])->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
