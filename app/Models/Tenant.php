<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'domain', 'email', 'phone', 'address',
        'logo', 'plan', 'trial_ends_at', 'is_active', 'settings',
    ];

    protected $casts = [
        'settings'       => 'array',
        'trial_ends_at'  => 'datetime',
        'is_active'      => 'boolean',
    ];

    /**
     * علاقة مع الطلاب
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * علاقة مع المعلمين
     */
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    /**
     * علاقة مع أولياء الأمور
     */
    public function parents()
    {
        return $this->hasMany(My_Parent::class);
    }

    /**
     * علاقة مع المستخدمين (الإدارة)
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * هل المدرسة نشطة؟
     */
    public function isActive(): bool
    {
        return $this->is_active && ($this->trial_ends_at === null || $this->trial_ends_at->isFuture());
    }

    /**
     * نطاق المدرسة (subdomain)
     */
    public function getUrlAttribute(): string
    {
        return $this->domain ?: $this->slug . '.madrasati.com';
    }
}
