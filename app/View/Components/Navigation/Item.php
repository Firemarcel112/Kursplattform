<?php

namespace App\View\Components\Navigation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Item extends Component
{
    public string $route_name;
    public string $icon_name;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        string $routeName = '',
        public string $url = '',
        string $iconName = '',
    ) {
        $this->route_name = $routeName;
        $this->icon_name = $iconName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation.item');
    }

    /**
     * Prüft ob die Aktuelle Route die Aktive seite ist
     *
     * @return string
     */
    public function isActive(): string
    {
        return request()->routeIs($this->route_name) || request()->routeIs($this->route_name . '.*') ? 'active' : '';
    }

    /**
     * Gibt die URL des Navigationselements zurück.
     *
     * @return string
     */
    public function getUrl()
    {
        if (!empty($this->url)) {
            return $this->url;
        }

        if (!empty($this->route_name)) {
            return route($this->route_name);
        }

        return '#';
    }
}
