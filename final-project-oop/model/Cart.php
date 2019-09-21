<?php

namespace app\model;


class Cart extends DbModel
{

    public $properties = [
        'id' => false,
        'dateCreate' => false,
        'id_session' => false,
        'id_product' => false,
        'id_user' => false,
        'id_orders' => false,
    ];


    function __construct()
    {
        $values = $this->properties;
        foreach ($values as $key => $value) {
            $this->$key = null;
        }

    }
    public function setItem($id_session,$id_product,$id_user,$id_orders)
    {
        $this->dateCreate = date("Y-m-d H:i:s");
        $this->setId_session($id_session);
        $this->setId_product($id_product);
        $this->setid_user($id_user);
        $this->setid_orders($id_orders);
    }
    public function setId_session($id_session)
    {
        $this->properties['id_session'] = true;
        $this->id_session = $id_session;
    }
    public function setId_product($id_product)
    {
        $this->properties['id_product'] = true;
        $this->id_product = $id_product;
    }
    public function setId_user($id_user)
    {
        $this->properties['id_user'] = true;
        $this->id_user = $id_user;
    }
    public function setId_orders($id_orders)
    {
        $this->properties['id_orders'] = true;
        $this->id_orders = $id_orders;
    }




    public static function getCartCount(){
        $user_id = $_SESSION['id'];
        $id_session = session_id();
        /*if(Users::is_auth()){
            return Cart::getCountWhere(
                "id_user = :id_user AND id_orders = 0",
                [':id_user' => $user_id]
            );
        } else {*/
            return Cart::getCountWhere(
                "id_session = :id_session AND id_orders = 0",
                [':id_session' => $id_session]
            );
       // }
        //return $count;

    }
    public static function getCart($id_order){
        $user_id = $_SESSION['id'];
        $id_session = session_id();

        /*if(Users::is_auth()){
           return Users::getDBCart(
                "c.id_user = :id_user AND c.id_orders = :id_order",
                [':id_user' => $user_id,
                ':id_order' =>$id_order]
            );
        } else {*/
            return Users::getDBCart(
                "c.id_session = :id_session AND c.id_orders = :id_order",
                [':id_session' => $id_session,
                 ':id_order' =>$id_order]
            );
        //}

    }

    public static function getTableName()
    {
        return "cart";
    }

}