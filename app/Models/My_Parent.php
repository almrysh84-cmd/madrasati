<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class My_Parent extends Authenticatable
{
    use HasFactory, HasTranslations, Notifiable;

    public $translatable  = ['Name_Father', 'Job_Father','Name_Mother','Job_Mother'];

    /**
     * P0-9 fix: Mass Assignment — explicit $fillable.
     * password is included because AddParent uses $parent->update(['password' => ...]).
     * Hash::make() is applied by the controller before assignment.
     */
    protected $fillable = [
        'email', 'password',
        'Name_Father', 'National_ID_Father', 'Passport_ID_Father',
        'Phone_Father', 'Job_Father', 'Nationality_Father_id',
        'Blood_Type_Father_id', 'Religion_Father_id', 'Address_Father',
        'Name_Mother', 'National_ID_Mother', 'Passport_ID_Mother',
        'Phone_Mother', 'Job_Mother', 'Nationality_Mother_id',
        'Blood_Type_Mother_id', 'Religion_Mother_id', 'Address_Mother',
    ];


    protected $table = 'my__parents';

    public function getAuthIdentifierName()
    {
        return 'email';
    }

    public function getAuthPasswordName()
    {
        return 'password';
    }

    /**
     * علاقة مع الأبناء (الطلاب المرتبطون بولي الأمر)
     */
    public function students()
    {
        return $this->hasMany('App\Models\Student', 'parent_id');
    }
}
