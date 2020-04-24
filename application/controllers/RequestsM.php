<?php

class RequestsM extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('manager/Request'));
    }
    
    public function index() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $com =$this->session->userdata['logged_in']['company'];
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $data['user_info'] = $this->Request->getData($user);
        $data['projects'] = $this->Request->getAllProjects($user, $com); 
        $data['worktype'] = $this->Request->getAllWorkerType();
        $data['cities'] = $this->Request->getCity();
        $data['mess'] =  $this->Request->count_rr($user2);
        $data['myprojects'] = $this->Request->getMyProjects($user); 
        $this->load->view("manager/header.php", $data);
        $this->load->view("manager/request.php", $data);
        $this->load->view("manager/footer.php");
    }

    public function check_list($id, $date){
        
    }

    public function seen_notif(){
          
        $this->Request->seennotif($this->session->userdata['logged_in']['user_id'], date("Y-m-d h:i:s"));
        echo json_encode(array("status" => TRUE));
    }

    public function seen_message($id){
        $data = array( 
            'seen_date' =>  date("Y-m-d h:i:s")
        );      
        $this->Request->seen(array('request_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function viewmessage2($id){
        $user = $this->session->userdata['logged_in']['user_id'];
        $c = $this->Request->view_m2($user,$id);
        echo json_encode($c);
    }

    public function viewmessages(){
        $user = $this->session->userdata['logged_in']['user_id'];
        $c = $this->Request->view_ms($user);
        echo json_encode($c);
    }

    public function viewmessage(){
        $user = $this->session->userdata['logged_in']['user_id'];
        $c = $this->Request->view_m($user);
        echo json_encode($c);
    }

    public function ajax_list_transeqp(){
        $id = $this->session->userdata['logged_in']['user_id'];
        $list = $this->Request->get_te_id($id);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
            $row[] = $mat->equipment_name;
            $row[] = $mat->project_title;
            $row[] = $mat->transfer_date;
            $row[] = $mat->transfer_quantity;
            // $row[] = '<a class="btn btn-xs btn-primary" title="Edit" onclick="updateEqp('."'".$mat->transe_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Update</a>
            //         <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteEqp('."'".$mat->transe_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }


    public function ajax_list_transmat(){
        $user = $this->session->userdata['logged_in']['user_id'];
        $list = $this->Request->get_tm_id($user);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
            $row[] = $mat->material_name;
            $row[] = $mat->project_title;
            $row[] = $mat->transfer_date;
            $row[] = $mat->transfer_quantity.' '.$mat->unit_acro;
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function countrecr(){
        $user = $this->session->userdata['logged_in']['user_id'];
        $c = $this->Request->count_rr($user);
        echo json_encode($c);
    }

    public function countmyr(){
        $user = $this->session->userdata['logged_in']['user_id'];
        $c = $this->Request->count_mr($user);
        echo json_encode($c);
    }

    public function newRequest(){
        $data = array(
           'request_severity' => $this->input->post('severity'),
            'material_req' => $this->input->post('mreq'),
            'material_req_stat' => '0',
            'equipment_req' => $this->input->post('ereq'),
            'equipment_req_stat' => '0',
            'worker_req' => $this->input->post('wreq'),
            'worker_req_stat' => '0',
            'req_from' => $this->input->post('prjselectwwww'),
            'req_to' => $this->input->post('prjselectwww'),
            'remarks' => $this->input->post('remarks'),
            'req_stat' => '0',
            'req_date' => date("Y-m-d h:i:s")
        );
        
        $insert = $this->Request->addRequest($data);
        echo json_encode(array("status" => TRUE));
    }

    public function countte(){
        $user = $this->session->userdata['logged_in']['user_id'];
        $c = $this->Request->count_eq($user);
        echo json_encode($c);
    }

    public function ajax_trans_equipment($id){
        $this->checkeqpQty($id);

        $data = array(
            'transe_id' =>  ('transfer'.$this->input->post('transeqpname2').''.date('dmy').''.$this->input->post('prjselecteqp2')),
            'eu_id'  => $this->input->post('transeqpname2'),
            'transfer_date' => date("Y-m-d"),
            'transfer_from' => $this->input->post('prjselecteqp'),
            'transfer_to' => $this->input->post('prjselecteqp2'),
            'transfer_quantity' => $this->input->post('transeqpqty2')
        );

        $data2 = array(
            'project_code' => $this->input->post('prjselecteqp2'),
            'equipment_id'  => $this->input->post('transeqpname2'),
            'equipment_date' => date("Y-m-d"),
            'equipment_quantity' => $this->input->post('transeqpqty2'),
            'receiver_from' => $this->input->post('prjselecteqp')
        );
       
        // $data2 = array(
        //     'project_code' => $this->input->post('prjselecteqp2'),
        //     'eu_id' =>  'equip'.$this->input->post('prjselecteqp').($this->input->post('transeqpname2').''.date('dmy').''.$this->input->post('prjselecteqp2')),
        //     'equipment_id'  => $this->input->post('transeqpname2'),
        //     'eu_date' => date("Y-m-d"),
        //     'eu_quantity' => $this->input->post('transeqpqty2'),
        //     'received_from' => $this->input->post('prjselecteqp')
        // );
        
        $insert = $this->Request->transEquip($data);
        $insert = $this->Request->addEquipment($data2);
        echo json_encode(array("status" => TRUE));
    }

    private function checkeqpQty($prj){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        
        if(intval($this->input->post('transeqpqty2')) > intval($this->Request->count_eqp2($this->input->post('transeqpname2'),$prj))){
            $data['inputerror'][] = 'transeqpqty2';
            if ($this->Request->count_eqp2($this->input->post('transeqpname2'),$prj)>0){
                $data['error_string'][] = 'You only have '.$this->Request->count_eqp2($this->input->post('transeqpname2'),$prj).' available on stock';
            }
            else{
                $data['error_string'][] = 'Unable to transfer, lack of material.';    
            }
        $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }



    public function counttm(){
        $user = $this->session->userdata['logged_in']['user_id'];
        $c = $this->Request->count_tm($user);
        echo json_encode($c);
    }

    public function ajax_trans_material($id){
        $this->checkmatQty($id);
         
        $data = array(
            'project_code' =>$id,
            'material_id'  => $this->input->post('transmatname2'),
            'quantity' => $this->input->post('transmatqty2'),
            'project_code' => $this->input->post('prjselectmat2')
        );

        $data2 = array(
            'project_code' => $this->input->post('prjselectmat2'),
            'material_id'  => $this->input->post('transmatname2'),
            'material_date' => date("Y-m-d"),
            'material_quantity' => $this->input->post('transmatqty2'),
            'receiver_from' => $this->input->post('prjselectmat')
        );

        $data3 = array(
            'transfer_from' => $this->input->post('prjselectmat'),
            'transfer_to' => $this->input->post('prjselectmat2'),
            'transm_id' =>  ('transfer'.$this->input->post('transmatname2').''.date('dmy').''.$this->input->post('prjselectmat2')),
            'mu_id'  => $this->input->post('transmatname2'),
            'transfer_date' => date("Y-m-d"),
            'transfer_quantity' => $this->input->post('transmatqty2')
        );
        
        $insert = $this->Request->addMaterial($data, $data2);
        
        $insert = $this->Request->transMaterial($data3);


        echo json_encode(array("status" => TRUE));
    }

    private function checkmatQty($prj){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        
        if(intval($this->input->post('transmatqty2')) > intval($this->Request->count_mat2($this->input->post('transmatname2'),$prj))){
            $data['inputerror'][] = 'transmatqty2';
            if ($this->Request->count_mat2($this->input->post('transmatname2'),$prj)>0){
                $data['error_string'][] = 'You only have '.$this->Request->count_mat2($this->input->post('transmatname2'),$prj).' available on stock';
            }
            else{
                $data['error_string'][] = 'Unable to transfer, lack of material.';    
            }
        $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }


    public function getMyMat($id){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $list = $this->Request->getmyMat($id,$user);
        echo json_encode($list);
    }

    public function getMyMatc($id,$id3){
        $id2 = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $list = $this->Request->getmyMatc($id, $id2,$id3);
        echo json_encode($list);
    }

    public function getMyEqp($id){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $list = $this->Request->getmyEqp($id,$user);
        echo json_encode($list);
    }

    public function getI($id){
        $list = $this->Request->getI($id);
        echo json_encode($list);
    }

    public function getTasks($id){
        $ii =0;
        $list = $this->Request->getTasks($id);
        if (sizeof($list)>0){
            foreach ($list as $project) {
                $ii += intval($project->projdtsk_percent);
            }
            echo json_encode (array('data' => intval($ii/sizeof($list))));
        }
        else{
            echo json_encode (array('data' => "no recorded task"));
        }
    }
    
    public function getMat($id){
        $list = $this->Request->getMat($id);
        echo json_encode($list);
    }

    public function getEquip($id){
        $list = $this->Request->getEquip($id);
        echo json_encode($list);
    }

    public function ajax_add_wt(){
        $data = array(
            'worker_type_id' => 'work'.$this->input->post('wtname'),
            'woker_type_desc' => $this->input->post('wtname'),
            'worker_type_salary' => $this->input->post('wtsal')
        );
    
        $insert = $this->Request->savewt($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_add_worker(){
        $this->_validateworker();
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data = array(
            //'pworker_id' => 'worker-'.($last+1),
            'pworker_fname' => $this->input->post('workfname'),
            'pworker_mname' => $this->input->post('workmname'),
            'pworker_lname' => $this->input->post('worklname'),
            'pworker_add' => $this->input->post('workaddr'),
            'city_id' => $this->input->post('workcity'),
            'pworker_gender' => $this->input->post('workgender'),
            'civil_status' => $this->input->post('workstat'),
            'user_id' => $user['user_id'],
            'worker_photo' => base_url().'assets/user.png'
        );

        
    
        $insert = $this->Request->saveworker($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update_worker($id){
        $data = array(
            'pworker_fname' => $this->input->post('workfname2'),
            'pworker_mname' => $this->input->post('workmname2'),
            'pworker_lname' => $this->input->post('worklname2'),
            'pworker_add' => $this->input->post('workaddr2'),
            'city_id' => $this->input->post('workcity2'),
            'pworker_gender' => $this->input->post('workgender2'),
            'civil_status' => $this->input->post('workstat2'),
         );

        $insert = $this->Request->updateworker(array('pworker_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    // public function designate($id, $date1,$date2,$date3){
    //     $date = date('Y-m-d h:i:s A');  
        
    //     $data = array(
    //         'pworker_id' => $id.'-'.$date3.'-'.$date1.'-'.$date2,
    //         'worker_type_id' => $this->input->post('dpos'),
    //         'project_code' => $this->input->post('dproj'),
    //         'stat' => $this->input->post('dstatus'),
    //         'time-in' => $date,
    //         'desig_date' => $date3.'-'.$date1.'-'.$date2//,
            
    //     );

    //     $insert = $this->Request->designateworker($data);
    //     echo json_encode(array("status" => TRUE));
    // }

    private function _validateworker(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('workfname') == ''){
            $data['inputerror'][] = 'workfname';
            $data['error_string'][] = 'Firstname is required';
            $data['status'] = FALSE;
        }

       
         if($this->input->post('worklname') == ''){
            $data['inputerror'][] = 'worklname';
            $data['error_string'][] = 'Lastname is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('workaddr') == ''){
            $data['inputerror'][] = 'workaddr';
            $data['error_string'][] = 'Address is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('workcity') == ''){
            $data['inputerror'][] = 'workcity';
            $data['error_string'][] = 'City is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('workstat') == ''){
            $data['inputerror'][] = 'workstat';
            $data['error_string'][] = 'Civil Status is required';
            $data['status'] = FALSE;
        }
       
        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }

    public function last(){
        $ins = $this->Request->countworker();
        echo json_encode($ins, 7);
        return substr($ins, 7);
    }

    public function ajax_list_work( ){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $list = $this->Request->get_worker_id($user);
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
           
            $row[] = '<li><a class="link" title="Edit" onclick="viewWorker('."'".$mat->pworker_id."'".')"><i class="glyphicon glyphicon-doc"></i>'.$mat->pworker_fname.' '.$mat->pworker_mname.' '.$mat->pworker_lname.'</a></li>';
            //$row[] = '<a class="btn btn-xs btn-primary" title="Edit" onclick="viewWorker('."'".$mat->pworker_id."'".')"><i class="glyphicon glyphicon-doc"></i> Display</a>';

            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list_work2($proj, $date1, $date2, $date3){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $list = $this->Request->get_worker_id2($user, $date1, $date2, $date3, $proj );
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
           
            $row[] = $mat->pworker_fname.' '.$mat->pworker_mname.' '.$mat->pworker_lname;
            $row[] = $mat->woker_type_desc;
            $row[] =    '<a class="btn btn-xs btn-primary" title="Edit" onclick="viewWorker('."'".$mat->pworker_id."'".')"><i class="glyphicon glyphicon-doc"></i> Display</a>
                        <a class="btn btn-xs btn-warning" title="Edit" onclick="viewWorker('."'".$mat->pworker_id."'".')"><i class="glyphicon glyphicon-doc"></i> Transfer</a>';

            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function getWorker($id){
        $data = $this->Request->getWorker($id);
        echo json_encode($data);
    }

    public function upload_workimage($id) {
        $status = "";
        $msg = "";
        $file_element_name = 'workfile';

        if ($status != "error") {
            $config['upload_path'] = './assets/worker/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = FALSE;

            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload($file_element_name)){
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            }
            else {
                $data = $this->upload->data();

                $save_path = base_url().'assets/worker/'.$data['upload_data']['file_name'].$data['file_name'];
                $userid = $id;
                $imagedb = $this->Request->worker_img($save_path,$userid);
                $status = "success";
                
                if(file_exists($save_path)) {
                    
                    $msg = "Successfully Updated! ";

                    }
                else {
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
           @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

}
