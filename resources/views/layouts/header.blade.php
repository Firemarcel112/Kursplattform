<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <button aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-bs-target="#navbar-menu" data-bs-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div></div>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                </div>
            </div>
            <div class="d-none d-md-flex">
                <div class="nav-item js-switch-light-dark-mode">
                    <x-icon classes="icon icon-1 cursor-pointer d-none js-hide-theme-dark" hover-placement="bottom" hovertext="{{ __('general.enable_night_mode') }}" name="moon" />
                    <x-icon classes="icon icon-1 cursor-pointer js-hide-theme-light" hover-placement="bottom" hovertext="{{ __('general.enable_day_mode') }}" name="sun" />
                </div>
            </div>
            @auth
                <div class="nav-item dropdown">
                    <a aria-label="Open user menu" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown" href="#">
                        <span class="avatar avatar-sm">{{ auth()->user()->initials }}</span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ auth()->user()->display_name }}</div>
                            <div class="mt-1 small text-secondary">ROLE NAME</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a class="dropdown-item" href="{{ route('logout') }}">{{ __('auth.logout') }}</a>
                    </div>
                </div>
            @else
                <div class="nav-item dropdown">
                    <a aria-label="Open user menu" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown" href="#">
                        <span class="avatar avatar-sm">{{ 'XX' }}</span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ __('general.guest') }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a class="dropdown-item" href="{{ route('login.index') }}">{{ __('auth.login_title') }}</a>
                        <a class="dropdown-item" href="{{ route('register.index') }}">{{ __('auth.register_title') }}</a>
                    </div>
                @endauth
            </div>
        </div>
</header>
