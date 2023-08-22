<?php
require_once('apps/controllers/base_controller.php');
require_once('apps/models/user.php');

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
                        $this->folder = 'dashboards';
                        $this->render('index');
                    } else {
                        $_SESSION['message'] = 'Đăng Nhập Thất Bại!!!';
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['password'] = $_POST['password'];
                        $this->render('index');
                    }
                } else {
                    $this->render('index');
                }
            }
        } else {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                if (User::userVerify($email, $password)) {
                    $this->folder = 'dashboards';
                    $this->render('index');
                } else {
                    $_SESSION['message'] = 'Đăng Nhập Thất Bại!!!';
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['password'] = $_POST['password'];
                    $this->render('index');
                }
            } else {
                $this->render('index');
            }
        }
    }

    public function create() {

    }

    public function store() {

    }

    public function destroy() {

    }
    public function error(){
        $this->render('error');
    }
}
