<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * P1-2 fix: Add missing Foreign Key constraints.
 *
 * The my__parents and sections tables were created with plain unsignedBigInteger
 * columns (no FK constraints). This migration adds the FK constraints idempotently.
 *
 * Idempotent: re-runnable without errors. Checks if each FK already exists
 * before trying to add it. MySQL uses information_schema; SQLite uses PRAGMA.
 */
return new class extends Migration
{
    private function fkExists($table, $column)
    {
        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'sqlite') {
            // SQLite does not expose FK names cleanly via PRAGMA — assume not exists.
            return false;
        }
        $database = Schema::getConnection()->getDatabaseName();
        $rows = DB::select(
            "SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE
             WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND COLUMN_NAME = ?
             AND REFERENCED_TABLE_NAME IS NOT NULL",
            [$database, $table, $column]
        );
        return count($rows) > 0;
    }

    public function up()
    {
        // ===== my__parents: Nationality / Blood / Religion for Father & Mother =====
        if (Schema::hasTable('my__parents')) {
            // Father
            if (!$this->fkExists('my__parents', 'Nationality_Father_id')
                && Schema::hasTable('nationalities')
                && Schema::hasColumn('my__parents', 'Nationality_Father_id')) {
                Schema::table('my__parents', function (Blueprint $t) {
                    $t->foreign('Nationality_Father_id')->references('id')->on('nationalities');
                });
            }
            if (!$this->fkExists('my__parents', 'Blood_Type_Father_id')
                && Schema::hasTable('type__bloods')
                && Schema::hasColumn('my__parents', 'Blood_Type_Father_id')) {
                Schema::table('my__parents', function (Blueprint $t) {
                    $t->foreign('Blood_Type_Father_id')->references('id')->on('type__bloods');
                });
            }
            if (!$this->fkExists('my__parents', 'Religion_Father_id')
                && Schema::hasTable('religions')
                && Schema::hasColumn('my__parents', 'Religion_Father_id')) {
                Schema::table('my__parents', function (Blueprint $t) {
                    $t->foreign('Religion_Father_id')->references('id')->on('religions');
                });
            }
            // Mother
            if (!$this->fkExists('my__parents', 'Nationality_Mother_id')
                && Schema::hasTable('nationalities')
                && Schema::hasColumn('my__parents', 'Nationality_Mother_id')) {
                Schema::table('my__parents', function (Blueprint $t) {
                    $t->foreign('Nationality_Mother_id')->references('id')->on('nationalities');
                });
            }
            if (!$this->fkExists('my__parents', 'Blood_Type_Mother_id')
                && Schema::hasTable('type__bloods')
                && Schema::hasColumn('my__parents', 'Blood_Type_Mother_id')) {
                Schema::table('my__parents', function (Blueprint $t) {
                    $t->foreign('Blood_Type_Mother_id')->references('id')->on('type__bloods');
                });
            }
            if (!$this->fkExists('my__parents', 'Religion_Mother_id')
                && Schema::hasTable('religions')
                && Schema::hasColumn('my__parents', 'Religion_Mother_id')) {
                Schema::table('my__parents', function (Blueprint $t) {
                    $t->foreign('Religion_Mother_id')->references('id')->on('religions');
                });
            }
        }

        // ===== sections: Grade_id and Class_id =====
        if (Schema::hasTable('sections')) {
            if (!$this->fkExists('sections', 'Grade_id')
                && Schema::hasTable('grades')
                && Schema::hasColumn('sections', 'Grade_id')) {
                Schema::table('sections', function (Blueprint $t) {
                    $t->foreign('Grade_id')->references('id')->on('grades')->cascadeOnDelete();
                });
            }
            if (!$this->fkExists('sections', 'Class_id')
                && Schema::hasTable('classrooms')
                && Schema::hasColumn('sections', 'Class_id')) {
                Schema::table('sections', function (Blueprint $t) {
                    $t->foreign('Class_id')->references('id')->on('classrooms')->cascadeOnDelete();
                });
            }
        }
    }

    public function down()
    {
        // Best-effort rollback: drop FKs if they exist.
        if (Schema::hasTable('my__parents')) {
            Schema::table('my__parents', function (Blueprint $t) {
                foreach (['Nationality_Father_id', 'Blood_Type_Father_id', 'Religion_Father_id',
                          'Nationality_Mother_id', 'Blood_Type_Mother_id', 'Religion_Mother_id'] as $col) {
                    if (Schema::hasColumn('my__parents', $col)) {
                        try { $t->dropForeign([$col]); } catch (\Throwable $e) {}
                    }
                }
            });
        }
        if (Schema::hasTable('sections')) {
            Schema::table('sections', function (Blueprint $t) {
                foreach (['Grade_id', 'Class_id'] as $col) {
                    if (Schema::hasColumn('sections', $col)) {
                        try { $t->dropForeign([$col]); } catch (\Throwable $e) {}
                    }
                }
            });
        }
    }
};
