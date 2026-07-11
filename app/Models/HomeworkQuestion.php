<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeworkQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    // جلب الواجب المرتبط بالسؤال
    public function homework()
    {
        return $this->belongsTo('App\Models\Homework', 'homework_id');
    }
}
