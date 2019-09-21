<?php
/**
 * Правка комментария
 */
function updateFeedback($name,$text,$id_elem)
{
    $namez = defenseSQL($name);
    $message = defenseSQL($text);
    $sql = "UPDATE `feedback` SET `name` = '{$namez}', `feedback` = '{$message}' WHERE `feedback`.`id` = {$id_elem};";

    return executeQuery($sql);

}

/**
 * Добавить новый коммент
 */
function addComment($name,$text,$id_parent,$correction)
{
    $namez = defenseSQL($name);
    $message = defenseSQL($text);
    $sql = "INSERT INTO `feedback` (`name`, `feedback`,`id_parent`,`from_table`) VALUES ('{$namez}', '{$message}', '{$id_parent}','{$correction}');";
    return executeQuery($sql);

}

/**
 * Получение всех комментариев для конкретной страницы
 */
function getAllComments($correction,$id)
{
    $sql = "SELECT * FROM feedback WHERE from_table = '{$correction}' AND id_parent = {$id} ORDER BY id DESC"; //Странно но работает только с двумя одинарными кавычками
    return getAssocResult($sql);
}

/**
 * Увеличение счетчика комментариев
 */
function addCommentCount($table,$id_parent){
        $sql = "UPDATE `{$table}` SET `commentCount` = `commentCount` + 1 WHERE id={$id_parent}";
        executeQuery($sql);
}

/**
 * Уменьшение счетчика комментариев
 */
function delCommentCount($table,$id_parent){
    $sql = "UPDATE `{$table}` SET `commentCount` = `commentCount` - 1 WHERE id={$id_parent}";
    executeQuery($sql);
}