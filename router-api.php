<?php
require_once 'Models/config.php';
require_once 'Models/UsersModel.php';
require_once 'libs/Router.php';
require_once 'Controller/ApiController.php';
require_once 'Controller/AuthController.php';


// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('libros', 'GET', 'ApiController', 'getLibros');
$router->addRoute('libros', 'POST', 'ApiController', 'AddLibro');
$router->addRoute('libros/:ID', 'GET', 'ApiController', 'getLibro');
$router->addRoute('libros/:ID','PUT','ApiController','EditLibro');
$router->addRoute('libros/:ID','DELETE','ApiController','DeleteLibro');
$router->addRoute("auth/token", 'GET', 'AuthController', 'getToken');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);