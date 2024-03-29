<?php
/**
 * Blezyl Santos and Sarah Mehri
 * Kids Learn Website - controller.php
 * Version 1.0
 * controller class for controlling the routes in f3
 **/

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

    /**
     * home route for user information
     */
    function home(){
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/home.html');
    }

    /**
     * shape route for user information
     */
    function shapes(){
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/shapes.html');
    }

    /**
     * animals route for user information
     */
    function animals(){
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/animals.html');
    }

    /**
     * fruits route for user information
     */
    function fruits(){
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/fruits.html');
    }

    /**
     * create route for user creation
     */
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

    /**
     * create1 route for user's creation
     */
    function create1(){
        global $dataLayer;
        global $validator;
        $creation = new Creations();
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
            } else {
                $this->_f3->set('errors["type"]', "Required");
            }
            //var_dump($_SESSION);
            if(empty($this->_f3->get('errors'))) {
                //$creation->setImage($_SESSION['pics']);
                $dataLayer->insertCreation($_SESSION['creation'], $_SESSION['un']);
                $this->_f3->reroute('/createFinish');
            }
        }
        $this->_f3->set('oname', isset($oname) ? $oname: "");
        $this->_f3->set('typePicked', isset($type) ? $type: "");


        $this->_f3->set("types", $dataLayer->getTypes());
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/create1.html');
    }

    /**
     * createFinish route for pro user summary of creation
     */
    function createFinish(){
        //global $order;
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/createFinish.html');
        unset($_SESSION['creation']);
        //var_dump($_SESSION);
    }

    /**
     * singIn route for user to sign in
     */
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
                    $this->_user = new ProUser($result[0]['username'], $result[0]['name'],"", $result[0]['age'], $result[0]['grade'], $result[0]['passwd'], true);
                    $this->_user->setSubject($result[0]['subject']);
                    $_SESSION['un'] = $this->_user;
                } else {
                    $this->_user = new User($result[0]['username'], $result[0]['name'],"", $result[0]['age'], $result[0]['grade'], $result[0]['passwd'], false);
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

    /**
     * signup route for user information
     */
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

           global $dataLayer;
            /**
            if($validator->validName($username) && !$dataLayer->userExists($username))
            {
                $user->setUsername($username);
            } else {
                $this->_f3->set('errors["user"]', "Username cannot be blank and must contain only characters, username
                already exists");
            }
            **/
            if(!$validator->validUsername($username)){
                $this->_f3->set('errors["user"]', "Username cannot be blank and no spaces");
            }
            else if($dataLayer->userExists($username)){
                $this->_f3->set('errors["user"]', "Username already exist!");
            }
            else{
                $user->setUsername($username);
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
                if($password == $cpassword){
                    $user->setPasswd($password);
                } else {
                    $this->_f3->set('errors["cpassword"]', "Not the same to password");
                }
            } else {
                $this->_f3->set('errors["password"]', "Password needs at least 8 characters");
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

    /**
     * signUpPro route for Pro user
     */
    function signUpPro(){
        global $dataLayer;
        global $validator;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $subject = $_POST['subject'];
            if(!empty($subject) && $validator->validSubject($subject)){
                $_SESSION['userCreate']->setSubject($subject);
            } else {
                $this->_f3->set('errors["subject"]', "Please enter a subject that is listed below: " . implode(", ", $dataLayer->getSubjects()));
            }
            //var_dump($_SESSION);
            if(empty($this->_f3->get('errors'))) {
                $dataLayer->insertUser($_SESSION['userCreate']);
                $_SESSION['un'] = $_SESSION['userCreate'];
                $this->_f3->reroute('account');
                unset($_SESSION['userCreate']);
            }
        }
        //creating a new view using the Template constructor
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/signUpPro.html');
    }

    /**
     * account route for user information
     */
    function account(){
        //var_dump($_SESSION['un']);
        $this->_f3->set('details', $_SESSION['un']);

        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/account.html');
    }

    /**
     * allCreation route for user information
     */
    function allCreations(){
        global $dataLayer;
        //var_dump($_SESSION['un']);

        $this->_f3->set('creations', $dataLayer->getCreations($_SESSION['un']->getUsername()));
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/creations.html');
    }

    /**
     * logout route for user to sign out
     */
    function logout()
    {
        session_destroy();
        $_SESSION = array();
        $this->_f3->reroute('/');
    }

    /**
     * forgot route for user forgetting password
     */
    function forgot(){
        global $dataLayer;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = trim($_POST['username']);
            if($dataLayer->userExists($username)){
                $dataLayer->resetPassword($username);
                $this->_f3->set('success', "Your password is 'Password'");
                //$this->_f3->reroute('account');  //GET
            } else {
                $this->_f3->set('errors', "Username does not exist");
            }
        }
        $this->_f3->set('username', isset($username) ? $username: "");
        $view = new Template();
        //echo the view and invoke its render method and supply the path
        echo $view->render('views/forgot.html');
    }

    /**
     * changePassword route for user to change pass
     */
    function changePassword(){
        global $dataLayer;
        global $validator;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $password = $_POST['pw'];
            $cpassword = $_POST['cpw'];
            if($validator->validPassword($password)){
                if($password == $cpassword){
                    $_SESSION['un']->setPasswd($password);
                    $dataLayer->setPassword($_SESSION['un']->getUsername(), $password);
                    $this->_f3->set('success', "Success!!");
                } else {
                    $this->_f3->set('errors', "Not the same password");
                }
            } else {
                $this->_f3->set('errors', "Password needs at least 8 characters");
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
        echo $view->render('views/changePassword.html');
    }

    /**
     * deletionCreation route for user to delete the creation
     */
    function deleteCreation($id){
        global $dataLayer;
        $dataLayer->deleteCreation($id);
        $this->_f3->reroute('creations');
    }

}