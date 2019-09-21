<?php

namespace app\model;


class Feedback extends DbModel
{
    public $properties = [
        'id' => false,
        'name' => false,
        'feedback' => false,
        'id_parent' => false,
        'from_table' => false,
    ];

    function __construct()
    {
        $values = $this->properties;
        foreach ($values as $key => $value){
            $this->$key = null;
        }

    }
    public static function getComments($id_parent,$from_table){

        return Feedback::getAllWhere(
            'id_parent = :id_parent AND from_table = :from_table ORDER BY id DESC',
            [':id_parent' => $id_parent,':from_table' => $from_table]
        );

    }
    public function setItem($feedback,$name,$id_parent,$from_table)
    {
        $this->setName($name);
        $this->setFeedback($feedback);
        $this->setId_parent($id_parent);
        $this->setFrom_table($from_table);
    }
    public function setName($name)
    {
        $this->properties['name'] = true;
        $this->name = $name;
    }
    public function setFeedback($feedback)
    {
        $this->properties['feedback'] = true;
        $this->feedback = $feedback;
    }
    public function setId_parent($id_parent)
    {
        $this->properties['id_parent'] = true;
        $this->id_parent = $id_parent;
    }
    public function setFrom_table($from_table)
    {
        $this->properties['from_table'] = true;
        $this->from_table = $from_table;
    }

    public static function getTableName()
    {
        return "feedback";
    }

}