<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 20.03.2019
 * Time: 20:11
 */

namespace app\controllers;


use app\model\Cart;
use app\model\Feedback;
use app\model\Orders;
use app\model\Products;

class AjaxController extends Controller
{
    private $id_parent;
    private $id_elem;
    private $someData;

    public function __construct()
    {

        $this->id_parent = (int)$_POST['id_parent'];
        $this->id_elem = (int)$_POST['id'];
        $this->someData = $_POST['someData']['0'];
    }

    public function actionAddlike()
    {
        $parent = Products::getOne($this->id_elem);
        $parent->setLikes($parent->likes+1);
        $parent->update();
        $params["likes"] = $parent->likes;
        //$params["parent"] = $parent;
        echo json_encode($params);
    }
    public function actionBuyItem()
    {
        $parent = Products::getOne($this->id_elem);
        $id_session = session_id();
        $id_user = $_SESSION['id']?: 0;
        $cart = new Cart();
        $cart->setItem($id_session,$parent->id,$id_user,0);
        $cart->save();
        $params['id_goods'] = $parent->id;
        $params['name'] = $parent->name;
        $params['img'] = $parent->img;
        $params['price'] = $parent->price;
        echo json_encode($params);
    }
    public function actionDelGoodFromCart()
    {
        $parent = Products::getOne($this->id_elem);;
        $cart = Cart::getWhere('id_product = :id_product ORDER BY id DESC LIMIT 1 ',[':id_product'=>$parent->id]);
        $cart-> delete();
        $params['id_goods'] = $parent->id;
        $params['name'] = $parent->name;
        $params['price'] = $parent->price;
        echo json_encode($params);
    }
    public function actionAddComment(){
        $parent = Products::getOne($this->id_parent);
        $parent->setCommentCount($parent->commentCount+1);
        $parent->update();
        $name = $this->someData['name'];
        $text = $this->someData['text'];
        $from_table = $this->someData['table'];
        $feedback = new Feedback();
        $feedback->setItem($text,$name,$this->id_parent,$from_table);
        $feedback->save();
        $params['id'] = $feedback->id;
        $params['price'] = $feedback->price;
        echo json_encode($params);
    }
    public function actionDelComment(){
        $parent = Products::getOne($this->id_parent);
        $parent->setCommentCount($parent->commentCount-1);
        $parent->update();
        $feedback = Feedback::getOne($this->id_elem);
        $feedback->delete();
        $params['id_block'] = $this->id_elem;
        echo json_encode($params);
    }
    public function actionEditComment()
    {
        $feedback = Feedback::getOne($this->id_elem);
        $params['name'] = $feedback->name;
        $params['message'] = $feedback->feedback;
        $params['id'] = $feedback->id;
        echo json_encode($params);
    }
    public function actionConfirmEditComment(){
        $name = $this->someData['name'];
        $text = $this->someData['text'];
        $from_table = $this->someData['table'];
        $feedback = new Feedback();
        $feedback->setItem($text,$name,$this->id_parent,$from_table);
        $feedback->save();
        $params['name'] = $name;
        $params['message'] = $text;
        echo json_encode($params);
    }
    public function actionAddOrder(){
        $phone = $this->someData['phone'];
        $id_session = session_id();
        $id_user = $_SESSION['id']?:0;
        $order = new Orders();
        $order->setItem($id_session,'Ожидает подтверждения',$id_user,$phone);
        $order->save();
        $cart = Cart::updateCart($order->id,
            "id_session = :id_session AND id_user = :id_user AND `id_orders` = 0",[
            ":id_session" => $id_session,
            ":id_user" => $id_user
        ]);
        echo json_encode(['id_user' => $id_user,
            'id_order' => $order->id]);
    }
    public function actionUpdateStatus(){
        $newStatus = $this->someData ['newStatus'];
        $status = Orders::getOne($this->id_elem);
        $status->setStatus($newStatus);
        $status->save();
        echo json_encode('');
    }
    public function actionConfirmEditElemListAP(){
        $name = $this->someData ['name'];
        $price = $this->someData ['price'];
        $discount = $this->someData ['discount'];
        $description = $this->someData ['description'];
        $img = $this->someData ['img'];
        $params['name'] = $name;
        $params['price'] = $price;
        $params['discount'] = $discount;
        $params['description'] = $description;
        $params['img'] = $img;
        $params['id'] = $this->id_elem;
        echo json_encode($params);
    }
    public function actionEditElemListAP(){
        $elem = Products::getOne($this->id_elem);
        $params['name'] = $elem->name;
        $params['price'] = $elem->price;
        $params['discount'] = $elem->discount;
        $params['img'] = $elem->img;
        $params['description'] = $elem->description?:'';
        $params['id'] = $this->id_elem;
        echo json_encode($params);
    }
    public function actionDelElemListAP(){

        echo json_encode('');
    }
    public function actionAddElemListAP(){
        $elem = Products::getAllWhere('id > 0 ORDER BY `id` DESC LIMIT 1',[]);
        $params['lastID'] =  $elem[0]['id'] + 1;
        echo json_encode($params);
    }

    }