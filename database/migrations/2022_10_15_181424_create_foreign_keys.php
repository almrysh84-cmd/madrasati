<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        // FK constraints are handled at application level to avoid
        // seeding issues with case-sensitive column names
    }

    public function down()
    {
        // No FK constraints to remove
    }
};