<?php
class Category {
    public $id;
    public $category_name;

    function __construct($id, $category_name){
    $this->id = $id;
    $this->category_name = $category_name;
    }

    public static function all() {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM categories');
    foreach ($req->fetchAll() as $item) {
        $list[] = new User($item['id'], $item['category_name']);
        }
    return $list;
    }

    public static function create($category_name, $user_id) {
        $db = DB::getInstance();
        $req = $db->prepare('INSERT INTO categories (category_name) VALUES (:category_name)');
        $req->execute(array('category_name' => $category_name));
        return null;
    } 

    public static function find($id) {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM categories WHERE id = :id');
    $req->execute(array('id' => $id));
    $item = $req->fetch();
    if (isset($item['id'])) {
        return new Category($item['id'], $item['category_name']);
        }
    return null;
    } 

    public static function destroy($id) {
        $db = DB::getInstance();
        $req = $db->prepare('DELETE FROM categories WHERE id = :id');
        $req->execute(array('id' => $id));
        return null;
    }

    // public static function tokenVerify($category_name) {
    //     $db = DB::getInstance();
    //     $req = $db->prepare('SELECT categories.*, users.* FROM categories JOIN Users ON categories.user_id = users.id WHERE categories.id = :category_name');
    //     $req->execute(array('category_name' => $category_name));
    //     $item = $req->fetch();
    //     if (isset($item['user_id'])) {
    //         return $item;
    //     } else {
    //         return null;
    //     }
    // }  
}
