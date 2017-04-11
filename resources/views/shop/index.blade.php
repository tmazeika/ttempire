@extends('layouts.master')

@php
    $active = 'shop';
    $title = 'Shop';
@endphp

@section('content')
    @foreach(\TTEmpire\Product::all() as $product)
        <div>
            <img src="{{ $product->getImgAsset() }}" width="100"/>
            {{ $product->title }}
        </div>
    @endforeach
@endsection
