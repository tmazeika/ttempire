window.$ = require('jquery');
require('turbolinks').start();

$('a[data-cart-link]').on('click', function () {
    const e = this;
    const set = $(this).attr('href').includes('/set');
    const inCart = $(this).parents('.cart').length > 0;

    $.ajax($(this).attr('href'), {
        data: {
            'in_cart': inCart,
        },
        success: function (data) {
            if (inCart) {
                let removing = false;
                let currentRows = $('.cart-table tbody tr:not(.standalone)').length;

                if (set && data.sub_qty_count === 0) {
                    removing = true;

                    $(e).closest('tr').hide('medium', function () {
                        $(this).remove();

                        if (currentRows === 1) {
                            $('.cart-no-items').show();
                            $('.cart').hide();
                        }
                    });
                }

                if (!removing && currentRows > 1) {
                    $('#paypal-button').html(data.paypal_button);
                }

                $(`.cart-subtotal[data-sub-qty="${data.sub_qty}"]`).html(data.subtotal);
            }

            $(`.product-qty[data-sub-qty="${data.sub_qty}"]`).html(data.sub_qty_count);
            $('.header-cart-count').html(data.cart_count);
        }
    });

    return false;
});
