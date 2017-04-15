<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="7lJH_awwD78EYulxxv-rakpDEyrlUJbO5mgAr937V68">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <style>
        @font-face {
            font-family: Hind;
            src: url({{ asset('fonts/hind.ttf') }}) format('truetype');
        }
    </style>

    <title>{{ $title }} &ndash; TTEmpire</title>
</head>
<body>
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
    @stack('scripts')

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
