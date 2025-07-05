<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Icon extends Component
{
    public string $hover_placement;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public int $width = 24,
        public int $height = 24,
        public string $classes = '',
        public string $hovertext = '',
        public string $title = '',
        string $hoverPlacement = 'top',
    ) {
        $this->hover_placement = $hoverPlacement;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.icon');
    }

    /**
     * Gibt die Default Werte für Hover Text zurück
     *
     * @return string
     */
    public function getHoverTextAttributes()
    {
        if (!empty($this->hovertext)) {
            return 'data-bs-toggle="popover" data-bs-placement="' . ($this->hover_placement ?? 'top') . '" data-bs-trigger="hover" title="' . ($this->title ?? 'TEST') . '" data-bs-content="' . ($this->hovertext ?? 'TEST') . '"';
        }
        return '';
    }
}
