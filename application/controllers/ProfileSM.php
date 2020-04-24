<?php

class ProfileSM extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('senior/Prof_model'));
        $this->load->library('form_validation');
    }
   public function index() {

        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
        $data['cities'] = $this->Prof_model->getCity();
        $data['user_info'] = $this->Prof_model->getData($user);
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $data['mess'] =  $this->Prof_model->count_rr($user2);
        $this->load->view("senior/header.php", $data);
        $this->load->view("senior/profile.php", $data);
        $this->load->view("senior/footer.php");  
   }

  public function upload_file() {
        $status = "";
        $msg = "";
        $file_element_name = 'userfile';

       if ($status != "error") {
        $config['upload_path'] = './assets/upimages/';
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

           $save_path = base_url().'assets/upimages/'.$data['upload_data']['file_name'].$data['file_name'];
           $userid = ($this->session->userdata['logged_in']['user_id']);
           $imagedb = $this->Prof_model->user_img($save_path,$userid);
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

  public function userDetails($user_id) {
        $data = $this->Prof_model->user_details($user_id);
        echo json_encode($data);
  }

  public function editDetails($id) {

        $id = $this->input->post('id');
        $data = array(
          'user_fname' => $this->input->post('fname'),
          'user_mname' => $this->input->post('mname'),
          'user_lname' => $this->input->post('lname'),
          'user_phone' => $this->input->post('phone'),
          'user_address' => $this->input->post('address'),
        );

        $this->Prof_model->update_prof($id,$data);
  }

  public function check_email($id) {

         $mail = $this->input->post('email');
         $this->form_validation->set_rules('email', 'Email', 'is_unique[user.user_email]|required');
         $this->form_validation->set_message('email', 'You must select a business');
         if ($this->form_validation->run() == FALSE):
                echo 'Enter valid email !';          
        else :           
            unset($_POST);
            $this->Prof_model->update_mail($id,$mail);
            $message = "Email Successfully updated! ";
            echo "<script type='text/javascript'>alert('$message');</script>";
        endif;
    
  }

  public function update_password() {
        $config = array(
            array(
                'field'   => 'curPword',
                'label'   => 'curPword',
                'rules'   => 'trim|required|callback_oldpassword_check' // Note: Notice added callback verifier.
            ),
            array(
                'field'   => 'confPword',
                'label'   => 'confPword',
                'rules'   => 'trim|required|matches[newPword]'
            ),
            array(
                'field'   => 'newPword',
                'label'   => 'newPword',
                'rules'   => 'trim|required'
            ));
        $pword = md5($this->input->post('newPword'));
        $id = $this->input->post('userid');
        
        $this->form_validation->set_rules($config);

         if ($this->form_validation->run() == FALSE) {
               echo 'Error in password fields !';  
               echo validation_errors();
         }
         else {
              unset($_POST);
              $this->Prof_model->update_pword($id,$pword);
              $message = "Password successfully  updated! ";
              echo "<script type='text/javascript'>alert('$message');</script>";
          }
  }

  public function oldpassword_check($old_password){
    $id = $this->input->post('userid');
      
       $old_password_hash = md5($old_password);
       $old_password_db_hash = $this->Prof_model->fetch_pwrod($id);
       
       if ($old_password_hash != $old_password_db_hash->user_password) {
          $this->form_validation->set_message('oldpassword_check', 'Old password not match');
          return FALSE;
       }
       else {
          return TRUE;
       }    
  }

}
