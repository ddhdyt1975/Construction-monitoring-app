<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Project extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function count_eqp($id){
        $query = $this->db->query('SELECT 
                                    quantity
                                    FROM
                                    admin_stock_equipment
                                    WHERE equipment_id ="'.$id.'" ');
        return $query->row('quantity');
    }

    public function count_eqp_ons($id, $id2){
        $query = $this->db->query('SELECT 
                                    quantity
                                    FROM
                                    manager_stock_equipment
                                    WHERE equipment_id ="'.$id.'" AND project_code = "'.$id2.'" ');
        return $query->row('quantity');
    }

    public function count_mat($id1, $id2){
         $query = $this->db->query('SELECT quantity
                                    FROM
                                    manager_stock
                                    WHERE material_id ="'.$id1.'" AND manager_stock.project_code = "'.$id2.'" ');
        return $query->row('quantity');
    }

    public function count_mats($id){
         $query = $this->db->query('SELECT quantity
                                    FROM
                                    admin_stock
                                    WHERE material_id ="'.$id.'" ');
        return $query->row('quantity');
    }

    public function okP($where, $data){
        $this->db->update('nextdayact', $data, $where);
        return $this->db->affected_rows();
    }

    public function VP($where, $data){
        $this->db->update('nextdayact', $data, $where);
        return $this->db->affected_rows();
    }

    public function getNA($id){
        $query = $this->db->query('SELECT
                                    nextdayact.project_code,
                                    nextdayact.nextAct,
                                    nextdayact.postDate,
                                    nextdayact.next_id,
                                    nextdayact.status,
                                    nextdayact.visible,
                                    project_task.projtsk_name
                                    FROM
                                    nextdayact
                                    INNER JOIN project_task ON nextdayact.task = project_task.projtsk_id
                                    WHERE project_code ="'.$id.'" ');
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

    function getAllProjects($data) {
        $condition = "user_id =" . "'" . $data['user_id'] . "'" ;
        $this->db->select('project_title,project_code');
        $this->db->from('project');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result();
    }
    
    function getProjDetails($project_title) {
        $query = $this->db->query('SELECT *
                                    FROM
                                    project
                                    INNER JOIN city ON city.city_id = project.city_id
                                    INNER JOIN province ON province.province_id = city.province_id
                                    INNER JOIN `user` ON `user`.user_id = project.user_id
                                    INNER JOIN project_details ON project_details.project_code = project.project_code
                            WHERE  project.project_code  = "'.$project_title.'" ');
        return $query->row();
    }

    function getProjs($project_title) {
        $query = $this->db->query('SELECT * FROM project WHERE  project.project_code NOT IN ("'.$project_title.'")');
        return $query->result();
    }

    function getOM($project_title) {
        $query = $this->db->query('SELECT *
            FROM
            manager_stock
            INNER JOIN material ON material.material_id = manager_stock.material_id
            INNER JOIN project ON project.project_code = manager_stock.project_code
            WHERE
            project.project_code = "'.$project_title.'"
            GROUP BY 
            manager_stock.stock_id');
        return $query->result();
    }

    function getOE($project_title) {
        $query = $this->db->query('SELECT equipment_used.eu_id,equipment_used.eu_date, equipment.equipment_id, equipment.equipment_name, equipment_used.project_code FROM project INNER JOIN equipment_used ON equipment_used.project_code = project.project_code INNER JOIN equipment ON equipment.equipment_id = equipment_used.equipment_id WHERE project.project_code ="'.$project_title.'"');
        return $query->result();
    }
    
    function getCity(){
        $query = $this->db->query('SELECT *
            FROM
            city
            INNER JOIN province ON city.province_id = province.province_id
        ');
                    
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

    function getFrom($id){
        $query = $this->db->query(' SELECT project_title FROM project WHERE project.project_code = "'.$id.'"');
        return $query->row();
    }

    public function getp_by_id($id){
        $query = $this->db->query(' SELECT * FROM project INNER JOIN user ON project.user_id = `user`.user_id INNER JOIN  project_details ON project.project_code = project_details.project_code WHERE project.project_code = "'.$id.'"');
        return $query->row();
    }
    
    public function getachv_by_id($id){
        $query = $this->db->query('SELECT * FROM project_achievement WHERE achv_id = "'.$id.'"');
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
       
        $query = $this->db->query('SELECT
            material_used.mu_id,
            material_used.received_from,
            material.material_name,
            material_used.mu_quantity,
            material_used.mu_date, 
            DATE_FORMAT(material_used.mu_date,"%M %d, %Y") AS ddate,
            units.unit_name,
            units.unit_acro
            FROM
            project
            INNER JOIN material_used ON material_used.project_code = project.project_code
            INNER JOIN material ON material.material_id = material_used.material_id 
            INNER JOIN units ON material.material_unit = units.unit_id
            WHERE project.project_code = "'.$id.'" GROUP BY material_used.mu_id');

        return $query->result();
    }

    public function get_teu_id($id){
       
        $query = $this->db->query('SELECT material.material_name, p2.project_title, transfer.transfer_date, CONCAT(transfer.transfer_quantity," " ,material.material_unit) AS quantity FROM transfer INNER JOIN material ON material.material_id = transfer.material_id INNER JOIN project AS p2 ON transfer.transfer_to = p2.project_code INNER JOIN project AS p1 ON p1.project_code = transfer.transfer_from WHERE  p1.project_code = "'.$id.'"');

        return $query->result();
    }

    public function get_eu_id($id){
       
        $query = $this->db->query('SELECT DATE_FORMAT(equipment_used.eu_date,"%M %d, %Y") AS ddate,
            equipment_used.eu_id,
            equipment_used.eu_date,
            equipment_used.eu_quantity,
            equipment_used.project_code,
            equipment.equipment_name,
            supplier.supplier_name
            FROM
            equipment_used
            INNER JOIN equipment ON equipment.equipment_id = equipment_used.equipment_id
            INNER JOIN supplier ON supplier.supplier_id = equipment.supplier_id
            INNER JOIN project ON project.project_code = equipment_used.project_code
            WHERE project.project_code = "'.$id.'"
            GROUP BY
            equipment_used.eu_id
        ');
        return $query->result();
    }

    public function get_tm_id($id){
       
        $query = $this->db->query('SELECT
            material_receive.material_date,
            material.material_name,
            manager_stock.quantity,
            manager_stock.stock_id,
            units.unit_acro,
            material_receive.receiver_from
            FROM
            project
            INNER JOIN manager_stock ON manager_stock.project_code = project.project_code
            INNER JOIN material ON material.material_id = manager_stock.material_id
            INNER JOIN material_receive ON material_receive.material_id = manager_stock.material_id
            INNER JOIN units ON material.material_unit = units.unit_id
            WHERE
            manager_stock.project_code = "'.$id.'" GROUP BY manager_stock.material_id');
        return $query->result();
    }

    public function get_tm_rec($id){
       
        $query = $this->db->query('SELECT
            material.material_name,
            transfered_material.transfer_quantity,
            units.unit_acro,
            project.project_title,
            transfered_material.transfer_date
            FROM
            transfered_material
            INNER JOIN material ON material.material_id = transfered_material.mu_id
            INNER JOIN units ON material.material_unit = units.unit_id
            INNER JOIN project  ON transfered_material.transfer_from =  project.project_code 
            WHERE transfered_material.transfer_to = "'.$id.'" ');
        return $query->result();
    }

    public function get_eq_rec($id){
       
        $query = $this->db->query('SELECT
            equipment.equipment_name,
            transfered_equipment.transfer_quantity,
            project.project_title,
            transfered_equipment.transfer_date
            FROM
            transfered_equipment
            INNER JOIN project ON transfered_equipment.transfer_to = project.project_code
            INNER JOIN equipment ON equipment.equipment_id = transfered_equipment.eu_id
            WHERE transfered_equipment.transfer_to = "'.$id.'" ');
        return $query->result();
    }

    public function get_te_id($id){
       
        $query = $this->db->query('SELECT
            equipment.equipment_name,
            manager_stock_equipment.quantity,
            manager_stock_equipment.equipment_id
            FROM
            manager_stock_equipment
            INNER JOIN equipment_receive ON equipment_receive.equipment_id = manager_stock_equipment.equipment_id
            INNER JOIN equipment ON equipment.equipment_id = equipment_receive.equipment_id
            WHERE manager_stock_equipment.project_code = "'.$id.'" GROUP BY
            manager_stock_equipment.equipment_id');
        return $query->result();
    }
 
    public function getTasks($id){
        $query = $this->db->query('SELECT   project.project_code,project_dtask.projdtsk_id,project_task.projtsk_desc, project_task.projtsk_id, project.project_title, project.project_desc, project.project_status, project_task.projtsk_name, project_dtask.projdtsk_percent, project_dtask.projdtsk_date,project_dtask.projdtsk_update  FROM project_task INNER JOIN project_dtask ON project_task.projtsk_id = project_dtask.projtsk_id INNER JOIN project ON project.project_code = project_dtask.project_code AND project.project_code = "'.$id.'"');

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

    public function addAchv($data){
        $this->db->insert("project_achievement", $data);   
        return $this->db->insert_id();
    }

    public function getAc($id){
        $query = $this->db->query('SELECT *, DATE_FORMAT(achv_date,"%M %d, %Y") AS ddate, DATE_FORMAT(achv_date,"%h:%i %p") AS time FROM project_achievement WHERE project_code = "'.$id.'" ORDER BY achv_date DESC ');

        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }    
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
        $query = $this->db->query('SELECT  
                                    *
                                    FROM
                                    admin_stock
                                    INNER JOIN material ON admin_stock.material_id = material.material_id
                                    GROUP BY
                                    admin_stock.material_id');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }
    
    public function addMaterial($data, $data2){

        $query2 = $this->db->query('SELECT * FROM manager_stock WHERE material_id = "'.$data['material_id'].'" AND manager_stock.project_code = "'.$data['project_code'].'"');
        if ($query2->num_rows() > 0){
            $query = $this->db->query('UPDATE manager_stock SET quantity =  quantity + '.$data2['quantity'].' WHERE  material_id = "'.$data2['material_id'].'" ');
        }
        else{
            $this->db->insert("manager_stock", $data2);
        }  

        $query5 = $this->db->query('SELECT * FROM material_receive WHERE material_id = "'.$data['material_id'].'" AND  material_date = "'.$data['material_date'].'" AND material_receive.project_code = "'.$data['project_code'].'"');
        if ($query5->num_rows() > 0){
            $query4 = $this->db->query('UPDATE material_receive SET material_quantity = material_quantity +  "'.$data['material_quantity'].'" WHERE material_id = "'.$data['material_id'].'"  AND material_date = "'.$data['material_date'].'"');
        }
        else{
            $this->db->insert("material_receive", $data);
        }
        
    }

    public function minusMaterial($data){
        $query = $this->db->query('UPDATE
                                    admin_stock
                                    SET quantity =  quantity - '.$data['material_quantity'].'
                                    WHERE
                                    material_id = "'.$data['material_id'].'" ');
        return $this->db->affected_rows();
    }

    public function addMaterial2($data){
        $this->db->insert("material_used", $data);
        return $this->db->insert_id();
    }

    public function minusMaterial2($data){
        $query = $this->db->query('UPDATE
                                    manager_stock
                                    SET quantity =  quantity - '.$data['mu_quantity'].'
                                    WHERE
                                    material_id = "'.$data['material_id'].'" AND manager_stock.project_code ="'.$data['project_code'].'" ');
        return $this->db->affected_rows();
    }

    public function getm_by_id($id){
        $query = $this->db->query('SELECT * FROM material_receive INNER JOIN material ON material.material_id = material_receive.material_id INNER JOIN supplier ON supplier.supplier_id = material.supplier_id INNER JOIN manager_stock ON manager_stock.material_id = material_receive.material_id WHERE manager_stock.stock_id = "'.$id.'"');
        return $query->row();
    }

    public function getm_by_id2($id){
        $query = $this->db->query('SELECT * FROM material_used INNER JOIN material ON material.material_id = material_used.material_id WHERE material_used.mu_id = "'.$id['id'].'" AND mu_date = "'.$id['date'].'" GROUP BY mu_id ');
        return $query->row();
    }

    public function updatematstock($data, $data2, $data3, $data4){
        $query = $this->db->query('SELECT * FROM material_used WHERE material_id = "'.$data3['material_id'].'" AND  mu_date = "'.$data3['material_date'].'" AND material_used.project_code = "'.$data3['project_code'].'"');
        if ($query->num_rows() > 0){
            $query4 = $this->db->query('UPDATE material_used SET mu_quantity = mu_quantity +  "'.$data4['quantity'].'" WHERE material_id = "'.$data2['material_id'].'"  AND mu_date = "'.$data3['material_date'].'" AND material_used.project_code = "'.$data3['project_code'].'" ');
        }
        else{
            $this->db->insert("material_receive", $data3);
        }

        $query2 = $this->db->query('SELECT * FROM manager_stock WHERE material_id = "'.$data2['material_id'].'" AND manager_stock.project_code = "'.$data4['project_code'].'" ');
        if ($query2->num_rows() > 0){
            $query = $this->db->query('UPDATE manager_stock SET quantity =  quantity + '.$data4['quantity'].' WHERE  material_id = "'.$data2['material_id'].'"  AND manager_stock.project_code = "'.$data4['project_code'].'" ');
        }
        else{
            $this->db->insert("manager_stock", $data4);
        }

        return $this->db->affected_rows();
    }

    public function updatematstock2($data, $data2, $data3, $data4){
        $query = $this->db->query('SELECT * FROM material_used WHERE material_id = "'.$data3['material_id'].'" AND  mu_date = "'.$data3['mu_date'].'" AND material_used.project_code = "'.$data3['project_code'].'"');
        if ($query->num_rows() > 0){
            $query4 = $this->db->query('UPDATE material_used SET mu_quantity = mu_quantity +  "'.$data4['quantity'].'" WHERE material_id = "'.$data2['material_id'].'"  AND mu_date = "'.$data3['mu_date'].'" AND material_used.project_code = "'.$data3['project_code'].'" ');
        }
        else{
            $this->db->insert("material_used", $data3);
        }

        $query2 = $this->db->query('SELECT * FROM manager_stock WHERE material_id = "'.$data2['material_id'].'" AND manager_stock.project_code = "'.$data4['project_code'].'" ');
        if ($query2->num_rows() > 0){
            $query = $this->db->query('UPDATE manager_stock SET quantity =  quantity - '.$data4['quantity'].' WHERE  material_id = "'.$data2['material_id'].'"  AND manager_stock.project_code = "'.$data4['project_code'].'" ');
        }
        else{
            $this->db->insert("manager_stock", $data4);
        }

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

    public function addEquipmenttostock($data){
        $query2 = $this->db->query('INSERT INTO manager_stock_equipment VALUES ("", "'.$data['equipment_id'].'", "'.$data['equipment_quantity'].'", "'.$data['project_code'].'") ');
        $this->db->insert("equipment_receive", $data);
        return $this->db->insert_id();
    }

    public function updateEquipmenttostock($data){
        $query = $this->db->query('SELECT * FROM manager_stock_equipment WHERE manager_stock_equipment.equipment_id = "'.$data['equipment_id'].'" AND project_code = "'.$data['project_code'].'" ');
        if($query->num_rows() > 0){
            $query2 = $this->db->query('UPDATE manager_stock_equipment SET quantity =  quantity + "'.$data['equipment_quantity'].'" WHERE  equipment_id = "'.$data['equipment_id'].'" AND project_code = "'.$data['project_code'].'" ');            
        }
        else{
            $query2 = $this->db->query('INSERT INTO manager_stock_equipment VALUES ("", "'.$data['equipment_id'].'", "'.$data['equipment_quantity'].'", "'.$data['project_code'].'") ');
        }

        $query3 = $this->db->query('SELECT * FROM equipment_receive WHERE equipment_id = "'.$data['equipment_id'].'" AND equipment_date = "'.$data['equipment_date'].'" AND project_code = "'.$data['project_code'].'" ');
        if($query3->num_rows() > 0){
            $query2 = $this->db->query('UPDATE equipment_receive SET equipment_quantity =  equipment_quantity + "'.$data['equipment_quantity'].'" WHERE  equipment_id = "'.$data['equipment_id'].'" AND project_code = "'.$data['project_code'].'" ');            
        }
        else{
            $this->db->insert("equipment_receive", $data);
        }
        return $this->db->insert_id();
    }

    public function updateEquipmenttopro($data){
        $query = $this->db->query('SELECT * FROM equipment_used WHERE equipment_used.equipment_id = "'.$data['equipment_id'].'" AND equipment_used.project_code = "'.$data['project_code'].'" AND equipment_used.eu_date = "'.$data['eu_date'].'" ');
        if($query->num_rows() > 0){
            $query2 = $this->db->query('UPDATE equipment_used SET eu_quantity =  eu_quantity + "'.$data['eu_quantity'].'" WHERE  equipment_id = "'.$data['equipment_id'].'" AND project_code = "'.$data['project_code'].'" AND equipment_used.eu_date = "'.$data['eu_date'].'"  ');            
        }
        else{
            $this->db->insert("equipment_used", $data);
            //$query2 = $this->db->query('INSERT INTO manager_stock_equipment VALUES ("", "'.$data['equipment_id'].'", "'.$data['equipment_quantity'].'", "'.$data['project_code'].'") ');
        }
    }

    public function minusEquipmenttoadmin($data){
        $query = $this->db->query('UPDATE
            admin_stock_equipment
            SET  quantity =   quantity - '.$data['equipment_quantity'].'
            WHERE
            equipment_id = "'.$data['equipment_id'].'" ');
    }

    public function minusEquipmenttomanager($data){
        $query = $this->db->query('UPDATE
            manager_stock_equipment
            SET  quantity =   quantity - '.$data['eu_quantity'].'
            WHERE
            equipment_id = "'.$data['equipment_id'].'"  AND project_code = "'.$data['project_code'].'" ');
    }

    public function getess_by_id($id, $id2){
        $query = $this->db->query('SELECT
            *
            FROM
            manager_stock_equipment
            INNER JOIN equipment ON equipment.equipment_id = manager_stock_equipment.equipment_id
            WHERE manager_stock_equipment.equipment_id ="'.$id.'" AND project_code = "'.$id2.'"
            GROUP BY
            manager_stock_equipment.equipment_id');
        return $query->row();
    }

    public function getesp_by_id($id, $id2){
        $query = $this->db->query('SELECT *
            FROM
            equipment_used
            INNER JOIN equipment ON equipment.equipment_id = equipment_used.equipment_id
            WHERE 
            equipment_used.eu_id ="'.$id.'" AND equipment_used.project_code = "'.$id2.'" ');
        return $query->row();
    }

    public function updateequip($data){
        $query = $this->db->query('UPDATE
                                     equipment_used
                                    SET eu_quantity =  eu_quantity + '.$data['eu_quantity'].'
                                    WHERE
                                    eu_id = "'.$data['eu_id'].'" ');
        return $this->db->affected_rows();
    }

    public function deletee_by_id($id){
        $this->db->where('eu_id', $id);
        $this->db->delete('equipment_used');
    }

    public function deleteachv_by_id($id){
        $this->db->where('achv_id', $id);
        $this->db->delete('project_achievement');
    }

    public function transMaterial($data){
        $this->db->insert("transfered_material", $data);
        return $this->db->insert_id();
    }

    public function transEquip($data){
        $this->db->insert("transfered_equipment", $data);
        return $this->db->insert_id();
    }

    public function getms_by_id($id){
        $query = $this->db->query('SELECT
                                *
                                FROM
                                manager_stock
                                INNER JOIN material ON material.material_id = manager_stock.material_id
                                WHERE manager_stock.project_code = "'.$id.'" AND manager_stock.quantity > 0
                                GROUP BY
                                manager_stock.material_id');
        return $query->result();
    }

    public function getes_by_id($com){
        $query = $this->db->query('SELECT
                                *
                                FROM
                                admin_stock_equipment
                                INNER JOIN equipment ON equipment.equipment_id = admin_stock_equipment.equipment_id
                                WHERE  admin_stock_equipment.quantity > 0 AND admin_stock_equipment.company_id = "'.$com.'"
                                GROUP BY
                                admin_stock_equipment.equipment_id');
        return $query->result();
    }

    public function getep_by_id($id){
        $query = $this->db->query('SELECT
            manager_stock_equipment.equipment_id,
            equipment.equipment_name,
            manager_stock_equipment.quantity,
            manager_stock_equipment.project_code
            FROM
            manager_stock_equipment
            INNER JOIN equipment ON equipment.equipment_id = manager_stock_equipment.equipment_id
            WHERE manager_stock_equipment.project_code = "'.$id.'" AND manager_stock_equipment.quantity > 0
            GROUP BY
            manager_stock_equipment.equipment_id');
        return $query->result();
    }
    public function getmss_by_id($com){
        $query = $this->db->query('SELECT
                                *
                                FROM
                                admin_stock
                                INNER JOIN material ON material.material_id = admin_stock.material_id
                                WHERE admin_stock.quantity > 0 AND admin_stock.company_id = "'.$com.'"
                                GROUP BY
                                admin_stock.material_id');
        return $query->result();
    }

    function addN($data){
        $this->db->insert("nextdayact", $data);
        return $this->db->insert_id();
    }
}
