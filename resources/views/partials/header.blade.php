<header class="header">
    <div class="header-item rotatable header-img">
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/logo_ico.png') }}" alt="@lang('page.title.home')"/>
        </a>
    </div>

    @foreach($navItems as $navItem)
        <div class="header-item">
            <a class="{{ $navItem->isActive() ? 'active' : '' }}" href="{{ $navItem->getUrl() }}">
                {{ trans($navItem->getTitle()) }}
            </a>
        </div>
    @endforeach

    <div class="spacer"></div>

    <div class="header-item ignore-casing header-lang">
        <img src="{{ asset('/img/flag_usd.svg') }}" width="35px"/>
        <a class="{{ LaravelLocalization::getCurrentLocale() === 'en-US' ? 'active' : '' }}" href="{{ LaravelLocalization::getLocalizedURL('en-US') }}">USD</a>
        <img src="{{ asset('/img/flag_eur.svg') }}" width="35px"/>
        <a class="{{ LaravelLocalization::getCurrentLocale() === 'en-GB' ? 'active' : '' }}" href="{{ LaravelLocalization::getLocalizedURL('en-GB') }}">EUR</a>
    </div>

    @if($cart->getTotalBoxes())
        <div class="header-item header-item-cart {{ isset($cartActive) ? 'active' : '' }}">
            <a href="{{ url('/shop/cart') }}">
                <span class="cart-txt">{{ trans('page.header.cart') }}</span>
                <span class="cart-size">{{ $cart->getTotalBoxes() }}</span>
            </a>
        </div>
    @endif
</header>
