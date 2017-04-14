@extends('layouts.master')

@php($title = $product->title)

@section('content')
    <div class="products-container">
        {{ $product }}
    </div>
@endsection
