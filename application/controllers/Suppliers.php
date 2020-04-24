<?php

class Suppliers extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model(array('admin/Supplier'));
    }

    public function index() {
        $userid = ($this->session->userdata['logged_in']['user_id']);
        $userid2 = ($this->session->userdata['logged_in']['company']);
        $data['cities'] = $this->Supplier->getCity();
        $data['supplier'] =$this->Supplier->getSuppliers($userid2);
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $data['user_info'] = $this->Supplier->getData($user2);
        $this->load->view("admin/header.php",$data);
        $this->load->view("admin/suppliers.php", $data);
        $this->load->view("admin/footer.php");
    }


    public function ajax_list(){
        $userid2 = ($this->session->userdata['logged_in']['company']);
        $list = $this->Supplier->get_datatables($userid2);
        $data = array();
        foreach ($list as $supplier) {
            $row = array();
            $row[] = $supplier->supplier_id;
            $row[] = $supplier->supplier_name;
            $row[] = $supplier->supplier_address.', '.$supplier->city_name.', '.$supplier->province_name.', '.$supplier->zip_code;
            $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit supplier Information" onclick="edit_supplier('."'".$supplier->supplier_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                 <a class="btn btn-xs btn-warning" href="javascript:void(0)" title="View materials & equipments" onclick="view_supplier('."'".$supplier->supplier_id."'".')"><i class="glyphicon glyphicon-book"></i> view</a>
                <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Delete this supplier" onclick="delete_supplier('."'".$supplier->supplier_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            $data[] = $row;
                 // <a class="btn btn-xs btn-success" href="javascript:void(0)" title="Add materials & equipments" onclick="add_new('."'".$supplier->supplier_id."'".')"><i class="glyphicon glyphicon-plus"></i> Add</a>
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_list2($id){
        $list = $this->Supplier->get_item_id($id);
        $data = array();
        foreach ($list as $mat) {

            $row = array();
            $row[] = $mat->material_id;
            $row[] = $mat->material_name;
            $row[] = $mat->material_quantity;
            $row[] = $mat->ddate;
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_list3($id){
        $list = $this->Supplier->get_sups_id($id);
        $data = array();
        foreach ($list as $mat) {
            $row = array();
            $row[] = $mat->equipment_id;
            $row[] = $mat->equipment_name;
            $row[] = $mat->equipment_quantity;
            $row[] = $mat->ddate;
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id){
        $data = $this->Supplier->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add(){
        $this->_validate();
        $data = array(
            'supplier_id' => $this->input->post('supid'),
            'supplier_name' => $this->input->post('supname'),
            'supplier_address' => $this->input->post('supadd'),
            'city_id' => $this->input->post('supcity'),
            'company_id'  => $this->session->userdata['logged_in']['company']
        );
        $insert = $this->Supplier->save($data);
        echo json_encode(array("status" => TRUE));
    }




    public function ajax_update(){
        $this->_validate();
        $data = array(
            'supplier_name' => $this->input->post('supname'),
            'supplier_address' => $this->input->post('supadd'),
            'city_id' => $this->input->post('supcity'),
        );
        $this->Supplier->update(array('supplier_id' => $this->input->post('supid')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id){
        $this->Supplier->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    private function _validate(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('supname') == ''){
            $data['inputerror'][] = 'supname';
            $data['error_string'][] = 'Supplier name is required';
            $data['status'] = FALSE;
        }

        if($this->Supplier->checkname($this->input->post('supname')) != null){
            $data['inputerror'][] = 'supname';
            $data['error_string'][] = '*Supplier name is already in the Database.';
            $data['status'] = FALSE;
        }


        if($this->input->post('supadd') == '')
        {
            $data['inputerror'][] = 'supadd';
            $data['error_string'][] = 'Address is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('supcity') == '')
        {
            $data['inputerror'][] = 'supcity';
            $data['error_string'][] = 'City is required';
            $data['status'] = FALSE;
        }


        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }


    public function ajax_add2(){
       $this->_validate2();

        $data = array(
            'equipment_id' => $this->input->post('eqid2'),
            'equipment_name' => $this->input->post('eqname2'),
            'supplier_id' => $this->input->post('supsup2'),
            'equipment_date' => $this->input->post('eqddate2'),
            'equipment_quantity' => $this->input->post('eqqua2'),
            'equipment_status' => $this->input->post('eqstat2'),
            'equipment_comment' => $this->input->post('eqcom2'),   
        );
    
        $insert = $this->Supplier->save2($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_add3(){
       $this->_validate3();

        $data = array(
            'material_id' => $this->input->post('matid2'),
            'material_name' => $this->input->post('matname2'),
            'material_quantity' => $this->input->post('matqty2'),
            'material_status' => $this->input->post('matstat2'),
            'material_date' => $this->input->post('matddate2'),
            'supplier_id' => $this->input->post('matsup2'),
            'material_unit' => $this->input->post('matunit2'),
            'material_comment' => $this->input->post('matcom2'),
        );
    
        $insert = $this->Supplier->save3($data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate2(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('eqid2') == '')
        {
            $data['inputerror'][] = 'eqid2';
            $data['error_string'][] = 'Equipment ID is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('eqname2') == '')
        {
            $data['inputerror'][] = 'eqname2';
            $data['error_string'][] = 'Equipment name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('eqqua2') == '')
        {
            $data['inputerror'][] = 'eqqua2';
            $data['error_string'][] = 'Quantity is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('eqstat2') == '')
        {
            $data['inputerror'][] = 'eqstat2';
            $data['error_string'][] = 'Status is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('supsup2') == '')
        {
            $data['inputerror'][] = 'supsup2';
            $data['error_string'][] = 'Supplier is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('eqddate2') == '')
        {
            $data['inputerror'][] = 'eqddate2';
            $data['error_string'][] = 'Deliver Date is required';
            $data['status'] = FALSE;
        }

       
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _validate3(){
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('matid2') == '')
        {
            $data['inputerror'][] = 'matid2';
            $data['error_string'][] = 'Material ID is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('matname2') == '')
        {
            $data['inputerror'][] = 'matname2';
            $data['error_string'][] = 'Material name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('matqty2') == '')
        {
            $data['inputerror'][] = 'matqty2';
            $data['error_string'][] = 'Quantity is required';
            $data['status'] = FALSE;
        }

         if($this->input->post('matsup2') == '')
        {
            $data['inputerror'][] = 'matsup2';
            $data['error_string'][] = 'Supplier is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('matstat2') == '')
        {
            $data['inputerror'][] = 'matstat2';
            $data['error_string'][] = 'Status is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('matddate2') == '')
        {
            $data['inputerror'][] = 'matddate2';
            $data['error_string'][] = 'Deliver Date is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('matunit2') == '')
        {
            $data['inputerror'][] = 'matunit2';
            $data['error_string'][] = 'Unit is required';
            $data['status'] = FALSE;
        }


        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}


