<?php
class User
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $address;
    public $phone;
    public $role_id;

    function __construct($id, $username, $email, $password, $address, $phone, $role_id){
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->address = $address;
    $this->phone = $phone;
    $this->role_id = $role_id;
    }

    public static function all() {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM users');
    foreach ($req->fetchAll() as $item) {
        $list[] = new User($item['id'], $item['username'],$item['email'], $item['password'], $item['address'], $item['phone'], $item['role_id']);
        }
    return $list;
    }

    public static function create($username, $email, $password, $address, $phone, $role_id) {
        $db = DB::getInstance();
        $req = $db->prepare('INSERT INTO users (username, email, password, address, phone, role_id) VALUES (:username, :email, :password, :address, :phone, :role_id)');
        $req->execute(array('username' => $username, 'email' => $email, 'password' => $password, 'address' => $address, 'phone' => $phone, 'role_id' => $role_id));
        return null;
    } 

    public static function update($username, $email, $address, $phone, $role_id){
        $db = DB::getInstance();
        $req = $db->prepare('UPDATE users SET username = :username, email = :email, address = :address, phone = :phone, role_id = :role_id');
        $req->execute(array('username' => $username, 'email' => $email, 'address' => $address, 'phone' => $phone, 'role_id' => $role_id));
        return null;
    }

    public static function find($id) {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM users WHERE id = :id');
    $req->execute(array('id' => $id));
    $item = $req->fetch();
    if (isset($item['id'])) {
        return new User($item['id'], $item['username'], $item['email'], $item['password'], $item['address'], $item['phone'], $item['role_id']);
        }
    return null;
    } 

    public static function findEmail($email) {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM users WHERE email = :email');
        $req->execute(array('email' => $email));
        $item = $req->fetch();
        if (isset($item['id'])) {
            return new User($item['id'], $item['username'], $item['email'], $item['password'], $item['address'], $item['phone'], $item['role_id']);
            }
        return null;
    }

    public static function userVerify($email, $password) {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM users WHERE email = :email and password = :password');
        $req->execute(array('email' => $email, 'password' => $password));
        $item = $req->fetch();
        if (isset($item['id'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function emailVerify($email) {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM users WHERE email = :email');
        $req->execute(array('email' => $email));
        $item = $req->fetch();
        if (isset($item['id'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function phoneVerify($phone) {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM users WHERE phone = :phone');
        $req->execute(array('phone' => $phone));
        $item = $req->fetch();
        if (isset($item['id'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function passwordReset($id, $password, $password_confirmation) {
        if ($password != $password_confirmation) {
            return false;
        } else {
            $db = DB::getInstance();
            $req = $db->prepare('SELECT * FROM users WHERE id = :id');
            $req->execute(array('id' => $id));
            $item = $req->fetch();
            if ($password == $item['password']) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function destroy($id) {
        $db = DB::getInstance();
        $req = $db->prepare('DELETE FROM users WHERE id = :id');
        $req->execute(array('id' => $id));
        return null;
    }
}
