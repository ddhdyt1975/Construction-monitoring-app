<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Attendance extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getData($id){
        $query = $this->db->query('SELECT * FROM `user` INNER JOIN city ON city.city_id = `user`.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id WHERE user_id = "'.$id['user_id'].'"');
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