<?php
namespace Routes;
require_once __DIR__ . '/../vendor/autoload.php';

class Router{
    protected $routeMap;

    function __construct(){
        $getRoutes = [
            "/login" => '/Auth/index',
            "/Checkout" => '/Checkout/index',
        ];
        
        $postRoutes = [
            "/login" => '/Auth/processLogins',
        ];

        $this->routeMap = [
            'GET' => $getRoutes,
            'POST' => $postRoutes,   
        ];
    }

    public function redirectToRoute($route, $method){
        if (!(isset($this->routeMap[$method][$route]))){
            // ROUTE NOT FOUND, 404!
            echo "SORRY, NOT FOUND!";
        }else{
            $this->checkController($route, $method);
        }   
    }

    private function createController($route, $method){
        $urlParams = explode("/",$this->routeMap[$method][$route]);
        $controller = 'Controllers\\' . $urlParams[1] . "Controller";
        $action = $urlParams[2];

        return [
            'Controller'=>$controller,
            'Action'=>$action,
        ];
    }

    private function checkController($namedRoute, $method){
        $Obj = $this->createController($namedRoute, $method);
        $controller = $Obj['Controller'];

        $myController = new $controller($namedRoute, $method);
        $result = $myController->checkAccess();

        // Get Request parameters
        if ($method == 'POST'){
            $request = $_POST;
        }else{
            $request = $_GET;
        }

        // Determines if user can be redirected or if he is not allowed to do such
        if($result == $namedRoute){
            $action = $Obj['Action'];
            $myController->$action($request);
        }else{
            // Redirects to where user should go
            header('Location: '. $_SERVER['REQUEST_SCHEME'] . '://'. $_SERVER['SERVER_NAME'] . $result);
        }
    }

}