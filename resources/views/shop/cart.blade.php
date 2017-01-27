@extends('layouts.app')

@section('content')
    <section class="cart-prev">
        <div class="cart-prev-container">
            <table class="cart-prev-table">
                <thead>
                <tr>
                    <td></td>
                    <td>Balls Per Box</td>
                    <td>Item</td>
                    <td>Subtotal</td>
                    <td></td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @foreach($cart->getInfo() as $cartItemI => $cartItem)
                    @foreach($cartItem['qty'] as $qtyId => $qty)
                        @php($product = $cartItem['product'])

                        <tr class="cart-prev-item">
                            <td>
                                <img class="cart-prev-item-img" src="{{ asset($product->getImg()) }}"/>
                            </td>
                            <td class="cart-prev-item-qty">{{ $cartItem['product']->getQuantities()[$qtyId]->getQty() }}</td>
                            <td class="cart-prev-item-name">{{ trans($product->getTitle()) }}</td>
                            <td class="cart-prev-item-subtotal">@lang('currency.price', ['amount' => number_format($qty['price'] * $qty['num'], 2, trans('currency.decimal_sep'), trans('currency.thousands_sep'))])</td>
                            <td class="cart-prev-qty-mod">
                                <a class="cart-prev-qty-link"
                                   href="{{ qs_url('/shop/cart/add', ['id' => $product->getId(), 'qty' => $qtyId, 'num' => -1]) }}">
                                    <button class="cart-prev-qty-btn">-</button>
                                </a>
                                <span class="cart-prev-qty-txt">{{ $cart->get($product->getId(), $qtyId) }}</span>
                                <a class="cart-prev-qty-link"
                                   href="{{ qs_url('/shop/cart/add', ['id' => $product->getId(), 'qty' => $qtyId, 'num' => 1]) }}">
                                    <button class="cart-prev-qty-btn">+</button>
                                </a>
                            </td>
                            <td class="cart-prev-qty-mod">
                                <a class="cart-prev-qty-link"
                                   href="{{ qs_url('/shop/cart/add', ['id' => $product->getId(), 'qty' => $qtyId, 'num' => -$cart->get($product->getId(), $qtyId)]) }}">
                                    <button class="cart-prev-qty-btn delete">&times;</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>

            <div class="cart-prev-action">
                <div class="cart-prev-action-item">
                    <span class="cart-prev-action-item-title">Shipping:</span> @lang('currency.price', ['amount' => number_format($shippingCost, 2, trans('currency.decimal_sep'), trans('currency.thousands_sep'))])
                </div>

                <div class="cart-prev-action-item">
                    <span class="cart-prev-action-item-title">Total:</span> @lang('currency.price', ['amount' => number_format($total + $shippingCost, 2, trans('currency.decimal_sep'), trans('currency.thousands_sep'))])
                </div>

                <div class="spacer"></div>

                <div class="cart-prev-action-item">
                    <form method="post" action="{{ env('PAYPAL_URL') }}">
                        <input type="hidden" name="cmd" value="_cart"/>
                        <input type="hidden" name="upload" value="1"/>
                        <input type="hidden" name="business" value="{{ env('PAYPAL_BUSINESS') }}"/>
                        <input type="hidden" name="image_url" value="{{ asset('img/logo_ppbanner.png') }}"/>
                        <input type="hidden" name="no_shipping" value="2"/>
                        <input type="hidden" name="cancel_return" value="{{ url('/shop/cart') }}"/>
                        <input type="hidden" name="notify_url" value="{{ url('/shop/ppipn') }}"/>
                        <input type="hidden" name="currency_code" value="{{ trans('currency.code') }}"/>
                        <input type="hidden" name="shipping_1" value="{{ $shippingCost }}"/>
                        <input type="hidden" name="tax" value="0"/>

                        @php
                            $i = 0;
                        @endphp

                        @foreach($cart->getInfo() as $cartItemI => $cartItem)
                            @foreach($cartItem['qty'] as $qtyId => $qty)
                                <input type="hidden" name="item_name_{{ ++$i }}"
                                       value="{{ trans($cartItem['product']->getTitle()) }} (box of {{ $cartItem['product']->getQuantities()[$qtyId]->getQty() }})"/>
                                <input type="hidden" name="item_number_{{ $i }}"
                                       value="{{ $cartItem['product']->getId() }}-{{ $qtyId }}"/>
                                <input type="hidden" name="amount_{{ $i }}" value="{{ $qty['price'] }}"/>
                                <input type="hidden" name="quantity_{{ $i }}" value="{{ $qty['num'] }}"/>
                            @endforeach
                        @endforeach

                        <input class="cart-prev-action-item-btn" type="submit" value="{{ trans('page.cart.checkout') }}"/>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
