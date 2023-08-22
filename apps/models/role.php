<?php
class Role
{
    public $id;
    public $role_name;

    function __construct($id, $role_name){
    $this->id = $id;
    $this->role_name = $role_name;
    }

    public static function all() {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM roles');
    foreach ($req->fetchAll() as $item) {
        $list[] = new Role($item['id'], $item['role_name']);
        }
    return $list;
    }

    public static function create($role_name, $user_id) {
        $db = DB::getInstance();
        $req = $db->prepare('INSERT INTO roles (role_name) VALUES (:role_name)');
        $req->execute(array('role_name' => $role_name));
        return null;
    } 

    public static function find($id) {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM roles WHERE id = :id');
    $req->execute(array('id' => $id));
    $item = $req->fetch();
    if (isset($item['id'])) {
        return new Role($item['id'], $item['role_name']);
        }
    return null;
    } 

    public static function destroy($id) {
        $db = DB::getInstance();
        $req = $db->prepare('DELETE FROM roles WHERE id = :id');
        $req->execute(array('id' => $id));
        return null;
    }

}
