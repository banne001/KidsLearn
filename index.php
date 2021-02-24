<?php

//This is my CONTROLLER page

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the auto autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('Debug',3);

//Define a default route (home page)
$f3->route('GET /', function(){
    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/home.html');
});

//learn route
$f3->route('GET /learn', function(){
    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/learn.html');
});

//Shapes route
$f3->route('GET /shapes', function(){
    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/shapes.html');
});

//numbers route
$f3->route('GET /numbers', function(){
    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/numbers.html');
});
//alphabet route
$f3->route('GET /alphabet', function(){
    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/alphabet.html');
});
//animals route
$f3->route('GET /animals', function(){
    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/animals.html');
});
//fruits route
$f3->route('GET /fruits', function(){
    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/fruits.html');
});
//sign in route
$f3->route('GET /signIn', function(){
    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/signIn.html');
});
//sign up route
$f3->route('GET /signUp', function(){
    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/signUp.html');
});
//Run fat free
$f3->run();