@extends('layouts.app')

@section('content')
    <section class="shop">
        @foreach($products as $product)
            <div class="shop-product-container">
                <div class="shop-product-cart">
                    <img src="{{ asset('img/fa_shopping_cart.svg') }}" alt="Add to cart" width="25"/>
                </div>

                <div class="shop-product" data-product-id="{{ $product->getId() }}">
                    <img class="shop-product-img" src="{{ $product->getImg() }}"/>

                    <div class="shop-product-info">
                        <h1 class="shop-product-desc">{{ $product->getDesc() }}</h1>
                        <sub class="shop-product-title">{{ $product->getTitle() }}</sub>
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

@section('scripts')
    @include('partials.js.app')
@endsection
