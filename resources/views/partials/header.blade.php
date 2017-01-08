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

    <div class="header-item header-item-cart" {!! $cart->getSize() === 0 ? 'style="display:none"' : '' !!}>
        <a class="{{ $checkoutItem->isActive() ? 'active' : '' }}" href="{{ $checkoutItem->getUrl() }}">
            <span class="cart-txt">{{ trans($checkoutItem->getTitle()) }}</span>
            <span class="cart-size">{{ $cart->getSize() }}</span>
        </a>
    </div>
</header>
