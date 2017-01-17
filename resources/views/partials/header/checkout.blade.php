@if($cart->getSize())
    <div class="header-item header-item-cart">
        <form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
            <input type="hidden" name="cmd" value="_cart"/>
            <input type="hidden" name="upload" value="1"/>
            <input type="hidden" name="business" value="GFLBCKL9RDD44"/>
            <input type="hidden" name="image_url" value="{{ asset('img/logo_ppbanner.png') }}"/>
            <input type="hidden" name="no_shipping" value="2"/>
            <input type="hidden" name="cancel_return" value="{{ url('/shop') }}"/>
            <input type="hidden" name="notify_url" value="{{ url('/shop/ppipn') }}"/>
            <input type="hidden" name="currency_code" value="{{ trans('currency.code') }}"/>
            <input type="hidden" name="shipping" value="0"/>
            <input type="hidden" name="tax" value="0"/>

            @foreach ($cart->getInfo() as $i => $cartItem)
                @php
                    /** @var \PingPongShop\Product $product */
                    $product = $cartItem['product']
                @endphp

                <input type="hidden" name="item_name_{{ $i + 1 }}" value="{{ trans($product->getTitle()) }}"/>
                <input type="hidden" name="item_number_{{ $i + 1 }}" value="{{ trans($product->getId()) }}"/>
                <input type="hidden" name="amount_{{ $i + 1 }}" value="{{ $product->getPrice() }}"/>
                <input type="hidden" name="quantity_{{ $i + 1 }}" value="{{ $cartItem['qty'] }}"/>
            @endforeach

            <button type="submit">
                <span class="cart-txt">{{ trans('page.header.checkout') }}</span>
                <span class="cart-size">{{ $cart->getSize() }}</span>
            </button>
        </form>
    </div>
@endif
