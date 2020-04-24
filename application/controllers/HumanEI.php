<?php

class HumanEI extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url','file'));
        $this->load->model(array('hr/Empinfo'));
    }

    public function index() {
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $user3 = $this->session->userdata['logged_in']['company'];

        $data['user_info'] = $this->Empinfo->getData($user2);
        $data['emp_info'] = $this->Empinfo->getEmployees($user3);
        $this->load->view("hr/header.php",$data);
        $this->load->view("hr/employeeinfo.php" );
        $this->load->view("hr/footer.php");
    }

    public function getEmp($id){
        $data = $this->Empinfo->get_by_id($id);
        echo json_encode($data);
    }  

    public function getdtr($aw){
        $list = $this->Empinfo->get_dtr_by_id($aw);
        echo json_encode($list);
    }

    public function ajax_list($id){
        $list = $this->Empinfo->get_dtr_by_id($id);
        $data = array();
        foreach ($list as $supplier) {
            $row = array();
            $row[] = '<a style="color:black" >'.$supplier->ddate.'</a>';
            $row[] = '<a style="color:black"> '.$supplier->dtime.' </a>';
            $row[] = '<a style="color:black"> '.$supplier->project_title.' </a>';
                       
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

}
