<?php
// This is a generic purpose basic MVC framework built for personal uses/studies
/**

 *  Developed by: Gustavo Diniz da Corte
 *  Email: gustavodacorte@gmail.com
 */
// 

session_start();
/**
 * The webserver should point to this public folder as the document_root of the host. 
 * All incoming requests are caught by the  .htaccess file and directed here. Here the router will map the route to the appropriate controller/action
 */
require_once __DIR__ . '/../vendor/autoload.php';

Use Routes\Router;

$router = new Router();

$_SESSION['basePath'] = str_replace('/public', '/', $_SERVER['DOCUMENT_ROOT']);

$view = $router->redirectToRoute($_SERVER['REDIRECT_URL'], $_SERVER['REQUEST_METHOD']);

?>