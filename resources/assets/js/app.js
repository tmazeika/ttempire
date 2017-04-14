window.$ = require('jquery');
require('turbolinks').start();

$('a[data-cart-link]').on('click', function () {
    $.ajax(this.href, {
        success: function (data) {
            $(`.product-view-qty[data-sub-qty="${data.sub_qty}"]`).text(data.sub_qty_count);
            $('.header-cart-count').text(data.cart_count);
        }
    });

    return false;
});
