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
        if (!Schema::hasTable('offers')) {
            Schema::create('offers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('offer_type_id');
                $table->string('offer_name');
                $table->double('offer_percent');
                $table->string('to_date')->nullable();
                $table->string('from_date')->nullable();
                $table->string('day')->nullable();
                $table->foreign('offer_type_id')->references('id')->on('offer_types')->onDelete('cascade');
                $table->timestamps();
            });

            return;
        }

        Schema::table('offers', function (Blueprint $table) {
            if (!Schema::hasColumn('offers', 'offer_type_id')) {
                $table->unsignedBigInteger('offer_type_id')->nullable();
            }
            if (!Schema::hasColumn('offers', 'offer_name')) {
                $table->string('offer_name')->nullable();
            }
            if (!Schema::hasColumn('offers', 'offer_percent')) {
                $table->double('offer_percent')->nullable();
            }
            if (!Schema::hasColumn('offers', 'to_date')) {
                $table->string('to_date')->nullable();
            }
            if (!Schema::hasColumn('offers', 'from_date')) {
                $table->string('from_date')->nullable();
            }
            if (!Schema::hasColumn('offers', 'day')) {
                $table->string('day')->nullable();
            }
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->foreign('offer_type_id')->references('id')->on('offer_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
