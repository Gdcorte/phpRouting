<?php
namespace Controllers;

class CheckoutController extends BaseController{
    function __construct($url, $method='GET', $token=''){
        $this->middleware('Auth', $url);
    }

}