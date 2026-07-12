<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtqanVisitor extends Model
{
    use HasFactory;

    /**
     * P0-9 fix: Mass Assignment — explicit $fillable.
     */
    protected $fillable = ['count'];
}
