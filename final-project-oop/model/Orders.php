<?php

namespace app\model;


class Orders extends DbModel
{
    public $properties = [
        'id' => false,
        'added' => false,
        'status' => false,
        'id_user' => false,
        'id_session' => false,
        'phone' => false,
    ];


    function __construct()
    {
        $values = $this->properties;
        foreach ($values as $key => $value) {
            $this->$key = null;
        }

    }

    public static function getOrders(){
        $orders = Orders::getAll();
        $allQuantity = 0;
        $allSumm =0;
        foreach ($orders as $key => $item) {
            $orders[$key] += ['inner' => Users::getDBCart('c.id_orders = :id_orders',[':id_orders' => $item['id']])];
            $orders[$key] += ['name' => Users::getOne($item['id_user'])->name];
        }
        foreach ($orders as $key => $item) {
            foreach ($item['inner'] as $value){
                $allQuantity += +$value['quantity'];
                $allSumm += +$value['quantity']*+$value['price'];
            }
            $orders[$key] += [
                'allQuantity' => $allQuantity,
                'allSumm' => $allSumm
            ];
            $allSumm =0;
            $allQuantity = 0;
        }
        return $orders;

    }
    public function setItem($id_session,$status,$id_user,$phone)
    {
        $this->added = date("Y-m-d H:i:s");
        $this->setId_session($id_session);
        $this->setStatus($status);
        $this->setid_user($id_user);
        $this->setphone($phone);
    }
    public function setId_session($id_session)
    {
        $this->properties['id_session'] = true;
        $this->id_session = $id_session;
    }
    public function setStatus($status)
    {
        $this->properties['status'] = true;
        $this->status = $status;
    }
    public function setPhone($phone)
    {
        $this->properties['phone'] = true;
        $this->phone = $phone;
    }
    public function setId_user($id_user)
    {
        $this->properties['id_user'] = true;
        $this->id_user = $id_user;
    }
    public static function getTableName()
    {
        return "orders";
    }
}