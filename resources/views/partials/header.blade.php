<header class="header">
    <nav class="header-nav">
        <a class="header-nav-item" href="{{ url('/') }}">
            <img class="header-nav-item-img" src="{{ asset('img/logo.png') }}"/>
        </a>
        <a class="header-nav-item @active(shop)" href="{{ url('shop') }}">Shop</a>
        <a class="header-nav-item @active(contact)" href="{{ url('contact') }}">Contact</a>
        <div class="flex-spacer"></div>
        <a class="header-nav-item @activeCurrency(eur) currency" href="{{ request()->url() }}?currency=eur">
            <img src="{{ asset('img/eur.png') }}"/>
            <span>EUR</span>
        </a>
        <a class="header-nav-item @activeCurrency(usd) currency" href="{{ request()->url() }}?currency=usd">
            <img src="{{ asset('img/usd.png') }}"/>
            <span>USD</span>
        </a>
        <a class="header-nav-item @active(cart)" href="{{ url('shop/cart') }}">
            Cart &ndash;
            <span class="header-cart-count">{{ $cart->getTotalCount() }}</span>
        </a>
    </nav>
</header>
