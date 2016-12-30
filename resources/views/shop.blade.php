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
@endsection
