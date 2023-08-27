<?php
require_once('apps/controllers/base_controller.php');
require_once('apps/models/user.php');
require_once('apps/models/role.php');

class UsersController extends BaseController
{
  function __construct()
  {
    $this->folder = 'users';
  }

  public function index()
  {
    $users = User::all();
    $data = array('users' => $users, 'navbar' => 'users');
    $this->render('index', $data);
  }

  public function show(){
    $users = User::find($_GET['id']);
    $roles = Role::find($users->role_id);
    $data = array('users' => $users, 'roles' => $roles, 'navbar' => 'users');
    $this->render('show', $data);
  }

  public function toCreate() {
    $roles = Role::all();
    $data = array('roles' => $roles, 'navbar' => 'users');
    $this->render('create', $data);
  }

  public function createUser() {
    if (isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['username']) && isset($_SESSION['address']) && isset($_SESSION['phone'])) {
      if ($_SESSION['email'] == $_POST['email'] && $_SESSION['username'] == $_POST['username'] && $_SESSION['address'] == $_POST['address'] && $_SESSION['password'] == $_POST['password'] && $_SESSION['phone'] == $_POST['phone']) {
        unset($_SESSION['message']);
        header('Location: index.php?controller=users');
        // $data = array('navbar' => 'users');
        // $this->render('index', $data);
      } else {
        if ($_POST['password'] != $_POST['password_confirmation']) {
          $_SESSION['message'] = 'Mật Khẩu Chưa Chính Xác!!!';
          $_SESSION['username'] = $_POST['username'];
          $_SESSION['email'] = $_POST['email'];
          $_SESSION['password'] = $_POST['password'];
          $_SESSION['address'] = $_POST['address'];
          $_SESSION['phone'] = $_POST['phone'];
          header('Location: index.php?controller=users&action=create');
          // $data = array('navbar' => 'users');
          // $this->render('create', $data);
          } else if (User::emailVerify($_POST['email'])) {
              $_SESSION['message'] = 'Email Đã Tồn Tại!!!';
              $_SESSION['username'] = $_POST['username'];
              $_SESSION['email'] = $_POST['email'];
              $_SESSION['password'] = $_POST['password'];
              $_SESSION['address'] = $_POST['address'];
              $_SESSION['phone'] = $_POST['phone'];
              header('Location: index.php?controller=users&action=create');
              // $data = array('navbar' => 'users');
              // $this->render('create', $data);
            } else if (User::phoneVerify($_POST['phone'])) {
                $_SESSION['message'] = 'Số Điện Thoại Đã Tồn Tại!!!';
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['address'] = $_POST['address'];
                $_SESSION['phone'] = $_POST['phone'];
                header('Location: index.php?controller=users&action=create');
                // $data = array('navbar' => 'users');
                // $this->render('create', $data);
              } else {
                  $role_id = 1;
                  User::create($_POST['username'], $_POST['email'], $_POST['password'], $_POST['address'], $_POST['phone'], $role_id);
                  $_SESSION['success'] = 'Tạo Tài Khoản Mới Thành Công!!!';
                  header('Location: index.php?controller=users');
                  // $data = array('navbar' => 'users');
                  // $this->render('index', $data);
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
        header('Location: index.php?controller=users&action=create');
        // $data = array('navbar' => 'users');
        // $this->render('create', $data);
        } else if (User::emailVerify($_POST['email'])) {
            $_SESSION['message'] = 'Email Đã Tồn Tại!!!';
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['address'] = $_POST['address'];
            $_SESSION['phone'] = $_POST['phone'];
            header('Location: index.php?controller=users&action=create');
            // $data = array('navbar' => 'users');
            // $this->render('create', $data);
          } else if (User::phoneVerify($_POST['phone'])) {
              $_SESSION['message'] = 'Số Điện Thoại Đã Tồn Tại!!!';
              $_SESSION['username'] = $_POST['username'];
              $_SESSION['email'] = $_POST['email'];
              $_SESSION['password'] = $_POST['password'];
              $_SESSION['address'] = $_POST['address'];
              $_SESSION['phone'] = $_POST['phone'];
              header('Location: index.php?controller=users&action=create');
              // $data = array('navbar' => 'users');
              // $this->render('create', $data);
            } else {
                $role_id = 1;
                User::create($_POST['username'], $_POST['email'], $_POST['password'], $_POST['address'], $_POST['phone'], $role_id);
                $_SESSION['success'] = 'Tạo Tài Khoản Mới Thành Công!!!';
                header('Location: index.php?controller=users');
                // $data = array('navbar' => 'users');
                // $this->render('index', $data);
      }
    }
  }
  
  public function toUpdate($id) {
    $users = User::find($_GET['id']);
    $data = array('users' => $users);
    $this->render('update', $data);
  }

  public function update() {
    User::update($_POST['username'], $_POST['email'], $_POST['address'], $_POST['phone'], $_POST['role_id']);
    header('Location: index.php?controller=users');
  }

  public function destroy() {
    User::destroy($_GET['id']);
    $users = User::all();
    $data = array('users' => $users, 'navbar' => 'users');
    $this->render('index', $data);
  }

}
