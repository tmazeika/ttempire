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
                @foreach($cart->getItems() as $item)
                    <tr class="cart-prev-item">
                        <td>
                            <img class="cart-prev-item-img" src="{{ asset($item->getProduct()->getImg()) }}"/>
                        </td>
                        <td class="cart-prev-item-qty">{{ $item->getBallsPerBox() }}</td>
                        <td class="cart-prev-item-name">{{ trans($item->getProduct()->getTitle()) }}</td>
                        <td class="cart-prev-item-subtotal">@lang('currency.price', ['amount' => number_format($item->getCost(), 2, trans('currency.decimal_sep'), trans('currency.thousands_sep'))])</td>
                        <td class="cart-prev-qty-mod">
                            <a class="cart-prev-qty-link"
                               href="{{ qs_url('/shop/cart/add', ['id' => $item->getProduct()->getId(), 'bpb' => $item->getBallsPerBox(), 'boxes' => -1]) }}">
                                <button class="cart-prev-qty-btn">-</button>
                            </a>
                            <span class="cart-prev-qty-txt">{{ $item->getBoxes() }}</span>
                            <a class="cart-prev-qty-link"
                               href="{{ qs_url('/shop/cart/add', ['id' => $item->getProduct()->getId(), 'bpb' => $item->getBallsPerBox(), 'boxes' => 1]) }}">
                                <button class="cart-prev-qty-btn">+</button>
                            </a>
                        </td>
                        <td class="cart-prev-qty-mod">
                            <a class="cart-prev-qty-link"
                               href="{{ qs_url('/shop/cart/add', ['id' => $item->getProduct()->getId(), 'bpb' => $item->getBallsPerBox(), 'boxes' => -$item->getBoxes()]) }}">
                                <button class="cart-prev-qty-btn delete">&times;</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="cart-prev-action">
                <div class="cart-prev-action-item">
                    <span class="cart-prev-action-item-title">Shipping:</span> @lang('currency.price', ['amount' => number_format($cart->getShippingCost(), 2, trans('currency.decimal_sep'), trans('currency.thousands_sep'))])
                </div>

                <div class="cart-prev-action-item">
                    <span class="cart-prev-action-item-title">Total:</span> @lang('currency.price', ['amount' => number_format($cart->getTotalCost(), 2, trans('currency.decimal_sep'), trans('currency.thousands_sep'))])
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
                        <input type="hidden" name="shipping_1" value="{{ $cart->getShippingCost() }}"/>
                        <input type="hidden" name="tax" value="0"/>

                        @php($i = 0)

                        @foreach($cart->getItems() as $item)
                            <input type="hidden" name="item_name_{{ ++$i }}"
                                   value="{{ trans($item->getProduct()->getTitle()) }} (box of {{ $item->getBallsPerBox() }})"/>
                            <input type="hidden" name="item_number_{{ $i }}"
                                   value="{{ $item->getProduct()->getId() }}-{{ $item->getBallsPerBox() }}"/>
                            <input type="hidden" name="amount_{{ $i }}" value="{{ $item->getQuantity()->getPricePerBox() }}"/>
                            <input type="hidden" name="quantity_{{ $i }}" value="{{ $item->getBoxes() }}"/>
                        @endforeach

                        <input class="cart-prev-action-item-btn" type="submit" value="{{ trans('page.cart.checkout') }}"/>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
