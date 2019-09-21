<?php

namespace app\model;
class Users extends DbModel
{
    public $properties = [
        'id' => false,
        'login' => false,
        'pass' => false,
        'name' => false,
        'phone' => false,
        'email' => false,
        'access' => false,
        'hash' => false
    ];


    function __construct()
    {
        $values = $this->properties;
        foreach ($values as $key => $value){
            $this->$key = null;
        }

    }
    public static function login(){

        if (isset($_POST['send'])) {
            $login = $_POST['login'];
            $pass = $_POST['pass'];
            if (!Users::auth($login, $pass)) {
                Die('Не верный логин пароль');
            } else {
                if (isset($_POST['save'])) {
                    $hash = uniqid(rand(), true);
                    $user = Users::getOne($_SESSION['id']);
                    $user->setHash($hash);
                    $user->update();
                    setcookie("hash", $hash, time() + 3600);
                }
                return true;
            }
        }
    }
    protected static function auth($login, $pass){

        /*
            $options = [
                'cost' => 11,
                'salt' => SALT
            ];
        */

        $result = Users::getWhere('login = :login',[':login' => $login]);

        if (password_verify($pass, $result->pass)) {
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $result->id;
            $_SESSION['access'] = $result->access;
            $_SESSION['name'] = $result->name;
            $_SESSION['phone'] = $result->phone;
            $_SESSION['email'] = $result->email;

            return true;
        }
        return false;
    }
    public static function is_auth()
    {
        if (isset($_COOKIE["hash"])) {
            $result = Users::getWhere('hash = :hash',[':hash' => $_COOKIE["hash"]]);
            if (!empty($result)) {
                $_SESSION['login'] = $result->login;
            }
        }
        return isset($_SESSION['login']) ? true : false;
    }

    public static function getTableName()
    {
        return "users";
    }

    public function setItem($login,$pass,$name,$phone,$email)
    {
        $this->setLogin($login);
        $this->setName($name);
        $this->setPass($pass);
        $this->setPhone($phone);
        $this->setEmail($email);
        $this->setAccess('user');
        $this->setHash(uniqid(rand(), true));

    }

    public function setName($name)
    {
        $this->properties['name'] = true;
        $this->name = $name;
    }
    public static function getName()
    {
        return Users::is_auth() ? $_SESSION['name'] : 'Гость';
    }


    public function setLogin($login)
    {
        $this->properties['login'] = true;
        $this->login = $login;
    }
    public function getLogin()
    {
        return $this->login;
    }


    public function setPass($pass)
    {
        $this->properties['pass'] = true;
        $passHash = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 11, 'salt' => 'asdafgfsagasdfasdfasdasdasdfggaasfas']);
        $this->pass = $passHash;
    }
    public function getPass()
    {
        return $this->pass;
    }


    public function setHash($hash)
    {
        $this->properties['hash'] = true;
        $this->hash = $hash;
    }
    public function getHash()
    {
        return $this->hash;
    }


    public function setPhone($phone)
    {
        $this->properties['phone'] = true;
        $this->phone = $phone;
    }
    public static function getPhone()
    {
        $phone = (string) $_SESSION['phone'];
        $phoneGood = '+' . $phone[0] . '(' . $phone[1] . $phone[2] . $phone[3] . ')' . $phone[4] . $phone[5] .
            $phone[6] . '-' . $phone[7] . $phone[8] . '-' . $phone[9] . $phone[10];
        return Users::is_auth() ? $phoneGood : 'Нет номера';
    }


    public function setEmail($email)
    {
        $this->properties['email'] = true;
        $this->email = $email;
    }
    public static function getEmail()
    {
        return Users::is_auth() ? $_SESSION['email'] : 'Нет почты';
    }


    public function setAccess($access)
    {
        $this->properties['access'] = true;
        $this->access = $access;
    }
    public static function getAccess()
    {
        return Users::is_auth() ? $_SESSION['access'] : false;
    }
    public static function get_allow(){
        $allow = false;
        if (Users::is_auth()) {
            $allow = true;
        }
        return $allow;
    }
}
