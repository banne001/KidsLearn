<?php

//This is my CONTROLLER page

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

//Require the auto autoload file
require_once('vendor/autoload.php');
require $_SERVER['DOCUMENT_ROOT'].'/../config.php';



//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('Debug',3);

$dataLayer = new DataLayer($dbh);
$validator = new Validation($dataLayer);
$controller = new Controller($f3);

//Define a default route (home page)
$f3->route('GET /', function(){

    global $controller;
    $controller->home();
});


//Shapes route
$f3->route('GET /shapes', function(){
    global $controller;
    $controller->shapes();
});
//fruits route
$f3->route('GET /animals', function(){
    global $controller;
    $controller->animals();
});
//fruits route
$f3->route('GET /fruits', function(){
    global $controller;
    $controller->fruits();
});
//create route
$f3->route('GET|POST /create', function($f3){
    global $controller;
    $controller->create();
});
//create1 route
$f3->route('GET|POST /createType', function($f3){
    global $controller;
    $controller->create1();

});
//create1 route
$f3->route('GET /createFinish', function($f3){
    global $controller;
    $controller->createFinish();
});
//sign in route
$f3->route('GET /signIn', function(){
    global $controller;
    $controller->signIn();

});
//sign up route
$f3->route('GET|POST /signUp', function($f3){
    global $controller;
    $controller->signUp();
});
//Run fat free
$f3->run();