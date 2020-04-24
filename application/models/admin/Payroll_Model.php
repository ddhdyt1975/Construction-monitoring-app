<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Payroll_Model extends CI_Model {

    var $table = 'additional_type';
    var $table1 = 'deduction_type';
    var $table2 = 'employee_type';
  
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

    function getAllProjects($data1, $data2) {
        $query = $this->db->query("SELECT
            project_title, project_code
            FROM
            project 
            INNER JOIN `user` ON `user`.company = project.company_id
            WHERE `user`.company = '".$data2."' AND `user`.user_id ='".$data1."' ");
 
        return $query->result();
    }

    function checknameAdd($title){
        $query = $this->db->query('SELECT * FROM additional_type WHERE description = "'.$title.'" ');
        return $query->result();
    }

    function checknameDeduc($title){
        $query = $this->db->query('SELECT * FROM deduction_type WHERE description = "'.$title.'" ');
        return $query->result();
    }

    function checknameDesc($title){
        $query = $this->db->query('SELECT * FROM employee_type WHERE description = "'.$title.'" ');
        return $query->result();
    }

    public function save($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function save1($data){
        $this->db->insert($this->table1, $data);
        return $this->db->insert_id();
    }

    public function save2($data){
        $this->db->insert($this->table2, $data);
        return $this->db->insert_id();
    }

    function get_datatables(){
        $this->db->from($this->table);
        $query = $this->db->query('SELECT additional_type.additionaltype_id, additional_type.description, additional_type.note, additional_type.created, additional_type.updated FROM additional_type');
        return $query->result();
    }

    function get_datatables1(){
        $this->db->from($this->table);
        $query = $this->db->query('SELECT deduction_type.deductiontype_id, deduction_type.description, deduction_type.note,
            deduction_type.created, deduction_type.updated FROM deduction_type');
        return $query->result();
    }

    function get_datatables2(){
        $this->db->from($this->table);
        $query = $this->db->query('SELECT * FROM employee_type ');
        return $query->result();
    }

    function get_datatables3(){
        $this->db->from($this->table);
        $query = $this->db->query('SELECT project_worker.pworker_id, project_worker.pworker_fname, project_worker.pworker_mname, project_worker.pworker_lname, project_worker.pworker_add, project_worker.city_id, project_worker.pworker_gender, project_worker.civil_status, project_worker.worker_photo, project_worker.user_id, project_worker.created, project_worker.dob, project_worker.contact_no, project_worker.sss, project_worker.philhealth, project_worker.pag_ibig, project_worker.bank_no, project_worker.`status`, project_worker.worker_type_id, project_worker.company_id, city.city_name, province.province_name, province.zip_code, employee_type.description, `user`.user_lname,`user`.user_fname FROM project_worker INNER JOIN city ON city.city_id = project_worker.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN `user` ON project_worker.user_id = `user`.user_id INNER JOIN employee_type ON project_worker.worker_type_id = employee_type.emptype_id
        ');
        return $query->result();
    }

    public function get_by_id($id){
        $this->db->from($this->table);
        $query = $this->db->query('SELECT additional_type.additionaltype_id, additional_type.description, additional_type.note, additional_type.created, additional_type.updated FROM additional_type WHERE additionaltype_id = "'.$id.'"');
        return $query->row();
    }

    public function get_by_id1($id){
        $this->db->from($this->table);
        $query = $this->db->query('SELECT deduction_type.deductiontype_id ,deduction_type.type as dtype, deduction_type.description, deduction_type.note,deduction_type.created, deduction_type.updated FROM deduction_type WHERE deductiontype_id = "'.$id.'"');
        return $query->row();
    }

    public function get_by_id2($id){
        $this->db->from($this->table);
        $query = $this->db->query('SELECT *  FROM employee_type WHERE emptype_id = "'.$id.'" ');
        return $query->row();
    }

    public function update($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function update1($where, $data){
        $this->db->update($this->table1, $data, $where);
        return $this->db->affected_rows();
    }

    public function update2($where, $data){
        $this->db->update($this->table2, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id){
        $this->db->where('additionaltype_id', $id);
        $this->db->delete($this->table);
    }

    public function delete_by_id1($id){
        $this->db->where('deductiontype_id', $id);
        $this->db->delete($this->table1);
    }

    public function delete_by_id2($id){
        $this->db->where('emptype_id', $id);
        $this->db->delete($this->table2);
    }

     public function saveadj($data){
        $this->db->insert('worker_designation', $data);
        return $this->db->insert_id();
    }

}
