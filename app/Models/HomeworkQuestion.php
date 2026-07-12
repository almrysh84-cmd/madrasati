<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeworkQuestion extends Model
{
    use HasFactory;

    /**
     * P0-9 fix: Mass Assignment — explicit $fillable.
     */
    protected $fillable = [
        'homework_id', 'title', 'answers', 'right_answer', 'score',
    ];

    // جلب الواجب المرتبط بالسؤال
    public function homework()
    {
        return $this->belongsTo('App\Models\Homework', 'homework_id');
    }
}
