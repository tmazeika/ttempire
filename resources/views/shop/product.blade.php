@extends('layouts.master')

@php($title = $product->title)

@section('content')
    <div class="products-view-container">
        <img class="products-view-img" src="{{ $product->getImgAsset() }}"/>

        <header class="products-view-header">
            <h1 class="products-view-title">{{ $product->title }}</h1>
            <span class="products-view-description">{{ $product->description }}</span>
        </header>

        @if($product->hasMultipleSubQuantities())
            @include('partials.shop.multiple-qty')
        @else
            @include('partials.shop.single-qty')
        @endif
    </div>
@endsection
