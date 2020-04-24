<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Attendance extends CI_Model {

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

    function savedata($data) {
        $this->db->insert("worker_designation", $data);
        return $this->db->insert_id();
    }

    function savedata2($data, $file) { 

        $this->db->query("LOAD DATA LOCAL INFILE  '".$data."' 
            INTO TABLE worker_designation
            FIELDS TERMINATED BY ' ' 
            LINES STARTING BY ' ' 
            TERMINATED BY '\\n' 
             (pworker_id,desig_date,time,project_code,evalute,a,b,file)
            SET file = '".$file."'
        ");

         
        
        return $this->db->insert_id();
    }

    function get_by_id($id){
        $query = $this->db->query('SELECT file_name
            FROM
            uploaded_att_file
            WHERE uploaded_att_file.file_id="'.$id.'" ');
        return $query->row();
    }
    

    public function delete_by_id($id){
        $this->db->where('file_id', $id);
        $this->db->delete('uploaded_att_file');
    }

     public function delete_by_evaluate($id){
        $this->db->where('file', $id);
        $this->db->delete('worker_designation');
    }


}