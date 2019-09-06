<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="UTF-8" />
    <title>Styleguide</title>
    <base href="{{ url('/') }}" />
    <meta name="robots" content="index, follow" />
    <meta name="author" content="Rein Van Oyen" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('vendor/atomic-styleguide/css/styleguide.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

</head>
<body>

    <div class="styleguide">
        <div class="styleguide-title">{{ config('styleguide.name')  }}</div>
        <div class="styleguide-content">
            @yield('body')
        </div>
    </div>
    <script src="{{ asset('js/app.js')  }}"></script>

</body>
</html>