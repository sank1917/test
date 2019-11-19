<?php
session_start();
define('ROOT', '/var/www/html/');
define('CONTROLLER_FOLDER', ROOT . '/controller/');
define('MODELS_FOLDER', ROOT . '/models/');
define('VIEWS_FOLDER', ROOT . '/views/');

require_once("db.php");
require_once("route.php");
require_once MODELS_FOLDER. 'Model.php';
require_once VIEWS_FOLDER. 'View.php';
require_once CONTROLLER_FOLDER. 'Controller.php';

Routings::buildRoute();
?>