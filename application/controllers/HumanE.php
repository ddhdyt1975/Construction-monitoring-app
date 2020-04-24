<?php

class HumanE extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model(array('hr/Employee'));
    }

    public function index() {
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $user3 = $this->session->userdata['logged_in']['company'];
        $data['cities'] = $this->Employee->getCity();
        $data['user_info'] = $this->Employee->getData($user2);
        $data['positions'] = $this->Employee->getPosition();
        $data['projects'] = $this->Employee->getAllProjects($user2, $user3); 
       
        $this->load->view("hr/header.php",$data);
        $this->load->view("hr/employee.php",$data);
        $this->load->view("hr/footer.php");
    }

    public function ajax_list(){
        $userid2 = ($this->session->userdata['logged_in']['company']);
        $list = $this->Employee->get_datatables($userid2);
        $data = array();
        foreach ($list as $supplier) {
            $row = array();
            $row[] = $supplier->pworker_id;
            $row[] = $supplier->pworker_fname.' '.$supplier->pworker_mname.' '.$supplier->pworker_lname;
            // $row[] = $supplier->pworker_add.', '.$supplier->city_name.', '.$supplier->province_name.', '.$supplier->zip_code;
            $row[] = $supplier->alias;
            $row[] = '<a class="btn btn-xs btn-success"  title="DTR Adjustments" onclick="dtradj('."'".$supplier->pworker_id."'".')"><i class="glyphicon glyphicon-wrench"></i> DTR</a> <a class="btn btn-xs btn-primary"  data-toggle="tooltip" data-placement="bottom" title="Update '.$supplier->pworker_id.'"  title="Edit this "'. $supplier->pworker_id.'"" onclick="edit_emp('."'".$supplier->pworker_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
              <a class="btn btn-xs btn-danger"  data-toggle="tooltip" data-placement="bottom" title="Delete '.$supplier->pworker_id.'" onclick="del_emp('."'".$supplier->pworker_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_add_employee(){        
        $this->_validate();
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $user3 = $this->session->userdata['logged_in']['company'];
        $date = date('Y-m-d H:i:s');
        if ($_FILES['file']['error'] !== 4){
                $config['upload_path'] = './assets/worker/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 1024 * 12;
                $this->load->library('upload', $config);
                if($this->upload->do_upload("file")) {
                    $upload_data = $this->upload->data();
                    $file_name =   base_url().'assets/worker/'.$upload_data['file_name'];
                      $data = array(
                        'pworker_id' => $this->input->post('worker_id'),            
                        'pworker_fname' => $this->input->post('efname'),                
                        'pworker_mname' => $this->input->post('emname'),
                        'pworker_lname' => $this->input->post('elname'),
                        'pworker_add' => $this->input->post('eaddress'),
                        'city_id' => $this->input->post('ecity'),
                        'pworker_gender' => $this->input->post('egender'),
                        'civil_status' => $this->input->post('ecivilstat'),
                        'worker_photo' => $file_name,
                        'user_id' => $user2,
                        'dob' => $this->input->post('ebdate'),
                        'contact_no' => $this->input->post('ephone'),
                        'sss' => $this->input->post('esss'),
                        'philhealth' => $this->input->post('ephil'),
                        'pag_ibig' => $this->input->post('epagibig'),
                        'bank_no' => $this->input->post('ebanknum'),
                        'status' => $this->input->post('estatus'),
                        'height'  => $this->input->post('eheight'),
                        'weight' => $this->input->post('eweight'),
                        'blood_type' => $this->input->post('eblood'),
                        'tin_number' => $this->input->post('etin'),
                        'tax_code' => $this->input->post('etax'),
                        'worker_type_id' => $this->input->post('eposition'), 
                        'company_id' => $user3, 
                        'created' => $date,            
                    );
                    $insert = $this->Employee->save($data);
                    echo json_encode(array("status" => TRUE));  
                }
        }
        else {
             $file_name = base_url().'assets/worker/worker6.png';
             $data = array(

                        'pworker_id' => $this->input->post('worker_id'),            
                        'pworker_fname' => $this->input->post('efname'),                
                        'pworker_mname' => $this->input->post('emname'),
                        'pworker_lname' => $this->input->post('elname'),
                        'pworker_add' => $this->input->post('eaddress'),
                        'city_id' => $this->input->post('ecity'),
                        'pworker_gender' => $this->input->post('egender'),
                        'civil_status' => $this->input->post('ecivilstat'),
                        'worker_photo' => $file_name,
                        'user_id' => $user2,
                        'dob' => $this->input->post('ebdate'),
                        'contact_no' => $this->input->post('ephone'),
                        'sss' => $this->input->post('esss'),
                        'philhealth' => $this->input->post('ephil'),
                        'pag_ibig' => $this->input->post('epagibig'),
                        'bank_no' => $this->input->post('ebanknum'),
                        'status' => $this->input->post('estatus'),
                        'height'  => $this->input->post('eheight'),
                        'weight' => $this->input->post('eweight'),
                        'blood_type' => $this->input->post('eblood'),
                        'tin_number' => $this->input->post('etin'),
                        'tax_code' => $this->input->post('etax'),          
                        'worker_type_id' => $this->input->post('eposition'), 
                        'company_id' => $user3, 
                        'created' => $date,            
                    );
                    $insert = $this->Employee->save($data);
                    echo json_encode(array("status" => TRUE)); 
            
        }
                    
   }

   public function ajax_update_employee(){
       // $this->_validate();
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $user3 = $this->session->userdata['logged_in']['company'];
        $date = date('Y-m-d H:i:s');
        if ($_FILES['file']['error'] !== 4){
                $config['upload_path'] = './assets/worker/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 1024 * 12;
                $this->load->library('upload', $config);
                if($this->upload->do_upload("file")) {
                    $upload_data = $this->upload->data();
                    $file_name =   base_url().'assets/worker/'.$upload_data['file_name'];
                      $data = array(            
                        'pworker_fname' => $this->input->post('efname'),                
                        'pworker_mname' => $this->input->post('emname'),
                        'pworker_lname' => $this->input->post('elname'),
                        'pworker_add' => $this->input->post('eaddress'),
                        'city_id' => $this->input->post('ecity'),
                        'pworker_gender' => $this->input->post('egender'),
                        'civil_status' => $this->input->post('ecivilstat'),
                        'worker_photo' => $file_name,
                        'user_id' => $user2,
                        'dob' => $this->input->post('ebdate'),
                        'contact_no' => $this->input->post('ephone'),
                        'sss' => $this->input->post('esss'),
                        'philhealth' => $this->input->post('ephil'),
                        'pag_ibig' => $this->input->post('epagibig'),
                        'bank_no' => $this->input->post('ebanknum'),
                        'status' => $this->input->post('estatus'),
                        'height'  => $this->input->post('eheight'),
                        'weight' => $this->input->post('eweight'),
                        'blood_type' => $this->input->post('eblood'),
                        'tin_number' => $this->input->post('etin'),
                        'tax_code' => $this->input->post('etax'),            
                        'worker_type_id' => $this->input->post('eposition'), 
                        'company_id' => $user3,                                 
                    );
                   $this->Employee->update(array('pworker_id' => $this->input->post('worker_id')), $data);
                   echo json_encode(array("status" => TRUE)); 
                }
        }
        else {            
             $data = array(            
                        'pworker_fname' => $this->input->post('efname'),                
                        'pworker_mname' => $this->input->post('emname'),
                        'pworker_lname' => $this->input->post('elname'),
                        'pworker_add' => $this->input->post('eaddress'),
                        'city_id' => $this->input->post('ecity'),
                        'pworker_gender' => $this->input->post('egender'),
                        'civil_status' => $this->input->post('ecivilstat'),                        
                        'user_id' => $user2,
                        'dob' => $this->input->post('ebdate'),
                        'contact_no' => $this->input->post('ephone'),
                        'sss' => $this->input->post('esss'),
                        'philhealth' => $this->input->post('ephil'),
                        'pag_ibig' => $this->input->post('epagibig'),
                        'bank_no' => $this->input->post('ebanknum'),
                        'status' => $this->input->post('estatus'),
                        'height'  => $this->input->post('eheight'),
                        'weight' => $this->input->post('eweight'),
                        'blood_type' => $this->input->post('eblood'),
                        'tin_number' => $this->input->post('etin'),
                        'tax_code' => $this->input->post('etax'),            
                        'worker_type_id' => $this->input->post('eposition'), 
                        'company_id' => $user3,                                  
                    );
            $this->Employee->update(array('pworker_id' => $this->input->post('worker_id')), $data);
            echo json_encode(array("status" => TRUE)); 
        }        
    }

   private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('worker_id') == ''){
            $data['inputerror'][] = 'worker_id';
            $data['error_string'][] = 'Worker ID is required';
            $data['status'] = FALSE;
        }   

        if($this->input->post('efname') == ''){
            $data['inputerror'][] = 'efname';
            $data['error_string'][] = 'First name is required';
            $data['status'] = FALSE;
        }   
        if($this->input->post('emname') == ''){
            $data['inputerror'][] = 'emname';
            $data['error_string'][] = 'Middle name is required';
            $data['status'] = FALSE;
        }  
        // if($this->input->post('elname') == ''){
        //     $data['inputerror'][] = 'elname';
        //     $data['error_string'][] = 'Last name is required';
        //     $data['status'] = FALSE;
        // } 
        if($this->input->post('eposition') == ''){
            $data['inputerror'][] = 'eposition';
            $data['error_string'][] = 'Position is required';
            $data['status'] = FALSE;
        } 
         
        // if($this->input->post('eaddress') == ''){
        //     $data['inputerror'][] = 'eaddress';
        //     $data['error_string'][] = 'Address is required';
        //     $data['status'] = FALSE;
        // }  
        // if($this->input->post('ecity') == ''){
        //     $data['inputerror'][] = 'ecity';
        //     $data['error_string'][] = 'City is required';
        //     $data['status'] = FALSE;
        // }  
        // if($this->input->post('egender') == ''){
        //     $data['inputerror'][] = 'egender';
        //     $data['error_string'][] = 'Gender is required';
        //     $data['status'] = FALSE;
        // }  
        // if($this->input->post('ecivilstat') == ''){
        //     $data['inputerror'][] = 'ecivilstat';
        //     $data['error_string'][] = 'Civil status is required';
        //     $data['status'] = FALSE;
        // }  
        // if($this->input->post('ebdate') == ''){
        //     $data['inputerror'][] = 'ebdate';
        //     $data['error_string'][] = 'Birthdate is required';
        //     $data['status'] = FALSE;
        // }  
        // if($this->input->post('ephone') == ''){
        //     $data['inputerror'][] = 'ephone';
        //     $data['error_string'][] = 'Phone number is required';
        //     $data['status'] = FALSE;
        // }  
        // if($this->input->post('estatus') == ''){
        //     $data['inputerror'][] = 'estatus';
        //     $data['error_string'][] = 'Status is required';
        //     $data['status'] = FALSE;
        // }  
        // if($this->input->post('eposition') == ''){
        //     $data['inputerror'][] = 'eposition';
        //     $data['error_string'][] = 'Position is required';
        //     $data['status'] = FALSE;
        // }
        // if($this->input->post('eheight') == ''){
        //     $data['inputerror'][] = 'eheight';
        //     $data['error_string'][] = 'Height is required';
        //     $data['status'] = FALSE;
        // }
        // if($this->input->post('eweight') == ''){
        //     $data['inputerror'][] = 'eweight';
        //     $data['error_string'][] = 'Weight is required';
        //     $data['status'] = FALSE;
        // }  

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function ajax_edit($id){
        $data = $this->Employee->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_delete($id){
        $this->Employee->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    // public function ajax_list(){
    //     $user3 = $this->session->userdata['logged_in']['company'];

    //     $list = $this->Dashboard->get_datatables($user3);
    //     $data = array();
       
    //     foreach ($list as $project) {

    //         $row = array();
    //         $row[] = $project->project_code;
    //         $row[] = '<b>'.$project->project_title.'</b>';
    //         $row[] = '<small>'.$project->project_desc.'</small>';
    //         $row[] = '<b>'.$project->user_fname.' '.$project->user_lname.'</b>';
    //         $row[] = $project->project_address.', '.$project->city_name.', '.$project->province_name.', '.$project->zip_code;

    //         $data[] = $row;
    //     }

    //     $output = array(   
    //         "data" => $data,
    //     );

    //     echo json_encode($output);
    // }

    // public function getProjects(){
    //     $user3 = $this->session->userdata['logged_in']['company'];

    //     $list = $this->Dashboard->getProjects2($user3);
    //     echo json_encode($list);
    // }

    // public function ajax_list2() {
    //     $com = $this->session->userdata['logged_in']['company'];

    //     $list = $this->Dashboard->get_datatables2($com);
    //     $data = array();
       
    //     foreach ($list as $material) {

    //         $row = array();
    //         $row[] = $material->material_id;
    //         $row[] = $material->material_name;
    //         $row[] = $material->material_quantity.' '.$material->material_unit;
    //         $row[] = $material->material_status;
    //         $row[] = $material->material_status;
    //         $row[] = $material->supplier_name;
    //         $row[] = $material->ddate;
    //         $row[] = $material->material_comment;
           
     
    //         $data[] = $row;
    //     }

    //     $output = array(   
    //         "data" => $data,
    //     );

    //     echo json_encode($output);
    // }

    // public function ajax_list3(){
    //     $com = $this->session->userdata['logged_in']['company'];
    //     $list = $this->Dashboard->get_datatables3($com);
    //     $data = array();
       
    //     foreach ($list as $equip) {

    //         $row = array();
    //         $row[] = $equip->equipment_id;
    //         $row[] = $equip->equipment_name;
    //         $row[] = $equip->supplier_name;
    //         $row[] = $equip->ddate;
    //         $row[] = $equip->equipment_quantity;
    //         $row[] = $equip->equipment_status;
    //         $row[] = $equip->equipment_comment;

          
    //         $data[] = $row;
    //     }

    //     $output = array(   
    //         "data" => $data,
    //     );

    //     echo json_encode($output);
    // }


    // public function ajax_list4(){
    //     $com = $this->session->userdata['logged_in']['company'];
    //     $list = $this->Dashboard->get_datatables4($com);
    //     $data = array();
       
    //     foreach ($list as $supplier) {

    //         $row = array();
    //         $row[] = $supplier->supplier_id;
    //         $row[] = $supplier->supplier_name;
    //         $row[] = $supplier->supplier_address.', '.$supplier->city_name.', '.$supplier->province_name.', '.$supplier->zip_code;
         
    //         $data[] = $row;
    //     }

    //     $output = array(   
    //         "data" => $data,
    //     );

    //     echo json_encode($output);
    // }


    // public function ajax_list5(){
    //     $userid = ($this->session->userdata['logged_in']['user_id']);
    //     $userid2 = ($this->session->userdata['logged_in']['company']);
        
    //     $list = $this->Dashboard->get_datatables5($userid, $userid2);
    //     $data = array();
       
    //    foreach ($list as $person) {

    //         $row = array();
    //         $row[] = "<b>".$person->name."</b>";
    //         $row[] = $person->user_email;
    //         $row[] = $person->usertype_name;
    //         $row[] = $person->addr;
    //         $row[] = $person->ddate;
          
            
    //         $data[] = $row;
    //     }
        
    //     $output = array(   
    //         "data" => $data,
    //     );

    //     echo json_encode($output);
    // }

    //  public function ajax_list51(){
    //     $userid = ($this->session->userdata['logged_in']['user_id']);
        
    //     $list = $this->Dashboard->get_datatables51($userid);
    //     echo json_encode($list);
    // }

    // public function getTasks($id){
    //     $list = $this->Dashboard->getTasks($id);
    //     echo json_encode($list);
    // }


}
