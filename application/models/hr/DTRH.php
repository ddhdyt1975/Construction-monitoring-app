<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class DTRH extends CI_Model {

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
        $query = $this->db->query('SELECT project_worker.pworker_id, project_worker.pworker_fname, project_worker.pworker_lname, worker_designation.project_code
            FROM
            worker_designation
            INNER JOIN project_worker ON project_worker.pworker_id = worker_designation.pworker_id
            INNER JOIN project ON project.project_code = worker_designation.project_code
            WHERE worker_designation.project_code = "'.$com.'"
            GROUP BY project_worker.pworker_id ');
        return $query->result();
    }

    function get_dtr_by_id($id,$id2){
        $query = $this->db->query('SELECT *,  DATE_FORMAT(time,"%h:%i:%s %p") AS dtime,
        project.project_title
        FROM
        worker_designation
        INNER JOIN project ON worker_designation.project_code = project.project_code
        WHERE pworker_id="'.$id.'" 
        AND worker_designation.project_code = "'.$id2.'" ');
        return $query->result();
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
}