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
                    <td>{{ $subQty->quantity() }}</td>
                    <td class="product-view-price">{{ $currencyService->getAndFormatPrice($subQty) }}</td>
                    <td>{{ $currencyService->formatPrice($currencyService->getPrice($subQty) / $subQty->quantity, 3) }}</td>
                    <td>
                        <div class="product-view-multiple-qty-buttons">
                            <a href="{{ url('shop/cart/subtract', [$product->slug, $subQty->id]) }}" data-cart-link>
                                <button class="product-view-button subtract">&minus;</button>
                            </a>

                            <div class="product-qty product-view-qty" data-sub-qty="{{ $subQty->id }}">
                                {{ $cart->getCount($product, $subQty) }}
                            </div>

                            <a href="{{ url('shop/cart/add', [$product->slug, $subQty->id]) }}" data-cart-link>
                                <button class="product-view-button add">&plus;</button>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
