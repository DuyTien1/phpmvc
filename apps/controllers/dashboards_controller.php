<?php
require_once('apps/controllers/base_controller.php');

class DashboardsController extends BaseController{
    function __construct(){
        $this->folder = 'dashboards';
    }

    public function index() {
        $data = array(
            'navbar' => 'dashboards'
        );
        $this->render('index', $data);
    } 

    public function login() {
        
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
