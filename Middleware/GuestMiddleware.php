<?php

class GuestMiddleware{
    public static function handle($requestUrl){
        return $requestUrl;
    }
}