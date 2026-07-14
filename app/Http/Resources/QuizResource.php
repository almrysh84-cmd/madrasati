<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->getTranslation('name', 'ar'),
            'subject'          => $this->subject ? $this->subject->getTranslation('name', 'ar') : null,
            'grade'            => $this->grade ? $this->grade->getTranslation('Name', 'ar') : null,
            'classroom'        => $this->classroom ? $this->classroom->getTranslation('Name_Class', 'ar') : null,
            'duration_minutes' => $this->duration_minutes,
            'passing_score'    => (float) $this->passing_score,
            'max_attempts'     => $this->max_attempts,
            'shuffle'          => (bool) $this->shuffle_questions,
            'anti_cheat'       => (bool) $this->anti_cheat,
            'questions_count'  => $this->whenLoaded('questions', fn() => $this->questions->count()),
            'available_from'   => $this->available_from?->toISOString(),
            'available_to'     => $this->available_to?->toISOString(),
        ];
    }
}
