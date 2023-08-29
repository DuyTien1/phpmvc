<?php
require_once('apps/controllers/base_controller.php');

class RolesController extends BaseController{
    function __construct(){
        $this->folder = 'roles';
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