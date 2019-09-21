<?php

//define("SALT", "asdafgfsagasdfasdfasdasdasdfggaasfas");
$allow = false;


function login()
{
    if (isset($_POST['send'])) {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        if (!auth($login, $pass)) {
            Die('Не верный логин пароль');
        } else {
            if (isset($_POST['save'])) {
                $hash = uniqid(rand(), true);
                $id = defenseSQL($_SESSION['id']);
                executeQuery("UPDATE `users` SET `hash` = '{$hash}' WHERE `users`.`id` = {$id}");
                setcookie("hash", $hash, time() + 3600);
            }
            return true;
        }
    }
}

function auth($login, $pass)
{
    $login_user = defenseSQL($login);
    /*
        $options = [
            'cost' => 11,
            'salt' => SALT
        ];
    */
    $result = getAssocRow("SELECT * FROM users WHERE login = '{$login_user}'");
    if (password_verify($pass, $result['pass'])) {
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $result['id'];
        $_SESSION['access'] = $result['access'];
        $_SESSION['name'] = $result['name'];
        $_SESSION['phone'] = $result['phone'];
        $_SESSION['email'] = $result['email'];

        return true;
    }
    return false;
}

function is_auth()
{
    if (isset($_COOKIE["hash"])) {
        $hash = $_COOKIE["hash"];
        $result = getAssocRow("SELECT * FROM `users` WHERE `hash`='{$hash}'");
        $user = $result['login'];
        if (!empty($user)) {
            $_SESSION['login'] = $user;
        }
    }
    return isset($_SESSION['login']) ? true : false;
}

/**
 * Получение Login
 */
function get_user()
{
    return is_auth() ? $_SESSION['login'] : 0;
}

/**
 * Получение Имени
 */
function get_userName()
{
    return is_auth() ? $_SESSION['name'] : 'Гость';
}

/**
 * Получение Номера телефона
 */
function get_userPhone()
{
    $phone = (string) $_SESSION['phone'];
    $phoneGood = '+' . $phone[0] . '(' . $phone[1] . $phone[2] . $phone[3] . ')' . $phone[4] . $phone[5] .
        $phone[6] . '-' . $phone[7] . $phone[8] . '-' . $phone[9] . $phone[10];
    return is_auth() ? $phoneGood : 'Нет номера';
}

/**
 * Получение email
 */
function get_userEmail()
{
    return is_auth() ? $_SESSION['email'] : 'Нет почты';
}

/**
 * Получение авторизации и права ходить по сайту авторизованым
 */
function get_allow(){
    $allow = false;
    if (is_auth()) {
        $allow = true;
    }
    return $allow;
}

/**
 * Получение уровня доступа
 */
function getAccessLevel(){
 return is_auth() ? $_SESSION['access'] : false;
}


//$hash = password_hash(12, PASSWORD_DEFAULT, ['cost' => 11, 'salt' => 'asdafgfsagasdfasdfasdasdasdfggaasfas']);
//var_dump($hash);

//$hash = password_hash(123, PASSWORD_DEFAULT, ['cost' => 11, 'salt' => 'asdafgfsagasdfasdfasdasdasdfggaasfas']);
//var_dump(password_verify(123,$hash));


