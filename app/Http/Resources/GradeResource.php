<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GradeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'student_name'  => $this->student ? $this->student->getTranslation('name', 'ar') : null,
            'quiz_name'     => $this->quizze ? $this->quizze->getTranslation('name', 'ar') : null,
            'subject'       => $this->quizze && $this->quizze->subject
                                ? $this->quizze->subject->getTranslation('name', 'ar') : null,
            'score'         => (float) $this->score,
            'date'          => $this->date,
            'abuse'         => (bool) $this->abuse,
        ];
    }
}
