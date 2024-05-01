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
        Schema::create('socialinfos', function (Blueprint $table) {
            $table->id();
            $table->string('appPhone');
            $table->string('appEmail');
            $table->string('whatsapp');
            $table->string('facebook')->nullable();
            $table->string('instragram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('copyright');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socialinfos');
    }
};
