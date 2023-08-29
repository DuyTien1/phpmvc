<?php
require_once('apps/controllers/base_controller.php');

class CommentsController extends BaseController{
    function __construct(){
        $this->folder = 'comments';
    }

    public function index() {
        $this->render('index');
    } 

    public function login() {
        
    }

    public function create() {

    }

    public function store() {

    }

    public function destroy() {

    }
}