<div class="product-view-single-qty">
    <a href="{{ url('cart/subtract', [$product->slug, 1]) }}">
        <button class="product-view-button subtract">&minus;</button>
    </a>
    <div class="product-view-qty">0</div>
    <a href="{{ url('cart/add', [$product->slug, 1]) }}">
        <button class="product-view-button add">&plus;</button>
    </a>
</div>
