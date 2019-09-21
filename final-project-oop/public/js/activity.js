$(document).ready(() => {
    $('.register_phone').mask('+7 (000) 000-00-00',{placeholder: "+7 (___) ___-__-__"});

});

/**
 * Кнопка "Открыть мини корзину"
 */
$(document).ready(() => {
    $('.mini_cart').css({'display': 'none'});
    $('.cart_link').on('click', '#open_mini_cart', e => {
        event.preventDefault();
        $('.mini_cart').slideToggle(1000);
    });
});
/**
 * Кнопка "Открыть оформление заказа"
 */
$(document).ready(() => {
    $('.go_to_orders__content').css({'display': 'none'});
    $('.go_to_orders').on('click', '.go_to_orders_button', e => {
        event.preventDefault();
        $('.go_to_orders__content').slideToggle(1000);
    });
});
/**
 * Отображение суммы
 */
$(document).ready(() => {
    let $amount = 0;
    let $sub = $('.mini_cart_goods_block').find('.mini_cart_elem__price');
    for (let $subAmount of $sub) {
        $amount += +($($subAmount).text()) * +$("#quant_id_"+(+$($subAmount).attr('data-id'))).text();
    }
    $('#summ_mini_card').html($amount);
    $('#summ_card').html($amount);
    $('.cart_summ_final').html($amount);

});

/**
 * Подборка нужного окончания для слова Рубль
 */
$(document).ready(() => {
    let $summ = parseInt($('.cart_summ_final').text());
    const $n = Math.abs($summ) % 100;
    const $n10 = $n % 10;
    let $result = '';

    if ($n >= 5 && $n <= 20) {
        $result = 'рублей';
    } else if ($n10 > 1 && $n10 < 5) {
        $result = 'рубля';
    } else if ($n10 === 1) {
        $result = 'рубль';
    } else {
        $result = 'рублей';
    }
    $('.rublesFinal').html($result);
});
/**
 * Подборка нужного окончания для слова Товар
 */
$(document).ready(() => {
    let $summ = parseInt($('.goods_Count').text());
    const $n = Math.abs($summ) % 100;
    const $n10 = $n % 10;
    let $result = '';

    if ($n >= 5 && $n <= 20) {
        $result = 'товаров';
    } else if ($n10 > 1 && $n10 < 5) {
        $result = 'товара';
    } else if ($n10 === 1) {
        $result = 'товар';
    } else {
        $result = 'товаров';
    }
    $('.goods_Final').html($result);
});

/**
 * Выделение цветом статуса заказа
 */

$(document).ready(() => {
    $('.status_order').each(function ($key, $value) {
        let $statusID = "#"+$($value).attr('id');
        let $status = $($statusID).text();
       // console.log($value);
        switch ($status) {
            case 'Ожидает подтверждения':
                $($statusID).css('backgroundColor', 'lightblue');
            break;
            case 'Заказ отменен':
                $($statusID).css('backgroundColor', 'lightcoral');
                break;
            case 'Заказ подтвержден':
                $($statusID).css('backgroundColor', 'lightgreen');
                break;
            case 'Заказ отправлен':
                $($statusID).css('backgroundColor', 'lightseagreen');
                break;
            case 'Заказ доставлен':
                $($statusID).css('backgroundColor', 'lightgrey');
                break;
        }
    })
});

$(document).ready(() => {
    $('.admin_block_content').css({'display': 'none'});
    $('.admin_block').on('click', '.admin_block_title', e => {
        event.preventDefault();
        $('.admin_block_content').not($(e.target).next()).slideUp(500);
        $(e.target).next().slideToggle(1000);
    });
});
