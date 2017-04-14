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
            @foreach($product->subQuantities as $subQuantity)
                <tr>
                    <td>{{ $subQuantity->quantity }}</td>
                    <td class="product-view-multiple-price">${{ $subQuantity->usd_price / 100}}</td>
                    <td>${{ $subQuantity->unitUsdPrice() }}</td>
                    <td>
                        <div class="product-view-multiple-qty-buttons">
                            <a href="{{ url('cart/subtract', [$product->slug, $subQuantity->id]) }}">
                                <button class="product-view-button subtract">&minus;</button>
                            </a>
                            <div class="product-view-qty">0</div>
                            <a href="{{ url('cart/add', [$product->slug, $subQuantity->id]) }}">
                                <button class="product-view-button add">&plus;</button>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
