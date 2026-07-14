<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'accountant']);
    }

    public function view(User $user, Payment $payment): bool
    {
        return in_array($user->role, ['admin', 'accountant']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'accountant']);
    }

    public function update(User $user, Payment $payment): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Payment $payment): bool
    {
        return $user->role === 'admin';
    }

    public function refund(User $user, Payment $payment): bool
    {
        return $user->role === 'admin';
    }
}
