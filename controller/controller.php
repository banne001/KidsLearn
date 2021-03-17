<?php

class Controller {

    private $_f3;
    private $_user;

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
        //var_dump($_SESSION['un']);
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
                    $creation = new Creations();
                    $creation->setImage($dest_path);
                    $_SESSION['creation']=$creation;
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
        //global $proUser;
        $creation = new Creations();
        //var_dump($_SESSION['un']);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //var_dump($_POST);
            $oname = $_POST['oname'];
            $desc = $_POST['desc'];
            $type = $_POST['type'];

            if($validator->validName($oname)){
                //$_SESSION['oname'] = $oname;
                $_SESSION['creation']->setName($oname);
            } else {
                $this->_f3->set('errors["oname"]', "Name cannot be blank and must contain only characters");
            }
            $_SESSION['creation']->setDesc($desc);
            //$creation->setDesc($desc);
            if(isset($type)){
                if($validator->validType($type)){
                    //$_SESSION['type'] = $type;
                    $_SESSION['creation']->setObject($type);
                } else {
                    $this->_f3->set('errors["type"]', "Stop Spoofing");
                }
            }
            //var_dump($_SESSION);
            if(empty($this->_f3->get('errors'))) {
                //$creation->setImage($_SESSION['pics']);
                $dataLayer->insertCreation($_SESSION['creation'], $_SESSION['un']);
                $this->_f3->reroute('/createFinish');
            }
        }

        $this->_f3->set("types", $dataLayer->getTypes());
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/create1.html');
    }

    function createFinish(){
        //global $order;
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/createFinish.html');
        unset($_SESSION['creation']);
        //$temp = $_SESSION['un'];
        //session_destroy();
        //$_SESSION['un'] = $temp;
        //var_dump($_SESSION);
    }

    function signIn(){
        global $dataLayer;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $result = $dataLayer->getUser($username, $password);
            //var_dump($result);
            //echo "THIS IS THE ID: " . $result[0]['user_id'] . "<br>";
            if($result){
                if($result[0]['isPro']){
                    $this->_user = new ProUser($result[0]['user_id'], $result[0]['username'], $result[0]['name'],"", $result[0]['age'], $result[0]['grade'], $result[0]['passwd'], true);
                    $this->_user->setSubject($result[0]['subject']);
                    $_SESSION['un'] = $this->_user;
                } else {
                    $this->_user = new User($result[0]['user_id'], $result[0]['username'], $result[0]['name'],"", $result[0]['age'], $result[0]['grade'], $result[0]['passwd'], false);
                    $_SESSION['un'] = $this->_user;
                }
                //var_dump($result);
                //print_r($this->_user);
                $this->_f3->reroute('account');  //GET
            } else {
                $this->_f3->set('errors["user"]', "Invalid password and username");
            }
        }
        $this->_f3->set('username', isset($username) ? $username: "");
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

            if(isset($_POST['premium'])){
                $user = new ProUser();
                $user->setIsPro(true);
            } else {
                $user = new User();
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
            //var_dump($user);
            //passed all cases
            if(empty($this->_f3->get('errors'))) {
                global $dataLayer;
                //global $user;

                if(isset($_POST['premium'])){
                    $_SESSION['userCreate'] = $user;
                    $this->_f3->reroute('signUpPro');  //GET
                } else {
                    $_SESSION['un'] = $user;
                    $dataLayer->insertUser($user);
                    $result = $dataLayer->getUser($user->getUsername(), $user->getPasswd());
                    $_SESSION['un'] = new User($result[0]['user_id'], $result[0]['username'], $result[0]['name'],"", $result[0]['age'], $result[0]['grade'], $result[0]['passwd'], false);
                    $this->_f3->reroute('account');  //GET
                }
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
    function signUpPro(){
        global $dataLayer;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $subject = $_POST['subject'];
            //TODO: validate maybe....
            if(!empty($subject)){
                $_SESSION['userCreate']->setSubject($subject);
            } else {
                $this->_f3->set('errors["subject"]', "Please enter a subject");
            }
            //var_dump($_SESSION);
            if(empty($this->_f3->get('errors'))) {
                $dataLayer->insertUser($_SESSION['userCreate']);
                //$_SESSION['un'] = $_SESSION['userCreate'];
                $result = $dataLayer->getUser($_SESSION['userCreate']->getUsername(), $_SESSION['userCreate']->getPasswd());
                $_SESSION['un'] = new ProUser($result[0]['user_id'], $result[0]['username'], $result[0]['name'],"", $result[0]['age'], $result[0]['grade'], $result[0]['passwd'], true, $result[0]['subject']);
                $this->_f3->reroute('account');
                unset($_SESSION['userCreate']);
            }
        }
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/signUpPro.html');
    }

    function account(){
        //var_dump($_SESSION['un']);
        $this->_f3->set('details', $_SESSION['un']);

        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/account.html');
    }

    function allCreations(){
        global $dataLayer;
        $this->_f3->set('creations', $dataLayer->getCreations($_SESSION['un']->getUserId()));
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/creations.html');
    }

    function logout()
    {
        session_destroy();
        $_SESSION = array();
        $this->_f3->reroute('/');
    }
}