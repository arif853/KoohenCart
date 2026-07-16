<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Checkout now auto-registers new customers with a random password and logs
     * them straight in, so we must know whether a customer has ever chosen their
     * own password: null password_set_at means "still on the generated one" and
     * drives the dashboard prompt.
     *
     * Customers get their own reset-token table rather than sharing the users one,
     * because both tables are keyed by email and the same address could exist in
     * each - a shared table would let a staff reset consume a customer's token.
     */
    public function up(): void
    {
        Schema::table('register_customers', function (Blueprint $table) {
            $table->timestamp('password_set_at')->nullable()->after('password');
        });

        Schema::create('customer_password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Customers that already existed chose their own password (or were given the
        // old phone-as-password default), so they must not be nagged to set one.
        DB::table('register_customers')
            ->whereNull('password_set_at')
            ->update(['password_set_at' => now()]);
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_password_reset_tokens');

        Schema::table('register_customers', function (Blueprint $table) {
            $table->dropColumn('password_set_at');
        });
    }
};
