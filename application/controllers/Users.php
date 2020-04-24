<?php

class Users extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model(array('admin/User'));
    }


    public function index() {
        $userid = ($this->session->userdata['logged_in']['user_id']);
        $data['cities'] = $this->User->getCity();
        $data['usertype'] = $this->User->getUsertypes();
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $data['user_info'] = $this->User->getData($user2);
        $this->load->view("admin/header.php",$data);
        $this->load->view("admin/users.php", $data);
        $this->load->view("admin/footer.php");

    }
        


    public function ajax_list(){
        $userid = ($this->session->userdata['logged_in']['user_id']);
        $userid3 = ($this->session->userdata['logged_in']['company']);
        $list = $this->User->get_datatables($userid, $userid3);
        $data = array();
       
        foreach ($list as $person) {

            $row = array();
            $row[] = $person->user_id;
            $row[] = $person->user_lname.', '.$person->user_fname.' '.$person->user_mname;
            $row[] = $person->user_email;
            $row[] = $person->user_address.', '.$person->city_name.', '.$person->province_name;
            $row[] = $person->user_status;
            $row[] = $person->usertype_name;

            //add html for action
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->user_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>      <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->user_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }


    public function ajax_edit($id){
        $data = $this->User->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add(){
        $this->_validate();

        $data = array(
            'user_fname' => $this->input->post('uaddfname'),
            'user_mname' => $this->input->post('uaddmname'),
            'user_lname' => $this->input->post('uaddlname'),
            'user_email' => $this->input->post('uaddemail'),
            'user_address' => $this->input->post('uaddaddr'),
            'city_id' => $this->input->post('uaddcity'),
            'user_status' => $this->input->post('uaddstat'),
            'usertype_id' => $this->input->post('uaddut'),
            'user_photo' => base_url().'assets/user.png',
            'user_password' => md5('12345678'),
            'registered_date' => date("Y-m-d h:i:s"),
            'company' => $this->input->post('company')
        );
    
        $insert = $this->User->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update(){
        $this->_validate();
        $data = array(

            'user_fname' => $this->input->post('uaddfname'),
            'user_mname' => $this->input->post('uaddmname'),
            'user_lname' => $this->input->post('uaddlname'),
            'user_email' => $this->input->post('uaddemail'),
            'user_address' => $this->input->post('uaddaddr'),
            'city_id' => $this->input->post('uaddcity'),
            'user_status' => $this->input->post('uaddstat'),
            'usertype_id' => $this->input->post('uaddut'),
            );
        $this->User->update(array('user_id' => $this->input->post('uaddid')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id){
        $this->User->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 

        if($this->input->post('uaddfname') == '')
        {
            $data['inputerror'][] = 'uaddfname';
            $data['error_string'][] = 'First name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('uaddlname') == '')
        {
            $data['inputerror'][] = 'uaddlname';
            $data['error_string'][] = 'Last name is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('uaddmname') == '')
        {
            $data['inputerror'][] = 'uaddmname';
            $data['error_string'][] = 'Middle name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('uaddemail') == '')
        {
            $data['inputerror'][] = 'uaddemail';
            $data['error_string'][] = 'Email is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('uaddaddr') == '')
        {
            $data['inputerror'][] = 'uaddaddr';
            $data['error_string'][] = 'Address is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('uaddcity') == '')
        {
            $data['inputerror'][] = 'uaddcity';
            $data['error_string'][] = 'City is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('uaddut') == '')
        {
            $data['inputerror'][] = 'uaddut';
            $data['error_string'][] = 'Usertype is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('uaddstat') == '')
        {
            $data['inputerror'][] = 'uaddstat';
            $data['error_string'][] = 'Status is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function contacts(){
        $userid = ($this->session->userdata['logged_in']['user_id']);
        $userid2 = ($this->session->userdata['logged_in']['company']);
        $list = $this->User->get_datatables($userid, $userid2);

        echo json_encode($list);
    }
}
