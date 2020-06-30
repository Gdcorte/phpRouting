<?php
/**
 *  Developed by: Gustavo Diniz da Corte
 *  Email: gustavodacorte@gmail.com
 */
// 

namespace Controllers;
require_once __DIR__ . '/../vendor/autoload.php';

class BaseController{
    protected $middleware;

    public function middleware($middlewareName, $url){
        $middlewareFull = "\Middlewares\\" . $middlewareName . 'Middleware';
        $this->middleware = $middlewareFull::handle($url);
    }

    public function checkAccess(){
        return $this->middleware;
    }

    public function redirect($location){
        // header('Location: '. $_SERVER['REQUEST_SCHEME'] . '://'. $_SERVER['SERVER_NAME'] .'/' . $location);
    }

    public function renderView($viewPath, array $args = []){
        ob_start();
        include($_SESSION['basePath'] . "Views/". $viewPath);
        $renderedView = ob_get_contents(); 
        ob_end_clean();

        echo $renderedView;
    }

}