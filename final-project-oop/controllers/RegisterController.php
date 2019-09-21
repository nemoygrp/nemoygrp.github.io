<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 28.03.2019
 * Time: 6:57
 */

namespace app\controllers;


use app\model\Users;

class RegisterController extends Controller
{
    public function actionIndex(){
        echo $this->render("register",['']);
    }
    public function actionConfirm(){
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $name = $_POST['name'];
        $phone = (int) preg_replace('~\D+~','', $_POST['phone']);
        $email = $_POST['email'];
        $newUser = new Users();
        $newUser->setItem($login,$pass,$name,$phone,$email);
        $newUser->save();
        Users::login();
        header("Location: /");
    }
}