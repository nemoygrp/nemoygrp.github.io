<?php
namespace app\model;

class Products extends DbModel
{
    public $textAction = 'Добавить';
    public $properties = [
        'id' => false,
        'name' => false,
        'description' => false,
        'price' => false,
        'img' => false,
        'likes' => false,
        'looks' => false,
        'discount' => false,
        'commentCount' => false,
    ];


   function __construct()
    {
        $values = $this->properties;
       foreach ($values as $key => $value) {
               $this->$key = null;
       }

   }
    public function setItem($img,$name,$description,$price)
    {
        $this->setName($name);
        $this->setImg($img);
        $this->setDescription($description);
        $this->setPrice($price);
    }
    public function setName($name)
{
    $this->properties['name'] = true;
    $this->name = $name;
}

    public function setImg($img)
    {
        $this->properties['img'] = true;
        $this->img = $img;
    }
    public function setDescription($description)
    {
        $this->properties['description'] = true;
        $this->description = $description;
    }
    public function setPrice($price)
    {
        $this->properties['price'] = true;
        $this->price = $price;
    }
    public function setLikes($likes)
    {
        $this->properties['likes'] = true;
        $this->likes = $likes;
    }
    public function setLooks($looks)
    {
        $this->properties['looks'] = true;
        $this->looks = $looks;
    }
    public function setDiscount($discount)
    {
        $this->properties['discount'] = true;
        $this->discount = $discount;
    }
    public function setCommentCount($commentCount)
    {
        $this->properties['commentCount'] = true;
        $this->commentCount = $commentCount;
    }
    public static function getTableName()
    {
       return "products";
    }

}