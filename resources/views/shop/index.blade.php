@extends('layouts.master')

@php
    $active = 'shop';
    $title = 'Shop';
@endphp

@section('content')
    <div class="welcome">
        <div class="welcome-text-container">
            <div class="welcome-text">Shop</div>
        </div>

        <a href="{{ url('/') }}">
            <button class="welcome-button">Home</button>
        </a>
    </div>
@endsection
