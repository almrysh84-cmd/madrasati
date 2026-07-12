<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * P1-1 fix: Add a 'role' column to the users (admin) table for fine-grained RBAC.
 *
 * Default role is 'admin' so existing users are not locked out.
 * Allowed values: admin (super admin), editor (manage students/teachers),
 *                 accountant (manage fees/payments), viewer (read-only).
 *
 * Teacher / Student / Parent guards are already isolated by their own auth
 * guards; this column is for separating admin privileges only.
 *
 * Apply the 'role:admin' middleware to sensitive routes (backup, settings, etc.).
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Only add the column if it doesn't already exist (idempotent)
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('admin')->after('email');
            }
        });
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};
