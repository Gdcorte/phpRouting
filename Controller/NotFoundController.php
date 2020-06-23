<?php
namespace Controllers;

class NotFoundController extends BaseController{
    function __construct($url=""){
        $this->middleware('Guest', $url);
    }

    public function index(){
        $this->renderView("404/index.php");
    }
}