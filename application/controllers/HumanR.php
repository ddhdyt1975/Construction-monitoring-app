<?php

class HumanR extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model(array('hr/Dashboard'));
    }

    public function index() {
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $user3 = $this->session->userdata['logged_in']['company'];

        $data['c1'] = $this->Dashboard->count_all1($user3);
        $data['c2'] = $this->Dashboard->count_all2($user3);        
        $data['user_info'] = $this->Dashboard->getData($user2);
       
        $this->load->view("hr/header.php",$data);
        $this->load->view("hr/dashboard.php",$data);
        $this->load->view("hr/footer.php");
    }

    public function ajax_list(){
        $user3 = $this->session->userdata['logged_in']['company'];

        $list = $this->Dashboard->get_datatables($user3);
        $data = array();
       
        foreach ($list as $project) {

            $row = array();
            $row[] = $project->project_code;
            $row[] = '<b>'.$project->project_title.'</b>';
            $row[] = '<small>'.$project->project_desc.'</small>';
            $row[] = '<b>'.$project->user_fname.' '.$project->user_lname.'</b>';
            $row[] = $project->project_address.', '.$project->city_name.', '.$project->province_name.', '.$project->zip_code;

            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list1(){
        $userid2 = ($this->session->userdata['logged_in']['company']);
        $list = $this->Dashboard->get_datatables1($userid2);
        $data = array();
        foreach ($list as $supplier) {
            $row = array();
            $row[] = $supplier->pworker_id;
            $row[] = $supplier->pworker_fname.' '.$supplier->pworker_mname.' '.$supplier->pworker_lname;
            $row[] = $supplier->pworker_add.', '.$supplier->city_name.', '.$supplier->province_name.', '.$supplier->zip_code;
            $row[] = $supplier->description;            
            
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    

}
