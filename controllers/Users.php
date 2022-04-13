<?php
require_once '../models/User.php';
require_once '../helpers/session_helper.php';

class Users {

    private $userModel;

    public function __construct() {
        $this->userModel = new User;
    }

    public function register() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // init data
        $data = [
            'userName' => trim($_POST['userName']),
            'userEmail' => trim($_POST['userEmail']),
            'userUid' => trim($_POST['userUid']),
            'userPwd' => trim($_POST['userPwd']),
            'pwdRepeat' => trim($_POST['pwdRepeat']),
        ];

        // validate input
        if (empty($data['userName']) || empty($data['userEmail']) || empty($data['userUid']) || empty($data['userPwd']) || empty($data['pwdRepeat']) ) {
            flash("register", "Please fill out all inputs");
            redirect("../signup.php");
        }

        if (!preg_match("/^[a-zA-Z0-9]*$/", $data['userUid'])) {
            flash("register", "Invalid username");
            redirect("../signup.php");
        }

        if (!filter_var($data['userEmail'], FILTER_VALIDATE_EMAIL)) {
            flash("register", "Invalid Email");
            redirect("../signup.php");
        }

        if (strlen($data['userPwd']) < 6) {
            flash("register", "Password must longer than 6 characters");
            redirect("../signup.php");
        } else if ($data['userPwd'] !== $data['pwdRepeat']) {
            flash("register", "Password dont match");
            redirect("../signup.php");
        }

        // check if user exist
        if ($this->userModel->findUserEmailOrUsername($data['userEmail'], $data['userName'])) {
            flash("register", "Username or email already taken");
            redirect("../signup.php");
        }

        // hash password
        $data['userPwd'] = password_hash($data['userPwd'], PASSWORD_DEFAULT);

        // regiseter user
        if ($this->userModel->register($data)) {
            redirect("../login.php");
        } else {
            die("Something went wrong");
        }
    }

    public function logout() {
        unset($_SESSION['userId']);
        unset($_SESSION['userName']);
        unset($_SESSION['userEmail']);
        session_destroy();
        redirect("../indexx.php");
    }

    public function login() {
        // sanitize post data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // init data
        $data=[
            'name/email' => trim($_POST['name/email']),

            'userPwd' => trim($_POST['userPwd'])
        ];

        if (empty($data['name/email']) || empty($data['userPwd'])) {
            flash("login", "Please fill out all inputs");
            header("location: ../indexx.php");
            exit();
        }

        // check user/email
        if ($this->userModel->findUserEmailOrUsername($data['name/email'], $data['name/email'])) {
            $loggedInUser = $this->userModel->login($data['name/email'], $data['userPwd']);
            if ($loggedInUser) {
                $this->createUserSession($loggedInUser);
            } else {
                flash("login", "Password Incorrect");
            redirect("../indexx.php");
            }
        } else {
            flash("login", "No User found");
            redirect("../indexx.php");
        }
    }

    public function createUserSession($user) {
        $_SESSION['userId'] = $user->userId;
        $_SESSION['userName'] = $user->userName;
        $_SESSION['userEmail'] = $user->userEmail;
        redirect("../index.php");
    }
}

$init = new Users;

// De chac rang user dang gui Post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "yes";
    switch($_POST['type']) {
        case 'register':
            $init->register();
            break;
        case 'login':
            $init->login();
            break;
        default:
        redirect("../indexx.php");
    } 
} else {
    switch($_GET['q']) {
        case 'logout':
            $init->logout();
            break;
        default:
            redirect("../indexx.php");
    }
}