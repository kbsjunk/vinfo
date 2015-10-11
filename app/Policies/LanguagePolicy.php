<?php

namespace Vinfo\Policies;

use Vinfo\User;

class LanguagePolicy
{
	public function before($user, $ability)
	{
		return $user->is_admin;
	}

}
