<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Fix the sessions.user_id column type.
 *
 * The previous migration (2026_07_16_000012_create_sessions_table.php) was
 * originally deployed with `user_id` as `foreignId` (bigint unsigned). It ran
 * successfully on the first deploy and was marked as 'ran' in the migrations
 * table, so the updated 'else' branch in that file never executes.
 *
 * This NEW migration forces the column type change to VARCHAR(150) so that
 * Teacher/Parent sessions (which store the email address as user_id) can be
 * written without 'Incorrect integer value' SQL errors.
 *
 * Uses raw SQL because doctrine/dbal is not installed (Laravel 9's
 * Schema::table()->change() requires it).
 */
return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('sessions')) {
            return; // nothing to fix
        }

        $driver = Schema::getConnection()->getDriverName();
        if ($driver !== 'mysql') {
            return; // SQLite tests create the table correctly already
        }

        $database = Schema::getConnection()->getDatabaseName();

        // Check current column type
        $col = DB::select(
            "SELECT DATA_TYPE FROM information_schema.columns
             WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'sessions' AND COLUMN_NAME = 'user_id'",
            [$database]
        );

        if (empty($col) || strtolower($col[0]->DATA_TYPE) === 'varchar') {
            return; // already fixed or column doesn't exist
        }

        // Find any existing index on user_id and drop it
        $indexes = DB::select(
            "SELECT INDEX_NAME FROM information_schema.statistics
             WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'sessions' AND COLUMN_NAME = 'user_id'",
            [$database]
        );
        foreach ($indexes as $idx) {
            $idxName = $idx->INDEX_NAME;
            try {
                DB::statement("ALTER TABLE `sessions` DROP INDEX `{$idxName}`");
            } catch (\Throwable $e) {
                // Ignore — primary key cannot be dropped, etc.
            }
        }

        // Change column type to VARCHAR(150) NULL
        DB::statement("ALTER TABLE `sessions` MODIFY `user_id` VARCHAR(150) NULL");

        // Recreate a standard index
        try {
            DB::statement('CREATE INDEX `sessions_user_id_index` ON `sessions` (`user_id`)');
        } catch (\Throwable $e) {
            // Index may already exist — silently skip
        }
    }

    public function down()
    {
        // No-op — we don't want to revert to the broken bigint column.
    }
};
