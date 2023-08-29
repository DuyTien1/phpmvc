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
                    if (User::userVerify($_POST['email'], $_POST['password'])) {
                        $token = md5($_POST['password'].$_POST['password']);
                        $user = User::findEmail($_POST['email']);
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
        } else {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                if (User::userVerify($_POST['email'], $_POST['password'])) {
                    $token = md5($_POST['email'].$_POST['password']);
                    $user = User::findEmail($_POST['email']);
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
        if (isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['username']) && isset($_SESSION['address']) && isset($_SESSION['phone'])) {
            if ($_SESSION['email'] == $_POST['email'] && $_SESSION['username'] == $_POST['username'] && $_SESSION['address'] == $_POST['address'] && $_SESSION['password'] == $_POST['password'] && $_SESSION['phone'] == $_POST['phone']) {
            unset($_SESSION['message']);
            $this->folder = 'auths';
            $this->render('signup');
            } else {
            if ($_POST['password'] != $_POST['password_confirmation']) {
                $_SESSION['message'] = 'Mật Khẩu Chưa Chính Xác!!!';
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['address'] = $_POST['address'];
                $_SESSION['phone'] = $_POST['phone'];
                $this->folder = 'auths';
                $this->render('signup');
                } else if (User::emailVerify($_POST['email'])) {
                    $_SESSION['message'] = 'Email Đã Tồn Tại!!!';
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['password'] = $_POST['password'];
                    $_SESSION['address'] = $_POST['address'];
                    $_SESSION['phone'] = $_POST['phone'];
                    $this->folder = 'auths';
                    $this->render('signup');
                } else if (User::phoneVerify($_POST['phone'])) {
                    $_SESSION['message'] = 'Số Điện Thoại Đã Tồn Tại!!!';
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['password'] = $_POST['password'];
                    $_SESSION['address'] = $_POST['address'];
                    $_SESSION['phone'] = $_POST['phone'];
                    $this->folder = 'auths';
                    $this->render('signup');
                    } else {
                        $role_id = 1;
                        User::create($_POST['username'], $_POST['email'], $_POST['password'], $_POST['address'], $_POST['phone'], $role_id);
                        $this->folder = 'auths';
                        $_SESSION['success'] = 'Tạo Tài Khoản Mới Thành Công!!!';
                        $this->render('index');
            }
        }
        } else {
            if ($_POST['password'] != $_POST['password_confirmation']) {
            $_SESSION['message'] = 'Mật Khẩu Chưa Chính Xác!!!';
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['address'] = $_POST['address'];
            $_SESSION['phone'] = $_POST['phone'];
            $this->folder = 'auths';
            $this->render('signup');
            } else if (User::emailVerify($_POST['email'])) {
                $_SESSION['message'] = 'Email Đã Tồn Tại!!!';
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['address'] = $_POST['address'];
                $_SESSION['phone'] = $_POST['phone'];
                $this->folder = 'auths';
                $this->render('signup');
                } else if (User::phoneVerify($_POST['phone'])) {
                    $_SESSION['message'] = 'Số Điện Thoại Đã Tồn Tại!!!';
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['password'] = $_POST['password'];
                    $_SESSION['address'] = $_POST['address'];
                    $_SESSION['phone'] = $_POST['phone'];
                    $this->folder = 'auths';
                    $this->render('signup');
                } else {
                    $role_id = 1;
                    User::create($_POST['username'], $_POST['email'], $_POST['password'], $_POST['address'], $_POST['phone'], $role_id);
                    $this->folder = 'auths';
                    $_SESSION['success'] = 'Tạo Tài Khoản Mới Thành Công!!!';
                    $this->render('index');
            }
        }
    }

    public function store() {

    }

    public function destroy() {
        $tokens = Token::findToken($_COOKIE['token']);
        Token::destroy($tokens->id);
        setcookie('token', '', -1, '/'); 
        setcookie('email', '', -1, '/'); 
        setcookie('username', '', -1, '/'); 
        unset($_SESSION['success']);
        header('Location: index.php?controller=auths');
    }
    public function error(){
        $this->render('error');
    }
}
