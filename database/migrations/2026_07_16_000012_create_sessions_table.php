<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create the sessions table.
 *
 * Required because we switched SESSION_DRIVER from 'file' to 'database' on
 * Railway. The 'file' driver was unreliable across Railway redeployments
 * and load-balanced replicas — CSRF tokens would vanish, causing HTTP 419
 * "Page Expired" errors on every login attempt.
 *
 * The 'database' driver stores sessions in MySQL, which is shared across
 * all replicas and survives redeployments.
 */
return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->text('payload');
                $table->integer('last_activity')->index();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
};
