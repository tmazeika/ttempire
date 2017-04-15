<form method="post" action="{{ env('PAYPAL_URL') }}">
    <input type="hidden" name="cmd" value="_cart"/>
    <input type="hidden" name="upload" value="1"/>
    <input type="hidden" name="business" value="{{ env('PAYPAL_BUSINESS') }}"/>
    <input type="hidden" name="image_url" value="{{ asset('img/logo_ppbanner.png') }}"/>
    <input type="hidden" name="no_shipping" value="2"/>
    <input type="hidden" name="cancel_return" value="{{ url('shop/cart') }}"/>
    <input type="hidden" name="notify_url" value="{{ url('shop/ppipn') }}"/>
    <input type="hidden" name="currency_code"
           value="{{ strtoupper($currencyService->getCurrency()) }}"/>
    <input type="hidden" name="shipping_1"
           value="{{ $currencyService->getFloatPrice($cart->getShippingPrice()) }}"/>
    <input type="hidden" name="tax" value="0"/>

    @foreach($cartItems as $cartItem)
        <input type="hidden" name="item_name_{{ $loop->iteration }}"
               value="{{ $cartItem->product->title }}{{--
                                       --}}{{ $cartItem->product->hasMultipleSubQuantities()
                                            ? ' (Box of ' . $cartItem->subQuantity->quantity() . ')'
                                            : '' }}"/>
        <input type="hidden" name="item_number_{{ $loop->iteration }}"
               value="{{ $cartItem->id() }}"/>
        <input type="hidden" name="amount_{{ $loop->iteration }}"
               value="{{ $currencyService->getFloatPrice($currencyService->getPrice($cartItem->subQuantity)) }}"/>
        <input type="hidden" name="quantity_{{ $loop->iteration }}"
               value="{{ $cartItem->count }}"/>
    @endforeach

    <button class="cart-checkout-button" type="submit">
        Checkout (&#8202;{{ $currencyService->formatPrice($cart->getSubtotal()) }}&#8202;)
    </button>
</form>
