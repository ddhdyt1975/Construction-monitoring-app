<?php

class Settings extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('admin/Setting'));
    }

    public function index() {
    	$user2 = $this->session->userdata['logged_in']['user_id'];
        $data['user_info'] = $this->Setting->getData($user2);
       
        $this->load->view("admin/header.php",$data);
        $this->load->view("admin/setting.php",$data);
        $this->load->view("admin/footer.php");
    }
//////////////////////TASK////////////////////////////////
    public function tasks_lists(){

        $user2 = $this->session->userdata['logged_in']['company'];

    	$list = $this->Setting->getTasks($user2);
        $data = array();
       
        foreach ($list as $task) {

            $row = array();
            $row[] = $task->projtsk_id;
            $row[] = $task->projtsk_name;
            $row[] = $task->projtsk_desc;

            $row[] = '<a class="btn btn-xs btn-primary"  data-toggle="tooltip" data-placement="bottom" title="Update '.$task->projtsk_name.'"  title="Edit this "'. $task->projtsk_name.'"" onclick="edit_task('."'".$task->projtsk_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
              <a class="btn btn-xs btn-danger"  data-toggle="tooltip" data-placement="bottom" title="Delete '.$task->projtsk_name.'" onclick="delete_task('."'".$task->projtsk_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function addtask(){
        $user2 = $this->session->userdata['logged_in']['company'];

    	$this->_validateT();
        $ii = $this->getlastidtask() + 1;

        $data = array(
            'projtsk_id' => $ii,
            'projtsk_name' => $this->input->post('taskname'),
            'projtsk_desc' => $this->input->post('tskdec'),
            'company_id' => $user2
        );
		
		$insert = $this->Setting->addtask($data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validateT(){
    	$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('taskname') == ''){
            $data['inputerror'][] = 'taskname';
            $data['error_string'][] = '* Task Name is required';
            $data['status'] = FALSE;
        }

        if($this->Setting->checkTname($this->input->post('taskname')) != null){
            $data['inputerror'][] = 'taskname';
            $data['error_string'][] = '* This Task Name is already used.';
            $data['status'] = FALSE;
        }
        
        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }

    private function getlastidtask(){
    	$tid = $this->Setting->getlastTaskid();
    	return intval($tid);
    }

    public function gettask($id){
    	$data = $this->Setting->gettask_by_id($id);
        echo json_encode($data);
    }

    public function updatetask(){
    	$data = array(
            'projtsk_name' => $this->input->post('taskname'),
            'projtsk_desc' => $this->input->post('tskdec'),
        );
		
		$insert = $this->Setting->updatetask(array('projtsk_id' => $this->input->post('taskid')),$data);
        echo json_encode(array("status" => TRUE));
    }

    public function deletetask($taskid){
    	$this->Setting->deletetask_by_id($taskid);
        echo json_encode(array("status" => TRUE));
    }
////////////////////TASK///////////////////////////////////////

/////////////////////UNIT//////////////////////////////////////
    
    public function unit_lists(){
    	$list = $this->Setting->getUnits();
        $data = array();
       
        foreach ($list as $un) {

            $row = array();
            $row[] = $un->unit_id;
            $row[] = $un->unit_name;
            $row[] = $un->unit_acro;

            $row[] = '<a class="btn btn-xs btn-primary"  data-toggle="tooltip" data-placement="bottom" title="Update '.$un->unit_name.'"  t onclick="edit_unit('."'".$un->unit_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
              <a class="btn btn-xs btn-danger"  data-toggle="tooltip" data-placement="bottom" title="Delete '.$un->unit_name.'" onclick="delete_unit('."'".$un->unit_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function addunit(){
    	$this->_validateU();
        $ii = $this->getlastidunit() + 1;

        $data = array(
            'unit_id' => $ii,
            'unit_name' => $this->input->post('unitname'),
            'unit_acro' => $this->input->post('unitacro'),
        );
		
		$insert = $this->Setting->addunit($data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validateU(){
    	$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('unitname') == ''){
            $data['inputerror'][] = 'unitname';
            $data['error_string'][] = '* Unit Name is required';
            $data['status'] = FALSE;
        }

        if($this->Setting->checkUname($this->input->post('unitname')) != null){
            $data['inputerror'][] = 'unitname';
            $data['error_string'][] = '* This Unit Name is already used.';
            $data['status'] = FALSE;
        }

        if($this->input->post('unitacro') == ''){
            $data['inputerror'][] = 'unitacro';
            $data['error_string'][] = '* Unit Acronym is required';
            $data['status'] = FALSE;
        }
        
        if($this->Setting->checkAUname($this->input->post('unitacro')) != null){
            $data['inputerror'][] = 'unitacro';
            $data['error_string'][] = '* This Unit Acronym is already used.';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }

    private function getlastidunit(){
    	$tid = $this->Setting->getlastunitid();
    	return intval($tid);
    }

    public function getunit($id){
    	$data = $this->Setting->getunit_by_id($id);
        echo json_encode($data);
    }

    public function updateunit(){
    	$data = array(
            'unit_name' => $this->input->post('unitname'),
            'unit_acro' => $this->input->post('unitacro'),
        );
		
		$insert = $this->Setting->updateunit(array('unit_id' => $this->input->post('unitid')),$data);
        echo json_encode(array("status" => TRUE));
    }

    public function deleteunit($taskid){
    	$this->Setting->deleteunit_by_id($taskid);
        echo json_encode(array("status" => TRUE));
    }

/////////////////////UNIT//////////////////////////////////////

/////////////////////CompanY//////////////////////////////////////

     public function updatecomname(){
        $this->_validateCN();
        $data = array(
            'company_name' => $this->input->post('comname'), 
        );
        
        $insert = $this->Setting->updatecomN(array('company_id' => $this->input->post('comid')),$data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validateCN(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('comname') == ''){
            $data['inputerror'][] = 'comname';
            $data['error_string'][] = '* Company Name is required';
            $data['status'] = FALSE;
        }

        if($this->Setting->checkCname($this->input->post('comname')) != null){
            $data['inputerror'][] = 'comname';
            $data['error_string'][] = '* This Company Name is already used.';
            $data['status'] = FALSE;
        }
        
        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }

    public function upload_file() {
         
        $file_element_name = 'userfile';
        $status="";
       if ($status != "error") {
        $config['upload_path'] = './assets/company_images/';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = FALSE;
        
        $this->load->library('upload', $config);
          if (!$this->upload->do_upload($file_element_name)){
            $status = 'error';
            $msg = $this->upload->display_errors('', '');
          }
          else {
           $data = $this->upload->data();
           //var_dump($data);
           $save_path = base_url().'assets/company_images/'.$data['upload_data']['file_name'].$data['file_name'];
           $userid = ($this->session->userdata['logged_in']['user_id']);
            $dd = $data['file_name'];
           $imagedb = $this->Setting->comp_img($save_path,$userid,$dd);
           $status = "success";
            
            if(file_exists($save_path)) {
                
                $msg = "Successfully Updated! ";
                 
            }
            else {
              $status = FALSE;
              $msg = "Something went wrong when saving the file, please try again.";
            }
        }
       @unlink($_FILES[$file_element_name]);
       }
       echo json_encode(array('status' => TRUE, 'msg' => $msg));
    }

/////////////////////COmpany//////////////////////////////////////



}