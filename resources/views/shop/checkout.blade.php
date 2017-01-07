@extends('layouts.app')

@section('head')
    <meta name="braintree-token" content="{{ $braintreeToken }}">
@endsection

@section('content')

@endsection

@section('scripts')
    @include('partials.js.braintree')
    @include('partials.js.app')
@endsection
