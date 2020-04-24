<?php

class Projects2M extends CI_Controller {

 
    function __construct() {
        parent::__construct();

        $this->load->model(array('manager/Project2'));
    }

    public function index() {

        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $com = $this->session->userdata['logged_in']['company'];
        
        $data['user_info'] = $this->Project2->getData($user);
        $data['projects'] = $this->Project2->getAllProjects($user, $com); 
        $data['PM'] = $this->Project2->getPM();
        $data['cities'] = $this->Project2->getCity();
        $data['task'] = $this->Project2->getTask();
        $data['material'] = $this->Project2->getMaterial();
        $data['equipment'] = $this->Project2->getEquipment();
        $user2 = $this->session->userdata['logged_in']['user_id'];
        //$data['mess'] =  $this->Project2->count_rr($user2);
        $this->load->view("manager/header.php", $data);
        $this->load->view("manager/project2.php", $data);
        $this->load->view("manager/footer.php");

    }

    function ProjDetails($project_title) {

        $data = $this->Project2->getProjDetails($project_title);
        echo json_encode($data);
    }

    function Projs($project_title) {

        $data = $this->Project2->getProjs($project_title);
        echo json_encode($data);
    }

    function getOm($project_title) {

        $data = $this->Project2->getOM($project_title);
        echo json_encode($data);
    }
    
    function getOe($project_title) {

        $data = $this->Project2->getOE($project_title);
        echo json_encode($data);
    }

    function Addworker(){
       
        $addworker = $this->Project2->insertWorker();      
    }

