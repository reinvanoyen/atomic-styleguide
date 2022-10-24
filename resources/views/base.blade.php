<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <title>{{ config('styleguide.name') }}</title>
    <base href="{{ url('/') }}" />
    <meta name="robots" content="index, follow" />
    <meta name="author" content="Rein Van Oyen" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('vendor/atomic-styleguide/css/styleguide.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro&display=swap" rel="stylesheet" />
    @vite(config('styleguide.load_with_vite'))
</head>
<body>
    <div class="asg-styleguide">
        <div class="asg-styleguide__header">
            <div class="breadcrumbs">
                @section('header')
                    <a class="breadcrumbs__item" href="{{  route('styleguide.index') }}">
                        {{ config('styleguide.name') }}
                    </a>
                @show
            </div>
        </div>
        <div class="asg-styleguide__content">
            @yield('body')
        </div>
    </div>
</body>
</html>
