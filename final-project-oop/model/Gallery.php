<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 24.03.2019
 * Time: 7:26
 */

namespace app\model;


class Gallery extends DbModel
{
    public $textAction = 'Добавить';
    public $properties = [
        'id' => false,
        'name' => false,
        'likes' => false,
        'looks' => false,
        'commentCount' => false
    ];

    function __construct()
    {
        $values = $this->properties;
        foreach ($values as $key => $value){
            $this->$key = null;
        }

    }
    public function setName($name)
    {
        $this->properties['name'] = true;
        $this->name = $name;
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

    public function setCommentCount($commentCount)
    {
        $this->properties['commentCount'] = true;
        $this->commentCount = $commentCount;
    }
    public static function getTableName()
    {
        return "gallery";
    }


}