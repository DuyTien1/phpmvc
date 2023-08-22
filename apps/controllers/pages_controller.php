<?php
require_once('apps/controllers/base_controller.php');

class PagesController extends BaseController{
    function __construct(){
        $this->folder = 'pages';
    }

    public function home(){
        $data = array(
            'username' => 'Sang Beo',
            'address' => 'an gaing'
            );
        $this->render('home', $data);
    } 

    public function error(){
        $this->render('error');
    }
}
