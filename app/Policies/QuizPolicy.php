<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Quizze;
use App\Models\Student;
use App\Models\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Quizze $quiz): bool
    {
        return $user->role === 'admin' || $quiz->teacher_id === $user->id;
    }

    public function update(User $user, Quizze $quiz): bool
    {
        return $user->role === 'admin' || $quiz->teacher_id === $user->id;
    }

    public function delete(User $user, Quizze $quiz): bool
    {
        return $user->role === 'admin' || $quiz->teacher_id === $user->id;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor', 'teacher']);
    }
}
