<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 15.03.2019
 * Time: 20:36
 */

namespace app\controllers;
use app\model\Products;
use app\model\Feedback;
use app\model\Users;

class ProductsController extends Controller
{


    public function actionIndex(){
        $catalog = Products::getAll();
        echo $this->render("catalog",['catalog'=> $catalog]);
    }

    public function actionCard($id){

        $products = Products::getOne($id);
        $products->setLooks($products->looks+1);
        $products->update();
        echo $this->render("card",[
            'products'=>$products,
            'userName' => Users::getName(),
            'access' => Users::getAccess(),
            'allow' => Users::get_allow(),
            'comments'=>Feedback::getComments($id,'products')]);
    }


}