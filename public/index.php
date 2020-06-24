<?php
// This is a generic purpose basic MVC framework built for personal uses
// Developed by: Gustavo Diniz da Corte
// Email: gustavodacorte@gmail.com
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

Use Routes\Router;

$router = new Router();

$_SESSION['basePath'] = str_replace('/public', '/', $_SERVER['DOCUMENT_ROOT']);

$view = $router->redirectToRoute($_SERVER['REDIRECT_URL'], $_SERVER['REQUEST_METHOD']);

?>