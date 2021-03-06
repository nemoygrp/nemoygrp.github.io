<div class="holiday_banner"><img src="<?=$holiday?>" alt=""></div>
<header class="header">
    <div class="header_left">
    <a class="logo"></a>
    <div class="header_text">
        <div class="logo_name">"Антикварная лавка Деда Игната"</div>
        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="/catalog/">Каталог</a></li>
            <li><a href="/gallery/">Галерея</a></li>
            <?if ($access == 'admin'):?>
            <li><a href="/admin_panel/">Админка</a></li>
            <?endif;?>
            <?if ($access == 'admin' || $access == 'operator'):?>
                <li><a href="/orders/">Обработка заказов</a></li>
            <?endif;?>
        </ul>
    </div>
    </div>
    <div class="header_right">
        <div class="authentication">
            <?if ($access == 'admin'):?>
                <i class="fa fa-user-md" aria-hidden="true"></i>
            <? elseif($access == 'operator'):?>
                <i class="fa fa-user-secret" aria-hidden="true"></i>
            <? else:?>
                <i class="fa fa-user" aria-hidden="true"></i>
            <?endif;?>

            <?if (!$allow):?> <div class="register_link">Войти или <a href="/register/">Зарегистрироваться...</a></div>
                 <form method="post" action="/login/">
                        <input class="login_input" type="text" name="login" placeholder="Введите логин"><br>
                        <input class="pass_input" type="password" name="pass" placeholder="Введите пароль"><br> <input type="checkbox" name="save">Сохранить?
                        <input type="submit" name="send">
                        </form>
             <? else:?>
                <span class="name_user"><?=$userName?><a class="logout_input" href="/logout/">&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i></a></span>
                <br>
            <?if ($access == 'user'):?>
            <div><a href="/orders/">Мои заказы</a></div>
                <?endif;?>
            <?endif;?>
        </div>
        <?if ($pageDetect != 'cart'):?>
            <div class="cart_link"><div id="open_mini_cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Корзина (<span id="cart_Count"><?=$cartCount?></span>)</div>
                    <div class="mini_cart">
                                <div class="mini_cart_elem">
                                    <div class="mini_cart_elem__foto_head">Фото</div>
                                    <div class="mini_cart_elem__head">Название</div>
                                    <div class="mini_cart_elem__head">Кол-во</div>
                                    <div class="mini_cart_elem__head">Цена</div>
                                </div>
                                <div class="mini_cart_goods_block">
                                <? foreach ($cart as $item):?>
                                    <div class="mini_cart_elem" id="elem_id_<?=$item['id_goods']?>">
                                        <div class="mini_cart_elem__photo"><img src="/<?=$item['img']?>" alt="foto" width="100" height="80"></div>
                                        <div class="mini_cart_elem__delete button_delete" id="<?=$item['id_goods']?>"><i class="fa fa-times-circle"></i></div>
                                        <div class="mini_cart_elem__name"><?=$item['name']?></div>
                                        <div class="mini_cart_elem__quantity" id="quant_id_<?=$item['id_goods']?>"><?=$item['quantity']?> шт.</div>
                                        <div class="mini_cart_elem__price"><span id="price_id_<?=$item['id_goods']?>"><?=$item['price']?></span> <i class="fa fa-rub" id="rubles" aria-hidden="true"></i></div>
                                    </div>
                                <? endforeach;?>
                        </div>
                        <div class="mini_cart_summ">Сумма:&nbsp; <span id="summ_mini_card"><?=$cartSumm?></span> &nbsp;рублей</div>
                        <a class="link_to_cart" href="/cart/">В корзину ---></a
                    </div>

            </div>
        <?endif;?>

    </div>
</header>



