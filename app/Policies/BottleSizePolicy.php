<?php

namespace Vinfo\Policies;

use Vinfo\User;

class BottleSizePolicy
{
	public function before($user, $ability)
	{
		return $user->is_admin;
	}
	
}
