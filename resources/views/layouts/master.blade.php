<!DOCTYPE html>

<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amaranth|Roboto:300">

    <title>PingPongShop</title>
</head>

<body>
    @include('partials.header')

    <main class="main">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
