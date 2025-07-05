<?php

namespace App\Services;

class AlertService
{
	/**
	 * fügt eine Erfolgsmeldung hinzu
	 *
	 * @param string $message
	 * @return void
	 */
	public function success(string $message): void
	{
		$this->addAlert('success', $message);
	}

	/**
	 * Fügt eine Fehlermeldung hinzu
	 *
	 * @param string $message
	 * @return void
	 */
	public function error(string $message): void
	{
		$this->addAlert('danger', $message);
	}

	/**
	 * fügt eine Informationsmeldung hinzu
	 *
	 * @param string $message
	 * @return void
	 */
	public function info(string $message): void
	{
		$this->addAlert('info', $message);
	}

	/**
	 * fügt eine Warnmeldung hinzu
	 *
	 * @param string $message
	 * @return void
	 */
	public function warning(string $message): void
	{
		$this->addAlert('warning', $message);
	}

	/**
	 * fügt ein Alert hinzu
	 *
	 * @param string $type
	 * @param string $message
	 * @return void
	 */
	protected function addAlert(string $type, string $message): void
	{
		$alerts = session()->get('alerts', []);

		$alerts[] = [
			'type' => $type,
			'message' => $message,
		];

		session()->flash('alerts', $alerts);
	}
}
