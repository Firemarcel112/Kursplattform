<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')

    <body data-bs-theme="dark">
        <div class="page page-center">
            <div class="container container-tight py-4">
                @yield('content')
            </div>
    </body>

</html>
