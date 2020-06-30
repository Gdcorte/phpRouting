<?php
/**
 *  Developed by: Gustavo Diniz da Corte
 *  Email: gustavodacorte@gmail.com
 */
// 

namespace Controllers;

class CheckoutController extends BaseController{
    function __construct($url, $method='GET', $token=''){
        $this->middleware('Auth', $url);
    }

}