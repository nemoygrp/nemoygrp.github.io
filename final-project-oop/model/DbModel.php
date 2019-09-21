<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 15.03.2019
 * Time: 20:33
 */

namespace app\model;

use app\engine\Db;
use app\interfaces\IModel;

abstract class DbModel extends Model implements IModel
{
    /**
     * @var Db
     */
   /* protected $db;


    public function __construct()
    {
        $this->db = Db::getInstance();
    }*/

    public static function getOne($id) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql,['id'=>$id],static::class);
    }

    public static function getAll() {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public static function getWhere($whereString,$whereArray) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$whereString}";
        return Db::getInstance()->queryObject($sql,$whereArray,static::class);
    }

    public static function getAllWhere($whereString,$whereArray) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$whereString}";
        return Db::getInstance()->queryAll($sql,$whereArray,static::class);
    }

    public static function getCountWhere($whereString,$whereArray) {
        $tableName = static::getTableName();
        $sql = "SELECT count(*) as count FROM {$tableName} WHERE {$whereString}";
        return Db::getInstance()->queryOne($sql, $whereArray)['count'];
    }

    public static function getDBCart($whereString,$whereArray){
        $sql = "SELECT c.id_product, COUNT(c.`id_product`)`quantity`, pr.img `image`, pr.name `name`, pr.price `price` FROM `cart` c INNER JOIN `products` pr ON pr.id = c.`id_product` WHERE {$whereString} GROUP BY `id_product`";
        return Db::getInstance()->queryAll($sql,$whereArray,static::class);
    }
    public static function updateCart($id_orders,$whereString,$whereArray){
        $sql = "UPDATE `cart` SET `id_orders`= '{$id_orders}' WHERE {$whereString}";
        Db::getInstance()->execute($sql, $whereArray);
    }

    /**
     * Добавление элемента в БД
     */
    public function insert() {

        $params = [];
        $columns = [];

        foreach ($this as $key => $value) {
            if ($key == "id") continue;
            if ($key == "properties") continue;
            $params[":{$key}"] = $value;
            $columns[] = $key;
        }

        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));
        $tableName = static::getTableName();


        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";
        Db::getInstance()->execute($sql, $params);

        $this->id = Db::getInstance()->LastInsertId();
    }
    /**
     * Изменение элемента в БД
     */
    public function update() {
        $tableName = static::getTableName();
        $params = [];
        $columns = [];
        foreach ($this as $key => $value) {

            if ($key == "id" || $key == "properties") continue;

            if ($this->properties[$key] != true) continue;
            $params[":{$key}"] = $value;
            $columns["{$key}"] = $value;
        }
        $columns = implode(', ', array_map(
            function ($v, $k) { return sprintf("%s = '%s'", $k, $v); },
            $columns,
            array_keys($columns)
        ));

        $sql = "UPDATE `{$tableName}` SET  {$columns} WHERE id={$this->id}";

        Db::getInstance()->execute($sql, $params);
    }
    /**
     * Добавление элемента в БД
     */
    public function delete() {

        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql,['id'=>$this->id]);
    }

    /**
     * Общая функция, проверяющая нужно ли добавлять или изменять объект
     */
    public function save(){
        if(is_null($this->id)){
            $this->insert();}
        else {
            $this->update();}

    }

    abstract public static function getTableName();

}