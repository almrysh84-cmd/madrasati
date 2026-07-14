<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->getTranslation('name', 'ar'),
            'name_en'    => $this->getTranslation('name', 'en'),
            'email'      => $this->email,
            'gender'     => $this->gender ? $this->gender->getTranslation('Name', 'ar') : null,
            'grade'      => $this->grade ? $this->grade->getTranslation('Name', 'ar') : null,
            'classroom'  => $this->classroom ? $this->classroom->getTranslation('Name_Class', 'ar') : null,
            'section'    => $this->section ? $this->section->getTranslation('Name_Section', 'ar') : null,
            'birth_date' => $this->Date_Birth,
            'academic_year' => $this->academic_year,
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
