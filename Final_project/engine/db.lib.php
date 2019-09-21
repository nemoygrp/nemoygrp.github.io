<?php
/**
 * Функция подключения базы данных
 * @return mysqli|null
 */
function getDb()
{
    static $db = null;
    if (is_null($db)) {
        $db = @mysqli_connect(HOST, USER, PASS, DB) or die("Could not connect: " . mysqli_connect_error());
    }
    return $db;
}

/**
 * Функция закрытия базы данных
 */
function closeDb() {
    mysqli_close(getDb());
}

/**
 * Функция создания ассоциативного массива из базы данных
 * @param $sql - запрос
 * @return array - собственно массив
 */
function getAssocResult($sql)
{
    $db = getDb();
    $result = @mysqli_query($db, $sql) or die(mysqli_error($db));
    $array_result = [];
    while ($row = mysqli_fetch_assoc($result))
        $array_result[] = $row;
    return $array_result;
}

/**
 * Функция создания ассоциативного массива из базы данных 1 строка
 * @param $sql - запрос
 * @return array - собственно массив
 */
function getAssocRow($sql)
{
    $db = getDb();
    $result = @mysqli_query($db, $sql) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result);
    return $row;
}
/**
 * Функция для простого запроса в бд - вроде добавить или исправить
 * @param $sql
 * @return bool|mysqli_result - при TRUE совершает действие с БД, при FALSE выводит ошибку
 */
function executeQuery($sql)
{
    $db = getDb();

    $result = @mysqli_query($db, $sql) or die(mysqli_error($db));
    return $result;
}

/**
 * Функция для синхронизации бд с папкой. Позволяет загрузить фото на сайт и в бд, просто залив файлы в папку img/gallery
 * @return array - массив всех изображений
 */
//TODO Переработать запросы SQL из циклов в строку с последующим вызовом в 1
//Запросы в цикле не очень хорошо, один запрос может долго выполняться, лучше в цикле формировать один инсерт, вот пример:
//INSERT INTO
//goods(title, price)
//VALUES
//("Вилка", 25),
//("Столовая ложка", 35),
//("Чайная ложка", 30)
//Через запятую записи перечисляются, потом одним запросом добавить.
function syncImg(){
    $arr = array_slice(scandir('img/gallery'), 2);
    $dbarr = getImg();
    $countDBarr = 0;
    if (empty($dbarr)) {
        for ($i = 0; $i < count($arr); $i++, $countDBarr++) {
            executeQuery("ALTER TABLE `gallery` AUTO_INCREMENT=0;");
            if (count($dbarr) <= $countDBarr) {
                executeQuery("INSERT INTO `gallery`(`name`, `likes`,`looks`,`commentCount`) VALUES ('{$arr[$i]}','0','0','0')");
            }
        }
    } else if (count($dbarr) != count(arr)) {
        $fliparr = array_flip($arr);
        foreach ($dbarr as $item) {
            if ((array_key_exists($item['name'], $fliparr))) {
                unset($fliparr["{$item['name']}"]);
            }
        }
    }
    $add = array_flip($fliparr);
    if (!empty($add)) {
        foreach ($add as $value) {
            executeQuery("INSERT INTO `gallery`(`name`, `likes`,`looks`,`commentCount`) VALUES ('{$value}','0','0','0')");
            unset($add[array_search($value, $add)]);
        }
    }
    return $dbarr;
}
