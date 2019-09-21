<?if ($access == 'admin' || $access == 'operator'):?>
    <h1>Обработка заказов</h1>
<? else:?>
    <h1>Ваши заказы</h1>
<?endif;?>

<div class="order_block">
<? foreach ($orders as $item):?>
<?if ($access == 'admin' || $access == 'operator' || $params['user'] == $item['user']):?>
<div class="order_elem">
    <div class="order_elem_head">
        <p class="order_elem_head__number">Номер заказа:&nbsp;&nbsp;<b><?=$item['id']?></b></p>
        <p class="order_elem_head__date">Дата:&nbsp;&nbsp;<b><?=$item['added']?></b></p>
        <p class="order_elem_head__name">Имя клиента:&nbsp;&nbsp;<b><?=$item['name']?></b></p>
        <p class="order_elem_head__phone">Номер телефона:&nbsp;&nbsp;<b><?=$item['phone']?></b></p>
    </div>
    <div class="status_order" id="status_order_<?=$item['id']?>"><?=$item['status']?></div>

    <div class="order_elem_body">
        <div class="order_elem_content">
            <div class="order_elem_content_goods">
                <p class="order_elem_content_goods__number">№ П.П.</p>
                <p class="order_elem_content_goods__name">Название товара</p>
                <p class="order_elem_content_goods__quant">Количество</p>
                <p class="order_elem_content_goods__price">Цена</p>
                <p class="order_elem_content_goods__summ">Сумма</p>
            </div>
            <? foreach ($item['innerOrders'] as $key => $value):?>
                <div class="order_elem_content_goods">
                    <p class="order_elem_content_goods__number"><?=$key+1?></p>
                    <p class="order_elem_content_goods__name"><?=$value['name']?></p>
                    <p class="order_elem_content_goods__quant detect"><?=$value['quantity']?></p>
                    <p class="order_elem_content_goods__price"><?=$value['price']?> <i class="fa fa-rub" id="rubles" aria-hidden="true"></i></p>
                    <p class="order_elem_content_goods__summ"><?=$value['summ']?> <i class="fa fa-rub" id="rubles" aria-hidden="true"></i></p>
                </div>
            <? endforeach;?>
            <div class="order_elem_content_goods__result">
                <div class="description_order">Всего выбрано&nbsp;<span class="goods_Final_orders"><?=$item['quantityAll']?></span>&nbsp;на сумму&nbsp;<span class="orders_summ_final"><?=$item['summAll']?></span>&nbsp;<i class="fa fa-rub" id="rubles" aria-hidden="true"></i> !</div>
            </div>
        </div>
        <div class="order_elem_control">
            <?if ($access == 'user' && $item['status'] == 'Ожидает подтверждения' ):?>
                <div class="button_status_ended button_status" data-id="<?=$item['id']?>" data-status="Заказ отменен">Отменить</div>
            <?endif;?>
            <?if ($access == 'admin' || $access == 'operator'):?>
                <div class="button_status_confirm button_status" data-id="<?=$item['id']?>" data-status="Заказ подтвержден">Подтвердить</div>
                <div class="button_status_ended button_status" data-id="<?=$item['id']?>" data-status="Заказ отменен">Отменить</div>
                <div class="button_status_shipping button_status" data-id="<?=$item['id']?>" data-status="Заказ отправлен">Отправлен</div>
                <div class="button_status_success button_status" data-id="<?=$item['id']?>" data-status="Заказ доставлен">Доставлен</div>
            <?endif;?>
        </div>

    </div>


</div>
    <?endif;?>
<? endforeach;?>
</div>
