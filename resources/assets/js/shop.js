$('.shop-product-cart').on('click', function() {
    const cartBtn = $(this);
    const productId = parseInt(cartBtn.data('product-id'));

    $.ajax('/shop/cart/add', {
        method: 'get',
        data: {
            id: productId,
            qty: 1
        }
    }).done(function(data) {
        $('.cart-size').text(data.total);
        $('.header-item-cart').css('display', data.total > 0 ? 'flex' : 'none');

        if (data.product > 0) {
            $('.shop-product-cart-txt', cartBtn)
                .html(data.product)
                .css('display', 'block');
            $('.shop-product-cart-img', cartBtn).css('display', 'none');
        }
        else {
            $('.shop-product-cart-txt', cartBtn).css('display', 'none');
            $('.shop-product-cart-img', cartBtn).css('display', 'block');
        }
    });
});
