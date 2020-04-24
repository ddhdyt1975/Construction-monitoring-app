<?php

class SuperAdmin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('superadmin/Super'));
    }

    public function index() {
    	$user2 = $this->session->userdata['logged_in']['user_id'];
        $data['user_info'] = $this->Super->getData($user2);
    	$this->load->view("superadmin/header.php",$data);
        $this->load->view("superadmin/dashboard.php",$data);
        $this->load->view("superadmin/footer.php");
    }

}
