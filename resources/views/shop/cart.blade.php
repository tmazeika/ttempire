@extends('layouts.master')

@php
    $active = 'cart';
    $title = 'Cart';
@endphp

@section('content')
    <div class="cart-no-items" style="display:{{ count($cartItems) > 0 ? 'none' : '' }}">No items added to your cart yet. Get <a href="{{ url('shop') }}">shopping</a>!</div>

    @if(count($cartItems) > 0)
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
                            <div class="cart-sub">Box of {{ $cartItem->subQuantity->quantity }}</div>
                        @endif
                    </td>
                    <td>{{ $cartItem->subQuantity->usdPrice() }}</td>
                    <td class="product-view-price cart-subtotal" data-sub-qty="{{ $cartItem->subQuantity->id }}">
                        {{ $cartItem->subQuantity->usdPrice($cartItem->count) }}
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
            </tbody>
        </table>
    @endif
@endsection
