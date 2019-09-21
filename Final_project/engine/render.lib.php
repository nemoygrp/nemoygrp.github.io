<?php
/**
 * Функция для получения изображений из БД
 * @return array - все изображения виде массива
 */
function getImg()
{
    $sql = "SELECT `id`,`name`,`likes`,`looks`,`commentCount` FROM gallery ORDER BY looks DESC";
    $img = getAssocResult($sql);
    return $img;
}

/**
 * Функция для получения товаров из БД
 */
function getGoods()
{
    $sql = "SELECT `id`,`img`,`name`,`price`,`likes`,`looks`,`discount`,`commentCount` FROM goods ORDER BY looks DESC";
    $goods = getAssocResult($sql);
    return $goods;
}

/**
 * Функция для получения пользователей из БД
 */
function getUsers(){
    $sql="SELECT `id`, `access`, `login`, `name`, `phone`, `email` FROM `users` WHERE 1";
    return getAssocResult($sql);
}

/**
 * Функция для получения заказов из БД
 */
function getOrders()
{
    $sql = "SELECT `id`,`name`,`phone`,`added`,`id_session`,`user`,`status` FROM `orders` ORDER BY added DESC";
    $orders = getAssocResult($sql);
    foreach ($orders as $key => $item){
        $innerSQL = "SELECT `id_goods`,COUNT(`id_goods`) AS 'quantity',`name`,`price`,sum(goods.price) as 'summ' FROM `cart`,`goods` WHERE `user` = '{$item['user']}' AND `cart`.`id_goods` = `goods`.`id` AND `id_orders` = '{$item['id']}' GROUP BY `id_goods`";
        $innerOrders = getAssocResult($innerSQL);
        $item['innerOrders'] = $innerOrders;
        $orders[$key]['innerOrders'] = $item['innerOrders'];

        $nextsql = "SELECT sum(goods.price) as 'summ',COUNT(`id_goods`) AS 'quantity' FROM `cart`,`goods` WHERE `id_orders` = '{$item['id']}' AND `cart`.`id_goods` = `goods`.`id`";
        $quantANDsumm = getAssocResult($nextsql);
        $orders[$key]['quantityAll'] = $quantANDsumm[0]['quantity'];
        $orders[$key]['summAll'] = $quantANDsumm[0]['summ'];
    }

    return $orders;
}

/**
 * Функция для получения корзины из БД
 */
function getCart(){
    $user = get_user();
    $id_session = session_id();

            if ($user === 0){
                $sql = "SELECT `id_goods`,COUNT(`id_goods`) AS 'quantity',`img`,`name`,`price` FROM `cart`,`goods` WHERE `id_session` = '{$id_session}' AND `user` = 0  AND `id_orders` = 0  AND `cart`.`id_goods` = `goods`.`id` GROUP BY `id_goods`";
            } else {
                $sql = "SELECT `id_goods`,COUNT(`id_goods`) AS 'quantity',`img`,`name`,`price` FROM `cart`,`goods` WHERE `user` = '{$user}' AND `cart`.`id_goods` = `goods`.`id` AND `id_orders` = 0 GROUP BY `id_goods`";
            }

    $goods = getAssocResult($sql);
    return $goods;
    //SELECT `id_goods`,COUNT(`id_goods`) AS 'quantity',`id_session`,`user`,`img`,`name`,`price` FROM `cart`,`goods` WHERE `user` = '{$user}' AND `id_session` = '{$id_session}' AND `cart`.`id_goods` = `goods`.`id` GROUP BY `id_goods`
}

/**
 * Функция для изменения оформления сайта в зависимости от дня года, пока настроена на 4 праздника НГ, 23февраля, 8марта и 9 мая
 */
function getHoliday(){
    $holiday =[]; //на будущее можно дополнять скидками и другим оформлением
    $day = getdate();
    if ($day['yday'] >= 60 && $day['yday'] <= 68){ // 8 Марта
        return '/img/banners/003.jpg';
    } elseif ($day['yday'] >= 50 && $day['yday'] <= 55){ //23 февраля
        return '/img/banners/001.jpg';
    } elseif ($day['yday'] >= 350 && $day['yday'] <= 7){ // Новый год
        return '/img/banners/003.jpg';
    } elseif ($day['yday'] >= 120 && $day['yday'] <= 130){ // День победы
        return '/img/banners/002.jpg';
    } else { // по умолчанию без баннера
        return "";
    }

}

/**
 * Функция для рендера основного шаблона
 * @param $page - название страницы
 * @param array $params - параметры которые необходимо ей передать в виде массива
 * @return false|string - получается на выходе зарендериная страница
 */
function render($page, $params = [])
{
    if (!$params['is_ajax']) {
        return renderTemplate(LAYOUTS_DIR . 'main', [
            'content' => renderTemplate($page, $params),
            'menu' => renderTemplate('menu', $params),
            'footer' => renderTemplate('footer', $params),
            'title' => SITE_TITLE
        ]);
    } else {
        return json_encode($params);
    }

}

/**
 * Вторая функция для рендера основного шаблона, в ней происходит все волшебство:
 * кэшируется содержимое страницы подставляя все переменные на свои места
 * @param $page
 * @param array $params
 * @return false|string
 */
function renderTemplate($page, $params = [])
{
    ob_start();

    if (!is_null($params)) {
        extract($params);
    }
    $fileName = TEMPLATES_DIR . $page . ".php";
    if (file_exists($fileName)) {
        include $fileName;
    } else {
        Die('Страницы не существует 404');
    }

    return ob_get_clean();
}