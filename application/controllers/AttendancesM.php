<?php

class AttendancesM extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('date');
        $this->load->model(array('manager/Attendance'));
    }

    public function index() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data['user_info'] = $this->Attendance->getData($user);
        $data['projects'] = $this->Attendance->getAllProjects($user); 
        $data['worktype'] = $this->Attendance->getAllWorkerType();
        $data['cities'] = $this->Attendance->getCity();
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $data['mess'] =  $this->Attendance->count_rr($user2);
        $this->load->view("manager/header.php", $data);
        $this->load->view("manager/attendance.php", $data);
        $this->load->view("manager/footer.php");
    }

    public function ajax_add_wt(){
        $data = array(
            'worker_type_id' => 'work'.$this->input->post('wtname'),
            'woker_type_desc' => $this->input->post('wtname'),
            'worker_type_salary' => $this->input->post('wtsal')
        );
    
        $insert = $this->Attendance->savewt($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_add_worker(){
        $this->_validateworker();
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data = array(
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

        
    
        $insert = $this->Attendance->saveworker($data);
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

        $insert = $this->Attendance->updateworker(array('pworker_id' => $id), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function designate($id, $date1,$date2,$date3){
        $date = date('Y-m-d h:i:s A');  
        
        $data = array(
            'pworker_id' => $id,
            'worker_type_id' => $this->input->post('dpos'),
            'project_code' => $this->input->post('dproj'),
            'stat' => $this->input->post('dstatus'),
            'time-in' => $date,
            'desig_date' => $date3.'-'.$date1.'-'.$date2//,
            
        );

        $insert = $this->Attendance->designateworker($data);
        echo json_encode(array("status" => TRUE));
    }

    public function designateTrans($id, $date1,$date2,$date3){
         
        $data = array(
            'pworker_id' => $id,
            'desig_date' => $date3.'-'.$date1.'-'.$date2
        );

        $data1 = array(
            'worker_type_id' => $this->input->post('dpos'),
        );

        $data2 = array(
            'project_code' => $this->input->post('dproj'),
        );

        $data3 = array(
            'stat' => $this->input->post('dstatus'),
        );



        $insert = $this->Attendance->designateworkerTrans($data,$data1,$data2,$data3 );
        echo json_encode(array("status" => TRUE));
    }


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
        $ins = $this->Attendance->countworker();
        echo json_encode($ins, 7);
        return substr($ins, 7);
    }

    public function ajax_list_work($date1, $date2, $date3){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $list = $this->Attendance->get_worker_id($user);
            
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
            
            if ($this->Attendance->checkD($mat->pworker_id, $date1, $date2, $date3) == NULL){
                $row[] = '<li><a class="link" title="Edit" onclick="viewWorker('."'".$mat->pworker_id."'".')"><i class="glyphicon glyphicon-doc"></i>'.$mat->pworker_fname.' '.$mat->pworker_mname.' '.$mat->pworker_lname.'</a></li>';
            }
            else{
                $row[]= '<li>'.$mat->pworker_fname.' '.$mat->pworker_mname.' '.$mat->pworker_lname.' - assigned already.</li>';
            }
            
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list_work2($proj, $date1, $date2, $date3){
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $list = $this->Attendance->get_worker_id2($user, $date1, $date2, $date3, $proj );
        $data = array();
       
        foreach ($list as $mat) {

            $row = array();
           
            $row[] = $mat->pworker_fname.' '.$mat->pworker_mname.' '.$mat->pworker_lname;
            $row[] = $mat->woker_type_desc;
            $row[] =    //'<a class="btn btn-xs btn-primary" title="Edit" onclick="viewWorker('."'".$mat->pworker_id."'".')"><i class="glyphicon glyphicon-doc"></i> Display</a>
                        '<a class="btn btn-xs btn-warning" title="Edit" onclick="viewWorkerAss('."'".$mat->pworker_id."'".')"><i class="glyphicon glyphicon-doc"></i> Transfer</a>';

            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function getWorker($id){
        $data = $this->Attendance->getWorker($id);
        echo json_encode($data);
    }

    public function getWorkerAss($id, $date1, $date2, $date3){
        $data = $this->Attendance->getWorkerAss($id, $date1, $date2, $date3);
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
                $imagedb = $this->Attendance->worker_img($save_path,$userid);
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
