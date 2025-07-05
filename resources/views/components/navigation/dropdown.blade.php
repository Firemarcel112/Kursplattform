@props([
    'title' => '',
    'icon' => '', // SVG als String
    'items' => [], // Array von Menüpunkten
])

<li class="nav-item dropdown">
    <a aria-expanded="false" class="nav-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown" href="#navbar-base" role="button">
        @if ($icon)
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <x-icon :name="$icon ?? ''" />
            </span>
        @endif
        <span class="nav-link-title">{{ $title }}</span>
    </a>

    <div class="dropdown-menu">
        <div class="dropdown-menu-columns">
            @foreach (array_chunk($items, ceil(count($items) / 2)) as $column)
                <div class="dropdown-menu-column">
                    @foreach ($column as $item)
                        @if (isset($item['divider']))
                            <div class="dropdown-divider"></div>
                        @elseif(isset($item['submenu']))
                            <div class="dropend">
                                <a class="dropdown-item dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown" href="#{{ $item['id'] ?? 'submenu' }}" role="button">
                                    {{ $item['label'] }}
                                </a>
                                <div class="dropdown-menu">
                                    @foreach ($item['submenu'] as $subitem)
                                        <a class="dropdown-item" href="{{ $subitem['url'] }}">
                                            {{ $subitem['label'] }}
                                            @if (isset($subitem['badge']))
                                                <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">{{ $subitem['badge'] }}</span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a class="dropdown-item" href="{{ $item['url'] }}">
                                {{ $item['label'] }}
                                @if (isset($item['badge']))
                                    <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">{{ $item['badge'] }}</span>
                                @endif
                            </a>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</li>
