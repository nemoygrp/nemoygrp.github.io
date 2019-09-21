<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 24.03.2019
 * Time: 7:23
 */

namespace app\controllers;

use app\model\Gallery;
use app\model\Feedback;
use app\model\Users;


class GalleryController extends Controller
{
    public function actionIndex(){
        $gallery = Gallery::getAll();
        echo $this->render("gallery",['gallery'=> $gallery]);
    }

    public function actionImage($id){

        $products = Gallery::getOne($id);
        $products->setLooks($products->looks+1);
        $products->update();
        echo $this->render("image",['params'=>$products,
            'userName' => Users::getName(),
            'access' => Users::getAccess(),
            'allow' => Users::get_allow(),
            'comments'=>Feedback::getComments($id,'gallery')
            ]);
    }

}