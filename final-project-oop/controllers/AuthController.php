<?php


namespace app\controllers;
use app\model\Users;

class AuthController extends Controller
{
 public function actionLogin(){
     Users::login();
     header("Location: /");
 }

    public function actionLogout(){
        session_regenerate_id();
        session_destroy();
        header("Location: /");
    }
}