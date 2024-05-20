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
        Schema::create('web_infos', function (Blueprint $table) {
            $table->id();
            $table->string('appName');
            $table->string('ownerName')->nullable();
            $table->string('address')->nullable();
            $table->longText('description')->nullable();
            $table->date('startDate')->nullable();
            $table->string('weblogo');
            $table->string('webfavicon');
            $table->string('marquee')->nullable();
            $table->string('copyright');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
