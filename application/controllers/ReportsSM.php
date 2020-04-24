<?php

class ReportsSM extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('senior/Report'));
        $this->load->library('form_validation');
    }

    public function index() {
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $com = $this->session->userdata['logged_in']['company'];

        $data['projects'] = $this->Report->getAllProjects($user, $com); 
        $data['user_info'] = $this->Report->getData($user);
        $data['task'] = $this->Report->getTask();
        $this->load->view("senior/header.php", $data);
        $this->load->view("senior/report.php", $data);
        $this->load->view("senior/footer.php");
    }

    function ProjDetails($project_title) {

        $data = $this->Report->getProjDetails($project_title);
        echo json_encode($data);
    }

    function actDetails($project_title, $date, $date2,$date3 ) {

        $data = $this->Report->getActDetails($project_title, $date, $date2,$date3);
        echo json_encode($data);
    }

    function actcomm($project_title, $date, $date2,$date3 ) {

        $data = $this->Report->getActCom($project_title, $date, $date2,$date3);
        echo json_encode($data);
    }

    function actcomm2($project_title, $date, $date2,$date3 ) {

        $data = $this->Report->getActCom2($project_title, $date, $date2,$date3);
        echo json_encode($data);
    }


    function EUDetails($project_title, $date, $date2,$date3 ) {

        $data = $this->Report->getEUDetails($project_title, $date, $date2,$date3);
        echo json_encode($data);
    }

    function EUDetails1($project_title, $date, $date2,$date3 ) {

        $data = $this->Report->getEUDetails1($project_title, $date, $date2,$date3);
        echo json_encode($data);
    }

    function MUDetails($project_title, $date, $date2,$date3 ) {

        $data = $this->Report->getMUDetails($project_title, $date, $date2,$date3);
        echo json_encode($data);
    }

    function MUDetails2($project_title, $date, $date2,$date3 ) {

        $data = $this->Report->getMUDetails2($project_title, $date, $date2,$date3);
        echo json_encode($data);
    }

    function WRKDetails($project_title, $date, $date2,$date3 ) {

        $data = $this->Report->getWorkDetails($project_title, $date, $date2,$date3);
        $json = array_count_values(array_filter(array_column($data, "description")));
        echo json_encode($json);
    }

    function WandTDetails($project_title, $date, $date2,$date3 ) {

        $data = $this->Report->getWandTDetails($project_title, $date, $date2,$date3);
        echo json_encode($data);
    }

    function PhotoDetails($project_title, $date, $date2,$date3) {

        $data = $this->Report->getPhotoDetails($project_title, $date, $date2,$date3);
        echo json_encode($data);
    }

    function ajax_add_weather($id, $date, $date2, $date3){
        $data = array(
            'project_code' => $id,
            'weather'  => $this->input->post('repweather'),
            'temperature' => $this->input->post('reptemp'),
            'rep_date' => $date3.'-'.$date.'-'.$date2,
            'reportid' => 'rep'.''.$id.''.$date3.''.$date.''.$date2
        );

         $data2 = array(
            'weather'  => $this->input->post('repweather'),
            'temperature' => $this->input->post('reptemp')
        );

        $this->Report->addW(array('reportid' => 'rep'.''.$id.''.$date3.''.$date.''.$date2), $data, $data2);
        echo json_encode(array("status" => TRUE));
    }

    function ajax_add_worker($id,$date, $date2, $date3 ){
        $data = array(
            'projdtsk_id' => 'work'.''.$id.''.$this->input->post('repwrk').''.$date3.''.$date.''.$date2,
            'worker_title'  => $this->input->post('repwrk'),
            'worker_quantity' => $this->input->post('repqty'),
            'worker_date' => $date3.'-'.$date.'-'.$date2,
            'project_code' => $id
        );

       
        $insert = $this->Report->addWRk($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit_work($id){
        $data = $this->Report->getw_by_id($id);
        echo json_encode($data);
    }

    function ajax_update_worker(){
        $data = array(
           'worker_quantity' => $this->input->post('repqty'),
        );            

        $this->Report->upW(array('projdtsk_id' => $this->input->post('wrkid')), $data);
        echo json_encode(array("status" => TRUE));
    }


    public function upload_file($id, $date, $date2, $date3 ) {
        
                    
        $status = "";
        $msg = "";
        $file_element_name = 'userfile';
         

        if ($status != "error") {
            $config['upload_path'] = './assets/project_photo/';
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
                    $save_path = base_url().'assets/project_photo/'.$data['upload_data']['file_name'].$data['file_name'];
                    $dd = $data['file_name'];
                    $imagedb = $this->Report->project_img($save_path,$id,$dd, $date, $date2, $date3 );
                    $status = "success";
                    
                    if(file_exists($save_path)) {
                        $msg = "Successfully Updated! ";
                        echo "<script type='text/javascript'>$('#modal_profile2').modal('hide');new PNotify({  title: 'Hey!',  text: 'Photo added successfully! To see changes please re-login.', type: 'info', styling: 'bootstrap3'});</script>";

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


    public function upload_file2($id){

        $data2 = array(
            'photo_comment'  => $this->input->post('comm')
        );

        $this->Report->addP(array('project_code' => $id), $data, $data2);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_editp($id){
        $data = $this->Report->getph_by_id($id);
        echo json_encode($data);
    }

    function ajax_add_comment(){
        $data = array(
            'photo_comment' => $this->input->post('comm'),
        );

       
        $this->Report->addPP(array('photo_id' => $this->input->post('pid')), $data);
        echo json_encode(array("status" => TRUE));
    }

    function NXTDetails($project_title, $date, $date2,$date3 ) {

        $data = $this->Report->getNXTDetails($project_title, $date, $date2,$date3);
        echo json_encode($data);
    }


    function ajax_add_nextact($id,$date, $date2, $date3 ){
        $data = array(
            'next_id' => $this->input->post('tskname').$date3.'-'.$date.'-'.$date2,
            'nextAct'  => $this->input->post('ncomm'),
            'postDate' => $date3.'-'.$date.'-'.$date2,
            'project_code' => $id,
            'task' => $this->input->post('tskname')
        );

       
        $insert = $this->Report->addN($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit_N($id){
        $data = $this->Report->getnn_by_id($id);
        echo json_encode($data);
    }

    function ajax_update_nextAct(){
        $data = array(
           'nextAct' => $this->input->post('ncomm'),
        );            

        $this->Report->upN(array('next_id' => $this->input->post('nid')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete_work($id){
        $this->Report->deletew_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete_next($id){
        $this->Report->deletenn_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
}