<?php

require_once('apps/controllers/base_controller.php');
require_once('apps/models/user.php');
require_once('apps/models/token.php');

class AuthsController extends BaseController{
    function __construct(){
        $this->folder = 'auths';
    }

    public function index() {
        $this->render('index');
    } 

    public function signup() {
        $this->render('signup');
    }

    public function login() {
        if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
            if (($_SESSION['email'] == $_POST['email']) && ($_SESSION['password'] == $_POST['password'])) {
                unset($_SESSION['message']);
                $this->render('index');
            } else {
                if (isset($_POST['email']) && isset($_POST['password'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    if (User::userVerify($email, $password)) {
                        $token = md5($email.$password);
                        $user = User::findEmail($email);
                        Token::create($token, $user['id']);
                        // $d = date('Y-m-d H:i:s');
                        // $d = strtotime("+7 day");
                        // $date = date('Y-m-d H:i:s', $d);
                        setcookie('token', $token, time()+7*24*60*60, '/');
                        setcookie('email', $user->email, time()+7*24*60*60, '/');
                        setcookie('username', $user->username, time()+7*24*60*60, '/');
                        header('Location: index.php?controller=dashboards');
                    } else {
                        $_SESSION['message'] = 'Đăng Nhập Thất Bại!!!';
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['password'] = $_POST['password'];
                        $this->render('index');
                    }
                } 
            }
        } else {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                if (User::userVerify($email, $password)) {
                    $token = md5($email.$password);
                    $user = User::findEmail($email);
                    Token::create($token, $user->id);
                    // $d = date('Y-m-d H:i:s');
                    // $d = strtotime("+7 day");
                    // $date = date('Y-m-d H:i:s', $d);
                    setcookie('token', $token, time()+7*24*60*60, '/');
                    setcookie('email', $user->email, time()+7*24*60*60, '/');
                    setcookie('username', $user->username, time()+7*24*60*60, '/');
                    header('Location: index.php?controller=dashboards');
                } else {
                    $_SESSION['message'] = 'Đăng Nhập Thất Bại!!!';
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['password'] = $_POST['password'];
                    $this->render('index');
                }
            } 
        }
    }

    public function create() {

    }

    public function store() {

    }

    public function destroy() {
        $tokens = Token::findToken($_COOKIE['token']);
        Token::destroy($tokens->id);
        setcookie('token', '', -1, '/'); 
        setcookie('email', '', -1, '/'); 
        setcookie('username', '', -1, '/'); 
        header('Location: index.php?controller=auths');
    }
    public function error(){
        $this->render('error');
    }
}
