<?php
/**
 *  Developed by: Gustavo Diniz da Corte
 *  Email: gustavodacorte@gmail.com
 */
// 

namespace Middlewares;
require_once __DIR__ . '/../vendor/autoload.php';

class GuestMiddleware{
    public static function handle($requestUrl){
        return $requestUrl;
    }
}