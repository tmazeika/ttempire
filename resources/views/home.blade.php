@extends('layouts.master')

@php($title = 'Home')

@section('content')
    <div class="welcome">
        <div class="welcome-text-container">
            <div class="welcome-text">Welcome</div>
            <div class="welcome-text small">to</div>
            <div class="welcome-text">Table Tennis Empire</div>
        </div>

        <a href="{{ url('shop') }}">
            <button class="welcome-button">Shop Now</button>
        </a>
    </div>
@endsection
