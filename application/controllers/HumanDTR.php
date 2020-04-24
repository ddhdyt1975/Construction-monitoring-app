<?php

class HumanDTR extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('hr/DTRH'));
    }

    public function index() {
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $user3 = $this->session->userdata['logged_in']['company'];
        $data['user_info'] = $this->DTRH->getData($user2);
        $data['projects'] = $this->DTRH->getAllProjects($user2, $user3); 
        
        $this->load->view("hr/header.php",$data);
        $this->load->view("hr/dtr.php",$data);
        $this->load->view("hr/footer.php");
    }

    public function ajax_list($id){
        $list = $this->DTRH->get_datatables($id);
        $data = array();
        foreach ($list as $supplier) {
            $row = array();
            $row[] = '<a style="color:black"  onclick="loadCalendar('.$supplier->pworker_id.','."'".$supplier->pworker_lname."'".','."'".$supplier->pworker_fname."'".','."'".$supplier->project_code."'".')">'.$supplier->pworker_id.'</a>';
            $row[] = '<a style="color:black" onclick="loadCalendar('.$supplier->pworker_id.','."'".$supplier->pworker_lname."'".','."'".$supplier->pworker_fname."'".','."'".$supplier->project_code."'".')"> '.$supplier->pworker_lname.', '.$supplier->pworker_fname.' </a>';
                       
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function getdtr($aw, $ew){
        $list = $this->DTRH->get_dtr_by_id($aw, $ew);
        echo json_encode($list);
    }

}