<?php

namespace Vinfo\Policies;

use Vinfo\User;

class CurrencyPolicy
{
	public function before($user, $ability)
	{
		return $user->is_admin;
	}

}
