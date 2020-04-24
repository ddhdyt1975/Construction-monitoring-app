<?php

class Projects extends CI_Controller {

 
       function __construct() {
        parent::__construct();

        $this->load->model(array('admin/Project'));
    }

    public function index() {
        $userid = ($this->session->userdata['logged_in']['user_id']);
        $userid3 = ($this->session->userdata['logged_in']['company']);

        $data['cities'] = $this->Project->getCity();
        //$data['projects'] = $this->Project->getProjects($userid3);
        $data['PM'] = $this->Project->getPM($userid3);
        $data['owner'] = $this->Project->getOwner($userid3);

        $user2 = $this->session->userdata['logged_in']['user_id'];
        $data['user_info'] = $this->Project->getData($user2);
        $this->load->view("admin/header.php",$data);
        $this->load->view("admin/projects.php", $data);
        $this->load->view("admin/footer.php");
          
    }

    public function ajax_add_task(){
        $data = array( 
            'projtsk_id' => $this->input->post('tskid'),
            'projtsk_name' => $this->input->post('tskname'),
            'projtsk_percentage' => $this->input->post('tskdecs')
        );
      
        $this->Project->addtask($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_add(){
        $userid3 = $this->session->userdata['logged_in']['company'];
        $this->_validate();

        $data = array(
            'project_code' => $this->input->post('prjcode'),
            'project_title' => $this->input->post('prjtitle'),
            'project_desc'  => $this->input->post('prjdesc'),
            'project_status' => $this->input->post('prjstatus'),
            'created_date' =>  date("Y-m-d H:i:s"),
            'start_project' => $this->input->post('prjstrt'),
            'expected_end_date' => $this->input->post('prjend'),
            'project_address' => $this->input->post('prjaddr'),
            'city_id' => $this->input->post('prjcity'),
            'user_id' => $this->input->post('prjmng'),
            'supervisor' =>$this->input->post('prjsv'),
            'foreman' => $this->input->post('prjfore'),
            'project_owner' => $this->input->post('prjown'),
            'company_id' => $userid3
        );
        
        $data2 = array(
            'project_code' => $this->input->post('prjcode'),
            'project_type' => $this->input->post('prjtype'),
            'project_sub_contractor' => $this->input->post('prjscn'),
            'project_comp_contract' => $this->input->post('prjcn'),
        );

        $insert = $this->Project->save($data, $data2);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update(){
        $this->_validate();
        $data = array( 
            'project_title' => $this->input->post('prjtitle'),
            'project_desc' => $this->input->post('prjdesc'),
            'project_status' => $this->input->post('prjstatus'),
            'project_address' => $this->input->post('prjaddr'),
            'update_date' =>  date("Y-m-d H:i:s"),
            'start_project' => $this->input->post('prjstrt'),
            'expected_end_date' => $this->input->post('prjend'),
            'city_id' => $this->input->post('prjcity'),
            'user_id' => $this->input->post('prjmng'),
            'supervisor' =>$this->input->post('prjsv'),
            'foreman' => $this->input->post('prjfore'),
            'project_owner' => $this->input->post('prjown')
            );

         $data2 = array( 
            'project_type' => $this->input->post('prjtype'),
            'project_sub_contractor' => $this->input->post('prjscn'),
            'project_comp_contract' => $this->input->post('prjcn'),
        );

      
        $this->Project->update(array('project_code' => $this->input->post('prjcode')), $data);

        $this->Project->update2(array('project_code' => $this->input->post('prjcode')), $data2);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('prjcode') == '')
        {
            $data['inputerror'][] = 'prjcode';
            $data['error_string'][] = 'Projec Code ID is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('prjtitle') == '')
        {
            $data['inputerror'][] = 'prjtitle';
            $data['error_string'][] = 'Project Title name is required';
            $data['status'] = FALSE;
        }

       
         if($this->input->post('prjstatus') == '')
        {
            $data['inputerror'][] = 'prjstatus';
            $data['error_string'][] = 'Status is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('prjaddr') == '')
        {
            $data['inputerror'][] = 'prjaddr';
            $data['error_string'][] = 'Address is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('prjcity') == '')
        {
            $data['inputerror'][] = 'prjcity';
            $data['error_string'][] = 'City is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('prjtype') == '')
        {
            $data['inputerror'][] = 'prjtype';
            $data['error_string'][] = 'Project Type is required';
            $data['status'] = FALSE;
        }

       
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }


    public function getProjects(){
        $userid3 = ($this->session->userdata['logged_in']['company']);
    
        $list = $this->Project->getProjects2($userid3);
        echo json_encode($list);
    }

    public function ajax_edit($id){
        $data = $this->Project->getp_by_id($id);
        echo json_encode($data);
    }

    public function ajax_delete($id){
        $this->Project->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function getTasks($id){
        $list = $this->Project->getTasks($id);
        echo json_encode($list);
    }

    public function getImages($id){
        $data = $this->Project->getimages_by_id($id);
        echo json_encode($data);
    }

    public function getProbs($id){
        $data = $this->Project->getprobs_by_id($id);
        echo json_encode($data);
    }

   
    public function getNOofEQ($id){
        $data = $this->Project->no_of_eq($id);
        echo json_encode($data);
    }

    public function getNOofMT($id){
        $data = $this->Project->no_of_mate($id);
        echo json_encode($data);
    }

    
    
}
