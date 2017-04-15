window.$ = require('jquery');
require('turbolinks').start();

$('a[data-cart-link]').on('click', function () {
    const e = $(this);
    const set = $(this).attr('href').includes('/set');

    $.ajax($(this).attr('href'), {
        success: function (data) {
            if (set) {
                $(e).closest('tr').hide('medium', function () {
                    $(this).remove();

                    if ($('.cart-table tbody tr:not(.standalone)').length === 0) {
                        $('.cart-no-items').show();
                        $('.cart').hide();
                    }
                });
            }
            else {
                $(`.product-qty[data-sub-qty="${data.sub_qty}"]`).html(data.sub_qty_count);
                $(`.cart-subtotal[data-sub-qty="${data.sub_qty}"]`).html(data.subtotal);
            }

            $('.header-cart-count').html(data.cart_count);
            $('.cart-checkout-button').html(`Checkout (&#8202;${data.total})&#8202;`);
        }
    });

    return false;
});
