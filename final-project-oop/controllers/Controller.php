<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 15.03.2019
 * Time: 21:16
 */

namespace app\controllers;

use app\engine\Render;
use app\engine\Request;
use app\interfaces\IRenderer;
use app\model\Cart;
use app\model\Users;

class Controller implements IRenderer
{

    private $action;
    private $id;
    private $defaultAction = "index";
    private $layout = 'main';
    private $useLayout = true;
    private $renderer;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function runAction($action = null,$id = null){
        $this->id = $id;
        $this->action = $action?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)){
            $this->$method($this->id);
        } else {
            echo "Не существует";
        }
    }





    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}",[
                'content'=> $this->renderTemplate($template, $params),
                'menu' => $this->renderTemplate('menu', [
                    'auth' => Users::is_auth(),
                    'userName' => Users::getName(),
                    'access' => Users::getAccess(),
                    'allow' => Users::get_allow(),
                    'cartCount' => Cart::getCartCount(),
                    'cart' => Cart::getCart(0),
                ]),
                'footer' => $this->renderTemplate('footer', $params),
                'title' => SITE_TITLE,
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->renderTemplate($template, $params);
    }

}