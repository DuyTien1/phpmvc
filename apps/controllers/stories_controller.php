<?php
require_once('apps/controllers/base_controller.php');

class StoriesController extends BaseController{
    function __construct(){
        $this->folder = 'stories';
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