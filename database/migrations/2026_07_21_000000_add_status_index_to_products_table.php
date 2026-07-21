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
        Schema::table('products', function (Blueprint $table) {
            // status is filtered on in almost every storefront query (Home,
            // Shop, single product page all do ->where('status', 'active'))
            // and had no index at all, so every one of those queries did a
            // full table scan - increasingly costly as the catalog grows
            // past a hundred or so rows.
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });
    }
};
