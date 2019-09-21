<?php
session_start();
include "../config/main.php";
clearCart();
/*
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'index';
}
*/
$url_array = explode("/", $_SERVER['REQUEST_URI']);
$page = "";
$action = "";
$id = "";
if ($url_array[1] == "") {
    $page = "index";
    $id = "";
} else {
    $page = $url_array[1];
    if (!$url_array[2] == "") {
        if (is_numeric($url_array[2])) {
            $id = $url_array[2];
        } else {
            $action = $url_array[2];
            if (is_numeric($url_array[3])) {
                $id = $url_array[3];
            }
        }
    }
}

$access = getAccessLevel();

$params = prepareVariables($page, $action, $id, $access);

echo render($page, $params);

closeDb();