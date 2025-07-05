<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')

    <body data-bs-theme="dark">
        <div class="page">
            @include('layouts.header')
            @include('layouts.navigation')

            <div class="page-wrapper">
                <div class="page-header d-print-none">
                    @hasSection('title')
                        <div class="container-xl">
                            <div class="row g-2 align-items-center">
                                <div class="col">
                                    <div class="page-pretitle">
                                        @yield('pretitle', config('app.name'))
                                    </div>
                                    <h2 class="page-title">
                                        @yield('title', config('app.name'))
                                    </h2>
                                </div>
                            </div>
                            <div class="col-auto ms-auto d-print-none">
                                @yield('header_buttons')
                            </div>
                        </div>
                    @endif
                </div>
                <div class="page-body">
                    <div class="container-xl">
                        @include('partials.alerts')
                        <div class="row row-deck row-cards">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
