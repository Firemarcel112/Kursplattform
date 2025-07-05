<?php

namespace App\Services;

/**
 * Verantwortlich für dass Dispatchen von Events
 */
class EventDispatchService
{
	/**
	 * Dispatcht ein Event
	 *
	 * @param string|object $event
	 * @return void
	 */
	public function dispatch(string|Object $event): void
	{
		event($event);
	}
}
