<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 13.03.2019
 * Time: 19:30
 */

namespace app\traits;


trait Tsingletone
{
    private static $instanse = null;

    public static function getInstance(){
        if(is_null(static::$instanse)){
            static::$instanse = new static();
        }
        return static::$instanse;
    }

    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}
}