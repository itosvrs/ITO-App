<?php

class Login_Controller extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->smarty = $this->load->library('smarty');
	}

    public function index()
    {
        debug($this->model->test());
        //$this->smarty->assign('test', 'Hello World -- hayyy');
        //$this->smarty->view('publishers/login.tpl.php');
    }
	
}