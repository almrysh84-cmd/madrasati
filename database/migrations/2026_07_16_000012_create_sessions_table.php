<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Create the sessions table (and fix the user_id column if it already exists).
 *
 * Required because we switched SESSION_DRIVER from 'file' to 'database' on
 * Railway. The 'file' driver was unreliable across Railway redeployments
 * and load-balanced replicas — CSRF tokens would vanish, causing HTTP 419
 * "Page Expired" errors on every login attempt.
 *
 * IMPORTANT: user_id is a STRING (varchar 150), not a foreignId (bigint),
 * because the Teacher and My_Parent models override getAuthIdentifierName()
 * to return 'email' (a string). A bigint user_id column rejects email values
 * with "Incorrect integer value" SQL errors when an authenticated teacher
 * or parent visits any page (HTTP 500).
 */
return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->string('user_id', 150)->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->text('payload');
                $table->integer('last_activity')->index();
            });
            return;
        }

        // Table already exists — fix the user_id column type if it's not already string.
        // Use raw SQL because doctrine/dbal is not installed (Laravel 9 change() requires it).
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            // Check current column type
            $database = Schema::getConnection()->getDatabaseName();
            $col = DB::select(
                "SELECT DATA_TYPE, COLUMN_TYPE FROM information_schema.columns
                 WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'sessions' AND COLUMN_NAME = 'user_id'",
                [$database]
            );

            if (!empty($col) && strtolower($col[0]->DATA_TYPE) !== 'varchar') {
                // Drop the existing index first (if any) to avoid conflicts
                try {
                    DB::statement('ALTER TABLE `sessions` DROP INDEX `sessions_user_id_index`');
                } catch (\Throwable $e) {
                    // Index may have a different name or not exist — try without it
                }

                // Alter the column to varchar(150)
                DB::statement("ALTER TABLE `sessions` MODIFY `user_id` VARCHAR(150) NULL");

                // Recreate the index
                try {
                    DB::statement('CREATE INDEX `sessions_user_id_index` ON `sessions` (`user_id`)');
                } catch (\Throwable $e) {
                    // Index may already exist — silently skip
                }
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
};
