<?php
/**
 * Функция для введения необходимых параметров, которые позже пойдут на страницу
 * @param $page - название страницы для которой надо передать параметры
 * @return array - массив параметров в зависимости от страницы
 */
function prepareVariables($page, $action, $id, $access)
{
    $params = [];
    $params['is_ajax'] = false;
    $params['user'] = get_user();
    $params['userName'] = get_userName();
    $params['allow'] = get_allow();
    $params['access'] = $access;
    $params['cart'] = getCart();
    $params['cartCount'] = getCartCount();
    $params['cartSumm'] = getCartSumm();
    $params['holiday'] = getHoliday();
    switch ($page) {
        case 'index':
            break;
        case 'cart':
            $params['email'] = $_SESSION['email'];
            $params['userPhone'] = get_userPhone();
            $params['pageDetect'] = $page;
            break;
        case 'admin_panel':
            if ($access == 'admin'){
                $params['catalog'] = getGoods();
                $params ['gallery'] = getImg();
                $params ['allUsers'] = getUsers();
                break;
            } else {
                continue;
            }
        case 'logout':
                setcookie('pass');
                session_destroy();
                header("Location: /");
            break;
        case 'reg':
            addNewUser();
            header("Location: /");
            break;
        case 'login':
            login();
            header("Location: /");
            break;
        case 'catalog':
            $params['catalog'] = getGoods();
            break;
        case 'orders':
            $params['orders'] = getOrders();
            break;
        case 'orderConfirm':
            addNewOrder();
            break;
        case 'gallery':
            syncImg();
            /**
             * Метод загрузки фотографий в галерею
             */
            if (isset($_POST['load'])) {
                $path = "img/gallery/" . $_FILES["myfile"]["name"];
                if ($_FILES['myfile']['type'] == "image/jpeg"){
                    move_uploaded_file($_FILES["myfile"]["tmp_name"], $path);
                    executeQuery("INSERT INTO `gallery`(`name`, `likes`) VALUES ('{$_FILES["myfile"]["name"]}','0')");
                    $message = 1;
                } else {
                    $message = 2;
                }
                header("Location:?message={$message}");
            }
            /**
             * Передача сообщения об успешной/неуспешной загрузки
             */
            if (isset($_GET['message'])){
                switch ((int)$_GET['message']) {
                    case 1: $message = "Файл загружен";break;
                    case 2: $message = "Ошибка загрузки";break;
                    default: $message = "";
                }
            }
            $params ['gallery'] = getImg();
            $params ['message'] = $message;
            break;
        case 'gallery_page':
            add_looks('gallery',$id);
            $content = getOneElementToId('gallery',$id);
            $params['id'] = $content['id'];
            $params['name'] = $content['name'];
            $params['likes'] = $content['likes'];
            $params['looks'] = $content['looks'];
            $params['textAction'] = "Добавить";
            $params['comments'] = getAllComments('gallery',$id);
            break;
        case "goods_page":
            $content = getOneElementToId('goods',$id);
            add_looks('goods',$id);
            $params['id'] = $content['id'];
            $params['img'] = $content['img'];
            $params['name'] = $content['name'];
            $params['price'] = $content['price'];
            $params['likes'] = $content['likes'];
            $params['looks'] = $content['looks'];
            $params['textAction'] = "Добавить";
            $params['comments'] = getAllComments('goods',$id);
            break;
        case "ajax":
            $change = $_POST['change'];
            $id_parent = (int)$_POST['id_parent'];
            $id_elem = (int)$_POST['id'];
            $someDataAsoc = $_POST['someData'];
            $someData = $someDataAsoc['0'];
            $params = newCRUDBlock($change,$id_elem,$someData,$id_parent);
            $params['is_ajax'] = true;
            break;
    }

   // var_dump($page);

    //var_dump($params);
    return $params;
}