<?php

/**
 * Функция добавления в корзину
 */
function addToCart($id_session,$id_goods,$user){
    $date = date("Y-m-d");
    $sql = "INSERT INTO `cart`(`dateCreate`,`id_session`,`id_goods`,`user`,`id_orders`) VALUES ('{$date}','{$id_session}','{$id_goods}','{$user}','0')";
    return executeQuery($sql);
}

/**
 * Получение колличества товаров в корзине
 */
function getCartCount(){
    $user = get_user();
    $id_session = session_id();
    if ($user === 0){
        $sql = "SELECT COUNT(id) AS 'count' FROM `cart` WHERE `id_session` = '{$id_session}' AND `user` = 0 AND `id_orders` = 0";
    } else {
        $sql = "SELECT COUNT(id) AS 'count' FROM `cart` WHERE `user` = '{$user}' AND `id_orders` = 0";
    }

    $count = getAssocResult($sql);
    $result = [];
    if (isset($count[0]))
        $result = $count[0];

    return $result['count'];
}

/**
 * Получение суммы за товары в корзине
 */
function getCartSumm(){
    $id_session = session_id();
    $user = get_user();
    if ($user === 0){
        $sql = "SELECT sum(goods.price) as 'summ' FROM `cart`,`goods` WHERE `cart`.`id_goods`=`goods`.`id` AND `id_session` = '{$id_session}' AND `user` = 0 AND `id_orders` = 0";
    } else {
        $sql = "SELECT sum(goods.price) as 'summ' FROM `cart`,`goods` WHERE `cart`.`id_goods`=`goods`.`id` AND `user` = '{$user}' AND `id_orders` = 0";
    }
    $summ = getAssocResult($sql);

    $result = [];
    if (isset($summ[0]))
        $result = $summ[0];

    return $result['summ'];
}

/**
 * Очистка старых потеряных элементов корзины от неавторизованых пользователей и оставленные более 3 дней назад
 */
function clearCart(){
    $date = new DateTime('-3 days');
    $newDate = $date->format('Y-m-d');
    $sql = "DELETE FROM `cart` WHERE `user` = 0 AND `dateCreate`<'{$newDate}' AND `id_orders` = 0";
    return executeQuery($sql);
}

/**
 * Определение первого экспоната данного продукта купленного одним и тем же пользователем и получение его ID
 */
function checkTheFirst($id_elem){
    $id_session = session_id();
    $user = get_user();
    $sql = "SELECT `id`, `id_session`, `id_goods`, `user` FROM `cart` WHERE `id_session` = '{$id_session}' AND `user` = '{$user}'  AND `id_goods` = '{$id_elem}' AND `id_orders` = 0";
    $onePosition = getAssocResult($sql);

    $result = [];
    if (isset($onePosition[0]))
        $result = $onePosition[0];

    return $result['id'];
}

