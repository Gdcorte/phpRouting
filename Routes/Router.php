<?php
namespace Routes;
require_once __DIR__ . '/../vendor/autoload.php';

use Controllers\NotFoundController;

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
        if (!(isset($this->routeMap[$method][$route]))){ //Route not found
            $this->redirectToNotFound();
        }else{ //Proceed to Route if middleware allows it
            $this->checkController($route, $method);
        }   
    }

    private function redirectToNotFound(){
        $controller = new NotFoundController();
        $controller->index();
        die;
    }

    private function createController($route, $method){
        $urlParams = explode("/",$this->routeMap[$method][$route]);
        $controller = 'Controllers\\' . $urlParams[1] . "Controller";
        $action = $urlParams[2];

        $routeType = explode('/',$route)[1];

        //Require a token for all routes that starts with api, ajax or have its method set to post
        if( ($routeType=='api')||($routeType=='ajax')||($method=='POST') ){
            if(!isset($_REQUEST['token'])){
                $this->redirectToNotFound();
            }else{
                $token = $_REQUEST['token'];
            }
        }else{ //Don't require token for get routes that are not called through an API
            $token = "";
        }

        return [
            'Controller'=>$controller,
            'Action'=>$action,
            'token'=>$token,
        ];
    }

    private function checkController($namedRoute, $method){
        $Obj = $this->createController($namedRoute, $method);
        $controller = $Obj['Controller'];

        $myController = new $controller($namedRoute, $method, $Obj['token']);
        $result = $myController->checkAccess();

        // Get Request parameters
        if ($method == 'POST'){
            $request = $_POST;
        }else{
            $request = $_GET;
        }

        // Determines if user can be redirected or if he is not allowed to do such
        if($result == $namedRoute){
            // Executes action
            $action = $Obj['Action'];
            $myController->$action($request);
        }else{
            $_SESSION['targetUri'] = $_SERVER['REQUEST_URI']; //Saves where user was trying to go before
            header('Location: '. $_SERVER['REQUEST_SCHEME'] . '://'. $_SERVER['SERVER_NAME'] . $result);  // Redirects to where user should go
        }
    }

}