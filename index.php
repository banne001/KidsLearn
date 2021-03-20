<?php

//This is my CONTROLLER page

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


//Require the auto autoload file
require_once('vendor/autoload.php');
require $_SERVER['DOCUMENT_ROOT'].'/../config.php';

session_start();


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
$f3->route('GET|POST /create', function(){
    global $controller;
    $controller->create();
});
//create1 route
$f3->route('GET|POST /createType', function(){
    global $controller;
    $controller->create1();

});
//create1 route
$f3->route('GET /createFinish', function(){
    global $controller;
    $controller->createFinish();
});
//sign in route
$f3->route('GET|POST /signIn', function(){
    global $controller;
    $controller->signIn();

});
//sign up route
$f3->route('GET|POST /signUp', function(){
    global $controller;
    $controller->signUp();
});

//sign up route
$f3->route('GET|POST /signUpPro', function(){
    global $controller;
    $controller->signUpPro();
});

//sign up route
$f3->route('GET /account', function(){
    global $controller;
    $controller->account();
});
//sign up route
$f3->route('GET /creations', function(){
    global $controller;
    $controller->allCreations();
});
$f3->route('GET /logout', function(){
    global $controller;
    $controller->logout();
});
$f3->route('GET|POST /forgot', function(){
    global $controller;
    $controller->forgot();
});
$f3->route('GET|POST /changePassword', function(){
    global $controller;
    $controller->changePassword();
});
$f3->route('GET /delete/@id', function($f3, $params){
    global $controller;
    $controller->deleteCreation($params['id']);
});
//Run fat free
$f3->run();