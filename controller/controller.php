<?php

class Controller {

    private $_f3;

    /**
     * Controller constructor.
     * @param $_f3
     */
    public function __construct($_f3)
    {
        $this->_f3 = $_f3;
    }

    function home(){


        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/home.html');

    }

    function shapes(){
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/shapes.html');
    }

    function animals(){
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/animals.html');
    }

    function fruits(){
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/fruits.html');
    }

    function create(){
        global $validator;
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(!empty($_FILES['fileToUpload']['name'])) {
                $fileName = $_FILES['fileToUpload']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                if ($validator->validExtension($fileExtension) == true) {
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
                    $this->_f3->set('errors["pics"]', "Invalid file type");
                }
            } else {
                $this->_f3->set('errors["pics"]', "Required");
            }
            if(empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('/createType');
            }
        }



        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/create.html');
    }

    function create1(){
        global $dataLayer;
        global $validator;
        //global $proUser;

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //var_dump($_POST);
            $oname = $_POST['oname'];
            $desc = $_POST['desc'];
            $type = $_POST['type'];
            $proUser = new proUser();


            if($validator->validName($oname)){

                $proUser->setName($oname);
            } else {
                $this->_f3->set('errors["oname"]', "Name cannot be blank and must contain only characters");
            }

            $proUser->setDesc($desc);
            if(isset($type)){
                if($validator->validType($type)){
                    //$_SESSION['seek'] = $_POST['seek'];

                    $proUser->setObject($type);
                } else {
                    $this->_f3->set('errors["type"]', "Stop Spoofing");
                }
            }
            //var_dump($_SESSION);
            if(empty($this->_f3->get('errors'))) {


                $this->_f3->reroute('/createFinish');
               // $dataLayer->insertProUser($proUser);

            }
        }

        $this->_f3->set("types", $dataLayer->getTypes());
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/create1.html');

    }

    function createFinish(){

        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/createFinish.html');
    }

    function signIn(){
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/signIn.html');
    }

    function signUp(){
        global $validator;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = trim($_POST['username']);
            $fname = trim($_POST['fname']);
            $lname = trim($_POST['lname']);
            $age = $_POST['age'];
            $grade = $_POST['grade'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $user = new User();
            if(isset($_POST['premium'])){
                $user->setIsPro(true);
            }
            if($validator->validName($username)){
                $user->setUsername($username);
            } else {
                $this->_f3->set('errors["user"]', "Username cannot be blank and must contain only characters");
            }

            if($validator->validName($fname)){
                $user->setFname($fname);
                //$_SESSION['fname'] = $fname;
            } else {
                $this->_f3->set('errors["fname"]', "First name cannot be blank and must contain only characters");
            }

            if($validator->validName($lname)){
                $user->setLname($lname);
                //$_SESSION['lname'] = $lname;
            } else {
                $this->_f3->set('errors["lname"]', "Last name cannot be blank and must contain only characters");
            }


            if($validator->validAge($age)){
                $user->setAge($age);
                //$_SESSION['age'] = $age;
            } else {
                $this->_f3->set('errors["age"]', "Age needs to be numeric and between 18 and 118");
            }

            if(isset($grade)){
                if($validator->validGrade($grade)){
                    $user->setGrade($grade);
                    //$_SESSION['grade'] = $grade;
                } else {
                    $this->_f3->set('errors["grade"]', "Grade needs to be numeric and under 12");
                }
            }
            if($validator->validPassword($password)){
                //$_SESSION['password'] = $password;
            } else {
                $this->_f3->set('errors["password"]', "Password needs ...");
            }

            if($password == $cpassword){
                $user->setPasswd($password);
            } else {
                $this->_f3->set('errors["cpassword"]', "Not the same to password");
            }
            //passed all cases
            if(empty($this->_f3->get('errors'))) {
                global $dataLayer;
                $dataLayer->insertUser($user);

                $this->_f3->reroute('/');  //GET

            }
        }
        $this->_f3->set('username', isset($username) ? $username: "");
        $this->_f3->set('fname', isset($fname) ? $fname: "");
        $this->_f3->set('lname', isset($lname) ? $lname: "");
        $this->_f3->set('age', isset($age) ? $age: "");
        $this->_f3->set('grade', isset($grade) ? $grade: "");

        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/signUp.html');

    }
}