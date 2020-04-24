<?php

class Equipments extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model(array('admin/Equipment'));
    }

    public function index() {
        $userid = ($this->session->userdata['logged_in']['user_id']);
        $userid2 = ($this->session->userdata['logged_in']['company']);
        $data['cities'] = $this->Equipment->getCity();
        $data['supplier'] = $this->Equipment->getSuppliers($userid2);
        $userid = ($this->session->userdata['logged_in']['user_id']);
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $data['user_info'] = $this->Equipment->getData($user2);
        $this->load->view("admin/header.php",$data);
        $this->load->view("admin/equipments.php",$data);
        $this->load->view("admin/footer.php");
    }

    public function ajax_list(){


        $com = $this->session->userdata['logged_in']['company'];
        $list = $this->Equipment->get_datatables($com);
        $data = array();
       
        foreach ($list as $equip) {

            $row = array();
            $row[] = $equip->equipment_id;
            $row[] = $equip->equipment_name;
            $row[] = $equip->equipment_quantity;
            $row[] = $equip->total_amount;
            $row[] = $equip->ddate;
            $row[] = $equip->supplier_name;
            $row[] = $equip->equipment_status; 

            if ($equip->equipment_date == date("Y-m-d")){
                $row[] = '<a class="btn btn-xs btn-primary"  title="Edit" onclick="edit_equip('."'".$equip->ii."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-xs btn-danger"  title="Hapus" onclick="delete_equip('."'".$equip->ii."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            }
            else{
                $row[] = "<small>cannot be updated.</small>";
            }
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list_proj(){
        $list = $this->Equipment->get_datatables_proj();
        $data = array();
       
        foreach ($list as $equip) {

            $row = array();
            $row[] = $equip->project_title;
            $row[] = $equip->equipment_name;

            $row[] = $equip->equipment_quantity;

            $row[] = $equip->ddate;
           
            
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list_stock(){

        $com = $this->session->userdata['logged_in']['company'];
        $list = $this->Equipment->get_datatables_stock($com);
        $data = array();
       
        foreach ($list as $equip) {

            $row = array(); 
            $row[] = $equip->equipment_name; 
            $row[] = $equip->quantity;
            
            if ($equip->equipment_date == date("Y-m-d")){
                $row[] = '<a class="btn btn-xs btn-primary" title="Edit" onclick="edit_equip_stock('."'".$equip->equipment_id."'".')"><i class="glyphicon glyphicon-refresh"></i> Update</a>';
            }

            else{
                $row[] = '<a class="btn btn-xs btn-primary"  title="Edit" onclick="edit_equip_stock('."'".$equip->equipment_id."'".')"><i class="glyphicon glyphicon-plus"></i> Add</a>';
            }

            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_edit($id){
        $data = $this->Equipment->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_edit2($id){
        $data = $this->Equipment->get_by_id2($id);
        echo json_encode($data);
    }

    public function ajax_add_to_stock(){

        $user2 = $this->session->userdata['logged_in']['company'];

        $this->_validate();
        $ii = $this->getlastid() + 1;

        $data = array(
            'equipment_id' => $ii,
            'equipment_name' => $this->input->post('eqname'),
            'supplier_id' => $this->input->post('eqsup'),
            'equipment_date' => $this->input->post('eqddate'),
            'equipment_quantity' => $this->input->post('eqqua'),
            'equipment_status' => $this->input->post('eqstat'),
            'equipment_comment' => $this->input->post('eqcom'),
            'total_amount' => $this->input->post('eqtot'),
            'company_id' => $user2   
        );

        $data2 = array(
            'equipment_id' => $ii,
            'quantity' => $this->input->post('eqqua'),
            'company_id' => $user2
        );
    
        $insert = $this->Equipment->save($data);
        $insert = $this->Equipment->savetostock($data2);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update_stock(){
        $user2 = $this->session->userdata['logged_in']['company'];
        $data = array(
            'equipment_id' => $this->input->post('eqid1'),
            'equipment_name' => $this->input->post('eqname1'),
            'supplier_id' => $this->input->post('eqsup1'),
            'equipment_date' => date("Y-m-d"),
            'equipment_quantity' => $this->input->post('eqqua1'),
            'equipment_status' => $this->input->post('eqstat1'),
            'equipment_comment' => $this->input->post('eqcom1'),
             
        );
        $this->Equipment->updatestock($data, $user2);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update(){
        //$this->_validate();
        $data = array(
            'equipment_id' => $this->input->post('eqid'),
            'equipment_name' => $this->input->post('eqname'),
            'supplier_id' => $this->input->post('eqsup'),
            'equipment_date' => $this->input->post('eqddate'),
            'equipment_quantity' => $this->input->post('eqqua'),
            'equipment_status' => $this->input->post('eqstat'),
            'equipment_comment' => $this->input->post('eqcom'),
            'total_amount' => $this->input->post('eqtot')
        );

        $data2 = array(
            'equipment_name' => $this->input->post('eqname'),
        );


        $data3 = array(
            'supplier_id' => $this->input->post('eqsup'),
        );

        $data4 = array(
            'equipment_status' => $this->input->post('eqstat'),
        );

        $data5 = array(
            'equipment_comment' => $this->input->post('eqcom'),
        );

        $data6 = array(
            'equipment_quantity' => $this->input->post('eqqua'),
        );

        $data7 = array(
            'total_amount' => $this->input->post('eqtot'),
        );

        $this->Equipment->update(array('ii' => $this->input->post('eqidii')),array('equipment_id' => $this->input->post('eqid')), $data, $data2, $data3, $data4, $data5, $data6,  $data7);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id){
        $this->Equipment->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    private function _validate(){
        $com = $this->session->userdata['logged_in']['company'];
    
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('eqname') == ''){
            $data['inputerror'][] = 'eqname';
            $data['error_string'][] = 'Equipment name is required';
            $data['status'] = FALSE;
        }

        if($this->Equipment->checkname($this->input->post('eqname'), $com) != null){
            $data['inputerror'][] = 'eqname';
            $data['error_string'][] = 'Equipment name is already used';
            $data['status'] = FALSE;
        }

        if($this->input->post('eqqua') == '')
        {
            $data['inputerror'][] = 'eqqua';
            $data['error_string'][] = 'Quantity is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('eqstat') == '')
        {
            $data['inputerror'][] = 'eqstat';
            $data['error_string'][] = 'Status is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('eqtot') == '')
        {
            $data['inputerror'][] = 'eqtot';
            $data['error_string'][] = 'Amount is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('eqsup') == '')
        {
            $data['inputerror'][] = 'eqsup';
            $data['error_string'][] = 'Supplier is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('eqddate') == '')
        {
            $data['inputerror'][] = 'eqddate';
            $data['error_string'][] = 'Deliver Date is required';
            $data['status'] = FALSE;
        }

       
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    public function getlastid(){
        $list = $this->Equipment->getlastid();
        return intval($list);
    }


}
