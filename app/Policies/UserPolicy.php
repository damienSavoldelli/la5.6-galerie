<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\User  $userprofile
     * @return mixed
     */
    public function update(User $user, User $userProfile)
    {
        return $user->id === $userProfile->id;
    }

}
