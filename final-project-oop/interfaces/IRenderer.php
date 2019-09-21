<?php
/**
 * Created by PhpStorm.
 * User: NEMOY
 * Date: 20.03.2019
 * Time: 15:00
 */

namespace app\interfaces;


interface IRenderer
{
    public function renderTemplate($template, $params = []);
}