<?php

//This is my CONTROLLER page

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

//Require the auto autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/validation.php');

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


//Shapes route
$f3->route('GET /shapes', function(){
    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/shapes.html');
});
//fruits route
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
//create route
$f3->route('GET|POST /create', function($f3){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!empty($_FILES['fileToUpload']['name'])) {
            $fileName = $_FILES['fileToUpload']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            if (validExtension($fileExtension) == true) {
                //File Details
                //$fileSize = $_FILES['fileToUpload']['size'];
                //$fileType = $_FILES['fileToUpload']['type'];
                $fileTmpPath = $_FILES['fileToUpload']['tmp_name'];

                //sanitize file name
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = 'images/';
                $dest_path = $uploadFileDir . $newFileName;
                $_SESSION['pics']=$dest_path;
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    echo 'File is successfully uploaded.';
                } else {
                    echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                }
                //var_dump($_SESSION);
            } else {
                $f3->set('errors["pics"]', "Invalid file type");
            }
        } else {
            $f3->set('errors["pics"]', "Required");
        }
        if(empty($f3->get('errors'))) {
            $f3->reroute('/createType');
        }
    }



    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/create.html');
});
//create1 route
$f3->route('GET|POST /createType', function($f3){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //var_dump($_POST);
        $oname = $_POST['oname'];
        $desc = $_POST['desc'];
        $type = $_POST['type'];

        if(validName($oname)){
            $_SESSION['oname'] = $oname;
        } else {
            $f3->set('errors["oname"]', "Name cannot be blank and must contain only characters");
        }
        $_SESSION['desc'] = $desc;
        if(isset($type)){
            if(validType($type)){
                //$_SESSION['seek'] = $_POST['seek'];
                $_SESSION['type'] = $type;
            } else {
                $f3->set('errors["type"]', "Stop Spoofing");
            }
        }
        //var_dump($_SESSION);
        if(empty($f3->get('errors'))) {
            $f3->reroute('/createFinish');
        }
    }
    $f3->set("types", getTypes());


    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/create1.html');
});
//create1 route
$f3->route('GET /createFinish', function($f3){


    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/createFinish.html');
});
//sign in route
$f3->route('GET /signIn', function(){

    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/signIn.html');
});
//sign up route
$f3->route('GET|POST /signUp', function($f3){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = trim($_POST['username']);
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $age = $_POST['age'];
        $grade = $_POST['grade'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if(validName($username)){
            $_SESSION['username'] = $username;
        } else {
            $f3->set('errors["username"]', "Username cannot be blank and must contain only characters");
        }
        if(validName($fname)){
            $_SESSION['fname'] = $fname;
        } else {
            $f3->set('errors["fname"]', "First name cannot be blank and must contain only characters");
        }

        if(validName($lname)){
            $_SESSION['lname'] = $lname;
        } else {
            $f3->set('errors["lname"]', "Last name cannot be blank and must contain only characters");
        }

        if(validAge($age)){
            $_SESSION['age'] = $age;
        } else {
            $f3->set('errors["age"]', "Age needs to be numeric and between 18 and 118");
        }

        if(isset($grade)){
            if(validGrade($grade)){
                $_SESSION['grade'] = $grade;
            } else {
                $f3->set('errors["grade"]', "Grade needs to be numeric and under 12");
            }
        }
        if(validPassword($password)){
            $_SESSION['password'] = $password;
        } else {
            $f3->set('errors["password"]', "Password needs ...");
        }

        if($password == $cpassword){
            $_SESSION['password'] = $password;
        } else {
            $f3->set('errors["cpassword"]', "Not the same to password");
        }
        //passed all cases
        if(empty($f3->get('errors'))) {
            $f3->reroute('/');  //GET
        }
    }
    $f3->set('username', isset($username) ? $username: "");
    $f3->set('fname', isset($fname) ? $fname: "");
    $f3->set('lname', isset($lname) ? $lname: "");
    $f3->set('age', isset($age) ? $age: "");
    $f3->set('gender', isset($grade) ? $grade: "");

    //creating a new view using the Template constructor
    $view = new Template();
    //echo the view and invoke its render method and supply the path
    echo $view->render('views/signUp.html');
});
//Run fat free
$f3->run();