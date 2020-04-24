<?php

class ProjectsM extends CI_Controller {

 
    function __construct() {
        parent::__construct();

        $this->load->model(array('manager/Project'));
        $this->load->library('form_validation');
        $this->load->helper('date');
    }

    public function index() {

        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data['user_info'] = $this->Project->getData($user);
        $data['projects'] = $this->Project->getAllProjects($user); 
        $data['PM'] = $this->Project->getPM();
        $data['cities'] = $this->Project->getCity();
        $data['task'] = $this->Project->getTask();
        $data['material'] = $this->Project->getMaterial();
        $data['equipment'] = $this->Project->getEquipment();
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $data['mess'] =  $this->Project->count_rr($user2);
        $this->load->view("manager/header.php", $data);
        $this->load->view("manager/project.php", $data);
        $this->load->view("manager/footer.php");

    }

    public function ok_planned_task($id){
        $data = array(
            'status' => date("Y-m-d H:i:s")
        );
        $insert = $this->Project->okP(array('next_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function visible_planned_task($id){
        $data = array(
            'visible' => "false"
        );
        $insert = $this->Project->VP(array('next_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function viewActs($id){
        $data = $this->Project->getNA($id);
        echo json_encode($data);
    }

    function ProjDetails($project_title) {

        $data = $this->Project->getProjDetails($project_title);
        echo json_encode($data);
    }

    function Projs($project_title) {

        $data = $this->Project->getProjs($project_title);
        echo json_encode($data);
    }

    function getOm($project_title) {

        $data = $this->Project->getOM($project_title);
        echo json_encode($data);
    }
    
    function getOe($project_title) {

        $data = $this->Project->getOE($project_title);
        echo json_encode($data);
    }

    function Addworker(){
       
        $addworker = $this->Project->insertWorker();      
    }

    public function ajax_edit($id){
        $data = $this->Project->getp_by_id($id);
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

    public function editachv($id){
        $data = $this->Project->getachv_by_id($id);
        echo json_encode($data);
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

        $list = $this->Project->get_item_id($id);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
           
            $row[] = $mat->material_name;
            $row[] = $mat->mu_quantity.' '.$mat->unit_acro;
            $row[] = $mat->ddate;
             if ($mat->mu_date >= date("Y-m-d")){
                $row[] = '<a class="btn btn-xs btn-primary" title="Edit" onclick="updateMat2('."'".$mat->mu_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Update</a>';
            }
            else{
                $row[] = '<small>cannot be update.</small>';   
            }

            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list3($id){

        $list = $this->Project->get_teu_id($id);
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

        $list = $this->Project->get_eu_id($id);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
            $row[] = $mat->equipment_name;
            $row[] = $mat->eu_quantity;
            $row[] = $mat->ddate;
            $row[] = $mat->supplier_name;
            if ($mat->eu_date >= date("Y-m-d")){
                $row[] = '<a class="btn btn-xs btn-primary" title="Edit" onclick="updateEqpinPro('."'".$mat->eu_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Update</a>';
            }
            else{
                $row[] = '<small>cannot be update.</small>';   
            }

            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list_transmat($id){

        $list = $this->Project->get_tm_id($id);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
            $row[] = $mat->material_name;
            $row[] = $mat->quantity.' '.$mat->unit_acro;

            if ($mat->material_date == date("Y-m-d")){
                $row[] = '<a class="btn btn-xs btn-primary" title="Edit" onclick="updateMat('."'".$mat->stock_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Update</a>';
            }
            else{
                $row[] = '<a class="btn btn-xs btn-primary" title="Edit" onclick="updateMat('."'".$mat->stock_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Update</a>';
            }
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list_recmat($id){

        $list = $this->Project->get_tm_rec($id);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
            $row[] = $mat->material_name;
            $row[] = $mat->transfer_quantity.' '.$mat->unit_acro;
            $row[] = $mat->project_title;
            $row[] = $mat->transfer_date;
            
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list_receqp($id){

        $list = $this->Project->get_eq_rec($id);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
            $row[] = $mat->equipment_name;
            $row[] = $mat->transfer_quantity;
            $row[] = $mat->project_title;
            $row[] = $mat->transfer_date;
            
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list_transeqp($id){

        $list = $this->Project->get_te_id($id);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
            $row[] = $mat->equipment_name;
             $row[] = $mat->quantity;
            $row[] = '<a class="btn btn-xs btn-primary" title="Edit" onclick="updateEqpstock('."'".$mat->equipment_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Update</a>';
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function getTasks($id){
        $list = $this->Project->getTasks($id);
        echo json_encode($list);
    }

    public function getTasksCom($id){
        $list = $this->Project->getTasksCom($id);
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
        
        $insert = $this->Project->addTask($data);
        $insert = $this->Project->addTask2($data2);
        echo json_encode(array("status" => TRUE));
    }

    public function Projs_ac($id){
        $data = array(
                'achv_sub' => $this->input->post('achv_sub'),
                'achv_info' => $this->input->post('achv_des'),
                'achv_date' => date('Y-m-d H:i:s'),
                'project_code' => $id
            );
        $insert = $this->Project->addAchv($data);
        echo json_encode(array("status" => TRUE));
    }

    public function Get_ac($id){
        $list = $this->Project->getAc($id);
        echo json_encode($list);        
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
    
        $insert = $this->Project->addTaskcom($data);
        $insert = $this->Project->addTaskcom2($data2);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit_comment($id){
        $data = $this->Project->getcc_by_id($id);
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

        $this->Project->updatetaskcom(array('prjtsk_comm_id' => $this->input->post('tskidcom1')), $data);
        $insert = $this->Project->updatetaskcom2(array('prjtsk_comm_id' => $this->input->post('tskidcom1').''.date("Ymd")), $data2, $data);  
   

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit_task($id){
        $data = $this->Project->gett_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update_task($id){
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
            'task_id' => $this->input->post('tskname')
        );
             
        $this->Project->updatetask(array('projdtsk_id' => $this->input->post('tskid')), $data);
        $insert = $this->Project->updatetask2(array('updated_task_id' => $this->input->post('tskid').''.date("Ymd")), $data2, $data3);  
       
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit_material($id){
        $data = $this->Project->getm_by_id($id);
        echo json_encode($data);
    }

    public function ajax_edit_material2($id){
        $data = array(
            'id' => $id,
            'date' => date("Y-m-d")
        ); 
        $data = $this->Project->getm_by_id2($data);
        echo json_encode($data);
    }

    public function ajax_update_material($id){
        $this->checkmatQtys();
        $data = array(
            'material_id' => $this->input->post('matid2'),
            'material_quantity' => $this->input->post('matqty')
        ); 

        $data2 = array(
            'mu_id' =>  ('material'.$id.''.$this->input->post('matname').''.date('dmy')),
            'material_id'  => $this->input->post('matid2'),
            'material_quantity' => $this->input->post('matqty')
        ); 

        $data3 = array(
            'project_code' => $id,
            'material_id'  => $this->input->post('matname'),
            'material_date' => date("Y-m-d"),
            'material_quantity' => $this->input->post('matqty'),
            'receiver_from' => 'wrhs',
        );


        $data4 = array(
            'material_id'  => $this->input->post('matname'),
            'quantity' => $this->input->post('matqty'),
            'project_code' => $id,
        );

        $this->Project->updatematstock($data, $data2, $data3, $data4);
        $insert = $this->Project->minusMaterial($data2);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update_materials($id){
        $this->checkmatQty2($id);
        $data = array(
            'material_id' => $this->input->post('matid2'),
            'material_quantity' => $this->input->post('matqty')
        ); 

        $data2 = array(
            'mu_id' =>  ('material'.$id.''.$this->input->post('matname').''.date('dmy')),
            'material_id'  => $this->input->post('matid2'),
            'mu_quantity' => $this->input->post('matqty')
        ); 

        $data3 = array(
            'mu_id' =>  ('material'.$id.''.$this->input->post('matname').''.date('dmy')),
            'project_code' => $id,
            'material_id'  => $this->input->post('matname'),
            'mu_date' => date("Y-m-d"),
            'mu_quantity' => $this->input->post('matqty'),
            'receiver_from' => 'wrhs',
        );


        $data4 = array(
            'material_id'  => $this->input->post('matname'),
            'quantity' => $this->input->post('matqty'),
            'project_code' => $id,
        );

        $this->Project->updatematstock2($data, $data2, $data3, $data4);
       // $insert = $this->Project->minusMaterial2($data2);
        echo json_encode(array("status" => TRUE));
    }

    private function checkmatQty2($id2){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        
        if( intval($this->input->post('matqty')) > intval($this->Project->count_mat($this->input->post('matid2'),$id2)) ){
            $data['inputerror'][] = 'matqty';
            if ($this->Project->count_mat($this->input->post('matid2'),$id2)>0){
                $data['error_string'][] = 'Only '.$this->Project->count_mat($this->input->post('matid2'),$id2).' available';
            }
            else{
                $data['error_string'][] = 'No available but you can request to other Project Manager/Project';
            }
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }

    public function ajax_delete_material($id){
        $this->Project->deletem_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete_achv($id){
        $this->Project->deleteachv_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete_task($id){
        $this->Project->deletett_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_add_equipment($id){
        $this->checkEqty();
        $data = array(
            'project_code' => $id,
            'eu_id' =>  ('equip'.$id.''.$this->input->post('equipname').''.date('dmy')),
            'equipment_id'  => $this->input->post('equipname'),
            'eu_date' => date("Y-m-d"),
            'eu_quantity' => $this->input->post('equipqty')
        );
        
        $insert = $this->Project->addEquipment($data);
        $insert = $this->Project->minusEquipment($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_add_equipment_to_stock($id){
        $this->checkEqty();
        $data = array(
            'project_code' => $id,
            'equipment_id'  => $this->input->post('equipname'),
            'equipment_date' => date("Y-m-d"),
            'equipment_quantity' => $this->input->post('equipqty'),
            'receiver_from' => 'wrhs'
        );
        
        $insert = $this->Project->addEquipmenttostock($data);
        $insert = $this->Project->minusEquipmenttoadmin($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_add_equipment_to_pro($id){
        $this->checkEqtyE2($id);
        $data = array(
            'eu_id'  => $this->input->post('equipname').date('dmy').$id,
            'equipment_id'  => $this->input->post('equipname'),
            'eu_date' => date("Y-m-d"),
            'eu_quantity' => $this->input->post('equipqty'),
            'project_code' => $id,
            'received_from' => 'wrhs'
        );
        
        $insert = $this->Project->addEquipment($data);
        $insert = $this->Project->minusEquipmenttomanager($data);
        echo json_encode(array("status" => TRUE));
    }

    public function checkEqtyE2($id){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        
        if( intval($this->input->post('equipqty')) > intval($this->Project->count_eqp_ons($this->input->post('equipname'), $id)) ){
            $data['inputerror'][] = 'equipqty';
            if ($this->Project->count_eqp_ons($this->input->post('equipname'), $id) >0){
                $data['error_string'][] = 'Only '.$this->Project->count_eqp_ons($this->input->post('equipname'), $id).' available on your stock.';
            }
            else{
                $data['error_string'][] = 'No available but you can request to other Project Manager/Project';
            }
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }

    public function checkEqty(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        
        if( intval($this->input->post('equipqty')) > intval($this->Project->count_eqp($this->input->post('equipname'))) ){
            $data['inputerror'][] = 'equipqty';
            if ($this->Project->count_eqp($this->input->post('equipname'))>0){
                $data['error_string'][] = 'Only '.$this->Project->count_eqp($this->input->post('equipname')).' available';
            }
            else{
                $data['error_string'][] = 'No available but you can request to other Project Manager/Project';
            }
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }

    public function ajax_edit_equipmentinstock($id, $id2){
        $data = $this->Project->getess_by_id($id, $id2);
        echo json_encode($data);
    }

    public function ajax_edit_equipmentinproj($id, $id2){
        $data = $this->Project->getesp_by_id($id, $id2);
        echo json_encode($data);
    }

    public function ajax_update_equipment_in_stock($id){
        $this->checkEqty();
        
        $data = array(
            'project_code' => $id,
            'equipment_id'  => $this->input->post('equipname'),
            'equipment_date' => date('Y-m-d H:i:s'),
            'equipment_quantity' => $this->input->post('equipqty'),
            'receiver_from' => 'wrhs'
        );
        
        $insert = $this->Project->updateEquipmenttostock($data);
        $insert = $this->Project->minusEquipmenttoadmin($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update_equipment ($id){
        $this->checkEqtyE2($id);
        
        $data = array(
            'eu_id'  => $this->input->post('equipname').date('dmy').$id,
            'equipment_id'  => $this->input->post('equipname'),
            'eu_date' => date("Y-m-d"),
            'eu_quantity' => $this->input->post('equipqty'),
            'project_code' => $id,
            'received_from' => 'wrhs'
        );
        
        $insert = $this->Project->updateEquipmenttopro($data);
        $insert = $this->Project->minusEquipmenttomanager($data);
        echo json_encode(array("status" => TRUE));
    }

    private function checkEQty2(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        
        if( intval($this->input->post('equipqty')) > intval($this->Project->count_eqp($this->input->post('equipid2'))) ){
            $data['inputerror'][] = 'equipqty';
            if ($this->Project->count_eqp($this->input->post('equipid2'))>0){
                $data['error_string'][] = 'Only '.$this->Project->count_eqp($this->input->post('equipid2')).' available';
            }
            else{
                $data['error_string'][] = 'No available but you can request to other Project Manager/Project';
            }
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }

    public function ajax_delete_equipment($id){
        $this->Project->deletee_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_get_materials($id){
        $data = $this->Project->getms_by_id($id);
        echo json_encode($data);
    }

    public function ajax_get_equipment_in_stock(){

        $com = $this->session->userdata['logged_in']['company'];
        
        $data = $this->Project->getes_by_id($com);
        echo json_encode($data);
    }

    public function ajax_get_equipment_in_pro($id){
        $data = $this->Project->getep_by_id($id);
        echo json_encode($data);
    }

    public function ajax_get_materialss($id){
        $com = $this->session->userdata['logged_in']['company'];
        
        $data = $this->Project->getmss_by_id($com);
        echo json_encode($data);
    }

    public function ajax_add_materialts($id){
        $this->checkmatQty($id);
        $data = array(
            'project_code' => $id,
            'mu_id'  => $this->input->post('matname').date("Ymd").$id,
            'material_id'  => $this->input->post('matname'),
            'mu_date' => date("Y-m-d"),
            'mu_quantity' => $this->input->post('matqty'),
            'received_from' => 'wrhs',
        );


        $insert = $this->Project->addMaterial2($data);
        $insert = $this->Project->minusMaterial2($data);
        echo json_encode(array("status" => TRUE));
    }

    private function checkmatQty($id2){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        
        if( intval($this->input->post('matqty')) > intval($this->Project->count_mat($this->input->post('matname'),$id2)) ){
            $data['inputerror'][] = 'matqty';
            if ($this->Project->count_mat($this->input->post('matname'),$id2)>0){
                $data['error_string'][] = 'Only '.$this->Project->count_mat($this->input->post('matname'),$id2).' available';
            }
            else{
                $data['error_string'][] = 'No available but you can request to other Project Manager/Project';
            }
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }

    public function ajax_add_material($id){
        $this->checkmatQtys();
        $data = array(
            'project_code' => $id,
            'material_id'  => $this->input->post('matname'),
            'material_date' => date("Y-m-d"),
            'material_quantity' => $this->input->post('matqty'),
            'receiver_from' => 'wrhs',
        );

        $data2 = array(
            'material_id'  => $this->input->post('matname'),
            'quantity' => $this->input->post('matqty'),
            'project_code' => $id,
        );
        
        $insert = $this->Project->addMaterial($data, $data2);
        $insert = $this->Project->minusMaterial($data);
        
        echo json_encode(array("status" => TRUE));
    }

    private function checkmatQtys(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        
        if( intval($this->input->post('matqty')) > intval($this->Project->count_mats($this->input->post('matname'))) ){
            $data['inputerror'][] = 'matqty';
            if ($this->Project->count_mats($this->input->post('matname'))>0){
                $data['error_string'][] = 'Only '.$this->Project->count_mats($this->input->post('matname')).' available';
            }
            else{
                $data['error_string'][] = 'No available but you can request to other Project Manager/Project';
            }
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }

    function ajax_add_nextact($id){
        $data = array(
            'next_id' => $this->input->post('tskname').date("Y-m-d"),
            'nextAct'  => $this->input->post('ncomm'),
            'postDate' => date("Y-m-d"),
            'project_code' => $id,
            'task' => $this->input->post('tskname')
        );

        $insert = $this->Project->addN($data);
        echo json_encode(array("status" => TRUE));
    }
}
