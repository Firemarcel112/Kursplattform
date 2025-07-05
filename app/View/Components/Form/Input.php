<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $value;

    public function __construct(
        public string $name,
        public string $label = '',
        public string $type = 'text',
        public string $inputClass = '',
        public string $divClass = '',
        public bool $required = false,
    ) {
        $this->value = old($name);
    }

    public function render()
    {
        return view('components.form.input');
    }
}
