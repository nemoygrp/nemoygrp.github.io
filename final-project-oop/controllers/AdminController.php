<?php


namespace app\controllers;


use app\model\Gallery;
use app\model\Users;
use app\model\Products;

class AdminController extends Controller
{
    public function actionIndex(){
        $catalog = Products::getAll();
        $gallery = Gallery::getAll();
        $users = Users::getAll();
        echo $this->render("admin_panel",[
            'catalog'=> $catalog,
            'gallery'=> $gallery,
            'allUsers'=> $users
        ]);
    }
}