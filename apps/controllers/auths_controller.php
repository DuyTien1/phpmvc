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
                        setcookie('token', $token, time()+7*24*64*64, '/');
                        setcookie('email', $user['email'], time()+7*24*64*64, '/');
                        setcookie('username', $user['username'], time()+7*24*64*64, '/');
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
                    setcookie('token', $token, time()+7*24*64*64, '/');
                    setcookie('email', $user['email'], time()+7*24*64*64, '/');
                    setcookie('username', $user['username'], time()+7*24*64*64, '/');
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
        unset($_COOKIE['token']);
        unset($_COOKIE['email']);
        unset($_COOKIE['username']);
        header('Location: index.php?controller=auths');
    }
    public function error(){
        $this->render('error');
    }
}
