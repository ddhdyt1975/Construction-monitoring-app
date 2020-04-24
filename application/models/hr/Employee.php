<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Employee extends CI_Model {

    var $table = 'project_worker';

    public function __construct() {
        parent::__construct();
    }

    function getAllProjects($data1, $data2) {
        $query = $this->db->query("SELECT
            project_title, project_code
            FROM
            project 
            INNER JOIN `user` ON `user`.company = project.company_id
            WHERE `user`.company = '".$data2."' AND `user`.user_id ='".$data1."' ");
 
        return $query->result();
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
        $query = $this->db->query('SELECT
                project_worker.pworker_id,
                project_worker.pworker_fname,
                project_worker.pworker_mname,
                project_worker.pworker_lname,
                project_worker.pworker_add,
                project_worker.city_id,
                project_worker.pworker_gender,
                project_worker.civil_status,
                project_worker.worker_photo,
                project_worker.user_id,
                project_worker.created,
                project_worker.dob,
                project_worker.contact_no,
                project_worker.sss,
                project_worker.philhealth,
                project_worker.pag_ibig,
                project_worker.bank_no,
                project_worker.`status`,
                project_worker.worker_type_id,
                project_worker.company_id,
                city.city_name,
                province.province_name,
                province.zip_code,
                employee_type.description,
                project_worker.tax_code,
                project_worker.blood_type,
                project_worker.tin_number,
                project_worker.height,
                project_worker.weight,
                employee_type.alias
            FROM
                project_worker
                INNER JOIN city ON city.city_id = project_worker.city_id
                INNER JOIN province ON province.province_id = city.province_id
                INNER JOIN `user` ON project_worker.user_id = `user`.user_id
                INNER JOIN employee_type ON project_worker.worker_type_id = employee_type.emptype_id
            WHERE project_worker.company_id="'.$com.'"');
        return $query->result();
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

    function getPosition() {
        $query = $this->db->query('SELECT * FROM employee_type ORDER BY alias ASC');
        return $query->result();
    }

    public function save($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id){
        $this->db->from($this->table);
        $query = $this->db->query('SELECT
        project_worker.pworker_id,
        project_worker.pworker_fname,
        project_worker.pworker_mname,
        project_worker.pworker_lname,
        project_worker.pworker_add,
        project_worker.pworker_gender,
        project_worker.civil_status,
        project_worker.worker_photo,
        project_worker.user_id,
        project_worker.created,
        project_worker.dob,
        project_worker.contact_no,
        project_worker.sss,
        project_worker.philhealth,
        project_worker.pag_ibig,
        project_worker.bank_no,
        project_worker.`status`,
        project_worker.company_id,
        employee_type.description,
        city.city_name,
        city.zip_code,
        province.province_name,
        city.city_id,
        employee_type.emptype_id,
        project_worker.tax_code,
        project_worker.blood_type,
        project_worker.tin_number,
        project_worker.height,
        project_worker.weight
        FROM
        employee_type
        INNER JOIN project_worker ON project_worker.worker_type_id = employee_type.emptype_id
        INNER JOIN city ON project_worker.city_id = city.city_id
        INNER JOIN province ON city.province_id = province.province_id
        WHERE project_worker.pworker_id="'.$id.'"');
        return $query->row();
    }

    public function update($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id){
        $this->db->where('pworker_id', $id);
        $this->db->delete($this->table);
    }
 
}