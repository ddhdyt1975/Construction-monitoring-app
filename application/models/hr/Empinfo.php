<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Empinfo extends CI_Model {

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

    function get_datatables($com){
        $query = $this->db->query('SELECT *
            FROM
            uploaded_att_file
            INNER JOIN `user` ON `user`.user_id = uploaded_att_file.user_id
            WHERE uploaded_att_file.company_id="'.$com.'" ');
        return $query->result();
    }

    function upload_att($data) {
        $this->db->insert("uploaded_att_file", $data);
        return $this->db->insert_id();
    }

    function getEmployees($data) {
        $query = $this->db->query('SELECT
            project_worker.pworker_id,
            project_worker.pworker_mname,
            project_worker.pworker_lname,
            project_worker.pworker_fname
            FROM
            project_worker
            WHERE
            company_id ="'.$data.'" ');
        return $query->result();
    }

  
    public function get_by_id($id){ 
        $query = $this->db->query('SELECT
        *
        FROM
        employee_type
        INNER JOIN project_worker ON project_worker.worker_type_id = employee_type.emptype_id
        INNER JOIN city ON project_worker.city_id = city.city_id
        INNER JOIN province ON city.province_id = province.province_id
        WHERE project_worker.pworker_id="'.$id.'"');
        return $query->row();
    }

    function get_dtr_by_id($id){
        $query = $this->db->query('SELECT *,DATE_FORMAT(desig_date,"%M %d, %Y") AS ddate, DATE_FORMAT(time,"%h:%i:%s %p") AS dtime,
        project.project_title
        FROM
        worker_designation
        INNER JOIN project ON worker_designation.project_code = project.project_code
        WHERE pworker_id="'.$id.'" ');
        return $query->result();
    }

    
 
}