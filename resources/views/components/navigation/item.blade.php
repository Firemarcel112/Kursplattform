<li class="nav-item {{ $isActive() }}">
    <a class="nav-link" href="{{ $getUrl() }}">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            @empty(!$icon_name)
                <x-icon name="{{ $icon_name }}" />
            @endempty
        </span>
        <span class="nav-link-title">{{ $name }}</span>
    </a>
</li>
