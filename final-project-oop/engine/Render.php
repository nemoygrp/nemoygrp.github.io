<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 20.03.2019
 * Time: 14:57
 */

namespace app\engine;

use app\interfaces\IRenderer;


class Render implements IRenderer
{
    public function renderTemplate($template, $params = [])
    {
        ob_start();
        extract($params);

        $templatePath = TEMPLATE_DIR . $template . ".php";

        include $templatePath;
        return ob_get_clean();
    }
}