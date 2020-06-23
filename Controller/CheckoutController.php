<?php
namespace Controllers;

class CheckoutController extends BaseController{
    function __construct($url){
        $this->middleware('Auth', $url);
    }

}