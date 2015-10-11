<?php

namespace Vinfo\Policies;

use Vinfo\User;

class CountryPolicy
{
	public function before($user, $ability)
	{
		return $user->is_admin;
	}

}
