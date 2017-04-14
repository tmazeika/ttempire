<div class="product-view-single-qty">
    <a href="{{ url('cart/subtract', [$product->slug, $subQty->id]) }}">
        <button class="product-view-button subtract">&minus;</button>
    </a>
    <div class="product-view-qty">{{ $cart->getCount($product, $subQty) }}</div>
    <a href="{{ url('cart/add', [$product->slug, $subQty->id]) }}">
        <button class="product-view-button add">&plus;</button>
    </a>
</div>
