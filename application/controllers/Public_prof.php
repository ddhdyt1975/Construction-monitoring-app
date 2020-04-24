<?php

class Public_prof extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model(array('auth/Viewer'));
    }

    function index() {
    	$user2 = $this->session->userdata['logged_in']['user_id'];
        $data['user_info'] = $this->Viewer->getData($user2);
    	$this->load->view("public/header.php");
        $this->load->view("public/profile.php",$data);
        $this->load->view("public/footer.php");
    }

}