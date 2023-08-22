<?php
class Token
{
    public $id;
    public $token;
    public $user_id;

    function __construct($id, $token, $user_id){
    $this->id = $id;
    $this->token = $token;
    $this->user_id = $user_id;
    }

    public static function all() {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM tokens');
    foreach ($req->fetchAll() as $item) {
        $list[] = new User($item['id'], $item['token'],$item['user_id']);
        }
    return $list;
    }

    public static function create($token, $user_id) {
        $db = DB::getInstance();
        $req = $db->prepare('INSERT INTO tokens (token, user_id) VALUES (:token, :user_id)');
        $req->execute(array('token' => $token, 'user_id' => $user_id));
        // $item = $req->fetch();
        return null;
    } 

    public static function find($id) {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM tokens WHERE id = :id');
    $req->execute(array('id' => $id));
    $item = $req->fetch();
    if (isset($item['id'])) {
        return new Token($item['id'], $item['token'], $item['user_id']);
        }
    return null;
    } 

    public static function destroy($id) {
        $db = DB::getInstance();
        $req = $db->prepare('DELETE FROM tokens WHERE id = :id');
        $req->execute(array('id' => $id));
        return null;
    }
    
    public static function findToken($token) {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM tokens WHERE token = :token');
        $req->execute(array('token' => $token));
        $item = $req->fetch();
        if (isset($item['id'])) {
            return new Token($item['id'], $item['token'], $item['user_id']);
            }
        return null;
    }

    public static function tokenVerify($token) {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT tokens.*, users.* FROM tokens JOIN Users ON tokens.user_id = users.id WHERE tokens.id = :token');
        $req->execute(array('token' => $token));
        $item = $req->fetch();
        if (isset($item['user_id'])) {
            return $item;
        } else {
            return null;
        }
    }  
}
