@extends('layouts.app')

@section('content')
    <section class="main-jumbo">
        <div class="main-jumbo-container">
            <div class="main-jumbo-welcome">
                Welcome<br/>
                <span class="main-jumbo-welcome-small">to</span><br/>
                Table Tennis Empire
            </div>

            <div class="main-jumbo-shop">
                <a href="{{ url('/shop') }}">
                    <button class="main-jumbo-shop-btn">
                        Shop Now
                    </button>
                </a>
            </div>
        </div>
    </section>
@endsection
