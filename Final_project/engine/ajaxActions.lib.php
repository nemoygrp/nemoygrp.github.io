-y<?php
/**
 * Ассинхронный CRUD блок для управления всеми ajax запросами
 * @param $change - то действие которое необходимо совершить
 * @param $id_elem - передается по средствам ajax id
 * @param $someData - передается по средствам ajax любая другая информация в любом размере
 * @param $id_parent - передается по средствам ajax при необходимости id родителя
 * @return mixed - массив Params который в виде json ответа возвращается в функцию файла Button.js
 */
function newCRUDBlock($change,$id_elem,$someData,$id_parent){
    switch ($change) {
        case "addlike":
            $table = $someData ['table'];
            add_likes($table,$id_elem);
            $image = getOneElementToId($table, $id_elem);
            $params['likes'] = $image['likes'];
            break;
        case "addComment":
            $name = $someData ['name'];
            $text = $someData ['text'];
            $table = $someData['table'];
            addComment($name,$text,$id_parent,$table);
            addCommentCount($table,$id_parent);
            $params['id_new_message'] = (int) detectWhyCommentId('feedback')['id'];
            break;
        case "delComment":
            $table = $someData ['table'];
            $comment = getOneElementToId('feedback', $id_elem);
            $params['id_block'] = $comment['id'];
            delCommentCount($table,$id_parent);
            delOneElementToId('feedback', $id_elem);
            break;
        case "editComment":
            $comment = getOneElementToId('feedback', $id_elem);
            $params['name'] = $comment['name'];
            $params['message'] = $comment['feedback'];
            $params['id'] = $id_elem;
            break;
        case "confirmEditComment":
            $name = $someData ['name'];
            $text = $someData ['text'];
            $params['id'] = $id_elem;
            updateFeedback($name,$text,$id_elem);
            $params['name'] = $name;
            $params['message'] = $text;
            break;
        case "buyItem":
            $id_goods = $id_elem;
            $id_session = session_id();
            $user = get_user();
            addToCart($id_session,$id_goods,$user);
            $newElem = getOneElementToId('goods',$id_goods);
            $params['id_goods'] = $id_goods;
            $params['name'] = $newElem['name'];
            $params['img'] = $newElem['img'];
            $params['price'] = $newElem['price'];
            break;
        case "delImageFromGallery":
            $delItem = getOneElementToId('gallery', $id_elem);
            //TODO Отключил реальное удаление файла и элемента из базы, при продакшене включить
            //unlink('img/gallery/'.$delItem['name']);
            //delOneElementToId('gallery',$id_elem);
            $params['id_block'] = $id_elem;
            break;
        case "delGoodFromCart":
            $firstElem = checkTheFirst($id_elem);
            delOneElementToId('cart',$firstElem);
            $newElem = getOneElementToId('goods',$id_elem);
            $params['id_goods'] = $id_elem;
            $params['price'] = $newElem['price'];
            $params['proverka'] = $firstElem;
            break;
        case "updateStatus":
            $newStatus = $someData ['newStatus'];
            updateOrderStatus($id_elem,$newStatus);
            break;
        case 'editElemListAP':
            $elem = getOneElementToId('goods', $id_elem);
            $params['name'] = $elem['name'];
            $params['price'] = $elem['price'];
            $params['discount'] = $elem['discount'];
            $params['img'] = $elem['img'];
            $params['id'] = $id_elem;
            break;
        case 'confirmEditElemListAP':
            $name = $someData ['name'];
            $price = $someData ['price'];
            $discount = $someData ['discount'];
            $img = $someData ['img'];
            $params['name'] = $name;
            $params['price'] = $price;
            $params['discount'] = $discount;
            $params['img'] = $img;
            $params['id'] = $id_elem;
            //не стал делать удаление и исправление из базы, правим понарошку вставить функцию UPDATE все переменные готовы
            break;
        case 'addElemListAP':
            $lastID = (int) detectWhyCommentId('goods')['id'];
            $params['lastID'] = $lastID + 1;
            break;
        case 'delElemListAP':
            break;
    }
    return $params;

}