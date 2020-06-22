<?php

class AuthMiddleware{

    public static function handle($requestUrl){
        session_start();
        if (!isset($_SESSION['USER_ID'])){
            return "/login";
        }else{
            return $requestUrl;
        }
    }
}