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
        if (!Schema::hasColumn('sliders', 'btntext')) {
            Schema::table('sliders', function (Blueprint $table) {
                $table->string('btntext')->nullable()->after('subtitle');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('sliders', 'btntext')) {
            Schema::table('sliders', function (Blueprint $table) {
                $table->dropColumn('btntext');
            });
        }
    }
};
