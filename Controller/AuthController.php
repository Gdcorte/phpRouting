<?php
namespace Controllers;

Class AuthController extends BaseController{
    function __construct($url){
        $this->middleware('Guest', $url);
    }

    public function index($request){
        $view = $this->renderView("Auth/index.php");

        echo $view;
    }
}