<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, viewport-fit=cover" name="viewport" />
    <meta content="ie=edge" http-equiv="X-UA-Compatible" />
    <title>{{ $page_title ?? config('app.name') }}</title>

    <link href="{{ config('app.cdn_url') }}/css/tabler.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ config('app.cdn_url') }}/js/tabler.min.js"></script>
    <script src="{{ config('app.cdn_url') }}/js/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>
