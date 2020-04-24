<?php

class HumanP extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('hr/PayrollH'));
    }

    public function index() {
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $user3 = $this->session->userdata['logged_in']['company'];
        $data['user_info'] = $this->PayrollH->getData($user2);
        $data['emp_info'] = $this->PayrollH->getEmployees($user3);
        $data['additionals_id'] = $this->PayrollH->getAdditionaltype_id();
        $data['deductions_id'] = $this->PayrollH->getDeductionstype_id();
        $data['deductions_id2'] = $this->PayrollH->getDeductionstype_id2(); 
        $error = array('error' => ' ' );
        $this->load->view("hr/header.php",$data);
        $this->load->view("hr/payroll.php",$error);
        $this->load->view("hr/footer.php");
    }

    public function getdtr1($aw, $ew, $ew2, $ew3, $ew4, $ew5 ){
        $e1 = trim(substr($ew3, 0,4));
        $e2 = trim(substr($ew3, 11,2));
        $data = $this->PayrollH->get_dtr_by_id1($aw, $ew, $ew2, $e1, $e2, $ew4, $ew5);
        echo json_encode($data);
    }  

    public function getdtr($aw, $ew, $ew2, $ew3, $ew4, $ew5, $pr){
        $e1 = trim(substr($ew3, 0,4));
        $e2 = trim(substr($ew3, 11,2));
        $data = $this->PayrollH->get_dtr_by_id($aw, $ew, $ew2, $e1, $e2, $ew4, $ew5, $pr);
        echo json_encode($data);
    }  

    public function getdtr2($aw, $ew, $ew2, $ew3, $ew4, $ew5, $pr){
        $e1 = trim(substr($ew3, 0,4));
        $e2 = trim(substr($ew3, 11,2));
        $data = $this->PayrollH->get_dtr_by_id2($aw, $ew, $ew2, $e1, $e2, $ew4, $ew5, $pr);
        echo json_encode($data);
    }   

    public function getaded($id, $ew, $ew2, $ew3, $ew4, $ew5){
        $e1 = trim(substr($ew3, 0,4));
        $e2 = trim(substr($ew3, 11,2));
        $data = $this->PayrollH->getadded($id, $ew, $ew2, $e1, $e2, $ew4, $ew5);
        echo json_encode($data);
    }

    public function getded($id, $ew, $ew2, $ew3, $ew4, $ew5){
        $e1 = trim(substr($ew3, 0,4));
        $e2 = trim(substr($ew3, 11,2));
        $data = $this->PayrollH->getdded($id, $ew, $ew2, $e1, $e2, $ew4, $ew5);
        echo json_encode($data);
    }

    public function getded2($id, $ew, $ew2, $ew3, $ew4, $ew5){
        $e1 = trim(substr($ew3, 0,4));
        $e2 = trim(substr($ew3, 11,2));
        $data = $this->PayrollH->getdded2($id, $ew, $ew2, $e1, $e2, $ew4, $ew5);
        
        $data2 = array(            
            'loan_id' => $id,
            'date_of_payment1' => $e1.'-'.$ew.'-'.$ew2,        
            'amount_paid' => $data->deduction_amt
        );

        $insert1 = $this->PayrollH->save_loan_payment($data2);

        echo json_encode($data);
    }

    public function displayded2($id, $ew, $ew2, $ew3, $ew4, $ew5){
        $e1 = trim(substr($ew3, 0,4));
        $e2 = trim(substr($ew3, 11,2));
        $data = $this->PayrollH->displayded2($id, $ew, $ew2, $e1, $e2, $ew4, $ew5);
        
        echo json_encode($data);
    }

    public function displayded21($id, $ew, $ew2, $ew3, $ew4, $ew5){
        $e1 = trim(substr($ew3, 0,4));
        $e2 = trim(substr($ew3, 11,2));
        $data = $this->PayrollH->displayded21($id, $ew, $ew2, $e1, $e2, $ew4, $ew5);
        
        echo json_encode($data);
    }


    public function ajax_list(){
        $userid2 = ($this->session->userdata['logged_in']['company']);
        $list = $this->PayrollH->get_datatables($userid2);
        $data = array();
        foreach ($list as $supplier) {
            $row = array();
            $row[] = $supplier->pworker_id;
            $row[] = $supplier->pworker_fname.' '.$supplier->pworker_mname.' '.$supplier->pworker_lname;
            $row[] = $supplier->pworker_add.', '.$supplier->city_name.', '.$supplier->province_name.', '.$supplier->zip_code;
            $row[] = $supplier->description;
            $row[] = '<a class="btn btn-xs btn-primary"  data-toggle="tooltip" data-placement="bottom" title="Additional '.$supplier->pworker_id.'"  title="Edit this "'. $supplier->pworker_id.'"" onclick="emp_additional('."'".$supplier->pworker_id."'".')"><i class="glyphicon glyphicon-plus"></i> Additional</a>
              <a class="btn btn-xs btn-danger"  data-toggle="tooltip" data-placement="bottom" title="Deduction '.$supplier->pworker_id.'" onclick="emp_deduction('."'".$supplier->pworker_id."'".')"><i class="glyphicon glyphicon-minus"></i> Deduction</a>
              <a class="btn btn-xs btn-success"  data-toggle="tooltip" data-placement="bottom" title="View '.$supplier->pworker_id.'" onclick="view_stat('."'".$supplier->pworker_id."'".')"><i class="glyphicon glyphicon-eye-open"></i> View status</a>';
            
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }    

    public function ajax_list_loan(){
        $userid2 = ($this->session->userdata['logged_in']['company']);
        $list = $this->PayrollH->get_datatables($userid2);
        $data = array();
        foreach ($list as $supplier) {
            $row = array();
            $row[] = $supplier->pworker_id;
            $row[] = $supplier->pworker_fname.' '.$supplier->pworker_mname.' '.$supplier->pworker_lname;
            $row[] = $supplier->pworker_add.', '.$supplier->city_name.', '.$supplier->province_name.', '.$supplier->zip_code;
            $row[] = $supplier->description;
            $row[] = '<a class="btn btn-xs btn-primary"  data-toggle="tooltip" data-placement="bottom" title="Additional '.$supplier->pworker_id.'"  title="Edit this "'. $supplier->pworker_id.'"" onclick="add_loan('."'".$supplier->pworker_id."'".')"><i class="glyphicon glyphicon-plus"></i> Add Loan</a>              
              <a class="btn btn-xs btn-success"  data-toggle="tooltip" data-placement="bottom" title="View '.$supplier->pworker_id.'" onclick="loan_stat('."'".$supplier->pworker_id."'".')"><i class="glyphicon glyphicon-eye-open"></i> View status</a>';
            
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function getAdditionalNote($noteid) {
        $noted = $this->PayrollH->getAddnote($noteid);
        echo json_encode($noted);
    }

    public function ajax_add_additional() {
        $this->_validate();
        $date = date('Y-m-d H:i:s');
         $data = array(            
            'emp_id' => $this->input->post('employee_id'),
            'additionaltype_id' => $this->input->post('additional_id'),        
            'amount' => $this->input->post('addamt'),
            'start_date' => $this->input->post('addsdate'),
            'end_date' => $this->input->post('addedate'),
            'created_at' => $date
        );
        $insert = $this->PayrollH->save_additional($data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('additionaltype_id') == 'undefined'){
            $data['inputerror'][] = 'additionaltype_id';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }    

        if($this->input->post('addamt') == '')
        {
            $data['inputerror'][] = 'addamt';
            $data['error_string'][] = 'Amount is required';
            $data['status'] = FALSE;
        }         

        if($this->input->post('addsdate') == '')
        {
            $data['inputerror'][] = 'addsdate';
            $data['error_string'][] = 'Start date is required';
            $data['status'] = FALSE;
        } 

        if($this->input->post('addedate') == '')
        {
            $data['inputerror'][] = 'addedate';
            $data['error_string'][] = 'Date end is required';
            $data['status'] = FALSE;
        } 


        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function getDeductionalNote($note_id) {
        $dnote = $this->PayrollH->getDecnote($note_id);
        echo json_encode($dnote);   
    }

    public function ajax_add_deduction() {
        $this->_validate1();
        $date = date('Y-m-d H:i:s');
         $data = array(            
            'emp_id' => $this->input->post('employee_id1'),
            'deductiontype_id' => $this->input->post('deduction_id'),        
            'amount' => $this->input->post('deducamt'),
            'start_date' => $this->input->post('deducsdate'),
            'end_date' => $this->input->post('deducedate'),
            'created_at' => $date
        );
        $insert1 = $this->PayrollH->save_deduction($data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate1(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('deduction_id') == 'undefined'){
            $data['inputerror'][] = 'deduction_id';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }    

        if($this->input->post('deducamt') == '')
        {
            $data['inputerror'][] = 'deducamt';
            $data['error_string'][] = 'Amount is required';
            $data['status'] = FALSE;
        }         

        if($this->input->post('deducsdate') == '')
        {
            $data['inputerror'][] = 'deducsdate';
            $data['error_string'][] = 'Start date is required';
            $data['status'] = FALSE;
        } 

        if($this->input->post('deducedate') == '')
        {
            $data['inputerror'][] = 'deducedate';
            $data['error_string'][] = 'Date end is required';
            $data['status'] = FALSE;
        } 


        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function get_employee_profile($id) {
        $emp_profile = $this->PayrollH->getprofile($id);
        echo json_encode($emp_profile);
    }

    public function ajax_list1($worker_id){        
        $list = $this->PayrollH->get_datatables1($worker_id);
        $datecondition = date('Y-m-d');
        $data = array();
        foreach ($list as $worker) {
            $row = array();
            if($worker->end_date < $datecondition) {
                $row[] = '<p style="color:red;">'.$worker->description.'</p>';
                $row[] = '<p style="color:red;">'.$worker->amount.'</p>';
                $row[] = '<p style="color:red;">'.$worker->start_date.'</p>';
                $row[] = '<p style="color:red;">'.$worker->end_date.'</p>';
                $row[] = '<p style="color:red;">'.$worker->created_at.'</p>';
            } else {
                $row[] = '<p style="color:green;">'.$worker->description.'</p>';
                $row[] = '<p style="color:green;">'.$worker->amount.'</p>';
                $row[] = '<p style="color:green;">'.$worker->start_date.'</p>';
                $row[] = '<p style="color:green;">'.$worker->end_date.'</p>';
                $row[] = '<p style="color:green;">'.$worker->created_at.'</p>';
            }            
            $row[] = '<a class="btn btn-xs btn-danger"  data-toggle="tooltip" data-placement="bottom" title="Delete '.$worker->additional_id.'" onclick="del_addt('."'".$worker->additional_id."'".')"><i class="glyphicon glyphicon-minus"></i> Delete</a>';
                      
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_list2($worker_id){        
        $list = $this->PayrollH->get_datatables2($worker_id);
        $datecondition1 = date('Y-m-d');
        $data = array();
        foreach ($list as $worker) {
            $row = array();
        if($worker->end_date < $datecondition1) {
            $row[] = '<p style="color:red;">'.$worker->description.'</p>';
            $row[] = '<p style="color:red;">'.$worker->amount.'</p>';
            $row[] = '<p style="color:red;">'.$worker->start_date.'</p>';
            $row[] = '<p style="color:red;">'.$worker->end_date.'</p>';
            $row[] = '<p style="color:red;">'.$worker->created_at.'</p>';
        } else {
            $row[] = '<p style="color:green;">'.$worker->description.'</p>';
            $row[] = '<p style="color:green;">'.$worker->amount.'</p>';
            $row[] = '<p style="color:green;">'.$worker->start_date.'</p>';
            $row[] = '<p style="color:green;">'.$worker->end_date.'</p>';
            $row[] = '<p style="color:green;">'.$worker->created_at.'</p>';
        }
            
            $row[] = '<a class="btn btn-xs btn-danger"  data-toggle="tooltip" data-placement="bottom" title="Delete '.$worker->deduction_id.'" onclick="del_deduc('."'".$worker->deduction_id."'".')"><i class="glyphicon glyphicon-minus"></i> Delete</a>';
                      
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_additional_delete($id){
        $this->PayrollH->delete_addtionl($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_deduction_delete($id){
        $this->PayrollH->delete_deduc($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_add_loan() {
        $this->_validate_loan();            
        $data = array(            
            'emp_id' => $this->input->post('employee_id_loan'),
            'deductiontype_id' => $this->input->post('loan_id'),
            'date_loan_granted' => $this->input->post('loangrant'),
            'original_loan' => $this->input->post('amt_loan'),
            'terms' => $this->input->post('loanterm'),
            'deduction_amt' => $this->input->post('deducamt'),
            'deduction_period' => $this->input->post('loan_period'),
            'deduction_starts' => $this->input->post('deducstart'),
            'interest' => $this->input->post('loanint')
        );        
        $this->PayrollH->insert_loan($data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate_loan(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('loan_id') == 'undefined'){
            $data['inputerror'][] = 'loan_id';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }    

        if($this->input->post('amt_loan') == '')
        {
            $data['inputerror'][] = 'amt_loan';
            $data['error_string'][] = 'Amount is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('loanterm') == '')
        {
            $data['inputerror'][] = 'loanterm';
            $data['error_string'][] = 'Term is required';
            $data['status'] = FALSE;
        }           

        if($this->input->post('loan_period') == '')
        {
            $data['inputerror'][] = 'loan_period';
            $data['error_string'][] = 'Period is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('loangrant') == '')
        {
            $data['inputerror'][] = 'loangrant';
            $data['error_string'][] = 'Date Loan/Granted required';
            $data['status'] = FALSE;
        } 

        if($this->input->post('deducstart') == '')
        {
            $data['inputerror'][] = 'deducstart';
            $data['error_string'][] = 'Deduction Start is required';
            $data['status'] = FALSE;
        } 

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function ajax_list3($id) {
        $list = $this->PayrollH->get_datatables_loans($id);        
        $data = array();
        foreach ($list as $worker) {
            $row = array();
            $pay = $this->PayrollH->getpaid($worker->loan_id);
            if($pay->total_paid == null){
                $pay->total_paid = '0.00';
            }

        if($pay->total_paid >= $worker->original_loan) {
            $row[] = '<p style="color:green;">'.$worker->description.'</p>';
            $row[] = '<p style="color:green;"green>'.$worker->date_loan_granted.'</p>';
            $row[] = '<p style="color:green;">'.$worker->original_loan.'</p>';
            $row[] = '<p style="color:green;">'.$worker->terms.'</p>';
            $row[] = '<p style="color:green;">'.$worker->interest.'%</p>';
            $row[] = '<p style="color:green;">'.$worker->deduction_amt.'</p>';
            $row[] = '<p style="color:green;">'.$worker->deduction_period.'</p>';
            $row[] = '<p style="color:green;">'.$worker->deduction_starts.'</p>';            
            $row[] = '<p style="color:green;">'.$pay->total_paid.'</p>';         
            $row[] = '<a class="btn btn-xs btn-danger" id="dell" data-toggle="tooltip" data-placement="bottom" title="Delete Loan" onclick="del_loan('."'".$worker->loan_id."'".')"><i class="fa fa-trash"></i> Delete</a> <a class="btn btn-xs btn-info" id="his" data-toggle="tooltip" data-placement="bottom" title="View Payment History" onclick="loan_history('."'".$worker->loan_id."'".')"><i class="fa fa-bar-chart"></i> History</a>';
            
        } else {
            $row[] = '<p style="color:red;">'.$worker->description.'</p>';
            $row[] = '<p style="color:red;">'.$worker->date_loan_granted.'</p>';
            $row[] = '<p style="color:red;">'.$worker->original_loan.'</p>';
            $row[] = '<p style="color:red;">'.$worker->terms.'</p>';
            $row[] = '<p style="color:green;">'.$worker->interest.'%</p>';
            $row[] = '<p style="color:red;">'.$worker->deduction_amt.'</p>';
            $row[] = '<p style="color:red;">'.$worker->deduction_period.'</p>';
            $row[] = '<p style="color:red;">'.$worker->deduction_starts.'</p>';            
            $row[] = '<p style="color:red;">'.$pay->total_paid.'</p>';            
            $row[] = '<button class="btn btn-xs btn-success" id="addl" data-toggle="tooltip" data-placement="bottom" title="Add to Payroll" onclick="getded2('."'".$worker->loan_id."'".','."'".$id."'".')"><i class="glyphicon glyphicon-check"></i> Add</button> <a class="btn btn-xs btn-danger" id="dell" data-toggle="tooltip" data-placement="bottom" title="Delete Loan" onclick="del_loan('."'".$worker->loan_id."'".')"><i class="fa fa-trash"></i> Delete</a> <a class="btn btn-xs btn-info" id="his" data-toggle="tooltip" data-placement="bottom" title="View Payment History" onclick="loan_history('."'".$worker->loan_id."'".')"><i class="fa fa-bar-chart"></i> History</a>';
        }         
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_listpay($id) {
        $list = $this->PayrollH->get_datatables_loans_pay($id);        
        $data = array();
        foreach ($list as $worker) {
            $row = array();
            
            $row[] = '<p style="color:green;">'.$worker->loan_payment_id.'</p>';
            $row[] = '<p style="color:green;"green>'.$worker->date_of_payment1.'</p>';
            $row[] = '<p style="color:green;">'.$worker->amount_paid.'</p>';
             
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }


    public function ajax_loan_delete($id){
        $this->PayrollH->delete_loan($id);
        echo json_encode(array("status" => TRUE));
    }

    public function loan_del($id){
        $this->PayrollH->loan_del($id);
        echo json_encode(array("status" => TRUE));
    }

    public function get13($aw,$start,$end){
        $data = $this->PayrollH->get_dtr_by_id13($aw,$start,$end);
        echo json_encode($data);
    }  


    public function getdtr13($aw, $ew, $ew2){
        $data = $this->PayrollH->get_dtr_by_id13($aw, $ew, $ew2);
        echo json_encode($data);
    }  


}
    