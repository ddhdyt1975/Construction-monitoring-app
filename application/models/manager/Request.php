<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Request extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function count_mat($id){
         $query = $this->db->query('SELECT material_used.mu_quantity
                                    FROM
                                    material_used
                                    WHERE mu_id ="'.$id.'" ');
        return $query->row('mu_quantity');
    }

    public function seennotif($id, $data){
       $query = $this->db->query('UPDATE
                                    updated_task 
                                    INNER JOIN project ON updated_task.project_code = project.project_code
                                    SET updated_task.seen_by_PM = "'.$data.'"
                                    WHERE
                                    updated_task.seen_by_PM IS NULL AND updated_task.updated_by IS NOT NULL AND project.user_id = "'.$id.'" ');
        return $this->db->affected_rows(); 
    }
          
    public function seen($where, $data){
        $this->db->update('project_request', $data, $where);
        return $this->db->affected_rows(); 
    }

    public function view_m2($data,$id){
        $query = $this->db->query('SELECT
                                    project_request.request_id,
                                    project.project_code,
                                    project_request.request_severity,
                                    project.project_title,
                                    project_request.req_date,
                                    p2.project_title,
                                    user1.user_fname,
                                    user1.user_lname,
                                    user1.user_photo,
                                    project_request.material_req,
                                    project_request.material_req_stat,
                                    project_request.equipment_req,
                                    project_request.equipment_req_stat,
                                    project_request.worker_req,
                                    project_request.worker_req_stat,
                                    project_request.req_from,
                                    project_request.req_to,
                                    project_request.remarks,
                                    project_request.req_stat,
                                    project_request.seen_date,
                                    user1.user_email,
                                    user.user_fname AS userr,
                                    DATE_FORMAT(project_request.req_date,"%h:%i %p") AS time
                                    FROM
                                    project_request
                                    INNER JOIN project ON project_request.req_from = project.project_code
                                    INNER JOIN `user` ON `user`.user_id = project.user_id
                                    INNER JOIN project AS p2 ON p2.project_code = project_request.req_to
                                    INNER JOIN `user` AS user1 ON user1.user_id = p2.user_id
                                    INNER JOIN usertype ON usertype.usertype_id = user1.usertype_id
                                    WHERE
                                    project.user_id = "'.$data.'" AND project_request.request_id = "'.$id.'" ');
        return $query->result();
    }

    public function view_ms($data){
        $query = $this->db->query('SELECT
                                    project_request.request_id,
                                    project.project_code,
                                    project_request.request_severity,
                                    project.project_title AS p1,
                                    project_request.req_date,
                                    p2.project_title,
                                    user1.user_fname,
                                    user1.user_lname,
                                    user1.user_photo,
                                    project_request.seen_date,
                                    DATE_FORMAT(project_request.req_date,"%h:%i %p") AS time,
                                    `user`.user_fname,
                                    `user`.user_lname
                                    FROM
                                    project_request
                                    INNER JOIN project ON project_request.req_from = project.project_code
                                    INNER JOIN `user` ON `user`.user_id = project.user_id
                                    INNER JOIN project AS p2 ON p2.project_code = project_request.req_to
                                    INNER JOIN `user` AS user1 ON user1.user_id = p2.user_id
                                    INNER JOIN usertype ON usertype.usertype_id = user1.usertype_id
                                    WHERE
                                    p2.user_id = "'.$data.'"');
        return $query->result();
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
                                    user1.user_photo,
                                    project_request.seen_date,
                                    DATE_FORMAT(project_request.req_date,"%h:%i %p") AS time
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

    public function get_te_id($data){
        $query = $this->db->query('SELECT
                                    transfered_equipment.transe_id,
                                    equipment.equipment_name,
                                    transfered_equipment.transfer_quantity,
                                    project.project_title,
                                    transfered_equipment.transfer_date
                                    FROM
                                    transfered_equipment
                                    INNER JOIN equipment ON transfered_equipment.eu_id = equipment.equipment_id
                                    INNER JOIN project AS p2 ON p2.project_code = transfered_equipment.transfer_from
                                    INNER JOIN project ON project.project_code = transfered_equipment.transfer_to
                                    WHERE 
                                    p2.user_id = "'.$data.'"');
        return $query->result();
    }

    public function get_tm_id($data){
       
        $query = $this->db->query('SELECT
                                    material.material_name,
                                    transfered_material.transfer_to,
                                    transfered_material.transfer_date,
                                    transfered_material.transfer_quantity,
                                    material.material_unit,
                                    transfered_material.transm_id,
                                    material.material_id,
                                    project.project_title,
                                    units.unit_acro
                                    FROM
                                    transfered_material
                                    INNER JOIN material ON material.material_id = transfered_material.mu_id
                                    INNER JOIN project ON project.project_code = transfered_material.transfer_to
                                    INNER JOIN project AS p2 ON p2.project_code = transfered_material.transfer_from
                                    INNER JOIN units ON units.unit_id = material.material_unit                                    
                                    WHERE 
                                    p2.user_id = "'.$data.'" GROUP BY transfered_material.transm_id');
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
                                    project.user_id = "'.$data.'" AND ISNULL(project_request.seen_date)');
        return $query->num_rows();
    }

    public function count_mr($data){
        $query = $this->db->query('SELECT
                                    project_request.request_id
                                    FROM
                                    project_request
                                    INNER JOIN project ON project_request.req_to = project.project_code
                                    INNER JOIN `user` ON `user`.user_id = project.user_id
                                    WHERE
                                    project.user_id = "'.$data.'"');
        return $query->num_rows();
    }

    public function addRequest($data){
        $this->db->insert("project_request", $data);
        return $this->db->insert_id();
    }

    public function count_eq($data){
        $query = $this->db->query('SELECT
                                    SUM(transfered_equipment.transfer_quantity) AS sum
                                    FROM
                                    transfered_equipment
                                    INNER JOIN equipment ON transfered_equipment.eu_id = equipment.equipment_id
                                    INNER JOIN project AS p2 ON p2.project_code = transfered_equipment.transfer_from
                                    INNER JOIN project ON project.project_code = transfered_equipment.transfer_to
                                    WHERE 
                                    p2.user_id = "'.$data.'"');
        return $query->row('sum');
    }
    
    public function addEquipment($data){
        $query = $this->db->query('SELECT * FROM manager_stock_equipment WHERE equipment_id = "'.$data['equipment_id'].'" AND project_code = "'.$data['project_code'].'"');
        if ($query->num_rows() > 0){
            $query3 = $this->db->query('UPDATE manager_stock_equipment SET quantity =  quantity + '.$data['equipment_quantity'].' WHERE  equipment_id = "'.$data['equipment_id'].'" AND project_code = "'.$data['project_code'].'" ');            
        }
        else{
            $query2 = $this->db->query('INSERT INTO manager_stock_equipment VALUES ("", "'.$data['equipment_id'].'", "'.$data['equipment_quantity'].'", "'.$data['project_code'].'") ');
        }

        $query5 = $this->db->query('UPDATE manager_stock_equipment SET quantity =  quantity - '.$data['equipment_quantity'].' WHERE  equipment_id = "'.$data['equipment_id'].'" AND  project_code = "'.$data['receiver_from'].'" ');
      
        $this->db->insert("equipment_receive", $data);


        return $this->db->insert_id();
    }

    public function transEquip($data){
        $this->db->insert("transfered_equipment", $data);
        return $this->db->insert_id();
    }

    public function count_tm($data){
        $query = $this->db->query('SELECT
                                    SUM(transfered_material.transfer_quantity) as sum
                                    FROM
                                    transfered_material
                                    INNER JOIN project ON project.project_code = transfered_material.transfer_from
                                    WHERE 
                                    project.user_id = "'.$data.'" ');
        return $query->row('sum');
    }

    public function addMaterial($data, $data2){
        $query2 = $this->db->query('SELECT * FROM manager_stock WHERE material_id = "'.$data['material_id'].'" AND manager_stock.project_code = "'.$data['project_code'].'"');
        if ($query2->num_rows() > 0){
            $query = $this->db->query('UPDATE manager_stock SET quantity =  quantity + '.$data2['material_quantity'].' WHERE  material_id = "'.$data2['material_id'].'" AND manager_stock.project_code = "'.$data['project_code'].'" ');
        }
        else{
            $this->db->insert("manager_stock", $data);
        }   

        $query5 = $this->db->query('UPDATE manager_stock SET quantity =  quantity - '.$data2['material_quantity'].' WHERE  material_id = "'.$data2['material_id'].'" AND manager_stock.project_code = "'.$data2['receiver_from'].'" ');
      
        $this->db->insert("material_receive", $data2);
        
 
        return $this->db->insert_id();
    }

    public function transMaterial($data){
        $this->db->insert("transfered_material", $data);
        return $this->db->insert_id();
    }
    
    public function getI($id){
        $query = $this->db->query('SELECT
                                    project.project_title,
                                    project.project_status,
                                    project_details.project_type,
                                    project_details.project_sub_contractor,
                                    project_details.project_comp_contract,
                                    CONCAT(project.project_address,", ",city.city_name,", ",province.province_name,", ",province.zip_code) AS addrsess,
                                    CONCAT(user.user_fname," ",user.user_lname) as PM
                                    FROM
                                    project
                                    INNER JOIN project_details ON project_details.project_code = project.project_code
                                    INNER JOIN city ON city.city_id = project.city_id
                                    INNER JOIN province ON province.province_id = city.province_id
                                    INNER JOIN user ON user.user_id = project.user_id
                                    WHERE project.project_code="'.$id.'"');
        return $query->result(); 
    }

    public function getMat($id){
        $query = $this->db->query('SELECT
                                    project.project_title,
                                    material.material_name,
                                    CONCAT(SUM(material_used.mu_quantity)," ",units.unit_acro) AS mat_qty
                                    FROM
                                    project
                                    INNER JOIN material_used ON material_used.project_code = project.project_code
                                    INNER JOIN material ON material.material_id = material_used.material_id
                                    INNER JOIN units ON units.unit_id = material.material_unit                                    
                                    WHERE project.project_code  ="'.$id.'"
                                    GROUP BY
                                    material.material_name');
        return $query->result(); 
    }

    public function getEquip($id){
        $query = $this->db->query('SELECT
                                    project.project_title,
                                    equipment.equipment_name,
                                    SUM(equipment_used.eu_quantity) AS equip_qty
                                    FROM
                                    project
                                    INNER JOIN equipment_used ON equipment_used.project_code = project.project_code
                                    INNER JOIN equipment ON equipment.equipment_id = equipment_used.equipment_id
                                    WHERE project.project_code ="'.$id.'"
                                    GROUP BY
                                    equipment.equipment_name');
        return $query->result(); 
    }

    public function getmyMat($id, $id2){
        $query = $this->db->query('SELECT
                                    material.material_id,
                                    material.material_name,
                                    manager_stock.quantity
                                    FROM
                                    manager_stock
                                    INNER JOIN material ON manager_stock.material_id = material.material_id
                                    INNER JOIN project ON manager_stock.project_code = project.project_code
                                    WHERE
                                    project.user_id = "'.$id2['user_id'].'" AND project.project_code =  "'.$id.'"
                                    GROUP BY
                                    material.material_name 
                                    ');
        return $query->result(); 
    }

    public function count_eqp2($id1, $id2){
         $query = $this->db->query('SELECT
                                    quantity
                                    FROM
                                    manager_stock_equipment
                                    WHERE
                                    manager_stock_equipment.equipment_id = "'.$id1.'" AND manager_stock_equipment.project_code =  "'.$id2.'"
                                    ');
        return $query->row('quantity'); 
    }

    public function count_mat2($id1, $id2){
         $query = $this->db->query('SELECT
                                    quantity
                                    FROM
                                    manager_stock
                                    WHERE
                                    manager_stock.material_id = "'.$id1.'" AND manager_stock.project_code =  "'.$id2.'"
                                    ');
        return $query->row('quantity'); 
    }

    public function getmyMatc($id, $id2, $id3){
        $query = $this->db->query('SELECT
                                    SUM(material_used.mu_quantity) AS mu_quantity
                                    FROM
                                    project
                                    INNER JOIN material_used ON project.project_code = material_used.project_code
                                    INNER JOIN material ON material_used.material_id = material.material_id
                                    WHERE
                                    project.user_id = "'.$id2['user_id'].'" AND project.project_code =  "'.$id3.'" AND material_used.material_id ="'.$id.'"
                                    GROUP BY
                                    material.material_name,
                                    project.project_code');
        return $query->row('mu_quantity'); 
    }

    public function getmyEqp($id, $id2){
        $query = $this->db->query('SELECT
            equipment.equipment_name,
            manager_stock_equipment.quantity,
            manager_stock_equipment.equipment_id
            FROM
            manager_stock_equipment
            INNER JOIN project ON manager_stock_equipment.project_code = project.project_code
            INNER JOIN equipment ON equipment.equipment_id = manager_stock_equipment.equipment_id
            WHERE
            project.user_id = "'.$id2['user_id'].'" AND project.project_code =  "'.$id.'" AND manager_stock_equipment.quantity > 0');
        return $query->result(); 
    }

    public function getTasks($id){
        $query = $this->db->query('SELECT project.project_code,project_dtask.projdtsk_id, project_task.projtsk_id, project.project_title, project.project_desc, project.project_status, project_task.projtsk_name, project_dtask.projdtsk_percent, project_dtask.projdtsk_date,project_dtask.projdtsk_update  FROM project_task INNER JOIN project_dtask ON project_task.projtsk_id = project_dtask.projtsk_id INNER JOIN project ON project.project_code = project_dtask.project_code AND project.project_code = "'.$id.'"');
        return $query->result();
    }

    public function getData($id){
        $query = $this->db->query('SELECT *,DATE_FORMAT(registered_date,"%M %d, %Y") AS ddate, DATE_FORMAT(registered_date,"%h:%i %p") AS time FROM `user` INNER JOIN city ON city.city_id = `user`.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id INNER JOIN company_details ON company_details.company_id = `user`.company WHERE user_id = "'.$id['user_id'].'"');
        return $query->row();
    }

    function getAllProjects($data, $com) {
       
        $query = $this->db->query('SELECT * FROM project INNER JOIN user WHERE  project.user_id = user.user_id AND project.user_id NOT IN ("'.$data['user_id'].'") AND user.company = "'.$com.'"');
        return $query->result();
    }

    function getMyProjects($data) {
       
        $query = $this->db->query('SELECT * FROM project INNER JOIN user WHERE  project.user_id = user.user_id AND project.user_id = "'.$data['user_id'].'" ');
        return $query->result();
    }
    
    function getCity(){
        $query = $this->db->query('SELECT * FROM city NATURAL JOIN province');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function getAllWorkerType(){
        $query = $this->db->query('SELECT   * FROM  worker_type ');
        return $query->result();
    }

    public function savewt($data){
        $this->db->insert('worker_type', $data);
        return $this->db->insert_id();
    }

    public function saveworker($data){
        $this->db->insert('project_worker', $data);
        return $this->db->insert_id();
    }

    public function updateworker($where, $data){
        $this->db->update('project_worker', $data, $where);
        return $this->db->affected_rows(); 
    }


    public function countworker(){
        $query = $this->db->query('SELECT project_worker.pworker_id AS id FROM   project_worker ORDER BY project_worker.pworker_id DESC LIMIT 1');
        return $query->row('id');
    }
    
    public function get_worker_id($id){
        $query = $this->db->query('SELECT * FROM project_worker WHERE user_id = "'.$id['user_id'].'"');
        return $query->result();
    }

    public function get_worker_id2($id, $date, $date2, $date3, $proj){
        $query = $this->db->query('SELECT * FROM worker_designation INNER JOIN project_worker ON worker_designation.pworker_id = project_worker.pworker_id INNER JOIN worker_type ON worker_designation.worker_type_id = worker_type.worker_type_id INNER JOIN `user` ON `user`.user_id = project_worker.user_id INNER JOIN project ON project.user_id = project_worker.user_id WHERE  project_worker.user_id ="'.$id['user_id'].'" AND DATE_FORMAT(desig_date,"%m/%d/%Y") = "'.$date.'/'.$date2.'/'.$date3.'" AND project.project_code = "'.$proj.'" ');
        return $query->result();
    }

    public function getWorker($id){
        $query = $this->db->query('SELECT * FROM project_worker INNER JOIN city ON project_worker.city_id = city.city_id INNER JOIN province ON city.province_id = province.province_id WHERE pworker_id = "'.$id.'"');
        return $query->result();
    }
   
    function worker_img($path, $userid) {

        $updateData = array('worker_photo' => $path);

        $this->db->where("pworker_id",$userid);
        $this->db->update("project_worker",$updateData);
    }
    
    function designateworker($data){
        $this->db->insert('worker_designation', $data);
        return $this->db->insert_id();
    }
}