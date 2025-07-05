<?php

namespace App\View\Components\Form\Input;

use Illuminate\View\Component;

class Password extends Component
{
	public string $name;
	public string $label;
	public string $inputClass;
	public string $divClass;

	public function __construct(
		string $name = 'password',
		string $label = 'Passwort',
		string $inputClass = '',
		string $divClass = ''
	) {
		$this->name = $name;
		$this->label = $label;
		$this->inputClass = $inputClass;
		$this->divClass = $divClass;
	}

	public function render()
	{
		return view('components.form.input.password');
	}
}
