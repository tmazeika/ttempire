<header class="header">
    <nav class="header-nav">
        <a class="header-nav-item" href="{{ url('/') }}">
            <img class="header-nav-item-img" src="{{ asset('img/logo.png') }}"/>
        </a>
        <a class="header-nav-item @active(shop)" href="{{ url('shop') }}">Shop</a>
        <a class="header-nav-item @active(contact)" href="{{ url('contact') }}">Contact</a>
    </nav>
</header>
