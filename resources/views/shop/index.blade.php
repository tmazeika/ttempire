@extends('layouts.app')

@section('content')
    <section class="shop">
        @foreach($products as $product)
            <div class="shop-product">
                <img class="shop-product-img" src="{{ $product->getImg() }}"/>

                <div class="shop-product-info">
                    <h1 class="shop-product-desc">{{ $product->getDesc() }}</h1>
                    <sub class="shop-product-title">{{ $product->getTitle() }}</sub>
                </div>

                <div class="spacer"></div>

                <div class="shop-product-action">
                    <div class="shop-product-action-item">${{ $product->getPrice() }}</div>
                    <sub class="shop-product-action-item sub long" hidden>&times; {{ $product->getQtyInc() }} per box</sub>
                    <sub class="shop-product-action-item sub short" hidden>{{ $product->getQtyInc() }}/box</sub>
                </div>

                {{--<h1 class="shop-product-title">{{ $product->getTitle() }}</h1>--}}
                {{--<div class="shop-product-price-qty-container">--}}
                    {{--<sub class="shop-product-price">${{ $product->getPrice() }}</sub>--}}
                    {{--<sub class="shop-product-qty-container">--}}
                        {{--<span>{{ $product->getQtyInc() }}</span>--}}
                        {{--<sub>per box</sub>--}}
                    {{--</sub>--}}
                {{--</div>--}}
                {{--<div class="shop-product-cart-container">--}}
                    {{--<input class="shop-product-cart-qty" type="number">--}}
                    {{--<button class="shop-product-cart-add"><img src="{{ asset('img/fa_cart_plus.svg') }}" width="30"/></button>--}}
                {{--</div>--}}
            </div>
        @endforeach
    </section>
@endsection

@section('scripts')
    @include('partials.js.app')
@endsection
