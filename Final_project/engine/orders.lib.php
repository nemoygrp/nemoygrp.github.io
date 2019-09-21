<?php
/**
 * Добавить новый заказ
 */
function addNewOrder(){
    $date = date('Y-m-d H:i:s');
    $user = get_user();
    $userName = get_userName();
    $id_session = session_id();
    $phone = (string) $_POST['phone'];
    $email = get_userEmail();

    $sql = "INSERT INTO `orders`(`id_session`,`added`,`user`,`name`, `phone`, `e-mail`,`status`) VALUES ('{$id_session}','{$date}','{$user}','{$userName}','{$phone}','{$email}','Ожидает подтверждения')";
    executeQuery($sql);

    $sql = "SELECT `id` FROM `orders` WHERE `id_session` = '{$id_session}' AND `user` = '{$user}' ORDER BY `id` DESC LIMIT 1";
    $elem = getAssocResult($sql);
    $result = [];
    if (isset($elem[0]))
        $result = (int) $elem[0]['id'];

    $sql = "UPDATE `cart` SET `id_orders`= '{$result}' WHERE `id_session` = '{$id_session}' AND `user` = '{$user}' AND `id_orders` = 0";
    return executeQuery($sql);
}

/**
 * Обновить статус заказа
 */
function updateOrderStatus($id_elem,$newStatus){
    $sql ="UPDATE `orders` SET `status`= '{$newStatus}' WHERE `id` = '{$id_elem}'";
    return executeQuery($sql);
}