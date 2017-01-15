@extends('layouts.app')

@section('content')
    <section class="shop">
        @foreach($products as $product)
            <div class="shop-product-container">
                <a href="{{ qs_url('/shop/cart/add', ['id' => $product->getId(), 'qty' => 1]) }}" class="shop-product-cart">
                    @if($cart->get($product->getId()))
                        <span class="shop-product-cart-txt">
                            {{ $cart->get($product->getId()) }}
                        </span>
                    @else
                        <img class="shop-product-cart-img" src="{{ asset('img/fa_shopping_cart.svg') }}" alt="Add to cart" width="32"/>
                    @endif
                </a>

                <div class="shop-product" data-product-id="{{ $product->getId() }}">
                    <img class="shop-product-img" src="{{ asset($product->getImg()) }}"/>

                    <div class="shop-product-info">
                        <h1 class="shop-product-desc">{{ trans($product->getDesc()) }}</h1>
                        <sub class="shop-product-title">{{ trans($product->getTitle()) }}</sub>
                    </div>

                    <div class="spacer"></div>

                    <div class="shop-product-action">
                        <div class="shop-product-action-item">${{ $product->getPrice() }}</div>
                        <sub class="shop-product-action-item sub long" hidden>{{ $product->getQtyInc() }} per box</sub>
                        <sub class="shop-product-action-item sub short" hidden>{{ $product->getQtyInc() }}/box</sub>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection
