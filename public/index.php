<?php
// This is a generic purpose basic MVC framework built for personal uses
// Developed by: Gustavo Diniz da Corte
// Email: gustavodacorte@gmail.com
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

Use Routes\Router;

$router = new Router();

$_SESSION['basePath'] = str_replace('/public', '/', $_SERVER['DOCUMENT_ROOT']);
if($_SERVER['REQUEST_URI'] != '/login'){
    $_SESSION['targetUri'] = $_SERVER['REQUEST_URI'];
}else{
    $_SESSION['targetUri'] = "/";
}

$view = $router->redirectToRoute($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

?>