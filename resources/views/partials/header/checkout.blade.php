@if($cart->getProductSize())
    <div class="header-item header-item-cart">
        <form method="post" action="{{ env('PAYPAL_URL') }}">
            <input type="hidden" name="cmd" value="_cart"/>
            <input type="hidden" name="upload" value="1"/>
            <input type="hidden" name="business" value="{{ env('PAYPAL_BUSINESS') }}"/>
            <input type="hidden" name="image_url" value="{{ asset('img/logo_ppbanner.png') }}"/>
            <input type="hidden" name="no_shipping" value="2"/>
            <input type="hidden" name="cancel_return" value="{{ url('/shop') }}"/>
            <input type="hidden" name="notify_url" value="{{ url('/shop/ppipn') }}"/>
            <input type="hidden" name="currency_code" value="{{ trans('currency.code') }}"/>
            <input type="hidden" name="shipping_1" value="{{ $shippingCost }}"/>
            <input type="hidden" name="tax" value="0"/>

            @php
                $i = 0;
            @endphp

            @foreach($cart->getInfo() as $cartItemI => $cartItem)
                @foreach($cartItem['qty'] as $qtyId => $qty)
                    <input type="hidden" name="item_name_{{ ++$i }}" value="{{ trans($cartItem['product']->getTitle()) }} (box of {{ $cartItem['product']->getQuantities()[$qtyId]->getQty() }})"/>
                    <input type="hidden" name="item_number_{{ $i }}" value="{{ $cartItem['product']->getId() }}-{{ $qtyId }}"/>
                    <input type="hidden" name="amount_{{ $i }}" value="{{ $qty['price'] }}"/>
                    <input type="hidden" name="quantity_{{ $i }}" value="{{ $qty['num'] }}"/>
                @endforeach
            @endforeach

            <button type="submit">
                <span class="cart-txt">{{ trans('page.header.checkout') }}</span>
                <span class="cart-size">{{ $cart->getProductSize() }}</span>
            </button>
        </form>
    </div>
@endif
