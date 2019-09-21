<?php
define('SITE_TITLE', "Антикварная лавка Деда Игната");

define("TEMPLATES_DIR", "../templates/");
define("ENGINE_DIR", "../engine/");
define("LAYOUTS_DIR", "/layouts/");

/* DB config */
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'shopDedIgnat');

include_once ENGINE_DIR . 'lib_autoload.php';
//include_once ENGINE_DIR . 'log.php';