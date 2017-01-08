<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:300,300i|Roboto:300"
          crossorigin="anonymous">
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">

    @yield('head')

    <title>{{ $title }} | Ping Pong Shop</title>
</head>

<body>
    @include('partials.header')

    <main class="main">
        @yield('content')
    </main>

    @include('partials.footer')

    @yield('scripts')
</body>
</html>
