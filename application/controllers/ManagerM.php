<?php

class ManagerM extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('manager/Dashboard'));
    }

    public function index() {
         
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $com = array('com' => $this->session->userdata['logged_in']['company']);
       
        if ($this->Dashboard->count_all1($user)==null){
            $data['c1'] = 0;
        }
        else{
            $data['c1'] = $this->Dashboard->count_all1($user);
        }

        if ($this->Dashboard->count_all2($user)==null){
            $data['c2'] = 0;
        }
        else{
            $data['c2'] = $this->Dashboard->count_all2($user);
        }

        if ($this->Dashboard->count_all3($user)==null){
            $data['c3'] = 0;
        }
        else{
            $data['c3'] = $this->Dashboard->count_all3($user);
        }

        if ($this->Dashboard->count_all4($com)==null){
            $data['c4'] = 0;
        }
        else{
            $data['c4'] = $this->Dashboard->count_all4($com);
        }

        if ($this->Dashboard->count_all5($user, $com)==null){
            $data['c5'] = 0;
        }
        else{
            $data['c5'] = $this->Dashboard->count_all5($user, $com);
        }

        if ($this->Dashboard->count_all6($user)==null){
            $data['c6'] = 0;
        }
        else{
            $data['c6'] = $this->Dashboard->count_all6($user);
        }

        if ($this->Dashboard->count_all7($user)==null){
            $data['c7'] = 0;
        }
        else{
            $data['c7'] = $this->Dashboard->count_all7($user);
        }

        if ($this->Dashboard->count_all8($user)==null){
            $data['c8'] = 0;
        }
        else{
            $data['c8'] = $this->Dashboard->count_all8($user);
        }

        if ($this->Dashboard->count_all9($user)==null){
            $data['c9'] = 0;
        }
        else{
            $data['c9'] = $this->Dashboard->count_all9($user);
        }

        if ($this->Dashboard->count_all10($user)==null){
            $data['c10'] = 0;
        }
        else{
            $data['c10'] = $this->Dashboard->count_all10($user);
        }

        if ($this->Dashboard->count_all11($user)==null){
            $data['c11'] = 0;
        }
        else{
            $data['c11'] = $this->Dashboard->count_all11($user);
        }

        if ($this->Dashboard->count_all12($user)==null){
            $data['c12'] = 0;
        }
        else{
            $data['c12'] = $this->Dashboard->count_all12($user);
        }


        $user2 = $this->session->userdata['logged_in']['user_id'];
        $data['projects'] =  $this->Dashboard->getAllProjects($user);
        $data['mess'] =  $this->Dashboard->count_rr($user2);
        $data['notif'] =  $this->Dashboard->count_notif($user2);
        $data['user_info'] = $this->Dashboard->getData($user);
        $this->load->view("manager/header.php", $data);
        $this->load->view("manager/dashboard.php", $data);
        $this->load->view("manager/footer.php");

    }

   
    public function check_list($id){
        $data = $this->Dashboard->check_list($id, date("Y-m-d h:i:s"));
        echo json_encode($data);
    }

    public function viewActs($id){
        $data = $this->Dashboard->getNA($id);
        echo json_encode($data);
    }

    public function ajax_list(){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $list = $this->Dashboard->get_datatables($user);
        $data = array();
       
        foreach ($list as $project) {

            $row = array();
            $row[] = $project->project_title;
            $row[] = $project->project_desc;
            $row[] = $project->addr;

            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }


    public function ajax_list2(){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $list = $this->Dashboard->get_datatables2($user);
        $data = array();
       
        foreach ($list as $material) {

            $row = array();
            $row[] = $material->project_title;
            $row[] = $material->material_name;
            $row[] = $material->mu_quantity;
            $row[] = $material->ddate;
            $row[] = $material->supplier_name;
                  
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list3(){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
       
        $list = $this->Dashboard->get_datatables3($user);
        $data = array();
       
        foreach ($list as $equip) {

            $row = array();
            $row[] = $equip->project_title;
            $row[] = $equip->equipment_name;
            $row[] = $equip->eu_quantity;
            $row[] = $equip->ddate;
            $row[] = $equip->supplier_name;
          
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function viewnotification(){
        $user = $this->session->userdata['logged_in']['user_id'];
        $c = $this->Dashboard->view_notif($user);
        echo json_encode($c);
    }

    public function countnotif(){
        $user = $this->session->userdata['logged_in']['user_id'];
        $c = $this->Dashboard->count_notif($user);
        echo json_encode($c);
    }

    public function ajax_list4(){

        $user = $this->session->userdata['logged_in']['user_id'];
        $list = $this->Dashboard->get_datatables4($user);
        $data = array();
       
        foreach ($list as $supplier) {

            $row = array();
             
            $row[] = $supplier->supplier_name;
            $row[] = $supplier->supplier_address.', '.$supplier->city_name.', '.$supplier->province_name.', '.$supplier->zip;
         
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }


    public function ajax_list5(){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $com = $this->session->userdata['logged_in']['company'];

        $list = $this->Dashboard->get_datatables5($user, $com);
        $data = array();
       
        foreach ($list as $person) {

            $row = array();
            $row[] = $person->name;
            $row[] = $person->user_email;
            $row[] = $person->usertype_name;
            $row[] = $person->addr;
          
            
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list6(){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $list = $this->Dashboard->get_datatables6($user);
        $data = array();
       
        foreach ($list as $person) {

            $row = array();
            $row[] = $person->material_name;
            $row[] = $person->project_title;
            $row[] = $person->project_title1;
            $row[] = $person->quantity;
            $row[] = $person->transfer_date;
            
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }
   
    public function ajax_list7(){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $list = $this->Dashboard->get_datatables7($user);
        $data = array();
       
        foreach ($list as $person) {

            $row = array();
            $row[] = $person->equipment_name;
            $row[] = $person->project_title;
            $row[] = $person->project_title1;
            $row[] = $person->transfer_quantity;
            $row[] = $person->transfer_date;
            
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list8(){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $list = $this->Dashboard->get_datatables8($user);
        $data = array();
       
        foreach ($list as $person) {

            $row = array();
            $row[] = $person->project_title;
            $row[] = $person->worker_title;
            $row[] = $person->worker_quantity;
            $row[] = $person->worker_date;
            
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function getProjects(){
        $user = $this->session->userdata['logged_in']['user_id'];
        $list = $this->Dashboard->getProjects2($user);
        echo json_encode($list);
    }

    public function getTasks($id){
        $list = $this->Dashboard->getTasks($id);
        echo json_encode($list);
    }
}
