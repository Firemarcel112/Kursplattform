<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class VerificationLinkGenerator
{
	/**
	 * Generiert einen temporären signierten Link für die Verifizierung eines Benutzers.
	 *
	 * @param int $user_id
	 * @param string $route_name
	 * @param int $expire in Minuten (Standard: 60)
	 * @return string
	 */
	public function forUser(int $user_id, string $route_name, int $expire = 60): string
	{
		return URL::temporarySignedRoute(
			$route_name,
			Carbon::now()->addMinutes($expire),
			['id' => $user_id]
		);
	}
}
