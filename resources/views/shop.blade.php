@extends('layouts.app')

@section('content')
    <p>Shop</p>

    <hr/>

    @foreach($products as $product)
        <div>
            <p>Title: {{ $product->getTitle() }}</p>
            <img src="{{ $product->getImg() }}" width="200px"/>
            <p>Price: ${{ $product->getPrice() }}</p>
            <p>Qty: {{ $product->getQtyInc() }}</p>
            <hr/>
        </div>
    @endforeach

    <!-- TODO -->
    <form id="checkout" method="POST" action="{{ url('/shop/checkout') }}">
        {{ csrf_field() }}
        <div id="checkout-payment"></div>
        <input type="submit" value="Pay $10">
    </form>
@endsection

@section('scripts')
    <!-- jQuery -->
    <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>

    <script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- TODO -->
    <script>
        braintree.setup('{{ $clientToken }}', 'dropin', {
            container: 'checkout-payment'
        });
    </script>
@endsection
