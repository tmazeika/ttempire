@extends('layouts.master')

@php
    $active = 'shop';
    $title = 'Shop';
@endphp

@section('content')
    <div class="products-container">
        @foreach($products as $product)
            <div class="product">
                <img class="product-img" src="{{ $product->getImgAsset() }}"/>
                <div class="product-title">
                    <a href="{{ url("shop/$product->slug") }}">{{ $product->title }}</a>
                </div>
                <div class="product-description">{{ $product->description }}</div>
                <div class="product-price">
                    @if ($product->hasMultipleSubQuantities())
                        From {{ $product->getCheapestSubQuantity()->usdPrice() }}
                    @else
                        {{ $product->subQuantities->first()->usdPrice() }}
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
