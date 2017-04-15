@extends('layouts.master')

@php
    $active = 'cart';
    $title = 'Cart';
@endphp

@section('content')
    <div class="cart-no-items" style="display:{{ count($cartItems) > 0 ? 'none' : '' }}">
        No items added to your cart yet. Get <a href="{{ url('shop') }}">shopping</a>!
    </div>

    @if(count($cartItems) > 0)
        <div class="cart">
            <table class="cart-table">
                <thead>
                <tr>
                    <td></td>
                    <td>Item</td>
                    <td>Unit Price</td>
                    <td>Subtotal</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $cartItem)
                    <tr>
                        <td>
                            <img class="cart-img" src="{{ $cartItem->product->getImgAsset() }}"/>
                        </td>
                        <td>
                            <div>{{ $cartItem->product->title }}</div>

                            @if($cartItem->product->hasMultipleSubQuantities())
                                <div class="cart-sub">Box of {{ $cartItem->subQuantity->quantity() }}</div>
                            @endif
                        </td>
                        <td>{{ $currencyService->getAndFormatPrice($cartItem->subQuantity) }}</td>
                        <td class="product-view-price cart-subtotal" data-sub-qty="{{ $cartItem->subQuantity->id }}">
                            {{ $currencyService->getAndFormatPrice($cartItem->subQuantity, 0, $cartItem->count) }}
                        </td>
                        <td>
                            <div class="cart-qty-buttons">
                                <a href="{{ url('shop/cart/subtract', [$cartItem->product->slug, $cartItem->subQuantity->id]) }}"
                                   data-cart-link>
                                    <button class="cart-qty-button subtract">&minus;</button>
                                </a>

                                <div class="product-qty cart-qty" data-sub-qty="{{ $cartItem->subQuantity->id }}">
                                    {{ $cart->getCount($cartItem->product, $cartItem->subQuantity) }}
                                </div>

                                <a href="{{ url('shop/cart/add', [$cartItem->product->slug, $cartItem->subQuantity->id]) }}"
                                   data-cart-link>
                                    <button class="cart-qty-button add">&plus;</button>
                                </a>

                                <a href="{{ url('shop/cart/set', [$cartItem->product->slug, $cartItem->subQuantity->id, 0]) }}"
                                   data-cart-link>
                                    <button class="cart-qty-button remove">&times;</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach

                <tr class="standalone">
                    <td colspan="2"></td>
                    <td class="bold">Shipping</td>
                    <td>{{ $currencyService->formatPrice($cart->getShippingPrice()) }}</td>
                    <td>
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

                            <input class="cart-checkout-button" type="submit"
                                   value="Checkout (&#8202;{{ $currencyService->formatPrice($cart->getSubtotal()) }}&#8202;)"/>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    @endif
@endsection
