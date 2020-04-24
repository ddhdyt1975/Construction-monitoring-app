<?php

class ManagerSM extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('senior/Dashboard'));
    }

    public function index() {
         
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
            $com = $this->session->userdata['logged_in']['company'];
            if ($this->Dashboard->count_all1($user,$com)==null){
            $data['c1'] = 0;
        }
        else{
            $data['c1'] = $this->Dashboard->count_all1($user,$com);
        }

        if ($this->Dashboard->count_all5($user,$com)==null){
            $data['c5'] = 0;
        }
        else{
            $data['c5'] = $this->Dashboard->count_all5($user,$com);
        }

        
        $data['user_info'] = $this->Dashboard->getData($user);
        $this->load->view("senior/header.php", $data);
        $this->load->view("senior/dashboard.php", $data);
        $this->load->view("senior/footer.php");
    }

    public function ajax_list(){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $com = $this->session->userdata['logged_in']['company'];
       
        $list = $this->Dashboard->get_datatables($user,$com);
        $data = array();
        $tot = 0;

        foreach ($list as $project) {
            
            $row = array();
            $row[] = $project->project_title;
            $row[] = $project->PM;
            //$tot = 

            $row[] = '<div class="progress progress-lg"><div class="progress-bar progress-bar-success" style="color:black;width: '.intval($this->getTasks($project->project_code)).'%">'.intval($this->getTasks($project->project_code)).'%</div></div>';//$project->addr;
            //$row[] = intval($this->getTasks($project->project_code));
            
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function getTasks($id){
        $ii =0;
        $list = $this->Dashboard->getTasks($id);
        if (sizeof($list)>0){
            foreach ($list as $project) {
                $ii += intval($project->projdtsk_percent);
            }
            return ($ii/sizeof($list));
        }
        else{
            return (0);
        }
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

    public function ajax_list5c(){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
         $com = $this->session->userdata['logged_in']['company'];
     
        $list = $this->Dashboard->get_datatables5($user, $com);
        echo json_encode($list);
    }

  

}
