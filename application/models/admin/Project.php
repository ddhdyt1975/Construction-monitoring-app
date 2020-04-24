<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Project extends CI_Model {

    var $table = 'project';
    var $table2 = "project_details";

    public function __construct() {
        parent::__construct();
    }

    public function getData($id){
         $query = $this->db->query('SELECT *,
            DATE_FORMAT(registered_date,"%M %d, %Y") AS ddate,
            DATE_FORMAT(registered_date,"%h:%i %p") AS time
            FROM
            `user`
            INNER JOIN city ON city.city_id = `user`.city_id
            INNER JOIN province ON province.province_id = city.province_id
            INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id
            INNER JOIN company_details ON company_details.company_id = `user`.company
            WHERE user_id ="'.$id.'"');
        return $query->row();
    }
    
    function addtask($data){
        $insert = $this->db->insert('project_task', $data);
        return $this->db->insert_id();
    }


    public function save($data, $data2)    {
        $this->db->insert($this->table, $data);
        $this->db->insert("project_details", $data2);
        
        return $this->db->insert_id();
    }

    function getCity(){
        $query = $this->db->query('SELECT *
            FROM
            city
            INNER JOIN province ON province.province_id = city.province_id
        ');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function getProjects(){
        $query = $this->db->query('SELECT *
            FROM
            project
            INNER JOIN city ON project.city_id = city.city_id
            INNER JOIN province ON province.province_id = city.province_id
            INNER JOIN `user` ON project.user_id = `user`.user_id
        ');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    public function getProjects2($com){
        $query = $this->db->query('SELECT *, DATE_FORMAT(project.created_date,"%M %d, %Y") AS ddate, DATE_FORMAT(project.update_date,"%M %d, %Y") AS edate FROM project LEFT JOIN user ON user.user_id = project.user_id WHERE user.company = "'.$com.'"');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    public function getp_by_id($id){ 
        $query = $this->db->query('SELECT *, `user`.user_id AS pmid, `owner`.user_fname AS ofname,
            `owner`.user_lname AS olname, 
            DATE_FORMAT(project.start_project,"%M %d, %Y") AS ddate,
            DATE_FORMAT(project.expected_end_date,"%M %d, %Y") AS edate,
            city.city_name,
            province.province_name
            FROM
            project
            INNER JOIN `user` ON project.user_id = `user`.user_id
            INNER JOIN project_details ON project_details.project_code = project.project_code
            INNER JOIN city ON city.city_id = project.city_id
            INNER JOIN province ON province.province_id = city.province_id
            INNER JOIN `user` AS `owner` ON project.project_owner = `owner`.user_id  
            WHERE
            project.project_code = project_details.project_code AND
            project.project_code = "'.$id.'" ');
        return $query->row();
    }

    public function delete_by_id($id){
        $this->db->where('project_code', $id);
        $this->db->delete($this->table);
    }
    
    public function update($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();    
    }


    public function update2($where, $data){
        $this->db->update($this->table2,$data, $where);
        return $this->db->affected_rows();         
    }

    public function getPM($com){
        $query = $this->db->query('SELECT * FROM user WHERE usertype_id="ut3" AND user.company = "'.$com.'" ');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    public function getOwner($com){
        $query = $this->db->query('SELECT * FROM user WHERE usertype_id="utv" AND user.company = "'.$com.'" ');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
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

    public function getimages_by_id($id){
        $query = $this->db->query('SELECT * FROM `photo` WHERE project_code  = "'.$id.'" ');
        return $query->result();
    }

    public function getprobs_by_id($id){
        $query = $this->db->query('SELECT project_task_comment_update.prjtsk_comment,project_task_comment_update.prjtskcom_update,project_task_comment_update.prjtsk_status,`user`.user_photo,project_task_comment_update.project_code FROM `user` INNER JOIN project ON project.user_id = `user`.user_id INNER JOIN project_task_comment_update ON project_task_comment_update.project_code = project.project_code WHERE project_task_comment_update.project_code  = "'.$id.'" ORDER BY project_task_comment_update.prjtskcom_update DESC');
        return $query->result();
    }

    public function no_of_eq($id){
        $query = $this->db->query('SELECT SUM(equipment_used.eu_quantity) AS total  FROM project INNER JOIN equipment_used ON equipment_used.project_code = project.project_code INNER JOIN equipment ON equipment.equipment_id = equipment_used.equipment_id WHERE project.project_code = "'.$id.'" ');
        return $query->row();
    }

    public function no_of_mate($id){
        $query = $this->db->query('SELECT SUM(material_used.mu_quantity) total2 FROM project INNER JOIN material_used ON project.project_code = material_used.project_code WHERE project.project_code = "'.$id.'" ');
         return $query->row();
    }
}
