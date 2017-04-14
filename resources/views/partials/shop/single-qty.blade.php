<div class="product-view-single-qty">
    <a href="{{ url('shop/cart/subtract', [$product->slug, $subQty->id]) }}" data-cart-link>
        <button class="product-view-button subtract">&minus;</button>
    </a>
    <div class="product-qty product-view-qty" data-sub-qty="{{ $subQty->id }}">{{ $cart->getCount($product, $subQty) }}</div>
    <a href="{{ url('shop/cart/add', [$product->slug, $subQty->id]) }}" data-cart-link>
        <button class="product-view-button add">&plus;</button>
    </a>
</div>
