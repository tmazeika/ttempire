@extends('layouts.app')

@section('content')
    <section class="shop">
        @foreach($products as $product)
            <a class="shop-product-link-container" href="{{ url('/shop/product', ['id' => $product->getId()]) }}">
                <div class="shop-product-container">
                    <div class="shop-product" data-product-id="{{ $product->getId() }}">
                        <img class="shop-product-img" src="{{ asset($product->getImg()) }}"/>

                        <div class="shop-product-info">
                            <h1 class="shop-product-desc">{{ trans($product->getDesc()) }}</h1>
                            <sub class="shop-product-title">{{ trans($product->getTitle()) }}</sub>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </section>
@endsection
