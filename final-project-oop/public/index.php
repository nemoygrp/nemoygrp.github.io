<?php
session_start();
include "../engine/Autoload.php";
include "../config/config.php";
use app\model\Products;
use app\engine\Autoload;
use app\engine\Render;
use app\engine\Request;
use app\model\Users;
use app\model\Cart;
use app\model\Feedback;
use app\model\Orders;
spl_autoload_register([new Autoload(), 'loadClass']);

//try {

//var_dump($_SESSION['user']);
$request = new Request();

$controllerName = $request->getControllerName()?: 'index';
$actionName = $request->getActionName();
$id_elem = $request->getId_elem();

$controllerClass = "app\\controllers\\" . ucfirst($controllerName) . "Controller";


if (class_exists($controllerClass)){
    $controller = new $controllerClass(new Render());
    $controller->runAction($actionName,$id_elem);
}

/*}catch (\PDOException $e) {
        echo "Ошибка PDO!";

        echo $e->getMessage();
        var_dump($e->getTrace());
    }
catch (\Exception $e) {
        echo $e->getMessage();
        var_dump($e->getTrace());
         var_dump($e);
    }

/*$product1 = Feedback::getAll();;
var_dump($product1);*/