    public function ajax_edit($id){
        $data = $this->Project2->getp_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update(){
        $this->_validate();
        $data = array(
            'project_title' => $this->input->post('prjtitle'),
            'project_desc'  => $this->input->post('prjdesc'),
            'project_status' => $this->input->post('prjstatus'),
            'project_address' => $this->input->post('prjaddr'),
            'update_date' => date('d/m/y'),
            'start_project' => $this->input->post('prjstrt'),
            'expected_end_date' => $this->input->post('prjend'),
            'city_id' => $this->input->post('prjcity'),
            'user_id' => $this->input->post('prjmng')
        );

        $data2 = array(
            'project_type' => $this->input->post('prjtype'),
            'project_sub_contractor' => $this->input->post('prjscn'),
            'project_comp_contract' => $this->input->post('prjcn'),
        );

      
        $this->Project2->update(array('project_code' => $this->input->post('prjcode')), $data);
        $this->Project2->update2(array('project_code' => $this->input->post('prjcode')), $data2);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate2(){
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

    public function ajax_list2($id){

        $list = $this->Project2->get_item_id($id);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
           
            $row[] = $mat->material_name;
            $row[] = $mat->mu_quantity.' '.$mat->unit_acro;
            $row[] = $mat->ddate;
            $row[] = $mat->supplier_name;
            // $row[] = '<a class="btn btn-xs btn-primary" title="Edit" onclick="updateMat('."'".$mat->mu_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Update</a>
            //           <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteMat('."'".$mat->mu_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';


            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list3($id){

        $list = $this->Project2->get_teu_id($id);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
            $row[] = $mat->material_name;
            $row[] = $mat->project_title;
            $row[] = $mat->transfer_date;
            $row[] = $mat->quantity;
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list4($id){

        $list = $this->Project2->get_eu_id($id);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
            $row[] = $mat->equipment_name;
            $row[] = $mat->eu_quantity;
            $row[] = $mat->ddate;
            $row[] = $mat->supplier_name;
            // $row[] = '<a class="btn btn-xs btn-primary" title="Edit" onclick="updateEqp('."'".$mat->eu_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Update</a>
            //       <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteEqp('."'".$mat->eu_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list_transmat($id){

        $list = $this->Project2->get_tm_id($id);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
            $row[] = $mat->material_name;
            $row[] = $mat->project_title;
            $row[] = $mat->transfer_date;
            $row[] = $mat->transfer_quantity.' '.$mat->material_unit;
            // $row[] = '<a class="btn btn-xs btn-primary" title="Edit" onclick="updateEqp('."'".$mat->transm_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Update</a>
            //       <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteEqp('."'".$mat->transm_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list_transeqp($id){

        $list = $this->Project2->get_te_id($id);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
            $row[] = $mat->equipment_name;
            $row[] = $mat->project_title;
            $row[] = $mat->transfer_date;
            $row[] = $mat->transfer_quantity;
            // $row[] = '<a class="btn btn-xs btn-primary" title="Edit" onclick="updateEqp('."'".$mat->transe_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Update</a>
            //       <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteEqp('."'".$mat->transe_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function getTasks($id){
        $list = $this->Project2->getTasks($id);
        echo json_encode($list);
    }

    public function getTasksCom($id){
        $list = $this->Project2->getTasksCom($id);
        echo json_encode($list);
    }

    public function ajax_add_task($id){
        $data = array(
            'project_code' => $id,
            'projdtsk_id' =>  ('Task'.$id.''.$this->input->post('tskname')),
            'projtsk_id'  => $this->input->post('tskname'),
            'projdtsk_percent' => $this->input->post('tskpercent'),
            'projdtsk_date' => date("Y-m-d"),
            'projdtsk_update' => date("Y-m-d")
        );

        $data2 = array(
            'updated_task_id' =>  ('Task'.$id.''.$this->input->post('tskname').''.date("Ymd")),
            'updated_percent' => $this->input->post('tskpercent'),
            'update_date' => date("Y-m-d"),
            'project_code' => $id,
            'task_id' => $this->input->post('tskname')
        );
        
        $insert = $this->Project2->addTask($data);
        $insert = $this->Project2->addTask2($data2);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_add_taskcomm($id){
        $data = array(
            'prjtsk_comment' =>  $this->input->post('prjtask_com'),
            'prjtsk_status'  => $this->input->post('prjstatus_com'),
            'projdtsk_id' =>  $this->input->post('tskidcom2'),
            'project_code' => $id,
            'prjtsk_comment_date' => date("Y-m-d")
        );
    
        $data2 = array(
            'prjtsk_comment' =>  $this->input->post('prjtask_com'),
            'prjtsk_status'  => $this->input->post('prjstatus_com'),
            'projdtsk_id' =>  $this->input->post('tskidcom2'),
            'project_code' => $id,
            'prjtskcom_update' => date("Y-m-d")
        );
    
        $insert = $this->Project2->addTaskcom($data);
        $insert = $this->Project2->addTaskcom2($data2);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit_comment($id){
        $data = $this->Project2->getcc_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update_taskcomm($id){
        $data = array(
            'prjtsk_comment' =>  $this->input->post('prjtask_com'),
            'prjtsk_status'  => $this->input->post('prjstatus_com'),
            'projdtsk_id' =>  $this->input->post('tskidcom2'),
            'project_code' => $id,
            'prjtskcom_update' => date("Y-m-d")
        );

        $data2 = array(
            'prjtsk_comment' =>  $this->input->post('prjtask_com'),
            'prjtsk_status'  => $this->input->post('prjstatus_com'),
             
        );

        $this->Project2->updatetaskcom(array('prjtsk_comm_id' => $this->input->post('tskidcom1')), $data);
        $insert = $this->Project2->updatetaskcom2(array('prjtsk_comm_id' => $this->input->post('tskidcom1').''.date("Ymd")), $data2, $data);  
   

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit_task($id){
        $data = $this->Project2->gett_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update_task($id){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data = array(
            'projdtsk_percent' => $this->input->post('tskpercent'),
            'projdtsk_update' => date("Y-m-d")
        );

        $data2 = array(
            'updated_percent' => $this->input->post('tskpercent'),
            'update_date' => date("Y-m-d"),
            'project_code' => $id,
            'task_id' => $this->input->post('tskname')
        );

        $data3 = array(
            'updated_task_id' =>  ('Task'.$id.''.$this->input->post('tskname').''.date("Ymd")),
            'updated_percent' => $this->input->post('tskpercent'),
            'update_date' => date("Y-m-d"),
            'project_code' => $id,
            'task_id' => $this->input->post('tskname'),
            'updated_by' => $this->session->userdata['logged_in']['user_id']
        );
             
        $this->Project2->updatetask(array('projdtsk_id' => $this->input->post('tskid')), $data);
        $insert = $this->Project2->updatetask2(array('updated_task_id' => $this->input->post('tskid').''.date("Ymd")), $data2, $data3);  
       
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_add_material($id){
      //  $this->_validate2();

        $data = array(
            'project_code' => $id,
            'mu_id' =>  ('material'.$id.''.$this->input->post('matname').''.date('dmy')),
            'material_id'  => $this->input->post('matname'),
            //'projdtsk_percent' => $this->input->post('tskpercent'),
            'mu_date' => date("Y-m-d"),
            'mu_quantity' => $this->input->post('matqty')
            
        );
        
        $insert = $this->Project2->addMaterial($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit_material($id){
        $data = $this->Project2->getm_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update_material($id){
        $data = array(
            'mu_quantity' => $this->input->post('matqty')
        );         
        $this->Project2->updatemat(array('mu_id' => $this->input->post('matid')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete_material($id){
        $this->Project2->deletem_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

     public function ajax_delete_task($id){
        $this->Project2->deletett_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_add_equipment($id){
        $data = array(
            'project_code' => $id,
            'eu_id' =>  ('equip'.$id.''.$this->input->post('equipname').''.date('dmy')),
            'equipment_id'  => $this->input->post('equipname'),
            'eu_date' => date("Y-m-d"),
            'eu_quantity' => $this->input->post('equipqty')
        );
        
        $insert = $this->Project2->addEquipment($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit_equipment($id){
        $data = $this->Project2->gete_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update_equipment($id){
        $data = array(
     
            'eu_quantity' => $this->input->post('equipqty')
        );

              
        $this->Project2->updateequip(array('eu_id' => $this->input->post('equipid')), $data);

        
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete_equipment($id){
        $this->Project2->deletee_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_trans_material($id){
        $data = array(
            
            'transfer_from' => $id,
            'transfer_to' => $this->input->post('trncom'),
            'transm_id' =>  ('transfer'.$id.''.$this->input->post('transmatname').''.date('dmy').''.$this->input->post('trncom')),
            'mu_id'  => $this->input->post('transmatname'),
            'transfer_date' => date("Y-m-d"),
            'transfer_quantity' => $this->input->post('transmatqty')
        );

          $data2 = array(
            'project_code' => $this->input->post('trncom'),
            'mu_id' =>  ($this->input->post('transmatname').''.date('dmy').''.$this->input->post('trncom')),
            'material_id'  => $this->input->post('transmatid2'),
            'mu_date' => date("Y-m-d"),
            'mu_quantity' => $this->input->post('transmatqty'),
            'received_from' => $id
        );
        
        $insert = $this->Project2->addMaterial($data2);
        
        $insert = $this->Project2->transMaterial($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_trans_equipment($id){
        $data = array(
            
            'transe_id' =>  ('transfer'.$id.''.$this->input->post('transeqpname').''.date('dmy').''.$this->input->post('trncom2')),
            'eu_id'  => $this->input->post('transeqpname'),
            'transfer_date' => date("Y-m-d"),
            'transfer_from' => $id,
            'transfer_to' => $this->input->post('trncom2'),
            'transfer_quantity' => $this->input->post('transeqpqty')
        );
        $data2 = array(
            'project_code' => $this->input->post('trncom2'),
            'eu_id' =>  ($this->input->post('transeqpname').''.date('dmy').''.$this->input->post('trncom2')),
            'equipment_id'  => $this->input->post('transeqpid2'),
            'eu_date' => date("Y-m-d"),
            'eu_quantity' => $this->input->post('transeqpqty'),
            'received_from' => $id
        );
        
        $insert = $this->Project2->addEquipment($data2);
        $insert = $this->Project2->transEquip($data);
        echo json_encode(array("status" => TRUE));
    }



}
