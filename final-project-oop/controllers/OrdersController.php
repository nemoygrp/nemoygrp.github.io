<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 26.03.2019
 * Time: 14:51
 */

namespace app\controllers;

use app\model\Cart;
use app\model\Orders;
use app\model\Products;
use app\model\Users;


class OrdersController extends Controller
{
    public function actionIndex(){
        $orders = Orders::getOrders();
        echo $this->render("orders",['orders'=> $orders,
            'access' => Users::getAccess(),
        ]);
    }
}