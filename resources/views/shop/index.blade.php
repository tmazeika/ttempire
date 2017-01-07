@extends('layouts.app')

@section('content')
    <div class="shop">
        <section class="shop-products">
            @foreach($products as $product)
                <div class="shop-product-item">
                    <p>Title: {{ $product->getTitle() }}</p>
                    <img src="{{ $product->getImg() }}" width="200px"/>
                    <p>Price: ${{ $product->getPrice() }}</p>
                    <p>Qty: {{ $product->getQtyInc() }}</p>
                    <hr/>
                </div>
            @endforeach
        </section>

        <aside class="shop-summary">
            Items
        </aside>
    </div>
@endsection

@section('scripts')
    @include('partials.js.app')
@endsection
