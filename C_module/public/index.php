<?php
session_start();

define('__DS', '/');
define("__ROOT", dirname(__DIR__));
define("SRC", __ROOT . "/src");
define("VIEW", SRC . "/View");
define('__UPLOAD', __DIR__ . __DS . 'uploads');

include_once __ROOT . "/autoloader.php";
include_once __ROOT . "/helper.php";
include_once __ROOT . "/web.php";