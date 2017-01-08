$('.shop-product-cart').on('click', function() {
    const productId = parseInt($(this).data('product-id'));

    $.ajax('/shop/cart/add', {
        method: 'get',
        data: {
            id: productId,
            qty: 1
        }
    }).done(function(data) {
        $('.cart-size').text(data);
    });
});
