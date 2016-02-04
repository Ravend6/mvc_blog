<?php
session_start();
require ('../vendor/autoload.php');
require('../config/routes.php');
use App\Controllers\PageController;
use Lib\Core\App;
use Lib\Core\Route;

$dotenv = new Dotenv\Dotenv(realpath('../'));
$dotenv->load();

$app = new App;
$app->run($route);


