<?php

namespace Vinfo\Policies;

use Illuminate\Database\Eloquent\Model;
use Vinfo\User;

class AdminPolicy
{
	public function before(User $user, $ability, Model $model)
	{
		if (!is_callable([$this, camel_case($ability)])) {
			return $user->is_admin;
		}
	}

	public function destroy(User $user, Model $model)
	{
		return $user->is_admin;
	}

}
