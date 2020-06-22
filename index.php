<?php
session_start();
// include __DIR__ . "/router.php";

// echo "<pre>";
// print_r($routeMap);
// print_r($_SERVER);

// if(isset($routeMap[$_SERVER['REQUEST_METHOD']][$_SERVER['REQUEST_URI']])){
//     echo "IT'S A MATCH!";
// }

// die;

// $_SESSION['basePath'] = __DIR__;

if(!isset($_SESSION['username'])){
    // echo 'NOT AUTHENTICATED MOTHERFUCKER! <br>';
    $myPath = explode("/", $_SERVER['REQUEST_URI']);
    // echo "<pre>";
    // print_r($myPath);
    // print_r($_SERVER);

    $_SESSION['targetPath'] = $_SERVER['REQUEST_URI'];

    include __DIR__ . "/Views/Auth/index.php";
    
    exit();
}

// phpinfo();
?>