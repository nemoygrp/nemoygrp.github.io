<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 25.03.2019
 * Time: 11:29
 */

namespace app\controllers;

use app\model\Cart;
use app\model\Users;


class CartController extends Controller
{

    public function actionIndex(){
        $cart = Cart::getCart(0);
        echo $this->render("cart",[
            'cart'=> $cart,
            'userName' => Users::getName(),
            'userPhone' => Users::getPhone(),
            'cartCount' => Cart::getCartCount(),

        ]);
    }
}