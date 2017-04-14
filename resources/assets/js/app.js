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

                    if ($('.cart-table tbody tr').length === 0) {
                        $('.cart-no-items').show();
                        $('.cart-table').hide();
                    }
                });
            }
            else {
                $(`.product-qty[data-sub-qty="${data.sub_qty}"]`).text(data.sub_qty_count);
                $(`.cart-subtotal[data-sub-qty="${data.sub_qty}"]`).text(data.subtotal);
            }

            $('.header-cart-count').text(data.cart_count);
        }
    });

    return false;
});
