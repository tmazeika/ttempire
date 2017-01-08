$('.shop-product-cart').on('click', function() {
    const productId = parseInt($(this).data('product-id'));

    console.log(productId);
});
