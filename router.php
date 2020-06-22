<?php

$getRoutes = [
    "/login" => [
        'Controller'=>'Auth',
        'Action'=>'index',
    ]
];

$postRoutes = [
    "/login" => [
        'Controller'=>'Auth',
        'Action'=>'processLogin',
    ]
];

$routeMap = [
    'GET' => $getRoutes,
    'POST' => $postRoutes,   
];