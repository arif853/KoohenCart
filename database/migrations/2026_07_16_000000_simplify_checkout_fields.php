<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The simplified checkout collects name, phone, optional email, address and a
     * delivery zone. Email becomes nullable, the postcode-based division/district/
     * area columns become optional, and the chosen zone is recorded on the order.
     *
     * Raw ALTER statements are used because doctrine/dbal (required by ->change()
     * on Laravel 10) is not installed.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE customers MODIFY email VARCHAR(255) NULL');
        DB::statement('ALTER TABLE register_customers MODIFY email VARCHAR(255) NULL');

        // shippings.area is a FK to postcodes; it cannot stay NOT NULL once the
        // postcode selector is gone, and the FK has to go with it.
        Schema::table('shippings', function (Blueprint $table) {
            $table->dropForeign(['area']);
        });

        DB::statement('ALTER TABLE shippings MODIFY division VARCHAR(255) NULL');
        DB::statement('ALTER TABLE shippings MODIFY district VARCHAR(255) NULL');
        DB::statement('ALTER TABLE shippings MODIFY area BIGINT UNSIGNED NULL');
        DB::statement('ALTER TABLE shippings MODIFY s_email VARCHAR(255) NULL');

        Schema::table('orders', function (Blueprint $table) {
            $table->string('delivery_zone')->nullable()->after('delivery_charge');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('delivery_zone');
        });

        // Rows created by the simplified checkout have no area, so the FK can only
        // be restored once those rows are backfilled. Left off deliberately.
        DB::statement('ALTER TABLE shippings MODIFY s_email VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE register_customers MODIFY email VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE customers MODIFY email VARCHAR(255) NOT NULL');
    }
};
