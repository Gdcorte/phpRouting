<?php
/**
 *  Developed by: Gustavo Diniz da Corte
 *  Email: gustavodacorte@gmail.com
 */
// 

namespace Middlewares;
require_once __DIR__ . '/../vendor/autoload.php';

class AuthMiddleware{
    public static function handle($requestUrl){
        if (!isset($_SESSION['USER_ID'])){
            return "/login";
        }else{
            return $requestUrl;
        }
    }
}