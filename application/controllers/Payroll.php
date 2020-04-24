<?php

class Payroll extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('admin/Payroll_Model'));      
        $this->load->library('form_validation');
   }

   public function index() {

        $user = $this->session->userdata['logged_in']['user_id']; 
        $user3 = $this->session->userdata['logged_in']['company'];     
        $data['user_info'] = $this->Payroll_Model->getData($user);
        $data['projects'] = $this->Payroll_Model->getAllProjects($user, $user3); 

        $this->load->view("admin/header.php",$data);
        $this->load->view("admin/payroll.php",$data);
        $this->load->view("admin/footer.php");  
   }

   public function ajax_list(){        
        $list = $this->Payroll_Model->get_datatables();
        $data = array();
        foreach ($list as $additional) {
            $row = array();            
            $row[] = $additional->description;            
            $row[] = $additional->note;
            $row[] = $additional->created;
            $row[] = $additional->updated;
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit Additionals Information" onclick="edit_additional('."'".$additional->additionaltype_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>                 
                <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Delete this Additionals" onclick="delete_additional('."'".$additional->additionaltype_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            $data[] = $row;
                 // <a class="btn btn-xs btn-success" href="javascript:void(0)" title="Add materials & equipments" onclick="add_new('."'".$supplier->supplier_id."'".')"><i class="glyphicon glyphicon-plus"></i> Add</a>
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_list1(){        
        $list = $this->Payroll_Model->get_datatables1();
        $data = array();
        foreach ($list as $deductions) {
            $row = array();            
            $row[] = $deductions->description;            
            $row[] = $deductions->note;
            $row[] = $deductions->created;
            $row[] = $deductions->updated;
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit Additionals Information" onclick="edit_deduction('."'".$deductions->deductiontype_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>                 
                <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Delete this Additionals" onclick="delete_deduction('."'".$deductions->deductiontype_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            $data[] = $row;
                 // <a class="btn btn-xs btn-success" href="javascript:void(0)" title="Add materials & equipments" onclick="add_new('."'".$supplier->supplier_id."'".')"><i class="glyphicon glyphicon-plus"></i> Add</a>
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_list2(){        
        $list = $this->Payroll_Model->get_datatables2();
        $data = array();
        foreach ($list as $employee_types) {
            $row = array();            
            $row[] = $employee_types->alias;            
            $row[] = $employee_types->salary;
            $row[] = $employee_types->created;
            $row[] = $employee_types->updated;
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit Additionals Information" onclick="edit_emptype('."'".$employee_types->emptype_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>                 
                <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Delete this Additionals" onclick="delete_emptype('."'".$employee_types->emptype_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            $data[] = $row;
                 // <a class="btn btn-xs btn-success" href="javascript:void(0)" title="Add materials & equipments" onclick="add_new('."'".$supplier->supplier_id."'".')"><i class="glyphicon glyphicon-plus"></i> Add</a>
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_list3(){        
        $list = $this->Payroll_Model->get_datatables3();
        $data = array();
        foreach ($list as $employees) {
            $row = array();            
            $row = array();
            $row[] = $employees->pworker_id;
            $row[] = $employees->pworker_fname.' '.$employees->pworker_mname.' '.$employees->pworker_lname;
            $row[] = $employees->pworker_add.', '.$employees->city_name.', '.$employees->province_name.', '.$employees->zip_code;
            $row[] = $employees->description;
            $row[] = $employees->status;
            $row[] = $employees->user_lname. ', ' .$employees->user_fname;
            $row[] = '<a class="btn btn-xs btn-success"  title="DTR Adjustments" onclick="dtradj('."'".$employees->pworker_id."'".')"><i class="glyphicon glyphicon-wrench"></i> DTR</a>';

            $data[] = $row;
                 // <a class="btn btn-xs btn-success" href="javascript:void(0)" title="Add materials & equipments" onclick="add_new('."'".$supplier->supplier_id."'".')"><i class="glyphicon glyphicon-plus"></i> Add</a>
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

   public function ajax_add_additionals(){
        $this->_validate();
        $date = date('Y-m-d H:i:s');
        $data = array(            
            'description' => $this->input->post('atitle'),
            'note' => $this->input->post('anote'),        
            'created' => $date,
            'updated' => $date,
        );
        $insert = $this->Payroll_Model->save($data);
        echo json_encode(array("status" => TRUE));
   }

   public function ajax_add_emptype(){
        $this->_validate2();
        $date = date('Y-m-d H:i:s');
        $data = array(            
            'description' => $this->input->post('description'),
            'salary' => $this->input->post('salary'),  
            'alias' => $this->input->post('disemp'),        
            'created' => $date,
            'updated' => $date,
        );
        $insert = $this->Payroll_Model->save2($data);
        echo json_encode(array("status" => TRUE));
   }

   public function ajax_edit($id){
        $data = $this->Payroll_Model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_edit1($id){
        $data = $this->Payroll_Model->get_by_id1($id);
        echo json_encode($data);
    }

    public function ajax_edit2($id){
        $data = $this->Payroll_Model->get_by_id2($id);
        echo json_encode($data);
    }

    public function ajax_delete($id){
        $this->Payroll_Model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete1($id){
        $this->Payroll_Model->delete_by_id1($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete2($id){
        $this->Payroll_Model->delete_by_id2($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update_additionals(){
        $this->_validate();
        $date = date('Y-m-d H:i:s');
        $data = array(            
            'description' => $this->input->post('atitle'),
            'note' => $this->input->post('anote'),                  
            'updated' => $date,
        );
        $this->Payroll_Model->update(array('additionaltype_id' => $this->input->post('addtype_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update_deductions(){
        $this->_validate1();
        $date = date('Y-m-d H:i:s');
        $data = array(            
            'description' => $this->input->post('dtitle'),
            'note' => $this->input->post('dnote'),                  
            'updated' => $date,
            'type' => $this->input->post('dtype'),   
        );
        $this->Payroll_Model->update1(array('deductiontype_id' => $this->input->post('deductype_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update_emptype(){
        $this->_validate2();
        $date = date('Y-m-d H:i:s');
        $data = array(            
            'description' => $this->input->post('description'),
            'salary' => $this->input->post('salary'),    
            'alias' => $this->input->post('disemp'),               
            'updated' => $date,
        );
        $this->Payroll_Model->update2(array('emptype_id' => $this->input->post('emptype_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

   private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('atitle') == ''){
            $data['inputerror'][] = 'atitle';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }

        if($this->Payroll_Model->checknameAdd($this->input->post('atitle')) != null){
            $data['inputerror'][] = 'atitle';
            $data['error_string'][] = '*Title is already in list.';
            $data['status'] = FALSE;
        }


        if($this->input->post('anote') == '')
        {
            $data['inputerror'][] = 'anote';
            $data['error_string'][] = 'Note is required';
            $data['status'] = FALSE;
        }         


        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function ajax_add_deductions(){
        $this->_validate1();
        $date = date('Y-m-d H:i:s');
        $data = array(            
            'description' => $this->input->post('dtitle'),
            'note' => $this->input->post('dnote'),        
            'created' => $date,
            'updated' => $date,
            'type' => $this->input->post('dtype'),   
        );
        $insert = $this->Payroll_Model->save1($data);
        echo json_encode(array("status" => TRUE));
   }

   private function _validate1(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('dtitle') == ''){
            $data['inputerror'][] = 'dtitle';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('dtype') == ''){
            $data['inputerror'][] = 'dtype';
            $data['error_string'][] = 'Type is required';
            $data['status'] = FALSE;
        }

        // if($this->Payroll_Model->checknameDeduc($this->input->post('dtitle')) != null){
        //     $data['inputerror'][] = 'dtitle';
        //     $data['error_string'][] = '*Title is already in list.';
        //     $data['status'] = FALSE;
        // }


        if($this->input->post('dnote') == '')
        {
            $data['inputerror'][] = 'anote';
            $data['error_string'][] = 'Note is required';
            $data['status'] = FALSE;
        }         


        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _validate2(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('description') == ''){
            $data['inputerror'][] = 'description';
            $data['error_string'][] = 'Description is required';
            $data['status'] = FALSE;
        }

        if($this->Payroll_Model->checknameDeduc($this->input->post('description')) != null){
            $data['inputerror'][] = 'description';
            $data['error_string'][] = '*Description is already in list.';
            $data['status'] = FALSE;
        }


        if($this->input->post('salary') == '')
        {
            $data['inputerror'][] = 'salary';
            $data['error_string'][] = 'Salary is required';
            $data['status'] = FALSE;
        }         


        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function adjust($id){
        $input = $this->input->post('intime');
        $input = str_replace(" : ", ":", $input);


        $data = array(            
            'pworker_id' => $id,
            'desig_date' => $this->input->post('single_cal5'),        
            'time' => date('H:i:s', strtotime($input)),
            'project_code' => $this->input->post('prjselect'),
            'file' => 'admin'
        );

        var_dump($data);

        $insert = $this->Payroll_Model->saveadj($data);
        echo json_encode(array("status" => TRUE));
    }

}
