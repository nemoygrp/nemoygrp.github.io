<h1>Корзина</h1>

<div class="cart_elem">
    <div class="cart_elem__foto_head">Фото</div>
    <div class="cart_elem__name_head">Название</div>
    <div class="cart_elem__head">Кол-во</div>
    <div class="cart_elem__head">Цена</div>
    <div class="cart_elem__head">Удалить</div>
</div>
<? foreach ($cart as $item):?>
    <div class="cart_elem" id="elem_id_<?=$item['id_goods']?>">
        <div class="cart_elem__photo"><img src="/<?=$item['img']?>" alt="foto" width="150" height="120"></div>
        <div class="cart_elem__name"><?=$item['name']?></div>
        <div class="cart_elem__quantity" id="quant_id_<?=$item['id_goods']?>"><?=$item['quantity']?> шт.</div>
        <div class="cart_elem__price"><?=$item['price']?> <i class="fa fa-rub" aria-hidden="true"></i></div>
        <div class="cart_elem__delete button_delete" id="<?=$item['id_goods']?>"><i class="fa fa-times-circle"></i></div>
    </div>
<? endforeach;?>
<div class="cart_summ">Сумма: <?=$cartSumm?>&nbsp;<span class="rublesFinal"></span></div>
<div class="go_to_orders"><p class="go_to_orders_button">Оформить заказ</p>
    <div class="go_to_orders__content">
        <div class="description_cart">Всего выбрано&nbsp;<span class="goods_Count"><?=$cartCount?></span>&nbsp;<span class="goods_Final"></span>&nbsp;на сумму&nbsp;<span class="cart_summ_final"><?=$cartSumm?></span>&nbsp;<span class="rublesFinal"></span>!</div>


        <? if ($user == '0'): ?>
            <h3>Для подтверждения заказа укажите номер телефона</h3>
            <form class="cart_input_block" method="post" action="/orderConfirm/">
                <input type="text" class="register_phone" name="phone">

        <? else: ?>
            <h3>Для продолжения подтвердите свой номер телефона</h3>
            <form class="cart_input_block" method="post" action="/orderConfirm/">
                <input type="text" class="register_phone" name="phone" value="<?= $userPhone ?>">

        <? endif; ?>
                <button name="page" value="main" type="submit"
                        class="register_phone_submit fa fa-check-square-o"></button>
            </form>
        <p>Наш оператор свяжится с Вами в ближайшее время!</p>


    </div>
</div>
