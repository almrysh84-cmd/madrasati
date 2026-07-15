<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true; // كل المستخدمين يمكنهم رؤية القائمة
    }

    public function view(User $user, Student $student): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function update(User $user, Student $student): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function delete(User $user, Student $student): bool
    {
        return $user->role === 'admin';
    }
}
