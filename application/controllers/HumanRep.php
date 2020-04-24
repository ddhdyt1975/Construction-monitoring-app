<?php

class HumanRep extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url','file'));
        $this->load->model(array('hr/Report'));
    }

    public function index() {
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $user3 = $this->session->userdata['logged_in']['company'];
        $data['projects'] = $this->Report->getAllProjects($user2, $user3); 

        $data['user_info'] = $this->Report->getData($user2);
        $this->load->view("hr/header.php",$data);
        $this->load->view("hr/hrreport.php" );
        $this->load->view("hr/footer.php");
    }

    public function getemp($aw, $ew, $ew2, $ew3, $ew4, $ew5){
        $e1 = trim(substr($ew3, 0,4));
        $e2 = trim(substr($ew3, 11,2));
        $data = $this->Report->getEmp($aw, $ew, $ew2, $e1, $e2, $ew4, $ew5);
        echo json_encode($data);
    }  

    public function getloan($ew, $ew2, $ew3, $ew4, $ew5){
        $e1 = trim(substr($ew3, 0,4));
        $e2 = trim(substr($ew3, 11,2));
        $aw = $this->session->userdata['logged_in']['company'];
       
        $data = $this->Report->getLoan($aw, $ew, $ew2, $e1, $e2, $ew4, $ew5);
        echo json_encode($data);
    }   

}