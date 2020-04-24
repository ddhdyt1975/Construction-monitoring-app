<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Project2 extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function view_m($data){
        $query = $this->db->query('SELECT
                                    project_request.request_id,
                                    project.project_code,
                                    project_request.request_severity,
                                    project.project_title AS p1,
                                    project_request.req_date,
                                    p2.project_title,
                                    user1.user_fname,
                                    user1.user_lname,
                                    user1.user_photo
                                    FROM
                                    project_request
                                    INNER JOIN project ON project_request.req_from = project.project_code
                                    INNER JOIN `user` ON `user`.user_id = project.user_id
                                    INNER JOIN project AS p2 ON p2.project_code = project_request.req_to
                                    INNER JOIN `user` AS user1 ON user1.user_id = p2.user_id
                                    INNER JOIN usertype ON usertype.usertype_id = user1.usertype_id
                                    WHERE
                                    project.user_id = "'.$data.'"');
        return $query->result();
    }
    
    public function count_rr($data){
        $query = $this->db->query('SELECT
                                    project_request.request_id,
                                    project.project_code,
                                    project.user_id
                                    FROM
                                    project_request
                                    INNER JOIN project ON project_request.req_from = project.project_code
                                    WHERE
                                    project.user_id = "'.$data.'"');
        return $query->num_rows();
    }
    
    public function getData($id){
        $query = $this->db->query('SELECT *,DATE_FORMAT(registered_date,"%M %d, %Y") AS ddate, DATE_FORMAT(registered_date,"%h:%i %p") AS time FROM `user` INNER JOIN city ON city.city_id = `user`.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id INNER JOIN company_details ON company_details.company_id = `user`.company WHERE user_id = "'.$id['user_id'].'"');
        return $query->row();
    }
    
    function getAllProjects($data, $com) {
       
        $query = $this->db->query('SELECT * FROM project INNER JOIN user WHERE  project.user_id = user.user_id AND project.user_id NOT IN ("'.$data['user_id'].'") AND user.company= "'.$com.'" ');
        return $query->result();
    }
    
    function getProjDetails($project_title) {
        $query = $this->db->query('SELECT * FROM  city c NATURAL JOIN province NATURAL JOIN project INNER JOIN user ON project.user_id = `user`.user_id NATURAL JOIN project_details WHERE project.project_code = project_details.project_code AND project.city_id = c.city_id AND c.province_id = province.province_id AND project.project_code  = "'.$project_title.'" ');
        return $query->row();
    }

    function getProjs($project_title) {
        $query = $this->db->query('SELECT * FROM project WHERE  project.project_code NOT IN ("'.$project_title.'")');
        return $query->result();
    }

    function getOM($project_title) {
        $query = $this->db->query('SELECT material_used.mu_id, material.material_id,material.material_name, material_used.mu_date, material.material_quantity FROM material_used INNER JOIN material ON material_used.material_id = material.material_id INNER JOIN project ON project.project_code = material_used.project_code WHERE project.project_code ="'.$project_title.'"');
        return $query->result();
    }

    function getOE($project_title) {
        $query = $this->db->query('SELECT equipment_used.eu_id,equipment_used.eu_date, equipment.equipment_id, equipment.equipment_name, equipment_used.project_code FROM project INNER JOIN equipment_used ON equipment_used.project_code = project.project_code INNER JOIN equipment ON equipment.equipment_id = equipment_used.equipment_id WHERE project.project_code ="'.$project_title.'"');
        return $query->result();
    }
    
    function getCity(){
        $query = $this->db->query('SELECT * FROM city INNER JOIN province ON city.province_id = province.province_id ');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function getTask(){
        $query = $this->db->query('SELECT * FROM project_task');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    public function getp_by_id($id){
        $query = $this->db->query(' SELECT * FROM project INNER JOIN user on project.user_id = `user`.user_id NATURAL JOIN  project_details WHERE project.project_code = project_details.project_code AND project.project_code = "'.$id.'"');
        return $query->row();
    }

    public function gett_by_id($id){
        $query = $this->db->query('SELECT * FROM project_dtask WHERE project_dtask.projdtsk_id = "'.$id.'"');
        return $query->row();
    }

    public function getcc_by_id($id){
        $query = $this->db->query('SELECT * FROM project_task_comment INNER JOIN project_dtask ON project_dtask.projdtsk_id = project_task_comment.projdtsk_id WHERE prjtsk_comm_id =  "'.$id.'"');
        return $query->row();
    }

    public function getPM(){
        $query = $this->db->query('SELECT * FROM user WHERE usertype_id="ut2"');

        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    public function update($where, $data){
        $this->db->update('project', $data, $where);
        return $this->db->affected_rows(); 
    }

    public function update2($where, $data){

       $this->db->update('project_details',$data, $where);
              return $this->db->affected_rows();
    }
    
    public function get_item_id($id){
       
        $query = $this->db->query('SELECT material_used.mu_id,material_used.received_from, material.material_name, material_used.mu_quantity, material.material_unit, material_used.mu_date, supplier.supplier_name,unit_acro ,DATE_FORMAT(material_used.mu_date,"%M %d, %Y") AS ddate  FROM project INNER JOIN material_used ON material_used.project_code = project.project_code INNER JOIN material ON material.material_id = material_used.material_id INNER JOIN supplier ON supplier.supplier_id = material.supplier_id INNER JOIN units ON material.material_unit = units.unit_id WHERE project.project_code = "'.$id.'"');

        return $query->result();
    }

    public function get_teu_id($id){
       
        $query = $this->db->query('SELECT material.material_name, p2.project_title, transfer.transfer_date, CONCAT(transfer.transfer_quantity," " ,material.material_unit) AS quantity FROM transfer INNER JOIN material ON material.material_id = transfer.material_id INNER JOIN project AS p2 ON transfer.transfer_to = p2.project_code INNER JOIN project AS p1 ON p1.project_code = transfer.transfer_from WHERE  p1.project_code = "'.$id.'"');

        return $query->result();
    }

    public function get_eu_id($id){
       
          $query = $this->db->query('SELECT equipment_used.eu_id, equipment.equipment_name, equipment_used.eu_quantity, supplier.supplier_name, equipment_used.eu_date,DATE_FORMAT(equipment_used.eu_date,"%M %d, %Y") AS ddate FROM project INNER JOIN equipment_used ON equipment_used.project_code = project.project_code INNER JOIN equipment ON equipment.equipment_id = equipment_used.equipment_id INNER JOIN supplier ON supplier.supplier_id = equipment.supplier_id WHERE project.project_code = "'.$id.'"');
    
        return $query->result();
    }

    public function get_tm_id($id){
       
        $query = $this->db->query('SELECT transfered_material.transm_id,material.material_name, transfered_material.transfer_date, transfered_material.transfer_quantity, material.material_unit, p2.project_title, project.project_code FROM transfered_material INNER JOIN material_used ON transfered_material.mu_id = material_used.mu_id INNER JOIN material ON material_used.material_id = material.material_id INNER JOIN project AS p2 ON p2.project_code = transfered_material.transfer_to INNER JOIN project ON transfered_material.transfer_from = project.project_code WHERE project.project_code = "'.$id.'"');
    
        return $query->result();
    }

    public function get_te_id($id){
       
        $query = $this->db->query('SELECT transfered_equipment.transe_id,pro2.project_title,transfered_equipment.transfer_date,transfered_equipment.transfer_quantity,equipment.equipment_name FROM transfered_equipment INNER JOIN equipment_used ON transfered_equipment.eu_id = equipment_used.eu_id INNER JOIN equipment ON equipment.equipment_id = equipment_used.equipment_id INNER JOIN project ON project.project_code = transfered_equipment.transfer_from INNER JOIN project AS pro2 ON transfered_equipment.transfer_to = pro2.project_code WHERE project.project_code = "'.$id.'"');
    
        return $query->result();
    }
 
    public function getTasks($id){
        $query = $this->db->query('SELECT   project.project_code,project_dtask.projdtsk_id, project_task.projtsk_id, project.project_title, project.project_desc, project.project_status, project_task.projtsk_name, project_dtask.projdtsk_percent, project_dtask.projdtsk_date,project_dtask.projdtsk_update  FROM project_task INNER JOIN project_dtask ON project_task.projtsk_id = project_dtask.projtsk_id INNER JOIN project ON project.project_code = project_dtask.project_code AND project.project_code = "'.$id.'"');

        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    public function getTasksCom($id){
        $query = $this->db->query('SELECT * FROM project_task_comment INNER JOIN project_dtask ON project_dtask.projdtsk_id = project_task_comment.projdtsk_id WHERE project_dtask.projdtsk_id  = "'.$id.'"');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    public function addTask($data){
        $this->db->insert("project_dtask", $data);
    }

    public function addTaskcom($data){
        $this->db->insert("project_task_comment", $data);
        return $this->db->insert_id();
    }

    public function addTaskcom2($data){
        $this->db->insert("project_task_comment_update", $data);
        return $this->db->insert_id();
    }

    public function updatetaskcom($where, $data){
        $this->db->update('project_task_comment', $data, $where);
         
    }

    public function updatetaskcom2($where, $data, $data2){
        $this->db->from('project_task_comment_update');
        $this->db->where('prjtsk_comm_id', $where['prjtsk_comm_id']); 
        $query = $this->db->get();
        if($query->num_rows() != 0){
            $this->db->update('project_task_comment_update', $data, $where);
            return $this->db->affected_rows();
        }else{
            $this->db->insert('project_task_comment_update', $data2);
            return $this->db->insert_id();
        }
    }


    public function addTask2($data){
        $this->db->insert("updated_task", $data);
        return $this->db->insert_id();
    }

    public function updatetask($where, $data){
        $this->db->update('project_dtask', $data, $where);      
    }
    
    public function updatetask2($where, $data, $data2){
        $this->db->from('updated_task');
        $this->db->where('updated_task_id', $data2['updated_task_id']); 
        $query = $this->db->get();
        if($query->num_rows() != 0){
            $this->db->update('updated_task', $data, $where);
            return $this->db->affected_rows();
        }else{
            $this->db->insert('updated_task', $data2);
            return $this->db->insert_id();
        }
    }

    public function deletett_by_id($id){
        $this->db->where('projdtsk_id', $id);
        $this->db->delete('project_dtask');
    }

    public function getMaterial(){
        $query = $this->db->query('SELECT * FROM material');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }
    
    public function addMaterial($data){
        $this->db->insert("material_used", $data);
        return $this->db->insert_id();
    }

    public function getm_by_id($id){
        $query = $this->db->query('SELECT material_used.mu_id, material.material_name,material.material_id, material_used.mu_quantity, material.material_unit, material_used.mu_date, supplier.supplier_name FROM project INNER JOIN material_used ON material_used.project_code = project.project_code INNER JOIN material ON material.material_id = material_used.material_id INNER JOIN supplier ON supplier.supplier_id = material.supplier_id WHERE material_used.mu_id = "'.$id.'"');
        return $query->row();
    }

    public function updatemat($where, $data){
        $this->db->update('material_used', $data, $where);
        return $this->db->affected_rows();
    }

    public function deletem_by_id($id){
        $this->db->where('mu_id', $id);
        $this->db->delete('material_used');
    }

    public function getEquipment(){
        $query = $this->db->query('SELECT * FROM equipment');

        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    public function addEquipment($data){
        $this->db->insert("equipment_used", $data);
        return $this->db->insert_id();
    }

    public function gete_by_id($id){
        $query = $this->db->query('SELECT equipment.equipment_id, equipment_used.eu_id, equipment.equipment_name, equipment_used.eu_quantity, supplier.supplier_name, equipment_used.eu_date FROM project INNER JOIN equipment_used ON equipment_used.project_code = project.project_code INNER JOIN equipment ON equipment.equipment_id = equipment_used.equipment_id INNER JOIN supplier ON supplier.supplier_id = equipment.supplier_id  WHERE equipment_used.eu_id = "'.$id.'"');
        return $query->row();
    }

    public function updateequip($where, $data){
        $this->db->update('equipment_used', $data, $where);
        return $this->db->affected_rows();
    }

    public function deletee_by_id($id){
        $this->db->where('eu_id', $id);
        $this->db->delete('equipment_used');
    }

    public function transMaterial($data){
        $this->db->insert("transfered_material", $data);
        return $this->db->insert_id();
    }

    public function transEquip($data){
        $this->db->insert("transfered_equipment", $data);
        return $this->db->insert_id();
    }

}
