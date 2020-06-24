<?php
namespace Controllers;

Class AuthController extends BaseController{
    function __construct($url, $method='GET', $token=''){
        $this->middleware('Guest', $url);
    }

    public function index($request){
        $this->renderView("Auth/index.php");
    }

    public function processLogin(){
        // Create new token for user
        if(!isset($_SESSION['token'])){
            $dateTime = new DateTime();
            $_SESSION['token'] = hash('sha256', $dateTime->getTimestamp());
        }
    }
}