<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Allow announcements.created_by to reference either users (admins) OR teachers.
 *
 * Previously created_by was a foreignId('users') — only admins could create
 * announcements. Now teachers need to create announcements for their students
 * (e.g. "I'll be late tomorrow", "Test on Sunday", etc.).
 *
 * Fix: drop the FK constraint + change column type to unsignedBigInteger so it
 * can reference either users.id or teachers.id (resolved at runtime via the
 * creator_type column).
 *
 * Idempotent.
 */
return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('announcements')) {
            return;
        }

        $driver = Schema::getConnection()->getDriverName();
        $database = Schema::getConnection()->getDatabaseName();

        if ($driver === 'mysql') {
            // Find and drop any FK constraint on created_by
            $fks = DB::select(
                "SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE
                 WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'announcements'
                 AND COLUMN_NAME = 'created_by' AND REFERENCED_TABLE_NAME IS NOT NULL",
                [$database]
            );
            foreach ($fks as $fk) {
                try {
                    DB::statement("ALTER TABLE `announcements` DROP FOREIGN KEY `{$fk->CONSTRAINT_NAME}`");
                } catch (\Throwable $e) {
                    // ignore
                }
            }

            // Change column type to unsignedBigInteger (no FK)
            DB::statement("ALTER TABLE `announcements` MODIFY `created_by` BIGINT UNSIGNED NOT NULL");
        }
    }

    public function down()
    {
        // No-op — we don't want to revert to the broken FK-only state.
    }
};
