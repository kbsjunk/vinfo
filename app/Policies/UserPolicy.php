<?php

namespace Vinfo\Policies;

use Illuminate\Database\Eloquent\Model;
use Vinfo\User;

class UserPolicy extends AdminPolicy
{
    /**
     * Determine if the given user can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return bool
     */
    public function update(User $user, User $model)
    {
        return $user->is_admin || $user->id === $model->id;
    }

    /**
     * Determine if the given user can be deleted by the user.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function destroy(User $user, Model $model)
    {
        return $user->is_admin && $model->id !== 1 && $user->id !== $model->id;
    }
}
