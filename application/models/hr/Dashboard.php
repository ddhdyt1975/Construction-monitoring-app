<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Dashboard extends CI_Model {

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

    public function count_all1($com){
        $query = $this->db->query('SELECT
            *
            FROM
            project
            INNER JOIN city ON city.city_id = project.city_id
            INNER JOIN province ON province.province_id = city.province_id INNER JOIN `user` ON `user`.user_id = project.user_id WHERE user.company ="'.$com.'" ');
        return $query->num_rows();
    }

    public function count_all2($com){
        $query = $this->db->query('SELECT  pworker_id FROM project_worker WHERE  company_id = "'.$com.'" ');
        return $query->num_rows();
    }

    function get_datatables($com){        
        $query = $this->db->query('SELECT
            *
            FROM
            project
            INNER JOIN city ON city.city_id = project.city_id
            INNER JOIN province ON province.province_id = city.province_id INNER JOIN `user` ON `user`.user_id = project.user_id WHERE user.company ="'.$com.'" ');
        return $query->result();
    }

    function get_datatables1($com) {
        $query = $this->db->query('SELECT project_worker.pworker_id, project_worker.pworker_fname, project_worker.pworker_mname, project_worker.pworker_lname, project_worker.pworker_add, project_worker.city_id, project_worker.pworker_gender, project_worker.civil_status, project_worker.worker_photo, project_worker.user_id, project_worker.created, project_worker.dob, project_worker.contact_no, project_worker.sss, project_worker.philhealth, project_worker.pag_ibig, project_worker.bank_no, project_worker.`status`, project_worker.worker_type_id, project_worker.company_id, city.city_name, province.province_name, province.zip_code, employee_type.description, project_worker.tax_code, project_worker.blood_type, project_worker.tin_number, project_worker.height, project_worker.weight FROM
        project_worker
        INNER JOIN city ON city.city_id = project_worker.city_id
        INNER JOIN province ON province.province_id = city.province_id
        INNER JOIN `user` ON project_worker.user_id = `user`.user_id
        INNER JOIN employee_type ON project_worker.worker_type_id = employee_type.emptype_id WHERE project_worker.company_id="'.$com.'" ');
        return $query->result();
    }

}