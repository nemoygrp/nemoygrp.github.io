<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 19.03.2019
 * Time: 9:38
 */

namespace app\controllers;


use app\model\Cart;
use app\model\Users;

class IndexController extends Controller
{
    public function actionIndex(){

        //$catalog = Products::getAll();
        echo $this->render("index",['']);
    }
}