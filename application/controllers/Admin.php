<?php

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model(array('admin/Dashboard'));
    }

    public function index() {
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $user3 = $this->session->userdata['logged_in']['company'];

        $data['c1'] = $this->Dashboard->count_all1($user3);
        $data['c2'] = $this->Dashboard->count_all2($user3);
        $data['c3'] = $this->Dashboard->count_all3($user3);
        $data['c4'] = $this->Dashboard->count_all4($user3);
        $data['c5'] = $this->Dashboard->count_all5($user2,$user3);
        $data['user_info'] = $this->Dashboard->getData($user2);
       
        $this->load->view("admin/header.php",$data);
        $this->load->view("admin/dashboard.php",$data);
        $this->load->view("admin/footer.php");
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

    public function getProjects(){
        $user3 = $this->session->userdata['logged_in']['company'];

        $list = $this->Dashboard->getProjects2($user3);
        echo json_encode($list);
    }

    public function ajax_list2() {
        $com = $this->session->userdata['logged_in']['company'];

        $list = $this->Dashboard->get_datatables2($com);
        $data = array();
       
        foreach ($list as $material) {

            $row = array();
            $row[] = $material->material_id;
            $row[] = $material->material_name;
            $row[] = $material->material_quantity.' '.$material->material_unit;
            $row[] = $material->material_status;
            $row[] = $material->material_status;
            $row[] = $material->supplier_name;
            $row[] = $material->ddate;
            $row[] = $material->material_comment;
           
     
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list3(){
        $com = $this->session->userdata['logged_in']['company'];
        $list = $this->Dashboard->get_datatables3($com);
        $data = array();
       
        foreach ($list as $equip) {

            $row = array();
            $row[] = $equip->equipment_id;
            $row[] = $equip->equipment_name;
            $row[] = $equip->supplier_name;
            $row[] = $equip->ddate;
            $row[] = $equip->equipment_quantity;
            $row[] = $equip->equipment_status;
            $row[] = $equip->equipment_comment;

          
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }


    public function ajax_list4(){
        $com = $this->session->userdata['logged_in']['company'];
        $list = $this->Dashboard->get_datatables4($com);
        $data = array();
       
        foreach ($list as $supplier) {

            $row = array();
            $row[] = $supplier->supplier_id;
            $row[] = $supplier->supplier_name;
            $row[] = $supplier->supplier_address.', '.$supplier->city_name.', '.$supplier->province_name.', '.$supplier->zip_code;
         
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }


    public function ajax_list5(){
        $userid = ($this->session->userdata['logged_in']['user_id']);
        $userid2 = ($this->session->userdata['logged_in']['company']);
        
        $list = $this->Dashboard->get_datatables5($userid, $userid2);
        $data = array();
       
       foreach ($list as $person) {

            $row = array();
            $row[] = "<b>".$person->name."</b>";
            $row[] = $person->user_email;
            $row[] = $person->usertype_name;
            $row[] = $person->addr;
            $row[] = $person->ddate;
          
            
            $data[] = $row;
        }
        
        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

     public function ajax_list51(){
        $userid = ($this->session->userdata['logged_in']['user_id']);
        
        $list = $this->Dashboard->get_datatables51($userid);
        echo json_encode($list);
    }

    public function getTasks($id){
        $list = $this->Dashboard->getTasks($id);
        echo json_encode($list);
    }


}
