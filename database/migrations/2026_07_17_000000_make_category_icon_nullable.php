<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * category_icon is NOT NULL with no default, but the create/edit forms never
     * marked it required and CategoryController::store() only assigns it inside
     * `if ($request->hasFile('category_icon'))` - so adding a category without an
     * icon threw an uncaught QueryException ("Field 'category_icon' doesn't have
     * a default value"). Raw ALTER TABLE is used because doctrine/dbal (required
     * by ->change() on Laravel 10) is not installed.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE categories MODIFY category_icon VARCHAR(255) NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE categories MODIFY category_icon VARCHAR(255) NOT NULL');
    }
};
