<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function creating(User $user): void
    {
        $user->password = \Hash::make($user->password);
    }

    public function created(User $user): void
    {
        $user->sendEmailVerificationNotification();
    }
}
