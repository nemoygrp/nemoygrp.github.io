<?php
/**
 * Добавить нового пользователя
 */
function addNewUser(){
    $login = defenseSQL($_POST['login']);
    $pass = defenseSQL($_POST['pass']);
    $passHash = getPass($pass);
    $name = defenseSQL($_POST['name']);
    $phone = (int) preg_replace('~\D+~','', $_POST['phone']);
    $email = defenseSQL($_POST['email']);

    $sql = "INSERT INTO `users`(`access`, `login`, `pass`,`hash`, `name`, `phone`, `email`) VALUES ('user','{$login}','{$passHash}','0','{$name}','{$phone}','{$email}')";
    return executeQuery($sql);
}

/**
 * Хэширование пароля
 */
function getPass($pass){
    return password_hash($pass, PASSWORD_DEFAULT, ['cost' => 11, 'salt' => 'asdafgfsagasdfasdfasdasdasdfggaasfas']);
}
//$hash = password_hash(12, PASSWORD_DEFAULT, ['cost' => 11, 'salt' => 'asdafgfsagasdfasdfasdasdasdfggaasfas']);
//var_dump($hash);