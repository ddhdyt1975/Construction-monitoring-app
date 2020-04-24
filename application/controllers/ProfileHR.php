<?php
class ProfileHR extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('hr/Profile'));
        $this->load->library('form_validation');
    }


    public function index() {
        $userid = ($this->session->userdata['logged_in']['user_id']);
        $data['city'] = $this->Profile->getCity();
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $data['user_info'] = $this->Profile->getData($user2);
        $this->load->view("hr/header.php",$data);
        $this->load->view("hr/profile.php", $data);
        $this->load->view("hr/footer.php");
    }

    public function getProjects(){
        $list = $this->Profile->getProjects();
        echo json_encode($list);
    }


    public function upload_file() {
         
        $file_element_name = 'userfile';
        $status="";
       if ($status != "error") {
        $config['upload_path'] = './assets/upimages/';
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
           var_dump($data);
           $save_path = base_url().'assets/upimages/'.$data['upload_data']['file_name'].$data['file_name'];
           $userid = ($this->session->userdata['logged_in']['user_id']);
           $imagedb = $this->Profile->user_img($save_path,$userid);
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

    public function ajax_update() {
     
        $userid = ($this->session->userdata['logged_in']['user_id']);
        $data = array(
            'user_fname' => $this->input->post('myfname'),
            'user_mname' => $this->input->post('mymname'),
            'user_lname' => $this->input->post('mylname'),
            'user_address' => $this->input->post('myadd'),
            'city_id' => $this->input->post('mycity'),
            'user_phone' => $this->input->post('mynum')
            );

        
      
        $this->Profile->update(array('user_id' => $userid), $data);
 
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit_p(){
        $userid = ($this->session->userdata['logged_in']['user_id']);
        $data = $this->Profile->getp_by_id($userid);
        echo json_encode($data);
    }

    public function update_password() {
        $config = array(
            array(
                'field'   => 'curPword',
                'label'   => 'curPword',
                'rules'   => 'trim|required|callback_oldpassword_check'  
            ),
            array(
                'field'   => 'confPword',
                'label'   => 'New Password',
                'rules'   => 'trim|required|matches[newPword]'
            ),
            array(
                'field'   => 'newPword',
                'label'   => 'Confirm Password',
                'rules'   => 'trim|required'
            ));
        $pword = md5($this->input->post('newPword'));
        $id = ($this->session->userdata['logged_in']['user_id']);
        $email = $this->input->post('myemail');
        
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
               echo 'ERROR!';  
               echo validation_errors();
        }
        else {
              unset($_POST);
              $this->Profile->update_pword($id,$pword, $email);
              $message = "Password successfully  updated! ";
              echo "<script type='text/javascript'>$('#modal_profile2').modal('hide');new PNotify({  title: 'Update Status',  text: 'Password successfully  updated! To see changes please re-login.', type: 'success', styling: 'bootstrap3'});</script>";
        }
    }

    public function oldpassword_check($old_password){
        $id = ($this->session->userdata['logged_in']['user_id']);
      
        $old_password_hash = md5($old_password);
        $old_password_db_hash = $this->Profile->fetch_pwrod($id);
       
        if ($old_password_hash != $old_password_db_hash->user_password) {
            $this->form_validation->set_message('oldpassword_check', 'Old password not match');
            return FALSE;
        }
        else {
            return TRUE;
        }    
    }


}
