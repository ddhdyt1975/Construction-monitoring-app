<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Dashboard extends CI_Model {

    public function __construct() {
      parent::__construct();
    }

    public function check_list($id, $data){
       $query = $this->db->query('UPDATE
                                    nexdayact 
                                    SET status = "'.$data.'"
                                    WHERE
                                    next_id = "'.$id.'" ');
        return $this->db->affected_rows(); 
    }

    function getAllProjects($data) {
        $condition = "user_id =" . "'" . $data['user_id'] . "'" ;
        $this->db->select('project_title,project_code');
        $this->db->from('project');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getNA($id){
        $query = $this->db->query('SELECT
                                    nexdayact.project_code,
                                    nexdayact.nextAct,
                                    nexdayact.postDate,
                                    nexdayact.next_id,
                                    nexdayact.status,
                                    DATE_FORMAT(postDate,"%h:%i %p") AS time2,
                                    project_task.projtsk_name
                                    FROM
                                    nexdayact
                                    INNER JOIN project_task ON nexdayact.task = project_task.projtsk_id
                                    WHERE project_code ="'.$id.'" ');
        return $query->result();
    }

    public function view_notif($data){
        $query = $this->db->query('SELECT
                                    project_task.projtsk_name,
                                    updated_task.updated_percent,
                                    updated_task.update_date,
                                    project.project_title,
                                    CONCAT(user.user_fname," ",user.user_lname) AS updated_by,
                                    usertype.usertype_name,
                                    updated_task.updated_task_id
                                    FROM
                                    project_task
                                    INNER JOIN updated_task ON project_task.projtsk_id = updated_task.task_id
                                    INNER JOIN project ON project.project_code = updated_task.project_code
                                    INNER JOIN `user` ON `user`.user_id = updated_task.updated_by
                                    INNER JOIN usertype ON `user`.usertype_id = usertype.usertype_id
                                    WHERE
                                    project.user_id = "'.$data.'"');
        return $query->result();
    }

    public function count_notif($data){
        $query = $this->db->query('SELECT
                                    project_task.projtsk_name,
                                    updated_task.updated_percent,
                                    updated_task.update_date,
                                    project.project_title,
                                    CONCAT(user.user_fname," ",user.user_lname) AS updated_by,
                                    usertype.usertype_name
                                    FROM
                                    project_task
                                    INNER JOIN updated_task ON project_task.projtsk_id = updated_task.task_id
                                    INNER JOIN project ON project.project_code = updated_task.project_code
                                    INNER JOIN `user` ON `user`.user_id = updated_task.updated_by
                                    INNER JOIN usertype ON `user`.usertype_id = usertype.usertype_id
                                    WHERE
                                    updated_task.seen_by_PM IS NULL AND updated_task.updated_by IS NOT NULL AND project.user_id = "'.$data.'"');
        return $query->num_rows();
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
    
    public function getData($id){
        $query = $this->db->query('SELECT *,DATE_FORMAT(registered_date,"%M %d, %Y") AS ddate, DATE_FORMAT(registered_date,"%h:%i %p") AS time FROM `user` INNER JOIN city ON city.city_id = `user`.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id  INNER JOIN company_details ON company_details.company_id = `user`.company WHERE user_id = "'.$id['user_id'].'"');
        return $query->row();
    }

    public function count_all1($data){
        $query = $this->db->query('SELECT * FROM project INNER JOIN `user` ON `user`.user_id = project.user_id WHERE project.user_id = "'.$data['user_id'].'" ');
        return $query->num_rows();
    }

    public function count_all2($data){
        $query = $this->db->query('SELECT
            SUM(material_used.mu_quantity) AS total
            FROM
            material_used
            INNER JOIN project ON project.project_code = material_used.project_code
            INNER JOIN `user` ON `user`.user_id = project.user_id
            WHERE project.user_id = "'.$data['user_id'].'" ');
        return $query->row('total');
    }

    public function count_all3($data){
        $query = $this->db->query('SELECT
            SUM(equipment_used.eu_quantity) as total
            FROM
            equipment_used
            INNER JOIN project ON equipment_used.project_code = project.project_code
            WHERE 
            project.user_id = "'.$data['user_id'].'" ');
        return $query->row('total');
    }

    public function count_all4($data){
        $query = $this->db->query('SELECT   COUNT(*) AS total  FROM supplier  WHERE supplier.company_id = "'.$data['com'].'" ');
        return $query->row('total');
    }
  
    public function count_all5($data, $com){
        $query = $this->db->query('SELECT COUNT(`user`.user_id) AS total FROM `user` 
            INNER JOIN usertype ON user.usertype_id = usertype.usertype_id
            WHERE
            `user`.user_id NOT IN ("'.$data['user_id'].'")
            AND `user`.company = "'.$com['com'].'"
            AND `user`.usertype_id NOT IN ("super")');
        return $query->row('total');
    }
  
    public function count_all6($data){
        $query = $this->db->query('SELECT SUM(transfered_material.transfer_quantity) AS total FROM transfered_material INNER JOIN project ON project.project_code = transfered_material.transfer_from INNER JOIN `user` ON `user`.user_id = project.user_id WHERE project.user_id = "'.$data['user_id'].'" ');
        return $query->row('total');
    }

    public function count_all7($data){
        $query = $this->db->query('SELECT SUM(transfered_equipment.transfer_quantity) AS total FROM transfered_equipment INNER JOIN project ON transfered_equipment.transfer_from = project.project_code INNER JOIN `user` ON `user`.user_id = project.user_id INNER JOIN equipment_used ON equipment_used.eu_id = transfered_equipment.eu_id WHERE project.user_id = "'.$data['user_id'].'" ');
        return $query->row('total');
    }

    public function count_all8($data){
        $query = $this->db->query('SELECT SUM(worker.worker_quantity) AS total FROM project INNER JOIN `user` ON `user`.user_id = project.user_id INNER JOIN worker ON worker.project_code = project.project_code WHERE project.user_id = "'.$data['user_id'].'" ');
        return $query->row('total');
    }

    public function count_all9($data){
        $query = $this->db->query('SELECT
            SUM(manager_stock.quantity) as total
            FROM
            manager_stock
            INNER JOIN project ON manager_stock.project_code = project.project_code
            INNER JOIN `user` ON project.user_id = `user`.user_id
        WHERE project.user_id = "'.$data['user_id'].'" ');
        return $query->row('total');
    }

    public function count_all10($data){
        $query = $this->db->query('SELECT
            SUM(transfered_material.transfer_quantity) as total
            FROM
            transfered_material
            INNER JOIN project ON transfered_material.transfer_from = project.project_code
            INNER JOIN `user` ON `user`.user_id = project.user_id
        WHERE project.user_id = "'.$data['user_id'].'" ');
        return $query->row('total');
    }

    public function count_all11($data){
        $query = $this->db->query('SELECT
            SUM(manager_stock_equipment.quantity) as total
            FROM
            manager_stock_equipment
            INNER JOIN project ON manager_stock_equipment.project_code = project.project_code
            INNER JOIN user ON project.user_id = user.user_id
        WHERE project.user_id = "'.$data['user_id'].'" ');
        return $query->row('total');
    }

    public function count_all12($data){
        $query = $this->db->query('SELECT
            SUM(transfered_equipment.transfer_quantity) as total
            FROM
            transfered_equipment
            INNER JOIN project ON transfered_equipment.transfer_from = project.project_code
            INNER JOIN user ON user.user_id = project.user_id
        WHERE project.user_id = "'.$data['user_id'].'" ');
        return $query->row('total');
    }

    function get_datatables($data){
        $query = $this->db->query('SELECT project.project_title, project.project_desc,CONCAT(project.project_address,", ",city.city_name,", ",province.province_name,", ",province.zip_code) AS addr FROM project INNER JOIN city ON city.city_id = project.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN `user` ON `user`.user_id = project.user_id WHERE project.user_id = "'.$data['user_id'].'"');
        return $query->result();
    }

    function get_datatables2($data){
        $query = $this->db->query('SELECT
            material_used.mu_quantity,
            material.material_name,
            material_used.mu_date,
            project.project_title,
            supplier.supplier_name,
            DATE_FORMAT(mu_date,"%M %d, %Y") AS ddate
            FROM
            material_used
            INNER JOIN project ON project.project_code = material_used.project_code
            INNER JOIN `user` ON `user`.user_id = project.user_id
            INNER JOIN material ON material.material_id = material_used.material_id
            INNER JOIN supplier ON supplier.supplier_id = material.supplier_id
            WHERE project.user_id = "'.$data['user_id'].'"
            GROUP BY
            material_used.mu_id
            ');
        return $query->result();
    }
    
    function get_datatables3($data){
        $query = $this->db->query('SELECT
            equipment_used.eu_quantity ,
            equipment.equipment_name,
            project.project_title,
            equipment_used.eu_date,
            supplier.supplier_name,
            DATE_FORMAT(eu_date,"%M %d, %Y") AS ddate
            FROM
            equipment_used
            INNER JOIN project ON equipment_used.project_code = project.project_code
            INNER JOIN equipment ON equipment.equipment_id = equipment_used.equipment_id
            INNER JOIN supplier ON supplier.supplier_id = equipment.supplier_id
            WHERE 
            project.user_id = "'.$data['user_id'].'"
            GROUP BY
            equipment_used.eu_id
        ');
        return $query->result();
    }

    function get_datatables4($data){
        $query = $this->db->query('SELECT   *, city.zip_code as zip FROM  city INNER JOIN province ON city.province_id = province.province_id INNER JOIN supplier ON supplier.city_id = city.city_id  INNER JOIN user ON user.company = supplier.company_id WHERE user.user_id = "'.$data.'" ');
        return $query->result();
    }

    function get_datatables5($data, $com){
        $query = $this->db->query('SELECT CONCAT(user.user_fname," ",user.user_mname," ",user.user_lname) AS name, user.user_email, usertype.usertype_name, CONCAT(user.user_address,", ",city.city_name,", ",province.province_name,", ",province.zip_code) AS addr  FROM user INNER JOIN usertype ON usertype.usertype_id = user.usertype_id INNER JOIN city ON user.city_id = city.city_id INNER JOIN province ON city.province_id = province.province_id WHERE user.user_id NOT IN  ("'.$data['user_id'].'")  AND `user`.company = "'.$com.'" AND `user`.usertype_id NOT IN ("super")');
        return $query->result();
    }

    function get_datatables6($data){
        $query = $this->db->query('SELECT material.material_name, project.project_title, p2.project_title AS project_title1, concat(transfered_material.transfer_quantity," ",material.material_unit,"(s)") AS quantity, transfered_material.transfer_date FROM transfered_material INNER JOIN project ON project.project_code = transfered_material.transfer_from INNER JOIN `user` ON `user`.user_id = project.user_id INNER JOIN material_used ON transfered_material.mu_id = material_used.mu_id INNER JOIN material ON material_used.material_id = material.material_id INNER JOIN project AS p2 ON p2.project_code = transfered_material.transfer_to WHERE project.user_id = "'.$data['user_id'].'" ORDER BY transfer_date ASC');
        return $query->result();
    }

    function get_datatables7($data){
        $query = $this->db->query('SELECT  equipment.equipment_name, project.project_title, p2.project_title AS project_title1, transfered_equipment.transfer_quantity, transfered_equipment.transfer_date FROM transfered_equipment INNER JOIN project ON transfered_equipment.transfer_from = project.project_code INNER JOIN `user` ON `user`.user_id = project.user_id INNER JOIN equipment_used ON equipment_used.eu_id = transfered_equipment.eu_id INNER JOIN equipment ON equipment.equipment_id = equipment_used.equipment_id INNER JOIN project AS p2 ON p2.project_code = transfered_equipment.transfer_to WHERE project.user_id = "'.$data['user_id'].'" ORDER BY transfer_date ASC');
        return $query->result();
    }

    function get_datatables8($data){
        $query = $this->db->query('SELECT project.project_title, worker.worker_title, worker.worker_quantity, worker.worker_date FROM project INNER JOIN  user  ON  user.user_id = project.user_id INNER JOIN worker ON worker.project_code = project.project_code WHERE project.user_id ="'.$data['user_id'].'" ORDER BY worker_date ASC');
        return $query->result();
    }

    public function getProjects2($id){
        $condition = "user_id =" . "'" . $id. "'" ;
        $this->db->select('project_title,project_code');
        $this->db->from('project');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result();
    }

    public function getTasks($id){
        $query = $this->db->query('SELECT project.project_code,project_dtask.projdtsk_id, project_task.projtsk_id, project.project_title, project.project_desc, project.project_status, project_task.projtsk_name, project_dtask.projdtsk_percent, project_dtask.projdtsk_date,project_dtask.projdtsk_update  FROM project_task INNER JOIN project_dtask ON project_task.projtsk_id = project_dtask.projtsk_id INNER JOIN project ON project.project_code = project_dtask.project_code AND project.project_code = "'.$id.'"');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

}