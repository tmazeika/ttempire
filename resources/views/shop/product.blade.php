@extends('layouts.master')

@php($title = $product->title)

@section('content')
    <div class="product-view-container" data-multiple-qty="{{ $multipleQty ? 'true' : 'false' }}">
        <img class="product-view-img" src="{{ $product->getImgAsset() }}"/>

        <header class="product-view-header">
            <h1 class="product-view-title">{{ $product->title }}</h1>

            @if(!$multipleQty)
                <div class="product-view-price product-view-single-price">
                    {{ $currencyService->getAndFormatPrice($product->subQuantities->first()) }}
                </div>
            @endif

            <div class="product-view-description">{{ $product->description }}</div>
        </header>

        @if(!$multipleQty)
            <div class="flex-spacer"></div>

            @include('partials.shop.single-qty')
        @endif
    </div>

    @if($multipleQty)
        @include('partials.shop.multiple-qty')
    @endif
@endsection
