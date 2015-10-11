<?php

namespace Vinfo\Policies;

use Vinfo\User;

class UserPolicy
{
    /**
     * Determine if the user can list users.
     *
     * @param  \App\User  $user
     * @param  \App\User  $given
     * @return bool
     */
    public function show(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine if the user can create users.
     *
     * @param  \App\User  $user
     * @param  \App\User  $given
     * @return bool
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine if the given user can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $given
     * @return bool
     */
    public function update(User $user, User $given)
    {
        return $user->is_admin || $user->id === $given->id;
    }

    /**
     * Determine if the given user can be deleted by the user.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function destroy(User $user, User $given)
    {
        return $user->is_admin && $given->id !== 1 && $user->id !== $given->id;
    }
}
