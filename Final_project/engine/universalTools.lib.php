<?php
/**
 * Функция автоматически защищающая пост-запрос, просто сокращение кода
 * @param $postContent - То что нужно защитить от sql инъекций
 * @return string результат
 */
function defenseSQL($postContent){
    $db = getDb();
    return mysqli_real_escape_string($db, strip_tags(htmlspecialchars($postContent)));
}

/**
 *  Универсальная функция по удалению 1 элемента из той базы, из которой нужно
 * @param $table - Нужная таблица
 * @param $id - нужный айди
 * @return bool|mysqli_result - готово
 */
function delOneElementToId($table,$id){
    $id = (int)$id;
    $sql = "DELETE FROM {$table} WHERE id = {$id}";
    return executeQuery($sql);
}

/**
 *  Универсальная функция по получению 1 элемента по айди
 * @param $table - Нужная таблица
 * @param $id - нужный айди
 * @return bool|mysqli_result - готово
 */
function getOneElementToId($table,$id){
    $id = (int)$id;
    $sql = "SELECT * FROM `{$table}` WHERE id = {$id}";
    $elem = getAssocResult($sql);
    $result = [];
    if (isset($elem[0]))
        $result = $elem[0];
    return $result;
}

/**
 *  Функция по получению ID последнего добавленного элемента
 * @param $table - Нужная таблица
 * @return bool|mysqli_result - готово
 */
function detectWhyCommentId($table){
    $sql = "SELECT `id` FROM {$table} ORDER BY `id` DESC LIMIT 1";
    $elem = getAssocResult($sql);
    $result = [];
    if (isset($elem[0]))
        $result = $elem[0];
    return $result;
}

/**
 * Универсальная функция увеличения кол-ва лайков
 * @param $table - нужная таблица
 * @param $id - айди того элемента лайки которых нужно увеличить
 */
function add_likes($table,$id)
{
    $sql = "UPDATE `{$table}` SET `likes` = `likes` + 1 WHERE id={$id}";
    executeQuery($sql);
}

/**
 * Универсальная функция увеличения кол-ва просмотров
 * @param $table - нужная таблица
 * @param $id - айди того элемента просмотры которых нужно увеличить
 */
function add_looks($table,$id){
    $sql = "UPDATE `{$table}` SET `looks` = `looks` + 1 WHERE id={$id}";
    executeQuery($sql);
}