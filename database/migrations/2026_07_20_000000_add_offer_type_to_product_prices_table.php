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
        Schema::table('product_prices', function (Blueprint $table) {
            // Percentage and amount are both always stored (one entered by the
            // admin, the other derived) so the storefront/admin display can show
            // a percentage regardless of which mode was used. Without a real
            // "which one did the admin actually pick" flag, that made it
            // impossible to tell the two modes apart later - e.g. re-opening the
            // edit form couldn't reliably pre-select the right radio.
            $table->string('offer_type')->nullable()->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_prices', function (Blueprint $table) {
            $table->dropColumn('offer_type');
        });
    }
};
