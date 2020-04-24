<?php

class Materials extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model(array('admin/Material'));
        
    }

    public function index() {
        $userid = ($this->session->userdata['logged_in']['user_id']);
        $userid2 = ($this->session->userdata['logged_in']['company']);
        $data['supplier'] = $this->Material->getSuppliers($userid2);
        $data['units'] = $this->Material->getUnits();
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $data['user_info'] = $this->Material->getData($user2);
        $this->load->view("admin/header.php",$data);
        $this->load->view("admin/materials.php", $data);
        $this->load->view("admin/footer.php");
    }


    public function ajax_list() {
        $userid = ($this->session->userdata['logged_in']['company']);

        $list = $this->Material->get_datatables($userid);
        $data = array();
       
        foreach ($list as $material) {

            $row = array();
            $row[] = $material->material_id;
            $row[] = $material->material_name;
            $row[] = $material->material_quantity.' '.$material->unit_acro;
            $row[] = $material->total_amount;
            $row[] = $material->material_status;
            $row[] = $material->supplier_name;
            $row[] = $material->ddate;
           
            if ($material->material_date == date("Y-m-d")){
                $row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_material('."'".$material->ii."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a><a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_material('."'".$material->ii."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            }
            else{
                $row[] = 'Cannot be updated.';
            }

            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_list_stock() {
        $userid = ($this->session->userdata['logged_in']['company']);

        $list = $this->Material->get_datatables_stock($userid);
        $data = array();
       
        foreach ($list as $material) {

            $row = array();
            $row[] = $material->material_name;
            $row[] = $material->quantity.' '.$material->unit_acro;
            
            if ($material->material_date == date("Y-m-d")){
                $row[] = '<a class="btn btn-xs btn-primary"  data-toggle="tooltip" data-placement="top" title="Update '.$material->material_name.'" onclick="edit_material_stock('."'".$material->material_id."'".')"><i class="glyphicon glyphicon-refresh"></i> Update</a>';
            }
            else{
                $row[] = '<a class="btn btn-xs btn-primary"  data-toggle="tooltip" data-placement="top" title="Add '.$material->material_name.'" onclick="edit_material_stock('."'".$material->material_id."'".')"><i class="glyphicon glyphicon-plus"></i> Add</a>';
            
            }
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }


    public function ajax_list4() {

        $list = $this->Material->get_datatables_r();
        $data = array();
       
        foreach ($list as $material) {

            $row = array();
            $row[] = $material->project_title;
            $row[] = $material->material_name;
            $row[] = $material->material_quantity.' '.$material->unit_acro;
            $row[] = $material->ddate;
            
            $data[] = $row;
        }

        $output = array(   
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function ajax_edit($id){
        $data = array(
            'material_id' => $id,
            'material_date' => date("Y-m-d")
        );

        $data = $this->Material->get_by_id($data);
        echo json_encode($data);
    }

    public function ajax_edit2($id){
        $data = $this->Material->get_by_id2($id);
        echo json_encode($data);
    }

    public function ajax_add(){
        $user2 = $this->session->userdata['logged_in']['company'];
        $this->_validate();
        $ii = $this->getlastid() + 1;

        $data = array(
            'material_id' => $ii,
            'material_name' => $this->input->post('matname'),
            'material_quantity' => $this->input->post('matqty'),
            'material_status' => $this->input->post('matstat'),
            'material_date' => $this->input->post('matddate'),
            'supplier_id' => $this->input->post('matsup'),
            'material_unit' => $this->input->post('matunit'),
            'material_comment' => $this->input->post('matcom'),
            'total_amount' => $this->input->post('mattot'),
            'company_id' => $user2 
        );

        $data2 = array(
            'material_id' => $ii,
            'quantity' => $this->input->post('matqty'),
            'company_id' => $user2
        );
        
        $insert = $this->Material->savestock($data2);
        $insert = $this->Material->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update(){
        //$this->_validate();
        $com = $this->session->userdata['logged_in']['company'];
        $data = array(
            'material_id' => $this->input->post('matid'),
            'material_name' => $this->input->post('matname'),
            'material_quantity' => $this->input->post('matqty'),
            'material_status' => $this->input->post('matstat'),
            'material_date' => date("Y-m-d"),
            'supplier_id' => $this->input->post('matsup'),
            'material_unit' => $this->input->post('matunit'),
            'material_comment' => $this->input->post('matcom'),
            'total_amount' => $this->input->post('mattot'),
        );

        $data2 = array(
            'material_name' => $this->input->post('matname'),
        );

        $data3 = array(
            'material_quantity' => $this->input->post('matqty'),
        );

        $data4 = array(
            'material_status' => $this->input->post('matstat'),
        );

        $data5 = array(
            'supplier_id' => $this->input->post('matsup'),
         );

        $data6 = array(
            'material_unit' => $this->input->post('matunit'),
        );

        $data7 = array(
            'material_comment' => $this->input->post('matcom'),
        );

        $data8 = array(
            'total_amount' => $this->input->post('mattot'),
        );

        $this->Material->update(array('ii' => $this->input->post('matidii')),array('material_id' => $this->input->post('matid')), $data, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $com);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update_stock(){
      
        $com = $this->session->userdata['logged_in']['company'];
        $data = array(
            'material_quantity' => $this->input->post('matqty1')
        );

        $data2 = array(
            'material_id' => $this->input->post('matids'),
            'material_name' => $this->input->post('matname1'),
            'material_quantity' => $this->input->post('matqty1'),
            'material_status' => $this->input->post('matstat1'),
            'material_date' => date("Y-m-d"),
            'supplier_id' => $this->input->post('matsup1'),
            'material_unit' => $this->input->post('matunit1'),
            'material_comment' => $this->input->post('matcom1'),
            'company_id' => $com
        );

        $insert = $this->Material->update_stock(array('material_id' => $this->input->post('matids'),'material_date' => date("Y-m-d")), $data, $data2);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id){ 
        $this->Material->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate(){

        $com = $this->session->userdata['logged_in']['company'];
        
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('matname') == ''){
            $data['inputerror'][] = 'matname';
            $data['error_string'][] = 'Material name is required';
            $data['status'] = FALSE;
        }

        if($this->Material->checkname($this->input->post('matname'),$com) != null){
            $data['inputerror'][] = 'matname';
            $data['error_string'][] = 'Material name is already used';
            $data['status'] = FALSE;
        }

        if($this->input->post('matqty') == ''){
            $data['inputerror'][] = 'matqty';
            $data['error_string'][] = 'Quantity is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('matsup') == ''){
            $data['inputerror'][] = 'matsup';
            $data['error_string'][] = 'Supplier is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('matstat') == ''){
            $data['inputerror'][] = 'matstat';
            $data['error_string'][] = 'Status is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('matddate') == ''){
            $data['inputerror'][] = 'matddate';
            $data['error_string'][] = 'Deliver Date is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('matunit') == ''){
            $data['inputerror'][] = 'matunit';
            $data['error_string'][] = 'Unit is required';
            $data['status'] = FALSE;
        }


        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
    }

    public function getlastid(){
        $list = $this->Material->getlastid();
        return intval($list);
    }

}
