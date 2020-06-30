<?php
/**
 *  Developed by: Gustavo Diniz da Corte
 *  Email: gustavodacorte@gmail.com
 */
// 

namespace Controllers;

class NotFoundController extends BaseController{
    function __construct($url="", $method='GET', $token=''){
        $this->middleware('Guest', $url);
    }

    public function index(){
        $this->renderView("404/index.php");
    }
}