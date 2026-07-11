<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Grade extends Model
{

    use HasTranslations, LogsActivity;

    /**
     * إعدادات تسجيل النشاطات
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['Name', 'Notes'])
            ->logOnlyDirty()
            ->useLogName('grade')
            ->setDescriptionForEvent(fn(string $eventName) => "تم {$eventName} مرحلة دراسية");
    }
    public $translatable  = ['Name'];

    protected $fillable=['Name','Notes'];
    protected $table = 'grades';
    public $timestamps = true;

    public function Section()
    {
        return $this->hasMany('App\Models\Section','Grade_id');
    }

}