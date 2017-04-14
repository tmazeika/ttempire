<div class="product-view-multiple-qty">
    <table class="product-view-table">
        <thead>
            <tr>
                <td>Balls Per Box</td>
                <td>Price Per Box</td>
                <td>Approx. Unit Price</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($product->subQuantities as $subQty)
                <tr>
                    <td>{{ $subQty->quantity }}</td>
                    <td class="product-view-multiple-price">${{ $subQty->usd_price / 100}}</td>
                    <td>${{ $subQty->unitUsdPrice() }}</td>
                    <td>
                        <div class="product-view-multiple-qty-buttons">
                            <a href="{{ url('cart/subtract', [$product->slug, $subQty->id]) }}" data-cart-link>
                                <button class="product-view-button subtract">&minus;</button>
                            </a>
                            <div class="product-view-qty" data-sub-qty="{{ $subQty->id }}">{{ $cart->getCount($product, $subQty) }}</div>
                            <a href="{{ url('cart/add', [$product->slug, $subQty->id]) }}" data-cart-link>
                                <button class="product-view-button add">&plus;</button>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
