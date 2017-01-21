@extends('layouts.app')

@section('content')
    <section class="shop-product-prev">
        <a class="shop-product-prev-back-link" href="{{ url('/shop') }}">&leftarrow; Back to Shop</a>

        <div class="shop-product-prev-header">
            <img class="shop-product-prev-img" src="{{ asset($product->getImg()) }}"/>
            <h1 class="shop-product-prev-title">@lang($product->getTitle())</h1>
        </div>

        <div class="shop-product-prev-qty-container">
            <table class="shop-product-prev-table">
                <thead>
                    <tr>
                        <td>Balls Per Box</td>
                        <td>Price Per Box</td>
                        <td>Price Per Ball</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product->getQuantities() as $id => $qty)
                        <tr class="shop-product-prev-qty">
                            <td class="shop-product-prev-qty-num">{{ $qty->getQty() }}</td>
                            <td class="shop-product-prev-qty-price">@lang('currency.price', ['amount' => $qty->getPricePerBox()])</td>
                            <td class="shop-product-prev-qty-unit-price">@lang('currency.price', ['amount' => number_format($qty->getPricePerUnit(), 2)])</td>
                            <td class="shop-product-prev-qty-cart">
                                <a class="shop-product-prev-qty-cart-link" href="{{ qs_url('/shop/cart/add', ['id' => $product->getId(), 'qty' => $id, 'num' => -1]) }}">
                                    <button class="shop-product-prev-qty-btn">-</button>
                                </a>
                                <span class="shop-product-prev-qty-btn-txt">{{ $cart->get($product->getId(), $id) }}</span>
                                <a class="shop-product-prev-qty-cart-link" href="{{ qs_url('/shop/cart/add', ['id' => $product->getId(), 'qty' => $id, 'num' => 1]) }}">
                                    <button class="shop-product-prev-qty-btn">+</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
