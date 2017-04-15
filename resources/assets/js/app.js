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
            const removing = (set && data.sub_qty_count === 0);
            const currentRows = $('.cart-table tbody tr:not(.standalone)').length;
            const removingLast = (removing && currentRows === 1);

            if (inCart) {
                if (removing) {
                    $(e).closest('tr').hide('medium', function () {
                        $(this).remove();

                        if (removingLast) {
                            $('.cart-no-items').show();
                            $('.cart').hide();
                        } else {
                            $('#paypal-button').html(data.paypal_button);
                        }
                    });
                } else {
                    $('#paypal-button').html(data.paypal_button);
                    $(`.cart-subtotal[data-sub-qty="${data.sub_qty}"]`).html(data.subtotal);
                }
            }

            if (!removing) {
                $(`.product-qty[data-sub-qty="${data.sub_qty}"]`).html(data.sub_qty_count);
            }

            $('.header-cart-count').html(data.cart_count);
        }
    });

    return false;
});
