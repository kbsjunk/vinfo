<?php

namespace Vinfo\Policies;

use Vinfo\User;

class ConsumedReasonPolicy
{
	public function before($user, $ability)
	{
		return $user->is_admin;
	}

}
