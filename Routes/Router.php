<?php
/**
 *  Developed by: Gustavo Diniz da Corte
 *  Email: gustavodacorte@gmail.com
 */
// 

namespace Routes;
require_once __DIR__ . '/../vendor/autoload.php';

use Controllers\NotFoundController;

/**
 * Class that creates a routemap and defines which actions should be performed by each route.
 */
class Router{
    protected $routeMap;

    /**
     * Creates a route map. All routes that are used in the system should be mapped here.
     * The array should be separate for different routing methods and the array's key should be the route the user will see in its browser, 
     * where the value is another route in the fashion: /{Controller}/{Action}. This mapped route will pass the request parameters to the specified controller's action
     */
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

    /**
     * Check if routes exist. Shows the user a 404 page if route is not found and check if the current user/API request has enough access right to go to the route.
     * @param $route - The browser route that will be mapped into the controller/action
     * @param $method - The method used to access the route.
     * 
     * @return null
     */
    public function redirectToRoute($route, $method){
        if (!(isset($this->routeMap[$method][$route]))){ //Route not found
            $this->redirectToNotFound();
        }else{ //Proceed to Route if middleware allows it
            $this->checkController($route, $method);
        }   
    }


    /**
     *  Method that redirects the suer to the 404 not found view (controlled by the NotFound Controller. 
     * its page and controller action can be customized to best fit the dev needs.)
     */
    private function redirectToNotFound(){
        $controller = new NotFoundController();
        $controller->index();
        die;
    }


    /**
     *  Unwrap the controller, along with its action and a possible token (for API access)
     * @param $route - The browser route that will be mapped into the controller/action
     * @param $method - The method used to access the route.
     * 
     * @return $controller, $action, $token in a single object 
     */
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

    /**
     * After mapping the correct course of action to be taken, a new controller instance is created to check if the user has access
     * to the route (The check is made through the use of middlewares that can be easily customized by the user and are invoked when creating the controller instance).
     * If the user has access to the page, redirects him to the requested page. If not, redirects him to a page defined by the middleware.
     * 
     * @param $namedRoute - The custom user defined route
     * @param $method - The request method
     * 
     * @return null
     */
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